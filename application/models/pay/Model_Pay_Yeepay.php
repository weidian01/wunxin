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
    public function request($orderSn, $amount, $PaymentChannel, $pName, $pDesc)
    {
        if (empty ($orderSn) || empty ($amount) || empty ($pName) || empty ($PaymentChannel) || empty ($pDesc) ) {
            return false;
        }

        $actionUrl = config_item('yeepay_request_url');
        $merchantId = config_item('yeepay_merchant_id');
        $payBackUrl = config_item('pay_back_url');
        $order_sn   = $orderSn;
        $amount = $amount;
        $pName = urlencode(iconv("UTF-8","GBK",$pName));
        $pCat = urlencode(iconv("UTF-8","GBK",'服装'));
        $pDesc = urlencode(iconv("UTF-8","GBK",$pDesc));
        $mp = urlencode(iconv("UTF-8","GBK",'万象网-中国最专业的个性化服装电子商城'));
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

    public function response()
    {
        $p1_MerId = $this->input->get_post('p1_MerId');
        $r0_Cmd = $this->input->get_post('r0_Cmd');
        $r1_Code = $this->input->get_post('r1_Code');
        $r2_TrxId = $this->input->get_post('r2_TrxId');
        $r3_Amt = $this->input->get_post('r3_Amt');
        $r4_Cur = $this->input->get_post('r4_Cur');
        $r5_Pid = $this->input->get_post('r5_Pid');
        $r6_Order = $this->input->get_post('r6_Order');
        $r7_Uid = $this->input->get_post('r7_Uid');
        $r8_MP = $this->input->get_post('r8_MP');
        $r9_BType = $this->input->get_post('r9_BType');
        $rb_BankId = $this->input->get_post('rb_BankId');
        $ro_BankOrderId = $this->input->get_post('ro_BankOrderId');
        $rp_PayDate = $this->input->get_post('rp_PayDate');
        $rq_CardNo = $this->input->get_post('rq_CardNo');
        $ru_Trxtime = $this->input->get_post('ru_Trxtime');
        $hmac = $this->input->get_post('hmac');


        $rData = array(
            'amount' => $r3_Amt,
            'order_sn' => $r6_Order,
            'result' => $r1_Code,
            'third_part_order_sn' => $r2_TrxId,
            'pay_user_id' => $r7_Uid,
            'request_type' => $r9_BType,
            'pay_channel' => $rb_BankId,
            'bank_order_id' => $ro_BankOrderId,
        );
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
}
