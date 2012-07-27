<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-5-31
 * Time: 下午10:53
 * To change this template use File | Settings | File Templates.
 */



/**
 * 用户错误代码  --  用户相关错误代码以 10 开头
 */
$error[10000] = array('error' => '10000', 'msg' => '登陆成功', 'code' => 'login_success');
$error[10001] = array('error' => '10001', 'msg' => '用户名不合法', 'code' => 'username_illegal');
$error[10002] = array('error' => '10002', 'msg' => '用户已存在', 'code' => 'user_already_exists');
$error[10003] = array('error' => '10003', 'msg' => '两次输入密码不一致', 'code' => 'twice_input_password_inconsistent');
$error[10004] = array('error' => '10004', 'msg' => '密码不合法', 'code' => 'password_illegal');
$error[10005] = array('error' => '10005', 'msg' => '验证码错误', 'code' => 'verification_code_error');
$error[10006] = array('error' => '10006', 'msg' => '用户不存在', 'code' => 'user_does_not_exist');
$error[10007] = array('error' => '10007', 'msg' => '密码错误', 'code' => 'password_error');
$error[10008] = array('error' => '10008', 'msg' => '注册用户失败', 'code' => 'register_user_failure');
$error[10009] = array('error' => '10009', 'msg' => '用户未登陆', 'code' => 'User_not_logged');

$error[10010] = array('error' => '10010', 'msg' => '评论设计师成功', 'code' => 'comment_designer_success');
$error[10011] = array('error' => '10011', 'msg' => '评论设计师失败', 'code' => 'comment_designer_failure');
$error[10012] = array('error' => '10012', 'msg' => '评论设计师参数不全', 'code' => 'comment_designer_parameter_failure');

$error[10013] = array('error' => '10013', 'msg' => '评论设计师回复成功', 'code' => 'reply_comment_designer_success');
$error[10014] = array('error' => '10014', 'msg' => '评论设计师回复失败', 'code' => 'reply_comment_designer_failure');
$error[10015] = array('error' => '10015', 'msg' => '评论设计师回复参数不全', 'code' => 'reply_comment_designer_parameter_failure');

$error[10016] = array('error' => '10016', 'msg' => '设计师评论不存在', 'code' => 'comment_designer_not_exist');

$error[10017] = array('error' => '10017', 'msg' => '收藏设计师成功', 'code' => 'favorite_designer_success');
$error[10018] = array('error' => '10018', 'msg' => '收藏设计师失败', 'code' => 'favorite_designer_failure');
$error[10019] = array('error' => '10019', 'msg' => '收藏设计师参数不全', 'code' => 'favorite_designer_parameter_failure');

$error[10020] = array('error' => '10020', 'msg' => '删除收藏的设计师成功', 'code' => 'delete_favorite_designer_success');
$error[10021] = array('error' => '10021', 'msg' => '删除收藏的设计师失败', 'code' => 'delete_favorite_designer_failure');
$error[10022] = array('error' => '10022', 'msg' => '删除收藏的设计师参数不全', 'code' => 'delete_favorite_designer_parameter_failure');

$error[10023] = array('error' => '10023', 'msg' => '清空收藏的设计师成功', 'code' => 'empty_favorite_designer_success');
$error[10024] = array('error' => '10024', 'msg' => '清空收藏的设计师失败', 'code' => 'empty_favorite_designer_failure');

$error[10025] = array('error' => '10025', 'msg' => '设置用户收货地址成功', 'code' => 'setting_user_recent_address_success');
$error[10026] = array('error' => '10026', 'msg' => '设置用户收货地址失败', 'code' => 'setting_user_recent_address_failure');
$error[10027] = array('error' => '10027', 'msg' => '设置用户收货地址参数不全', 'code' => 'setting_user_recent_address_parameter_failure');

$error[10028] = array('error' => '10028', 'msg' => '编码用户收货地址参数不全', 'code' => 'edit_user_recent_address_parameter_failure');
$error[10029] = array('error' => '10029', 'msg' => '获取用户收货地址成功', 'code' => 'get_user_recent_address_success');
$error[10030] = array('error' => '10030', 'msg' => '编码用户收货地址失败', 'code' => 'edit_user_recent_address_failure');

$error[10031] = array('error' => '10031', 'msg' => '删除用户收货地址失败', 'code' => 'delete_user_recent_address_failure');
$error[10032] = array('error' => '10032', 'msg' => '删除用户收货地址成功', 'code' => 'delete_user_recent_address_success');
$error[10033] = array('error' => '10033', 'msg' => '删除用户收货地址参数不全', 'code' => 'delete_user_recent_address_parameter_failure');

