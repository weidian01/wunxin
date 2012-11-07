/*
* WunXin JavaScript Cart Library v1.0
*
* Copyright 2012, http://www.wunxin.com
*
* Referrer: jquery library 1.4
* Author: Evan Hou
* Date: 2012.07.04
*/
var cart = {
    product_max_num:100,
    product_min_num:1
};

//购物车初始化
cart.init = function ()
{
    var html = '';
    var data = wx.ajax('cart/getCart', '');

    if (data['cart'] == '' || data['cart'] == undefined) {
        html = '<br /><h1 style="text-align: center;">您的购物车中没有商品，请您去 <a href="javascript:void(0);" onclick="wx.goToBack()" style="color: #b5161c;">选购商品</a> 或 ' +
            '<a style="color: #b5161c;" href="javascript:void(0);" onclick="cart.removeCart()">取出寄存的产品</a>&nbsp;&nbsp;» </h1><br /><br /><br /><br />';
        $('#shopping_cart').html(html);
        return ;
    }

    html += '<table width="100%" border="0" cellspacing="0" cellpadding="0" id="shopping_cart_item">';

    //*
    var activity = data['activity'];//console.log(wx.isEmpty(activity));
    if (wx.isEmpty(activity)) {
        html += '<tr style="width: 980px;"><td colspan="7" style="padding: 5px 0 5px 25px;"><h2>您还可以免费参加以下促销活动\
                    <a id="cart_top_free_prom_tab" showui="1" onclick="cart.switchActivity();" class="cartHide" href="javascript:void(0)" style="padding-right: 25px;">隐藏</a></h2></td></tr>';
        html += '<tr id="activity_list"><td colspan="7" style="padding: 5px 0;"><div class="activity_list"><ul id="list_ul" class="jcarousel-skin-activity">';

        for (var ii in activity) {
            if (!wx.isEmpty(activity[ii])) return;
            html += cart.getActivityTemplate(activity[ii]['discount_type'], activity[ii]['promotion_id'], activity[ii]['name'],
                activity[ii]['descr'], activity[ii]['pid'], activity[ii]['discount_price'], activity[ii]['status']);
        }
        html += '</ul></div></td></tr>';
    }

    html += '<tr><td colspan="2" align="center" class="tit">商品/商品号</td>';
    html += '<td width="9%" align="center" class="tit">单价</td>';
    html += '<td width="9%" align="center" class="tit">尺码</td>';
    html += '<td width="13%" align="center" class="tit">数量</td>';
    html += '<td width="10%" align="center" class="tit">赠送积分</td>';
    html += '<td width="12%" align="center" class="tit">小计</td></tr>';

    var totalPrice = 0;
    var totalIntegral = 0;
    var totalProductNum = 0;

    data = data['cart'];
    for (var i in data) {
        //console.log(i);
        html += '<tr>';
        html += '<td width="7%" style="padding-left: 8px;"><a href="'+wx.productURL(data[i].pid)+'" title="'+data[i].pname+'" target="_blank">' +
            '<img src="'+wx.img_url+'product/'+idToPath(data[i].pid)+'icon.jpg" width="50" height="60"/></a></td>';
        html += '<td width="40%" style="padding-left: 8px;">';
        html += '<a class="gn" href="'+wx.productURL(data[i].pid)+'" target="_blank" title="'+data[i].pname+'">'+data[i].pname+'</a><br/>';
        html += '<a href="javascript:void(0);" id="cart_favorite_id" onclick="product.favoriteProduct('+data[i].pid+', \'cart_favorite_id\')">收藏</a>&nbsp;&nbsp;&nbsp;'
        html += '<a href="javascript:void(0);" onclick="cart.deleteCartItem('+data[i].pid+')">删除</a></td>';
        html += '<td align="center" style="padding-left: 8px;">'+wx.fPrice(data[i].final_price)+'</td>';
        html += '<td align="center" style="padding-left: 8px;">'+data[i].product_size+'</td>';
        html += '<td align="center" style="padding-left: 8px;">';
        html += (data[i].num > cart.product_min_num) ?
            '&nbsp;<a href="javascript:void(0);" onclick="cart.changeQuantity('+data[i].pid+', 0)"><img src="'+wx.base_url+'images/reduce.gif" alt="减少"/></a>&nbsp;' :
            '&nbsp;<img src="'+wx.base_url+'images/reduce_none.gif" alt="减少"/>&nbsp;';
        html += '<input name="product_num" type="text" class="gnum" id="product_num_'+data[i].pid+'" value="'+data[i].num+'" maxlength="2" onchange="cart.changeQuantity('+data[i].pid+', 2)"/>';
        html += (data[i].num >= cart.product_max_num) ?
            '<img src="'+wx.base_url+'images/plus_none.gif" width="11" height="11"/>' :
            '&nbsp;<a href="javascript:void(0);" onclick="cart.changeQuantity('+data[i].pid+', 1)"><img src="'+wx.base_url+'images/plus.gif" width="11" height="11"/></a>';
        html += '</td>';
        html += '<td align="center" style="padding-left: 8px;"><span class="font2">'+parseInt( wx.fPrice(data[i].final_price * data[i].num) )+'</span></td>';
        html += '<td align="center" style="padding-left: 8px;"><span class="font6">'+wx.fPrice(data[i].final_price * data[i].num)+'</span></td>';
        html += '</tr>';
        totalIntegral += (data[i].final_price * data[i].num);
        totalPrice += (data[i].final_price * data[i].num);
        totalProductNum += (data[i].num);
    }

    html += '<tr><td style="border-bottom:1px solid #a5afc3;">&nbsp;</td><td colspan="6" style="border-bottom:1px solid #a5afc3;">';
    html += '<div class="gsum"> 产品数量总计：<span class="font1">'+parseInt(totalProductNum)+'</span>&nbsp;&nbsp;&nbsp;&nbsp;';
    html += '赠送积分总计：<span class="font1">'+parseInt(wx.fPrice(totalIntegral))+'</span>&nbsp;&nbsp;&nbsp;&nbsp;';
    //html += '花费积分总计：<span class="font1">0</span>&nbsp;&nbsp;&nbsp;&nbsp;';
    html += '商品金额总计：<span class="font1">'+wx.fPrice(totalPrice)+'</span></div></td></tr>';

    html += '<tr><td colspan="7"><div class="empty"><a href="javascript:void(0)" onclick="cart.emptyCart()">清空购物车</a></div>\
		<div class="storage"> <div class="st-d"><a href="javascript:void(0)" onclick="cart.saveCart()">寄存购物车</a></div>\
        <div class="st-a"><a href="javascript:void(0)" onclick="cart.removeCart()">取出购物车</a></div> </div><div class="post-btn">';
    html += '<a href="javascript:void(0);" onclick="wx.goToBack()" class="continue_shopping"></a>&nbsp;&nbsp;';
    //html += '<a href="javascript:void(0);" onclick="wx.goToBack()"><img src="'+wx.base_url+'images/buy_bg_14.gif" alt="继续购物" width="115" height="32"/></a>&nbsp;&nbsp;';
    html += '<a href="javascript:void(0);" onclick="cart.goToOrderConfirm()" class="go_payment"></a></div></td></tr></table>';
    //html += '<a href="javascript:void(0);" onclick="cart.goToOrderConfirm()"><img src="'+wx.base_url+'images/buy_bg_16.gif" width="126" height="32" alt="去结算"/></a></div></td></tr></table>';

    $('#shopping_cart').html(html);
    jQuery('#list_ul').jcarousel();
}

