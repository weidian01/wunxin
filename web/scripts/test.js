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
var activity = data['activity'];//未使用的活动
var usedPromotion = data['used_promotion'];//已使用的活动
var totalPrice = data['total_price'];
data = data['cart'];//购物车信息

if (wx.isEmpty(activity)) {
    html += '<tr style="width: 980px;"><td colspan="7" style="padding: 5px 0 5px 25px;"><h2>您还可以免费参加以下促销活动\
                <a id="cart_top_free_prom_tab" showui="1" onclick="cart.switchActivity();" class="cartHide" href="javascript:void(0)" style="padding-right: 25px;">隐藏</a></h2></td></tr>';
    html += '<tr id="activity_list"><td colspan="7" style="padding: 5px 0;"><div class="activity_list"><ul id="list_ul" class="jcarousel-skin-activity">';

    for (var ii in activity) {
        if (wx.isEmpty(activity[ii])) {
            html += cart.getActivityTemplate(activity[ii]['discount_type'], activity[ii]['promotion_id'], activity[ii]['name'],
                activity[ii]['descr'], activity[ii]['pid'], activity[ii]['discount_price'], activity[ii]['status'], activity[ii]['save']);
        }
    }
    html += '</ul></div></td></tr>';
}

html += '<tr><td width="47%" colspan="2" align="center" class="tit">商品/商品号</td>';
html += '<td width="9%" align="center" class="tit">原价</td>';
html += '<td width="9%" align="center" class="tit">尺码</td>';
html += '<td width="13%" align="center" class="tit">数量</td>';
html += '<td width="10%" align="center" class="tit">赠送积分</td>';
html += '<td width="12%" align="center" class="tit">小计</td></tr>';

var totalProductNum = 0;

for (var i in data) {
    //console.log(i);
    html += '<tr>';
    html += '<td width="7%" style="padding-left: 8px;"><a href="'+wx.productURL(data[i].pid)+'" title="'+data[i].pname+'" target="_blank">' +
        '<img src="'+wx.img_url+'product/'+idToPath(data[i].pid)+'icon.jpg" width="50" height="60"/></a></td>';
    html += '<td width="40%" style="padding-left: 8px;">';
    html += '<a class="gn" href="'+wx.productURL(data[i].pid)+'" target="_blank" title="'+data[i].pname+'">'+data[i].pname+'</a><br/>';
    html += '<a href="javascript:void(0);" id="cart_favorite_id" onclick="product.favoriteProduct('+data[i].pid+', \'cart_favorite_id\')">收藏</a>&nbsp;&nbsp;&nbsp;'
    html += '<a href="javascript:void(0);" onclick="cart.deleteCartItem('+data[i].pid+')">删除</a></td>';
    html += '<td align="center" style="padding-left: 8px;">￥'+wx.fPrice(data[i].sell_price)+'</td>';
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
    html += '<td align="center" style="padding-left: 8px;"><span class="font2">'+parseInt( wx.fPrice(data[i].final_price) )+'</span></td>';
    html += '<td align="center" style="padding-left: 8px;"><span class="font6">'+wx.fPrice(data[i].final_price)+'</span></td>';
    html += '</tr>';
    totalProductNum += (data[i].num);
}

if (wx.isEmpty(usedPromotion)) {
    var img = '';
    html += '<tr><td colspan="7" style="padding: 10px;background-color: #F5F5F5;color: #888888"><b>已参加的活动</b></td></tr>';

    for (var ui in usedPromotion) {
        switch (usedPromotion[ui]['discount_type']) {
            case '2': img = wx.base_url+'images/discounticon.gif';break;
            case '3': img = wx.base_url+'images/cashicon.gif';break;
            default : img = wx.base_url+'images/discounticon.gif';
        }
        html += '<tr height="45"><td><img src="'+img+'" alt="优惠"></td>\
            <td colspan="6">'+usedPromotion[ui]['name']+'&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#B9151B;">节省：￥'+wx.fPrice(usedPromotion[ui]['save'])+'</span><br/>\
            <a href="javascript:void(0);" onclick="cart.deletePromotion('+usedPromotion[ui]['promotion_id']+', \'delete_promotion\')" id="delete_promotion">删除</a></td></tr>';
    }
}

html += '<tr><td style="border-bottom:1px solid #a5afc3;">&nbsp;</td><td colspan="6" style="border-bottom:1px solid #a5afc3;">';
html += '<div class="gsum"> 产品数量总计：<span class="font1">'+parseInt(totalProductNum)+'</span>&nbsp;&nbsp;&nbsp;&nbsp;';
html += '赠送积分总计：<span class="font1">'+parseInt(wx.fPrice(totalPrice))+'</span>&nbsp;&nbsp;&nbsp;&nbsp;';
html += '打折先金额：<span class="font1">0</span>&nbsp;&nbsp;&nbsp;&nbsp;';
html += '商品金额总计：<span class="font1">￥'+wx.fPrice(totalPrice)+'</span></div></td></tr>';

html += '<tr><td colspan="7"><div class="empty"><a href="javascript:void(0)" onclick="cart.emptyCart()">清空购物车</a></div>\
<div class="storage"> <div class="st-d"><a href="javascript:void(0)" onclick="cart.saveCart(\'save_cart\')" id="save_cart">寄存购物车</a></div>\
    <div class="st-a"><a href="javascript:void(0)" onclick="cart.removeCart(\'fetch_cart\')" id="fetch_cart">取出购物车</a></div> </div><div class="post-btn">';
html += '<a href="javascript:void(0);" onclick="wx.goToBack()" class="continue_shopping"></a>&nbsp;&nbsp;';
//html += '<a href="javascript:void(0);" onclick="wx.goToBack()"><img src="'+wx.base_url+'images/buy_bg_14.gif" alt="继续购物" width="115" height="32"/></a>&nbsp;&nbsp;';
html += '<a href="javascript:void(0);" onclick="cart.goToOrderConfirm()" class="go_payment"></a></div></td></tr></table>';
//html += '<a href="javascript:void(0);" onclick="cart.goToOrderConfirm()"><img src="'+wx.base_url+'images/buy_bg_16.gif" width="126" height="32" alt="去结算"/></a></div></td></tr></table>';

$('#shopping_cart').html(html);
jQuery('#list_ul').jcarousel();