$error[10034] = array('error' => '10034', 'msg' => '注册用户成功', 'code' => 'register_user_success');

$error[10035] = array('error' => '10035', 'msg' => '用户可以使用', 'code' => 'you_can_use_the');

$error[10036] = array('error' => '10036', 'msg' => '修改密码成功', 'code' => 'modify_password_success');
$error[10037] = array('error' => '10037', 'msg' => '修改密码失败', 'code' => 'modify_password_failure');
$error[10038] = array('error' => '10038', 'msg' => '修改密码参数不全', 'code' => 'modify_password_parameter_failure');

$error[10039] = array('error' => '10039', 'msg' => '保存用户昵称失败', 'code' => 'save_user_nickname_failure');
$error[10040] = array('error' => '10040', 'msg' => '保存用户信息失败', 'code' => 'save_user_info_failure');

$error[10041] = array('error' => '10041', 'msg' => '删除设计师留言参数不全', 'code' => 'delete_designer_message_parameter_failure');
$error[10042] = array('error' => '10042', 'msg' => '删除设计师留言失败', 'code' => 'delete_designer_message_failure');




/**
 * 产品错误代码  --  产品相关错误代码以 20 开头
 */
$error[20001] = array('error' => '20001', 'msg' => '产品不合法', 'code' => 'product_illegal');

$error[20002] = array('error' => '20002', 'msg' => '产品不存在', 'code' => 'product_does_not_exist');

$error[20004] = array('error' => '20004', 'msg' => '产品晒单成功', 'code' => 'product_share_success');
$error[20005] = array('error' => '20005', 'msg' => '产品晒单失败', 'code' => 'product_share_failure');
$error[20006] = array('error' => '20006', 'msg' => '产品晒单参数不全', 'code' => 'product_share_parameter_failure');

$error[20007] = array('error' => '20007', 'msg' => '喜欢晒单产品成功', 'code' => 'like_share_product_success');
$error[20008] = array('error' => '20008', 'msg' => '喜欢晒单产品失败', 'code' => 'like_share_product_failure');
$error[20009] = array('error' => '20009', 'msg' => '喜欢晒单产品参数不全', 'code' => 'like_share_product_parameter_failure');

$error[20010] = array('error' => '20010', 'msg' => '产品收藏成功', 'code' => 'product_favorite_success');
$error[20011] = array('error' => '20011', 'msg' => '产品收藏失败', 'code' => 'product_favorite_failure');
$error[20012] = array('error' => '20012', 'msg' => '产品收藏参数不全', 'code' => 'product_favorite_parameter_failure');

$error[20013] = array('error' => '20013', 'msg' => '删除收藏成功', 'code' => 'delete_favorite_success');
$error[20014] = array('error' => '20014', 'msg' => '删除收藏失败', 'code' => 'delete_favorite_failure');
$error[20015] = array('error' => '20015', 'msg' => '删除收藏参数不全', 'code' => 'delete_favorite_parameter_failure');

$error[20016] = array('error' => '20016', 'msg' => '清空收藏夹成功', 'code' => 'empty_favorite_success');
$error[20017] = array('error' => '20017', 'msg' => '清空收藏夹失败', 'code' => 'empty_favorite_failure');

$error[20018] = array('error' => '20018', 'msg' => '产品晒单评论成功', 'code' => 'product_share_comment_success');
$error[20019] = array('error' => '20019', 'msg' => '产品晒单评论失败', 'code' => 'product_share_comment_failure');
$error[20020] = array('error' => '20020', 'msg' => '产品晒单评论参数不全', 'code' => 'product_share_comment_parameter_failure');

$error[20021] = array('error' => '20021', 'msg' => '删除产品评论参数不全', 'code' => 'delete_product_comment_parameter_failure');
$error[20022] = array('error' => '20022', 'msg' => '删除产品评论失败', 'code' => 'delete_product_comment_failure');

$error[20023] = array('error' => '20023', 'msg' => '删除产品问答失败', 'code' => 'delete_product_comment_failure');
$error[20024] = array('error' => '20024', 'msg' => '删除产品问答参数不全', 'code' => 'delete_product_comment_parameter_failure');

$error[20025] = array('error' => '20025', 'msg' => '删除产品参数不全', 'code' => 'delete_product_parameter_failure');
$error[20026] = array('error' => '20026', 'msg' => '删除产品失败', 'code' => 'delete_product_failure');



/**
 * 订单错误代码  --  订单相关错误代码以 30 开头
 */
$error[30001] = array('error' => '30001', 'msg' => '订单不合法', 'code' => 'order_illegal');

