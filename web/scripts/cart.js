/*
* WunXin JavaScript Cart Library v1.0
*
* Copyright 2012, http://www.wunxin.com
*
* Referrer: jquery library 1.4
* Author: Evan Hou
* Date: 2012.07.04
*/
var cart = {};

//购物车初始化
cart.init = function ()
{
    var html = '';
    var data = wx.ajax('cart/getCart', '');

    if (data == '' || data == undefined) {
        html = '<br /><h1 style="text-align: center;">您的购物车中没有商品，请您去 <a href="javascript:void(0);" onclick="wx.goToBack()" style="color: #b5161c;">选购商品</a> 或 ' +
            '<a style="color: #b5161c;" href="javascript:void(0);" onclick="cart.removeCart()">取出寄存的产品</a>&nbsp;&nbsp;» </h1><br /><br /><br /><br />';
        $('#shopping_cart').html(html);
        return ;
    }

    html += '<table width="100%" border="0" cellspacing="0" cellpadding="0" id="shopping_cart_item"><tr>';
    html += '<td colspan="2" align="center" class="tit">商品/商品号</td>';
    html += '<td width="9%" align="center" class="tit">单价</td>';
    html += '<td width="9%" align="center" class="tit">尺码</td>';
    html += '<td width="13%" align="center" class="tit">数量</td>';
    html += '<td width="10%" align="center" class="tit">赠送积分</td>';
    html += '<td width="12%" align="center" class="tit">小计</td>';
    html += '</tr>';

    var totalPrice = 0;
    var totalIntegral = 0;
    var totalProductNum = 0;

    for (var i in data) {
        html += '<tr>';
        html += '<td width="7%"><img src="'+wx.img_url+'product/'+idToPath(data[i].pid)+'icon.jpg" width="50" height="67"/></td>';
        html += '<td width="40%">';
        html += '<a class="gn" href="#">'+data[i].pname.substring(0, 60)+'</a><br/>';
        html += '<a href="javascript:void(0);" id="cart_favorite_id" onclick="product.favoriteProduct('+data[i].pid+', \'cart_favorite_id\')">收藏</a>&nbsp;&nbsp;&nbsp;'
        html += '<a href="javascript:void(0);" onclick="cart.deleteCartItem('+i+')">删除</a></td>';
        html += '<td align="center">'+wx.fPrice(data[i].product_price)+'</td>';
        html += '<td align="center">'+data[i].product_size+'</td>';
        html += '<td align="center">';
        html += (data[i].product_num > 1) ? '&nbsp;<a href="javascript:void(0);" onclick="cart.changeQuantity('+i+', 0)"><img src="/images/reduce.gif" alt="减少"/></a>&nbsp;' : '';
        html += '<input name="product_num" type="text" class="gnum" id="product_num_'+i+'" value="'+data[i].product_num+'" maxlength="3" onchange="cart.changeQuantity('+i+', 2)"/>';
        html += '&nbsp;<a href="javascript:void(0);" onclick="cart.changeQuantity('+i+', 1)"><img src="/images/plus.gif" width="11" height="11"/></a>';
        html += '</td>';
        html += '<td align="center"><span class="font2">'+parseInt( wx.fPrice(data[i].product_price * data[i].product_num) )+'</span></td>';
        html += '<td align="center"><span class="font6">'+wx.fPrice(data[i].product_price * data[i].product_num)+'</span></td>';
        html += '</tr>';
        totalIntegral += (data[i].product_price * data[i].product_num);
        totalPrice += (data[i].product_price * data[i].product_num);
        totalProductNum += (data[i].product_num);
    }

    html += '<tr>';
    html += '<td style="border-bottom:1px solid #a5afc3;">&nbsp;</td>';
    html += '<td colspan="6" style="border-bottom:1px solid #a5afc3;">';
    html += '<div class="gsum"> 产品数量总计：<span class="font1">'+parseInt(totalProductNum)+'</span>&nbsp;&nbsp;&nbsp;&nbsp;';
    html += '赠送积分总计：<span class="font1">'+parseInt(wx.fPrice(totalIntegral))+'</span>&nbsp;&nbsp;&nbsp;&nbsp;';
    //html += '花费积分总计：<span class="font1">0</span>&nbsp;&nbsp;&nbsp;&nbsp;';
    html += '商品金额总计：<span class="font1">'+wx.fPrice(totalPrice)+'</span>';
    html += '</div>';
    html += '</td>';
    html += '</tr>';

    html += '<tr>';
    html += '<td colspan="7">';
    html += '<div class="empty"><a href="javascript:void(0)" onclick="cart.emptyCart()">清空购物车</a></div>' +
		'<div class="storage"> <div class="st-d"><a href="javascript:void(0)" onclick="cart.saveCart()">寄存购物车</a></div> ' +
        '<div class="st-a"><a href="javascript:void(0)" onclick="cart.removeCart()">取出购物车</a></div> </div>' ;
    html += '<div class="post-btn">';
    html += '<a href="javascript:void(0);" onclick="wx.goToBack()";><img src="/images/buy_bg_14.gif" alt="继续购物" width="115" height="32"/></a>&nbsp;&nbsp;';
    html += '<a href="javascript:void(0);" onclick="cart.goToOrderConfirm()"><img src="/images/buy_bg_16.gif" width="126" height="32" alt="去结算"/></a>';
    html += '</div>';
    html += '</td>';
    html += '</tr></table>';

    $('#shopping_cart').html(html);
}

