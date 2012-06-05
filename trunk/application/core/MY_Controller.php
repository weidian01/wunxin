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

    protected function lib($name, $params = NULL)
    {
        static $lib;
        if (!isset($lib[$name])) {
            $lib[$name] = true;
            $this->load->library($name, $params);
        }
    }

    /**
     * 用户是否登陆
     *
     * @access    public
     * @return    void
     */
    function isLogin()
    {
        $prefix = config_item('cookie_prefix');
        $uid = $this->input->cookie($prefix.'uid');
        $password = $this->input->cookie($prefix.'password');

        if (empty ($uid) || empty ($password)) {
            return false;
        }

        $this->load->model('user/Model_User', 'user');
        $uInfo = $this->user->getUserById($uid);
        var_dump(empty ($uInfo));exit;
echo '<pre>';print_r($uInfo);exit;
        if (empty ($uInfo) || !is_array($uInfo) || $uInfo['password'] != $password) {
            return false;
        }

        return $uInfo;
    }
}
