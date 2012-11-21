/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-20
 * Time: 下午7:01
 * To change this template use File | Settings | File Templates.
 */
var promotion = {
    'promotion_rule' : {
        '1':{'name':'产品折扣','rule':'5', 'notice':'全场或指定产品优惠，例：产品5折', 'product_rule':false},
        '2':{'name':'第N件折扣','rule':'2,5', 'notice':'全场或指定产品第N件N折,例：第2件5折', 'product_rule':false},
        '3':{'name':'满N减N','rule':'100,10', 'notice':'全场或指定产品满N减N优惠,例：满100减10', 'product_rule':true}
    }
};

//初始化折扣活动模板与活动规则
promotion.init = function(generaType, initKey, initRule)
{
    var html = '';
    var isSelected = '';
    var rule = promotion.promotion_rule;//console.log(rule[initKey]);

    initKey = wx.isEmpty(initKey) ? initKey : 1;
    initRule = wx.isEmpty(initRule)  ? initRule : rule[initKey].rule;
    generaType = wx.isEmpty(generaType) ? generaType : 1;
    //console.log(generaType);
    for (var i in rule) {
        if (generaType > 1 && !rule[i].product_rule) {
            continue;
        }
        isSelected = (initKey == i) ? 'selected="selected"' : '';
        html += '<option value="'+i+'" '+isSelected+'>'+rule[i].name+'</option>';
    }

    $('#promotion_type').html(html);
    //$('#rule_id').value = rule[initKey].rule;
    $('#rule_id').val(initRule);
    $('#rule_notice').html(rule[initKey].notice);
}