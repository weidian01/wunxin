<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */

class Admin_login extends AM_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->helper('url');
        if ( $this->isLogin() ) redirect('/administrator/main/index');

        $this->load->view('administrator/login');
    }

    public function login()
    {
        $this->load->helper('url');

        $url = '/administrator/admin_login/';
        $username = $this->input->get_post('username');
        $password = $this->input->get_post('password');

        $this->load->model('administrator/admin_user', 'adminuser');
        $status = $this->adminuser->adminUserLogin($username, $password);

        if ($status) {
            $this->input->set_cookie('username', $status['username'], 3600);
            $ip = $this->input->ip_address();
            $this->adminuser->adminUserLoginLog($status['user_id'], $ip);
            $url = '/administrator/main/index';
        }
        redirect($url);
    }

    public function loginOut()
    {
        $this->load->helper('cookie');
        $this->load->helper('url');

        delete_user_cookie();
        redirect('/administrator/admin_login/');
    }
}