/*
 * 获取活动模板
 * param type int 1 赠送， 2 折扣， 3 减
 * param aId int 活动ID
 * param aTitle int 活动标题
 * param aDesc int 活动描述
 * param pId int 产品ID
 * param DiscountPrice int 产品价格
 */
cart.getActivityTemplate = function(type, aId, aTitle, aDesc, pId, DiscountPrice, activityStatus)
{
    var typeName = 'zeng';
    var zengPid = '';
    var pInfo = '&nbsp;';
    var activityImage = '';
    //var activityStatus = wx.isEmpty(activityStatus) ? activityStatus : ;

    switch (type) {
        case '1' :
            typeName = 'zeng';
            zengPid = '<span surl="http://www.wunxin.com/" class="zdsp">&nbsp;</span>&nbsp;';
            pInfo = '<del>￥'+wx.fPrice(DiscountPrice)+'</del>&nbsp;&nbsp;<strong class="red">免费</strong>';
            activityImage = wx.base_url+'upload/product/'+idToPath(pId)+'default.jpg';
            break;
        case '2' :
            typeName = 'zhe';
            activityImage = wx.base_url+'images/discounticon.gif';
            break;
        case '3' :
            typeName = 'jian';
            activityImage = wx.base_url+'images/cashicon.gif';
            break;
    }

    activityStatus = '<a href="javascript:void(0);" target="_blank" class="view_detail">查看详情</a>\
    <a class="a-red" href="javascript:void(0);" style="color: #ffffff;" onclick="cart.usePromotion('+aId+', \'join_promotion_'+aId+'\');" id="join_promotion_'+aId+'"> <s></s>立即参加 </a>';

    /*
    if (activityStatus) {
        activityStatus = '<a href="javascript:void(0);" target="_blank" class="view_detail">查看详情</a>\
        <a class="a-red" href="javascript:void(0);" style="color: #ffffff;" onclick="cart.usePromotion('+aId+', "join_promotion_'+aId+'");" id="join_promotion_'+aId+'"> <s></s>立即参加 </a>';
    } else {
        activityStatus = '<a class="a-gray" href="javascript:void(0);"><s></s>已领完</a>';
    }
    //*/

    var html = '<li>\
            <dt title="'+aTitle+'" class="pro-title promo_title">'+zengPid+'<b>'+aTitle+'</b></dt>\
            <dd class="fl"><a class="img60" href="javascript:void(0)" target="_blank"><img src="'+activityImage+'" width="56" height="56" alt="'+aTitle+'"></a></dd>\
            <dd class="proname"><a href="javascript:void(0)" target="_blank" title="'+aDesc+'">'+aDesc+'</a></dd>\
            <dd>'+pInfo+'</dd>\
            <dd>'+activityStatus+'</dd>\
            <dd class="'+typeName+'"></dd>\
        </li>';
    return html;
}

