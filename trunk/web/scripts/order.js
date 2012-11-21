/*
* WunXin JavaScript order Library v1.0
*
* Copyright 2012, http://www.wunxin.com
*
* Referrer: jquery library 1.4
* Author: Evan Hou
* Date: 2012.07.04
*/
var order = {};
order.paymentChannel = new Array(
    'ICBC-NET-B2C', 'CMBCHINA-NET-B2C', 'BOC-NET-B2C', 'HKBEA-NET-B2C', 'CCB-NET-B2C', 'ABC-NET-B2C', 'GDB-NET-B2C', 'CMBC-NET-B2C', 'CIB-NET-B2C', 'BCCB-NET-B2C', 'BJRCB-NET-B2C',
    'POST-NET-B2C', 'BOCO-NET-B2C', 'SPDB-NET-B2C', 'SDB-NET-B2C', 'CEB-NET-B2C', 'PINGANBANK-NET', 'ECITIC-NET-B2C', 'HZBANK-NET-B2C', 'NBCB-NET-B2C', 'alipay', '1000000-NET'
);

//改变省份
order.changeProvince = function (v)
{
    if (! wx.isEmpty(v)) {
        return false;
    }

    var url = 'order/order/getCity';
    var param = 'id='+ v;
    var data = wx.ajax(url, param);

    if (!wx.isEmpty(data['data'])) {
        return false;
    }

    var info = data['data'];
    var html = '';
    var num = 1;
    for (var i in info) {
        if (num == 1) {
            order.changeCity(info[i].id);
            //console.log(info[i]);
            $('#proposal_post_code_id').html(info[i].post_code);
        }
        html += '<option value="'+info[i].id+'">'+info[i].name+'</option>';
        num++;
    }

    $('#city_id').html(html);
}

//改变城市
order.changeCity = function (v)
{
    if (! wx.isEmpty(v)) {
        return false;
    }

    var url = 'order/order/getArea';
    var param = 'id='+ v;
    var data = wx.ajax(url, param);

    if (!wx.isEmpty(data['data'])) {
        return false;
    }

    var info = data['data'];
    var html = '';
    for (var i in info) {
        html += '<option value="'+info[i].id+'">'+info[i].name+'</option>';
    }

    $('#area_id').html(html);
}

//添加新地址 层切换
order.layerSwitch = function ()
{
    $('#new_address_id').show();
}

