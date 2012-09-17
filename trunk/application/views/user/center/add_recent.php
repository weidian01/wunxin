<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>添加收货地址 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
        td a.btn-save {
        display: block;
        float: left;
        padding: 4px 15px;
        line-height: 20px;
        background-color: #A10000;
        color: white;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        }
    </style>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">添加收货地址 </div>
        </div>
        <div class="u-r-box">
            <form action="/user/center/addInvoice" method="post">
                <input type="hidden" name="act" value="add">
                <input type="hidden" name="act" value="<?php echo empty ($recentData['recent_name']) ? '0' : $recentData['address_id'];?>" id="aid_id">
                <table class="tab1" width="100%" border="0" cellspacing="0" cellpadding="0" id="new_address_id">
                    <tr>
                      <td width="10%" align="right"><span class="font10">*</span> 收货人姓名：</td>
                      <td width="90%"><input name="recent_name" type="text" class="input4" id="recent_name_id" value="<?php echo empty ($recentData['recent_name']) ? '' : $recentData['recent_name'];?>"/>
                        <span class="font2" id="recent_name_notice_id"> 请填写您的真实姓名</span></td>
                    </tr>
                    <tr>
                      <td width="10%" align="right"><span class="font10">*</span> 省市：</td>
                      <td width="90%">
                          <select name="select" id="province_id" onchange="order.changeProvince(this.value)">
                              <option value="0">省份</option>
                              <?php foreach ($province_data as $pv) {?>
                              <option value="<?php echo $pv['id'];?>"><?php echo $pv['name'];?></option>
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
                        <span id="address_notice_id"> 请填写您的收货地址</span></span></td>
                    </tr>
                    <tr>
                      <td align="right"><span class="font10">*</span>手机号码：</td>
                      <td><input name="phone_num" type="text" class="input4" id="phone_num_id" value="" />
                        <span class="font2" id="phone_num_notice_id"> 请填写正确手机号码，便于接收发货和收货通知</span></td>
                    </tr>
                    <tr>
                      <td align="right">固定电话：</td>
                      <td><input name="area_num" type="text" class="input2" id="area_num_id" value="" />
                        -
                        <input name="call_num" type="text" class="input3" id="call_num_id" value="" />
                        <span class="font2"> 如010-12345678，固定电话和手机号码请至少填写一项</span></td>
                    </tr>
                    <tr>
                      <td align="right"><span class="font10">*</span> 电子邮件：</td>
                      <td><input name="email" type="text" class="input4" id="email_id" />
                        <span class="font2" id="email_notice_id"> 用于接收订单提醒邮件，便于您及时了解订单状态</span></td>
                    </tr>
                    <tr>
                      <td align="right"><span class="font10">*</span> 邮编：</td>
                      <td><input name="post_code" type="text" class="input4" id="post_code_id" />
                        <span class="font2" id="post_code_notice_id"> 建议邮编：<span id="proposal_post_code_id"></span></span></td>
                    </tr>
                    <tr>
                      <td height="50" align="right">&nbsp;</td>
                      <td><a class="" href="javascript:void(0);" onclick="order.saveAddress('/user/center/recentAddress')">
                          <img src="<?=config_item('static_url')?>images/save_address.png" title="保存地址">
                      </a></td>
                    </tr>
                  </table>
            </form>
        </div>
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/order.js"></SCRIPT>
<!-- #EndLibraryItem -->
</body>
</html>

