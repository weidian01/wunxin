<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-7-6
 * Time: 下午4:19
 * To change this template use File | Settings | File Templates.
 */
class order extends MY_Controller
{
    public function index()
    {
        $this->load->view('order/order_confirm');
    }
}
