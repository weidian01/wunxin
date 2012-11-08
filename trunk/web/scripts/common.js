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

//去两头空格
wx.trim = function (str)
{
    var i;
    for(i=0;i<str.length;i++)
    {
        if(str.charAt(i)!=" "&&str.charAt(i)!=" ")break;
    }
    str=str.substring(i,str.length);
    return str;
}

//去左边空格
wx.lTrim = function (str)
{
    var i;
    for(i=str.length-1;i>=0;i--)
    {
        if(str.charAt(i)!=" "&&str.charAt(i)!=" ")break;
    }
    str=str.substring(0,i+1);
    return str;
}

//去右边空格
wx.rTrim = function (str)
{
    return LTrim(RTrim(str));
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
    $.getJSON(url + "?"+ $.param(param)+"&callback=?", func);
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


function str_repeat(i, m) {
    for (var o = []; m > 0; o[--m] = i);
    return o.join('');
}

function sprintf() {
    var i = 0, a, f = arguments[i++], o = [], m, p, c, x, s = '';
    while (f) {
        if (m = /^[^\x25]+/.exec(f)) {
            o.push(m[0]);
        }
        else if (m = /^\x25{2}/.exec(f)) {
            o.push('%');
        }
        else if (m = /^\x25(?:(\d+)\$)?(\+)?(0|'[^$])?(-)?(\d+)?(?:\.(\d+))?([b-fosuxX])/.exec(f)) {
            if (((a = arguments[m[1] || i++]) == null) || (a == undefined)) {
                throw('Too few arguments.');
            }
            if (/[^s]/.test(m[7]) && (typeof(a) != 'number')) {
                throw('Expecting number but found ' + typeof(a));
            }
            switch (m[7]) {
                case 'b':
                    a = a.toString(2);
                    break;
                case 'c':
                    a = String.fromCharCode(a);
                    break;
                case 'd':
                    a = parseInt(a);
                    break;
                case 'e':
                    a = m[6] ? a.toExponential(m[6]) : a.toExponential();
                    break;
                case 'f':
                    a = m[6] ? parseFloat(a).toFixed(m[6]) : parseFloat(a);
                    break;
                case 'o':
                    a = a.toString(8);
                    break;
                case 's':
                    a = ((a = String(a)) && m[6] ? a.substring(0, m[6]) : a);
                    break;
                case 'u':
                    a = Math.abs(a);
                    break;
                case 'x':
                    a = a.toString(16);
                    break;
                case 'X':
                    a = a.toString(16).toUpperCase();
                    break;
            }
            a = (/[def]/.test(m[7]) && m[2] && a >= 0 ? '+' + a : a);
            c = m[3] ? m[3] == '0' ? '0' : m[3].charAt(1) : ' ';
            x = m[5] - String(a).length - s.length;
            p = m[5] ? str_repeat(c, x) : '';
            o.push(s + (m[4] ? a + p : p + a));
        }
        else {
            throw('Huh ?!');
        }
        f = f.substring(m[0].length);
    }
    return o.join('');
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

    return sprintf('%.2f', p);
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
//console.log(data);
    data = data['cart'];
    if (!wx.isEmpty (data)) {
        $('#cart_product_num').html(' '+totalNum+' ');
        $('#cartbox').html('<h4>购物车中还没有商品，赶紧去选购吧！</h4>');
        return false;
    }

    for (var i in data) {
        html += '<div class="cart-bx">';
        html += '<div class="cart-goodsimg"><a href="'+wx.productURL(data[i].pid)+'" target="_blank">' +
            '<img src="'+wx.img_url+'product/'+idToPath(data[i].pid)+'icon.jpg" width="50" height="50" alt="'+data[i].pname+'" title="'+data[i].pname+'"/></a></div>';
        html += '<div class="cart-goodsname"><a href="'+wx.productURL(data[i].pid)+'" title="'+data[i].pname+'" target="_blank">'+data[i].pname.substring(0,25)+'</a><br/>' +
            '<span class="font5">￥'+wx.fPrice(data[i].final_price)+'</span>';
        html += '<span> &nbsp;&nbsp;&nbsp; 数量：'+parseInt(data[i].num)+'</span>';
        html += '</div><div class="clear" onclick="cart.deleteCartItem('+i+')"></div>';
        html += '</div>';
        totalPrice += (parseInt(data[i].final_price) * parseInt(data[i].num));
        totalNum += parseInt(data[i].num);
    }

    html += '<div class="cart-hj">';
    html += '<div class="sum">合计：<span class="font3">￥'+wx.fPrice( totalPrice )+'</span></div>';
    html += '<div class="cart-to-js"><a href="'+wx.static_url+'cart/"><b>我要结算</b></a></div>';
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
    //+ "([0-9a-z_!~*'()-]+\.)*" // 域名- www.
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

//设为首页
wx.setHomepage = function () {
    if (document.all) {
        document.body.style.behavior = 'url(#default#homepage)';
        document.body.setHomePage('http://www.wunxin.com');
    } else if (window.sidebar) {
        if (window.netscape) {
            try {
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
            }
            catch (e) {
                alert("该操作被浏览器拒绝，如果想启用该功能，请在地址栏内输入 about:config,然后将项 signed.applets.codebase_principal_support 值该为true");
            }
        }
        var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
        prefs.setCharPref('browser.startup.homepage', 'http://www.wunxin.com');
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
        wx.loginLayer();
        return false;
    }

    var url = 'user/login/getUserInfo';
    var data = wx.ajax(url, '');

    if (data.error == '10009') {
        wx.loginLayer();
        return false;
    }

    if (data.error == '0') {
        return data.user_info;
    }

    wx.loginLayer();
    return false;
}

//跳转到某个地址
wx.goToUrl = function (url)
{
    //url = wx.base_url+url;

    url = url.split('#');
    url = url[0];
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
        html = '<a href="'+wx.static_url+'user/login/login_out" style="color: #AE8D8F;">[退出]</a>';
        $('#user_name_id').html(userInfo.nickname);
        $('#loginout_id').html(html);

        $('#user_info_id').remove();
        $('#user_login_out_id').remove();
    }

}

//计算图片路径
function idToPath(id) {
    if( (typeof id) == 'undefined' || id == 'undefined' || id == '') return '#';
    //alert('开始');alert(typeof id);alert(id)
    var id = String(id);//alert(id);
    var l = id.match(/(\d{1,2})(\d{0,2})/);
    //alert(typeof id);alert(id);alert(l);
    return l[1] + '/' + l[1] + l[2] + '/' + id + '/';
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
wx.favoriteProductLayer = function(status, bindingId){
    var prompt = '该商品已成功放入收藏夹';
    var promptIcon = (status == '1') ? 'topicon' : 'topicon2';
    switch (status){
        case 1: prompt = '该商品已成功放入收藏夹';break;
        case 2: prompt = '您已经收藏过该商品';break;
        case 3: prompt = '您收藏的商品不存在';break;
        case 4: prompt = '系统繁忙，请稍后再试';break;
    }

	var html = '\<div class="topinfo"><div class="pop-close" onclick="wx.layerClose()"></div> <span class="'+promptIcon+'"></span><span class="topicon2" style="display:none;"></span><p>'+prompt+
     '&nbsp;&nbsp;&nbsp;<a class="popfont1" href="'+wx.static_url+'user/center/productFavorite" target="_blank">查看收藏夹 >></a></p></div><div class="pop-t"><span class="pop-b">看过该商品的人还购买过</span>\
     &nbsp;&nbsp;&nbsp;&nbsp;<a class="pop-c" href="'+wx.static_url+'" target="_blank"> 更多您可能喜欢的商品 >></a> </div><ul class="pop-goods"><li><div class="pop-img" style="text-align:center;width:435px;">\
     <img alt="aaaa" src="'+wx.static_url+'images/loading.gif"></div></li></ul>';

    art.dialog({ follow: document.getElementById(bindingId), title:false, content: html });

    var number = 5;
    var url = '/product/recommend/favoriteRecommend';
    var param = 'number='+number;
    var data = wx.ajax(url, param);

    //console.log(wx.isEmpty(data['data']));
    if (wx.isEmpty(data['data'])) {
        var fData = data['data'];
        var fHtml = '';
        for (var i in fData) {
            fHtml += '<li><div class="pop-img"><a href="'+wx.productURL(fData[i].pid)+'" target="_blank">\
              <img src="'+wx.static_url+'upload/product/'+idToPath(fData[i].pid)+'icon.jpg" width="70" height="84" title="'+fData[i].pname+', ￥'+wx.fPrice(fData[i].sell_price)+'"/></a>\
              </div> <p><a href="'+wx.productURL(fData[i].pid)+'" title="'+fData[i].pname+', ￥'+wx.fPrice(fData[i].sell_price)+'" target="_blank">'+fData[i].pname.substring(0,15)+'</a><br/>\
              <span class="popfont2" style="font-size: 11px;">￥'+wx.fPrice(fData[i].sell_price)+'</span></p></li>';
        }
        $('.pop-goods').html(fHtml);
    }
}

//产品评论浮层
wx.productCommentLayer = function (pId, pNmae)
{
    var html ='<input type="hidden" name="pid" value="'+pId+'" id="pid"> <div class="commentDIV"><div class="tit">我要评论<div class="close-cm" onclick="wx.layerClose()"></div></div>\
    <div class="cmt-gname"><strong>商品名称：</strong>'+pNmae.substring(0, 80)+'</div><div class="cmtbox"> <dl id="p_s_s"><span id="p_s_s_n">(5分 - 非常满意)</span>\
    <input type="hidden" value="5" name="product_score" id="p_s_s_id"/><dt><strong>商品评分：</strong></dt> <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_s_s\', 1)"></dd> \
    <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_s_s\', 2)"></dd> <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_s_s\', 3)"></dd>\
    <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_s_s\', 4)"></dd> <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_s_s\', 5)"></dd></dl>\
    <dl id="p_e_s"><span id="p_e_s_n">(5分 - 非常满意)</span><input type="hidden" value="5" name="product_exterior" id="p_e_s_id"/>\
    <dt><strong>商品外观：</strong></dt> <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_e_s\', 1)"></dd> <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_e_s\', 2)"></dd>\
    <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_e_s\', 3)"></dd> <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_e_s\', 4)"></dd>\
    <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_e_s\', 5)"></dd> </dl>\
    <dl id="p_c_s"><span id="p_c_s_n">(5分 - 非常满意)</span><input type="hidden" value="5" name="product_comfort" id="p_c_s_id"/>\
    <dt><strong>商品舒适度：</strong></dt> <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_c_s\', 1)"></dd>\
    <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_c_s\', 2)"></dd> <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_c_s\', 3)"></dd>\
    <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_c_s\', 4)"></dd> <dd class="pop" onmouseover="wx.scoreStatSelect(\'p_c_s\', 5)"></dd> </dl></div>\
    <div class="cmtbox"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="17%" height="28"><strong>尺码偏差：</strong></td>\
        <td width="19%"><input class="bdbox" name="size_deviation" type="radio" value="2" />&nbsp;&nbsp;<label class="bdlabel">偏大</label></td>\
        <td width="20%"><input class="bdbox" name="size_deviation" type="radio" value="1" checked="checked"/>&nbsp;&nbsp;<label class="bdlabel">合适</label></td>\
        <td width="44%"><input class="bdbox" name="size_deviation" type="radio" value="3" />&nbsp;&nbsp;<label class="bdlabel">偏小</label></td></tr>\
    </table></div><div class="cmtbox"><div class="cmt-title">\
    <strong>评论标题：</strong>&nbsp;&nbsp;&nbsp;<span class="popfont2">*</span>&nbsp;&nbsp;&nbsp;请填写评论标题(5-25字) <br/><input class="popinput1" name="title" type="text" id="title"/></div></div>\
    <div class="cmtbox"><div class="cmt-title"><strong>商品评论：</strong>&nbsp;&nbsp;&nbsp;<span class="popfont2">*</span>&nbsp;&nbsp;&nbsp;请填写评论标题(5-45字) <br/>\
    <textarea class="poparea1" name="content" cols="" rows="" id="content"></textarea></div></div><div class="cmtbox">\
    <div class="cmt-tip">欢迎您发表原创、商品质量相关、对其它用户有参考价值的商品评论 发表评论可获积分，若评论被置顶还可以获得50个积分！详见积分规则 </div>\
    <div class="cmt-btn"><input name="" type="button" class="cmt-button" value="发表评论" onclick="product.productCommentSubmit(\'c_p_submit_button\')" id="c_p_submit_button"/></div></div></div>';

    art.dialog({ opacity: 0.5, padding: 0, title: false, content: html, lock: true });
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
wx.addToCartLayer = function (pId, pName, bindingId)
{
    var cartData = wx.ajax('cart/getCart', '');
    cartData = cartData['cart'];

    var totalNum = 0;
    var totalPrice = 0;
//console.log(cartData.length);
    for (var ci in cartData) {
        totalNum += cartData[ci]['num'];
        totalPrice += cartData[ci]['final_price'] * cartData[ci]['num'];
    }

    var html = '<div class="commentDIV"> <div class="tit">商品已成功加入购物车 <div class="close-cm" onclick="wx.layerClose()"></div> </div> <div class="addto-goods">\
       <div class="p-img-g"><a href="'+wx.productURL(pId)+'" target="_blank"><img src="'+wx.img_url+'product/'+idToPath(pId)+'default.jpg" width="109" height="109" /></a></div> <div class="p-cont-g">\
       <p><a href="'+wx.productURL(pId)+'" target="_blank">'+pName+'</a></p><div class="p-cont-price">购物车共 '+parseInt(totalNum)+' 件宝贝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合计：<span class="popfont3">'+wx.fPrice(totalPrice)+'</span>元</div>\
       <div class="p-cont-btn"> <a class="goshopping" href="javascript:void(0);" onclick="wx.layerClose()">继续购物</a><a class="gocash" href="'+wx.static_url+'cart/">去结算</a> </div></div></div>\
       <div class="pop-t" style="padding-top:20px;"><span class="pop-b">看过该商品的人还购买过</span><a class="pop-c" href="'+wx.static_url+'">更多您可能喜欢的商品 >></a></div>\
       <ul class="pop-goods" style="padding:0px 0px 20px 20px;" id="pop-goods">\
       <li><div class="pop-img" style="text-align:center;width:435px;"><img alt="aaaa" src="'+wx.static_url+'images/loading.gif"></div></li></ul></div>';

    art.dialog({ follow: document.getElementById(bindingId), title:false, content: html,padding:0 });

    var number = 5;
    var url = '/product/recommend/getSalesRecommend';
    var param = 'number='+number;
    var data = wx.ajax(url, param);

    if (wx.isEmpty(data['data'])) {
        var fData = data['data'];
        var fHtml = '';
        for (var i in fData) {
            fHtml += '<li><div class="pop-img"><a href="'+wx.productURL(fData[i].pid)+'" target="_blank">' +
                '<img src="'+wx.static_url+'upload/product/'+idToPath(fData[i].pid)+'icon.jpg" width="70" height="84" alt="aaaa" /></a></div>\
              <p><a href="'+wx.productURL(fData[i].pid)+'" title="'+fData[i].pname+', ￥'+wx.fPrice(fData[i].sell_price)+'" target="_blank">'+fData[i].pname.substring(0,15)+'</a></p>\
              <span class="popfont2">售价￥'+wx.fPrice(fData[i].sell_price)+'</span></li>';
        }
        $('.pop-goods').html(fHtml);
    }
}

//登陆浮层
wx.loginLayer = function ()
{
    var html = '<div class="commentDIV" style="width:510px;"> <div class="tit" style="padding-left:0px;"> <ul class="lgrg"> <li class="curr" id="login_id" onclick="wx.changeLRLayer(\'login\')">登录</li>\
     <li id="register_id" onclick="wx.changeLRLayer(\'register\')">注册</li> </ul> <div class="close-cm" onclick="wx.layerClose()"></div> </div> <div id="switch_id"> </div> </div>';

    art.dialog({ opacity: 0.5, padding: 0, title: false, content: html, lock: true });

    wx.changeLRLayer('login');
}

//改变登陆与注册的层
wx.changeLRLayer = function (lr)
{
    var userName = wx.getCookie('username');
    userName = ( userName == null ) ? '' : userName;

    if (lr == 'login') {
        $('#login_id').addClass('curr');
        $('#register_id').removeClass('curr');

        var Html = '<div id="lgrg1"> <div class="lgrgbox"><input type="hidden" name="source_id" id="source_id" value="1" />\
            <input type="hidden" name="redirect_url_id" id="redirect_url_id" value="'+window.location.href+'" /> <table width="100%" border="0" cellspacing="0" cellpadding="0">\
                <tr> <td width="28%" align="right"><span class="popfont4"><strong style="color:#666666;">用户名：</strong></span></td>\
                  <td width="46%"><label><input class="popinput2" type="text" name="username_id" id="username_id" onblur="user.checkUserName()" maxlength="32" value="'+userName+'"/></label></td>\
                  <td width="26%"></td> </tr> <tr> <td align="right"><span class="popfont4"><strong style="color:#666666;">密 码：</strong></span></td>\
                  <td><input class="popinput2" type="password" name="password_id" id="password_id" onkeydown="user.checkLoginIsSubmit(event)" onblur="user.checkPassWord()" maxlength="32"/></td>\
                  <td><!--<a href="#">忘记密码了？</a>--></td> </tr> </table>\
              <span class="mistake" id="username_notice_id" style="color: #C40000;padding-bottom: px;padding-left: 0px;font-size:12px;padding-left:140px;"></span>\
              <span class="mistake" id="password_notice_id" style="color: #C40000;padding-bottom: px;padding-left: 0px;font-size:12px;"></span>\
              <span class="mistake" id="message_id" style="color: #C40000;padding-bottom: px;padding-left: 0px;font-size:12px;"></span>\
              <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td width="28%" align="right">&nbsp;</td>\
                  <td width="22%"><input name="input2" type="button" class="cmt-button" value="登 录 " onclick="user.submitLoginForm()"/></td>\
                  <td width="50%" valign="bottom"><a href="javascript:void(0);" onclick="wx.changeLRLayer(\'register\')">新用户注册</a></td> </tr> </table>\
            </div>\
            <div class="cmtbox2"> <div class="lgrg-tip"> <span class="popfont3">温馨提示：</span>\
            <p>1、请输入您的万象用户名及密码进行登录； <br /> 2、如果还未注册万象用户名，请您<a onclick="wx.changeLRLayer(\'register\')">注册</a>万象网会员，注册用户成功后将会开始积分和累积消费金额。 <br />\
              如有疑问请进入<a href="#">帮助中心或联系客服</a></p> </div><br /></div></div> ';
    } else {
        $('#register_id').addClass('curr');
        $('#login_id').removeClass('curr');

        var Html = '<div id="lgrg2""><input type="hidden" name="source_id" id="source_id" value="1" /> <input type="hidden" name="redirect_url_id" id="redirect_url_id" value="'+wx.base_url+'user/login/" />\
                <table class="zhuce" width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td width="25%" align="right" valign="top"><strong>用&nbsp;户&nbsp;名：</strong></td>\
                    <td width="43%"> <input class="popinput2" type="text" name="username_id" id="username_id"  onkeydown="user.checkRegisterIsSubmit(event);" onblur="user.checkUserExist()" maxlength="32" value="'+userName+'"/>\
                      <br /> <span class="popfont5" id="username_notice_id" style="padding-bottom: px;padding-left: 0px;font-size:12px;">请输入邮件地址</span> </td>\
                    <td width="32%" valign="top"><!--<span class="rg-yes"></span><span class="rg-no" style="display:none;"></span>--></td> </tr> <tr>\
                    <td align="right" valign="top"><strong style="color:#666666;">登录密码：</strong></td>\
                    <td><input class="popinput2" type="password" name="password_id" id="password_id" onkeydown="user.checkLoginIsSubmit(event)" onblur="user.checkPassWord()" maxlength="32"/> <br />\
                      <span class="popfont5" id="password_notice_id" style="padding-bottom: px;padding-left: 0px;font-size:12px;">请输入密码</span></td>\
                    <td valign="top"><!--<span class="rg-yes" style="display:none;"></span><span class="rg-no"></span>--></td> </tr> <tr>\
                    <td align="right" valign="top"><strong style="color:#666666;">确认密码：</strong></td>\
                    <td><input class="popinput2" type="password" name="repassword_id" id="repassword_id"  onkeydown="user.checkRegisterIsSubmit(event);" onblur="user.checkRePassWord()" /> <br />\
                      <span class="txi" id="repassword_notice_id" style="padding-bottom: px;padding-left: 0px;font-size:12px;">请输入密码</span></td>\
                    <td valign="top"><!--<span class="rg-yes" style="display:none;"></span><span class="rg-no"></span>--></td> </tr>\
                  <tr> <td align="right" valign="top"><strong style="color:#666666;">验&nbsp;证&nbsp;码：</strong></td> <td><table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr>\
                  <td width="40%"> <input class="popinput3" type="text" name="verify_code" id="verify_code_id" onkeydown="user.checkRegisterIsSubmit(event);" onblur="user.checkVerifyCode();"/>\
                            <br/><span class="" id="verify_code_notice_id" style="color: #C40000;padding-bottom: px;padding-left: 0px;font-size:12px;">请输入验证码</span></td>\
                          <td width="60%" valign="top"><img src="'+wx.base_url+'user/register/verifyCode" alt="" id="verify_code" onclick="user.refreshVerifyCode()"/><br/>\
                            <span class="mstk">看不请，</span><a onclick="user.refreshVerifyCode()" href="javascript:void(0);">换一张</a></td> </tr> </table></td>\
                    <td valign="top"><!--<span class="rg-yes" style="display:none;"></span><span class="rg-no"></span>--></td> </tr>\
                  <tr> <td align="right" valign="top">&nbsp;</td> <td><input id="agree_id" type="checkbox" checked="checked" name="agree"><strong>请阅读《<!--<a href="#">-->万象服务条款<!--</a>-->》 </strong></td>\
                    <td valign="top">&nbsp;</td> </tr>\
                  <tr> <td align="right" valign="top">&nbsp;</td> <td><input name="input2" type="button" class="cmt-button" value="注 册 "  onclick="user.submitRegisterForm()"/></td>\
                    <td valign="top">&nbsp;</td> </tr> </table> </div> ';
    }

    $('#switch_id').html(Html);
}

//产品晒单浮层
wx.productShareLayer = function (pId)
{
    var data = wx.ajax('/product/share/getUserShareProduct', '');

    if ( !wx.isEmpty(data['data']) ) {
        wx.showPop('没有可以晒单的产品');
        return false;
    }

    var pHtml = '';
    var pData = data['data'];
    for (var i in pData) {//console.log(pData[i]);
        pHtml += '<dl onmouseover="wx.shareProductLayerBackground(this)" onclick="wx.selectShareProduct('+pData[i].pid+', \''+pData[i].pname.substring(0, 40)+'\')"><dt>\
            <img src="'+wx.static_url+'upload/product/'+idToPath(pData[i].pid)+'icon.jpg" width="43" height="43"/></dt><dd>'+pData[i].pname.substring(0, 40)+'</dd></dl>';
    }
    //console.log(data);

    var html = '<form action="'+wx.base_url+'product/share/add" method="post"  enctype="multipart/form-data" name="product_share_form">\
        <div class="commentDIV show-o-w"> <div class="tit">发表晒单 <div class="close-cm" onclick="wx.layerClose()"></div> </div> <div class="questbox">\
        <input type="hidden" name="pid" id="curr_share_product_id" value="'+pData[0].pid+'"/>\
        <table class="queat-ms2" width="100%" border="0" cellspacing="0" cellpadding="0">\
        <tr><td align="right" valign="top"><strong>晒单商品</strong> <span class="popfont2">*</span></td>\
        <td><div class="show-goods" onmouseover="wx.shareProductLayer(1)" onmouseout="wx.shareProductLayer(0)"><span id="curr_share_product_name">'+pData[0].pname.substring(0, 40)+'</span>\
        <div class="show-goods-box" style="display:none;" id="show_goods_box">'+pHtml+'<div class="more-sdgoods"><!--<a href="#">查看更多晒单商品 >></a>--></div></div> </div> \
        订单完成后所购商品才能晒单，每个商品只可晒单一次</td> </tr> <tr> <td width="17%" align="right" valign="top"><strong>标题</strong> <span class="popfont2">*</span></td>\
        <td width="83%"><input name="title" type="text" class="popinput1" id="share_title_id" /> <span class="popfont2">请输入5或50个字符</span></td> </tr> <tr>\
        <td align="right" valign="top"><strong>内容</strong> <span class="popfont2">*</span></td> <td><textarea name="content" cols="45" rows="5" class="poparea1" id="share_content_id"></textarea>\
        <div class="word-num"> <div class="word-num-w">请输入5或80个字符</div> <!--<div class="word-num-tip">还能输入10000个字符</div>--> </div></td> </tr>\
        <tr> <td align="right" valign="top"><strong>上传图片</strong> <span class="popfont2">*</span></td> <td><table width="100%" border="0" cellspacing="0" cellpadding="0">\
        <tr> <td width="19%" valign="top"><input class="upload-btnp" type="file" name="images[]" id="share_file_id" value="上传"  multiple=""/> </td></tr>\
        <tr><td width="81%" style="text-align: left;">请上传3-10张图片，每张图片不超过4M，支持的图片格式为 jpg，png，gif；可一次上传多张；</td> </tr> </table></td> </tr>\
        </table> <div class="post-q-btn" style="text-align: center;"> \
        <input id="submit_share_product" type="button" class="pop-btn" value="提交问题" onclick="product.productShareSubmit(\'submit_share_product\')"/> </div> </div>\
        <div class="cmtbox2" style="padding-left:20px;"> <div class="lgrg-tip"> <span class="popfont3">温馨提示：</span>\
        <p>·您可以将自己的使用感受、选购建议、实物照片、使用场景、拆包过程等与网友们分享； <br /> ·每个商品前5位成功晒单者且图片数在3张及以上的客户可获得10个积分奖励；\
          ·请保证所上传的图片是原创的及合法的，否则万象有权删除图片； <br /> </p> </div> </div></div> </form>';

    art.dialog({ opacity: 0.5, padding: 0, title: false, content: html, lock: true });
}

//显示晒单浮层上的选择层
wx.shareProductLayer = function (t)
{
    var status =  (t == 1) ? 'block' : 'none';

    document.getElementById('show_goods_box').style.display = status;
}

//改变晒单浮层上选择层的背景色等
wx.shareProductLayerBackground = function (t)
{
    $('#show_goods_box dl').each(function (){
        $(this).css('background-color', '');
    });

    $(t).css('background-color', '#C4C4C4');
}

//在晒单浮层上 选择在进行晒单的产品
wx.selectShareProduct = function (pId, pName)
{
    if ( !wx.isEmpty(pId) || !wx.isEmpty(pName) ) {
        return false;
    }

    document.getElementById('curr_share_product_id').value = pId;
    $('#curr_share_product_name').html(pName);
    document.getElementById('show_goods_box').style.display = 'none';
}

wx.productQaLayer = function (data)
{
    var html = '<input type="hidden" name="pid" value="'+data.pid+'" id="pid_id"/><div class="commentDIV"> <div class="tit">我的提问 <div class="close-cm" onclick="wx.layerClose()"></div> </div>\
      <div class="addto-goods" style="padding-bottom:5px;">\
        <div class="p-img-g"><img src="'+wx.static_url+'upload/product/'+idToPath(data.pid)+'icon.jpg" width="109" height="109" /></div>\
        <div class="p-cont-g2">\
          <a href="#"><strong>'+data.pname.substring(0, 50)+'</strong></a><br />\
          售价：<span class="popfont6">'+wx.fPrice(data.sell_price)+'</span> 元<br />\
          提问数量：<span class="popfont6">'+data.qa_num+'</span> 条\
          <div class="p-cont-pf">\
            <!--<div class="p-pf-text">商品评分：</div>\
            <div class="p-cont-star"><span class="p-star-full"></span><span class="p-star-full"></span><span class="p-star-full"></span><span class="p-star-full"></span><span class="p-star-emp"></span></div>\
            <div class="p-pf-text"><span class="popfont6">4.2分</span>&nbsp;<a href="#">(12条评论)</a></div>-->\
          </div>\
        </div>\
      </div>\
      <div class="questbox">\
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:8px;">\
      <tr>\
        <td width="17%" height="28"><strong>提问类型</strong>*</td>\
        <td width="19%"><input class="bdbox" name="q_type" type="radio" value="1" checked="checked"/> <label class="bdlabel">尺码问题</label></td>\
        <td width="20%"><input class="bdbox" name="q_type" type="radio" value="2" />&nbsp;<label class="bdlabel">颜色问题</label> </td>\
        <td width="22%"><input class="bdbox" name="q_type" type="radio" value="3" />&nbsp;<label class="bdlabel">商品材质</label></td>\
        <td width="22%"><input class="bdbox" name="q_type" type="radio" value="4" />&nbsp;<label class="bdlabel">其他</label></td>\
      </tr>\
    </table>\
    <table class="queat-ms" width="100%" border="0" cellspacing="0" cellpadding="0">\
      <tr>\
        <td width="16%" valign="top"><strong>您的问题</strong></td>\
        <td width="84%">\
          <input name="textfield" type="text" class="popinput4" id="title_id" /><br />\
          <span class="popfont2">请输入5至50个字符</span></td>\
      </tr>\
      <tr>\
        <td valign="top"><strong>问题描述</strong><span class="popfont2">*</span></td>\
        <td>\
          <textarea name="textarea" cols="45" rows="5" class="poparea2" id="content_id"></textarea><br />\
          <span class="popfont2">请输入5至100个字符</span></td>\
      </tr>\
    </table>\
    <div class="post-q-btn"><input name="" type="button" class="pop-btn" value="提交问题" onclick="product.addProductQaSubmit(\'qa_submit_button\')" id="qa_submit_button"/></div>\
    </div>\
    </div>';

    art.dialog({ opacity: 0.5, padding: 0, title: false, content: html, lock: true });
}

//弹出提示框
wx.showPop = function (content, bindingId, timeOut)
{
    var time = timeOut;
    if ( !wx.isEmpty(timeOut)) {
        time = 3;
    }
    art.dialog({ title:false, follow: document.getElementById(bindingId), time: time, content: '<br/><span style="color: #A10000;font-weight: bold;">'+content+'</span><br/>' });
}

//产品链接
wx.productURL = function(pid)
{
    return  wx.base_url + 'product/' + pid;
}

wx.initLoginStatus();

wx.cartGlobalInit();

/*右侧浮层菜单开始*/
function sideToolsAct() {
    var u = $("#sideTools");
    var q = $(window).height();
    var n = u.height();
    var y = u.find(".stMore");
    var t = u.find(".miniNav a");

    var w = u.find(".stMoreClose");
    var r = false;
    var o;
    var x = !!window.ActiveXObject;
    var v = x && !window.XMLHttpRequest;
    u.css({top:(q - n) / 2 + "px"});
    u.removeClass("hide");
    u.hover(function () {
        clearTimeout(o);
        u.stop().animate({right:0})
    }, function () {
        if (!r) {
            o = setTimeout(function () {
                u.stop(true, true).animate({right:"-52px"})
            }, 300)
        }
    });

    t.click(function () {
        p()
    });
    w.click(function () {
        p()
    });
    function p() {
        var c = y.height();
        if (!r) {
            t.addClass("on");
            y.show().height("auto");
            var e = y.height();
            y.height(0).hide();
            var b = (q - n - e + 14) / 2;
            var a = u.css("right");
            if (a < 0) {
                u.animate({right:0}, 1)
            }
            if (b < 0) {
                b = 0
            }
            y.show().animate({height:e + "px"}, 400);
            if (v) {
                u.css({top:$(document).scrollTop() + 42})
            } else {
                u.stop().animate({top:b + "px"}, 350)
            }
            w.show();
            r = true
        } else {
            t.removeClass("on");
            y.animate({height:0}, 180);
            if (v) {
                u.css({top:$(document).scrollTop() + 42})
            } else {
                u.stop().animate({top:(q - n) / 2 + "px"}, 350, function () {
                    y.hide()
                })
            }
            w.hide();
            r = false
        }
    }

    var t1 = u.find(".iOnline a");
    var y1 = u.find(".stMore1");
    var w1 = u.find(".stMoreClose1");

    t1.click(function () {
        p1()
    });
    w1.click(function () {
        p1()
    });
    function p1() {
        var c = y1.height();
        if (!r) {
            t1.addClass("on");
            y1.show().height("auto");
            var e = y1.height();
            y1.height(0).hide();
            var b = (q - n - e + 14) / 2;
            var a = u.css("right");
            if (a < 0) {
                u.animate({right:0}, 1)
            }
            if (b < 0) {
                b = 0
            }
            y1.show().animate({height:e + "px"}, 400);
            if (v) {
                u.css({top:$(document).scrollTop() + 42})
            } else {
                u.stop().animate({top:b + "px"}, 350)
            }
            w1.show();
            r = true
        } else {
            t1.removeClass("on");
            y1.animate({height:0}, 180);
            if (v) {
                u.css({top:$(document).scrollTop() + 42})
            } else {
                u.stop().animate({top:(q - n) / 2 + "px"}, 350, function () {
                    y1.hide()
                })
            }
            w1.hide();
            r = false
        }
    }

    function s() {
        if (v) {
            var a = (q - n) / 2;
            u.css({position:"absolute", right:"-54px", top:a + "px"});
            $(window).scroll(function () {
                var e = u.height();
                var b = (q - e) / 2;
                var c = $(document).scrollTop();
                u.stop().animate({top:b + c + "px"}, 500)
            })
        }
    }
    s()
}

function d(b) {
    var a;
    return(a = document.cookie.match(RegExp("(^| )" + b + "=([^;]*)(;|$)"))) ? decodeURIComponent(a[2].replace(/\+/g, "%20")) : null
}

eval(function (k, l, c, m, a, e) {
    a = function (b) {
        return(b < l ? "" : a(parseInt(b / l))) + ((b = b % l) > 35 ? String.fromCharCode(b + 29) : b.toString(36))
    };
    if (!"".replace(/^/, String)) {
        while (c--) {
            e[a(c)] = m[c] || a(c)
        }
        m = [function (b) {
            return e[b]
        }];
        a = function () {
            return"\\w+"
        };
        c = 1
    }
    while (c--) { if (m[c]) { k = k.replace(new RegExp("\\b" + a(c) + "\\b", "g"), m[c]) } }
    return k
}('8 5(){6(2.3){$(2.3).1({4:0})};$("7").1({4:0})}', 9, 9, "|animate|document|body|scrollTop|backToTop|if|html|function".split("|"), 0, {}));

$(function(){ sideToolsAct(); })
/*右侧浮层菜单结束*/