<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午4:32
 * To change this template use File | Settings | File Templates.
 */
class product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ( !$this->AdminIsLogin() ) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    public function model_create()
    {
        $this->load->view('administrator/product/model_create', array('username' => $this->amInfo['am_uname']));
    }
}
