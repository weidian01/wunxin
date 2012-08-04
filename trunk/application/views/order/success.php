<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>订单提交成功</title>
<link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css" />
<link href="<?=config_item('static_url')?>css/shopping.css" rel="stylesheet" type="text/css" />
<!--<SCRIPT type=text/javascript src="/scripts/comm.js"></SCRIPT>-->
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/jquery-1.4.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/artdialog.js"></SCRIPT>
    <SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/product.js"></SCRIPT>
<!--[if lt IE 7]>
<script type="text/javascript" src="<?=config_item('static_url')?>js/iepng.js"></script>
<script type="text/javascript">
EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
</script>
<![endif]-->
<script type="text/javascript">
$(document).ready(function(){
  $(".bankpic").click(function(){
    $(".bankpic").css("border","1px solid #eee");
	$(this).css("border","1px solid #a10000");
  });
});

</script>

</head>
<body>
<?php include '/../header.php';?>
<div class="box pad8">
  <div class="process">
    <ul>
      <li>我的购物车</li>
      <li style="background:none;">填写订单核对信息</li>
      <li class="current">成功提交订单</li>
    </ul>
  </div>
  <div class="other-shopping">
    <div class="tit">订单状态</div>
    <div class="order-c">
      <p>恭喜您，订单提交成功了！</p>
      <span class="font9">您的订单号：<?php echo $order['order_sn'];?>
          应付金额：<span class="font6"><?php echo fPrice($order['after_discount_price']);?></span> 元，
          支付方式：<?php
          switch ($order['pay_type']) {
              case '1': $ps = '线上支付'; break;
              case '2': $ps = '货到付款'; break;
              case '3': $ps = '邮局汇款'; break;
              case '4': $ps = '来万象自提'; break;
              case '5': $ps = '公司转账'; break;
              default :$ps = '线上支付';
          }echo $ps;
          ?>，　<?php
          switch ($order['delivert_time']) {
              case '1': $s = '工作日、双休日和节假日均送货'; break;
              case '2': $s = ' 只双休日、节假日送货（工作时间不送货）'; break;
              case '3': $s = '只工作日送货（双休日、节假日不送）'; break;
              case '4': $s = '学校地址，白天没人'; break;
          }echo $s;
          ?><br/>
          <?php echo $order['recent_name'].',';

            if ($order['pay_type'] == '1') {
                echo '如果<span class="font6"> 24 </span>小时内您无法完成付款，系统会将您的订单取消。';
            } elseif ($order['pay_type'] == '3') {
                echo '如果<span class="font6"> 72 </span>小时内您无法完成付款，系统会将您的订单取消。';
            }
          ?></div>
  </div>
  <?php if ($order['pay_type'] == '1') {?>
  <form action="" method="POST" onsubmit="return order.pay()" name="pay_form" id="" target="_blank">
      <input type="hidden" name="order_sn" value="<?php echo $order['order_sn'];?>" />
  <div class="other-shopping">
    <div class="tit">选择支付方式</div>
    <div class="payment">
      <p>点击选择银行付款</p>
      <div class="payment-c">
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="onlinepay-b" value="ICBC-NET-B2C" name="bank" checked="checked"/>
          </div>
          <div class="bankpic" style="border: 1px solid rgb(161, 0, 0);"><label for="onlinepay-b"><span class="bankimg" id="onlinepay">中国工商银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" value="CMBCHINA-NET-B2C" id="icbc-b" name="bank"/>
          </div>
          <div class="bankpic"><label for="icbc-b"><span class="bankimg" id="icbc">招商银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="cmb-b" value="BOC-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="cmb-b"><span class="bankimg" id="cmb">中国银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" value="HKBEA-NET-B2C" id="boc-b" name="bank" />
          </div>
          <div class="bankpic"><label for="boc-b"><span class="bankimg" id="boc">东亚银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="ccb-b" value="CCB-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="ccb-b"><span class="bankimg" id="ccb">中国建设银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="abc-b" value="ABC-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="abc-b"><span class="bankimg" id="abc">中国农业银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="cgb-b" value="GDB-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="cgb-b"><span class="bankimg" id="cgb">广发银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="cmbc-b" value="CMBC-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="cmbc-b"><span class="bankimg" id="cmbc">中国民生银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="cib-b" value="CIB-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="cib-b"><span class="bankimg" id="cib">兴业银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="bob-b" value="BCCB-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="bob-b"><span class="bankimg" id="bob">北京银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="bjrcb-b" value="BJRCB-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="bjrcb-b"><span class="bankimg" id="bjrcb">北京农村商业银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="psbc-b" value="POST-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="psbc-b"><span class="bankimg" id="psbc">中国邮政储蓄银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="bcomm-b" value="BOCO-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="bcomm-b"><span class="bankimg" id="bcomm">交通银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="spdb-b" value="SPDB-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="spdb-b"><span class="bankimg" id="spdb">浦发银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="sdb-b" value="SDB-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="sdb-b"><span class="bankimg" id="sdb">深圳发展银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="cebb-b" value="CEB-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="cebb-b"><span class="bankimg" id="cebb">中国光大银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="pingan-b" value="PINGANBANK-NET" name="bank" />
          </div>
          <div class="bankpic"><label for="pingan-b"><span class="bankimg" id="pingan">平安银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="ecitic-b" value="ECITIC-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="ecitic-b"><span class="bankimg" id="ecitic">中信银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="hzb-b" value="HZBANK-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="hzb-b"><span class="bankimg" id="hzb">杭州银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="nb-b" value="NBCB-NET-B2C" name="bank" />
          </div>
          <div class="bankpic"><label for="nb-b"><span class="bankimg" id="nbcb">宁波银行</span></label></div>
        </div>
      </div>
      <p>点击选择支付平台付款</p>
      <div class="payment-c">
        <div class="payment-b">
          <div class="pradio">
            <input name="bank" id="alipay-b" type="radio" value="alipay"/>
          </div>
          <div class="bankpic"><label for="alipay-b"><span class="bankimg" id="alipay">支付宝</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input name="bank" id="cmpay-b" type="radio" value="1000000-NET" />
          </div>
          <div class="bankpic"><label for="cmpay-b"><span class="bankimg" id="cmpay">易宝支付</span></label></div>
        </div>

        <!--
        <div class="payment-b">
          <div class="pradio">
            <input name="bank" id="tenpay-b" type="radio" value="" />
          </div>
          <div class="bankpic"><label for="tenpay-b"><span class="bankimg" id="tenpay">财付通</span></label></div>
        </div>
        -->

      </div>
      <div class="topay"><a href="javascript:vaid(0);" onclick="order.pay('pay_now_id')" id="pay_now_id"><img src="/images/pay.gif" width="150" height="41" alt="立即付款"/></a></div>
    </div>
  </div>
  </form>
      <?php }?>
  <!--
  <div class="other-shopping" style="height:320px;">
    <div class="tit">购买以上商品的顾客还购买过</div>
    <div class="other-c">
      <div class="other-pre"><a href="#">pre</a></div>
      <div class="other-next"><a href="#">next</a></div>
      <div class="other-cg">
        <div style=" height:230px; width:1800px;">
          <div class="rq">
            <div class="rqimg"><img src="/images/df_03.jpg" width="120" height="120" /></div>
            <p>Bessie OL气质荷叶边条纹短裙<br/>
              原价：￥<span class="font7">236.00</span><br/>
              <span class="font6">特惠价：￥198.00</span></p>
            <img src="/images/add-cart.gif" width="81" height="21" alt="放入购物车" /></div>
          <div class="rq">
            <div class="rqimg"><img src="/images/df_03.jpg" width="120" height="120" /></div>
            <p>Bessie OL气质荷叶边条纹短裙<br/>
              原价：￥<span class="font7">236.00</span><br/>
              <span class="font6">特惠价：￥198.00</span></p>
            <img src="/images/add-cart.gif" width="81" height="21" alt="放入购物车" /></div>
          <div class="rq">
            <div class="rqimg"><img src="/images/df_03.jpg" width="120" height="120" /></div>
            <p>Bessie OL气质荷叶边条纹短裙<br/>
              原价：￥<span class="font7">236.00</span><br/>
              <span class="font6">特惠价：￥198.00</span></p>
            <img src="/images/add-cart.gif" width="81" height="21" alt="放入购物车" /></div>
          <div class="rq">
            <div class="rqimg"><img src="/images/df_03.jpg" width="120" height="120" /></div>
            <p>Bessie OL气质荷叶边条纹短裙<br/>
              原价：￥<span class="font7">236.00</span><br/>
              <span class="font6">特惠价：￥198.00</span></p>
            <img src="/images/add-cart.gif" width="81" height="21" alt="放入购物车" /></div>
          <div class="rq">
            <div class="rqimg"><img src="/images/df_03.jpg" width="120" height="120" /></div>
            <p>Bessie OL气质荷叶边条纹短裙<br/>
              原价：￥<span class="font7">236.00</span><br/>
              <span class="font6">特惠价：￥198.00</span></p>
            <img src="/images/add-cart.gif" width="81" height="21" alt="放入购物车" /></div>
          <div class="rq">
            <div class="rqimg"><img src="/images/df_03.jpg" width="120" height="120" /></div>
            <p>Bessie OL气质荷叶边条纹短裙<br/>
              原价：￥<span class="font7">236.00</span><br/>
              <span class="font6">特惠价：￥198.00</span></p>
            <img src="/images/add-cart.gif" width="81" height="21" alt="放入购物车" /></div>
          <div class="rq">
            <div class="rqimg"><img src="/images/df_03.jpg" width="120" height="120" /></div>
            <p>Bessie OL气质荷叶边条纹短裙<br/>
              原价：￥<span class="font7">236.00</span><br/>
              <span class="font6">特惠价：￥198.00</span></p>
            <img src="/images/add-cart.gif" width="81" height="21" alt="放入购物车" /></div>
          <div class="rq">
            <div class="rqimg"><img src="/images/df_03.jpg" width="120" height="120" /></div>
            <p>Bessie OL气质荷叶边条纹短裙<br/>
              原价：￥<span class="font7">236.00</span><br/>
              <span class="font6">特惠价：￥198.00</span></p>
            <img src="/images/add-cart.gif" width="81" height="21" alt="放入购物车" /></div>
          <div class="rq">
            <div class="rqimg"><img src="/images/df_03.jpg" width="120" height="120" /></div>
            <p>Bessie OL气质荷叶边条纹短裙<br/>
              原价：￥<span class="font7">236.00</span><br/>
              <span class="font6">特惠价：￥198.00</span></p>
            <img src="/images/add-cart.gif" width="81" height="21" alt="放入购物车" /></div>
        </div>
      </div>
      <div class="switch"><a class="curr" href="#">1</a><a href="#">2</a></div>
    </div>
  </div>
