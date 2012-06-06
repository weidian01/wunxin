<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Main extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ( !$this->AdminIsLogin() ) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    public function index()
    {
        $this->load->view('administrator/index', array('username' => $this->amInfo['am_uname']));

    }

    public function login()
    {
        $cUserName = $this->input->get->cookie('username');

        $this->load->helper('url');

        $url = '/administrator/admin/index';
        $username = $this->input->get_post('username');
        $password = $this->input->get_post('password');

        $this->load->model('administrator/Model_Admin_User', 'adminuser');
        $status = $this->adminuser->adminUserLogin($username, $password);

        if ($status) {
            $this->input->set_cookie('username', $status['username']);
            $ip = $this->input->ip_address();
            $this->adminuser->adminUserLoginLog($status['user_id'], $ip);
            $url = '/administrator/main/';
        }

        redirect($url, 'refresh');
    }
}