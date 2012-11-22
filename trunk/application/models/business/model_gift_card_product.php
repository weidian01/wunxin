<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-22
 * Time: 上午11:48
 * To change this template use File | Settings | File Templates.
 */
class model_gift_card_product extends MY_Model
{
    /**
     * 给礼物卡添加销售范围的产品
     *
     * @param array $data
     * @return mixed
     */
    public function addProduct(array $data)
    {
        /*
        $info = array(
            'model_id' => $data['model_id'],
            'pid' => $data['pid'],
            'sell_price' => $data['sell_price'],
            'pname' => $data['pname'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('card_product', $info);
        return $this->db->insert_id();
        //*/

        $sql = "INSERT IGNORE INTO wx_card_product(model_id, pid, pname, sell_price, create_time) values ";
        $sql .= "({$data['model_id']}, {$data['pid']}, '{$data['pname']}', {$data['sell_price']}, '".date('Y-m-d H:i:s', TIMESTAMP)."')";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $field
     * @param null $where
     * @param null $orderBy
     * @return mixed
     */
    public function getList($limit = 20, $offset = 0, $field = '*', $where = null, $orderBy = null)
    {
        $this->db->select($field);
        $this->db->from('card_product');
        $where && $this->db->where($where);
        $orderBy && $this->db->order_by($orderBy);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return $data;
    }

    /**
     * 获取卡产品数量
     *
     * @param null $where
     * @return mixed
     */
    public function getProductCount($where = null)
    {
        $this->db->from('card_product');
        $where && $this->db->where($where);
        return $this->db->count_all_results();
    }

    /**
     * 删除产品
     *
     * @param $id
     * @return mixed
     */
    public function deleteProduct($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('card_product');
    }

    /**
     * 删除产品 -- 通过产品ID和卡模型ID
     *
     * @param $pId
     * @param $modelId
     * @return mixed
     */
    public function deleteProductByPM($pId, $modelId)
    {
        $this->db->where('pid', $pId);
        $this->db->where('model_id', $modelId);
        return $this->db->delete('card_product');
    }
}
