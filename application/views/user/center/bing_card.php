<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>绑定礼物卡 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/artdialog.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
        body, div, ul, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, pre, input, p, blockquote, th, td, button, blockquote { margin: 0; padding: 0; }
        .xgmm .main {
            /*background: url("<?=config_item('static_url')?>images/k_r_b.png") no-repeat scroll center bottom transparent;*/
            float: left; min-height: 400px; padding: 10px 11px 11px; width: 778px; }
        .xgmm .main dl { border: 1px solid #FFFFFF; float: left; height: 35px; margin-bottom: 5px; width: 776px; }
        dl, ul, li, ol { list-style: none outside none; margin: 0; padding: 0; }
        .xgmm .main dl dt { float: left; line-height: 35px; text-align: right; width: 86px; }
        .xgmm .main dl dd { float: left; padding-top: 5px; width: 665px; }
        .txi { background: url("<?=config_item('static_url')?>images/onShow.png") no-repeat scroll 5px 5px transparent; color: #999999; display: inline-block; font-size: 12px; height: 22px;
            line-height: 22px; padding-left: 25px; }
        .input_1 { background: url("<?=config_item('static_url')?>images/input_1.png") repeat-x scroll 0 0 #FFFFFF; border: 1px solid #C9C9C9; color: #333333; height: 20px; line-height: 20px; vertical-align: top; }
        .mistake { background: url("<?=config_item('static_url')?>images/onError.png") no-repeat scroll 5px 5px #FFF2E9; color: #E8044F; display: inline-block; font-size: 12px; height: 22px;
            line-height: 22px; padding-left: 25px; }
        .xgmm .main .submit { clear: both; padding: 20px 0 0 86px; }
        .btn_b1 { background: url("<?=config_item('static_url')?>images/btn_b2.png") no-repeat scroll 0 0 transparent; border: 0 none; color: #FFFFFF; cursor: pointer; display: inline-block;
            font-size: 14px; font-weight: bold; height: 34px; line-height: 34px; padding-right: 10px; width: 118px; }
    </style>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">绑定礼物卡</div>
        </div>
        <div class="u-r-box">
            <div class="xgmm">
            <div class="main">
                <dl id="oldpassword_dl">
                    <dt>卡号：</dt>
                    <dd>
                        <input name="card_no" id="card_no_id" type="text" class="input_1" style="width:200px;" onblur="checkcardNo()">
                        <span class="txi" id="card_no_notice_id">请输入卡号，请认真填写<!--，<a href="http://www.yohobuy.com/help/?category_id=57">忘记密码？</a>--></span>
                    </dd>
                </dl>
                <dl id="password_dl">
                    <dt>卡密码：</dt>
                    <dd>
                        <input name="card_password" id="card_password_id" type="password" class="input_1" style="width:200px;" onblur="checkCardPassword()">
                        <span class="txi" id="card_password_notice_id">请输入卡密码，密码为6位以上30位以下的数字</span>
                    </dd>
                </dl>
                <div class="submit">
                    <input type="button" value="" class="btn_b1" onclick="bingCard('banding_card_id')" id="banding_card_id">
                    <span id="submit_id" class=""></span>
                </div>
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
    function checkcardNo ()
    {
        var cardNo = document.getElementById('card_no_id').value;

        $('#card_no_notice_id').html('');
        $("#card_no_notice_id").removeClass("mistake");
        $("#card_no_notice_id").removeClass("txi");

        if (!wx.isEmpty (cardNo)) {
            $("#card_no_notice_id").removeClass("txi").addClass("mistake");
            $('#card_no_notice_id').html('卡号为空！');
            return false;
        }

        if (!wx.limit_length(cardNo, 8, 32)) {
            $("#card_no_notice_id").removeClass("txi").addClass("mistake");
            $('#card_no_notice_id').html('卡号小于8位或大于32位！');
            return false;
        }

        return cardNo;
    }

    function checkCardPassword()
    {
        var cardPassword = document.getElementById('card_password_id').value;

        $('#card_password_notice_id').html('');
        $("#card_password_notice_id").removeClass("mistake");
        $("#card_password_notice_id").removeClass("txi");

        if (!wx.isEmpty (cardPassword)) {
            $("#card_password_notice_id").removeClass("txi").addClass("mistake");
            $('#card_password_notice_id').html('密码为空！');
            return false;
        }

        if (!wx.limit_length(cardPassword, 6, 32)) {
            $("#card_password_notice_id").removeClass("txi").addClass("mistake");
            $('#card_password_notice_id').html('密码小于6位或大于32位！');
            return false;
        }

        return cardPassword;
    }

    function bingCard(banding_card_id)
    {
        var cardNo = checkcardNo();
        var cardPassword = checkCardPassword();

        if (!cardNo) { return false; }
        if (!cardPassword) { return false; }

        var url = '/business/giftCard/cardBanding';
        var param = 'card_no='+cardNo+'&card_password='+cardPassword;
        var data = wx.ajax(url, param);

        //$('#submit_id').addClass('mistake');
        //$('#submit_id').html(data.msg);
        wx.showPop(data.msg, banding_card_id, 10)

        if (data.error == '0') {
            wx.goToUrl('/user/center/giftCard');
            return true;
        }
    }
</script>
<!-- #EndLibraryItem -->
</body>
</html>

