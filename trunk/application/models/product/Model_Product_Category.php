<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午9:31
 * To change this template use File | Settings | File Templates.
 */
class Model_Product_Category extends MY_Model
{
    /**
     * 获取所有分类列表
     */
    public function getCategroyList()
    {
        $categroyList = $this->db
            ->select()
            ->order_by('sort', 'desc')
            ->get_where('product_category')
            ->result_array();
        return $this->sortdata($categroyList);
    }

    /**
     * 将所有分类按正确位置排序
     * @static
     * @param $catArray
     * @param int $id
     * @return array
     */
    private static function sortdata($catArray, $id = 0)
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
     * @param $class_id
     * @return mixed
     */
    public function getCategroyById($class_id)
    {
        return $categroy = $this->db
            ->select()
            ->get_where('product_category',array('class_id' => $class_id))
            ->row_array();
    }

    /**
     * 传入素有
     */
    public function getCategroyTree(array $categroyList)
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
            $this->db->where('class_id', $class_id);
            $this->db->update('product_category', $data);
        } else {
            $data['create_time'] = date('Y-m-d H:i:s', TIMESTAMP);
            $this->db->insert('product_category', $data);
        }
    }

    /**
     * 根据分类id查看是否有子类
     * @param $class_id
     * @return bool
     */
    public function isAlone($class_id)
    {
        $num = $this->db->from('product_category')
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
        $this->db->where('class_id', $class_id);
        $this->db->delete('product_category');
        return true;

    }
}