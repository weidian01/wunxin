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
    /**
     * 后台用户登陆
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function adminUserLogin($username, $password)
    {
        $field = 'am_uid, am_uname, password, ip, last_login_time, contact';
        $uInfo = $this->db->select($field)->get_where('admin_user', array('am_uname' => $username, 'status' => 1))->row_array();

        if (empty ($uInfo) || !is_array($uInfo)) {
            return false;
        }

        $password = md5(trim($password));
        if ($password != $uInfo['password']) {
             return false;
        }

        return $uInfo;
    }

    /**
     * 后台用户登陆 更新登陆记录
     *
     * @param int $am_uid
     * @param $ip
     * @return  boolen
     */
    public function adminUserLoginLog($am_uid, $ip)
    {
        $data = array(
            'ip' => $ip,
            'last_login_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        return $this->db->where('am_uid', $am_uid)->update('admin_user', $data);
    }

    /**
     * 获取后台用户 -- 通过后台用户ID
     * @param $amUid
     * @return null
     */
    public function getUserInfoByAmUid($amUid)
    {
        $data = $this->db->select('*')->get_where('admin_user', array('am_uid' => $amUid))->row_array();

        return (!$data) ? null : $data;
    }
}