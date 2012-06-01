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
 * CodeIgniter Cookie Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/cookie_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Set cookie
 *
 * Accepts six parameter, or you can submit an associative
 * array in the first parameter containing all the values.
 *
 * @access	public
 * @param	mixed
 * @param	string	the value of the cookie
 * @param	string	the number of seconds until expiration
 * @param	string	the cookie domain.  Usually:  .yourdomain.com
 * @param	string	the cookie path
 * @param	string	the cookie prefix
 * @return	void
 */
if ( ! function_exists('set_cookie'))
{
	function set_cookie($name = '', $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = FALSE)
	{
		// Set the config file options
		$CI =& get_instance();
		$CI->input->set_cookie($name, $value, $expire, $domain, $path, $prefix, $secure);
	}
}

// --------------------------------------------------------------------

/**
 * Fetch an item from the COOKIE array
 *
 * @access	public
 * @param	string
 * @param	bool
 * @return	mixed
 */
if ( ! function_exists('get_cookie'))
{
	function get_cookie($index = '', $xss_clean = FALSE)
	{
		$CI =& get_instance();

		$prefix = '';

		if ( ! isset($_COOKIE[$index]) && config_item('cookie_prefix') != '')
		{
			$prefix = config_item('cookie_prefix');
		}

		return $CI->input->cookie($prefix.$index, $xss_clean);
	}
}

// --------------------------------------------------------------------

/**
 * Delete a COOKIE
 *
 * @param	mixed
 * @param	string	the cookie domain.  Usually:  .yourdomain.com
 * @param	string	the cookie path
 * @param	string	the cookie prefix
 * @return	void
 */
if ( ! function_exists('delete_cookie'))
{
	function delete_cookie($name = '', $domain = '', $path = '/', $prefix = '')
	{
		set_cookie($name, '', '', $domain, $path, $prefix);
	}
}

/**
 * 设置用户登陆cookie
 *
 * @access	public
 * @param	string	用户信息
 * @param	string	过期时间
 * @return	void
 */
if (!function_exists('set_login_cookie')) {
    function set_user_cookie(array $cInfo, $expire = 86400)
    {
        set_cookie('uid', $cInfo['uid'], $expire);
        set_cookie('username', $cInfo['uname'], $expire);
        set_cookie('nickname', $cInfo['nickname'], $expire);
        set_cookie('integral', $cInfo['integral'], $expire);
        set_cookie('balance', $cInfo['balance'], $expire);
        set_cookie('amount', $cInfo['amount'], $expire);
        set_cookie('level', $cInfo['lid'], $expire);
        //return filter_var($url, FILTER_VALIDATE_URL);
    }
}

/**
 * 清除用户cookie
 *
 * @access	public
 * @return	void
 */
if (!function_exists('delete_user_cookie')) {
    function delete_user_cookie()
    {
        delete_cookie('uid');
        delete_cookie('username');
        delete_cookie('nickname');
        delete_cookie('integral');
        delete_cookie('balance');
        delete_cookie('amount');
        delete_cookie('level');
        //return filter_var($url, FILTER_VALIDATE_URL);
    }
}

/**
 * 用户是否登陆
 *
 * @access	public
 * @return	void
 */
if (!function_exists('get_user_cookie')) {
    function get_user_cookie()
    {
        $uid = get_cookie('uid');
        return empty ($uid) ? false : true;
    }
}


/* End of file cookie_helper.php */
/* Location: ./system/helpers/cookie_helper.php */