cart.switchActivity = function ()
{
    $("#activity_list").toggle('fast');
}

//添加产品到购物车
cart.addToCart = function (pid, pSize, pNum, additional_info, bindingId)
{
    if (pid == '' || pid == undefined || pSize == '' || pSize == undefined) {
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
cart.deleteCartItem = function (pid, bindingId)
{
    pid = parseInt(pid);
    if ( !wx.isEmpty(pid) && pid !== 0) {
        wx.showPop('参数不全。', bindingId);
        return false;
    }

    var url = 'cart/deleteCartProduct';
    var param = 'pid='+pid;
    var data = wx.ajax(url, param);

    cart.init();
}

//更改购物中产品的数量
cart.changeQuantity = function (pid, type, bindingId)
{
    var productNum = document.getElementById('product_num_'+pid).value;
    productNum = parseInt(productNum);

    var num = (type == 2) ? productNum : ( type ? (productNum + 1) : (productNum - 1) );

    if (num > cart.product_max_num) {
        wx.showPop('产品数量超出限制！', bindingId);
        return;
    }

    var url = 'cart/changeQuantity';
    var param = 'pid='+pid+'&num='+num;
    var data = wx.ajax(url, param);

    cart.init();
}

//保存购物车中产品至数据库
cart.saveCart = function (bindingId)
{
    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var data = wx.ajax('cart/cartStorageToDatabase', '');

    switch (data.error) {
        case '10009': wx.loginLayer(); return false; break;
        case '60019': wx.showPop('保存失败！', bindingId); return false; break;
        case '0': wx.showPop('购物车中产品寄存成功！', bindingId); return true; break;
        default :wx.showPop('系统繁忙，请稍后再试！');
    }
}

//将购物库中购物车产品取出
cart.removeCart = function (bindingId)
{
    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'cart/removeCartProduct';
    var data = wx.ajax(url, '');

    switch (data.error) {
        case '10009':wx.loginLayer(); return false;break;
        case '0':wx.showPop('取出购物车产品成功！', bindingId);break;
    }

    cart.init();
}

//清空购物车
cart.emptyCart = function (bindingId)
{
    var url = 'cart/emptyCart';
    wx.ajax(url, '');

    wx.showPop('清空成功！', bindingId);

    cart.init();
}

//提交订单至填写订单核对信息页面
cart.goToOrderConfirm = function ()
{
    if (!wx.checkLoginStatus()) return false;

    wx.goToUrl('/order/order/');
}

//使用活动
cart.usePromotion = function (promotionId, bindingId)
{
    var url = 'cart/usePromotion';
    var data = wx.ajax(url, 'promotion_id='+promotionId);

    var popMessage = '系统繁忙，请稍后再试！';
    switch (data.error) {
        case '0': popMessage = '使用活动成功！';break;
        case '60020': popMessage = '参数不全！';break;
        case '60021': popMessage = '活动不存在！';break;
    }

    wx.showPop(popMessage, bindingId);

    if (data.error == '0') {
        cart.init();
    }
}

//删除活动
cart.deletePromotion = function (promotionId, bindingId)
{
    var url = 'cart/deletePromotion';
    var data = wx.ajax(url, 'promotion_id='+promotionId);

    var popMessage = '系统繁忙，请稍后再试！';
    switch (data.error) {
        case '0': popMessage = '删除活动成功！';break;
        case '60022':popMessage = '删除活动参数不全！';break;
    }

    wx.showPop(popMessage, bindingId);

    if (data.error == '0') {
        cart.init();
    }
}

