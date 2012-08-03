<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-2
 * Time: 上午11:18
 * To change this template use File | Settings | File Templates.
 */
class pay extends MY_Controller
{
    public function index()
    {
        $orderSn = intval( $this->input->get_post('order_sn') );
        $bank = strtoupper( trim($this->input->get_post('bank')) );

        if ( empty ($orderSn) ) {
            show_error('订单ID为空!');
        }

        if ( empty ($bank) ) {
            show_error('没有选择支付银行或支付!');
        }

        $bankList = config_item('pay_channel');//echo '<pre>';print_r($bankList);exit;
        if (!in_array($bank, $bankList)) {
            show_error('未知的支付渠道！');
        }

        $this->load->model('order/Model_Order', 'order');
        $orderData = $this->order->getOrderByOrderSn($orderSn);
        if (empty ($orderSn)) {
            show_error('订单不存在!');
        }

        $orderProduct = $this->order->getOrderAllProductByOrderSn($orderSn);
        if ( empty ($orderProduct) ) {
            show_error('订单中没有任何产品!');
        }

        $pDesc = '';
        foreach ($orderProduct as $v) {
            $pDesc .= $v['pname'].' | ';
        }
        $pDesc = substr($pDesc, 0, -2);
        //echo '<pre>';print_r($pDesc);exit;
        if ($bank == 'alipay') {

        } else {
            $this->load->model('pay/Model_Pay_Yeepay', 'yeepay');
            $html = $this->yeepay->request($orderData['order_sn'], ($orderData['after_discount_price'] / 100), $bank, $orderProduct[0]['pname'], $pDesc);//($orderSn, $amount, $PaymentChannel, $pName, $pDesc)
        }

        if (!$html) {
            show_error('下单失败，参数不全!');
        }


        echo $html;
    }

    public function payBack()
    {
        $paymentChannel = $this->checkPaymentChannel();

        if (empty ($paymentChannel) || $paymentChannel == '') {
            show_error('未知的支付渠道');
        }

        $this->load->model("pay/Model_pay_{$paymentChannel}", 'channel');
        $this->channel->response();

    }

    /**
     * 检查支付渠道
     *
     * @return string
     */
    private function checkPaymentChannel()
    {
        $payChannel = '';

        do {
            $merchantId = $this->input->get_post('p1_MerId');
            $yeePayMerchantId = config_item('yeepay_merchant_id');

            if ( ($merchantId !== false) && ($merchantId == $yeePayMerchantId) )
            {
                $payChannel = 'Yeepay';
            }

            $merchantId = $this->input->get_post('partner');
            $aliPayMerchantId = config_item('alipay_merchant_id');
            if ( ($merchantId !== false) && $merchantId == $aliPayMerchantId) {
                $payChannel = 'Alipay';
            }

        } while (false);

        return $payChannel;
    }

    public function writeLog()
    {

    }
}
