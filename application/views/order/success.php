<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>订单提交成功</title>
<link href="/css/base.css" rel="stylesheet" type="text/css" />
<link href="/css/shopping.css" rel="stylesheet" type="text/css" />
<!--<SCRIPT type=text/javascript src="/scripts/comm.js"></SCRIPT>-->
<SCRIPT type=text/javascript src="/scripts/jquery-1.4.2.min.js"></SCRIPT>
<!--[if lt IE 7]>
<script type="text/javascript" src="js/iepng.js"></script>
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
          应付金额：<span class="font6"><?php echo $order['after_discount_price'];?></span> 元，
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
  <div class="other-shopping">
    <div class="tit">选择支付方式</div>
    <div class="payment">
      <p>点击选择银行付款</p>
      <div class="payment-c">
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="onlinepay-b" value="" name="bank"/>
          </div>
          <div class="bankpic"><label for="onlinepay-b"><span class="bankimg" id="onlinepay">中国工商银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" value="" id="icbc-b" name="bank" />
          </div>
          <div class="bankpic"><label for="icbc-b"><span class="bankimg" id="icbc">中国工商银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="cmb-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="cmb-b"><span class="bankimg" id="cmb">招商银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" value="" id="boc-b" name="bank" />
          </div>
          <div class="bankpic"><label for="boc-b"><span class="bankimg" id="boc">中国银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="ccb-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="ccb-b"><span class="bankimg" id="ccb">中国建设银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="abc-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="abc-b"><span class="bankimg" id="abc">中国农业银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="cgb-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="cgb-b"><span class="bankimg" id="cgb">广发银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="cmbc-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="cmbc-b"><span class="bankimg" id="cmbc">中国民生银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="cib-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="cib-b"><span class="bankimg" id="cib">兴业银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="bob-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="bob-b"><span class="bankimg" id="bob">北京银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="bjrcb-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="bjrcb-b"><span class="bankimg" id="bjrcb">北京农村商业银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="psbc-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="psbc-b"><span class="bankimg" id="psbc">中国邮政储蓄银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="bcomm-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="bcomm-b"><span class="bankimg" id="bcomm">交通银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="spdb-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="spdb-b"><span class="bankimg" id="spdb">浦发银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="sdb-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="sdb-b"><span class="bankimg" id="sdb">深圳发展银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="cebb-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="cebb-b"><span class="bankimg" id="cebb">中国光大银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="pingan-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="pingan-b"><span class="bankimg" id="pingan">平安银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="ecitic-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="ecitic-b"><span class="bankimg" id="ecitic">中信银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="hzb-b" value="" name="bank" />
          </div>
          <div class="bankpic"><label for="hzb-b"><span class="bankimg" id="hzb">杭州银行</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input type="radio" id="" value="nbcb-b" name="bank" />
          </div>
          <div class="bankpic"><label for="nbcb-b"><span class="bankimg" id="nbcb">宁波银行</span></label></div>
        </div>
      </div>
      <p>点击选择支付平台付款</p>
      <div class="payment-c">
        <div class="payment-b">
          <div class="pradio">
            <input name="bank" id="alipay-b" type="radio" value=""/>
          </div>
          <div class="bankpic"><label for="alipay-b"><span class="bankimg" id="alipay">支付宝</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input name="bank" id="cmpay-b" type="radio" value="" />
          </div>
          <div class="bankpic"><label for="cmpay-b"><span class="bankimg" id="cmpay">手机支付</span></label></div>
        </div>
        <div class="payment-b">
          <div class="pradio">
            <input name="bank" id="tenpay-b" type="radio" value="" />
          </div>
          <div class="bankpic"><label for="tenpay-b"><span class="bankimg" id="tenpay">财付通</span></label></div>
        </div>
      </div>
      <div class="topay"><a href="#"><img src="/images/pay.gif" width="150" height="41" alt="立即付款" /></a></div>
    </div>
  </div>
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
<SCRIPT type=text/javascript src="/scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="/scripts/order.js"></SCRIPT>
</body>
</html>
