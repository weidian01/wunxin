<?php
/**
 * Created by JetBrains PhpStorm.
 * User: EvanHou
 * Date: 12-5-30
 * Time: 下午2:39
 * To change this template use File | Settings | File Templates.
 */
class user extends CI_Model
{

    /**
     * @name 注册用户
     *
     * @param array $userInfo 用户信息
     * @return boolean
     */
    public function registerUser(array $userInfo)
    {
        $data = array(
            'uname' => $userInfo['uname'],
            'password' => md5(trim($userInfo['password'])),
            'source' => $userInfo['source'],
            'nickname' => $userInfo['nickname'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    /**
     * @name 删除用户 -- 通过用户ID
     *
     * @param $uId 用户ID
     * @return boolean
     */
    public function deleteUserById($uId)
    {
        return $this->db->update('user', array('status' => 0), "uid = $uId");
    }

    /**
     * @name 删除用户 -- 通过用户名称
     *
     * @param $uName 用户名 -- 邮箱地址
     * @return boolean
     */
    public function deleteUserByName($uName)
    {
        return $this->db->update('user', array('status' => 0), "uname = '$uName'");
    }

    /**
     * @name 获取用户信息 -- 通过用户ID
     *
     * @param $uId 用户ID
     * @return array
     */
    public function getUserById($uId)
    {
        return $this->db->select('uid, nickname, lid, uname, integral, balance, amount, create_time')->get_where('user', array('uid' => $uId, 'status' => 1))->row_array();
    }

    /**
     * @name 获取用户信息 -- 通过用户名称
     *
     * @param $uName 用户名 -- 邮箱地址
     * @return array
     */
    public function getUserByName($uName)
    {
        return $this->db->select('uid, nickname, lid, uname, integral, balance, amount, create_time')->get_where('user', array('uname' => $uName, 'status' => 1))->row_array();
    }

    /**
     * @name 获取用户所有信息 -- 通过用户ID
     *
     * @param $uId 用户ID
     * @return array
     */
    public function getUserAllInfoById($uId)
    {
        $field = 'user.uid, nickname, lid, uname, integral, balance, amount, real_name, header, sex, birthday, country, province, city, zipcode, detail_address, phone,
            company_call, family_call, height, weight, body_type, marital_status, education_level, job, industry, income, interest, introduction, website, create_time';

        $this->db->select($field)->from('user')->join('user_info', 'user.uid = user_info.uid')->where('user.uid', $uId)->where('user.status', 1);
        return $this->db->get()->row_array();
    }

    /**
     * @name 获取用户所有信息 -- 通过用户名称
     *
     * @param $uName 用户名 -- 邮箱地址
     * @return array
     */
    public function getUserALlInfoByName($uName)
    {
        $field = 'user.uid, nickname, lid, uname, integral, balance, amount, real_name, header, sex, birthday, country, province, city, zipcode, detail_address, phone,
            company_call, family_call, height, weight, body_type, marital_status, education_level, job, industry, income, interest, introduction, website, create_time';

        $this->db->select($field)->from('user')->join('user_info', 'user.uid = user_info.uid')->where('user.uname', $uName)->where('user.status', 1);
        return $this->db->get()->row_array();
    }


    public function userLogin($uName, $password)
    {
        //$uInfo = $this->getUserByName($uName);
        $uInfo = $this->db->select('uid, nickname, password, lid, uname, integral, balance, amount, create_time')->get_where('user', array('uname' => $uName, 'status' => 1))->row_array();

        if (empty ($uInfo) || !is_array($uInfo))
        {
            return 1;
        }

        if ($uInfo['password'] != md5(trim($password)))
        {
            return 2;
        }
        unset ($uInfo['password']);
        return $uInfo;
    }

    /**
     * @name 检测用户是否存在
     *
     * @param $uName 用户名 -- 邮箱地址
     * @return int
     */
    public function userNameIsExist($uName)
    {
        $this->db->from('user');
        $this->db->where("uname = '{$uName}'");
        return $this->db->count_all_results();
    }

    /**
     * @name 修改用户信息 -- 通过用户ID
     *
     * @param $uId 用户ID
     * @return boolean
     */
    public function modifyUserByUserId($uId, array $userInfo)
    {

    }

    public function mofidyUserPasswordByUserId($uId, $oldPassword, $newPassword)
    {

    }


}