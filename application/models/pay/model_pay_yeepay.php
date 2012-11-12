<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-2
 * Time: 上午11:19
 * To change this template use File | Settings | File Templates.
 */
class Model_Pay_Yeepay extends MY_Model
{
    /**
     * 易宝支付请求
     *
     * @param $orderSn
     * @param $amount
     * @param $PaymentChannel
     * @param $pName
     * @param $pDesc
     * @return bool|string
     */
    public function request($orderSn, $amount, $pName, $pDesc, $PaymentChannel)
    {
        if (empty ($orderSn) || empty ($amount) || empty ($pName) || empty ($PaymentChannel) || empty ($pDesc) ) {
            return false;
        }

        $actionUrl = config_item('yeepay_request_url');
        $merchantId = config_item('yeepay_merchant_id');
        $payBackUrl = config_item('pay_back_url');
        $order_sn   = $orderSn;
        $amount = $amount;
        $pName = 'product_name';urlencode(iconv("UTF-8","GBK",$pName));
        $pCat = 'clothing';//urlencode(iconv("UTF-8","GBK",'服装'));
        $pDesc = 'product_desc';urlencode(iconv("UTF-8","GBK",$pDesc));
        $mp = 'wunxin.com';//urlencode(iconv("UTF-8","GBK",'万象网-中国最专业的个性化服装电子商城'));
        $PaymentChannel = $PaymentChannel;


        //generationHMac($p2_Order, $p3_Amt, $p4_Cur, $p5_Pid, $p6_Pcat, $p7_Pdesc, $p8_Url, $pa_MP, $pd_FrpId, $pr_NeedResponse)
        $hMac = $this->generationHMac($order_sn, $amount, 'CNY', $pName, $pCat, $pDesc, $payBackUrl, $mp, $PaymentChannel, '1');

        $html = '<form method="post" action="'.$actionUrl.'" name="yeepay_form">';
        $html .= '<input type="hidden" name="p0_Cmd" value="Buy">';
        $html .= '<input type="hidden" name="p1_MerId" value="'.$merchantId.'">';
        $html .= '<input type="hidden" name="p2_Order" value="'.$order_sn.'">';
        $html .= '<input type="hidden" name="p3_Amt" value="'.$amount.'">';
        $html .= '<input type="hidden" name="p4_Cur" value="CNY">';
        $html .= '<input type="hidden" name="p5_Pid" value="'.($pName).'">';
        $html .= '<input type="hidden" name="p6_Pcat" value="'.($pCat).'">';
        $html .= '<input type="hidden" name="p7_Pdesc" value="'.($pDesc).'">';
        $html .= '<input type="hidden" name="p8_Url" value="'.$payBackUrl.'">';
        $html .= '<input type="hidden" name="p9_SAF" value="0">';
        $html .= '<input type="hidden" name="pa_MP" value="'.($mp).'">';
        $html .= '<input type="hidden" name="pd_FrpId" value="'.$PaymentChannel.'">';
        $html .= '<input type="hidden" name="pr_NeedResponse" value="1">';
        $html .= '<input type="hidden" name="hmac" value="'.$hMac.'">';
        $html .= '</form>';

        $html .= '<script type="text/javascript">document.yeepay_form.submit();</script>';

        return  $html;//iconv("UTF-8","GB2312",$html);
    }

    /**
     * 易宝回调处理
     *
     * @return array
     */
    public function response()
    {
        $p1_MerId = $this->input->get_post('p1_MerId');
        $r0_Cmd = $this->input->get_post('r0_Cmd');
        $r1_Code = $this->input->get_post('r1_Code');
        $r2_TrxId = $this->input->get_post('r2_TrxId');
        $r3_Amt = $this->input->get_post('r3_Amt');
        $r4_Cur = $this->input->get_post('r4_Cur');
        $r5_Pid = $this->input->get_post('r5_Pid');//iconv('GB2312', 'UTF-8', urldecode($this->input->get_post('r5_Pid')));
        $r6_Order = $this->input->get_post('r6_Order');
        $r7_Uid = $this->input->get_post('r7_Uid');
        $r8_MP = $this->input->get_post('r8_MP');//iconv('GB2312', 'UTF-8', urldecode($this->input->get_post('r8_MP')));
        $r9_BType = $this->input->get_post('r9_BType');
        $rb_BankId = $this->input->get_post('rb_BankId');
        $ro_BankOrderId = $this->input->get_post('ro_BankOrderId');
        $rp_PayDate = $this->input->get_post('rp_PayDate');
        $rq_CardNo = $this->input->get_post('rq_CardNo');
        $ru_Trxtime = $this->input->get_post('ru_Trxtime');
        $hMac = $this->input->get_post('hmac');

        $rData = array(
            'result' => $r1_Code,
            'third_part_order_sn' => $r2_TrxId,
            'amount' => ($r3_Amt * 100),
            'order_sn' => $r6_Order,
            'pay_user' => $r7_Uid,
            'pay_user_id' => $r7_Uid,
            'request_type' => ($r9_BType == 1) ? 1 : 2,
            'pay_channel' => $rb_BankId,
            'bank_order_id' => $ro_BankOrderId,
            'pay_type' => 'yeepay',
        );

        $rhMac = $this->getCallbackHMacString($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType);

        //状态值(status) 1 成功， 2 签名错误， 3 订单支付失败
        $rData = array('status' => 1);
        if ($hMac != $rhMac) {
            $rData['status'] = 2;
        }

        //判断支付状态
        if ($r1_Code != 1) {
            $rData['status'] = 3;
        }

        return $rData;
    }

