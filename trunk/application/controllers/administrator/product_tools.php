<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-12-8
 * Time: 下午2:34
 * To change this template use File | Settings | File Templates.
 */
class product_tools extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

}
