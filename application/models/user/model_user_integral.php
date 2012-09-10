<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-27
 * Time: 下午9:28
 * To change this template use File | Settings | File Templates.
 */
class Model_User_Integral extends MY_Model
{
    /**
     * 添加积分日志
     *
     * @param array $data
     * @return boolean
     */
    public function integralAdd(array $data)
    {
        $info = array(
            'uid' => $data['uid'],
            'operat_type' => $data['operat_type'],
            'consume_amount' => $data['consume_amount'],
            'before_amount' => $data['before_amount'],
            'after_amount' => $data['after_amount'],
            'descr' => $data['descr'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('user_integral_log', $info);
        return $this->db->insert_id();
    }

    /**
     * 获取用户积分日志列表
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserIntegralList($uId, $limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('user_integral_log');
        $this->db->where('uid', $uId);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户积分日志数量
     *
     * @param $uId
     * @return int
     */
    public function getUserIntegralCount($uId)
    {
        $this->db->select('*')->from('user_integral_log')->where('uid', $uId);

        return $this->db->count_all_results();
    }
}
