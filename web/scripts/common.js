/*
* WunXin JavaScript public Library v1.0
*
* Copyright 2012, http://www.wunxin.com
*
* Referrer: jquery library 1.4
* Author: Evan Hou
* Date: 2012.07.04
*/

var wx = {
    'base_url':'http://wunxin.com/',
    'img_url':'http://wunxin.com/upload/',
    'static_url':'http://wunxin.com/',
    'cookie_prefix':'wunxin_',
    'cookie_domain':'wunxin.com',
    'cookie_path':'/'
};

// 获取Cookie
wx.getCookie = function (name)
{
    name = wx.cookie_prefix+name;

    var arrStr = document.cookie.split("; ");

    for (var i = 0; i < arrStr.length; i++) {
        var temp = arrStr[i].split("=");
        if (temp[0] == name) return unescape(temp[1]);
    }

    return null;
}


// 设置Cookie
wx.setCookie = function (name, value, expires)
{
    var secure;
	var today = new Date();
	today.setTime(today.getTime());
	if (expires) {
		expires = expires * 1000 * 60 * 60 * 24;
	}
	var expires_date = new Date(today.getTime() + (expires));
	document.cookie = wx.cookie_prefix+name+'='+escape(value) +
	( ( expires ) ? ';expires='+expires_date.toGMTString() : '' ) + //expires.toGMTString()
	( ( wx.cookie_path ) ? ';path=' + wx.cookie_path : '' ) +
	( ( wx.cookie_domain ) ? ';domain=' + wx.cookie_domain : '' ) +
	( ( secure ) ? ';secure' : '' );
}

// 删除Cookie
wx.deleteCookie = function (name, path, domain)
{
	if (getCookie(name)) document.cookie = wx.cookie_prefix+name + '=' +
	( ( path ) ? ';path=' + path : '') +
	( ( domain ) ? ';domain=' + domain : '' ) +
	';expires=Thu, 01-Jan-1970 00:00:01 GMT';
}

// 删除数组包含某元素，并重新构建索引
wx.arr_del = function (arr, d)
{
	return arr.slice(0,d-1).concat(arr.slice(d));
}

// 数组查找返回索引
wx.arr_find = function (arr, d)
{
	var length = arr.length;
	for (var i = 0; i < length; i++) {
		if (arr[i] == d) {
			return i;
		}
	}
	return -1;
}

/* 是否存在于数组 */
wx.inArray = function (value, array)
{
  for (var i=0; i < array.length; i++) {
      if (array[i] == value) return true;
  }
  return false;
}

//AJAX请求
wx.ajax = function (url, parameter)
{
    var msg;
	$.ajax({
	   type : "POST",
	   url  : wx.base_url+url,
	   async: false,
	   data : parameter,
       dataType:'json',
	   success: function(msgs){
			//eval('('+msgs+')');
           msg = msgs;
	   }
	});
	return msg;
}

wx.jsonp = function(url, param, func)
{
    var result = {};
    $.getJSON(url + "?"+ $.param(param)+"&jsoncallback=?", func);
}

//获取单选框的值
wx.getRadioCheckBoxValue = function (RadioName)
{
	var obj;
	obj=document.getElementsByName(RadioName);
	if(obj!=null){
	    var i;
	    for(i=0;i<obj.length;i++){
	        if(obj[i].checked){
	            //return true;
                return obj[i].value;
	        }
	    }
	}
	return false;
}


//获取当前URL的某个参数值
wx.request = function (paras){
	var url = location.href;
	var paraString = url.substring(url.indexOf("?")+1,url.length).split("&");
	var paraObj = {}
	for (i=0; j=paraString[i]; i++)
	{
		paraObj[j.substring(0,j.indexOf("=")).toLowerCase()] = j.substring(j.indexOf("=")+1,j.length);
	}
	var returnValue = paraObj[paras.toLowerCase()];
	if(typeof(returnValue)=="undefined")
	{
		return "";
	}else{
		return returnValue;
	}
}

//是否为邮件地址
wx.isEmail = function ( str ){
    var myReg = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[A-Za-z0-9]{2,3}$/;

    return myReg.test(str) ? true : false;
}

//判断是否为空
wx.isEmpty = function(content)
{
    return (content == '' || content == undefined) ? false : true;
}

