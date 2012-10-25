<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-24
 * Time: 下午5:54
 * To change this template use File | Settings | File Templates.
 */
class model_business_promotion_category extends MY_Model
{
    /**
     * 获取所有分类列表
     */
    public function getCategoryList($limit = 20, $offset = 0, $field = '*', $where = null, $order = null)
    {
        $this->db->select($field)->from('promotion_product_category');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $this->db->limit($limit, $offset);

        $categoryList = $this->db->get()->result_array('cid');

        return $this->sortdata($categoryList);
    }

    /**
     * 将所有分类按正确位置排序
     *
     * @static
     * @param $catArray
     * @param int $id
     * @return array
     */
    private static function sortData($catArray, $id = 0)
    {
        static $formatCat = array();
        static $floor = 0;

        foreach ($catArray as $key => $val) {//echo '<pre>';print_r($val);exit;
            if ($val['parent_id'] == $id) {
                $val['name'] = $val['name'];

                $val['floor'] = $floor;
                $formatCat[$val['cid']] = $val;

                unset($catArray[$key]);

                $floor++;
                self::sortdata($catArray, $val['cid']);
                $floor--;
            }
        }
        return $formatCat;
    }

    /**
     * 获取分类数量
     *
     * @param string $field
     * @param null $where
     * @return mixed
     */
    public function getCategoryCount($field = '*', $where = null)
    {
        $this->db->select($field)->from('promotion_product_category');
        $where && $this->db->where($where);

        return $this->db->count_all_results();
    }

    /**
     * 获取分类列表
     *
     * @param $promotionId
     * @param int $limit
     * @param int $offset
     * @param string $field
     * @param null $where
     * @param null $order
     * @return mixed
     */
    public function getCategoryListByPromotionId($promotionId, $limit = 20, $offset = 0, $field = '*', $where = null, $order = null)
    {
        $this->db->select($field)->from('promotion_product_category');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $this->db->limit($limit, $offset);

        if(is_array($promotionId))
        {
            $data = $this->db->where_in('promotion_id', $promotionId)->get()->result_array();
        } else {
            $data = $this->db->where('promotion_id', $promotionId)->get()->result_array();
        }

        //return $data;
        return $this->sortdata($data);
    }

    /**
     * 根据分类id 获取分类信息
     * @param $class_id
     * @return mixed
     */
    public function getCategoryById($class_id)
    {
        return $category = $this->db
            ->select()
            ->get_where('promotion_product_category', array('cid' => $class_id))
            ->row_array();
    }

    /**
     * 传入素有
     */
    public function getCategoryTree(array $categoryList)
    {

    }

    /**
     * 插入一条新分类或修改一条已存在的分类信息
     * @param array $data
     * @param int $class_id
     */
    public function save(array $data, $class_id = 0)
    {
        if ($class_id) {
            $this->db->where('cid', $class_id);
            $this->db->update('promotion_product_category', $data);
        } else {
            $data['create_time'] = date('Y-m-d H:i:s', TIMESTAMP);
            $this->db->insert('promotion_product_category', $data);
        }
    }

    /**
     * 根据分类id查看是否有子类
     * @param $class_id
     * @return bool
     */
    public function isAlone($class_id)
    {
        $num = $this->db->from('promotion_product_category')
            ->where('parent_id', $class_id)
            ->count_all_results();
        if ($num) //如果存在子类,则无法删除
            return false;
        return true;
    }

    /**
     * 删除分类信息
     * @param $class_id
     * @return bool
     */
    public function delete($class_id)
    {
        $this->db->where('cid', $class_id);
        $this->db->delete('promotion_product_category');
        return true;

    }
}