//保存收货地址
order.saveAddress = function (urls)
{
    var recentName = wx.trim(document.getElementById('recent_name_id').value);
    var province = $('#province_id').find('option:selected').text();//document.getElementById('province_id').value;
    var city = $('#city_id').find('option:selected').text();//document.getElementById('city_id')
    var area = $('#area_id').find('option:selected').text();//document.getElementById('area_id').value;
    var detailAddress = document.getElementById('detail_address_id').value;
    var phoneNum = document.getElementById('phone_num_id').value;
    var areaNum = document.getElementById('area_num_id').value;
    var callNum = document.getElementById('call_num_id').value;
    var email = document.getElementById('email_id').value;
    var postCode = document.getElementById('post_code_id').value;
    var addressId = document.getElementById('aid_id').value;
    addressId = addressId ? addressId : 0;

    $('#recent_name_notice_id').html('请填写收货人姓名!');
    if (!wx.isEmpty(recentName) || recentName.length < 2) {
        $('#recent_name_notice_id').html('<span style="color:#D20000;">收货人姓名为空或小于两个字!</span>');
        return false;
    } else if (!wx.isChinese (recentName)) {
        $('#recent_name_notice_id').html('<span style="color:#D20000;">收货人姓名只能是中文!</span>');
        return false;
    }

    $('#address_notice_id').html('请填写您的收货地址!');
    if (!wx.isEmpty(province) || province == '省份' || !wx.isEmpty(city) || city == '市' || !wx.isEmpty(area) || area == '县/区' || !wx.isEmpty(detailAddress)) {
        $('#address_notice_id').html('<span style="color:#D20000;">收货地址不能为空!</span>');
        return false;
    }

    $('#phone_num_notice_id').html('请填写正确手机号码，便于接收发货和收货通知!');
    if (!wx.isEmpty(phoneNum)) {
        $('#phone_num_notice_id').html('<span style="color:#D20000;">请填写手机号码!</span>');
        return false;
    } else if (!wx.isMobile(phoneNum)) {
        $('#phone_num_notice_id').html('<span style="color:#D20000;">手机号码格式错误!</span>');
        return false;
    }

    $('#email_notice_id').html('用于接收订单提醒邮件，便于您及时了解订单状态!');
    if (!wx.isEmpty(email)) {
        $('#email_notice_id').html('<span style="color:#D20000;">请填写邮件地址!</span>');
        return false;
    } else if (!wx.isEmail (email)) {
        $('#email_notice_id').html('<span style="color:#D20000;">邮件地址格式错误!</span>');
        return false;
    }

    /*
    $('#post_code_notice_id').html('请填写准确的邮编，以便商品能尽快送达!');
    if (!wx.isEmpty(postCode)) {
        $('#post_code_notice_id').html('<span style="color:#D20000;">请填写邮编!</span>');
        return false;
    }
    //*/

    var url = 'order/order/saveAddress';
    var param = 'recent_name='+ recentName+'&province='+ province+'&city='+ city+'&area='+ area+'&address_id='+addressId+
        '&detail_address='+ detailAddress+'&phone_num='+ phoneNum+'&area_num='+ areaNum+'&call_num='+callNum+'&email='+ email+'&post_code='+ postCode;
    var data = wx.ajax(url, param);

    if (data.error == '30009') {
//console.log(urls);
        if (wx.isEmpty(urls)) {
            wx.goToUrl(urls);
        } else {
            wx.pageReload();
        }
    }
    alert(data.msg);
}

//编辑地址
wx.editAddress = function (aId)
{

    var url = 'order/order/getOneAddress';
    var param = 'address_id='+ aId;
    var data = wx.ajax(url, param);

    var str = data.call_num;
    var callNum = '';
    if (wx.isEmpty(str)) {
        var callNum = str.split('-');
    }

    //$('#edit_address_id').html('<br/>'+data.province+', '+data.city+', '+data.area);
    document.getElementById('recent_name_id').value = data.recent_name;
    document.getElementById('detail_address_id').value = data.detail_address;
    document.getElementById('phone_num_id').value = data.phone_num;
    document.getElementById('area_num_id').value = wx.isEmpty(callNum[0]) ? callNum[0] : '';
    document.getElementById('call_num_id').value = wx.isEmpty(callNum[1]) ? callNum[1] : '';
    document.getElementById('email_id').value = data.email;
    document.getElementById('post_code_id').value = data.zipcode;
    document.getElementById('aid_id').value = data.address_id;

    var provinceCount=$("#province_id option").length;
    for (var i = 0; i < provinceCount; i++) {
        if ($("#province_id").get(0).options[i].text == data.province) {
            $("#province_id").get(0).options[i].selected = true;
            order.changeProvince($("#province_id").get(0).options[i].value);
            break;
        }
    }

    var cityCount=$("#city_id option").length;
    for (var i = 0; i < cityCount; i++) {
        if ($("#city_id").get(0).options[i].text == data.city) {
            $("#city_id").get(0).options[i].selected = true;
            order.changeCity($("#city_id").get(0).options[i].value);
            break;
        }
    }

    var areaCount=$("#area_id option").length;
    for (var i = 0; i < areaCount; i++) {
        if ($("#area_id").get(0).options[i].text == data.area) {
            $("#area_id").get(0).options[i].selected = true;
            break;
        }
    }

    order.layerSwitch();
}

