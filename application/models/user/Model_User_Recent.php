<?php
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
     * 设置用户收货地址
     *
     * @param array $aInfo
     * @return boolean
     */
    public function createAddress(array $aInfo)
    {
        $data = array(
            'uid' => $aInfo['uid'],
            'uname' => $aInfo['uname'],
            'recent_name' => $aInfo['recent_name'],
            'country' => $aInfo['country'],
            'province' => $aInfo['province'],
            'city' => $aInfo['city'],
            'area' => $aInfo['area'],
            'detail_address' => $aInfo['detail_address'],
            'zipcode' => $aInfo['zipcode'],
            'phone_num' => $aInfo['phone_num'],
            'call_num' => $aInfo['call_num'],
            'default_address' => $aInfo['default_address'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('user_recipient_address', $data);
        return $this->db->insert_id();
    }

    /**
     * 编辑用户收货地址
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
        );

        $this->db->where('address_id', $aId);
        return $this->db->update('user_recipient_address', $data);
    }

    /**
     * 设置默认收货地址
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
        return $this->db->update('user_recipient_address', $data);
    }

    /**
     * 删除用户收货地址
     *
     * @param $aId
     * @return boolean
     */
    public function deleteRecentAddress($aId)
    {
        return $this->db->delete('user_recipient_address', array('address_id' => $aId));
    }

    /**
     * 更新用户全部收货地址不为默认
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
        return $this->db->update('user_recipient_address', $data);
    }
}
