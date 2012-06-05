<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class product_comment extends MY_Controller
{
    public function postProductComment()
    {
        $uid = $this->input->get_post('uid');
        $pid = $this->input->get_post('pid');
        $title = $this->input->get_post('title');
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();
        $rank = $this->input->get_post('rank');

        $response = error(50004);
        do {
            if (empty ($uid) || empty ($pid) || empty ($title) || empty ($content) || empty ($rank)) {
                $response = error(50008);
                break;
            }
            $this->load->model('order/Model_order', 'order');
            $data = $this->order->userIsBuyProduct(1, 1); //($uid, $pid);
            if (empty ($data)) {
                $response = error(50002);
                break;
            }

            $data = array(
                'pid' => $data['pid'],
                'uid' => $data['uid'],
                'uname' => $data['uname'],
                'comment_title' => $title,
                'comment_content' => $content,
                'ip' => $ip,
                'rank' => $rank
            );

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
     * 评论是否有效, 1为有效，0为无效
     */
    public function postProductCommentIsValid()
    {
        $commentId = $this->input->get_post('comment_id');
        $operaType = $this->input->get_post('opera_type');


        $response = error(50005);

        do {
            if (empty ($commentId) || empty ($operaType)) {
                $response = error(50008);
                break;
            }

            $operaType = $operaType == 1 ? true : false;

            $this->load->model('comment/Model_Product_comment', 'comment');
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
    public function postProductCommentReply()
    {
        $uid = $this->input->get_post('uid');
        $commentId = $this->input->get_post('comment_id');
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();

        $response = error(50006);

        do {
            if (empty ($uid) || empty ($commentId) || empty ($content)) {
                $response = error(50008);
                break;
            }

            $uInfo = $this->isLogin();
            if (!$uInfo) {
                $response = error(10009);
                break;
            }

            $this->load->model('comment/Model_Product_comment', 'comment');
            $data = array(
                'comment_id' => $commentId,
                'uid' => $uInfo['uid'],
                'uname' => $uInfo['uname'],
                'ip' => $ip,
                'reply_content' => $content
            );
            $status = $this->comment->addProductCommentReply($data);
            if (!$status) {
                $response = error(50007);
                break;
            }

            $this->comment->updateCommentReplyNum($commentId);
        } while (false);


        $this->json_output($response);
    }

    /**
     *
     */
}