$error[30002] = array('error' => '30002', 'msg' => '添加发票成功', 'code' => 'add_invoice_success');
$error[30003] = array('error' => '30003', 'msg' => '添加发票失败', 'code' => 'add_invoice_failure');
$error[30004] = array('error' => '30004', 'msg' => '添加发票参数不会', 'code' => 'add_invoice_parameter_failure');

$error[30005] = array('error' => '30005', 'msg' => '编码发票参数不全', 'code' => 'edit_invoice_parameter_failure');

$error[30006] = array('error' => '30006', 'msg' => '删除发票成功', 'code' => 'delete_invoice_success');
$error[30007] = array('error' => '30007', 'msg' => '删除发票失败', 'code' => 'delete_invoice_failure');
$error[30008] = array('error' => '30008', 'msg' => '删除发票参数不全', 'code' => 'delete_invoice_parameter_failure');

$error[30009] = array('error' => '30009', 'msg' => '保存收货地址成功', 'code' => 'save_recent_address_success');
$error[30010] = array('error' => '30010', 'msg' => '保存收货地址失败', 'code' => 'save_recent_address_failure');
$error[30011] = array('error' => '30011', 'msg' => '保存收货地址参数不全', 'code' => 'save_recent_address_parameter_failure');
$error[30012] = array('error' => '30012', 'msg' => '修改收货地址参失败', 'code' => 'save_recent_address_parameter_failure');

$error[30013] = array('error' => '30013', 'msg' => '添加订单成功', 'code' => 'add_order_success');
$error[30014] = array('error' => '30014', 'msg' => '添加订单失败', 'code' => 'add_order_failure');
$error[30015] = array('error' => '30015', 'msg' => '添加订单参数不全', 'code' => 'add_order_parameter_failure');
$error[30016] = array('error' => '30016', 'msg' => '收货地址为空', 'code' => 'recent_address_empty');



/**
 * 设计图错误代码  --  设计图相关错误代码以 40 开头
 */
$error[40001] = array('error' => '40001', 'msg' => '设计图不合法', 'code' => 'artwork_illegal');

$error[40002] = array('error' => '40002', 'msg' => '添加设计图评论成功', 'code' => 'add_design_comment_success');
$error[40003] = array('error' => '40003', 'msg' => '添加设计图评论失败', 'code' => 'add_design_comment_failure');
$error[40004] = array('error' => '40004', 'msg' => '添加设计图评论参数不全', 'code' => 'add_design_comment_parameter_failure');

$error[40005] = array('error' => '40005', 'msg' => '设计图不存在', 'code' => 'design_not_exist');

$error[40006] = array('error' => '40006', 'msg' => '评论不存在', 'code' => 'comment_not_exist');

$error[40007] = array('error' => '40007', 'msg' => '添加设计图评论回复成功', 'code' => 'add_design_comment_reply_success');
$error[40008] = array('error' => '40008', 'msg' => '添加设计图评论回复失败', 'code' => 'add_design_comment_reply_failure');
$error[40009] = array('error' => '40009', 'msg' => '添加设计图评论回复参数不全', 'code' => 'add_design_comment_reply_parameter_failure');

$error[40010] = array('error' => '40010', 'msg' => '添加设计图收藏成功', 'code' => 'add_design_favorite_success');
$error[40011] = array('error' => '40011', 'msg' => '添加设计图收藏失败', 'code' => 'add_design_favorite_failure');
$error[40012] = array('error' => '40012', 'msg' => '添加设计图收藏参数不全', 'code' => 'add_design_favorite_parameter_failure');

$error[40013] = array('error' => '40013', 'msg' => '删除设计图收藏成功', 'code' => 'delete_design_favorite_success');
$error[40014] = array('error' => '40014', 'msg' => '删除设计图收藏失败', 'code' => 'delete_design_favorite_failure');
$error[40015] = array('error' => '40015', 'msg' => '删除设计图收藏参数不全', 'code' => 'delete_design_favorite_parameter_failure');

$error[40016] = array('error' => '40016', 'msg' => '清空用户设计图收藏夹成功', 'code' => 'empty_user_design_favorite_success');
$error[40017] = array('error' => '40017', 'msg' => '清空用户设计图收藏夹失败', 'code' => 'empty_user_design_favorite_failure');

$error[40018] = array('error' => '40018', 'msg' => '设计图投票成功', 'code' => 'design_vote_success');
$error[40019] = array('error' => '40019', 'msg' => '设计图投票失败', 'code' => 'design_vote_failure');
$error[40020] = array('error' => '40020', 'msg' => '设计图投票参数不全', 'code' => 'design_vote_parameter_failure');

