<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Common Functions
 *
 * Loads the base classes and executes the request.
 *
 * @package		CodeIgniter
 * @subpackage	codeigniter
 * @category	Common Functions
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/
 */

// ------------------------------------------------------------------------

/**
* Determines if the current version of PHP is greater then the supplied value
*
* Since there are a few places where we conditionally test for PHP > 5
* we'll set a static variable.
*
* @access	public
* @param	string
* @return	bool	TRUE if the current version is $version or higher
*/
if ( ! function_exists('is_php'))
{
	function is_php($version = '5.0.0')
	{
		static $_is_php;
		$version = (string)$version;

		if ( ! isset($_is_php[$version]))
		{
			$_is_php[$version] = (version_compare(PHP_VERSION, $version) < 0) ? FALSE : TRUE;
		}

		return $_is_php[$version];
	}
}

// ------------------------------------------------------------------------

/**
 * Tests for file writability
 *
 * is_writable() returns TRUE on Windows servers when you really can't write to
 * the file, based on the read-only attribute.  is_writable() is also unreliable
 * on Unix servers if safe_mode is on.
 *
 * @access	private
 * @return	void
 */
if ( ! function_exists('is_really_writable'))
{
	function is_really_writable($file)
	{
		// If we're on a Unix server with safe_mode off we call is_writable
		if (DIRECTORY_SEPARATOR == '/' AND @ini_get("safe_mode") == FALSE)
		{
			return is_writable($file);
		}

		// For windows servers and safe_mode "on" installations we'll actually
		// write a file then read it.  Bah...
		if (is_dir($file))
		{
			$file = rtrim($file, '/').'/'.md5(mt_rand(1,100).mt_rand(1,100));

			if (($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
			{
				return FALSE;
			}

			fclose($fp);
			@chmod($file, DIR_WRITE_MODE);
			@unlink($file);
			return TRUE;
		}
		elseif ( ! is_file($file) OR ($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
		{
			return FALSE;
		}

		fclose($fp);
		return TRUE;
	}
}

// ------------------------------------------------------------------------

/**
* Class registry
*
* This function acts as a singleton.  If the requested class does not
* exist it is instantiated and set to a static variable.  If it has
* previously been instantiated the variable is returned.
*
* @access	public
* @param	string	the class name being requested
* @param	string	the directory where the class should be found
* @param	string	the class name prefix
* @return	object
*/
if ( ! function_exists('load_class'))
{
	function &load_class($class, $directory = 'libraries', $prefix = 'CI_')
	{
		static $_classes = array();

		// Does the class exist?  If so, we're done...
		if (isset($_classes[$class]))
		{
			return $_classes[$class];
		}

		$name = FALSE;

		// Look for the class first in the local application/libraries folder
		// then in the native system/libraries folder
		foreach (array(APPPATH, BASEPATH) as $path)
		{
			if (file_exists($path.$directory.'/'.$class.'.php'))
			{
				$name = $prefix.$class;

				if (class_exists($name) === FALSE)
				{
					require($path.$directory.'/'.$class.'.php');
				}

				break;
			}
		}

		// Is the request a class extension?  If so we load it too
		if (file_exists(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php'))
		{
			$name = config_item('subclass_prefix').$class;

			if (class_exists($name) === FALSE)
			{
				require(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php');
			}
		}

		// Did we find the class?
		if ($name === FALSE)
		{
			// Note: We use exit() rather then show_error() in order to avoid a
			// self-referencing loop with the Excptions class
			exit('Unable to locate the specified class: '.$class.'.php');
		}

		// Keep track of what we just loaded
		is_loaded($class);
		$_classes[$class] = new $name();
		return $_classes[$class];
	}
}

// --------------------------------------------------------------------

/**
* Keeps track of which libraries have been loaded.  This function is
* called by the load_class() function above
*
* @access	public
* @return	array
*/
if ( ! function_exists('is_loaded'))
{
	function is_loaded($class = '')
	{
		static $_is_loaded = array();

		if ($class != '')
		{
			$_is_loaded[strtolower($class)] = $class;
		}

		return $_is_loaded;
	}
}

// ------------------------------------------------------------------------

/**
* Loads the main config.php file
*
* This function lets us grab the config file even if the Config class
* hasn't been instantiated yet
*
* @access	private
* @return	array
*/
if ( ! function_exists('get_config'))
{
	function &get_config($replace = array())
	{
		static $_config;

		if (isset($_config))
		{
			return $_config[0];
		}

		// Is the config file in the environment folder?
		if ( ! defined('ENVIRONMENT') OR ! file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/config.php'))
		{
			$file_path = APPPATH.'config/config.php';
		}

		// Fetch the config file
		if ( ! file_exists($file_path))
		{
			exit('The configuration file does not exist.');
		}

		require($file_path);

		// Does the $config array exist in the file?
		if ( ! isset($config) OR ! is_array($config))
		{
			exit('Your config file does not appear to be formatted correctly.');
		}

		// Are any values being dynamically replaced?
		if (count($replace) > 0)
		{
			foreach ($replace as $key => $val)
			{
				if (isset($config[$key]))
				{
					$config[$key] = $val;
				}
			}
		}

		return $_config[0] =& $config;
	}
}

// ------------------------------------------------------------------------

/**
* Returns the specified config item
*
* @access	public
* @return	mixed
*/
if ( ! function_exists('config_item'))
{
	function config_item($item)
	{
		static $_config_item = array();

		if ( ! isset($_config_item[$item]))
		{
			$config =& get_config();

			if ( ! isset($config[$item]))
			{
				return FALSE;
			}
			$_config_item[$item] = $config[$item];
		}

		return $_config_item[$item];
	}
}

// ------------------------------------------------------------------------

/**
* Error Handler
*
* This function lets us invoke the exception class and
* display errors using the standard error template located
* in application/errors/errors.php
* This function will send the error page directly to the
* browser and exit.
*
* @access	public
* @return	void
*/
if ( ! function_exists('show_error'))
{
	function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered')
	{
		$_error =& load_class('Exceptions', 'core');
		echo $_error->show_error($heading, $message, 'error_general', $status_code);
		exit;
	}
}

// ------------------------------------------------------------------------

/**
* 404 Page Handler
*
* This function is similar to the show_error() function above
* However, instead of the standard error template it displays
* 404 errors.
*
* @access	public
* @return	void
*/
if ( ! function_exists('show_404'))
{
	function show_404($page = '', $log_error = TRUE)
	{
		$_error =& load_class('Exceptions', 'core');
		$_error->show_404($page, $log_error);
		exit;
	}
}

// ------------------------------------------------------------------------

/**
* Error Logging Interface
*
* We use this as a simple mechanism to access the logging
* class and send messages to be logged.
*
* @access	public
* @return	void
*/
if ( ! function_exists('log_message'))
{
	function log_message($level = 'error', $message, $php_error = FALSE)
	{
		if (config_item('log_threshold') == 0)
		{
			return;
		}
		$_log = load_class('Log');
		$_log->write_log($level, $message, $php_error);
	}
}

// ------------------------------------------------------------------------

/**
 * Set HTTP Status Header
 *
 * @access	public
 * @param	int		the status code
 * @param	string
 * @return	void
 */
if ( ! function_exists('set_status_header'))
{
	function set_status_header($code = 200, $text = '')
	{
		$stati = array(
            200	=> 'OK',
            201	=> 'Created',
            202	=> 'Accepted',
            203	=> 'Non-Authoritative Information',
            204	=> 'No Content',
            205	=> 'Reset Content',
            206	=> 'Partial Content',

            300	=> 'Multiple Choices',
            301	=> 'Moved Permanently',
            302	=> 'Found',
            304	=> 'Not Modified',
            305	=> 'Use Proxy',
            307	=> 'Temporary Redirect',

            400	=> 'Bad Request',
            401	=> 'Unauthorized',
            403	=> 'Forbidden',
            404	=> 'Not Found',
            405	=> 'Method Not Allowed',
            406	=> 'Not Acceptable',
            407	=> 'Proxy Authentication Required',
            408	=> 'Request Timeout',
            409	=> 'Conflict',
            410	=> 'Gone',
            411	=> 'Length Required',
            412	=> 'Precondition Failed',
            413	=> 'Request Entity Too Large',
            414	=> 'Request-URI Too Long',
            415	=> 'Unsupported Media Type',
            416	=> 'Requested Range Not Satisfiable',
            417	=> 'Expectation Failed',

            500	=> 'Internal Server Error',
            501	=> 'Not Implemented',
            502	=> 'Bad Gateway',
            503	=> 'Service Unavailable',
            504	=> 'Gateway Timeout',
            505	=> 'HTTP Version Not Supported'
        );

		if ($code == '' OR ! is_numeric($code))
		{
			show_error('Status codes must be numeric', 500);
		}

		if (isset($stati[$code]) AND $text == '')
		{
			$text = $stati[$code];
		}

		if ($text == '')
		{
			show_error('No status text available.  Please check your status code number or supply your own message text.', 500);
		}

		$server_protocol = (isset($_SERVER['SERVER_PROTOCOL'])) ? $_SERVER['SERVER_PROTOCOL'] : FALSE;

		if (substr(php_sapi_name(), 0, 3) == 'cgi')
		{
			header("Status: {$code} {$text}", TRUE);
		}
		elseif ($server_protocol == 'HTTP/1.1' OR $server_protocol == 'HTTP/1.0')
		{
			header($server_protocol." {$code} {$text}", TRUE, $code);
		}
		else
		{
			header("HTTP/1.1 {$code} {$text}", TRUE, $code);
		}
	}
}

// --------------------------------------------------------------------

/**
* Exception Handler
*
* This is the custom exception handler that is declaired at the top
* of Codeigniter.php.  The main reason we use this is to permit
* PHP errors to be logged in our own log files since the user may
* not have access to server logs. Since this function
* effectively intercepts PHP errors, however, we also need
* to display errors based on the current error_reporting level.
* We do that with the use of a PHP error template.
*
* @access	private
* @return	void
*/
if ( ! function_exists('_exception_handler'))
{
	function _exception_handler($severity, $message, $filepath, $line)
	{
		 // We don't bother with "strict" notices since they tend to fill up
		 // the log file with excess information that isn't normally very helpful.
		 // For example, if you are running PHP 5 and you use version 4 style
		 // class functions (without prefixes like "public", "private", etc.)
		 // you'll get notices telling you that these have been deprecated.
		if ($severity == E_STRICT)
		{
			return;
		}

		$_error =& load_class('Exceptions', 'core');

		// Should we display the error? We'll get the current error_reporting
		// level and add its bits with the severity bits to find out.
		if (($severity & error_reporting()) == $severity)
		{
			$_error->show_php_error($severity, $message, $filepath, $line);
		}

		// Should we log the error?  No?  We're done...
		if (config_item('log_threshold') == 0)
		{
			return;
		}

		$_error->log_exception($severity, $message, $filepath, $line);
	}
}

// --------------------------------------------------------------------

/**
 * Remove Invisible Characters
 *
 * This prevents sandwiching null characters
 * between ascii characters, like Java\0script.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('remove_invisible_characters'))
{
	function remove_invisible_characters($str, $url_encoded = TRUE)
	{
		$non_displayables = array();
		
		// every control character except newline (dec 10)
		// carriage return (dec 13), and horizontal tab (dec 09)
		
		if ($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/';	// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/';	// url encoded 16-31
		}
		
		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

		do
		{
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		}
		while ($count);

		return $str;
	}
}

// ------------------------------------------------------------------------

/**
* Returns HTML escaped variable
*
* @access	public
* @param	mixed
* @return	mixed
*/
if ( ! function_exists('html_escape'))
{
	function html_escape($var)
	{
		if (is_array($var))
		{
			return array_map('html_escape', $var);
		}
		else
		{
			return htmlspecialchars($var, ENT_QUOTES, config_item('charset'));
		}
	}
}

if ( ! function_exists('error'))
{
    function error($code)
    {
        static $_error;
        if(! $_error)
        {
            $_error = require(APPPATH.'config/error.php');
        }
        if (!isset($_error[$code]))
        {
            $code = 99999;
        }
        return $_error[$code];
    }
}

function authcode($string, $operation = 'DECODE', $expiry = 0, $key = '')
{
	$ckey_length = 4;
	$key = md5($key ? $key : config_item('encryption_key'));
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}

function url($prefix='base')
{
    $url = config_item("{$prefix}_url");
    return $url . config_item('index_page');
}

/**
 * @param $source_file         源文件
 * @param $new_width           输出文件宽度
 * @param $new_height          输出文件高度
 * @param null $new_file_name  输出文件地址
 * @param int $quality         品质0-100
 * @param int $keep_ratio      高宽比 0表示原样输出
 * @return bool
 */
function copyImg($source_file, $new_width, $new_height, $new_file_name=null, $quality = 90, $keep_ratio = 0)
{
    list($width, $height, $type) = getimagesize($source_file);

    $_new_width = $new_width;
    $_new_height = $new_height;
    $skewing_x = $skewing_y = 0;

    if ($keep_ratio != 0) {
        $ratio = round(($height / $width) * 10);
        if ($ratio < 12) {//原图横宽
            if ($new_width > 0) {
                $_new_width = ceil($new_height / ($height / $width));
            } else {
                $new_width = ceil($height / $keep_ratio);
                $_new_width = $width;
                $new_height = $_new_height = $height;
            }
            $skewing_x = (int)(($_new_width - $new_width) / 2);
        } elseif ($ratio > 12) {//原图细高
            if ($new_height > 0) {
                $_new_height = ceil($new_width * ($height / $width));
            } else {
                $new_height = ceil($width * $keep_ratio);
                $_new_height = $height;
                $new_width = $_new_width = $width;
            }
            $skewing_y = (int)(($_new_height - $new_height) / 2);
        }
    }
    //var_dump($new_width, $new_height, $_new_width, $_new_height);
    switch (image_type_to_extension($type)) {
        case '.bmp':
            $source = imagecreatefromwbmp($source_file);
            break;
        case '.gif':
            $source = imagecreatefromgif($source_file);
            break;
        case '.png':
            $source = imagecreatefrompng($source_file);
            break;
        case '.jpeg':
        case '.jpg':
            $source = imagecreatefromjpeg($source_file);
            break;
    }

    if ($new_width && $new_height) {
        $thumb = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($thumb, $source, -($skewing_x), -($skewing_y), 0, 0, $_new_width, $_new_height, $width, $height);
    } else {
        $thumb = $source;
    }

    imagejpeg($thumb, $new_file_name, $quality);
    return true;
}

function intToPath($id)
{
    $id = (int)$id;
    if ($id < 1) return false;
    preg_match("/(\d{1,2})(\d{0,2})/", "{$id}", $matches);
    return $matches[1] . '/' . $matches[1] . $matches[2] . '/' . $id . '/';
}

/* 格式化产品价格 数据库中存储的价格为分 $type为获取单位：1 元， 2 角， 3 分*/
function fPrice($price, $type = 1)
{
    $p = intval($price);

    switch ($type) {
        case 1:  $p = ( $p /100 ); break;
        case 2:  $p = ( $p /10 ); break;
        case 3:  $p = ( $p /1 ); break;
        default: $p = ( $p /100 );
    }

    return sprintf('%.2f', $p);
}

function productURL($pid, $suffix = '')
{
    return config_item('base_url').'product/' . $pid . $suffix;
}

function productFilterURL($param=array(), $suffix = '.html')
{
    if(is_string($param))
    {
        return config_item('base_url') . "filter/{$param}{$suffix}";
    }
    ! isset($param['category']) && $param['category'] = 0;
    ! isset($param['page']) && $param['page'] = 1;
    ! isset($param['order']) && $param['order'] = array('order'=>'0', 'by'=>'0');
    //! isset($param['by']) && $param['by'] = 1;
    ! isset($param['param']) && $param['param'] = array();
    return config_item('base_url') . "filter/{$param['category']}/{$param['page']}/{$param['order']['order']}-{$param['order']['by']}/!" . implode('!', $param['param']) . $suffix;

}

function p($variable)
{
    echo "\n<pre>\n";
    print_r($variable);
    echo "\n</pre>\n";
}

function d($variable)
{
    echo "\n<pre>\n";
    var_dump($variable);
    echo "\n</pre>\n";
}

function _require($file)
{
    $file = strtolower($file);
    static $require = array();
    if(isset($require[$file]))
    {
        return ;
    }

    if(!is_file($file))
    {
        die("not found {$file}");
    }

    $require[$file] = TRUE;
    require($file);
}

/**
 * 获取时间
 * @param $begin_time
 * @param $end_time
 * @return array
 */
function timeDiff($begin_time, $end_time)
{
    if ($begin_time < $end_time) {
        $startTime = $begin_time;
        $endTime = $end_time;
    } else {
        $startTime = $end_time;
        $endTime = $begin_time;
    }
    $timeDiff = $endTime - $startTime;
    $days = intval($timeDiff / 86400);
    $remain = $timeDiff % 86400;
    $hours = intval($remain / 3600);
    $remain = $remain % 3600;
    $min = intval($remain / 60);
    $secs = $remain % 60;
    $res = array("day" => $days, "hour" => $hours, "min" => $min, "sec" => $secs);
    return $res;
}

//获取用户操作系统
function getSystem()
{
	$sys = $_SERVER['HTTP_USER_AGENT'];
	if(stripos($sys, "NT 6.1"))
	   $os = "Windows 7";
	elseif(stripos($sys, "NT 6.0"))
	   $os = "Windows Vista";
	elseif(stripos($sys, "NT 5.1"))
	   $os = "Windows XP";
	elseif(stripos($sys, "NT 5.2"))
	   $os = "Windows Server 2003";
	elseif(stripos($sys, "NT 5"))
	   $os = "Windows 2000";
	elseif(stripos($sys, "NT 4.9"))
	   $os = "Windows ME";
	elseif(stripos($sys, "NT 4"))
	   $os = "Windows NT 4.0";
	elseif(stripos($sys, "98"))
	   $os = "Windows 98";
	elseif(stripos($sys, "95"))
	   $os = "Windows 95";
	elseif(stripos($sys, "Mac"))
	   $os = "Mac";
	elseif(stripos($sys, "Linux"))
	   $os = "Linux";
	elseif(stripos($sys, "Unix"))
	   $os = "Unix";
	elseif(stripos($sys, "FreeBSD"))
	   $os = "FreeBSD";
	elseif(stripos($sys, "SunOS"))
	   $os = "SunOS";
	elseif(stripos($sys, "BeOS"))
	   $os = "BeOS";
	elseif(stripos($sys, "OS/2"))
	   $os = "OS/2";
	elseif(stripos($sys, "PC"))
	   $os = "Macintosh";
	elseif(stripos($sys, "AIX"))
	   $os = "AIX";
	else
	   $os = "未知操作系统";

	return $os;
}

//产品尺码排序
function sizeSort($sizeArr)
{
    if (!is_array($sizeArr) || empty ($sizeArr)) {
        return false;
    }

    $i = 10;
    $rArr = array();
    foreach ($sizeArr as $v) {
        /** 判断尺码来源于产品尺码表还是来自于配置表 **/
        if (isset ($v['name']) && isset ($v['abbreviation'])) {
            return array();
        }

        $v['name'] = isset ($v['name']) ? $v['name'] : $v['abbreviation'];
        $tmpSize = strtoupper(trim($v['name']));

        switch ($tmpSize) {
            case 'XS': $rArr[0] = $v; break;
            case 'S':  $rArr[1] = $v; break;
            case 'M':  $rArr[2] = $v; break;
            case 'L':  $rArr[3] = $v; break;
            case 'XL': $rArr[4] = $v; break;
            case 'XXL':$rArr[5] = $v; break;
            case 'XXXL':$rArr[6] = $v; break;

            case '90CM': $rArr[7] = $v; break;
            case '100CM': $rArr[8] = $v; break;
            case '110CM': $rArr[9] = $v; break;
            case '120CM': $rArr[10] = $v; break;
            case '130CM': $rArr[11] = $v; break;
            case '140CM': $rArr[12] = $v; break;
            case '150CM': $rArr[13] = $v; break;

            default: $rArr[$i] = $v; break;
        }
        $i++;
    }

    ksort($rArr);
    

    return $rArr;
}

/* End of file Common.php */
/* Location: ./system/core/Common.php */