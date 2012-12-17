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
        if($this->router->method !== 'logout')
        {
            if ($this->AdminIsLogin())
            {
                $this->load->helper('url');
                redirect('/administrator/main/index');
            }
        }
    }

    public function index()
    {
        $this->load->view('administrator/bootstrap/login');
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

        $verify_code = $this->input->get_post('verify_code');
        $server_code = $this->getVerifyCode();$this->usetVerifyCode();
        if ('' === $verify_code || md5(strtolower($verify_code)) !== $server_code) {
            show_error('验证码错误!', 500);
        }

        $this->load->model('administrator/Model_admin_user', 'adminuser');
        $status = $this->adminuser->adminUserLogin($username, $password);

        if ($status) {
            $this->load->helper('cookie');
            set_cookie('admin_auth', authcode("{$status['am_uid']}\t{$status['am_uname']}\t{$status['password']}", 'ENCODE'), 36000);

            $ip = $this->input->ip_address();
            $this->adminuser->adminUserLoginLog($status['am_uid'], $ip);
            $url = '/administrator/main/index';
        }
        //echo $url;exit;
        redirect($url);
    }

    public function logout()
    {
        $this->load->helper('cookie');
        $this->load->helper('url');

        delete_cookie('admin_auth');
        redirect('/administrator/admin_login/');
    }

    /**
     * 显示验证码图片
     */
    public function verifyCode()
    {
        $code = $this->setVerifyCode();
        //$this->input->set_cookie('verify_code', $code, 60);
        $this->lib('captcha', array('code'=>$code));
        $this->captcha->display();
    }

    /**
     * 获取验证码
     * @return mixed
     */
    private function getVerifyCode()
    {
        $this->lib('session');
        return $this->session->userdata('verifyCode');
    }

    /**
     * 销毁验证码
     * @return mixed
     */
    private function usetVerifyCode()
    {
        $this->lib('session');
        $this->session->unset_userdata('verifyCode');
        return;
    }

    /**
     * 生成验证码
     * @param int $lenght
     * @return mixed
     */
    private function setVerifyCode($lenght = 4)
    {

        $this->load->helper('string');
        $rand_str =  str_replace(array('0','O','1','l'), array('o','o','L','L'), random_string('alnum', $lenght));
        $newdata = array('verifyCode'  => md5(strtolower($rand_str)));
        $this->lib('session');
        $this->session->set_userdata($newdata);
        return $rand_str;
    }
}