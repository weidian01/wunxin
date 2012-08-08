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
    /**
     * 请求支付
     */
    public function index()
    {
        $orderSn = intval( $this->input->get_post('order_sn') );
        $bank = strtoupper( trim($this->input->get_post('bank')) );

        log_message('PAYLOG', $orderSn.'-'.$bank);

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

        $html = '';
        switch ($bank) {
            case 'ALIPAY':
                $this->load->model('pay/Model_Pay_Alipay', 'alipay');
                $html = $this->alipay->request( $orderData['order_sn'], fPrice($orderData['after_discount_price']), trim($orderProduct[0]['pname']), trim($pDesc), $orderData );
                break;
            default:
                $this->load->model('pay/Model_Pay_Yeepay', 'yeepay');
                $html = $this->yeepay->request($orderData['order_sn'], fPrice($orderData['after_discount_price']), $orderProduct[0]['pname'], $pDesc, $bank);
        }

        if (!$html || $html == '') {
            show_error('下单失败，参数不全!');
        }

        echo $html;
    }

    /**
     * 支付回调
     */
    public function payBack()
    {
        //log_message('PAYLOG', $_REQUEST);
        log_message("PAYLOG", print_r($_SERVER,true)."\n".print_r($_GET,true)."\n".print_r($_POST,true)."\n\n\n");

        $response = array('error' => '0', 'msg' => '支付成功', 'code' => 'pay_success');

        do {
            //未知的支付渠道
            $paymentChannel = $this->checkPaymentChannel();
            if (empty ($paymentChannel) || $paymentChannel == '') {
                $response = error(30019);
                break;
            }

            $this->load->model('order/Model_Order', 'order');
            $this->load->model("pay/Model_pay_{$paymentChannel}", 'channel');
            $payResult = $this->channel->response();

            //2 签名错误
            if ($payResult['status'] == 2) {
                $data = array('is_pay' => 2, 'paid' => 0, 'need_pay' => $payResult['amount'], 'status' => 1, 'defray_type' => $payResult['pay_channel']);
                $this->order->updateOrderByOrderSn($data, $payResult['order_sn']);

                $response = error(30020);
                $response['order_sn'] = $payResult['order_sn'];
                break;
            }

            //3 订单支付失败
            if ($payResult['status'] == 3) {
                $data = array('is_pay' => 2, 'paid' => 0, 'need_pay' => $payResult['amount'], 'status' => 1, 'defray_type' => $payResult['pay_channel']);
                $this->order->updateOrderByOrderSn($data, $payResult['order_sn']);

                $response = error(30021);
                $response['order_sn'] = $payResult['order_sn'];
                break;
            }

            //未知的订单
            $orderInfo = $this->order->getOrderByOrderSn($payResult['order_sn']);
            if (empty ($orderInfo)) {
                $response = error(30022);
                $response['order_sn'] = $payResult['order_sn'];
                break;
            }

            //是已支付完成
            if ($orderInfo['is_pay'] == '1') {
                $response['order_sn'] = $payResult['order_sn'];
                break;
            }

            //支付金额有误
            if ($orderInfo['after_discount_price'] != $payResult['amount']) {
                $data = array('is_pay' => 2, 'paid' => 0, 'need_pay' => $payResult['amount'], 'status' => 1, 'defray_type' => $payResult['pay_channel']);
                $this->order->updateOrderByOrderSn($data, $payResult['order_sn']);

                $response = error(30023);
                $response['order_sn'] = $payResult['order_sn'];
                break;
            }

            //更新订单信息
            $data = array('is_pay' => 1, 'paid' => $payResult['amount'], 'need_pay' => 0, 'status' => 2, 'defray_type' => $payResult['pay_channel']);
            $status = $this->order->updateOrderByOrderSn($data, $payResult['order_sn']);
            if ( !$status ) {
                $response = error(30024);
                $response['order_sn'] = $payResult['order_sn'];
                break;
            }

            //记录收款单信息
            $channel = '';
            switch ($payResult['pay_type']) {
                case 'yeepay': $channel = '1'; break;
                case 'alipay': $channel = '2'; break;
                default: $channel = '3';
            }

            $info = array(
                'order_sn' => $payResult['order_sn'],
                'uid' => $orderInfo['uid'],
                'uname' => $orderInfo['uname'],
                'amount' => $payResult['amount'],
                'pay_type' => $channel,
                'pay_account' => $payResult['pay_user_id'],
                'extended_information' => $payResult['result'].'-'.$payResult['third_part_order_sn'].'-'.$payResult['bank_order_id'],//扩展信息：结果-第三方订单-银行订单号
            );
            $this->load->model('order/Model_Order_Receiver', 'receiver');
            $rStatus = $this->receiver->addReceiver($info);
            if ( !$rStatus ) {
                $response = error(30025);
                $response['order_sn'] = $payResult['order_sn'];
                break;
            }

            //更新产品销量
            $this->updateProduct($payResult['order_sn']);

            $response['order_sn'] = $payResult['order_sn'];

        } while (false);


        if ( $payResult['request_type'] == 2 ) {
            echo 'success';
        } else {
            //获取订单信息
            $orderInfo = array();
            if ( !empty ($response['order_sn']) ) {
                $this->load->model('order/Model_Order', 'order');
                $orderInfo = $this->order->getOrderByOrderSn($response['order_sn']);
            }

            //获取销量推荐产品信息
            $recommend = array();
            if ($response['error'] == '0') {
                $this->load->model('product/Model_Product', 'product');
                $recommend = $this->product->getProductList(9, 0, '*', array('status' => 1, 'check_status' => '1', 'shelves' => 1), 'sales desc');
            }

            $this->load->view('pay/callback', array('response' => $response, 'order' => $orderInfo, 'recommend' => $recommend));
        }
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

            $merchantId = $this->input->get_post('seller_id');
            $aliPayMerchantId = config_item('alipay_merchant_id');
            if ( ($merchantId !== false) && $merchantId == $aliPayMerchantId) {
                $payChannel = 'Alipay';
            }

        } while (false);

        return $payChannel;
    }

    /**
     * 更新产品信息
     *
     * @param $orderSn
     * @return bool
     */
    private function updateProduct($orderSn)
    {
        if ( empty ($orderSn) ) {
            return false;
        }
        //更新产品销量
        $this->load->model('product/Model_Product', 'product');
        $orderProduct = $this->order->getOrderAllProductByOrderSn($orderSn);
        foreach ($orderProduct as $opv) {
            $pId = intval($opv['pid']);
            $pNum = intval($opv['product_num']);

            $this->product->updateProductSales($pId, $pNum);
        }

        return true;
    }

    public function writeLog()
    {

    }
}
