<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-27
 * Time: 下午10:54
 * To change this template use File | Settings | File Templates.
 */
class user_comment extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    /**
     * 用户评论列表
     */
    public function userCommentList()
    {
        $uId = $this->uri->segment(4, 1);
        if (!$uId) {
            show_error('用户ID为空');
        }

        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('user/Model_Designer_Comment', 'comment');
        $totalNum = $this->comment->getDesignerCommentByUidCount($uId);
        $data = $this->comment->getDesignerCommentByUid($uId, $Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/user_comment/userCommentList/'.$uId;
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
        //echo '<pre>';print_r($data);exit;
        $this->load->view('/administrator/user/comment/list', array('data' => $data, 'page_html' => $pageHtml, 'current_page' => $currentPage));
    }

    public function commentDetail()
    {
        $mId = $this->uri->segment(4, 1);
        if (!$mId) {
            show_error('留言ID为空');
        }

        $this->load->model('user/Model_Designer_Comment', 'comment');
        $messageData = $this->comment->getDesignerCommentByCommentId($mId);

        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('user/Model_Designer_Comment', 'comment');
        $totalNum = $this->comment->getReplyByCommentIdCount($mId);
        $reply_data = $this->comment->getReplyByCommentId($mId, $Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/user_comment/commentDetail/'.$mId;
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
        //echo '<pre>';print_r($data);exit;
        $this->load->view('/administrator/user/comment/detail', array('message_data' => $messageData, 'reply_data' => $reply_data, 'page_html' => $pageHtml, 'current_page' => $currentPage));
    }

    /**
     * 删除用户留言
     */
    public function commentDelete()
    {
        $mId = $this->uri->segment(4, 0);
        $uId = $this->uri->segment(5, 0);
        $currentPage = $this->uri->segment(6, 1);
        if (!$mId) {
            show_error('留言ID为空');
        }

        if (!$uId) {
            show_error('用户ID为空');
        }

        $this->load->model('user/Model_Designer_Comment', 'comment');
        $status = $this->comment->deleteDesignerCommentByCommentId($mId);
        if (!$status) {
            show_error('删除留言失败');
        }

        redirect('/administrator/user_comment/userCommentList/'.$uId.'/'.$currentPage);
    }

    /**
     * 删除留言回复 -- 通过回复ID
     */
    public function deleteReply()
    {
        $rId = $this->uri->segment(4, 0);
        $mId = $this->uri->segment(5, 0);
        if (!$rId) {
            show_error('留言回复ID为空');
        }

        if (!$mId) {
            show_error('留言ID为空');
        }

        $this->load->model('user/Model_Designer_Comment', 'comment');
        $this->comment->deleteProductCommentReplyByReplyId($rId);

        redirect('/administrator/user_comment/commentDetail/'.$mId);
    }
}
