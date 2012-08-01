<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-1
 * Time: 下午5:18
 * To change this template use File | Settings | File Templates.
 */
class yeepay extends MY_Controller
{
    public function pay()
    {
        $orderSn = $this->input->get_post('order_sn');

        if (empty ($orderSn)) {
            show_error('订单ID为空');
        }

        $this->load->model('order/Model_Order', 'order');
        $orderData = $this->order->getOrderByOrderSn($orderSn);

        if (empty ($orderSn)) {
            show_error('订单不存在');
        }


    }

    public function payBack()
    {

    }
}
