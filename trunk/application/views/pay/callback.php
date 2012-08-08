<?php
    $t = '很遗憾，您的订单支付失败了！原因：系统繁忙，请稍后再试';
    switch ($response['error']) {
        case '0' : $t = '恭喜您，您的订单支付成功了'; break;
        case '30019' : $t = '很遗憾，您的订单支付失败了！原因：未知的支付渠道'; break;
        case '30020' : $t = '很遗憾，您的订单支付失败了！原因：签名错误'; break;
        case '30021' : $t = '很遗憾，您的订单支付失败了！原因：您未付款或支付失败'; break;
        case '30022' : $t = '很遗憾，您的订单支付失败了！原因：订单不存在或未知的订单'; break;
        case '30023' : $t = '很遗憾，您的订单支付失败了！原因：支付的金额与订单的金额不一致'; break;
        case '30024' : $t = '很遗憾，您的订单支付失败了！原因：系统繁忙，请稍后再试'; break;
        case '30025' : $t = '很遗憾，您的订单支付失败了！原因：记录收款单信息失败'; break;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $t;?></title>
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
      <p><?php echo $t;?>!</p>
      <span class="font9">您的订单号：<?php echo $order['order_sn'];?>
          <?php echo ($response['error'] == '0') ? '已' : '应';?>付金额：<span class="font6"><?php echo fPrice($order['after_discount_price']);?></span> 元，
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
              default:  $s = '工作日、双休日和节假日均送货'; break;
          }echo $s;
          ?><br/>
          <?php echo $order['recent_name'].',';

            if (($response['error'] == '0')) {
                echo ' 您于'.date('Y-m-d H:i',strtotime($order['pay_time'])).' 已成功付款，我们将尽快安排发货，可随时登陆万象网
                    <a href="/user/center/index" style="color:#A10000;" target="_blank"><b>(我的订单)</b></a> 查看订单状态。';
            } else {
                if ($order['pay_type'] == '1') {
                    echo ' 如果<span class="font6"> 24 </span>小时内您无法完成付款，系统会将您的订单取消。';
                } elseif ($order['pay_type'] == '3') {
                    echo ' 如果<span class="font6"> 72 </span>小时内您无法完成付款，系统会将您的订单取消。';
                } else {
                    echo ' 如果<span class="font6"> 24 </span>小时内您无法完成付款，系统会将您的订单取消。';
                }
            }

          ?></div>
  </div>
  <?php if ($response['error'] != '0') {?>
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
      <div class="topay"><a href="javascript:vaid(0);" onclick="order.pay()"><img src="<?=config_item('static_url')?>images/pay.gif" width="150" height="41" alt="立即付款" /></a></div>
    </div>
  </div>
  </form>
      <?php } else {?>
  <div class="other-shopping" style="height:350px;">
      <div class="tit">购买以上商品的顾客还购买过</div>
      <div class="other-c">
          <div class="other-pre"><a href="#">pre</a></div>
          <div class="other-next"><a href="#">next</a></div>
          <div class="other-cg">
              <div style=" height:230px; width:1800px;">
                  <?php foreach ($recommend as $rv) { ?>
                  <div class="rq">
                      <div class="rqimg">
                          <a href="#" title="<?=$rv['pname'];?>">
                            <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($rv['pid'])?>default.jpg" width="120" height="161" title="<?php echo $rv['pname'];?>"/>
                          </a>
                      </div>
                      <p>
                          <a href="#" title="<?php echo $rv['pname'];?>"> <?=mb_substr($rv['pname'], 0, 20, 'utf-8');?></a><br/>
                          原价：￥<span class="font7"><?php echo fPrice($rv['market_price']);?></span><br/>
                          <span class="font6">特惠价：￥<?php echo fPrice($rv['sell_price']);?></span>
                      </p>
                      <a href="#" title="<?=$rv['pname'];?>">
                        <img src="/images/add-cart.gif" width="81" height="21" alt="放入购物车"/>
                      </a>
                  </div>
                  <?php }?>
              </div>
          </div>
          <div class="switch"><a class="curr" href="#">1</a><a href="#">2</a></div>
      </div>
  </div>
<?php } ?>
</div>
<?php include '/../footer.php';?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/order.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/cart.js"></SCRIPT>
</body>
</html>