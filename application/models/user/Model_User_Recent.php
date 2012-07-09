<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午5:58
 * To change this template use File | Settings | File Templates.
 */
class Model_User_Recent extends MY_Model
{
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
            'email' => $addrInfo['email'],
            'default_address' => 1,
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );
        $this->updateUserDefaultAddress($addrInfo['uid']);
        $this->db->insert('user_recent_address', $data);
        return $this->db->insert_id();
    }

    /**
     * @name 编辑用户收货地址
     *
     * @param int $aId
     * @param int $aInfo
     * @return boolean
     */
    public function editRecentAddress($aId, $aInfo)
    {
        $data = array(
            'recent_name' => $aInfo['recent_name'],
            'country' => $aInfo['country'],
            'province' => $aInfo['province'],
            'city' => $aInfo['city'],
            'area' => $aInfo['area'],
            'detail_address' => $aInfo['detail_address'],
            'zipcode' => $aInfo['zipcode'],
            'phone_num' => $aInfo['phone_num'],
            'call_num' => $aInfo['call_num'],
            'email' => $aInfo['email'],
            'default_address' => $aInfo['default_address'],
        );

        $this->updateUserDefaultAddress($aInfo['uid']);
        $this->db->where('address_id', $aId);
        return $this->db->update('user_recent_address', $data);
    }

    /**
     * @name 设置默认收货地址
     *
     * @param int $aId
     * @return boolean
     */
    public function setDefaultRecentAddress($aId)
    {
        $data = array(
            'default_address' => 1
        );

        $this->db->where('address_id', $aId);
        return $this->db->update('user_recent_address', $data);
    }

    /**
     * @name 删除收货地址
     *
     * @param $aId
     * @return boolean
     */
    public function deleteRecentAddress($aId)
    {
        return $this->db->delete('user_recent_address', array('address_id' => $aId));
    }

    /**
     * 删除用户收货地址
     * @param $aId
     * @param $uid
     * @return boolean
     */
    public function deleteUserRecentAddress($aId, $uid)
    {
        return $this->db->delete('user_recent_address', array('address_id' => $aId, 'uid' => $uid));
    }

    /**
     * @name 更新用户全部收货地址不为默认
     *
     * @param $uid
     * @return mixed
     */
    private function updateUserDefaultAddress($uid)
    {
        $data = array(
            'default_address' => 0
        );
        $this->db->where('uid', $uid);
        return $this->db->update('user_recent_address', $data);
    }


    /**
     * 获取用户收货地址列表
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function getUserRecentAddressByUid($uId, $limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->get_where('user_recent_address', array('uid' => $uId), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户收货地址数量
     *
     * @param $uId
     * @return int
     */
    public function getUserRecentAddressCount($uId)
    {
        $this->db->select('*')->from('user_recent_address')->where('uid', $uId);

        return $this->db->count_all_results();
    }

    /**
     * @name 获取收货地址 -- 通过地址ID
     *
     * @param $aid
     * @return array
     */
    public function getUserRecentAddressByAid($aid)
    {
        return $this->db->select('*')->get_where('user_recent_address', array('address_id' => $aid))->row_array();
    }
}