-->
</div>
<?php include '/../footer.php';?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/order.js"></SCRIPT>
</body>
</html>




<!--
<form id='aliPay_submit' name='aliPay_submit' action='https://mapi.alipay.com/gateway.do?_input_charset=utf-8' method='POST'>
    <input type='hidden' name='_input_charset' value='utf-8'/>
    <input type='hidden' name='body' value='潮人必备个性T恤-红色 | 潮人必备个性T恤-白色'/>
    <input type='hidden' name='logistics_payment' value='SELLER_PAY'/>
    <input type='hidden' name='logistics_type' value='EXPRESS'/>
    <input type='hidden' name='notify_url' value='http://wunxin.com/pay/payBack/'/>
    <input type='hidden' name='out_trade_no' value='105'/>
    <input type='hidden' name='partner' value='2088002380741030'/>
    <input type='hidden' name='payment_type' value='1'/>
    <input type='hidden' name='price' value='567.43'/>
    <input type='hidden' name='quantity' value='1'/>
    <input type='hidden' name='receive_address' value='北京市朝阳区高碑乡半壁店村25号'/>
    <input type='hidden' name='receive_mobile' value='01061116110'/>
    <input type='hidden' name='receive_name' value='侯积平'/>
    <input type='hidden' name='receive_phone' value='15101559313'/>
    <input type='hidden' name='receive_zip' value='100010'/>
    <input type='hidden' name='return_url' value='http://wunxin.com/pay/payBack/'/>
    <input type='hidden' name='seller_email' value='hjpking@hotmail.com'/>
    <input type='hidden' name='service' value='trade_create_by_buyer'/>
    <input type='hidden' name='subject' value='潮人必备个性T恤-红色'/>
    <input type='hidden' name='sign' value='5dbf29d06db2ab96934d07f7391dd0b5'/>
    <input type='hidden' name='sign_type' value='MD5'/>
    <input type='submit' value='提交'>