    /**
     * 生成加密串
     *
     * @param $p2_Order 商户订单号
     * @param $p3_Amt 支付金额
     * @param $p4_Cur 交易币种
     * @param $p5_Pid 商品名称
     * @param $p6_Pcat 商品分类
     * @param $p7_Pdesc 商品描述
     * @param $p8_Url 商户接收支付成功数据的地址
     * @param $pa_MP 商户扩展信息
     * @param $pd_FrpId 支付通道编码
     * @param $pr_NeedResponse 是否需要应答机制
     * @return string
     */
    private function generationHMac($p2_Order, $p3_Amt, $p4_Cur, $p5_Pid, $p6_Pcat, $p7_Pdesc, $p8_Url, $pa_MP, $pd_FrpId, $pr_NeedResponse)
    {
        $p0_Cmd = 'Buy';
        $p9_SAF = '0';

        #进行签名处理，一定按照文档中标明的签名顺序进行
        $sbOld = "";
        #加入业务类型
        $sbOld = $sbOld.$p0_Cmd;
        #加入商户编号
        $sbOld = $sbOld.config_item('yeepay_merchant_id');
        #加入商户订单号
        $sbOld = $sbOld.$p2_Order;
        #加入支付金额
        $sbOld = $sbOld.$p3_Amt;
        #加入交易币种
        $sbOld = $sbOld.$p4_Cur;
        #加入商品名称
        $sbOld = $sbOld.$p5_Pid;
        #加入商品分类
        $sbOld = $sbOld.$p6_Pcat;
        #加入商品描述
        $sbOld = $sbOld.$p7_Pdesc;
        #加入商户接收支付成功数据的地址
        $sbOld = $sbOld.$p8_Url;
        #加入送货地址标识
        $sbOld = $sbOld.$p9_SAF;
        #加入商户扩展信息
        $sbOld = $sbOld.$pa_MP;
        #加入支付通道编码
        $sbOld = $sbOld.$pd_FrpId;
        #加入是否需要应答机制
        $sbOld = $sbOld.$pr_NeedResponse;

        //logstr($p2_Order,$sbOld,HmacMd5($sbOld, config_item('yeepay_merchant_key')));

        return $this->HMacMd5($sbOld,config_item('yeepay_merchant_key'));
    }

    /**
     * 生成KEY
     *
     * @param $data
     * @param $key
     * @return string
     */
    function HMacMd5($data,$key)
    {
        // RFC 2104 HMAC implementation for php.
        // Creates an md5 HMAC.
        // Eliminates the need to install mhash to compute a HMAC
        // Hacked by Lance Rushing(NOTE: Hacked means written)

        //需要配置环境支持iconv，否则中文参数不能正常处理
        //$key = iconv("UTF-8","GB2312",$key);
        //$data = iconv("UTF-8","GB2312",$data);
        //$key = iconv("GB2312","UTF-8",$key);
        //$data = iconv("GB2312","UTF-8",$data);

        $b = 64; // byte length for md5
        if (strlen($key) > $b) {
        $key = pack("H*",md5($key));
        }
        $key = str_pad($key, $b, chr(0x00));
        $ipad = str_pad('', $b, chr(0x36));
        $opad = str_pad('', $b, chr(0x5c));
        $k_ipad = $key ^ $ipad ;
        $k_opad = $key ^ $opad;

        return md5($k_opad . pack("H*",md5($k_ipad . $data)));
    }

    /**
     * 获取回调的密钥值
     *
     * @param $r0_Cmd
     * @param $r1_Code
     * @param $r2_TrxId
     * @param $r3_Amt
     * @param $r4_Cur
     * @param $r5_Pid
     * @param $r6_Order
     * @param $r7_Uid
     * @param $r8_MP
     * @param $r9_BType
     * @return string
     */
    public function getCallbackHMacString($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType)
    {
    	#取得加密前的字符串
    	$sbOld = "";
    	#加入商家ID
    	$sbOld = $sbOld.config_item('yeepay_merchant_id');
    	#加入消息类型
    	$sbOld = $sbOld.$r0_Cmd;
    	#加入业务返回码
    	$sbOld = $sbOld.$r1_Code;
    	#加入交易ID
    	$sbOld = $sbOld.$r2_TrxId;
    	#加入交易金额
    	$sbOld = $sbOld.$r3_Amt;
    	#加入货币单位
    	$sbOld = $sbOld.$r4_Cur;
    	#加入产品Id
    	$sbOld = $sbOld.$r5_Pid;
    	#加入订单ID
    	$sbOld = $sbOld.$r6_Order;
    	#加入用户ID
    	$sbOld = $sbOld.$r7_Uid;
    	#加入商家扩展信息
    	$sbOld = $sbOld.$r8_MP;
    	#加入交易结果返回类型
    	$sbOld = $sbOld.$r9_BType;

    	//logstr($r6_Order,$sbOld,HmacMd5($sbOld,config_item('yeepay_merchant_key')));
    	return $this->HmacMd5($sbOld, config_item('yeepay_merchant_key'));

    }
}
