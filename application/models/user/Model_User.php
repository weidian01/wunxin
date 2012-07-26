<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
    public function getUserById($uId, $fields = "*")
    {
        list($key, $fields) = self::formatField($fields);
        $this->db->select($fields)->from('user');
        if(is_array($uId))
        {
            return  $this->db->where_in('uid', $uId)->get()->result_array($key);
        }
        return $this->db->where('uid', $uId)->get()->row_array();
    }

    /**
     * 根据用户id获取用户扩展信息
     * @param $uId
     * @param string $fields
     * @return mixed
     */
    public function getUserInfoById($uId , $fields = "*")
    {
        list($key, $fields) = self::formatField($fields);
        $this->db->select($fields)->from('user_info');
        if(is_array($uId))
        {
            return $this->db->where_in('uid', $uId)->get()->result_array($key);
        }
        return $this->db->where('uid', $uId)->get()->row_array();
    }

    /**
     * @name 获取用户信息 -- 通过用户名称
     *
     * @param $uName 用户名 -- 邮箱地址
     * @return array
     */
    public function getUserByName($uName)
    {
        return $this->db->select('uid, nickname, password, lid, source, uname, integral, amount, status, create_time')->get_where('user', array('uname' => $uName, 'status' => 1))->row_array();
    }

    /**
     * @name 获取用户所有信息 -- 通过用户ID
     *
     * @param $uId 用户ID
     * @return array
     */
    public function getUserAllInfoById($uId)
    {
        $field = 'user.uid, nickname, password, lid, uname, source, status, integral, amount, real_name, header, sex, birthday, country, province, city, zipcode, detail_address, phone, id_card, qq,
            company_call, family_call, height, weight, body_type, marital_status, education_level, job, industry, income, interest, introduction, website, create_time, bank_name, bank_account';

        $this->db->select($field)->from('user')->join('user_info', 'user.uid = user_info.uid', 'left')->where('user.uid', $uId)->where('user.status', 1);
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
        $field = 'user.uid, nickname, password, lid, uname, source, status, integral, amount, real_name, header, sex, birthday, country, province, city, zipcode, detail_address, phone, id_card, qq,
            company_call, family_call, height, weight, body_type, marital_status, education_level, job, industry, income, interest, introduction, website, create_time, bank_name, bank_account';

        $this->db->select($field)->from('user')->join('user_info', 'user.uid = user_info.uid')->where('user.uname', $uName)->where('user.status', 1);
        return $this->db->get()->row_array();
    }

    /**
     * 用户登陆
     *
     * @param $uName
     * @param $password
     * @return int
     */
    public function userLogin($uName, $password)
    {
        //$uInfo = $this->getUserByName($uName);
        $uInfo = $this->db->select('uid, nickname, password, lid, uname, integral, amount, create_time')->get_where('user', array('uname' => $uName, 'status' => 1))->row_array();

        if (empty ($uInfo) || !is_array($uInfo)) {
            return 1;
        }

        if ($uInfo['password'] != md5(trim($password))) {
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
    public function modifyUserPasswordByUserId($uId, $oldPassword, $newPassword)
    {
        //新老密码一致
        if (md5(trim($oldPassword)) == md5(trim($newPassword))) {
            return true;
        }

        $uInfo = $this->db->select('uid, nickname, password, lid, uname, integral, amount, create_time')
            ->get_where('user', array('uid' => $uId, 'status' => 1))->row_array();

        //用户不存在
        if (empty ($uInfo) || !is_array($uInfo)) {
            return 2;
        }

        //密码验证失败
        if ($uInfo['password'] != md5(trim($oldPassword))) {
            return 3;
        }

        $data = array('password' => md5($newPassword));
        return $this->db->where('uid', $uId)->update('user', $data);
    }

    /**
     * 修改用户昵称
     *
     * @param $uId
     * @param $nickName
     * @return boolean
     */
    public function modifyUserNickName($uId, $nickName)
    {
        $data = array('nickname' => $nickName);
        return $this->db->where('uid', $uId)->update('user', $data);
    }

    /**
     * 获取用户列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户数量
     *
     * @return int
     */
    public function getUserCount()
    {
        $this->db->select('*')->from('user');

        return $this->db->count_all_results();
    }
}