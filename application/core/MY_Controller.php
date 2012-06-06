<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-4
 * Time: 下午3:49
 * To change this template use File | Settings | File Templates.
 */
class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 减少重复载入相同库步骤;
     * @param $name
     * @param null $params
     */
    protected function lib($name, $params = NULL)
    {
        static $lib;
        if (!isset($lib[$name])) {
            $lib[$name] = true;
            $this->load->library($name, $params);
        }
    }

    /**
     * 从cookie中获取用户登录信息
     * @return array | NULL
     */
    protected function getUserinfoForCookie()
    {
        $this->load->helper('cookie');
        $auth =  get_cookie('auth');
        if($auth)
            return explode("\t", authcode($auth, 'DECODE'));
    }

    /**
     * 用户是否登陆
     *
     * @access    public
     * @return    void
     */
    protected function isLogin()
    {
        $userinfo = $this->getUserinfoForCookie();
        if(! $userinfo)
            return false;

        $uid = $userinfo[0];
        $password = $userinfo[2];

        if (empty ($uid) || empty ($password)) {
            return false;
        }

        $this->load->model('user/Model_User', 'user');
        $uInfo = $this->user->getUserById($uid);

        if (! $uInfo || $uInfo['password'] != $password) {
            return false;
        }

        return $uInfo;
    }


    protected function AdminIsLogin()
    {
        //$prefix = config_item('cookie_prefix');
        //$cUserName = $this->input->cookie($prefix . 'username');
        $this->load->helper('cookie');
        $auth =  get_cookie('admin_auth');
        if($auth)
        {
            $am = explode("\t", authcode($auth, 'DECODE'));
            $this->load->model('adminstrator/Model_Admin_User', 'admin');
            $uinfo = $this->admin->getUserInfoByAmUid($am[0]);
            if (isset($uinfo) && $uinfo['password'] === $am[2]) {
                return $uinfo;
            }
        }
        return false;
    }

    static protected function json_output($data)
    {
        die(json_encode($data));
    }


}
