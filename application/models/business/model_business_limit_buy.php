<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-16
 * Time: 下午6:51
 * To change this template use File | Settings | File Templates.
 */
class model_business_limit_buy extends MY_Model
{
    public function getList()
    {
        $data = $this->db
            ->select()
            ->order_by('id', 'desc')
            ->get_where('limit_buy')
            ->result_array();

        return $data;
    }

    public function getCategoryAndLimitBuyList()
    {
        $categoryList = $this->db->select()->order_by('sort', 'desc')->get_where('limit_buy_category', null, 5, 0)->result_array();

        foreach ($categoryList as $k=>$v) {
            $tmpData = $this->db->select()->order_by('sort', 'desc')->get_where('limit_buy', array('cid' => $v['id'], 'end_time >' => date('Y-m-d H:i:s')), 4, 0)->result_array();
            $categoryList[$k]['item'] = $tmpData;
        }

        return $categoryList;
        //echo '<pre>';print_r($categoryList);
    }

    public function getBeforeLimitBuy()
    {
        return $this->db->select()->order_by('sort', 'desc')->get_where('limit_buy', array('end_time <' => date('Y-m-d H:i:s')), 8, 0)->result_array();
    }

    public function getDefaultLimitBuy()
    {
        return $this->db->select()->order_by('sort', 'desc')->get_where('limit_buy', array('cid =' => '0'), 5, 0)->result_array();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('limit_buy');
        return true;
    }

    public function addLimitBuy(array $data)
    {
        $info = array(
            'cid' => $data['cid'],
            'pid' => $data['pid'],
            //'product_image' => $data['product_image'],
            'pname' => $data['pname'],
            'sell_price' => $data['sell_price'],
            'limit_buy_price' => $data['limit_buy_price'],
            //'attention_num' => $data['attention_num'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'sales_status' => $data['sales_status'],
            'inventory' => $data['inventory'],
            'sort' => $data['sort'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('limit_buy', $info);
        return $this->db->insert_id();
    }

    public function updateLimitBuy(array $data, $id)
    {
        $info = array(
            'cid' => $data['cid'],
            'pid' => $data['pid'],
            //'product_image' => $data['product_image'],
            'pname' => $data['pname'],
            'sell_price' => $data['sell_price'],
            'limit_buy_price' => $data['limit_buy_price'],
            //'attention_num' => $data['attention_num'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'sales_status' => $data['sales_status'],
            'inventory' => $data['inventory'],
            'sort' => $data['sort'],
            //'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->where('id', $id);
        return $this->db->update('limit_buy', $info);
    }

    public function getLimitBuy($id)
    {
        $data = $this->db
            ->select()
            ->where('id', $id)
            ->order_by('sort', 'desc')
            ->get_where('limit_buy')
            ->row_array();
        return $data;
    }

    public function updateImage($file, $tId)
    {
        $data = array(
            'product_image' => $file,
        );

        $this->db->where('id', $tId);
        return $this->db->update('limit_buy', $data);
    }
}
