<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>系统建议与意见 -- 个人中心</title>
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
        .txi { background: url("<?=config_item('static_url')?>images/onShow.gif") no-repeat scroll 5px 5px transparent; color: #999999; display: inline-block; font-size: 12px; height: 22px;
            line-height: 22px; padding-left: 25px; }
        .input_1 { background: url("<?=config_item('static_url')?>images/input_1.gif") repeat-x scroll 0 0 #FFFFFF; border: 1px solid #C9C9C9; color: #333333; height: 20px; line-height: 20px; vertical-align: top;width: 200px; }
        .mistake { background: url("<?=config_item('static_url')?>images/onError.gif") no-repeat scroll 5px 5px #FFF2E9; color: #E8044F; display: inline-block; font-size: 12px; height: 22px;
            line-height: 22px; padding-left: 25px; }
        tr{ padding: 10px;}
        td{font-size: 12px;font-weight: bold;color: #525252;}
        textarea{margin: 0px; width: 509px; height: 169px;border: 1px solid #C9C9C9;background: url('<?=config_item('static_url')?>images/input_1.gif') repeat-x scroll 0 0 #FFFFFF; }
        h3{padding-left: 10px;}
        .s_notice li {padding-left: 30px;font-size: 13px;margin: 10px;}
        .err{font-size: 12px;font-weight:normal;color: #949494;padding-left: 10px;}
    </style>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=config_item('static_url')?>">首页</a></li>
      <li><a href="<?=config_item('static_url')?>user/center/index">个人中心</a></li>
      <li class="last">系统建议与意见</li>
    </ul>
  </div>
</div>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">
              <span style="float:right;text-align: right;">
                    <a style="color: #8B8878;font-size: 12px;" href="<?=config_item('static_url')?>user/center/mySystemProposal">我的建议与意见&nbsp;&nbsp;</a>
                </span>
              系统建议与意见
            </div>
        </div>
        <div class="u-r-box">
            <br/>
            <table width="100%" border="0">
                <tbody>
                <tr>
                    <td align="right"> 姓名： </td>
                    <td> <label> <input type="text" id="uname" name="uname" class="input_1"> </label> </td>
                </tr>
                <tr><td colspan="2"></td> </tr>
                <tr>
                    <td align="right"> 电话： </td>
                    <td> <input type="text" id="phone" name="phone" class="input_1"> <span class="err">请填写电话联系方式，以便于我们在第一时间联系到您</span></td>
                </tr><br/>
                <tr>
                    <td align="right"> <label> </label> Email： </td>
                    <td> <input type="text" id="mail" name="mail" class="input_1"> <span class="err"></span> <span class="" id="mail_notice_id"></span></td>
                </tr>
                <tr><td colspan="2"></td> </tr>
                <tr>
                    <td align="right"> 标题： </td>
                    <td>
                        <input type="text" id="title" name="title" class="input_1" style="width: 350px;">
                    </td>
                </tr>
                <tr>
                    <td align="right"> 内容： </td>
                    <td>
                        <textarea rows="5" cols="45" id="content" name="content"></textarea>
                        <span class="" id="content_notice_id"></span>
                    </td>
                </tr>
                <tr><td colspan="2"></td> </tr>
                <tr>
                    <td align="right">&nbsp;
                        
                    </td>
                    <td>
                        <input id="submit" style="width: auto; height: auto; border: 0pt none;" type="image" src="<?=config_item('static_url')?>images/submit.jpg" onclick="submitSystemProposal()">
                        <h6 id="complain" style="display: none; margin: -23px 0px 0px 255px; ">（您的意见将直接提交到客服经理的邮箱）</h6>
                    </td>
                </tr>
                </tbody>
            </table>
            <br/><br/>
            <h3>温馨提示：</h3>
            <ul class="s_notice">
                <li>1. 请填写正确联系方式，以便我们能第一时间联系到您。</li>
                <li>2. 对于您提供的建议与意见，我们会在第一时间阅读并对此进行响应。</li>
                <li>3. 对提供好的意见，我们会进行相应的物质奖励。</li>
                <li>4. 对于您提供的信息我们将严格保密，不泄漏。而且不会作为宣传推广用途。</li>
            </ul>
            <br/><br/><br/><br/><br/>
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
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/artdialog.js"></SCRIPT>
<script type="text/javascript">
    function submitSystemProposal()
    {
        var uname = document.getElementById('uname').value;
        var phone = document.getElementById('phone').value;
        var mail = document.getElementById('mail').value;
        var title = document.getElementById('title').value;
        var content = document.getElementById('content').value;

        $('#content_notice_id').html('');
        $("#content_notice_id").removeClass("mistake");
        $("#content_notice_id").removeClass("txi");

        if (!wx.isEmpty (content)) {
            $("#content_notice_id").addClass("mistake");
            $('#content_notice_id').html('内容为空,请认真填写内容！');
            return false;
        }

        $('#mail_notice_id').html('');
        $("#mail_notice_id").removeClass("mistake");
        $("#mail_notice_id").removeClass("txi");
        if (wx.isEmpty(mail) && !wx.isEmail(mail)) {
            $("#mail_notice_id").addClass("mistake");
            $('#mail_notice_id').html('邮件地址错误！');
            return false;
        }

        var url = '/other/systemProposal/addSystemProposal';
        var param = 'uname='+uname+'&phone='+phone+'&mail='+mail+'&title='+title+'&content='+content;
        var data = wx.ajax(url, param);

        if (data.error == '0') {
            alert('感谢你提供的建议与意见！ 我们将会认真阅读并响应！');
            wx.goToUrl('/user/center/mySystemProposal');
            return;
        }

        alert(data.msg);
    }
</script>
<!-- #EndLibraryItem -->
</body>
</html>

