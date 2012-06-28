<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-28
 * Time: 下午2:07
 * To change this template use File | Settings | File Templates.
 */
class business_mail_subscribe extends MY_Controller
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
     * 邮件订阅列表
     */
    public function mailSubscribeList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('business/Model_Mail_Subscription', 'ms');
        $totalNum = $this->ms->getSubscribeCount();
        $data = $this->ms->getSubscribeList($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/business_mail_subscribe/mailSubscribeList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
        $info = array('data' => $data, 'page_html' => $pageHtml, 'current_page' => $currentPage);

        //echo '<pre>';print_r($cdata);exit;
        $this->load->view('/administrator/business/mail_subscribe/list', $info);
    }

    /**
     * 添加邮件订阅
     */
    public function mailSubscribeAdd()
    {
        $this->load->view('/administrator/business/mail_subscribe/create', array('type' => 'add'));
    }

    /**
     * 保存邮件订阅
     */
    public function mailSubscribeSave()
    {
        $data['uid'] = intval($this->input->get_post('uid'));
        $data['email_addr'] = $this->input->get_post('email_addr');
        $data['get_info_type'] = intval($this->input->get_post('get_info_type'));

        if (empty ($data['email_addr']) || empty ($data['get_info_type'])) {
            show_error('参数不全');
        }

        if (!filter_var($data['email_addr'], FILTER_VALIDATE_EMAIL)) {
            show_error('邮件地址错误');
        }

        $this->load->model('business/Model_Mail_Subscription', 'ms');
        $status = $this->ms->subscribe($data);
        if (!$status) {
            show_error('添加邮件订阅失败');
        }

        redirect('/administrator/business_mail_subscribe/mailSubscribeList');
    }

    /**
     * 修改邮件订阅
     */
    public function mailSubscribeEdit()
    {
        $msId = $this->uri->segment(4, 0);
        if (!$msId) {
            show_error('邮件订阅ID为空');
        }

        $this->load->model('business/Model_Mail_Subscription', 'ms');
        $data = $this->ms->getSubscribeBymId($msId);

        $this->load->view('/administrator/business/mail_subscribe/create', array('type' => 'edit', 'info' => $data));
    }

    /**
     * 保存修改邮件订阅
     */
    public function mailSubscribeEditSave()
    {
        $data['uid'] = intval($this->input->get_post('uid'));
        $data['email_addr'] = $this->input->get_post('email_addr');
        $data['get_info_type'] = intval($this->input->get_post('get_info_type'));
        $msId = intval($this->input->get_post('id'));

        if (empty ($msId) || empty ($data['email_addr']) || empty ($data['get_info_type'])) {
            show_error('参数不全');
        }

        if (!filter_var($data['email_addr'], FILTER_VALIDATE_EMAIL)) {
            show_error('邮件地址错误');
        }

        $this->load->model('business/Model_Mail_Subscription', 'ms');
        $status = $this->ms->editSubscribe($data, $msId);
        if (!$status) {
            show_error('修改邮件订阅失败');
        }

        redirect('/administrator/business_mail_subscribe/mailSubscribeList');
    }

    /**
     * 删除邮件订阅
     */
    public function mailSubscribeDelete()
    {
        $msId = $this->uri->segment(4, 0);
        $currentPage = $this->uri->segment(5, 1);

        if (!$msId) {
            show_error('邮件订阅ID为空');
        }

        $this->load->model('business/Model_Mail_Subscription', 'ms');
        $status = $this->ms->deleteSubscribe($msId);
        if (!$status) {
            show_error('删除邮件订阅失败');
        }

        redirect('/administrator/business_mail_subscribe/mailSubscribeList/'.$currentPage);
    }
}