//判断长度
wx.limit_length = function (str, minLength, maxLength)
{
    if (!wx.isEmpty (str)) {
        return false;
    }

    if (!wx.isEmpty (minLength)) {
        minLength = 6;
    }

    if (!wx.isEmpty (maxLength)) {
        maxLength = 32;
    }

    if (str.length < minLength || str.length > maxLength) {
        return false;
    }

    return true;
}

//是否显示全局购物车
wx.cartView = function(elementId, type)
{
    var display = type ? '' : 'none';

    return document.getElementById(elementId).style.display = display;
}

//* 格式化产品价格 数据库中存储的价格为分 $type为获取单位：1 元， 2 角， 3 分*/
wx.fPrice = function (price, type)
{
    var p = parseInt(price);

    switch (type) {
        case 1:  p = ( p / 100 ); break;
        case 2:  p = ( p / 10 ); break;
        case 3:  p = ( p / 1 ); break;
        default: p = ( p / 100 );
    }

    return p;
}

//购物车全局初始化
wx.cartGlobalInit = function ()
{
    var html = '';
    var totalNum = 0;;
    var totalPrice = 0;

    var url = 'cart/getCart';
    var param = '';
    var data = wx.ajax(url, param);

    if (!wx.isEmpty (data)) {
        $('#cart_product_num').html(' '+totalNum+' ');
        $('#cartbox').html('<h4>购物车中还没有商品，赶紧去选购吧！</h4>');
        return false;
    }

    for (var i in data) {
        html += '<div class="cart-bx">';
        html += '<div class="cart-goodsimg"><img src="'+wx.img_url+'product/'+idToPath(data[i].pid)+'icon.jpg" width="50" height="50" alt="'+data[i].pname+'" title="'+data[i].pname+'"/></div>';
        html += '<div class="cart-goodsname"><a href="#">'+data[i].pname+'</a><br/><span class="font5">￥'+(data[i].product_price)+'</span></div>';
        html += '<div class="clear" onclick="cart.deleteCartItem('+i+')"></div>';
        html += '</div>';
        totalPrice += (data[i].product_price * data[i].product_num);
        totalNum += data[i].product_num;
    }

    html += '<div class="cart-hj">';
    html += '<div class="sum">合计：<span class="font3">￥'+totalPrice+'</span></div>';
    html += '<div class="cart-to-js"><a href="/cart/">我要结算</a></div>';
    html += '</div>';
//console.log(html);
    $('#cart_product_num').html(' '+totalNum+' ');
    $('#cartbox').html(html);

    return true;
}

//判断是否为正确的URL
wx.isUrl = function (url)
{
    if (! wx.isEmpty(url)) {
        return false;
    }

    var strRegex = "^((https|http|ftp|rtsp|mms)?://)" + "?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?" //ftp的user@
    + "(([0-9]{1,3}\.){3}[0-9]{1,3}" // IP形式的URL- 199.194.52.184
    + "|" // 允许IP和DOMAIN（域名）
    + "([0-9a-z_!~*'()-]+\.)*" // 域名- www.
    + "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\." // 二级域名
    + "[a-z]{2,6})" // first level domain- .com or .museum
    + "(:[0-9]{1,4})?" // 端口- :80
    + "((/?)|" // a slash isn't required if there is no file name
    + "(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$";
    var re=new RegExp(strRegex);
    if (re.test(url)){
        return true;
     }else{
        return false;
     }
}

//获取来源(referer)地址
wx.getReferer = function ()
{
    var referer = document.referrer;

    return wx.isEmpty(referer) ? referer : wx.base_url;
}

//跳转到上一个页面
wx.goToBack = function ()
{
    var url = wx.getReferer();

    if (wx.isEmpty(url) && wx.isUrl(url)) {
        window.location.href = url;
    }

    return false;
}

//收藏
wx.addFavorite = function (title, url)
{
    title = wx.isEmpty(title) ? title : "万象网,中国最专业的个性化服装电子商务网站, www.wunxin.com";
    url = wx.isEmpty(url) ? url : wx.base_url+"?fav";

	if(window.sidebar) {
		window.sidebar.addPanel(title,url,'');
	} else {
		try{
			window.external.AddFavorite(url,title);
		} catch(e) {
			alert("您的浏览器不支持该功能,请使用Ctrl+D收藏本页");
		}
	}
}
/*
function addToFavorite() {
    var d = "http://www.360buy.com/";
    var c = "京东商城-网购上京东，省钱又放心";
    if (document.all) {
        window.external.AddFavorite(d, c);
    } else {
        if (window.sidebar) {
            window.sidebar.addPanel(c, d, "");
        } else {
            alert("对不起，您的浏览器不支持此操作!\n请您使用菜单栏或Ctrl+D收藏本站。");
        }
    }
}
//*/


