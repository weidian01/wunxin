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



/**
 * 产品错误代码  --  产品相关错误代码以 20 开头
 */
$error[20001] = array('error' => '20001', 'msg' => '产品不合法', 'code' => 'product_illegal');
$error[20002] = array('error' => '20002', 'msg' => '产品不存在', 'code' => 'product_does_not_exist');
$error[20003] = array('error' => '20003', 'msg' => '产品收藏成功', 'code' => 'product_favorite_success');



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



/**
 * 其他错误代码  --  其他相关错误代码以 70 开头
 */
$error[99999] = array('error' => '99999', 'msg' => '未知错误', 'code' => 'unknown_error');



return $error;