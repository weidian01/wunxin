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
    public function postProductComment()
    {
        $uid = $this->input->get_post('uid');
        $pid = $this->input->get_post('pid');
        $title = $this->input->get_post('title');
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();
        $rank = $this->input->get_post('rank');

        $response = array('error'=>0);

        do {
            if (empty ($uid) || empty ($pid) || empty ($title) || empty ($content) || empty ($rank)) {
                $response = error(50008);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
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
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
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

            $this->load->model('product/Model_Product_comment', 'comment');
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
    public function ajaxComment()
    {
        $pid = $this->input->get_post('pid');
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
            $uinfo = $this->user->getUserInfoById($uid, array('uid'=>'uid, header, height, weight'));
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
        $response = error(20002);
        if ($pid) {
            $this->load->model('product/Model_Product_comment', 'comment');
            $response = $this->comment->getAppraise($pid);
        }
        self::json_output($response, true);
    }
}
