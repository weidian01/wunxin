<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-27
 * Time: 下午10:13
 * To change this template use File | Settings | File Templates.
 */
class Model_User_Level extends MY_Model
{
    /**
     * 添加等级日志
     *
     * @param array $data
     * @return boolean
     */
    public function  levelAdd(array $data)
    {
        $info = array(
            'uid' => $data['uid'],
            'up_action' => $data['up_action'],
            'former_level' => $data['former_level'],
            'current_level' => $data['current_level'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('user_up_level_log', $info);
        return $this->db->insert_id();
    }

    /**
     * 获取用户等级日志列表
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserLevelList($uId, $limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('user_up_level_log');
        $this->db->where('uid', $uId);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户等级日志数量
     *
     * @param $uId
     * @return int
     */
    public function getUserInLevelCount($uId)
    {
        $this->db->select('*')->from('user_up_level_log')->where('uid', $uId);

        return $this->db->count_all_results();
    }
}
