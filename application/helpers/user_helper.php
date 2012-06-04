<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */

/**
 * 设置用户登陆cookie
 *
 * 设置用户登陆cookie
 *
 * @access	public
 * @param	string	用户信息
 * @param	string	过期时间
 * @return	void
 */
if (!function_exists('set_login_cookie')) {
    function set_login_cookie(array $cInfo, $expire = 86400)
    {
        set_cookie('uid', $cInfo['uid'], $expire);
        set_cookie('username', $cInfo['uname'], $expire);
        set_cookie('nickname', $cInfo['nickname'], $expire);
        set_cookie('integral', $cInfo['integral'], $expire);
        set_cookie('balance', $cInfo['balance'], $expire);
        set_cookie('amount', $cInfo['amount'], $expire);
        set_cookie('level', $cInfo['lid'], $expire);
        return filter_var($url, FILTER_VALIDATE_URL);
    }
}