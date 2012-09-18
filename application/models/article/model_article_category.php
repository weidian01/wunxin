<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-18
 * Time: 下午9:40
 * To change this template use File | Settings | File Templates.
 */
class Model_Article_Category extends MY_Model
{
    /**
     * 添加分类
     *
     * @param array $data
     * @return boolean
     */
    public function addCategory(array $data)
    {
        $data = array(
            'cname' => $data['cname'],
            'parent_id' => $data['parent_id'],
            'sort' => $data['sort'],
            'path' => $data['path'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('article_category', $data);
        return $this->db->insert_id();
    }

    /**
     * 修改分类
     *
     * @param array $data
     * @param $cId
     * @return boolean
     */
    public function editCategory(array $data, $cId)
    {
        $data = array(
            'cname' => '"'.$data['cname'].'"',
            'parent_id' => $data['parent_id'],
            'sort' => $data['sort'],
            'path' => '"'.$data['path'].'"',
        );

        $this->db->where('cid', $cId);
        return $this->db->set($data, '', false)->update('article_category');
    }

    /**
     * 根据分类id查看是否有子类
     *
     * @param $class_id
     * @return bool
     */
    public function isAlone($class_id)
    {
        $num = $this->db->from('article_category')
            ->where('parent_id', $class_id)
            ->count_all_results();
        if ($num) //如果存在子类,则无法删除
            return false;
        return true;
    }

    /**
     * 删除分类
     *
     * @param $cId
     * @return boolean
     */
    public function deleteCategory($cId)
    {
        return $this->db->delete('article_category', array('cid' => $cId));
    }

    /**
     * 获取分类 -- 通过分类ID
     *
     * @param $cId
     * @return null | array
     */
    public function getCategoryById($cId)
    {
        $data = $this->db->select('*')->from('article_category')->where('cid', $cId)->get()->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取分类列表
     */
    public function getCategoryList()
    {
        $categoryList = $this->db
            ->select()
            ->order_by('sort', 'desc')
            ->get_where('article_category')
            ->result_array();
        return $this->sortdata($categoryList);
    }

    /**
     * 获取分类数量
     *
     * @return int
     */
    public function getCategoryCount()
    {
        $this->db->select('*')->from('article_category');

        return $this->db->count_all_results();
    }

    public function deleteCategoryByCId($newsId)
    {

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
                $formatCat[$val['cid']] = $val;

                unset($catArray[$key]);

                $floor++;
                self::sortdata($catArray, $val['cid']);
                $floor--;
            }
        }
        return $formatCat;
    }
}
