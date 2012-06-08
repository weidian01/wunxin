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
     * 退订促销信息
     *
     * @param $uId
     * @return boolean
     */
    public function unSubscribe($mailAddr)
    {
        return $this->db->delete('mail_subscription', array('email_addr' => $mailAddr));
    }
}
