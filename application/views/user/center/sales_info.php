<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>促销信息退订 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
        body, div, ul, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, pre, input, p, blockquote, th, td, button, blockquote { margin: 0; padding: 0; }
        .xgmm .main {
            /*background: url("<?=config_item('static_url')?>images/k_r_b.gif") no-repeat scroll center bottom transparent;*/
            float: left; min-height: 400px; padding: 10px 11px 11px; width: 778px; }
        .xgmm .main dl { border: 1px solid #FFFFFF; float: left; height: 35px; margin-bottom: 5px; width: 776px; }
        dl, ul, li, ol { list-style: none outside none; margin: 0; padding: 0; }
        .xgmm .main dl dt { float: left; line-height: 35px; text-align: right; width: 100px; }
        .xgmm .main dl dd { float: left; padding-top: 5px; width: 665px; }
        .txi { background: url("<?=config_item('static_url')?>images/onShow.gif") no-repeat scroll 5px 5px transparent; color: #999999; display: inline-block; font-size: 12px; height: 22px;
            line-height: 22px; padding-left: 25px; }
        .input_1 { background: url("<?=config_item('static_url')?>images/input_1.gif") repeat-x scroll 0 0 #FFFFFF; border: 1px solid #C9C9C9; color: #333333; height: 20px; line-height: 20px; vertical-align: top; }
        .mistake { background: url("<?=config_item('static_url')?>images/onError.gif") no-repeat scroll 5px 5px #FFF2E9; color: #E8044F; display: inline-block; font-size: 12px; height: 22px;
            line-height: 22px; padding-left: 25px; }
        .xgmm .main .submit { clear: both; padding: 20px 0 0 86px; }
        .btn_b1 { background: url("<?=config_item('static_url')?>images/btn_b1.gif") no-repeat scroll 0 0 transparent; border: 0 none; color: #FFFFFF; cursor: pointer; display: inline-block;
            font-size: 14px; font-weight: bold; height: 34px; line-height: 34px; padding-right: 10px; width: 118px; }
    </style>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=config_item('static_url')?>">首页</a></li>
      <li><a href="<?=config_item('static_url')?>user/center/index">个人中心</a></li>
      <li class="last">促销信息退订</li>
    </ul>
  </div>
</div>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">促销信息退订</div>
        </div>
        <div class="u-r-box">
            <div class="xgmm">
            <div class="main">
                <h3>退订邮件</h3> <br/><br/>
                <?php if (empty ($data)) {?>
                <dl id="oldpassword_dl">
                    <dt style="font-size: 14px;font-weight: bold;font-size: 11px;color: #707070;">输入邮件地址：</dt>
                    <dd>
                        <input name="email" id="email_id" type="text" class="input_1" style="width:180px;" onblur="checkPassWord()">
                        &nbsp;&nbsp;&nbsp;
                        <input type="button" value="退订" onclick="unsubscribe()">
                    </dd>
                </dl>

                <?php } else {?>
                    <?php
                    foreach ($data as $v) {?>
                    <dl id="oldpassword_dl">
                        <dt style="font-size: 14px;font-weight: bold;font-size: 11px;color: #707070;">邮件地址：</dt>
                        <dd>
                            <input name="email" id="email_id_<?=$v['id'];?>" type="text" class="input_1" style="width:180px;" onblur="checkPassWord()" value="<?=$v['email_addr'];?>">
                            &nbsp;&nbsp;&nbsp;
                            <!--<input type="button" value="退订" onclick="unsubscribe(<?=$v['id'];?>)">-->
                            <img src="<?=config_item('static_url')?>images/unsubscribe.gif" alt="" onclick="unsubscribe(<?=$v['id'];?>)" style="cursor: pointer;" title="退订此邮件地址">

                        </dd>
                    </dl>
                    <?php }?>
                <?php }?>
            </div>
            </div>
        </div>
        <div class="pages" style="float: right;">
        <?php //echo $page_html;?>
        </div>
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/user.js"></SCRIPT>
<script type="text/javascript">
    function unsubscribe(mId)
    {
        var mailId;
        if (wx.isEmpty(mId)) {
            mailId = 'email_id_'+mId;
        } else {
            mailId = 'email_id';
        }

        console.log(mailId);
        var email = document.getElementById(mailId).value;

        if (!wx.isEmpty (email)) {
            alert('邮件地址为空')
            return false;
        }

        if (!wx.isEmail(email)) {
            alert('邮件地址格式错误')
            return false;
        }

        var data = wx.ajax('/business/mailSubscription/unSubscribe', 'mail_address='+email);

        if (data.error == '70008') {
            wx.pageReload(0);
            return true;
        }

        alert('退订失败');
    }
</script>
<!-- #EndLibraryItem -->
</body>
</html>

