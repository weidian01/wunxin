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

        if (empty ($pid) || empty ($title) || empty ($content)) {
            show_error('参数不全');
        }

        if (!$this->isLogin()) {
            show_error('用户没有登陆');
        }

        $this->load->model('order/Model_order', 'order');
        $data = $this->order->userIsBuyProduct(1, 1); //($uid, $pid);
        if (empty ($data)) {
            show_error('没有购买过此商品');
        }

        if ($data['share_status'] == '1') {
            show_error('你已对此商品进行过晒单');
        }

        $data = array(
            'pid' => $pid,
            'uid' => $this->uInfo['uid'],
            'title' => $title,
            'content' => $content,
            'ip' => $ip
        );
        $this->load->model('product/Model_Product_Share', 'share');
        $status = $this->share->productShare($data);
        if (!$status) {
            show_error('产品晒单失败');
        }

        //
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
            $config['max_size'] = '1000';
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

            //是否购买过产品
            $this->load->model('order/Model_order', 'order');
            $isBuyProduct = $this->order->userIsBuyProduct($this->uInfo['uid'], $data['pid']);
            if (empty ($isBuyProduct)) {
                $response = error(50002);
                break;
            }

            //是否晒单过
            if ($isBuyProduct['share_status'] == '1') {
                $response = error(50020);
                break;
            }

            $response['data'] = $isBuyProduct;
        } while (false);

        self::json_output($response);
    }

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
                $response['share'] = $this->share->getProductShareByPid($pid, $limit, $offset, '*', 'share_id DESC');
                if($response['share'])
                {
                    $this->load->model('user/Model_User', 'user');
                    $uinfo = $this->user->getUserInfoById($response['share'][0]['uid'], array('uid' => 'height, weight'));
                    $response['share'][0]['height'] = $uinfo['height'];
                    $response['share'][0]['weight'] = $uinfo['weight'];
                }
            }
        }
        self::json_output($response , true);
    }
}
