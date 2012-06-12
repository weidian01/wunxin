<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-11
 * Time: 上午9:09
 * To change this template use File | Settings | File Templates.
 */
class am_activity extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        if (!$this->AdminIsLogin()) redirect('/administrator/admin_login/index');
    }

    /**
     * 添加活动
     */
    public function addActivity()
    {
        echo 'a';
        $this->load->view('administrator/activity/add_activity');
    }

    /**
     * 保存活动
     */
    public function saveActivity()
    {
        $this->input->get_post('subject');
        $this->input->get_post('start_time');
        $this->input->get_post('end_time');
        $this->input->get_post('description');
        $this->input->get_post('specification');


    }
}
