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
order.saveAddress = function ()
{
    var recentName = document.getElementById('recent_name_id').value;
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
        wx.pageReload();
    }

    if (data.error == '30010') {
        alert(data.msg);
    }

    if (data.error == '30011') {
        alert(data.msg);
    }

    if (data.error == '30012') {
        alert(data.msg);
    }
    //saveAddress
}

wx.editAddress = function (aId)
{

    var url = 'order/order/getOneAddress';
    var param = 'address_id='+ aId;
    var data = wx.ajax(url, param);

    var str = data.call_num;
    var callNum = str.split('-');

    $('#edit_address_id').html('<br/>'+data.province+', '+data.city+', '+data.area);
    document.getElementById('recent_name_id').value = data.recent_name;
    document.getElementById('detail_address_id').value = data.detail_address;
    document.getElementById('phone_num_id').value = data.phone_num;
    document.getElementById('area_num_id').value = wx.isEmpty(callNum[0]) ? callNum[0] : '';
    document.getElementById('call_num_id').value = wx.isEmpty(callNum[1]) ? callNum[1] : '';
    document.getElementById('email_id').value = data.email;
    document.getElementById('post_code_id').value = data.zipcode;
    document.getElementById('aid_id').value = data.address_id;
    order.layerSwitch();
}

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
    var url = 'order/order/deleteAddress';
    var param = 'address_id='+ aId;
    var data = wx.ajax(url, param);

    $('#address_'+aId).remove();

    wx.pageReload();
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

    var url = '/order/order/submit/';
    var param = 'address_id='+addressId+'&pay_type='+payType+'&delivert_time='+delivertTime+'&annotated='+annotated;//+'&invoice_payable='+invoicePayable+'&invoice_content='+invoiceContent;
    var data = wx.ajax(url, param);

    if (data.error == '30013') {
        wx.goToUrl('/order/order/success/'+data.order_sn);
    }

    alert(data.msg);
    //document.order_form_id.submit();
}