<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-27
 * Time: 下午10:19
 * To change this template use File | Settings | File Templates.
 */
class Model_User_Consume extends MY_Model
{
    /**
     * 添加用户消费日志
     *
     * @param array $data
     * @return boolean
     */
    public function  consumeAdd(array $data)
    {
        $info = array(
            'uid' => $data['uid'],
            'operat_type' => $data['operat_type'],
            'before_amount' => $data['before_amount'],
            'after_amount' => $data['after_amount'],
            'descr' => $data['descr'],
            'consume_amount' => $data['consume_amount'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('user_consume_log', $info);
        return $this->db->insert_id();
    }

    /**
     * 获取用户消费日志列表
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserConsumeList($uId, $limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('user_consume_log');
        $this->db->where('uid', $uId);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户消费日志数量
     *
     * @param $uId
     * @return int
     */
    public function getUserConsumeCount($uId)
    {
        $this->db->select('*')->from('user_consume_log')->where('uid', $uId);

        return $this->db->count_all_results();
    }
}
