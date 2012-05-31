<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-5-31
 * Time: 下午1:11
 * To change this template use File | Settings | File Templates.
 */

function is_username($username)
{
    if(length_limit($username ,6, 32))
    {
        return filter_var($username, FILTER_VALIDATE_EMAIL);
    }
    return false;
}

function length_limit($str ,$min, $max)
{
    $len = strlen($str);
    if($len < $min || $len > $max) return false;
    return true;
}

function is_url($url)
{
    return filter_var($url, FILTER_VALIDATE_URL);
}