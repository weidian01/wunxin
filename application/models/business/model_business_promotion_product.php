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

    /**
     * 删除促销产品
     *
     * @param $id
     * @return mixed
     */
    public function deleteProduct($id)
    {
        $this->db->where('id', $id);

        return $this->db->delete('promotion_product');
    }

    /**
     * 添加促销产品
     *
     * @param array $data
     * @return mixed
     */
    public function addProduct(array $data)
    {
        $info = array(
            'promotion_id' => $data['promotion_id'],
            'cid' => $data['cid'],
            'pid' => $data['pid'],
            'pname' => $data['pname'],
            'sell_price' => $data['sell_price'],
            'promotion_price' => $data['promotion_price'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'inventory' => $data['inventory'],
            'sort' => $data['sort'],
            'sales_status' => $data['sales_status'],
            'rule' => $data['rule'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('promotion_product', $info);
        return $this->db->insert_id();
    }

    /**
     * 修改活动产品
     *
     * @param array $data
     * @param $id
     * @return boolean
     */
    public function editProduct(array $data, $id)
    {
        $info = array(
            'promotion_id' => $data['promotion_id'],
            'cid' => $data['cid'],
            'pid' => $data['pid'],
            'pname' => $data['pname'],
            'sell_price' => $data['sell_price'],
            'promotion_price' => $data['promotion_price'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'inventory' => $data['inventory'],
            'sort' => $data['sort'],
            'sales_status' => $data['sales_status'],
            'rule' => $data['rule'],
        );

        $this->db->where('id', $id);
        return $this->db->update('promotion_product', $info);
    }

    /**
     * 更新图片地址
     *
     * @param $file
     * @param $lastId
     * @return mixed
     */
    public function updateImage($file, $lastId)
    {
        $data = array(
            'product_image' => $file,
        );

        $this->db->where('id', $lastId);
        return $this->db->update('promotion_product', $data);
    }

    /**
     * 通过活动ID，获取活动分类和产品
     *
     * @param $promotionId
     * @param int $limit
     * @param $offset
     * @return array
     */
    public function getProductByPromotionId($promotionId, $limit = 4, $offset = 0)
    {
        $return = array();
        $this->db->select('*')->from('promotion_product_category');
        $category = $this->db->where('promotion_id', $promotionId)->limit(5, 0)->order_by('sort', 'desc')->get()->result_array();

        if (!empty ($category)) {
            foreach ($category as $k=>$v) {
                $tmp = array(
                    'promotion_id' => $promotionId,
                    'cid' => $v['cid'],
                    'start_time <=' => date('Y-m-d H:i:s', TIMESTAMP),
                    'end_time >=' => date('Y-m-d H:i:s', TIMESTAMP),
                );
                $category[$k]['item'] = $this->db->select('*')->from('promotion_product')->where($tmp)->limit($limit, $offset)->get()->result_array();
            }
        }

        return empty ($category) ? $return : $category;
    }

    /**
     * 获取活动产品
     *
     * @param $pId
     * @param int $limit
     * @param int $offset
     * @param string $field
     * @param null $where
     * @param null $order
     * @param null $group
     * @return mixed
     */
    public function getPromotionProductByPid($pId, $limit = 20, $offset = 0, $field = '*', $where = null, $order = null, $group = null)
    {
        $this->db->select($field)->from('promotion_product');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $group && $this->db->group_by($group);
        $this->db->limit($limit, $offset);

        if(is_array($pId))
        {
            return  $this->db->where_in('pid', $pId)->get()->result_array('pid');
        }
        return $this->db->where('pid', $pId)->get()->result_array('pid');
    }

    /**
     * 获取活动产品 -- 通过自增ID
     *
     * @param $id
     * @param int $limit
     * @param int $offset
     * @param string $field
     * @param null $where
     * @param null $order
     * @param null $group
     * @return mixed
     */
    public function getProductById($id, $limit = 20, $offset = 0, $field = '*', $where = null, $order = null, $group = null)
    {
        $this->db->select($field)->from('promotion_product');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $group && $this->db->group_by($group);
        $this->db->limit($limit, $offset);

        return  $this->db->where_in('id', $id)->get()->row_array('pid');
    }
}
