<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: EvanHou
 * Date: 12-5-30
 * Time: 下午2:39
 * To change this template use File | Settings | File Templates.
 */
class Model_User extends MY_Model
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
     * @name 设置用户收货地址
     *
     * @param array $addrInfo 用户信息
     * @return boolean
     */
    public function addUserRecipientAddress(array $addrInfo)
    {
        $data = array(
            'uid' => $addrInfo['uid'],
            'uname' => $addrInfo['uname'],
            'recent_name' => $addrInfo['recent_name'],
            'country' => $addrInfo['country'],
            'province' => $addrInfo['province'],
            'city' => $addrInfo['city'],
            'area' => $addrInfo['area'],
            'detail_address' => $addrInfo['detail_address'],
            'zipcode' => $addrInfo['zipcode'],
            'phone_num' => $addrInfo['phone_num'],
            'call_num' => $addrInfo['call_num'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('user_recipient_address', $data);
        return $this->db->insert_id();
    }
    /**
     * @name 获取用户收货地址
     *
     * @param array $uid 用户ID
     * @return boolean
     */
    public function getUserRecipientAddressByUid($uid)
    {
        return $this->db->select('*')->get_where('user_recipient_address', array('uid' => $uid))->result_array();
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
        return $this->db->select('uid, nickname, password, lid, uname, integral, amount, create_time')->get_where('user', array('uid' => $uId, 'status' => 1))->row_array();
    }

    /**
     * @name 获取用户信息 -- 通过用户名称
     *
     * @param $uName 用户名 -- 邮箱地址
     * @return array
     */
    public function getUserByName($uName)
    {
        return $this->db->select('uid, nickname, password, lid, uname, integral, amount, create_time')->get_where('user', array('uname' => $uName, 'status' => 1))->row_array();
    }

    /**
     * @name 获取用户所有信息 -- 通过用户ID
     *
     * @param $uId 用户ID
     * @return array
     */
    public function getUserAllInfoById($uId)
    {
        $field = 'user.uid, nickname, password, lid, uname, integral, amount, real_name, header, sex, birthday, country, province, city, zipcode, detail_address, phone,
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
        $field = 'user.uid, password, nickname, lid, uname, integral, amount, real_name, header, sex, birthday, country, province, city, zipcode, detail_address, phone,
            company_call, family_call, height, weight, body_type, marital_status, education_level, job, industry, income, interest, introduction, website, create_time';

        $this->db->select($field)->from('user')->join('user_info', 'user.uid = user_info.uid')->where('user.uname', $uName)->where('user.status', 1);
        return $this->db->get()->row_array();
    }

    /**
     * @name 获取用户所有发票信息 -- 通过用户ID
     *
     * @param $uId 用户ID
     * @return array
     */
    public function getUserAllInvoiceInfoByUid($uId)
    {
        return $this->db->select('*')->get_where('invoice', array('uid' => $uId))->result_array();
    }


    public function userLogin($uName, $password)
    {
        //$uInfo = $this->getUserByName($uName);
        $uInfo = $this->db->select('uid, nickname, password, lid, uname, integral, amount, create_time')->get_where('user', array('uname' => $uName, 'status' => 1))->row_array();

        if (empty ($uInfo) || !is_array($uInfo))
        {
            return 1;
        }

        if ($uInfo['password'] != md5(trim($password)))
        {
            return 2;
        }

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
     * @param $userInfo 用户信息
     * @return boolean
     */
    public function modifyUserByUserId($uId, array $userInfo)
    {
        $data = array(
            'real_name' => $userInfo['real_name'],
            'header' => $userInfo['header'],
            'sex' => $userInfo['sex'],
            'birthday' => $userInfo['birthday'],
            'country' => $userInfo['country'],
            'province' => $userInfo['province'],
            'city' => $userInfo['city'],
            'zipcode' => $userInfo['zipcode'],
            'detail_address' => $userInfo['detail_address'],
            'phone' => $userInfo['phone'],
            'company_call' => $userInfo['company_call'],
            'family_call' => $userInfo['family_call'],
            'height' => $userInfo['height'],
            'weight' => $userInfo['weight'],
            'body_type' => $userInfo['body_type'],
            'marital_status' => $userInfo['marital_status'],
            'education_level' => $userInfo['education_level'],
            'job' => $userInfo['job'],
            'industry' => $userInfo['industry'],
            'income' => $userInfo['income'],
            'interest' => $userInfo['interest'],
            'introduction' => $userInfo['introduction'],
            'website' => $userInfo['website'],
            'id_card' => $userInfo['id_card'],
            'bank_name' => $userInfo['bank_name'],
            'bank_account' => $userInfo['bank_account']
        );

        return $this->db->where('uid', $uId)->update('user', $data);
    }

    /**
     * @name 修改用户密码 -- 通过用户ID
     *
     * @param $uId 用户ID
     * @param $oldPassword 用户当前密码
     * @param $newPassword 用户新密码
     * @return boolean
     */
    public function mofidyUserPasswordByUserId($uId, $oldPassword, $newPassword)
    {
        //新老密码一致
        if (md5(trim($oldPassword)) == md5(trim($newPassword)))
        {
            return true;
        }

        $uInfo = $this->db->select('uid, nickname, password, lid, uname, integral, amount, create_time')->get_where('user', array('uid' => $uId, 'status' => 1))->row_array();

        //用户不存在
        if (empty ($uInfo) || !is_array($uInfo))
        {
            return 2;
        }

        //密码验证失败
        if ($uInfo['password'] != md5(trim($oldPassword)))
        {
            return 3;
        }

        $data = array('password' => md5($newPassword));
        return $this->db->where('uid', $uId)->update('user', $data);
    }


}