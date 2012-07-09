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

//初始化地址信息
order.changeProvince(1);

//添加新地址 层切换
order.layerSwitch = function ()
{
    $('#new_address_id').show();
}

//检查收货人名称
order.checkRecentName = function ()
{
    var recentName = document.getElementById('recent_name_id').value;

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

    $('#recent_name_notice_id').html('请填写收货人姓名!');
    if (!wx.isEmpty(recentName)) {
        $('#recent_name_notice_id').html('<span style="color:#D20000;">收货人姓名不能为空!</span>');
        return false;
    }

    $('#address_notice_id').html('请填写您的收货地址!');
    if (!wx.isEmpty(province) || !wx.isEmpty(city) || city == '市' || !wx.isEmpty(area) || area == '县/区' || !wx.isEmpty(detailAddress)) {
        $('#address_notice_id').html('<span style="color:#D20000;">收货地址不能为空!</span>');
        return false;
    }

    $('#phone_num_notice_id').html('请填写正确手机号码，便于接收发货和收货通知!');
    if (!wx.isEmpty(phoneNum)) {
        $('#phone_num_notice_id').html('<span style="color:#D20000;">请填写手机号码!</span>');
        return false;
    }

    $('#email_notice_id').html('用于接收订单提醒邮件，便于您及时了解订单状态!');
    if (!wx.isEmpty(email)) {
        $('#email_notice_id').html('<span style="color:#D20000;">请填写邮件地址!</span>');
        return false;
    }

    $('#post_code_notice_id').html('请填写准确的邮编，以便商品能尽快送达!');
    if (!wx.isEmpty(postCode)) {
        $('#post_code_notice_id').html('<span style="color:#D20000;">请填写邮编!</span>');
        return false;
    }

    var url = 'order/order/saveAddress';
    var param = 'recent_name='+ recentName+'&province='+ province+'&city='+ city+'&area='+ area+
        '&detail_address='+ detailAddress+'&phone_num='+ phoneNum+'&area_num='+ areaNum+'&call_num='+callNum+'&email='+ email+'&post_code='+ postCode;
    var data = wx.ajax(url, param);

    if (data.error == '30009') {
        wx.pageReload();
    }
    //saveAddress
}
