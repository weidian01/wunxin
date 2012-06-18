<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-18
 * Time: 上午11:50
 * To change this template use File | Settings | File Templates.
 */
class Model_Order_Return extends MY_Model
{
    /**
     * 获取退换货信息 -- 通过订单ID
     *
     * @param $orderSn
     * @return null || array
     */
    public function getReturnByOrderSn($orderSn)
    {
        $data = $this->db->select('*')->get_where('returns', array('order_sn' => $orderSn))->result_array();

        return empty ($data) ? null : $data;
    }
}
