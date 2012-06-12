<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-11
 * Time: 下午2:18
 * To change this template use File | Settings | File Templates.
 */
class order extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    /**
     * 订单列表
     */
    public function orderList()
    {
        $this->load->model('order/Model_Order', 'order');
        $data = $this->order->getOrderList();
        //echo '<pre>';print_r($data);exit;
        $this->load->view('/administrator/order/order_list', array('data' => $data));
    }

    /**
     * 订单详情
     */
    public function orderDetail()
    {
        $orderSn = $this->input->get_post('order_sn');

        $this->load->model('order/Model_Order', 'order');
        $oInfo = $this->order->getOrderAllInfoByOrderSn($orderSn);

        $this->load->view('/administrator/order/order_detail', array('data' => $oInfo));
    }

    /**
     * 订单编辑
     */
    public function orderEdit()
    {
        $orderSn = $this->input->get_post('order_sn');

        $this->load->model('order/Model_Order', 'order');
        $oInfo = $this->order->getOrderAllInfoByOrderSn($orderSn);

        $this->load->view('/administrator/order/order_edit', array('data' => $oInfo));
    }
}
