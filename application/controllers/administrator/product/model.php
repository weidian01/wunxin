<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class model extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        if ( !$this->isLogin() ) redirect('/administrator/admin_login/index');
    }

    public function modelAdd()
    {

    }

}