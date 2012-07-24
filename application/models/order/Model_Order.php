<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Order extends MY_Model
{
    /**
     * @name 增加订单
     *
     * @param $orderInfo 订单信息
     * @return array
     */
    public function addOrder(array $orderInfo)
    {
        $data = array(
            'uid' => $orderInfo['uid'],
            'uname' => $orderInfo['uname'],
            'after_discount_price' => $orderInfo['after_discount_price'],
            'discount_rate' => $orderInfo['discount_rate'],
            'before_discount_price' => $orderInfo['before_discount_price'],
            'pay_type' => $orderInfo['pay_type'],
            'order_source' => $orderInfo['order_source'],
            'delivert_time' => $orderInfo['delivert_time'],
            'annotated' => $orderInfo['annotated'],
            'invoice' => $orderInfo['invoice'],
            'paid' => $orderInfo['paid'],
            'need_pay' => $orderInfo['need_pay'],
            'ip' => $orderInfo['ip'],
            'address_id' => $orderInfo['address_id'],
            'invoice_payable' => $orderInfo['invoice_payable'],
            'invoice_content' => $orderInfo['invoice_content'],
            'recent_name' => $orderInfo['recent_name'],
            'recent_address' => $orderInfo['recent_address'],
            'zipcode' => $orderInfo['zipcode'],
            'phone_num' => $orderInfo['phone_num'],
            'call_num' => $orderInfo['call_num'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('order', $data);
        return $this->db->insert_id();
    }

    /**
     * @name 增加订单和订单产品
     *
     * @param $productInfo 订单产品信息
     * @param $orderSn 订单ID
     * @return array
     */
    public function addOrderProduct(array $productInfo, $orderSn)
    {
        $data = array();
        foreach ($productInfo as $v) {
            $data[] = array(
                'order_sn' => $orderSn,
                'pid' => $v['pid'],
                'uid' => $v['uid'],
                'uname' => $v['uname'],
                'pname' => $v['pname'],
                'market_price' => $v['market_price'],
                'sall_price' => $v['sall_price'],
                'product_num' => $v['product_num'],
                'product_size' => $v['product_size'],
                'presentation_integral' => $v['presentation_integral'],
                'preferential' => $v['preferential'],
                'warehouse'=> $v['warehouse'],
                'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
            );
        }

        return $this->db->insert_batch('order_product', $data);
    }

    /**
     * 添加一个订单产品
     *
     * @param array $productInfo
     * @param $orderSn
     * @return int
     */
    public function addOneOrderProduct(array $productInfo, $orderSn) {
        $data = array(
            'order_sn' => $orderSn,
            'pid' => $productInfo['pid'],
            'uid' => $productInfo['uid'],
            'uname' => $productInfo['uname'],
            'pname' => $productInfo['pname'],
            'market_price' => $productInfo['market_price'],
            'sall_price' => $productInfo['sall_price'],
            'product_num' => $productInfo['product_num'],
            'product_size' => $productInfo['product_size'],
            'presentation_integral' => $productInfo['presentation_integral'],
            'preferential' => $productInfo['preferential'],
            'warehouse'=> $productInfo['warehouse'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('order_product', $data);
        return $this->db->insert_id();
    }

    /**
     * @name 增加订单和订单产品
     *
     * @param $orderInfo 订单信息
     * @param $productInfo 订单产品信息
     * @return array
     */
    public function addOrderAndProduct(array $orderInfo, array $productInfo)
    {
        $orderSn = $this->addOrder($orderInfo);
        if (!$orderInfo) return false;

        $status = $this->addOrderProduct($productInfo, $orderSn);
        if (!$status) return false;

        return true;
    }

    /**
     * @name 获取订单信息 -- 通过订单ID
     *
     * @param $orderSn 订单ID
     * @param $field
     * @return array | null
     */
    public function getOrderByOrderSn($orderSn, $field = '*')
    {
        //$field = $field === '*' ? '*' : $field;

        $data = $this->db->select($field)->get_where('order', array('order_sn' => $orderSn))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * @name 获取订单产品信息 -- 通过订单ID
     *
     * @param $orderSn 订单ID
     * @param $field
     * @return array
     */
    public function getOrderAllProductByOrderSn($orderSn, $field = '*')
    {
        $field = $field === '*' ? '*' : $field;

        return $this->db->select($field)->get_where('order_product', array('order_sn' => $orderSn))->result_array();
    }

    /**
     * @name 获取订单所有信息 -- 通过订单ID
     *
     * @param $orderSn 订单ID
     * @return boolean
     */
    public function getOrderAllInfoByOrderSn($orderSn)
    {
        $orderInfo = $this->getOrderByOrderSn($orderSn);
        $orderProductInfo = $this->getOrderAllProductByOrderSn($orderSn);
        //$orderInvoiceInfo = $this->getOrderInvoiceInfoByOrderSn($orderSn);

        $orderInfo['product'] = $orderProductInfo;
        //$orderInfo['invoice'] = $orderInvoiceInfo;

        return $orderInfo;

    }

    /**
     * @name 更新订单信息 -- 通过订单ID
     *
     * @param $changeInfo 需要更新的数据
     * @param $orderSn 订单ID
     * @return boolean
     */
    public function updateOrderByOrderSn(array $changeInfo, $orderSn)
    {
        $data = array(
            'is_pay' => $changeInfo['is_pay'],
            'paid' => $changeInfo['paid'],
            'need_pay' => $changeInfo['need_pay'],
            'pay_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        return $this->db->where('order_sn', $orderSn)->update('order', $data);
    }

    /**
     * @name 根据用户id获取订单信息
     *
     * @param int $uid
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getOrderByUid($uid, $limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->order_by('order_sn', 'desc')->get_where('order', array('uid' => $uid), $limit, $offset)->result_array();
        //var_dump($data);
        $orders = $ordersn = array();
        foreach ($data as $item) {
            $orders[$item['order_sn']] = $item;
            $ordersn[] = $item['order_sn'];
        }

        unset($data);

        if ($ordersn) {
            $products = $this->db->select('*')->from('order_product')->where_in('order_sn', $ordersn)->get()->result_array();
            //var_dump($products);
            foreach ($products as $item) {
                $orders[$item['order_sn']]['products'][] = $item;
            }
        }
        return $orders;
    }

    /**
     * 获取用户订单列表
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserOrderList($uId, $limit = 20, $offset = 0)
    {
        $this->db->select('*')->from('order')->where('uid', $uId)->order_by('order_sn', 'desc')->limit($limit, $offset);
        $data = $this->db->get()->result_array();
        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户订单数量
     *
     * @param $uId
     * @return int
     */
    public function getUserOrderCount($uId)
    {
        $this->db->select('*')->from('order')->where('uid', $uId);
        return $this->db->count_all_results();
        //return empty ($data) ? null : $data;
    }

    /**
     * 获取订单列表
     *
     * @param int $limit
     * @param int $offset
     * @param array $where
     * @return null | array
     */
    public function getOrderList($limit = 20, $offset = 0,$where = array())
    {
        $this->db->where($where);
        $this->db->select('*')->from('order')->order_by('order_sn', 'desc')->limit($limit, $offset);
        $data = $this->db->get()->result_array();
        return empty ($data) ? null : $data;
    }

    /**
     * 获取订单数量
     *
     * @param array $where
     * @return mixed
     */
    public function getOrderCount($where = array())
    {
        $this->db->select('*')->from('order');
        $this->db->where($where);
        return $this->db->count_all_results();
    }

    /**
     * @name 用户是否购买过此产品
     *
     * @param $uid
     * @param $pid
     * @return array
     */
    public function userIsBuyProduct($uid, $pid)
    {
        $field = '*';
        $data = $this->db->select($field)->from('order_product')
            ->join('order', 'order_product.order_sn=order.order_sn', 'left')
            ->where('order_product.uid', $uid)
            ->where('order_product.pid', $pid)
            ->where('order.is_pay', '1')->get()->row_array();

        return $data;
    }

    /**
     * 删除订单
     *
     * @param $orderSn
     * @return bool
     */
    public function deleteOrderByOrderSn($orderSn)
    {
        $this->db->delete('order', array('order_sn' => $orderSn));

        $this->db->delete('order_product', array('order_sn' => $orderSn));

        return true;
    }
}