<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-18
 * Time: 上午11:16
 * To change this template use File | Settings | File Templates.
 */
class Model_Order_Receiver extends MY_Model
{
    /**
     * 添加收款单
     *
     * @param array $data
     * @return boolean
     */
    public function addReceiver(array $data)
    {
        $info = array(
            'order_sn' => $data['order_sn'],
            'uid' => $data['uid'],
            'uname' => $data['uname'],
            'amount' => $data['amount'],
            'pay_time' => date('Y-m-d H:i:s', TIMESTAMP),
            'pay_type' => $data['pay_type'],
            'pay_account' => $data['pay_account'],
            'extended_information' => $data['extended_information'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('receivable', $info);
        return $this->db->insert_id();
    }
    /**
     * 获取收款单信息 -- 通过收款单ID
     *
     * @param $id
     * @return null
     */
    public function getReceiverById($id)
    {
        $data = $this->db->select('*')->get_where('receivable', array('receiver_id' => $id))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取收款单列表 -- 通过订单ID
     *
     * @param $orderSn
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getReceiverByOrderSn($orderSn, $limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->get_where('receivable', array('order_sn' => $orderSn), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取收款单数量 -- 通过订单ID
     *
     * @param int $orderSn
     * @return int
     */
    public function getOrderSnReceiverCount($orderSn)
    {
        $this->db->select('*')->from('receivable')->where('order_sn', $orderSn);

        return $this->db->count_all_results();
    }

    /**
     * 获取收款单列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getReceiverList($limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->from('receivable')->order_by('receiver_id', 'desc')->limit($limit, $offset)->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取收款单数量
     *
     * @return int
     */
    public function getReceiverCount()
    {
        $this->db->select('*')->from('receivable');

        return $this->db->count_all_results();
    }

    /**
     * 获取用户收款单 -- 通过用户ID
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getReceiverByuId($uId, $limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->get_where('receivable', array('uid' => $uId), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户收款单数量
     *
     * @param $uId
     * @return int
     */
    public function getUserReceiverCount($uId)
    {
        $this->db->select('*')->from('receivable')->where('uid', $uId);

        return $this->db->count_all_results();
    }
}
