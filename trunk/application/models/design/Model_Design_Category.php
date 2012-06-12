<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-12
 * Time: 下午3:24
 * To change this template use File | Settings | File Templates.
 */
class Model_Design_Category extends MY_Model
{
    /**
     * 获取所有分类列表
     */
    public function getCategoryList()
    {
        $categoryList = $this->db
            ->select()
            ->order_by('sort', 'desc')
            ->get_where('design_category')
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

        foreach ($catArray as $key => $val) {
            if ($val['parent_id'] == $id) {
                $val['cname'] = $val['cname'];

                $val['floor'] = $floor;
                $formatCat[$val['class_id']] = $val;

                unset($catArray[$key]);

                $floor++;
                self::sortdata($catArray, $val['class_id']);
                $floor--;
            }
        }
        return $formatCat;
    }

    /**
     * 根据分类id 获取分类信息
     *
     * @param $class_id
     * @return mixed
     */
    public function getCategroyById($class_id)
    {
        return $categroy = $this->db
            ->select()
            ->get_where('product_category', array('class_id' => $class_id))
            ->row_array();
    }
}
