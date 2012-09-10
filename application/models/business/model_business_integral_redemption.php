<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-28
 * Time: 下午12:42
 * To change this template use File | Settings | File Templates.
 */
class Model_Business_Integral_Redemption extends MY_Model
{
    /**
     * 添加积分换购产品
     *
     * @param array $data
     * @return boolean
     */
    public function addIntegralRedemption(array $data)
    {
        $info = array(
            'pid' => $data['pid'],
            'redemption_integral' => $data['redemption_integral'],
            'price' => $data['price'],
            'redemption_price' => $data['redemption_price'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('integral_redemption_product', $info);
        return $this->db->insert_id();
    }

    /**
     * 修改积分换购产品
     *
     * @param array $data
     * @param $irId
     * @return boolean
     */
    public function editIntegralRedemption(array $data, $irId)
    {
        $info = array(
            'pid' => $data['pid'],
            'redemption_integral' => $data['redemption_integral'],
            'price' => $data['price'],
            'redemption_price' => $data['redemption_price'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
        );

        $this->db->where('redemption_id', $irId);
        return $this->db->update('integral_redemption_product', $info);
    }

    /**
     * 获取积分换购产品
     *
     * @param $irId
     * @return null | array
     */
    public function getIntegralRedemptionByirId($irId)
    {
        $data = $this->db->select('*')->from('integral_redemption_product')->where('redemption_id', $irId)->get()->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取积分换购产品列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getIntegralRedemptionList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('integral_redemption_product');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取积分换购产品数量
     *
     * @return int
     */
    public function getIntegralRedemptionCount()
    {
        $this->db->select('*')->from('integral_redemption_product');

        return $this->db->count_all_results();
    }

    /**
     * 删除积分换购产品
     *
     * @param $irId
     * @return boolean
     */
    public function deleteIntegralRedemption($irId)
    {
        return $this->db->delete('integral_redemption_product', array('redemption_id' => $irId));
    }
}
