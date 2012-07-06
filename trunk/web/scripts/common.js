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
    'img_url':'http://wunxin.com/',
    'static_url':'http://wunxin.com/',
    'cookie_prefix':'wunxin_',
    'cookie_domain':'wunxin.com',
    'cookie_path':'/'
};

// 获取Cookie
/*
wx.getCookie = function (name)
{
    name = wx.cookie_prefix+name;

	var start = document.cookie.indexOf( + "=");console.log(document.cookie);
    //console.log(name.length);
	var len = start + name.length + 1;
	if ((!start) && (name != document.cookie.substring(0, name.length))) {
		return null;
	}

	if (start == -1)
	return null;
	var end = document.cookie.indexOf(';', len);
	if (end == -1)
	end = document.cookie.length;

	return unescape(document.cookie.substring(len, end));
}
//*/

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

/*
wx.setCookie = function (name, value, expires, path, domain, secure)
{
	var today = new Date();
	today.setTime(today.getTime());
	if (expires) {
		expires = expires * 1000 * 60 * 60 * 24;
	}
	var expires_date = new Date(today.getTime() + (expires));
	document.cookie = wx.cookie_prefix+name+'='+escape(value) +
	( ( expires ) ? ';expires='+expires_date.toGMTString() : '' ) + //expires.toGMTString()
	( ( path ) ? ';path=' + path : '' ) +
	( ( domain ) ? ';domain=' + domain : '' ) +
	( ( secure ) ? ';secure' : '' );
}
//*/

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

//AJAX请求
wx.ajax = function (url, parameter)
{
	$.ajax({
	   type : "POST",
	   url  : wx.base_url+url,
	   async: false,
	   data : parameter,
	   success: function(msgs){
			msg = eval('('+msgs+')');
	   }
	});
	return msg;
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
	            return true;
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
function cartView(elementId, type)
{
    var display = type ? '' : 'none';

    return document.getElementById(elementId).style.display = display;
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
        html += '<div class="cart-goodsimg"><img src="'+wx.img_url+'upload/product/'+data[i].product_img+'" width="50" height="50" alt="连衣裙"/></div>';
        html += '<div class="cart-goodsname">'+data[i].pname+'<br/><span class="font5">￥'+data[i].product_price+'</span></div>';
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
        alert ('暂未登陆，请登陆!');
        return false;
    }

    var url = 'user/login/getUserInfo';
    var data = wx.ajax(url, '');

    if (data.error == '10009') {
        return false;
    }

    if (data.error == '10000') {
        return data.user_info;
    }

    return false;
}



















wx.cartGlobalInit();