<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-9-10
 * Time: 下午10:37
 * To change this template use File | Settings | File Templates.
 */
class model_crawl_analysis extends MY_Model
{
    /**
     * 获取淘宝产品链接
     *
     * @param string $field
     * @param int $limit
     * @param int $offset
     * @param null $where
     * @param null $order
     * @return mixed
     */
    public function getTableProductLink($field = '*', $limit = 20, $offset = 0, $where = null, $order = null)
    {
        $this->db->select($field)->from('taobao_product_link');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $this->db->limit($limit, $offset);

        return $this->db->get()->result_array();
    }

    /**
     * 获取淘宝产品图片
     *
     * @param string $field
     * @param int $limit
     * @param int $offset
     * @param null $where
     * @param null $order
     * @return mixed
     */
    public function getTaobaoProductImg($field = '*', $limit = 20, $offset = 0, $where = null, $order = null)
    {
        $this->db->select($field)->from('taobao_product_img');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $this->db->limit($limit, $offset);

        return $this->db->get()->result_array();
    }

    /**
     * 获取淘宝产品
     *
     * @param string $field
     * @param int $limit
     * @param int $offset
     * @param null $where
     * @param null $order
     * @return mixed
     */
    public function getTaobaoProduct($field = '*', $limit = 20, $offset = 0, $where = null, $order = null)
    {
        $this->db->select($field)->from('taobao_product_data');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $this->db->limit($limit, $offset);

        return $this->db->get()->result_array();
    }

    /**
     * 获取淘宝产品简介图片
     *
     * @param string $field
     * @param int $limit
     * @param int $offset
     * @param null $where
     * @param null $order
     * @return mixed
     */
    public function getTaobaoProductIntroImg($field = '*', $limit = 20, $offset = 0, $where = null, $order = null)
    {
        $this->db->select($field)->from('taobao_product_intro_img');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $this->db->limit($limit, $offset);

        return $this->db->get()->result_array();
    }


}