//添加地址
wx.addAddress = function ()
{
    $('#edit_address_id').html('');
    document.getElementById('recent_name_id').value = '';
    document.getElementById('detail_address_id').value = '';
    document.getElementById('phone_num_id').value = '';
    document.getElementById('area_num_id').value = '';
    document.getElementById('call_num_id').value = '';
    document.getElementById('email_id').value = '';
    document.getElementById('post_code_id').value = '';
    document.getElementById('aid_id').value = '0';
    order.layerSwitch();
}

//删除收货地址
wx.deleteAddress = function (aId)
{
    if (!wx.isEmpty(aId)) {
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'order/order/deleteAddress';
    var param = 'address_id='+ aId;
    var data = wx.ajax(url, param);

    $('#address_'+aId).remove();

    //wx.pageReload();
}

//保存支付与送货时间
order.savePayRecent = function ()
{
    var payType = $("input[name='pay_type']:checked").val();
    var delivertTime = $("input[name='delivert_time']:checked").val();
//console.log(payType);console.log(delivertTime);
    var payTypeHtml = '';
    switch (payType) {
        case '1': payTypeHtml = '在线支付';break;
        case '3': payTypeHtml = '邮政汇款';break;
        default :payTypeHtml = '在线支付';
    }
    $('#pay_type_view_id').html(payTypeHtml);


    var delivertTimeHtml = '';
    switch (delivertTime) {
        case '1': delivertTimeHtml = '工作日、双休日和节假日均送货'; break;
        case '2': delivertTimeHtml = '只双休日、节假日送货（工作时间不送货）'; break;
        case '3': delivertTimeHtml = '只工作日送货（双休日、节假日不送）'; break;
        default :delivertTimeHtml = '工作日、双休日和节假日均送货';
    }
    $('#delivert_time_view_id').html(delivertTimeHtml);

    editorder('pay-delivery2','pay-delivery1', this);
}

//提交订单
order.orderSubmit = function ()
{
    var addressId = $("input[name='address_id']:checked").val();//wx.getRadioCheckBoxValue('address_id');//配货地址
    var payType = $("input[name='pay_type']:checked").val();//wx.getRadioCheckBoxValue('pay_type');//支付方式
    var delivertTime = $("input[name='delivert_time']:checked").val();//wx.getRadioCheckBoxValue('delivert_time');//配送时间
    //var invoicePayable = document.getElementById('invoice_payable_id').value;
    //var invoiceContent = $("#invoice_content_id").val();
    var annotated = document.getElementById('annotated_id').value;
    var isPrintPrice = $("input[name='is_print_price']:checked").val();

    if (!addressId) {
        alert('请检查配送地址是否正确!');
        return false;
    }

    if (!payType) {
        alert('请检查支付方式是否正确!');
        return false;
    }

    if (!delivertTime) {
        alert('请检查配送方式是否正确!');
        return false;
    }

    var url = 'order/order/submit/';
    var param = 'address_id='+addressId+'&pay_type='+payType+'&delivert_time='+delivertTime+'&annotated='+annotated+'&is_print_price='+isPrintPrice;//+'&invoice_payable='+invoicePayable+'&invoice_content='+invoiceContent;
    var data = wx.ajax(url, param);

    if (data.error == '30013') {
        wx.goToUrl('/order/order/success/'+data.order_sn);
    }

    alert(data.msg);
    //document.order_form_id.submit();
}

//提交进行支付
order.pay = function (bindingId)
{
    var payBank = wx.getRadioCheckBoxValue('bank');

    if ( !wx.isEmpty(payBank) ) {
        art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">请选择支付方式。</span><br/>' });
        return false;
    }

    if (!wx.inArray(payBank, order.paymentChannel)) {
        art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">未知的支付方式。</span><br/>' });
        return false;
    }

    document.pay_form.action = '/pay/index';
    if (payBank == 'alipay') {
        document.pay_form.action = '/pay/index';
    }

    document.pay_form.submit();
}

//取消订单
order.cancelOrder = function (order_sn, bindingId)
{
    if ( !wx.isEmpty(order_sn) ) {
        wx.showPop('参数为空', bindingId);
        return false;
    }

    var url = '/order/order/cancelOrder/';
    var param = 'order_sn='+order_sn
    var data = wx.ajax(url, param);

    var prompt = '取消成功';
    switch (data.error) {
        case '0': prompt = '取消成功';break;
        case '30026': prompt = '参数不全';break;
        case '10009': wx.loginLayer();break;
        case '30022': prompt = '订单不存在';break;
        case '30027': prompt = '订单已支付成功并在配货中';break;
        case '30028': prompt = '系统繁忙，请稍后再试';break;
    }

    wx.showPop(prompt, bindingId);
    wx.pageReload();
}

//使用礼品卡
order.useGiftCard = function (card_no, base_amount, bindingId)
{
    var cardNumber = $.trim(card_no);
    var useAmount = $.trim($('#use_amount_'+card_no).val());
    useAmount = (useAmount * 100);

    if (!wx.isEmpty(cardNumber) || !wx.isEmpty(useAmount)) {
        wx.showPop('卡号或使用金额不能为空！', bindingId);
        return ;
    }

    base_amount = parseInt(base_amount);
    if (useAmount > base_amount) {
        wx.showPop('输入的金额大于卡金额！', bindingId);
        return ;
    }

    if (!wx.isLogin()) {
        return ;
    }

    var url = 'business/giftCard/useBandingCard';
    var param = 'card_number='+cardNumber+'&use_amount='+useAmount;
    var data = wx.ajax(url, param);

    /*
    var prompt = '系统繁忙，请稍后再试！';
    switch (data.error) {
        case '':prompt = '';break;
        case '70015':prompt = '使用礼品卡参数不全';break;
        case '10009':wx.loginLayer();return;break;
        case '70017':prompt = '礼品卡未不存在';break;
        case '70018':prompt = '礼品卡已过期';break;
        case '70016':prompt = '礼品卡未绑定';break;
        case '70019':prompt = '礼品卡不属于您';break;
        case '70021':prompt = '礼品卡金额为空';break;
        case '70020':prompt = '礼品卡密码错误';break;
        case '60001':prompt = '购物车为空';break;
    }
    //*/

    if (data.error == '10009') {
        wx.loginLayer();
        return;
    }

    if (data.error == '0') {
        var img = '<img src="'+wx.base_url+'images/cancel.jpg" alt="取消使用礼品卡" title="取消使用礼品卡"/>';
        $('#'+bindingId).html(img);
        order.updateCardView(data.save_price);
    }

    //是否是取消卡,如果是取消卡，则直接替换显示图片
    if (data.error == '70033') {
        var img = '<img src="'+wx.base_url+'images/use.png" alt="使用礼品卡" title="使用礼品卡"/>';
        $('#'+bindingId).html(img);
        order.updateCardView(data.save_price);
    }

    wx.showPop(data.msg, bindingId);

    //console.log(bindingId);
}

order.updateCardView = function (savePrice)
{
    var orderTotalPrice = $('#order_total_price').text();
    orderTotalPrice = parseFloat(orderTotalPrice)
    orderTotalPrice = orderTotalPrice < 0 ? 0 : orderTotalPrice;

    savePrice = wx.fPrice(savePrice);
    if (isNaN(savePrice) || !wx.isEmpty(savePrice)) {
        savePrice = wx.fPrice(0);
    }

    //savePrice = savePrice >= orderTotalPrice ? 0 : savePrice

    $('#card_use_amount').html(savePrice);

    var finalPrice = savePrice >= orderTotalPrice ? 0 : (orderTotalPrice - savePrice);
    //var finalPrice = (orderTotalPrice * 100)-(savePrice * 100);
    $('#final_pay_amount').html(finalPrice);
    //console.log(savePrice);
    //console.log(orderTotalPrice);
}