//用户是否登陆
wx.isLogin = function ()
{
    var auth = wx.getCookie('auth');

    if (!wx.isEmpty(auth)) {
        return false;
    }

    var url = 'user/login/getUserInfo';
    var data = wx.ajax(url, '');

    if (data.error == '10009') {
        return false;
    }

    if (data.error == '0') {
        return data.user_info;
    }

    return false;
}

//检查登陆状态
wx.checkLoginStatus = function ()
{
    var auth = wx.getCookie('auth');

    if (!wx.isEmpty(auth)) {
        alert ('暂未登陆，请登陆!');
        return false;
    }

    var url = 'user/login/getUserInfo';
    var data = wx.ajax(url, '');

    if (data.error == '10009') {
        alert ('暂未登陆，请登陆!');
        return false;
    }

    if (data.error == '0') {
        return data.user_info;
    }

    alert ('暂未登陆，请登陆!');
    return false;
}

//跳转到某个地址
wx.goToUrl = function (url)
{
    url = wx.base_url+url;

    /*
    if (wx.isUrl(url) ) {
        alert ('不是一个正确的URL地址!');
        return false;
    }
    //*/

    window.location.href = url;
}

//让页面重新加载
wx.pageReload = function (time)
{
    if (time) {
        time = time * 1000;
        setTimeout('window.location.reload()', time);
    } else {
        window.location.reload();
    }
}

//验证手机号码
wx.isMobile = function (value) {
    if (/^13\d{9}$/g.test(value) || (/^15[0-35-9]\d{8}$/g.test(value)) || (/^18[05-9]\d{8}$/g.test(value))) {
        return true;
    } else {
        return false;
    }
}

//判断输入是否为中文
wx.isChinese = function(s) {
    var ret = true;
    for (var i = 0; i < s.length; i++)
        ret = ret && (s.charCodeAt(i) >= 10000);
    return ret;
}

//判断是否登陆，改变页头
wx.initLoginStatus = function ()
{
    var userInfo = wx.isLogin();
    var html = '';

    if (userInfo) {
        html = '<a href="/user/login/login_out" style="color: #AE8D8F;">[退出]</a>';
        $('#user_name_id').html(userInfo.nickname);
        $('#loginout_id').html(html);

        $('#user_info_id').remove();
        $('#user_login_out_id').remove();
    }

}

//计算图片路径
function idToPath(id) {
    var id = String(id);
    var l = id.match(/(\d{1,2})(\d{0,2})/);
    return l[0] + '/' + l[1] + l[2] + '/' + id + '/';
}

//关闭浮层
wx.layerClose = function ()
{
	var list = art.dialog.list;
	for (var i in list) {
		list[i].close();
	};
}