</form>

<form id='alipaysubmit' name='alipaysubmit' action='https://mapi.alipay.com/gateway.do?_input_charset=utf-8' method='POST'>
    <input type='hidden' name='_input_charset' value='utf-8'/>
    <input type='hidden' name='body' value='潮人必备个性T恤-红色 | 潮人必备个性T恤-白色'/>
    <input type='hidden' name='logistics_payment' value='SELLER_PAY'/>
    <input type='hidden' name='logistics_type' value='EXPRESS'/>
    <input type='hidden' name='notify_url' value='http://wunxin.com/pay/payBack/'/>
    <input type='hidden' name='out_trade_no' value='105'/>
    <input type='hidden' name='partner' value='2088002380741030'/>
    <input type='hidden' name='payment_type' value='1'/>
    <input type='hidden' name='price' value='567.43'/>
    <input type='hidden' name='quantity' value='1'/>
    <input type='hidden' name='receive_address' value='北京市朝阳区高碑乡半壁店村25号'/>
    <input type='hidden' name='receive_mobile' value='01061116110'/>
    <input type='hidden' name='receive_name' value='侯积平'/>
    <input type='hidden' name='receive_phone' value='15101559313'/>
    <input type='hidden' name='receive_zip' value='100010'/>
    <input type='hidden' name='return_url' value='http://wunxin.com/pay/payBack/'/>
    <input type='hidden' name='seller_email' value='hjpking@hotmail.com'/>
    <input type='hidden' name='service' value='trade_create_by_buyer'/>
    <input type='hidden' name='subject' value='潮人必备个性T恤-红色'/>
    <input type='hidden' name='sign' value='5dbf29d06db2ab96934d07f7391dd0b5'/>
    <input type='hidden' name='sign_type' value='MD5'/>
    <input type='submit' value='确认'>
</form>
-->