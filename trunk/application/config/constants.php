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

define('ORDER_INVALID', 0); //订单已取消
define('ORDER_NORMAL', 1);  //订单默认状态
define('ORDER_CONFIRM', 2); //订单乙确认

define('ORDER_PAY_INIT', 0); //未支付
define('ORDER_PAY_SUCC', 1); //支付成功
define('ORDER_PAY_FAIL', 2);  //支付失败
define('ORDER_PAY_DEFECT', 3);  //支付部分

define('PICKING_NOT', 0); //未配货
define('PICKING_CONDUCT', 1); //配货中
define('PICKING_COMPLETED', 2);  //配货完成

/* End of file constants.php */
/* Location: ./application/config/constants.php */