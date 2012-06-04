<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class MY_AdminController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function isLogin()
    {
        $prefix = config_item('cookie_prefix');
        $cUserName = $this->input->cookie($prefix . 'username');

        return empty ($cUserName) ? false : true;
    }

    public function getLoginUser()
    {
        $prefix = config_item('cookie_prefix');
        return $this->input->cookie($prefix . 'username');
    }
}