<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午10:32
 * To change this template use File | Settings | File Templates.
 */
class Model_Product_Brand extends MY_Model
{
    /**
     * 根据品牌id获取信息
     * @param $bid
     * @param string $field
     * @param null $where
     * @return mixed
     */
    function getBrandByID($bid, $field = '*', $where = null)
     {
         $this->db->select($field)->from('product_brand');
         $where && $this->db->where($where);
         if(is_array($bid))
         {
             return  $this->db->where_in('bid', $bid)->get()->result_array();
         }
         return $this->db->where('bid', $bid)->get()->row_array();
     }

    /**
     * 获取品牌数量
     * @param null $where
     * @return int
     */
    public function getBrandCount($where = null)
    {
        $this->db->from('product_brand');
        $where && $this->db->where($where);
        return $this->db->count_all_results();
    }

    /**
     * 获取品牌列表
     *
     * @param int $limit
     * @param int $offset
     * @param string $field
     * @param int $where
     * @param $order
     * @return null | array
     */
    public function getBrandList($limit = 20, $offset = 0, $field= "*", $where = null, $order = null)
    {
        list($key, $field) = self::formatField($field);
        $this->db->select($field);
        $this->db->from('product_brand');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array($key);
        return $data;
    }
}
