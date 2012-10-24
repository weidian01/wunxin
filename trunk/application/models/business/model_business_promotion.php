<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-23
 * Time: 下午3:07
 * To change this template use File | Settings | File Templates.
 */
class model_business_promotion extends MY_Model
{
    /**
     * 获取促销活动数量
     *
     * @param string $field
     * @param null $where
     * @return mixed
     */
    public function getPromotionCount($field = '*', $where = null)
    {
        $this->db->select($field)->from('promotion');
        $where && $this->db->where($where);

        return $this->db->count_all_results();
    }

    /**
     * 获取促销活动列表
     *
     * @param int $limit
     * @param int $offset
     * @param string $field
     * @param null $where
     * @param null $order
     * @return mixed
     */
    public function getPromotionList($limit = 20, $offset = 0, $field = '*', $where = null, $order = null)
    {
        $this->db->select($field)->from('promotion');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $this->db->limit($limit, $offset);

        return $this->db->get()->result_array('promotion_id');
    }

    /**
     * 添加促销活动
     *
     * @param array $data
     * @return mixed
     */
    public function addPromotion(array $data)
    {
        $info = array(
            'name' => $data['name'],
            'promotion_range' => $data['promotion_range'],
            'promotion_type' => $data['promotion_type'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'descr' => $data['descr'],
            'is_juxtaposed' => $data['is_juxtaposed'],
            'priority' => $data['priority'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('promotion', $info);
        return $this->db->insert_id();
    }

    /**
     * 获取促销活动
     *
     * @param $promotionId
     * @param int $limit
     * @param int $offset
     * @param string $field
     * @param null $where
     * @param null $order
     * @return mixed
     */
    public function getPromotion($promotionId, $limit = 20, $offset = 0, $field = '*', $where = null, $order = null)
    {
        $this->db->select($field)->from('promotion');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $this->db->limit($limit, $offset);

        if(is_array($promotionId))
        {
            return  $this->db->where_in('promotion_id', $promotionId)->get()->result_array('promotion_id');
        }
        return $this->db->where('promotion_id', $promotionId)->get()->row_array('promotion_id');
    }

    /**
     * 修改促销活动
     *
     * @param array $data
     * @param $promotionId
     */
    public function editPromotion(array $data, $promotionId)
    {
        $this->db->where('promotion_id', $promotionId);

        return $this->db->update('promotion', $data);
    }

    /**
     * 删除促销活动
     *
     * @param $promotionId
     * @return mixed
     */
    public function deletePromotion($promotionId)
    {
        $this->db->where('promotion_id', $promotionId);

        return $this->db->delete('promotion');
    }
}
