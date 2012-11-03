<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'a');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

//文件分隔符
define('DS', DIRECTORY_SEPARATOR);

//上传文件目录
define('UPLOAD', WEBROOT.DS.'upload'.DS);

define('PAY_ONLINE', '1');//在线支付
define('PAY_CASHDELIVERY', '2');//货到付款
define('PAY_POST', '3');//邮政汇款
define('PAY_SELF', '4');//来万象自提
define('PAY_COMPANY', '5');//公司汇款


define('ORDER_INVALID', '0'); //订单已取消
define('ORDER_NORMAL', '1');  //订单默认状态
define('ORDER_CONFIRM', '2'); //订单已确认

define('ORDER_PAY_INIT', '0'); //未支付
define('ORDER_PAY_SUCC', '1'); //支付成功
define('ORDER_PAY_FAIL', '2');  //支付失败
define('ORDER_PAY_DEFECT', '3');  //支付部分

define('PICKING_NOT', '0'); //未配货
define('PICKING_CONDUCT', '1'); //配货中
define('PICKING_COMPLETED', '2');  //配货完成

define('DELIVERT_TIME_ANY', '1');//1工作日、双休日与假日均可送货
define('DELIVERT_TIME_HOLIDAY', '2');//2只双休日、假日送货
define('DELIVERT_TIME_WORK', '3');//3只工作日送货
define('DELIVERT_TIME_SCHOOL', '4');//4学校地址、白天没有

//订单支付超时时间
define('TIME_OUT_PAY_ONLINE', 86400);//在线支付超时时间，1天。
define('TIME_OUT_PAY_CASHDELIVERY', 1209600);//货到付款超时时间，14天。
define('TIME_OUT_PAY_POST', 259200);//邮政支付超时时间，3天。
define('TIME_OUT_PAY_SELF', 604800);//来万象自提超时时间，7天。
define('TIME_OUT_PAY_COMPANY', 86400);//来万象自提超时时间，1天。

/* End of file constants.php */
/* Location: ./application/config/constants.php */