<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-14
 * Time: 下午1:53
 * To change this template use File | Settings | File Templates.
 */
class design_comment extends MY_Controller
{
    public $commentSearchType = array(
            1 => '评论ID',
            2 => '用户ID',
            3 => '设计图ID',
        );

    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    public function viewComment()
    {
        $cId = $this->uri->segment(4, 1);

        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;

        if (!$cId) {
            show_error('评论Id为空');
        }

        $this->load->model('design/Model_Design_Comment', 'comment');
        $cData = $this->comment->getDesignCommentByCid($cId);
//echo '<pre>';print_r($cData);exit;
        $totalNum = $this->comment->getReplyCommentCount($cId);
        $rData = $this->comment->getReplyByCommentId($cId, $Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/design_comment/viewComment/'.$cId;
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/design/comment/reply_list', array('comment_data' => $cData, 'reply_data' => $rData, 'page_html' => $pageHtml));
    }

    public function commentList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('design/Model_Design_Comment', 'comment');
        $cData = $this->comment->getCommentList($Limit, $offset);
        $totalNum = $this->comment->getCommentCount();

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/design_comment/commentList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/design/comment/list', array('data' => $cData, 'page_html' => $pageHtml, 'searchType' => $this->commentSearchType));
    }

    public function designCommentList()
    {
        $Limit = 20;
        $dId = $this->uri->segment(4, 1);
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;

        if (!$dId) {
            show_error('设计图评论ID为空');
        }

        $this->load->model('design/Model_Design_Comment', 'comment');
        $cData = $this->comment->getDesignCommentByDid($dId, $Limit, $offset);
        $totalNum = $this->comment->getDesignCommentCount($dId);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/design_comment/designCommentList/' . $dId;
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/design/comment/list', array('data' => $cData, 'page_html' => $pageHtml, 'searchType' => $this->commentSearchType));
    }

    public function userCommentList()
    {
        $Limit = 20;
        $uId = $this->uri->segment(4, 1);
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;

        if (!$uId) {
            show_error('用户ID为空');
        }

        $this->load->model('design/Model_Design_Comment', 'comment');
        $cData = $this->comment->getCommentByUid($uId, $Limit, $offset);
        $totalNum = $this->comment->getUserCommentCount($uId);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/design_comment/designCommentList/' . $uId;
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/design/comment/list', array('data' => $cData, 'page_html' => $pageHtml, 'searchType' => $this->commentSearchType));
    }

    /**
     * 搜索评论信息
     */
    public function search()
    {
        $keyword = $this->input->get_post('keyword');
        $sType = $this->input->get_post('s_type');

        if (empty ($keyword) || empty ($sType)) {
            show_error('搜索参数不全');
        }

        $this->load->model('design/Model_Design_Comment', 'comment');
        switch ($sType) {
            case 1:
                $datas = $this->comment->getDesignCommentByCid($keyword);
                $dInfo[] = $datas;
                break;
            case 2:
                $dInfo = $this->comment->getCommentByUid($keyword, 20000);
                break;
            case 3:
                $dInfo = $this->comment->getDesignCommentByDid($keyword);
                break;
            default:
                $data = $this->comment->getDesignCommentByCid($keyword);
                $dInfo[] = $data;
        }

        $this->load->view('/administrator/design/comment/list', array('data' => $dInfo, 'searchType' => $this->commentSearchType, 'keyword' => $keyword, 'sType' => $sType));
    }

    public function deleteComment()
    {
        $commentId = $this->uri->segment(4, 0);
        if (!$commentId) {
            show_error('评论Id为空');
        }

        $this->load->model('design/Model_Design_Comment', 'comment');
        $this->comment->deleteDesignCommentByCommentId($commentId);

        redirect('/administrator/design_comment/commentList');
    }

    public function deleteReply()
    {
        $replyId = $this->uri->segment(4, 0);
        $commentId = $this->uri->segment(5, 1);

        if (!$replyId) {
            show_error('评论回复ID为空');
        }

        $this->load->model('design/Model_Design_Comment', 'comment');
        $this->comment->deleteDesignCommentReplyByReplyId($replyId);
        redirect('/administrator/design_comment/viewComment/'.$commentId);
    }
}
