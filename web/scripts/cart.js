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

    var cartData = data['cart'];//购物车信息
    var unUsedPromotion = data['activity'];//未使用的活动
    var usedPromotion = data['used_promotion'];//已使用的活动
    var totalPrice = data['total_price'];//总金额
    var totalProductNum = 0;//商品数量

    if (wx.isEmpty(unUsedPromotion)) {
        html += '<div class="cuxiao">\
                  <div class="cuxiaotit"><span class="hidden-cx" onclick="cart.switchActivity();">隐藏</span>您还可以免费参加以下促销活动</div>\
                  <div class="cuxiaoBox" id="promotion_list">\
                    <!--<div class="cuxiao-l"><span class="scol-l"></span></div>-->\
                    <div class="slidebox">\
                      <ul class="slideContainer jcarousel-skin-activity" id="list_ul">';

        for (var ii in unUsedPromotion) {
            if (!wx.isEmpty(unUsedPromotion[ii])) { continue;}

            html += cart.getActivityTemplate(unUsedPromotion[ii]['discount_type'], unUsedPromotion[ii]['promotion_id'], unUsedPromotion[ii]['name'], unUsedPromotion[ii]['descr'], unUsedPromotion[ii]['save']);
        }
        html += '</ul>\
                </div>\
                <!--<div class="cuxiao-r"><span class="scol-r"></span></div>-->\
              </div>\
            </div>';
    }

    html += '<div class="carbox">\
          <div class="cartitem">\
            <div class="colm c-goods">商品/商品号</div>\
            <div class="colm c-price">原价</div>\
            <div class="colm c-size">尺码</div>\
            <div class="colm c-numb">数量</div>\
            <div class="colm c-zengjf">赠送积分</div>\
            <div class="colm c-subtotal">小计</div>\
          </div>\
          <div class="cartregion">';

    var tmpHtml = '';
    for (var i in cartData) {
        tmpHtml = (cartData[i].num > cart.product_min_num) ?
            '&nbsp;<a href="javascript:void(0);" onclick="cart.changeQuantity('+cartData[i].pid+', 0, '+cartData[i].size_id+')"><img src="'+wx.base_url+'images/reduce.gif" alt="减少"/></a>&nbsp;' :
            '&nbsp;<img src="'+wx.base_url+'images/reduce_none.gif" alt="减少"/>&nbsp;';
        tmpHtml += '<input name="product_num" type="text" class="gnum" id="product_num_'+cartData[i].pid+'_'+cartData[i].size_id+'" value="'+cartData[i].num+'" maxlength="2" onchange="cart.changeQuantity('+cartData[i].pid+', 2, '+cartData[i].size_id+')"/>'
        tmpHtml += (cartData[i].num >= cart.product_max_num) ?
            '<img src="'+wx.base_url+'images/plus_none.gif" width="11" height="11"/>' :
            '&nbsp;<a href="javascript:void(0);" onclick="cart.changeQuantity('+cartData[i].pid+', 1, '+cartData[i].size_id+')"><img src="'+wx.base_url+'images/plus.gif" width="11" height="11"/></a>';

        html += '<div class="cartRow">\
                  <div class="cartCell cart-goods">\
                    <div class="cart-gimg"><img src="'+wx.img_url+'product/'+idToPath(cartData[i].pid)+'icon.jpg" width="50" height="50" /></div>\
                    <div class="cart-gname"><a class="cart-gn" href="'+wx.productURL(cartData[i].pid)+'" target="_blank" title="'+cartData[i].pname+'">'+cartData[i].pname+'</a><br/>\
                    <a href="javascript:void(0);" id="cart_favorite_id" onclick="product.favoriteProduct('+cartData[i].pid+', \'cart_favorite_id\')">收藏</a>&nbsp;&nbsp;\
                    <a href="javascript:void(0);" onclick="cart.deleteCartItem('+cartData[i].pid+', '+cartData[i].size_id+')">&nbsp;删除</a></div>\
                  </div>\
                  <div class="cartCell cart-price">￥'+wx.fPrice(cartData[i].sell_price)+'</div>\
                  <div class="cartCell cart-size">'+cartData[i].product_size+'</div>\
                  <div class="cartCell cart-numb">\
                  '+tmpHtml+'\
                  </div>\
                  <div class="cartCell cart-zengjf">'+parseInt( wx.fPrice(cartData[i].final_price) )+'</div>\
                  <div class="cartCell cart-subtotal">￥'+wx.fPrice(cartData[i].final_price)+'</div>\
                </div>';
        totalProductNum += (cartData[i].num);
    }

    if (wx.isEmpty(usedPromotion)) {
        var img = '';
        html += '<div class="joinactive">\
                <div class="joinact-tit">已参与的活动</div>';

        for (var ui in usedPromotion) {
            switch (usedPromotion[ui]['discount_type']) {
                case '2': img = wx.base_url+'images/discounticon.gif';break;
                case '3': img = wx.base_url+'images/cashicon.gif';break;
                default : img = wx.base_url+'images/discounticon.gif';
            }
            html += '<div class="cartRow2">\
                      <div class="ja-img"><a href="javascript:void(0);" title="'+usedPromotion[ui]['name']+'">\
                        <img src="'+img+'" alt="" width="56" height="56" title="'+usedPromotion[ui]['name']+'"/></a></div>\
                      <p><a href="javascript:void(0);">'+usedPromotion[ui]['name']+'</a>&nbsp;&nbsp;<span class="font6">节省：￥'+wx.fPrice(usedPromotion[ui]['save'])+'</span><br />\
                      <a href="javascript:void(0);" onclick="cart.deletePromotion('+usedPromotion[ui]['promotion_id']+', \'delete_promotion\')" id="delete_promotion">删除</a></p>\
                    </div>';
        }
        html += '</div>';
    }

    html += '<div class="gsum">产品数量总计：<span class="font1">'+parseInt(totalProductNum)+'</span>&nbsp;&nbsp;&nbsp;&nbsp;\
        赠送积分总计：<span class="font1">'+parseInt(wx.fPrice(totalPrice))+'</span>&nbsp;&nbsp;&nbsp;&nbsp;\
        花费积分总计：<span class="font1">0</span>&nbsp;&nbsp;&nbsp;&nbsp;商品金额总计：<span class="font1">￥'+wx.fPrice(totalPrice)+'</span></div>'
    html += '</div>';

    html += '<div class="cart-accounts">\
          <div class="cart-clean"><div class="empty"><a href="javascript:void(0)" onclick="cart.emptyCart()">清空购物车</a></div>\
              <div class="storage">\
                <div class="st-d"><a href="javascript:void(0)" onclick="cart.saveCart(\'save_cart\')" id="save_cart">寄存</a></div>\
                <div class="st-a"><a href="javascript:void(0)" onclick="cart.removeCart(\'fetch_cart\')" id="fetch_cart">取出</a></div>\
              </div></div>\
             <div class="post-btn"><a href="javascript:void(0);" onclick="wx.goToBack()"><img src="'+wx.base_url+'images/buy_bg_14.gif" alt="继续购物" width="115" height="32" /></a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="cart.goToOrderConfirm()"><img src="'+wx.base_url+'images/buy_bg_16.gif" width="126" height="32" alt="去结算" /></a></div>\
        </div>';
    html += '</div>';

    $('#shopping_cart').html(html);
    jQuery('#list_ul').jcarousel();
}

