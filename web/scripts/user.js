/*
* WunXin JavaScript User Library v1.0
*
* Copyright 2012, http://www.wunxin.com
*
* Referrer: jquery library 1.4
* Author: Evan Hou
* Date: 2012.07.04
*/

var user = {oldBoxId : 1};

//用户JS库初始化
user.init = function ()
{
    var userName = wx.getCookie('username');

    userName = ( userName == null ) ? '' : userName;
    //console.log(document.getElementById('username_id'));
    if (document.getElementById('username_id')) {
        document.getElementById('username_id').value = userName;
    }
}

//检测用户名
user.checkUserName = function ()
{
    var userName = document.getElementById('username_id').value;

    $('#username_notice_id').html('');
    $("#username_notice_id").removeClass("mistake");
    $("#username_notice_id").removeClass("txi");

    if (!wx.isEmpty (userName)) {
        $("#username_notice_id").removeClass("txi").addClass("mistake");
        $('#username_notice_id').html('用户名为空！');
        return false;
    }

    if (!wx.limit_length(userName, 6, 32)) {
        $("#username_notice_id").removeClass("txi").addClass("mistake");
        $('#username_notice_id').html('用户名小于6位或大于32位！');
        return false;
    }

    if (!wx.isEmail(userName)) {
        $("#username_notice_id").removeClass("txi").addClass("mistake");
        $('#username_notice_id').html('输入的用户名不为邮件地址！');
        return false;
    }

    //将用户名设置成cookie,以便于刷新页面后不需要重新输入
    wx.setCookie('username', userName, 10000000);

    return userName;
}

//检测密码
user.checkPassWord = function ()
{
    var passWord = document.getElementById('password_id').value;

    $('#password_notice_id').html('');
    $("#password_notice_id").removeClass("mistake");
    $("#password_notice_id").removeClass("txi");

    if (!wx.isEmpty (passWord)) {
        $("#password_notice_id").removeClass("txi").addClass("mistake");
        $('#password_notice_id').html('密码为空！');
        return false;
    }

    if (!wx.limit_length(passWord, 6, 32)) {
        $("#password_notice_id").removeClass("txi").addClass("mistake");
        $('#password_notice_id').html('密码小于6位或大于32位！');
        return false;
    }

    return passWord;
}

user.checkLoginIsSubmit = function (e)
{
    if (e.keyCode == 13) {
        user.submitLoginForm();
    }
}

//提交登陆表单
user.submitLoginForm = function ()
{
    var source = document.getElementById('source_id').value;
    var redirectUrl = document.getElementById('redirect_url_id').value;
    var remember = wx.getRadioCheckBoxValue('remember') ? 1 : 0;

    var userName = '';
    var passWord = '';

    //console.log(remember);return ;

    if ( !(userName = user.checkUserName()) ) return false;
    if ( !(passWord = user.checkPassWord()) ) return false;

    var url = 'user/login/submit';
    var param = 'username='+userName+'&password='+passWord+'&source='+source+'&redirect_url='+redirectUrl+'&remember='+remember;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        wx.goToUrl(data.redirect_url);
        //window.location.href = data.redirect_url;
    }

    $('#message_id').html(data.msg);
    $('.tips_box').fadeIn("slow");
}

//检测重复密码
user.checkRePassWord = function ()
{
    var passWord = document.getElementById('password_id').value;
    var rePassWord = document.getElementById('repassword_id').value;

    var passWord = user.checkPassWord();

    $('#repassword_notice_id').html('');
    $("#repassword_notice_id").removeClass("mistake");
    $("#repassword_notice_id").removeClass("txi");

    if ( ! passWord ) return false;

    if (!wx.isEmpty (rePassWord)) {
        $("#repassword_notice_id").removeClass("txi").addClass("mistake");
        $('#repassword_notice_id').html('确认密码为空！');
        return false;
    }

    if (!wx.limit_length(rePassWord, 6, 32)) {
        $("#repassword_notice_id").removeClass("txi").addClass("mistake");
        $('#repassword_notice_id').html('确认密码小于6位或大于32位！');
        return false;
    }

    if (passWord != rePassWord) {
        $("#repassword_notice_id").removeClass("txi").addClass("mistake");
        $('#repassword_notice_id').html('两个输入密码不一致！');
        return false;
    }

    return rePassWord;
}

//检查验证码
user.checkVerifyCode = function ()
{
    var verifyCodeCookie = wx.getCookie('verify_code');

    var verifyCodePage = document.getElementById('verify_code_id').value;

    $('#verify_code_notice_id').html('');
    $("#verify_code_notice_id").removeClass("mistake");
    $("#verify_code_notice_id").removeClass("txi");

    if (!wx.isEmpty (verifyCodePage)) {
        $("#verify_code_notice_id").removeClass("txi").addClass("mistake");
        $('#verify_code_notice_id').html('验证码为空！');
        return false;
    }

    var status = '';
    var url = '/user/register/checkVerifyCode';
    var param = {"verify_code":verifyCodePage};
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        $("#verify_code_notice_id").removeClass("mistake").addClass("txi");
        $('#verify_code_notice_id').html('输入正确！');
        return verifyCodePage;
    } else {
        $("#verify_code_notice_id").removeClass("txi").addClass("mistake");
        $('#verify_code_notice_id').html('验证码错误！');
        return false;
    }
}

