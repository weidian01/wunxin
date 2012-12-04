<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>填写订单核对信息</title>
<link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css" />
<link href="<?=config_item('static_url')?>css/shopping.css" rel="stylesheet" type="text/css" />
<link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css" />
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></SCRIPT>
    <SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/artdialog.js"></SCRIPT>
<!--[if lt IE 7]>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
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
<?php include APPPATH.'views/header.php';?>
<form action="/order/order/submit/" method="POST" onsubmit="order.orderSubmit()" id="order_form_id" name="order_form_id">
<div class="box pad8" style="overflow:hidden;">
  <div class="process">
    <ul>
      <li class="bgcart">我的购物车</li>
      <li class="curr2">填写订单核对信息</li>
      <li class="last2">成功提交订单</li>
    </ul>
  </div>
  <div class="other-shopping">
    <div class="tit">收货人信息：&nbsp;&nbsp;<span onclick="editorder('edit-cong','cong', this)" id="modify_text_id">[修改]</span></div>
    <?php if (empty ($recent_data)) {?>
        <script type="text/javascript">
        $(document).ready(function(){
          wx.addAddress();
          editorder('edit-cong','cong', this);
        });
        </script>
    <?php } else {?>
        <?php foreach ($recent_data as $v) {?>
            <?php if ($v['default_address']) {?>
        <div class="consignee" id="cong">
            <?=$v['recent_name']; ?><span style="padding-left:20px;"></span><?=$v['province'].','.$v['city'].','.$v['area'].','.$v['detail_address'];?>
            <span style="padding-left:20px;"></span><?=$v['zipcode'];?><br/>
            <?=$v['phone_num'];?>，    <?=$v['call_num'];?>
        </div>
            <?php }?>
        <?php }?>
    <?php }?>
    <div class="consignee" id="edit-cong" style="display:none;">
      <div class="consigneeList">

          <?php if (empty ($recent_data)) $recent_data = array();foreach ($recent_data as $rdv) {?>
          <label id="address_<?=$rdv['address_id'];?>" onclick="wx.editAddress(<?=$rdv['address_id'];?>)">
              <span class="xzradio"> <input name="address_id" type="radio" value="<?=$rdv['address_id'];?>" <?=$rdv['default_address'] == '1' ? 'checked="checked"' : '';?>/> </span>
              <span><?=$rdv['recent_name'];?></span><span><?=$rdv['province'].','.$rdv['city'].','.$rdv['area'].','.$rdv['detail_address'];?>
              </span><span><?=$rdv['phone_num'];?></span><span><?=$rdv['call_num'];?></span>

              <!--<span onclick="wx.editAddress(<?=$rdv['address_id'];?>)">编辑</span>-->
              <span onclick="wx.deleteAddress(<?=$rdv['address_id'];?>)">删除</span>
          </label>
          <?php }?>

          <label onclick="wx.addAddress()">
            <span class="xzradio"> <input name="address_id" type="radio" value="0" /> </span>
            <span>添加新地址</span>
          </label>
      </div>
        <input type="hidden" name="aid" id="aid_id" value="0"/>
      <!--<div class="address"> <input name="" type="radio" value="" checked="checked"/> 添加新地址</div>-->
      <table class="tab1" width="100%" border="0" cellspacing="0" cellpadding="0" style="display: none;" id="new_address_id">
        <tr>
          <td width="10%" align="right"><span class="font10">*</span> 收货人姓名：</td>
          <td width="90%"><input name="recent_name" type="text" class="input4" id="recent_name_id"/>
            <span class="font2" id="recent_name_notice_id">请填写您的真实姓名</span></td>
        </tr>
        <tr>
          <td width="10%" align="right"><span class="font10">*</span> 省市：</td>
          <td width="90%">
              <select name="select" id="province_id" onchange="order.changeProvince(this.value)">
                  <option value="0">省份</option>
                  <?php foreach ($province_data as $pv) {?>
                  <option value="<?=$pv['id'];?>"><?=$pv['name'];?></option>
                  <?php }?>
            </select>
            &nbsp;&nbsp;
            <select name="city" id="city_id" onchange="order.changeCity(this.value)">
              <option value="0">市</option>
            </select>
            &nbsp;&nbsp;
            <select name="area" id="area_id">
              <option value="0">县/区</option>
            </select>
            &nbsp;&nbsp; <span class="font2"> <span id="edit_address_id"></span>
            <input name="detail_address" type="text" class="input1" id="detail_address_id" value="" />
            <span id="address_notice_id">请填写您的收货地址</span></span></td>
        </tr>
        <tr>
          <td align="right"><span class="font10">*</span>手机号码：</td>
          <td><input name="phone_num" type="text" class="input4" id="phone_num_id" value="" />
            <span class="font2" id="phone_num_notice_id">请填写正确手机号码，便于接收发货和收货通知</span></td>
        </tr>
        <tr>
          <td align="right">固定电话：</td>
          <td><input name="area_num" type="text" class="input2" id="area_num_id" value="" />
            -
            <input name="call_num" type="text" class="input3" id="call_num_id" value="" />
            <span class="font2">如010-12345678，固定电话和手机号码请至少填写一项</span></td>
        </tr>
        <tr>
          <td align="right"><span class="font10">*</span> 电子邮件：</td>
          <td><input name="email" type="text" class="input4" id="email_id" />
            <span class="font2" id="email_notice_id">用于接收订单提醒邮件，便于您及时了解订单状态</span></td>
        </tr>
        <tr>
          <td align="right"><span class="font10">*</span> 邮编：</td>
          <td><input name="post_code" type="text" class="input4" id="post_code_id" />
            <span class="font2" id="post_code_notice_id">建议邮编：<span id="proposal_post_code_id"></span></span></td>
        </tr>
        <tr>
          <td height="50" align="right">&nbsp;</td>
          <td><a class="btn-save" href="javascript:void(0);" onclick="order.saveAddress()">保存并送到此地址</a></td>
        </tr>
      </table>
        <!--<br/>
        <a class="btn-save" href="javascript:void(0);" onclick="order.saveAddress()">保存并送到此地址</a>
        <br/>-->
    </div>
    <div class="tit borders">支付及送货时间：&nbsp;&nbsp;<span onclick="editorder('pay-delivery2','pay-delivery1', this)">[修改]</span></div>
    <div class="consignee" id="pay-delivery1">
      <table class="tab1" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="9%" align="right">支付方式：</td>
          <td width="91%" id="pay_type_view_id">在线支付</td>
        </tr>
        <tr>
          <td align="right">配送方式：</td>
          <td>快递</td>
        </tr>
        <tr>
          <td align="right">运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：</td>
          <td>0.00（免运费）</td>
        </tr>
        <tr>
          <td align="right">送货时间：</td>
          <td id="delivert_time_view_id">工作日、双休日和节假日均送货</td>
        </tr>
      </table>
    </div>
    <div class="paybox" id="pay-delivery2" style="display:none;">
      <table class="tab4" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2"><strong>支付方式</strong></td>
          <td width="72%"><strong>备注</strong></td>
        </tr>
        <tr>
          <td width="4%" align="center"><input name="pay_type" type="radio" id="radio" value="1" checked="checked" /></td>
          <td width="24%">在线支付</td>
          <td> 即时到帐，支持绝大数银行借记卡及部分银行信用卡 查看银行及限额</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>银行或机构支付</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">
          <div class="payment-c">
        <div class="payment-b">
          <!--<div class="pradio"> <input type="radio" id="onlinepay-b" value="" name="bank"/> </div>-->
          <div class="bankpic"><label for="onlinepay-b"><span class="bankimg" id="onlinepay">在线支付</span></label></div>
        </div>
        <div class="payment-b">
          <!--<div class="pradio"> <input type="radio" value="" id="icbc-b" name="bank" /> </div>-->
          <div class="bankpic"><label for="icbc-b"><span class="bankimg" id="icbc">中国工商银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="cmb-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="cmb-b"><span class="bankimg" id="cmb">招商银行</span></label></div>
        </div>
        <div class="payment-b">
          <!--<div class="pradio"> <input type="radio" value="" id="boc-b" name="bank" /> </div>-->
          <div class="bankpic"><label for="boc-b"><span class="bankimg" id="boc">中国银行</span></label></div>
        </div>
        <div class="payment-b">
          <!--<div class="pradio"> <input type="radio" id="ccb-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="ccb-b"><span class="bankimg" id="ccb">中国建设银行</span></label></div>
        </div>
        <div class="payment-b">
          <!--<div class="pradio"> <input type="radio" id="abc-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="abc-b"><span class="bankimg" id="abc">中国农业银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="cgb-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="cgb-b"><span class="bankimg" id="cgb">广发银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="cmbc-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="cmbc-b"><span class="bankimg" id="cmbc">中国民生银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="cib-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="cib-b"><span class="bankimg" id="cib">兴业银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="bob-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="bob-b"><span class="bankimg" id="bob">北京银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="bjrcb-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="bjrcb-b"><span class="bankimg" id="bjrcb">北京农村商业银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="psbc-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="psbc-b"><span class="bankimg" id="psbc">中国邮政储蓄银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="bcomm-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="bcomm-b"><span class="bankimg" id="bcomm">交通银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="spdb-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="spdb-b"><span class="bankimg" id="spdb">浦发银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="sdb-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="sdb-b"><span class="bankimg" id="sdb">深圳发展银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="cebb-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="cebb-b"><span class="bankimg" id="cebb">中国光大银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="pingan-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="pingan-b"><span class="bankimg" id="pingan">平安银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="ecitic-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="ecitic-b"><span class="bankimg" id="ecitic">中信银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="hzb-b" value="" name="bank" /> </div>-->
          <div class="bankpic"><label for="hzb-b"><span class="bankimg" id="hzb">杭州银行</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input type="radio" id="" value="nbcb-b" name="bank" /> </div>-->
          <div class="bankpic"><label for="nbcb-b"><span class="bankimg" id="nbcb">宁波银行</span></label></div>
        </div>
      </div>
            <p>支付平台</p>
            <div class="payment-c">
        <div class="payment-b">
            <!--<div class="pradio"> <input name="bank" id="alipay-b" type="radio" value=""/> </div>-->
          <div class="bankpic"><label for="alipay-b"><span class="bankimg" id="alipay">支付宝</span></label></div>
        </div>
        <div class="payment-b">
            <!--<div class="pradio"> <input name="bank" id="cmpay-b" type="radio" value="" /> </div>-->
          <div class="bankpic"><label for="cmpay-b"><span class="bankimg" id="cmpay">手机支付</span></label></div>
        </div>
        <!--
        <div class="payment-b">
            <div class="pradio"> <input name="bank" id="tenpay-b" type="radio" value="" /> </div>
          <div class="bankpic"><label for="tenpay-b"><span class="bankimg" id="tenpay">财付通</span></label></div>
        </div>
        -->
      </div>
            </td>
        </tr>
        <tr>
          <td align="center"><input type="radio" name="pay_type" id="radio2" value="3" /></td>
          <td>邮政汇款</td>
          <td><!--通过快钱平台收款 汇款后1-3个工作日到账 查看帮助--></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><div class="postal">选择邮局汇款的万象网订单，订单提交后将保留将保留3天，请您及时汇款，谢谢！<br />
              在填写邮局汇款单时请务必填写以下内容：<br />
              1、收款人姓名：侯积平<br />
              2、收款人地址：北京市朝阳区高碑店乡半壁店村25号<br />
              3、收款人邮编：100124<br />
              4、账号：62220606030354<br />
              5、请填写您的姓名、地址、邮编；<br />
              6、在附言栏注明订单号（您成功提交订单后会收到订单号，也可以在<a href="<?=config_item('static_url')?>user/center/index" target="_blank"><b> 我的订单 </b></a>中查询到）、联系电话、客户编号（老客户）；<br />
              我们将在收到您的汇款后为您寄发包裹。</div></td>
        </tr>
      </table>
      <table class="tab2" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
        <tr>
          <td colspan="2"><strong>送货时间</strong></td>
        </tr>
        <tr>
          <td width="4%" align="center"><input type="radio" name="delivert_time" id="radio3" value="3" /></td>
          <td width="96%"> 只工作日送货（双休日、节假日不送）</td>
        </tr>
        <tr>
          <td align="center"><input type="radio" name="delivert_time" id="radio4" value="1" checked="checked"/></td>
          <td>工作日、双休日和节假日均送货</td>
        </tr>
        <tr>
          <td align="center" valign="top"><input type="radio" name="delivert_time" id="radio5" value="2" /></td>
          <td> 只双休日、节假日送货（工作时间不送货）<br /><br />
            声明：我们会努力按照您指定的时间配送，但因为天气、交通等各类因素影响，您的订单有可能会有延误现象，敬请谅解！<br />
            <!--送货前是否联系：是 否（您需要特定时间配送可以选择哦！）--></td>
        </tr>
        <tr>
          <td height="50" align="center">&nbsp;</td>
          <td><a class="btn-save" href="javascript:void(0);" onclick="order.savePayRecent()">保存支付与送货时间</a></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="other-shopping">
    <div class="tit">产品清单</div>
    <div class="cartlist">
      <table class="tab3" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center">&nbsp;</td>
          <td align="left"><span class="font11">产品名称</span></td>
          <td width="9%" align="center"><span class="font11">单价</span></td>
          <td width="13%" align="center"><span class="font11">数量</span></td>
          <td width="10%" align="center"><span class="font11">赠送积分</span></td>
          <td width="12%" align="center"><span class="font11">小计</span></td>
        </tr>
          <?php
          $total_num = 0;
          $total_price = 0;
          foreach ($cart_info['products'] as $cv) {
              //$total_price += $cv['final_price'] * $cv['num'];
              $total_num += $cv['num'];

              ?>
        <tr>
          <td width="7%">
              <a href="<?=productURL($cv['pid'])?>" target="_blank">
                <img src="<?=config_item('static_url')?>upload/product/<?=str_replace('\\', '/', intToPath($cv['pid']))?>icon.jpg" width="60" height="60" />
              </a>
          </td>
          <td width="49%"><a class="gn2" href="<?=productURL($cv['pid'])?>" target="_blank"><?=mb_substr($cv['pname'], 0, 70, 'utf-8');?></a><br/>
            <!-- <span class="font2">GZ26052909-S</span> --></td>
          <td align="center"><?=fPrice($cv['final_price']);?></td>
          <td align="center"><?=intval($cv['num']);?></td>
          <td align="center"><?=intval(fPrice($cv['final_price'] * $cv['num']));?></td>
          <td align="center"><span class="font6"><?=fPrice($cv['final_price'] * $cv['num']);?></span></td>
        </tr>
          <?php }?>
      </table>
      <table class="tab2" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
        <tr>
          <!--<td width="21%"><div class="sy"><span class="invo" id="invos" onclick="syinfo('syinv','invos')"></span></div></td>-->
          <td width="79%" align="right">
              产品数量总计：<?=intval($total_num);?>&nbsp;&nbsp;&nbsp;&nbsp;
              赠送积分总计：<?=intval(fPrice($cart_info['total_price']));?>&nbsp;&nbsp;&nbsp;&nbsp;
              花费积分总计：0&nbsp;&nbsp;&nbsp;&nbsp;
              商品金额总计：￥<span id="order_total_price"><?=fPrice($cart_info['total_price']);?></span></td>
        </tr>
      </table>
      <div class="order-info">
        <div class="order-fj">
            <div class="sy"><span class="gift_card" id="gift_card" onclick="syinfo('gift_card_box','gift_card')"></span></div>
            <div class="gift_card_box" id="gift_card_box" style="display: none;">
                <style>.o-list{font-weight: bold;color: #888888;}</style>
                <table class="tab2" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr class="o-list">
                        <td align="center">卡号</td>
                        <td align="center">卡名称</td>
                        <td align="center">卡金额</td>
                        <td align="center">使用说明</td>
                        <td align="center">使用金额</td>
                        <td align="center">操作</td>
                    </tr>
                    <tbody>
                    <?php
                    foreach ($user_card as $k=>$v) {
                        if ($v['card_amount'] <= 0 || $card_model[$v['model_id']]['end_time'] < date('Y-m-d H:i:s') || $v['status'] != 2) {
                            unset ($user_card[$k]);
                        }
                    }
                    if (empty ($user_card)) {?>
                    <tr>
                        <td colspan="7" style="text-align: center;font-weight: bold;color: #A10000;" height="50">
                            您暂时没有礼品卡，去<a href="<?=config_item('static_url')?>user/center/bingCard" target="_blank">绑定卡</a>吧。
                        </td>
                    </tr>
                    <?php } else {?>
                    <?php foreach ($user_card as $k=>$v):?>
                    <tr style="background-color: <?=($k%2) ? '#FFFAFA': '';?>;">
                        <td style="word-break:break-all; width:22%;"><?=$v['card_no'];?></td>
                        <td style="word-break:break-all; width:15%;">
                            <a href="<?=config_item('static_url')?>coupon/show/<?=$v['model_id'];?>" title="<?=$card_model[$v['model_id']]['card_name'];?>" target="_blank">
                                    <?=mb_substr($card_model[$v['model_id']]['card_name'], 0, 10, 'UTF-8');?>
                            </a>
                        </td>
                        <td align="center">￥<?=fPrice($v['card_amount']);?></td>
                        <td style="word-break:break-all; width:20%;">
                            <span title="<?=$card_model[$v['model_id']]['descr'];?>">
                                <?=mb_substr($card_model[$v['model_id']]['descr'], 0, 15, 'UTF-8');?>
                            </span>
                        </td>
                        <td align="center">
                            <input type="text" name="use_amount" value="<?=fPrice($v['card_amount']);?>" size="6" id="use_amount_<?=$v['card_no'];?>"/>元
                        </td>
                        <td align="center">

                            <a href="javascript:void(0);" onclick="order.useGiftCard('<?=$v['card_no'];?>', <?=($v['card_amount']);?>, 'pop_<?=$v['card_no'];?>')" id="pop_<?=$v['card_no'];?>">
                            <?php if (!isset ($need_use_card[$v['card_no']])){?>
                                <img src="<?=config_item('static_url')?>images/use.gif" alt="使用礼品卡" title="使用礼品卡"/>
                            <?php } else {?>
                                <img src="<?=config_item('static_url')?>images/cancel.jpg" alt="取消使用礼品卡" title="取消使用礼品卡"/>
                            <?php }?>
                            </a>

                        </td>
                    </tr>
                    <?php endforeach;?>
                    <tr>
                        <td align="right" colspan="7">
                            <a class="banding_gift_card" href="<?=config_item('static_url')?>user/center/bingCard" target="_blank"></a>
                            <!--<s class="use_gift_card" onclick="order.useGiftCard('use_card_button');" id="use_card_button"></s>-->
                        </td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>

          <div class="sy2"><span class="ordermark" id="omk" onclick="marksinfo('syinv2','omk')"></span></div>
          <div class="sybox" id="syinv2" style="display:none;">
            <textarea class="tta" name="annotated" rows="6" id="annotated_id"></textarea>
            <p style="padding-top:8px;"><span class="font2">声明：备注中的有关收货人信息、支付方式、配送方式等购买要求一律以上面的选择为准，备注无效。</span><br/>

              是否打印价格：
              <input name="is_print_price" type="radio" value="1"/>
              是
              <input name="is_print_price" type="radio" value="0" checked="checked"/>
              否 （如送朋友的商品可不打印价格哦）</p>

          </div>
        </div>
        <div class="order-sum">运费：￥0<br/>
          礼品卡抵冲：￥<span id="card_use_amount"><?=fPrice( (array_sum($gift_card) > $cart_info['total_price']) ? $cart_info['total_price'] : array_sum($gift_card) );?></span><br/>
          虚拟账户余额抵冲：￥0.00
          <div style="padding:10px 0 0 0;">您共需要为订单支付：<span class="font12">￥
              <span id="final_pay_amount"><?=fPrice( (array_sum($gift_card) > $cart_info['total_price']) ? 0 : ($cart_info['total_price'] - array_sum($gift_card)) );?></span></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="topost">
      <a href="javascript:void(0);" onclick="order.orderSubmit()" class="order_submit_button">
          <!--<img src="<?=config_item('static_url')?>images/post-order.gif" width="150" height="41" alt="提交订单" />-->
      </a>
  </div>
</div>
</form>
<?php include APPPATH.'views/footer.php';?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/order.js"></SCRIPT>
<script type="text/javascript">
function syinfo(a, b)
{
    var dsy = document.getElementById(a);
    var dsc = document.getElementById(b);
    if (dsy.style.display == "none") {
        dsy.style.display = "";
        dsc.style.background = "url(<?=config_item('static_url')?>images/button_images.gif) no-repeat";
        dsc.style.backgroundPosition = "-16px -150px";
    }
    else {
        dsy.style.display = "none";
        dsc.style.background = "url(<?=config_item('static_url')?>images/button_images.gif) no-repeat";
        dsc.style.backgroundPosition = "-16px -180px";
    }
}

function marksinfo(a, b)
{
    var dsy = document.getElementById(a);
    var dsc = document.getElementById(b);
    if (dsy.style.display == "none") {
        dsy.style.display = "";
        dsc.style.background = "url(<?=config_item('static_url')?>images/shoppingbg.gif) no-repeat";
        dsc.style.backgroundPosition = "0px -217px";
    } else {
        dsy.style.display = "none";
        dsc.style.background = "url(<?=config_item('static_url')?>images/shoppingbg.gif) no-repeat";
        dsc.style.backgroundPosition = "0px -109px";
    }
}

function editorder(a, b, t)
{
    var ey = document.getElementById(a);
    var et = document.getElementById(b);
    if (ey.style.display == "none") {
        t.innerHTML = '[不保存关闭]';
        //$('#modify_text_id').html('[不保存关闭]');
        ey.style.display = "";
        (et == null || et == '') ? '' : et.style.display = "none";
    } else {
        t.innerHTML = '[修改]';
        ey.style.display = "none";
        (et == null || et == '') ? '' : et.style.display = "";
    }
}
</script>
</body>
</html>