//添加产品到购物车
cart.addToCart = function (pid, pSize, pNum, additional_info, bindingId)
{
    if (pid == '' || pid == undefined || pSize == '' || pSize == undefined) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">添加产品到购物车参数不全。</span><br/>' });
        wx.showPop('添加产品到购物车参数不全。', bindingId);
        return false;
    }

    if (pNum == '' || pNum == undefined) {
        pNum = 1;
    }

    if (additional_info == '' || additional_info == undefined) {
        additional_info = '';
    }

    pid = parseInt(pid);

    var url = 'cart/addToCart';
    var param = 'pid='+pid+'&p_size='+pSize+'&p_num='+pNum+'&additional_info='+additional_info;
    var data = wx.ajax(url, param);

    //1 添加成功， 2 系统繁忙， 3 参数不全
    switch (data.error)
    {
        case '0': wx.addToCartLayer(1, data.pinfo['pname'], bindingId);break;
        case '60002': wx.showPop('系统繁忙，请稍后再试', bindingId);break;
        case '60003': wx.showPop('参数不全', bindingId);break;
    }

    //wx.addToCartLayer(status, bindingId);

    cart.init();
}

//删除购物车中产品
cart.deleteCartItem = function (id, bindingId)
{
    id = parseInt(id);
    //*
    if ( !wx.isEmpty(id) && id !== 0) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">参数不全。</span><br/>' });
        wx.showPop('参数不全。', bindingId);
        return false;
    }
    //*/
    var url = 'cart/deleteCartProduct';
    var param = 'id='+id;
    var data = wx.ajax(url, param);
/*
    switch (data.error)
    {
        case '60008': alert(data.msg);break;
        case '60009': alert(data.msg);break;
        case '60010': alert(data.msg);break;
        default :alert(data.msg);
    }
//*/
    cart.init();
}

//更改购物中产品的数量
cart.changeQuantity = function (id, type)
{
    var productNum = document.getElementById('product_num_'+id).value;
    productNum = parseInt(productNum);

    var num = (type == 2) ? productNum : ( type ? (productNum + 1) : (productNum - 1) );

    var url = 'cart/changeQuantity';
    var param = 'id='+id+'&num='+num;
    var data = wx.ajax(url, param);
/*
    switch (data.error)
    {
        case '60004': alert(data.msg);break;
        case '60005': alert(data.msg);break;
        case '60007': alert(data.msg);break;
        case '60018': alert(data.msg);break;
        default :alert(data.msg);
    }
//*/
    cart.init();
}

//保存购物车中产品至数据库
cart.saveCart = function (bindingId)
{
    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    //var url = 'cart/cartStorageToDatabase';
    //var param = '';
    var data = wx.ajax('cart/cartStorageToDatabase', '');

    if (data.error == '10009') {
        wx.loginLayer();
        return false;
    }

    if (data.error == '60019') {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">保存失败。</span><br/>' });
        wx.showPop('保存失败。', bindingId);
        return false;
    }

    if (data.error == '0') {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">保存成功。</span><br/>' });
        wx.showPop('购物车中产品寄存成功。', bindingId);
        return true;
    }
}

//将购物库中购物车产品取出
cart.removeCart = function (bindingId)
{
    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'cart/removeCartProduct';
    //var param = '';
    var data = wx.ajax(url, '');

    if (data.error == '10009') {
        wx.loginLayer();
        return false;
    }

    if (data.error == '0') {
        //alert('取出产品成功!');
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">取出产品成功。</span><br/>' });
        wx.showPop('取出购物车产品成功。', bindingId);
    }

    cart.init();
}

//清空购物车
cart.emptyCart = function (bindingId)
{
    var url = 'cart/emptyCart';
    wx.ajax(url, '');

    //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">清空成功。</span><br/>' });
    wx.showPop('清空成功。', bindingId);

    cart.init();
}

//提交订单至填写订单核对信息页面
cart.goToOrderConfirm = function ()
{
    if (!wx.checkLoginStatus()) {
        return false;
    }

    wx.goToUrl('/order/order/');
}



