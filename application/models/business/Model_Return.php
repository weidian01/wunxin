<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午9:01
 * To change this template use File | Settings | File Templates.
 */
class Model_Return extends MY_Model
{
    /**
     * 退换货申请
     *
     * @param array $rInfo
     * @param int $type
     * @return boolean
     */
    public function returnApply(array $rInfo, $type = 1)
    {
        $data = array(
            'uid' => $rInfo['uid'],
            'order_sn' => $rInfo['order_sn'],
            'pid' => $rInfo['pid'],
            'type' => $type,
            'reason' => $rInfo['reason'],
            'descr' => $rInfo['descr'],
            'img_one' => $rInfo['img_one'],
            'img_two' => $rInfo['img_two'],
            'create_time' => $rInfo['create_time']
        );

        $this->db->insert('returns', $data);
        return $this->db->insert_id();
    }

    /**
     * 以下功能暂定，暂不能用。
     */
    public function getReturnByReturnId($rId)
    {
        $field = '*';
        return $this->db->select($field)->get_where('returns', array('return_id' => $rId))->row_array();
    }

    public function getReturnByUid($uId)
    {
        $field = '*';
        return $this->db->select($field)->get_where('returns', array('uid' => $uId))->result_array();
    }

    public function getReturnByOrderSn($orderSn)
    {
        $field = '*';
        return $this->db->select($field)->get_where('returns', array('order_sn' => $orderSn))->result_array();
    }
}