//刷新验证码
user.refreshVerifyCode = function ()
{
    var refresh = document.getElementById("verify_code");
    refresh.src = "/user/register/verifyCode?tempstr=" + Math.random();
}

//检测用户是否存在
user.checkUserExist = function ()
{
    var userName = user.checkUserName();

    if ( ! userName ) return false;

    var url = '/user/register/checkUserName';
    var param = 'username='+userName;
    var data = wx.ajax(url, param);

    var status;
    switch (data.error) {
        case '10001': status = false; break
        case '10002': status = false; break
        case '10035': status = userName; break
    }

    status ? $("#username_notice_id").removeClass("mistake").addClass("txi") : $("#username_notice_id").removeClass("txi").addClass("mistake");

    $('#username_notice_id').html(data.msg);
    return status;

}

//检测注册是否提交
user.checkRegisterIsSubmit = function (e)
{
    if (e.keyCode == 13) {
        user.submitRegisterForm();
    }
}

//注册表单提交
user.submitRegisterForm = function ()
{
    var source = document.getElementById('source_id').value;
    var redirectUrl = document.getElementById('redirect_url_id').value;
    var agree = wx.getRadioCheckBoxValue('agree') ? 1 : 0;

    var userName = user.checkUserName();
    var passWord = user.checkPassWord();
    var rePassWord = user.checkRePassWord();
    var verifyCode = user.checkVerifyCode();
//console.log(verifyCode);
    if (!agree) {
        alert('请同意万象网服务条款');
    }

    if ( ! userName ) return false;
    if ( ! passWord ) return false;
    if ( ! rePassWord ) return false;
    if ( ! verifyCode ) return false;

    var url = 'user/register/submit';
    var param = 'username='+userName+'&password='+passWord+'&repassword='+rePassWord+'&source='+source+'&redirect_url='+redirectUrl+'&verify_code='+verifyCode;
    var data = wx.ajax(url, param);

    $('#message_id').html(data.msg);
    $('.tips_box').fadeIn("slow");

    if (data.error == '0') {
        wx.goToUrl(data.redirect_url);
        //window.location.href = data.redirect_url;
    }
}

//收藏设计师
user.favoriteDesigner = function (uId)
{
    if ( !wx.isEmpty(uId)) {
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'user/designerFavorite/addFavorite';
    var param = 'uid='+uId;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

//删除设计师收藏
user.deleteDesignerFavorite = function(fId)
{
    if (confirm('确定删除设计师收藏！')) {
        if (!wx.isEmpty(fId)) {
            return false;
        }

        if ( !wx.checkLoginStatus() ) {
            return false;
        }

        var url = '/user/designerFavorite/deleteDesignerFavorite';
        var param = 'fid='+fId;
        var data = wx.ajax(url, param);

        if (data.error == '0') {
            wx.pageReload(0);
            return true;
        }

        return data;
    }
}

//清空设计师收藏
user.emptyFavorite = function()
{
    if ( confirm('确定清空所有设计师收藏！') ) {
        if ( !wx.checkLoginStatus() ) {
            return false;
        }

        var url = '/user/designerFavorite/emptyDesignerFavorite';
        var param = '';
        var data = wx.ajax(url, param);

        if (data.error == '10023') {
            wx.pageReload(0);
            return true;
        }

        return data;
    }
}

//设计师留言
user.designerMessage = function (uId, title, content)
{
    if ( !wx.isEmpty(uId) || !wx.isEmpty(title) || !wx.isEmpty(content) ) {
        return false;
    }

    if ( !wx.isLogin() ) {
        return 0;
    }

    var url = 'user/message/add';
    var param = 'be_uid='+uId+'&title='+title+'&content='+content;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

//设计师留言回复
user.designerMessageReply = function (uId, content)
{
    if ( !wx.isEmpty(uId) || !wx.isEmpty(content) ) {
        return false;
    }

    if ( !wx.isLogin() ) {
        return 0;
    }

    var url = 'user/message/messageReply';
    var param = 'message_id='+uId+'&content='+content;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

//删除设计师留言
user.deleteDesignerMessage = function(mId)
{
    if (confirm('确定删除！')) {
        if (!wx.isEmpty(mId)) {
            return false;
        }

        if ( !wx.isLogin() ) {
            return 0;
        }

        var url = '/user/message/delete';
        var param = 'message_id='+mId;
        var data = wx.ajax(url, param);

        if (data.error == '0') {
            wx.pageReload(0);
            return true;
        }

        alert('删除失败!');
    }
}











user.init();