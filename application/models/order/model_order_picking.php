<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-18
 * Time: 下午2:35
 * To change this template use File | Settings | File Templates.
 */
class Model_Order_Picking extends MY_Model
{
    /**
     * 获取配货信息 -- 通过配货ID
     * @param $pId
     * @return null | array
     */
    public function getPickingByPid($pId)
    {
        $data = $this->db->select('*')->get_where('picking', array('picking_id' => $pId))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取配货产品信息 -- 通过配货ID
     *
     * @param $pId
     * @return null  | array
     */
    public function getPickingProductByPid($pId)
    {
        $data = $this->db->select('*')->get_where('picking_product', array('picking_id' => $pId))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取配货产品详情信息 -- 通过配货ID
     *
     * @param $pId
     * @return null | array
     */
    public function getPickingProductInfoByPid($pId)
    {
        $this->db->select('*');
        $this->db->from('picking_product');
        $this->db->join('product', 'picking_product.pid = product.pid', 'left');
        $this->db->where('picking_product.picking_id', $pId);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取配货列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getPicking($limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->from('picking')->order_by('picking_id', 'desc')->limit($limit, $offset)->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取配货数量
     *
     * @return mixed
     */
    public function getPickingCount()
    {
        $this->db->select('*')->from('picking');

        return $this->db->count_all_results();
    }

    /**
     * 获取配货信息 -- 通过订单ID
     *
     * @param $orderSn
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getPickingByOrderSn($orderSn, $limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->get_where('picking', array('order_sn' => $orderSn), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取配货信息数量 -- 通过订单ID
     *
     * @param $orderSn
     * @return int
     */
    public function getPickingCountByOrderSn($orderSn)
    {
        $this->db->select('*')->from('picking')->where('order_sn', $orderSn);

        return $this->db->count_all_results();
    }


    public function create($info,$product, $amUid)
    {
       $info['uid'] = $amUid;
       $info['create_time'] = date("Y-m-d H:i:s", TIMESTAMP);
       $this->db->insert('picking', $info);
       $picking_id = $this->db->insert_id();
       foreach($product as $k=>$v)
       {
           $product[$k]['picking_id'] = $picking_id;
           $product[$k]['create_time'] = $info['create_time'];
       }
       $this->db->insert_batch('picking_product', $product);
       $this->db->update('order', array('picking_status'=>1), array('order_sn'=>$info['order_sn'], 'picking_status'=>0, 'status'=>2));
    }

}
