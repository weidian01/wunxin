<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-27
 * Time: 下午10:29
 * To change this template use File | Settings | File Templates.
 */
class Model_User_Apply_Cash_Back extends MY_Model
{
    /**
     * 添加用户申请返现日志
     *
     * @param array $data
     * @return boolean
     */
    public function acbAdd(array $data)
    {
        $info = array(
            'uid' => $data['uid'],
            'passwd_code' => $data['passwd_code'],
            'end_time' => $data['end_time'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('apply_cash_back_log', $info);
        return $this->db->insert_id();
    }

    /**
     * 获取用户申请返现日志列表
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserAcbList($uId, $limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('apply_cash_back_log');
        $this->db->where('uid', $uId);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户申请返现日志数量
     *
     * @param $uId
     * @return int
     */
    public function getUserAcbCount($uId)
    {
        $this->db->select('*')->from('apply_cash_back_log')->where('uid', $uId);

        return $this->db->count_all_results();
    }
}
