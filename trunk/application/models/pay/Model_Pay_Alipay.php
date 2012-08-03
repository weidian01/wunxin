<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-2
 * Time: 上午11:19
 * To change this template use File | Settings | File Templates.
 */
class Model_Pay_Alipay extends MY_Model
{
    /**
     * 支付宝支付请求
     *
     * @param $orderSn
     * @param $pName
     * @param $pDesc
     * @param $amount
     * @param array $orderInfo
     * @return bool|string
     */
    public function request($orderSn, $pName, $pDesc, $amount, array $orderInfo)
    {
        if (empty ($orderSn) || empty ($amount) || empty ($pName)  || empty ($pDesc) ) {
            return false;
        }

        $parameter = array(
            "service"		=> "trade_create_by_buyer",
            "payment_type"	=> "1",
            "partner"		=> config_item('alipay_merchant_id'),
            "_input_charset"=> 'utf-8',
            "seller_email"	=> config_item('alipay_account'),
            "return_url"	=> config_item('pay_back_url'),
            "notify_url"	=> config_item('pay_back_url'),
            "out_trade_no"	=> $orderSn,
            "subject"		=> $pName,
            "body"			=> $pDesc,
            "price"			=> $amount,
            "quantity"		=> 1,
            "logistics_fee"		=> '0.00',
            "logistics_type"	=> 'EXPRESS',
            "logistics_payment"	=> 'SELLER_PAY',
            "receive_name"		=> $orderInfo['recent_name'],
            "receive_address"	=> $orderInfo['recent_address'],
            "receive_zip"		=> $orderInfo['zipcode'],
            "receive_phone"		=> $orderInfo['phone_num'],
            "receive_mobile"	=> $orderInfo['call_num'],
            "show_url"		=> ''
        );

        $actionUrl = config_item('alipay_request_url');

        $html = $this->buildForm($parameter, $actionUrl);

        return $html;
    }

    /**
     * 处理支付宝回调
     *
     * @return array
     */
    public function response()
    {
        $sign = $this->get_post('sign');//加密串
        $out_trade_no = $this->get_post('out_trade_no');//商户订单号
        $trade_no = $this->get_post('trade_no');//支付宝订单号
        $price = $this->get_post('price');//金额

        $mySign = $this->buildMySign($_GET, config_item('alipay_merchant_key'));

        $out_trade_no	= $_GET['out_trade_no'];	//获取订单号
            $trade_no		= $_GET['trade_no'];		//获取支付宝交易号
            $total_fee		= $_GET['price'];
        //状态值(status) 1 成功， 2 签名错误， 3 订单支付失败
        $rData = array('status' => 1);
        if ($sign != $mySign) {
            $rData['status'] = 2;
        }


        $rData = array(
            'result' => '',
            'third_part_order_sn' => $trade_no,
            'amount' => $price,
            'order_sn' => $out_trade_no,
            'pay_user_id' => '',
            'request_type' => '',
            'pay_channel' => '',
            'bank_order_id' => '',
            'pay_type' => 'alipay',
        );

        return $rData;
    }

    /**
     * 生成加密串
     *
     * @param $sort_para
     * @param $key
     * @param string $sign_type
     * @return string
     */
    private function buildMySign($sort_para, $key, $sign_type = "MD5")
    {
    	//把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
    	$preStr = $this->createLinkstring($sort_para);

    	//把拼接后的字符串再与安全校验码直接连接起来
        $preStr = $preStr.$key;

    	//把最终的字符串签名，获得签名结果
    	$mySign = $this->sign($preStr, $sign_type);
    	return $mySign;
    }

    /**
     * 生成链接串
     *
     * @param $para
     * @return string
     */
    private function createLinkString($para)
    {
    	$arg  = "";
    	while (list ($key, $val) = each ($para)) {
    		$arg.=$key."=".$val."&";
    	}
    	//去掉最后一个&字符
    	$arg = substr($arg,0,count($arg)-2);

    	//如果存在转义字符，那么去掉转义
    	if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

    	return $arg;
    }

    /**
     * 加密串 -- md5
     *
     * @param $preStr
     * @param string $sign_type
     * @return string
     */
    private function sign($preStr,$sign_type='MD5')
    {
    	$sign='';
    	if($sign_type == 'MD5') {
    		$sign = md5($preStr);
    	}elseif($sign_type =='DSA') {
    		//DSA 签名方法待后续开发
    		die("DSA 签名方法待后续开发，请先使用MD5签名方式");
    	}else {
    		die("支付宝暂不支持".$sign_type."类型的签名方式");
    	}
    	return $sign;
    }

    /**
     * 生成FORM表单
     *
     * @param $para_temp
     * @param $gateway
     * @return string
     */
    private function buildForm($para_temp, $gateway)
    {
        //待请求参数数组
        //$para = $this->buildRequestPara($para_temp,$aliapy_config);
        $para = $this->paraFilter($para_temp);

        ksort($para);
       	reset($para);

        //签名结果与签名方式加入请求提交参数组中
        $mySign = $this->buildMySign( $para, config_item('alipay_merchant_key') );
        $para['sign'] = $mySign;
        $para['sign_type'] = 'MD5';

        $sHtml = "<form id='aliPay_submit' name='aliPay_submit' action='".$gateway."_input_charset=utf-8' method='POST'>";
        foreach ($para as $key => $val) {
            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }

        //submit按钮控件请不要含有name属性
        $sHtml = $sHtml."<input type='submit' value='提交'></form>";

        $sHtml = $sHtml."<script>document.forms['aliPay_submit'].submit();</script>";

        return $sHtml;
    }

    //去掉加密类型、加密串和为空的字段
    private function paraFilter($para)
    {
        $para_filter = array();
        foreach ($para as $key => $val) {
            if($key == "sign" || $key == "sign_type" || $val == "")continue;
            else	$para_filter[$key] = $para[$key];
        }

        return $para_filter;
    }
}