/*
 * 获取活动模板
 * param type int 1 赠送， 2 折扣， 3 减
 * param aId int 活动ID
 * param aTitle int 活动标题
 * param aDesc int 活动描述
 * param save int 节省金额
 */
cart.getActivityTemplate = function(type, aId, aTitle, aDesc, save)
{
    var typeName = 'zeng';
    var typeImageName = '';

    switch (type) {
        case '1' : typeName = 'zeng'; typeImageName = '#'; break;
        case '2' : typeName = 'zhe'; typeImageName = 'discounticon.gif'; break;
        case '3' : typeName = 'jian'; typeImageName = 'cashicon.gif'; break;
    }

    var html = '<li class="slideDiv">\
                  <div class="promo-tit"><span class="act-'+typeName+'"></span><span class="promo-txt"><a href="javascript:void(0);">'+aTitle+'</a></span></div>\
                  <div class="promo-img"><img src="'+wx.base_url+'images/'+typeImageName+'" width="56" height="56" /></div>\
                  <div class="promo-cont">\
                    <p><a href="javascript:void(0);" target="_blank" title="'+aDesc+'">'+aDesc+'</a></p>\
                    <div class="promo-btn"><a class="promo-join" href="javascript:void(0);" onclick="cart.usePromotion('+aId+', \'join_promotion_'+aId+'\');" id="join_promotion_'+aId+'">\
                        <span></span>立即参加</a><span class="promo-save">立省￥'+wx.fPrice(save)+'</span></div>\
                  </div>\
                </li>';

    return html;
}

cart.switchActivity = function ()
{
    $("#promotion_list").toggle('fast');
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
cart.deleteCartItem = function (pid, size_id, bindingId)
{
    pid = parseInt(pid);
    if ( !wx.isEmpty(pid) && pid !== 0 && !wx.isEmpty(size_id) && size_id !== 0) {
        wx.showPop('参数不全。', bindingId);
        return false;
    }

    var url = 'cart/deleteCartProduct';
    var param = 'pid='+pid+'&size_id='+size_id;
    var data = wx.ajax(url, param);

    cart.init();
}

//更改购物中产品的数量
cart.changeQuantity = function (pid, type, size_id, bindingId)
{
    var productNum = document.getElementById('product_num_'+pid+'_'+size_id).value;
    productNum = parseInt(productNum);

    var num = (type == 2) ? productNum : ( type ? (productNum + 1) : (productNum - 1) );

    if (num > cart.product_max_num) {
        wx.showPop('产品数量超出限制！', bindingId);
        return;
    }

    var url = 'cart/changeQuantity';
    var param = 'pid='+pid+'&size_id='+size_id+'&num='+num;
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

    if (data.error == '0') {
        cart.init();
        return ;
    }

    wx.showPop(popMessage, bindingId);
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

    if (data.error == '0') {
        cart.init();
        return;
    }

    wx.showPop(popMessage, bindingId);
}

