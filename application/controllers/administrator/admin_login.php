<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */

class Admin_login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        if ($this->isLogin()) redirect('/administrator/main/index');
    }

    public function index()
    {
        $this->load->view('administrator/login');
    }

    public function login()
    {
        $this->load->helper('url');

        $url = '/administrator/admin_login/';
        $username = $this->input->get_post('username');
        $password = $this->input->get_post('password');

        if (empty ($username) || empty ($password)) {
            show_error('用户名或密码为空!', 500);
        }

        $this->load->model('administrator/Model_admin_user', 'adminuser');
        $status = $this->adminuser->adminUserLogin($username, $password);

        if ($status) {
            $this->load->helper('cookie');
            set_cookie('admin_auth', authcode("{$status['am_uid']}\t{$status['am_uname']}\t{$status['password']}", 'ENCODE'), 0);

            $ip = $this->input->ip_address();
            $this->adminuser->adminUserLoginLog($status['am_uid'], $ip);
            $url = '/administrator/main/index';
        }
        //echo $url;exit;
        redirect($url);
    }

    public function loginOut()
    {
        $this->load->helper('cookie');
        $this->load->helper('url');

        delete_cookie('admin_auth');
        redirect('/administrator/admin_login/');
    }
}