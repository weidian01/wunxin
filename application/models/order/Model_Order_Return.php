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
     * 申请退换货
     *
     * @param array $data
     * @return boolean
     */
    public function addReturn(array $data)
    {
        $info = array(
            'uid' => $data['uid'],
            'order_sn' => $data['order_sn'],
            'pid' => $data['pid'],
            'type' => $data['type'],
            'reason' => $data['reason'],
            'descr' => $data['descr'],
            'img_one' => $data['img_one'],
            'img_two' => $data['img_two'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );
        $this->db->insert('returns', $info);
        return $this->db->insert_id();
    }

    /**
     * 获取退换货信息 -- 通过订单号和产品ID
     *
     * @param $orderSn
     * @param $pId
     * @return null | array
     */
    public function getReturnByOrderSnAndPid($orderSn, $pId)
    {
        $data = $this->db->select('*')->get_where('returns', array('order_sn' => $orderSn, 'pid' => $pId))->result_array();

        return empty ($data) ? null : $data;
    }

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

    /**
     * 获取用户退换货信息
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserReturn($uId, $limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('returns')->where('uid', $uId);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户退换货信息数量
     *
     * @param $uId
     * @return int
     */
    public function getUserReturnCount($uId)
    {
        $this->db->select('*')->from('returns')->where('uid', $uId);

        return $this->db->count_all_results();
    }

    /**
     * 获取用户退换货和产品信息
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserReturnAndProduct($uId, $limit = 20, $offset = 0)
    {
        $field = 'return_id, returns.uid, order_sn, returns.pid, type, reason, returns.descr, logistic_num, cs_operations, store_operations,
        financial_operations, img_one, img_two, returns.status, returns.create_time,
        did, class_id, color_id, model_id, brand_id, pname, market_price, sell_price, style_no, stock, warehouse, product_taobao_addr, keyword, pcontent,
        source, expand, gender, size_type, check_status, shelves, cost_price, sales, favorite_num, comment_num';

        $this->db->select($field);
        $this->db->from('returns');
        $this->db->join('product', 'returns.pid = product.pid');
        $this->db->where('returns.uid', $uId);
        $this->db->order_by('returns.create_time', 'desc');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户退换货和产品信息数量
     *
     * @param $uId
     * @return int
     */
    public function getUserReturnAndProductCount($uId)
    {
        $this->db->select('*');
        $this->db->from('returns');
        $this->db->join('product', 'returns.pid = product.pid');
        $this->db->where('returns.uid', $uId);

        return $this->db->count_all_results();
    }

    /**
     * 取消退换货申请
     *
     * @param $returnId
     * @param $uId
     * @return boolean
     */
    public function cancelReturnApply($returnId, $uId)
    {
        $data = array( 'status' => 2, );

        $this->db->where('return_id', $returnId);
        $this->db->where('uid', $uId);
        return $this->db->update('returns', $data);
    }
}
