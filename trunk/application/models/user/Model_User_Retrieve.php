<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-27
 * Time: 下午10:25
 * To change this template use File | Settings | File Templates.
 */
class Model_User_Retrieve extends MY_Model
{
    /**
     * 添加用户找回密码日志
     *
     * @param array $data
     * @return boolean
     */
    public function retrieveAdd(array $data)
    {
        $info = array(
            'uid' => $data['uid'],
            'passwd_code' => $data['passwd_code'],
            'end_time' => $data['end_time'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('retrieve_password_log', $info);
        return $this->db->insert_id();
    }

    /**
     * 获取用户找回密码日志列表
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserRetrieveList($uId, $limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('retrieve_password_log');
        $this->db->where('uid', $uId);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户找回密码日志数量
     *
     * @param $uId
     * @return int
     */
    public function getUserRetrieveCount($uId)
    {
        $this->db->select('*')->from('retrieve_password_log')->where('uid', $uId);

        return $this->db->count_all_results();
    }
}
