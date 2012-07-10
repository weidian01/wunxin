<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>万象网 -- 会员免费注册</title>
    <link href="/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/css/member.css" rel="stylesheet" type="text/css"/>
    <SCRIPT type=text/javascript src="/scripts/jquery.js"></SCRIPT>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="/scripts/iepng.js"></script>
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
<?php include '/../header.php';?>
<div class="tips_box" style="display: none;"><!-- a href="#" class="xclose" title="关闭">关闭</a-->
	<p>提示信息！ <strong id="message_id"></strong></p>
</div>
<div class="box pad9">
    <div class="user-login">
        <div class="regist-lf"><span class="font13">已经是会员？立即登录</span>
            <div class="turn-to-login">
                <a href="/user/login/" title="快速登陆">
                    <img src="/images/lo_03.gif" width="135" height="36" alt="登录"/>
                </a>
            </div>
        </div>
        <form action="/user/register/submit" method="POST" name="register_form">
            <input type="hidden" name="source" value="<?php echo $source ? $source : 1;?>" id="source_id">
            <input type="hidden" name="redirect_url" value="<?php echo $redirect_url;?>" id="redirect_url_id">
            <div class="regist-rgt">
                <div class="reg-tit"><h1>注册新会员</h1></div>
                <table class="tab5" width="93%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="19%" align="right">邮箱：</td>
                        <td width="37%"><label>
                            <input name="username" type="text" class="input5" id="username_id" onblur="user.checkUserExist()" onkeydown="user.checkRegisterIsSubmit(event);"/>
                        </label></td>
                        <td width="44%"><span class="txi" id="username_notice_id">请输入用户名</span></td>
                        <!-- <td width="44%"><span class="mistake">您输入的邮件地址格式不正确</span></td> -->
                    </tr>
                    <tr>
                        <td align="right">密码：</td>
                        <td><input name="password" type="password" class="input5" id="password_id" onblur="user.checkPassWord()" onkeydown="user.checkRegisterIsSubmit(event);"/></td>
                        <td><span class="txi" id="password_notice_id">密码是6位以上的字母或数字</span></td>
                    </tr>
                    <tr>
                        <td align="right">重复密码：</td>
                        <td><input name="repassword" type="password" class="input5" id="repassword_id" onblur="user.checkRePassWord()" onkeydown="user.checkRegisterIsSubmit(event);"/></td>
                        <td><span class="txi" id="repassword_notice_id">请重复输入密码</span></td>
                    </tr>
                    <tr>
                        <td align="right">验证码：</td>
                        <td><input name="verify_code" type="text" class="input5" id="verify_code_id" onblur="user.checkVerifyCode();" onkeydown="user.checkRegisterIsSubmit(event);"/></td>
                        <td><span class="txi" id="verify_code_notice_id">请输入验证码</span></td>
                    </tr>
                    <tr>
                        <td height="72" align="right">&nbsp;</td>
                        <td colspan="2">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="38%">
                                        <img src="/user/register/verifyCode" id="verify_code"/>
                                        <!-- <img src="/user/register/verifyCode" width="146" height="53"/> -->
                                    </td>
                                    <td width="62%">&nbsp;&nbsp;看不清楚？<a href="javascript:void(0);" onclick="user.refreshVerifyCode()">换一张</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">&nbsp;</td>
                        <td colspan="2">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="6%"><input name="agree" type="checkbox" id="agree_id" checked="checked"/>
                                    </td>
                                    <td width="94%"> 我已阅读并同意遵守<a href="#">万象网服务条款</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="40" align="right">&nbsp;</td>
                        <td valign="bottom">
                            <a href="javascript:void(0);" onclick="user.submitRegisterForm()">
                                <img src="/images/register.gif" width="133" height="32" alt="注册为新会员"/>
                            </a>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>
<?php include '/../footer.php';?>
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="/scripts/user.js"></script>
</body>
</html>