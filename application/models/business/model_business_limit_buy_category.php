<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-16
 * Time: 下午6:21
 * To change this template use File | Settings | File Templates.
 */
class model_business_limit_buy_category extends MY_Model
{
    /**
     * 获取所有分类列表
     */
    public function getCategoryList()
    {
        $categoryList = $this->db
            ->select()
            ->order_by('sort', 'desc')
            ->get_where('limit_buy_category')
            ->result_array();

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
                $formatCat[$val['id']] = $val;

                unset($catArray[$key]);

                $floor++;
                self::sortdata($catArray, $val['id']);
                $floor--;
            }
        }
        return $formatCat;
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
            ->get_where('limit_buy_category', array('id' => $class_id))
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
            $this->db->where('id', $class_id);
            $this->db->update('limit_buy_category', $data);
        } else {
            $data['create_time'] = date('Y-m-d H:i:s', TIMESTAMP);
            $this->db->insert('limit_buy_category', $data);
        }
    }

    /**
     * 根据分类id查看是否有子类
     * @param $class_id
     * @return bool
     */
    public function isAlone($class_id)
    {
        $num = $this->db->from('limit_buy_category')
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
        $this->db->where('id', $class_id);
        $this->db->delete('limit_buy_category');
        return true;

    }
}
