<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-24
 * Time: 下午7:19
 * To change this template use File | Settings | File Templates.
 */
class model_business_promotion_product extends MY_Model
{
    /**
     * 获取促销产品数量
     *
     * @param string $field
     * @param null $where
     * @return mixed
     */
    public function getProductCount($field = '*', $where = null)
    {
        $this->db->select($field)->from('promotion_product');
        $where && $this->db->where($where);

        return $this->db->count_all_results();
    }

    /**
     * 获取促销产品列表
     *
     * @param int $limit
     * @param int $offset
     * @param string $field
     * @param null $where
     * @param null $order
     * @return mixed
     */
    public function getProductList($limit = 20, $offset = 0, $field = '*', $where = null, $order = null)
    {
        $this->db->select($field)->from('promotion_product');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $this->db->limit($limit, $offset);

        return $this->db->get()->result_array();
    }
}
