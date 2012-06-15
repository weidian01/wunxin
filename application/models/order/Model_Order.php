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
            'address_id' => $orderInfo['address_id'],
            'uid' => $orderInfo['uid'],
            'uname' => $orderInfo['uname'],
            'after_discount_price' => $orderInfo['after_discount_price'],
            'discount_rate' => $orderInfo['discount_rate'],
            'before_discount_price' => $orderInfo['before_discount_price'],
            'pay_type' => $orderInfo['pay_type'],
            'defray_type' => $orderInfo['defray_type'],
            'is_pay' => $orderInfo['is_pay'],
            'order_source' => $orderInfo['order_source'],
            'pay_time' => $orderInfo['pay_time'],
            'delivert_time' => $orderInfo['delivert_time'],
            'annotated' => $orderInfo['annotated'],
            'invoice' => $orderInfo['invoice'],
            'paid' => $orderInfo['paid'],
            'need_pay' => $orderInfo['need_pay'],
            'ip' => $orderInfo['ip'],
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
                'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
            );
        }

        return $this->db->insert_batch('order_product', $data);
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
     * @return array
     */
    public function getOrderByOrderSn($orderSn)
    {
        $field = 'order_sn, address_id, uid, uname, after_discount_price, discount_rate, before_discount_price, pay_type,
            defray_type, is_pay, order_source, pay_time, delivert_time, annotated, invoice, paid, need_pay, ip, create_time';
        $field = '*';

        return $this->db->select($field)->get_where('order', array('order_sn' => $orderSn))->row_array();
    }

    /**
     * @name 获取订单产品信息 -- 通过订单ID
     *
     * @param $orderSn 订单ID
     * @return array
     */
    public function getOrderAllProductByOrderSn($orderSn)
    {
        $field = 'id, order_sn, pid, uid, uname, pname, market_price, sall_price, product_num, create_time, comment_status,
            share_status, product_size, presentation_integral, preferential';

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
        $orderInvoiceInfo = $this->getOrderInvoiceInfoByOrderSn($orderSn);

        $orderInfo['product'] = $orderProductInfo;
        $orderInfo['invoice'] = $orderInvoiceInfo;

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
     * 获取订单列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getOrderList($limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->from('order')->order_by('order_sn', 'desc')->limit($limit, $offset)->get()->result_array();

        return empty ($data) ? null : $data;
    }

    public function getOrderCount()
    {
        $this->db->select('*')->from('order');

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