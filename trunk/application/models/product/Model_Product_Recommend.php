<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-1
 * Time: 下午2:51
 * To change this template use File | Settings | File Templates.
 */
class Model_Product_Recommend extends MY_Model
{
    /**
     * 获取产品收藏推荐
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getProductFavoriteRecommend($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('status', 1);
        $this->db->where('shelves', 1);
        $this->db->order_by('favorite_num', 'desc');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }
}
