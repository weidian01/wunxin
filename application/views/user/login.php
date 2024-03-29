<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>万象网 -- 会员登陆</title>
    <link href="<?=url('static')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=url('static')?>css/member.css" rel="stylesheet" type="text/css"/>
    <SCRIPT type=text/javascript src="<?=url('static')?>scripts/jquery.js"></SCRIPT>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=url('static')?>script/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <script type="text/javascript">
        $(document).ready(function () {
            $(".bankpic").click(function () {
                $(".bankpic").css("border", "1px solid #eee");
                $(this).css("border", "1px solid #a10000");
            });
        });
    </script>
</head>
<body>
<?php include APPPATH.'views/header.php';?>
<div class="tips_box" style="display: none;"><!-- a href="#" class="xclose" title="关闭">关闭</a-->
	<p>提示信息！ <strong id="message_id"></strong></p>
</div>
<div class="box pad9">
    <div class="user-login">
        <form action="/user/login/submit" method="POST" name="login_form">
            <input type="hidden" name="source" value="<?=$source ? $source: 1;?>" id="source_id">
            <input type="hidden" name="redirect_url" value="<?=$redirect_url;?>" id="redirect_url_id">
            <div class="regist-rgt" style="border:0px; border-right:1px solid #eee;">
                <div class="reg-tit"> <h1>会员登录</h1></div>
                <table class="tab5" width="93%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="19%" align="right">用户名：</td>
                        <td width="37%"><label>
                            <input name="username" type="text" class="input5" id="username_id" onblur="user.checkUserName()" maxlength="32" onkeydown="user.checkLoginIsSubmit(event)"/>
                        </label></td>
                        <td width="44%"><span class="txi" id="username_notice_id">请输入用户名</span></td>
                        <!-- <td width="44%"><span class="mistake" id="username_notice_id">请输入用户名</span></td> -->
                    </tr>
                    <tr>
                        <td align="right">密&nbsp;&nbsp;&nbsp;&nbsp;码：</td>
                        <td><input name="password" type="password" class="input5" id="password_id" onblur="user.checkPassWord()" onkeydown="user.checkLoginIsSubmit(event)" maxlength="32"/></td>
                        <td><span class="txi" id="password_notice_id">请输入密码</span></td>
                    </tr>
                    <!--
                    <tr>
                        <td align="right">验证码：</td>
                        <td><input name="textfield3" type="text" class="input5" id="textfield3"/></td>
                        <td><span class="txi">请输入验证</span></td>
                    </tr>
                    <tr>
                        <td height="65" align="right">&nbsp;</td>
                        <td colspan="2">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="38%"><img src="<?=url('static')?>images/rg_12.gif" width="146" height="53"/></td>
                                    <td width="62%">看不清楚？<a href="#">换一张</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    -->
                    <tr>
                        <td align="right">&nbsp;</td>
                        <td colspan="2">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="6%" height="36">
                                        <input name="remember" type="checkbox" id="remember_id" checked="checked"/>
                                    </td>
                                    <td width="94%">记住登录状态</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="40" align="right">&nbsp;</td>
                        <td colspan="2" valign="bottom">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="35%">
                                        <a href="javascript:void(0);" onclick="user.submitLoginForm()">
                                            <img src="<?=url('static')?>images/login.jpg" width="133" height="32" alt="登录"/>
                                        </a>
                                    </td>
                                    <td width="65%">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">找回密码</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--
                <div class="other_login">
                    <h4>其他登陆方式：</h4>
                    <ul>
                        <li><span class="icon_qq"></span><a href="#" style="text-decoration: none;">QQ</a></li>
                        <li><span class="icon_sina"></span><a href="#" style="text-decoration: none;">新浪</a></li>
                        <li><span class="icon_renren"></span><a href="#" style="text-decoration: none;">人人网</a></li>
                        <li><span class="icon_163"></span><a href="#" style="text-decoration: none;">网易</a></li>
                        <li><span class="icon_kx"></span><a href="#" style="text-decoration: none;">开心网</a></li>
                        <li><span class="icon_douban"></span><a href="#" style="text-decoration: none;">豆瓣</a></li>
                    </ul>
                </div>
                -->
            </div>

        </form>

        <div class="login-lef" style="text-align:left"><span class="font13">还不是万象网会员？立即注册</span>

            <p><strong class="font14">为什么要注册？</strong><br/>
                注册后您的个人信息可以永久保存，下次购物后不需要再次输入相同的信息</p>

            <div class="turn-to-regist">
                <a href="<?=url('member')?>user/register" title="免费注册用户">
                    <img src="<?=url('static')?>images/register.jpg" width="173" height="32" alt="注册"/>
                </a>
            </div>
            <div class="tip3">注册只需花费您10秒钟哦</div>
        </div>
    </div>
</div>
<?php include APPPATH.'views/footer.php';?>
<script type="text/javascript" src="<?=url('static')?>scripts/common.js"></script>
<script type="text/javascript" src="<?=url('static')?>scripts/user.js"></script>
</body>
</html>