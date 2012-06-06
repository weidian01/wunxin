<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Admin_User extends MY_Model
{
    public function adminUserLogin($username, $password)
    {
        $uInfo = $this->db->select('*')->get_where('admin_user', array('username' => $username))->row_array();

        if (empty ($uInfo) || !is_array($uInfo)) {
            return false;
        }

        $password = md5(trim($password));
        if ($password != $uInfo['password']) {
             return false;
        }

        return $uInfo;
    }

    public function adminUserLoginLog($user_id, $ip)
    {
        $data = array(
            'ip' => $ip,
            'last_login_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        return $this->db->where('user_id', $user_id)->update('admin_user', $data);
    }

    public function getUserInfoByAmUid($amUid)
    {
        $this->db->select('*')->get_where('admin_user', array('am_uid' => $amUid))->row_array();
    }
}