//收藏产品浮层 status 1 收藏成功， 2 已收藏过此产品， 3 收藏此产品不存在, 4 未知错误，系统繁忙
wx.favoriteProductLayer = function(status, bingingId){
    var prompt = '该商品已成功放入收藏夹';
    var promptIcon = (status == '1') ? 'topicon' : 'topicon2';
    switch (status){
        case 1: prompt = '该商品已成功放入收藏夹';break;
        case 2: prompt = '您已经收藏过该商品';break;
        case 3: prompt = '您收藏的商品不存在';break;
        case 4: prompt = '系统繁忙，请稍后再试';break;
    }


	var html = '\<div class="topinfo"> \
        <div class="pop-close" onclick="wx.layerClose()"></div> <span class="'+promptIcon+'"></span>\
        <span class="topicon2" style="display:none;"></span> <p>'+prompt+'&nbsp;&nbsp;&nbsp;\
        <a class="popfont1" href="/user/center/productFavorite">查看收藏夹 >></a></p> </div>\
        <div class="pop-t"> <span class="pop-b">看过该商品的人还购买过</span> <a class="pop-c" href="#">更多您可能喜欢的商品 >></a> </div>\
        <ul class="pop-goods"><li><div class="pop-img" style="text-align:center;width:435px;"><img alt="aaaa" src="/images/loading.gif"></div></li></ul>\
        ';

    if (wx.isEmpty(bingingId)) {
        art.dialog({ follow: document.getElementById(bingingId), title:false, content: html
        });
    } else {
        art.dialog({ title:false, content: html });
    }

    var number = 6;
    var url = '/product/recommend/favoriteRecommend';
    var param = 'number='+number;
    var data = wx.ajax(url, param);

    //console.log(wx.isEmpty(data['data']));
    if (wx.isEmpty(data['data'])) {
        var fData = data['data'];
        var fHtml = '';
        for (var i in fData) {
            fHtml += '<li> <div class="pop-img"> <a href="#">' +
                '<img src="'+wx.static_url+'upload/product/'+idToPath(fData[i].pid)+'icon.jpg" width="60" height="60" title="'+fData[i].pname+', ￥'+( (fData[i].sell_price) / 100 )+'"/></a> ' +
                '</div> <p><a href="#" title="'+fData[i].pname+', ￥'+( (fData[i].sell_price) / 100 )+'">'+fData[i].pname.substring(0,15)+'</a><br/>' +
                '<span class="popfont2" style="font-size: 11px;">￥'+( (fData[i].sell_price) / 100 )+'</span></p></li>';
        }
        $('.pop-goods').html(fHtml);
    }
}

//产品评论浮层
wx.productCommentLayer = function (pId, pNmae)
{
    var html ='<input type="hidden" name="pid" value="'+pId+'" id="pid">\
    <div class="commentDIV"><div class="tit">我要评论<div class="close-cm" onclick="wx.layerClose()"></div></div>\
      <div class="cmt-gname"><strong>商品名称：</strong>'+pNmae+'</div><div class="cmtbox">\
        <dl id="p_s_s"><span id="p_s_s_n">(5分 - 非常满意)</span><input type="hidden" value="5" name="product_score" id="p_s_s_id"/>\
          <dt><strong>商品评分：</strong></dt>\
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_s_s\', 1)"></dd> \
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_s_s\', 2)"></dd> \
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_s_s\', 3)"></dd> \
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_s_s\', 4)"></dd> \
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_s_s\', 5)"></dd>\
        </dl>\
         <dl id="p_e_s"><span id="p_e_s_n">(5分 - 非常满意)</span><input type="hidden" value="5" name="product_exterior" id="p_e_s_id"/>\
          <dt><strong>商品外观：</strong></dt>\
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_e_s\', 1)"></dd>\
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_e_s\', 2)"></dd>\
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_e_s\', 3)"></dd>\
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_e_s\', 4)"></dd>\
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_e_s\', 5)"></dd>\
        </dl>\
         <dl id="p_c_s"><span id="p_c_s_n">(5分 - 非常满意)</span><input type="hidden" value="5" name="product_comfort" id="p_c_s_id"/>\
          <dt><strong>商品舒适度：</strong></dt>\
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_c_s\', 1)"></dd>\
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_c_s\', 2)"></dd>\
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_c_s\', 3)"></dd>\
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_c_s\', 4)"></dd>\
          <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_c_s\', 5)"></dd>\
        </dl></div>\
      <div class="cmtbox"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>\
        <td width="17%" height="28"><strong>尺码偏差：</strong></td>\
        <td width="19%"><input class="bdbox" name="size_deviation" type="radio" value="2" />&nbsp;&nbsp;<label class="bdlabel">偏大</label></td>\
        <td width="20%"><input class="bdbox" name="size_deviation" type="radio" value="1" checked="checked"/>&nbsp;&nbsp;<label class="bdlabel">合适</label></td>\
        <td width="44%"><input class="bdbox" name="size_deviation" type="radio" value="3" />&nbsp;&nbsp;<label class="bdlabel">偏小</label></td></tr>\
    </table></div>\
     <div class="cmtbox"><div class="cmt-title">\
        <strong>评论标题：</strong>&nbsp;&nbsp;&nbsp;<span class="popfont2">*</span>&nbsp;&nbsp;&nbsp;请填写评论标题(5-25字) <br/><input class="popinput1" name="title" type="text" id="title"/></div></div>\
      <div class="cmtbox"><div class="cmt-title">\
        <strong>商品评论：</strong>&nbsp;&nbsp;&nbsp;<span class="popfont2">*</span>&nbsp;&nbsp;&nbsp;请填写评论标题(5-45字) <br/>\
        <textarea class="poparea1" name="content" cols="" rows="" id="content"></textarea></div></div>\
       <div class="cmtbox">\
         <div class="cmt-tip">欢迎您发表原创、商品质量相关、对其它用户有参考价值的商品评论 发表评论可获积分，若评论被置顶还可以获得50个积分！详见积分规则 </div>\
        <div class="cmt-btn"><input name="" type="button" class="cmt-button" value="发表评论" onclick="product.productCommentSubmit(\'c_p_submit_button\')" id="c_p_submit_button"/></div>\
       </div></div>\
       ';

    art.dialog({
        opacity: 0.5,	// 透明度
        padding: 0,
        title: false,
        content: html,
        lock: true
    });
}

