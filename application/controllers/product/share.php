<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class share extends MY_Controller
{
    /**
     * 晒单
     */
    public function add()
    {
        $pid = $this->input->get_post('pid');
        $title = $this->input->get_post('title');
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();
        $orderSn = intval($this->input->get_post('order_sn'));

        if (empty ($pid) || empty ($title) || empty ($content)) {
            show_error('参数不全');
        }

        if (!$this->isLogin()) {
            show_error('用户没有登陆');
        }

        if (empty ($orderSn)) {
            $orderSn = null;
        }

        $this->load->model('order/Model_order', 'order');
        $data = $this->order->userIsBuyProduct($this->uInfo['uid'], $pid, $orderSn); //($uid, $pid);
        if (empty ($data)) {
            show_error('没有购买过此商品');
        }

        $key = 0;
        if (empty ($data['order_sn'])) {
            foreach ($data as $k=>$v) {
                if ($v['share_status'] == 0) {
                    $orderSn = $v['order_sn'];
                    $key = $k;
                }
            }
        }
        $data = $data[$key];

        if ($data['share_status'] == '1') {
            show_error('你已对此商品进行过晒单');
        }

        $this->load->model('product/model_product', 'product');
        $pInfo = $this->product->getProductById($pid);
        $this->load->model('product/model_product_color', 'color');
        $colorInfo = $this->color->getColorById($pInfo['color_id']);

        $info = array(
            'pid' => $pid,
            'uid' => $this->uInfo['uid'],
            'title' => $title,
            'content' => $content,
            'ip' => $ip,
            'size' => $data['product_size'],
            'color' => $colorInfo['descr'],
            'order_sn' => $orderSn,
        );

        $this->load->model('product/Model_Product_Share', 'share');
        $status = $this->share->productShare($info);
        if (!$status) {
            show_error('产品晒单失败');
        }

        foreach ($_FILES['images'] as $key => $item) {
            foreach ($item as $k => $v) {
                $_FILES['image' . $k][$key] = $v;
            }
        }
        unset($_FILES['images']);

        if ($_FILES['image0']['size'] > 0) {
            $this->load->helper('directory');
            $path = intToPath($pid);
            $config['upload_path'] = UPLOAD . 'product_share' . DS . $path.$status.DS;
            recursiveMkdirDirectory($config['upload_path']);
            $config['allowed_types'] = 'gif|jpg|png|jepg';
            $config['max_size'] = '4000';
            $config['encrypt_name'] = true;
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $product_photo = array();
            foreach ($_FILES as $key => $item) {
                if (!$this->upload->do_upload($key)) {
                    show_error($this->upload->display_errors());
                } else {
                    $tmp = $this->upload->data();
                    $source_file = $config['upload_path'] . $tmp['file_name'];
                    //copyImg($source_file, 350, 420, str_replace('.', '_M.', $source_file));
                    //copyImg($source_file, 60, 60, str_replace('.', '_S.', $source_file));
                    $product_photo[] = $path .$status.DS. $tmp['file_name'];
                }
            }
        }

        foreach ($product_photo as $k => $v) {
            $data = array(
                'share_id' => $status,
                'img_addr' => $v,
                'is_cover' => ($k == '0') ? '1' : '0',
            );
            $this->share->saveProductShareImage($data);
        }

        redirect('/product/share/shareDescribe/'.$status);
    }

    /**
     * 用户是否购买过此产品并没有晒单
     */
    public function isBuyProduct()
    {
        $data['pid'] = intval($this->input->get_post('pid'));
        $data['order_sn'] = intval($this->input->get_post('order_sn'));

        $response = array('error' => '0', 'msg' => '已购买', 'code' => 'need_buy');

        do {
            if ( empty ($data['pid'])) {
                $response = error(50008);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            if (empty ($data['order_sn'])) {
                $data['order_sn'] = null;
            }

            //是否购买过产品
            $this->load->model('order/Model_order', 'order');
            $isBuyProduct = $this->order->userIsBuyProduct($this->uInfo['uid'], $data['pid'], $data['order_sn']);
            if (empty ($isBuyProduct)) {
                $response = error(50002);
                break;
            }

            //判断是否传过来订单ID，如没有传过来，则随机选取一条订单内产品
            $flag = false;
            foreach ($isBuyProduct as $v) {
                if ($v['share_status'] == 0) {
                    $flag = true;
                }
            }

            if (!$flag) {
                $response = error(50020);
                break;
            }

            /*
            //是否晒单过
            if ($isBuyProduct['share_status'] == '1') {
                $response = error(50020);
                break;
            }
            //*/

            $response['data'] = $isBuyProduct[0];
        } while (false);

        self::json_output($response);
    }

    public function getUserShareProduct()
    {
        $orderSn = intval($this->input->get_post('order_sn'));

        $response = array('error' => '0', 'msg' => '获取成功', 'code' => 'get_success');

        do {
            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('product/Model_Product_Share', 'share');
            $data = $this->share->getUserShareProductList($this->uInfo['uid'], $orderSn);

            $response['data'] = $data;
        } while (false);

        self::json_output($response);
    }

    /**
     * 晒单照片描述
     */
    public function shareDescribe()
    {
        $shareId = $this->uri->segment(4, 0);

        if ( empty ($shareId) ) {
            show_error('参数错误!');
        }

        if(! $this->input->is_ajax_request()){
            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }

        $this->load->model('product/Model_Product_Share', 'share');
        $shareImg = $this->share->getProductShareImage($shareId);
        $this->load->view('product/share/describe', array('s_img' => $shareImg));
    }

    /**
     * 保存晒单照片描述
     */
    public function saveShareDescribe()
    {
        $number = $this->input->get_post('number');
        $PhotoCover = $this->input->get_post('PhotoCover');

        $this->load->model('product/Model_Product_Share', 'share');

        for ($i = 1; $i <= $number; $i++) {
            $id = $this->input->get_post('s_img_'.$i);
            $title = $this->input->get_post('photo_name_'.$i);
            $content = $this->input->get_post('photo_desc_'.$i);


            $data = array(
                'title' => $title,
                'descr' => $content,
                'is_cover' => $PhotoCover == $id ? '1' : '0',
            );
            $this->share->updateShareImage($data, $id);
        }

        redirect('/');
        //$this->load->view('product/share/describe');
    }

    /**
     * 喜欢晒单产品图片
     */
    public function likeShareImage()
    {
        $imgId = $this->input->get_post('img_id');

        $response = array('error' => '0', 'msg' => '喜欢晒单产品成功', 'code' => 'like_share_product_success');

        do {
            if (empty ($imgId)) {
                $response = error(20009);
                break;
            }

            $this->load->model('product/Model_Product_Share', 'share');
            $status = $this->share->likeProductShareImage($imgId);
            if (!$status) {
                $response = error(20008);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 添加晒单评论
     */
    public function comment()
    {
        $sId = $this->input->get_post('sid');
        $content = $this->input->get_post('content');

        $response = array('error' => '0', 'msg' => '产品晒单评论成功', 'code' => 'product_share_comment_success');

        do {
            if (empty ($sId) || empty ($content)) {
                $response = error(20020);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $data = array(
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'content' => $content,
            );
            $this->load->model('product/Model_Product_Share', 'share');
            $status = $this->share->shareComment($sId, $data);
            if (!$status) {
                $response = error(20019);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    public function ajaxGetShareByPid()
    {
        $pid = $this->input->get_post('pid');
        $limit = max(10, $this->input->get_post('limit'));
        $offset = max(0, $this->input->get_post('offset'));

        $response  = error(20002);
        if($pid > 0)
        {
            $response = array();
            $this->load->model('product/Model_Product_Share', 'share');
            $response['total'] = $this->share->getProductShareCountByPid($pid);
            $response['share'] = array();
            if($response['total'])
            {
                $response['share'] = $this->share->getProductShareByPid($pid, $limit, $offset, array('share_id'=>'*'), 'share_id ASC');
                //p($response['share']);exit;
                if($response['share'])
                {
                    $tmp = current($response['share']);
                    $this->load->model('user/Model_User', 'user');
                    $uinfo = $this->user->getUserAllInfoById($tmp['uid']);

                    $response['share'][$tmp['share_id']]['height'] = $uinfo['height'];

                    $response['share'][$tmp['share_id']]['height'] = $uinfo['height'];
                    $response['share'][$tmp['share_id']]['weight'] = $uinfo['weight'];
                    $response['share'][$tmp['share_id']]['uname'] = $uinfo['uname'];
                    $response['share'][$tmp['share_id']]['nickname'] = $uinfo['nickname'];
                    $response['share'][$tmp['share_id']]['body_type'] = $uinfo['body_type'];
                    $response['share'][$tmp['share_id']]['integral'] = $uinfo['integral'];

                    //p($response['share']);exit;
                }
                $share_img = $this->share->getProductShareImage(array_keys($response['share']), 'share_id, img_addr, descr' , array('is_cover'=>1));
                foreach($share_img as $img)
                {
                    $response['share'][$img['share_id']] += $img;
                }
                //p($response['share']);exit;
            }
        }
        self::json_output($response , true);
    }
}