$error[40021] = array('error' => '40021', 'msg' => '删除设计图投票成功', 'code' => 'delete_design_vote_success');
$error[40022] = array('error' => '40022', 'msg' => '删除设计图投票失败', 'code' => 'delete_design_vote_failure');
$error[40023] = array('error' => '40023', 'msg' => '删除设计图投票参数不全', 'code' => 'delete_design_vote_parameter_failure');
$error[40024] = array('error' => '40024', 'msg' => '无权限删除此设计图投票', 'code' => 'no_permission_remove_the_vote_of_this_design');

$error[40025] = array('error' => '40025', 'msg' => '删除设计图参数不全', 'code' => 'delete_design_parameter_failure');
$error[40026] = array('error' => '40026', 'msg' => '删除设计图失败', 'code' => 'delete_design_failure');

$error[40027] = array('error' => '40027', 'msg' => '删除设计图评论参数不全', 'code' => 'delete_design_comment_parameter_failure');
$error[40028] = array('error' => '40028', 'msg' => '删除设计图评论失败', 'code' => 'delete_design_comment_failure');


/**
 * 评论错误代码  --  评论相关错误代码以 50 开头
 */
$error[50001] = array('error' => '50001', 'msg' => '评论不合法', 'code' => 'comment_illegal');
$error[50002] = array('error' => '50002', 'msg' => '未购买产品不能评论', 'code' => 'not_buy_product_can_not_comment');
$error[50003] = array('error' => '50003', 'msg' => '添加评论失败', 'code' => 'add_comment_failure');
$error[50004] = array('error' => '50004', 'msg' => '重复投票', 'code' => 'repeat_voting');
$error[50005] = array('error' => '50005', 'msg' => '评论是否有效提供成功', 'code' => 'comment_whether_effective_delivery_successful');
$error[50006] = array('error' => '50006', 'msg' => '评论回复成功', 'code' => 'comment_reply_success');
$error[50007] = array('error' => '50007', 'msg' => '评论回复失败', 'code' => 'comment_reply_failure');
$error[50008] = array('error' => '50008', 'msg' => '评论参数不全', 'code' => 'comment_parameter_failure');
$error[50009] = array('error' => '50009', 'msg' => '评论是否有效提供失败', 'code' => 'comment_whether_effective_delivery_failure');

$error[50010] = array('error' => '50010', 'msg' => '疑难问答参数不全', 'code' => 'qa_parameter_failure');
$error[50011] = array('error' => '50011', 'msg' => '疑难问答提交失败', 'code' => 'qa_delivery_failure');
$error[50012] = array('error' => '50012', 'msg' => '疑难问答提交成功', 'code' => 'qa_delivery_success');
$error[50013] = array('error' => '50013', 'msg' => '疑难问答是否有效提供成功', 'code' => 'qa_whether_effective_delivery_successful');
$error[50014] = array('error' => '50014', 'msg' => '疑难问答是否有效提供失败', 'code' => 'qa_whether_effective_delivery_failure');
$error[50015] = array('error' => '50015', 'msg' => '疑难问答是否有效参数不全', 'code' => 'qa_whether_effective_parameter_failure');
$error[50016] = array('error' => '50016', 'msg' => '疑难问答回复成功', 'code' => 'qa_whether_effective_reply_successful');
$error[50017] = array('error' => '50017', 'msg' => '疑难问答回复失败', 'code' => 'qa_whether_effective_reply_failure');
$error[50018] = array('error' => '50018', 'msg' => '疑难问答回复参数不全', 'code' => 'qa_whether_effective_reply_failure');


/**
 * 购物车错误代码 -- 购物车相关错误代码以60开头
 */
$error[60001] = array('error' => '60001', 'msg' => '添加产品到购物车成功', 'code' => 'add_products_to_cart_successful');
$error[60002] = array('error' => '60002', 'msg' => '添加产品到购物车失败', 'code' => 'add_products_to_cart_failure');
$error[60003] = array('error' => '60003', 'msg' => '添加产品到购物车参数不全', 'code' => 'add_products_to_cart_parameter_failure');


$error[60004] = array('error' => '60004', 'msg' => '更改购物车产品数量成功', 'code' => 'change_cart_products_successful');
$error[60005] = array('error' => '60005', 'msg' => '更改购物车产品数量失败', 'code' => 'change_cart_products_failure');
//$error[60006] = array('error' => '60006', 'msg' => '更改购物车产品数量参数不全', 'code' => 'change_cart_products_parameter_failure');
$error[60007] = array('error' => '60007', 'msg' => '更改购物车产品数量值错误', 'code' => 'change_cart_products_number_value_failure');

