<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午9:56
 * To change this template use File | Settings | File Templates.
 */
class Model_Mail_Subscription extends MY_Model
{
    /**
     * 订阅促销信息
     *
     * @param array $sInfo
     * @return boolean
     */
    public function subscribe(array $sInfo)
    {
        $data = array(
            'uid' => $sInfo['uid'],
            'email_addr' => $sInfo['email_addr'],
            'get_info_type' => $sInfo['get_info_type'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('mail_subscription', $data);
        return $this->db->insert_id();
    }

    /**
     * 修改
     *
     * @param array $data
     * @param $mId
     * @return boolean
     */
    public function editSubscribe(array $data, $mId)
    {
        $info = array(
            'uid' => $data['uid'],
            'email_addr' => $data['email_addr'],
            'get_info_type' => $data['get_info_type'],
        );

        $this->db->where('id', $mId);
        return $this->db->update('mail_subscription', $info);
    }

    /**
     * 获取一条
     *
     * @param $mId
     * @return null | array
     */
    public function getSubscribeBymId($mId)
    {
        $data = $this->db->select('*')->from('mail_subscription')->where('id', $mId)->get()->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getSubscribeList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('mail_subscription');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取数量
     *
     * @return int
     */
    public function getSubscribeCount()
    {
        $this->db->select('*')->from('mail_subscription');

        return $this->db->count_all_results();
    }

    /**
     * 获取用户订阅列表
     *
     * @param int $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserSubscribeList($uId, $limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('mail_subscription');
        $this->db->limit($limit, $offset);
        $this->db->where('uid', $uId);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户订阅数量
     *
     * @param int $uId
     * @return int
     */
    public function getUserSubscribeCount($uId)
    {
        $this->db->select('*')->from('mail_subscription')->where('uid', $uId);

        return $this->db->count_all_results();
    }

    /**
     * 退订促销信息
     *
     * @param $mailAddr
     * @param $uId
     * @return boolean
     */
    public function unSubscribe($mailAddr, $uId)
    {
        return $this->db->delete('mail_subscription', array('email_addr' => $mailAddr, 'uid' => $uId));
    }

    /**
     * 删除
     *
     * @param $mId
     * @return boolean
     */
    public function deleteSubscribe($mId)
    {
        return $this->db->delete('mail_subscription', array('id' => $mId));
    }
}
