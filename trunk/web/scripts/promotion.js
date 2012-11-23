/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-20
 * Time: 下午7:01
 * To change this template use File | Settings | File Templates.
 */
//pay_type 1 产品， 0 订单     discount_type：1 送，2 折，3 减
var promotion = {
    'promotion_rule' : {
        '1':{'name':'产品折扣','rule':'5', 'notice':'全场或指定产品优惠，例：产品5折', discount_type:2, pay_type:1},
        '2':{'name':'第N件X折扣','rule':'2,5', 'notice':'全场或指定产品第N件X折,例：第2件5折', discount_type:2, pay_type:1},
        '3':{'name':'满N件X折扣','rule':'2,7.5', 'notice':'全场或指定产品满N件X折优惠,例：满2件7.5折', discount_type:2, pay_type:1},
        '100':{'name':'订单满N元X折优惠','rule':'100,7', 'notice':'订单满N元X折优惠,例：满100元7折', discount_type:2, pay_type:0},
        '101':{'name':'订单满N元减X元优惠','rule':'100,10', 'notice':'订单满N元减X元优惠,例：满100元减10元', discount_type:3, pay_type:0}
    }
};

//初始化折扣活动模板与活动规则
promotion.init = function(initKey, initRule)
{
    var html = '';
    var isSelected = '';
    var rule = promotion.promotion_rule;//console.log(rule[initKey]);

    initKey = wx.isEmpty(initKey) ? initKey : 1;
    initRule = wx.isEmpty(initRule)  ? initRule : rule[initKey].rule;
    //generaType = wx.isEmpty(generaType) ? generaType : 1;

    for (var i in rule) {
        isSelected = (initKey == i) ? 'selected="selected"' : '';
        html += '<option value="'+i+'" '+isSelected+'>'+rule[i].name+'</option>';
    }

    $('#promotion_type').html(html);
    //$('#rule_id').value = rule[initKey].rule;
    $('#rule_id').val(initRule);
    $('#rule_notice').html(rule[initKey].notice);

    //改变结算方式的值
    $('#pay_type_id option').each(function(k, v){
        if (k == rule[initKey].pay_type) {
            v.selected = true;
        }
    });

    $('#discount_type_id option').each(function(i, n){
        if (k == rule[initKey].discount_type) {
            v.selected = true;
        }
    });
}