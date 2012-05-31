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
            'uname' => $userInfo['uname'] ,
            'password' => $userInfo['password'] ,
            'source' => $userInfo['source'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP) ,
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

    }

    /**
     * @name 删除用户 -- 通过用户名称
     *
     * @param $uName 用户名 -- 邮箱地址
     * @return boolean
     */
    public function deleteUserByName($uName)
    {

    }

    /**
     * @name 获取用户信息 -- 通过用户ID
     *
     * @param $uId 用户ID
     * @return array
     */
    public function getUserById($uId)
    {

    }

    /**
     * @name 获取用户信息 -- 通过用户名称
     *
     * @param $uName 用户名 -- 邮箱地址
     * @return array
     */
    public function getUserByName($uName)
    {

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



    /**
     * @name 注册用户
     *
     * @param array $userInfo 用户信息
     * @return boolean
     */
    public function updateUserInfo(array $userInfo)
    {

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


}