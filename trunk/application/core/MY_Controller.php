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
        $uid = $this->input->cookie('uid');
        $password = $this->input->cookie('password');


        $this->load->model('');
        return empty ($uid) ? false : true;
    }
}