//选择评分星星
wx.scoreStatSelect = function (id, pointNum)
{
    //检查评论星级数
    var statLevel = new Array(1,2,3,4,5);
    if (!wx.inArray(pointNum, statLevel)) {
        return false;
    }

    var i = 1;
    $('#'+id+' dd').each(function (){
        if (i <= pointNum) {
            $(this).addClass('pop');
        } else {
            $(this).removeClass('pop');
        }
        i++;
    });

    document.getElementById(id+'_id').value = pointNum;
    //alert(pointNum);
    var prompt = '';
    switch (pointNum){
        case 1:prompt = '(1 分 - 非常不满意)';break;
        case 2:prompt = '(2 分 - 不满意)';break;
        case 3:prompt = '(3 分 - 满意)';break;
        case 4:prompt = '(4 分 - 很满意)';break;
        case 5:prompt = '(5 分 - 非常满意)';break;
    }
    $('#'+id+'_n').html(prompt);
}

//加入购物车浮层 status:1 添加成功， 2 系统繁忙， 3 参数不全
wx.addToCartLayer = function (status, bindingId)
{

}

//登陆浮层
wx.loginLayer = function ()
{
    var html = '\
            <div class="commentDIV" style="width:510px;">\
              <div class="tit" style="padding-left:0px;">\
                <ul class="lgrg">\
                  <li class="curr" id="login_id" onclick="wx.changeLRLayer(\'login\')">登录</li>\
                  <li id="register_id" onclick="wx.changeLRLayer(\'register\')">注册</li>\
                </ul>\
                <div class="close-cm" onclick="wx.layerClose()"></div>\
              </div>\
              <div id="lgrg1">\
                <div class="lgrgbox"><input type="hidden" name="source_id" id="source_id" value="1" />\
                <input type="hidden" name="redirect_url_id" id="redirect_url_id" value="'+window.location.href+'" />\
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">\
                    <tr>\
                      <td width="28%" align="right"><span class="popfont4"><strong style="color:#666666;">用户名：</strong></span></td>\
                      <td width="46%"><label>\
                          <input class="popinput2" type="text" name="username_id" id="username_id" />\
                        </label></td>\
                      <td width="26%" id="username_notice_id" style="color: #C40000;padding-bottom: px;padding-left: 0px;">用户名小于6位或大于32位</td>\
                    </tr>\
                    <tr>\
                      <td align="right"><span class="popfont4"><strong style="color:#666666;">密 码：</strong></span></td>\
                      <td><input class="popinput2" type="password" name="password_id" id="password_id" /></td>\
                      <td id="password_notice_id" style="color: #C40000;padding-bottom: px;padding-left: 0px;">dsadadsa<!--<a href="#">忘记密码了？</a>--></td>\
                    </tr>\
                  </table>\
                  <div class="mistake" id="message_id" ></div>\
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">\
                    <tr>\
                      <td width="28%" align="right">&nbsp;</td>\
                      <td width="22%"><input name="input2" type="button" class="cmt-button" value="登 录 " onclick="user.submitLoginForm()"/></td>\
                      <td width="50%" valign="bottom"><a href="#">新用户注册</a></td>\
                    </tr>\
                  </table>\
                </div>\
                <div class="cmtbox2">\
                  <div class="lgrg-tip"> <span class="popfont3">温馨提示：</span>\
                    <p>1、请输入您的万象用户名及密码进行登录； <br />\
                      2、如果还未注册万象用户名，请您<a onclick="wx.changeLRLayer(\'register\')">注册</a>万象网会员，注册用户成功后将会开始积分和累积消费金额。 <br />\
                      如有疑问请进入<a href="#">帮助中心或联系客服</a></p>\
                  </div><br />\
                </div>\
              </div>\
              <div id="lgrg2" style="display:none;">\
                <table class="zhuce" width="100%" border="0" cellspacing="0" cellpadding="0">\
                  <tr>\
                    <td width="25%" align="right" valign="top"><strong>用&nbsp;户&nbsp;名：</strong></td>\
                    <td width="43%"><input class="popinput2" type="text" name="textfield" id="textfield" />\
                      <br />\
                      <span class="popfont5">请填写有效的Email或手机号</span><span class="mstk" style="display:none;">您输入的Email或手机号有误</span></td>\
                    <td width="32%" valign="top"><span class="rg-yes"></span><span class="rg-no" style="display:none;"></span></td>\
                  </tr>\
                  <tr>\
                    <td align="right" valign="top"><strong style="color:#666666;">登录密码：</strong></td>\
                    <td><input class="popinput2" type="text" name="textfield3" id="textfield3" />\
                      <br />\
                      <span class="mstk">您输入的Email或手机号有误</span></td>\
                    <td valign="top"><span class="rg-yes" style="display:none;"></span><span class="rg-no"></span></td>\
                  </tr>\
                  <tr>\
                    <td align="right" valign="top"><strong style="color:#666666;">确认密码：</strong></td>\
                    <td><input class="popinput2" type="text" name="textfield4" id="textfield4" />\
                      <br />\
                      <span class="mstk">您输入的Email或手机号有误</span></td>\
                    <td valign="top"><span class="rg-yes" style="display:none;"></span><span class="rg-no"></span></td>\
                  </tr>\
                  <tr>\
                    <td align="right" valign="top"><strong style="color:#666666;">验&nbsp;证&nbsp;码：</strong></td>\
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">\
                        <tr>\
                          <td width="40%"><input class="popinput3" type="text" name="textfield5" id="textfield7" />\
                            <br/>\
                            <span class="mstk">请输入验证码</span></td>\
                          <td width="60%" valign="top"><img src="/images/yzm_03.jpg" alt="" width="120" height="21" /><br/>\
                            <span class="mstk">看不请</span><a href="#">，换一张</a></td>\
                        </tr>\
                      </table></td>\
                    <td valign="top"><span class="rg-yes" style="display:none;"></span><span class="rg-no"></span></td>\
                  </tr>\
                  <tr>\
                    <td align="right" valign="top">&nbsp;</td>\
                    <td><strong>请阅读《<a href="#">万象服务条款</a>》 </strong></td>\
                    <td valign="top">&nbsp;</td>\
                  </tr>\
                  <tr>\
                    <td align="right" valign="top">&nbsp;</td>\
                    <td><input name="input2" type="button" class="cmt-button" value="注 册 " /></td>\
                    <td valign="top">&nbsp;</td>\
                  </tr>\
                </table>\
              </div>\
            </div>\
        ';

    art.dialog({
        opacity: 0.5,	// 透明度
        padding: 0,
        title: false,
        content: html,
        lock: true
    });
}

wx.changeLRLayer = function (lr)
{
    if (lr == 'login') {
        $('#login_id').addClass('curr');
        $('#register_id').removeClass('curr');
        document.getElementById('lgrg1').style.display = 'block';
        document.getElementById('lgrg2').style.display = 'none';
    } else {
        $('#register_id').addClass('curr');
        $('#login_id').removeClass('curr');
        document.getElementById('lgrg1').style.display = 'none';
        document.getElementById('lgrg2').style.display = 'block';
    }
}

//产品晒单浮层
wx.productShareLayer = function (pId, pName)
{

}

wx.showPop = function (content, bindingId, timeOut)
{
    var time = timeOut;
    if ( !wx.isEmpty(timeOut)) {
        time = 5;
    }
    art.dialog({ title:false, follow: document.getElementById(bindingId), time: time, content: '<br/><span style="color: #A10000;font-weight: bold;">'+content+'</span><br/>' });
}

wx.productURL = function(pid)
{
    return  wx.base_url + 'product/' + pid;
}

wx.initLoginStatus();

wx.cartGlobalInit();