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
   public function record_login_log($uId,$ip, $source = 1)
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
}