$error[60008] = array('error' => '60008', 'msg' => '删除/重新添加产品至购物车中成功', 'code' => 'remove_re_add_product_to_shopping_cart_success');
$error[60009] = array('error' => '60009', 'msg' => '删除/重新添加产品至购物车中失败', 'code' => 'remove_re_add_product_to_shopping_cart_failure');
$error[60010] = array('error' => '60010', 'msg' => '删除/重新添加产品至购物车中参数错误', 'code' => 'remove_re_add_product_to_shopping_cart_parameter_failure');

$error[60011] = array('error' => '60011', 'msg' => '清空用户购物车成功', 'code' => 'empty_shopping_cart_success');
$error[60012] = array('error' => '60012', 'msg' => '清空用户购物车失败', 'code' => 'empty_shopping_cart_failure');
$error[60013] = array('error' => '60013', 'msg' => '清空用户购物车参数不全', 'code' => 'empty_shopping_cart_parameter_failure');

$error[60014] = array('error' => '60014', 'msg' => '取出用户购物车中产品成功', 'code' => 'remove_user_shopping_cart_product_success');
$error[60015] = array('error' => '60015', 'msg' => '取出用户购物车中产品失败', 'code' => 'remove_user_shopping_cart_product_failure');
$error[60016] = array('error' => '60016', 'msg' => '取出用户购物车中产品参数不全', 'code' => 'remove_user_shopping_cart_product_parameter_failure');

$error[60017] = array('error' => '60017', 'msg' => '存储用户购物车中产品到数据库成功', 'code' => 'storage_user_shopping_cart_product_to_database_success');
$error[60018] = array('error' => '60018', 'msg' => '用户购物车为空', 'code' => 'user_shopping_cart_empty');
$error[60019] = array('error' => '60019', 'msg' => '存储用户购物车中产品到数据库失败', 'code' => 'storage_user_shopping_cart_product_to_database_failure');


/**
 * 业务错误代码 -- 相关业务错误代码以 70 开头
 */
$error[70001] = array('error' => '70001', 'msg' => '卡密码错误', 'code' => 'card_password_error');
$error[70002] = array('error' => '70002', 'msg' => '绑定卡失败', 'code' => 'banding_card_failure');
$error[70003] = array('error' => '70003', 'msg' => '绑定卡参数不全', 'code' => 'banding_card_parameter_failure');
$error[70004] = array('error' => '70004', 'msg' => '卡已经绑定', 'code' => 'card_already_banding_success');

$error[70005] = array('error' => '70005', 'msg' => '订阅邮件列表成功', 'code' => 'subscribe_mail_list_success');
$error[70006] = array('error' => '70006', 'msg' => '订阅邮件列表失败', 'code' => 'subscribe_mail_list_failure');
$error[70007] = array('error' => '70007', 'msg' => '订阅邮件列表参数不全', 'code' => 'subscribe_mail_list_parameter_failure');

$error[70008] = array('error' => '70008', 'msg' => '退订邮件列表成功', 'code' => 'unSubscribe_mail_list_success');
$error[70009] = array('error' => '70009', 'msg' => '退订邮件列表失败', 'code' => 'unSubscribe_mail_list_failure');
$error[70010] = array('error' => '70010', 'msg' => '退订邮件列表参数不全', 'code' => 'unSubscribe_mail_list_parameter_failure');

$error[70011] = array('error' => '70011', 'msg' => '删除礼物卡参数不全', 'code' => 'delete_gift_card_parameter_failure');
$error[70012] = array('error' => '70012', 'msg' => '删除礼物卡失败', 'code' => 'delete_gift_card_failure');



/**
 * 其他错误代码  --  其他相关错误代码以 70 开头
 */
$error[99001] = array('error' => '99001', 'msg' => '添加系统建议与意见成功', 'code' => 'add_system_proposal_success');
$error[99002] = array('error' => '99002', 'msg' => '添加系统建议与意见失败', 'code' => 'add_system_proposal_failure');
$error[99003] = array('error' => '99003', 'msg' => '添加系统建议与意见参数不全', 'code' => 'add_system_proposal_parameter_failure');
$error[99004] = array('error' => '99004', 'msg' => '参数为空', 'code' => 'parameter_failure');
$error[99005] = array('error' => '99005', 'msg' => '获取成功', 'code' => 'get_success');

$error[99999] = array('error' => '99999', 'msg' => '未知错误', 'code' => 'unknown_error');







return $error;