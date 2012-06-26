<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-26
 * Time: 下午2:09
 * To change this template use File | Settings | File Templates.
 */
class activity extends MY_Controller
{
    public $eventInitiator = array(
        '1' => array('id' => '1', 'name' => '系统'),
        '2' => array('id' => '2', 'name' => '用户'),
        '3' => array('id' => '3', 'name' => '企业'),
        '4' => array('id' => '4', 'name' => '其他'),
    );
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    /**
     * 活动列表
     */
    public function activityList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('activity/Model_Activity', 'activity');
        $totalNum = $this->activity->getActivityCount();
        $data = $this->activity->getActivityList($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/activity/activityList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
        $info = array('data' => $data, 'page_html' => $pageHtml, 'current_page' => $currentPage, 'event_initiator' => $this->eventInitiator);
        //echo '<pre>';print_r($cdata);exit;
        $this->load->view('/administrator/activity/list', $info);
    }

    /**
     * 添加活动
     */
    public function activityAdd()
    {
        $this->load->view('/administrator/activity/create', array('type' => 'add', 'event_initiator' => $this->eventInitiator));
    }

    /**
     * 活动保存
     */
    public function activitySave()
    {
        $data['subject'] = $this->input->get_post('subject');
        $data['start_time'] = $this->input->get_post('start_time');
        $data['end_time'] = $this->input->get_post('end_time');
        $data['event_initiator'] = $this->input->get_post('event_initiator');
        $data['status'] = intval($this->input->get_post('status'));
        $data['initiator_name'] = $this->input->get_post('initiator_name');
        $data['initiator_desc'] = $this->input->get_post('initiator_desc');
        $data['specification'] = $this->input->get_post('specification');
        $data['descr'] = $this->input->get_post('descr');

        if (empty ($data['subject']) || empty ($data['start_time']) || empty ($data['end_time']) || empty ($data['event_initiator']) || empty ($data['initiator_name']) || empty ($data['initiator_desc']) || empty ($data['specification']) || empty ($data['descr'])) {
            show_error('参数不全');
        }

        $this->load->model('activity/Model_Activity', 'activity');
        $lastId = $this->activity->addActivity($data);
        if (!$lastId) {
            show_error('添加活动失败');
        }

        redirect('/administrator/activity/activityList');
    }

    /**
     * 活动修改
     */
    public function activityEdit()
    {
        $aId = $this->uri->segment(4, 1);
        if (!$aId) {
            show_error('活动ID为空');
        }

        $this->load->model('activity/Model_Activity', 'activity');
        $data = $this->activity->getActivityById($aId);
        //echo '<pre>';print_r($data);exit;
        $this->load->view('/administrator/activity/create', array('type' => 'edit', 'event_initiator' => $this->eventInitiator, 'info' => $data));
    }

    /**
     * 活动修改保存
     */
    public function activityEditSave()
    {
        $data['subject'] = $this->input->get_post('subject');
        $data['start_time'] = $this->input->get_post('start_time');
        $data['end_time'] = $this->input->get_post('end_time');
        $data['event_initiator'] = $this->input->get_post('event_initiator');
        $data['status'] = $this->input->get_post('status');
        $data['initiator_name'] = $this->input->get_post('initiator_name');
        $data['initiator_desc'] = $this->input->get_post('initiator_desc');
        $data['specification'] = $this->input->get_post('specification');
        $data['descr'] = $this->input->get_post('descr');
        $data['activity_id'] = $this->input->get_post('activity_id');
        //echo '<pre>';print_r($data);exit;
        //var_dump(empty ($data['descr']));exit;
        if (empty($data['activity_id']) || empty ($data['subject']) || empty ($data['start_time']) || empty ($data['end_time']) || empty ($data['event_initiator']) || empty ($data['initiator_name']) || empty ($data['initiator_desc']) || empty ($data['specification']) || empty ($data['descr'])) {
            show_error('参数不全');
        }

        $this->load->model('activity/Model_Activity', 'activity');
        $lastId = $this->activity->editActivity($data, $data['activity_id']);
        var_dump($lastId);
        if (!$lastId) {
            show_error('修改活动失败');
        }

        redirect('/administrator/activity/activityList');
    }

    public function activityView()
    {
        $activityId = $this->uri->segment(4, 0);
        if (!$activityId) {
            show_error('活动ID为空');
        }

        $this->load->model('activity/Model_Activity', 'activity');
        $activityData = $this->activity->getActivityById($activityId);
        //echo '<pre>';print_r($activityData);exit;

        //评论分页 开始
        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('activity/Model_Activity_Comment', 'comment');
        $totalNum = $this->comment->getActivityCommentCount($activityId);
        $commentData = $this->comment->getActivityCommentList($activityId, $Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/activity/activityView/'.$activityId;
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
        //评论分页 结束

        $this->load->model('activity/Model_Activity_Prize', 'prize');
        $prizeData = $this->prize->getActivityPrizeList($activityId, 1000);


        $data = array(
            'a_data' => $activityData,
            'event_initiator' => $this->eventInitiator,
            'comment_page_html' => $pageHtml,
            'comment_data' => $commentData,
            'prize_data' => $prizeData,
        );
        $this->load->view('/administrator/activity/detail', $data);
    }

    public function activityCommentDelete()
    {
        $commentId = $this->uri->segment(4, 1);
        $activityId = $this->uri->segment(5, 0);

        if (!$commentId) {
            show_error('评论ID为空');
        }

        if (!$activityId) {
            show_error('活动ID为空');
        }

        $this->load->model('activity/Model_Activity_Comment', 'comment');
        $status = $this->comment->deleteComment($commentId);
        if (!$status) {
            show_error('删除活动评论失败');
        }

        redirect('/administrator/activity/activityView/'.$activityId);
    }

    /**
     * 结束活动
     */
    public function activityDelete()
    {
        $id = $this->uri->segment(4, 1);
        $currentPage = $this->uri->segment(5, 1);
        if (!$id) {
            show_error('活动ID为空');
        }

        $this->load->model('activity/Model_Activity', 'activity');
        $status = $this->activity->deleteActivity($id);
        if (!$status) {
            show_error('删除活动失败');
        }

        redirect('/administrator/activity/activityList/'.$currentPage);
    }
}
