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





























