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
$error[10001] = array('error' => '10001', 'msg' => '用户名不合法', 'code' => 'username_illegal');

$error[10002] = array('error' => '10002', 'msg' => '用户已存在', 'code' => 'user_already_exists');

$error[10003] = array('error' => '10003', 'msg' => '两次输入密码不一致', 'code' => 'twice_input_password_inconsistent');

$error[10004] = array('error' => '10004', 'msg' => '密码不合法', 'code' => 'password_illegal');

$error[10005] = array('error' => '10005', 'msg' => '验证码错误', 'code' => 'verification_code_error');

$error[10006] = array('error' => '10006', 'msg' => '用户不存在', 'code' => 'user_does_not_exist');

$error[10007] = array('error' => '10007', 'msg' => '密码错误', 'code' => 'password_error');

$error[10008] = array('error' => '10008', 'msg' => '注册用户失败', 'code' => 'register_user_failure');

$error[10009] = array('error' => '10009', 'msg' => '用户未登陆', 'code' => 'User_not_logged');



/**
 * 产品错误代码  --  产品相关错误代码以 20 开头
 */
$error[20001] = array('error' => '20001', 'msg' => '产品不合法', 'code' => 'product_illegal');

$error[20002] = array('error' => '20002', 'msg' => '产品不存在', 'code' => 'product_does_not_exist');

$error[20003] = array('error' => '20003', 'msg' => '产品收藏成功', 'code' => 'product_favorite_success');

$error[20004] = array('error' => '20004', 'msg' => '产品晒单成功', 'code' => 'product_share_success');

$error[20005] = array('error' => '20005', 'msg' => '产品晒单失败', 'code' => 'product_share_failure');

$error[20006] = array('error' => '20006', 'msg' => '产品晒单参数不全', 'code' => 'product_share_parameter_failure');

$error[20007] = array('error' => '20007', 'msg' => '喜欢晒单产品成功', 'code' => 'like_share_product_success');

$error[20008] = array('error' => '20008', 'msg' => '喜欢晒单产品失败', 'code' => 'like_share_product_failure');

$error[20009] = array('error' => '20009', 'msg' => '喜欢晒单产品参数不全', 'code' => 'like_share_product_parameter_failure');



/**
 * 订单错误代码  --  订单相关错误代码以 30 开头
 */
$error[30001] = array('error' => '30001', 'msg' => '订单不合法', 'code' => 'order_illegal');



/**
 * 设计图错误代码  --  设计图相关错误代码以 40 开头
 */
$error[40001] = array('error' => '40001', 'msg' => '设计图不合法', 'code' => 'artwork_illegal');



/**
 * 评论错误代码  --  评论相关错误代码以 50 开头
 */
$error[50001] = array('error' => '50001', 'msg' => '评论不合法', 'code' => 'comment_illegal');

$error[50002] = array('error' => '50002', 'msg' => '未购买产品不能评论', 'code' => 'not_buy_product_can_not_comment');

$error[50003] = array('error' => '50003', 'msg' => '添加评论失败', 'code' => 'add_comment_failure');

$error[50004] = array('error' => '50004', 'msg' => '评论成功', 'code' => 'comment_success');

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
 * 其他错误代码  --  其他相关错误代码以 70 开头
 */
$error[99999] = array('error' => '99999', 'msg' => '未知错误', 'code' => 'unknown_error');



return $error;