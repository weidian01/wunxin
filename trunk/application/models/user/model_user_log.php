<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
* Time: 上午8:51
* wunxin E-commerce management system
*/
class Model_User_Log extends MY_Model
{
   /**
    * @name 记录登陆日志
    *
    * @param $uId 用户ID
    * @param $ip 登陆IP地址
    * @param $source 登陆来源
    * @return boolean
    */
   public function record_login_log($uId, $ip, $source = 1)
   {
       $data = array(
           'uid' => $uId,
           'login_source' => $source,
           'ip' => $ip,
           'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
       );

       $this->db->insert('user_login_log', $data);
       return $this->db->insert_id();
   }

    /**
     * 获取登陆日志列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getLoginLogList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('user_login_log');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取登陆日志数量
     *
     * @return int
     */
    public function getLoginLogCount()
    {
        $this->db->select('*')->from('user_login_log');

        return $this->db->count_all_results();
    }

    /**
     * 获取用户登陆日志列表
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null
     */
    public function getUserLoginLogList($uId, $limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('user_login_log');
        $this->db->where('uid', $uId);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户登陆日志数量
     *
     * @param $uId
     * @return int
     */
    public function getUserLoginLogCount($uId)
    {
        $this->db->select('*')->from('user_login_log')->where('uid', $uId);

        return $this->db->count_all_results();
    }
}