<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class comment extends MY_Controller
{
    /**
     * 添加产品评论
     */
    public function addComment()
    {
        $data['pid'] = intval($this->input->get_post('pid'));
        $data['title'] = $this->input->get_post('title');
        $data['content'] = $this->input->get_post('content');
        $data['ip'] = $this->input->ip_address();
        $data['rank'] = intval($this->input->get_post('rank'));
        $data['comfort'] = intval($this->input->get_post('comfort'));
        $data['exterior'] = intval($this->input->get_post('exterior'));
        $data['size_deviation'] = intval($this->input->get_post('size_deviation'));

        $response = array('error' => '0', 'msg' => '评论成功', 'code' => 'comment_success');

        do {
            if (empty ($data['pid']) ||
                empty ($data['title']) ||
                empty ($data['content']) ||
                empty ($data['rank']) ||
                empty ($data['comfort']) ||
                empty ($data['exterior']) ||
                empty ($data['size_deviation'])) {
                $response = error(50008);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }
            $data['uid'] = isset ($this->uInfo['uid']) ? $this->uInfo['uid'] : '';
            $data['uname'] = isset ($this->uInfo['uname']) ? $this->uInfo['uname'] : '';

            //产品是否存在
            $this->load->model('product/Model_Product', 'product');
            $pInfo = $this->product->productIsExist($data['pid']);
            if (!$pInfo) {
                $response = error(20002);
                break;
            }

            //是否购买过产品
            $this->load->model('order/Model_order', 'order');
            $isBuyProduct = $this->order->userIsBuyProduct($this->uInfo['uid'], $data['pid']);
            if (empty ($isBuyProduct)) {
                $response = error(50002);
                break;
            }
            $data['size'] = isset ($isBuyProduct['product_size']) ? $isBuyProduct['product_size'] : $isBuyProduct['product_size'];

            //是否评论过
            if ($isBuyProduct['comment_status'] == '1') {
                $response = error(50019);
                break;
            }
            $data['o_p_id'] = isset ($isBuyProduct['id']) ? $isBuyProduct['id'] : '';//订单产品表自增ID

            //获取产品颜色
            $this->load->model('product/Model_Product_Color', 'color');
            $colorData = $this->color->getColorById($pInfo['color_id']);
            $data['color'] = isset ($colorData['china_name']) ? $colorData['china_name'] : '';

            $this->load->model('product/Model_Product_comment', 'comment');
            $status = $this->comment->addProductComment($data);
            if (!$status) {
                $response = error(50003);
                break;
            }
        } while (false);

        echo json_encode($response);
    }

    /**
     * 用户是否购买过此产品
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

            //是否评论过
            if ($isBuyProduct['comment_status'] == '1') {
                $response = error(50019);
                break;
            }

            $response['data'] = $isBuyProduct;
        } while (false);

        self::json_output($response);
    }

    /**
     * 评论是否有效, 1为有效，0为无效
     */
    public function CommentIsValid()
    {
        $commentId = intval( $this->input->get_post('comment_id') );
        $operaType = intval( $this->input->get_post('opera_type') );

        $response = array('error' => '0', 'msg' => '评论是否有效提供成功', 'code' => 'comment_whether_effective_delivery_successful');

        do {
            if (empty ($commentId)) {
                $response = error(50008);
                break;
            }

            $operaType = $operaType == 1 ? true : false;

            $this->load->model('product/Model_Product_comment', 'comment');
            $status = $this->comment->productCommentIsValid($commentId, $operaType);
            if (!$status) {
                $response = error(50009);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 产品评论回复
     */
    public function commentReply()
    {
        $commentId = intval( $this->input->get_post('comment_id') );
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();

        $response = array('error' => '0', 'msg' => '评论回复成功', 'code' => 'comment_reply_success');

        do {
            if (empty ($commentId) || empty ($content)) {
                $response = error(50008);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $data = array(
                'comment_id' => $commentId,
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'ip' => $ip,
                'reply_content' => $content
            );

            $this->load->model('product/Model_Product_comment', 'comment');
            $status = $this->comment->addProductCommentReply($data);
            if (!$status) {
                $response = error(50007);
                break;
            }
        } while (false);


        $this->json_output($response);
    }

    /**
     *
     */
    public function ajaxComment()
    {
        $pid = intval( $this->input->get_post('pid') );
        $limit = max(10, $this->input->get_post('limit'));
        $pageno = max(1, $this->input->get_post('pageno'));
        $offset = ($pageno - 1) * $limit;
        $this->load->model('product/Model_Product_comment', 'comment');
        $re['totalCount'] = $this->comment->getCommentCountByPid($pid);
        $re['comments'] = array();
        if($re['totalCount'])
        {
            $re['comments'] = $this->comment->getCommentByPid($pid, $limit, $offset, $field = 'comment_id,pid,uid,uname,content, is_valid, is_invalid, color, size, rank, comfort, exterior, size_deviation,  create_time');
            foreach($re['comments'] as $item)
            {
                $uid[] = $item['uid'];
            }
            $this->load->model('user/Model_User', 'user');
            $uinfo = $this->user->getUserInfoById($uid, array('uid'=>'uid, height, weight'));
            //print_r($re['comments']);
            foreach($re['comments'] as $key=>$item)
            {
                $re['comments'][$key] += $uinfo[$item['uid']];
            }
        }
        self::json_output($re, true);
    }

    public function ajaxTop()
    {
        $response = error(10009);
        if($this->isLogin())
        {
            $cid = $this->input->get_post('cid');
            $top = $this->input->get_post('top') ? true:false;
            $this->load->model('product/Model_Product_comment', 'comment');
            $r = $this->comment->top($cid, $this->uInfo['uid'], $top);
            $response = array('error'=>0);
            if (!$r)
            {
                $response = error(50004);
            }
        }
        self::json_output($response, true);
    }

    public function ajaxAppraise()
    {
        $pid = $this->input->get_post('pid');
        $response = array();
        if ($pid) {
            $this->load->model('product/Model_Product_comment', 'comment');
            $response = $this->comment->getAppraise($pid);
        }
        //print_r($response);
        self::json_output($response, true);
    }

    public function deleteComment()
    {
        $cId = $this->input->get_post('cid');

        $response = array('error' => '0', 'msg' => '删除产品评论成功', 'code' => 'delete_product_comment_success');;

        do {
            if (empty ($cId)) {
                $response = error(20021);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('product/Model_Product_comment', 'comment');
            $status = $this->comment->deleteProductCommentByCommentId($cId);
            if (!$status) {
                $response = error(20022);
                break;
            }
        } while (false);

        $this->json_output($response);
    }
}
