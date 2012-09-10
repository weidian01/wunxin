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
    private $category = array();

    /**
     * 获取所有分类列表
     */
    public function getCategroyList()
    {
        if($this->category)
            return $this->category;

        $categroyList = $this->db
            ->select()
            ->order_by('sort', 'desc')
            ->get_where('product_category')
            ->result_array();
        $this->category = $this->sortdata($categroyList);
        return $this->category;
    }

    /**
     * 将所有分类按正确位置排序
     * @static
     * @param $catArray
     * @param int $id
     * @return array
     */
    private static function sortdata(&$catArray, $id = 0)
    {
        static $formatCat = array();
        static $floor = 0;
        static $ancestor = 0;
        foreach ($catArray as $key => $val) {

            if ($val['parent_id'] == $id) {
                ($val['parent_id'] == 0) && $ancestor = $val['class_id'];
                //$val['cname'] = $val['cname'];
                $val['ancestor'] = $ancestor;
                $id && $formatCat[$id]['is_parent'] = true;
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
     * 获取所有父类
     * @param $cid
     */
    public function getParents($cid = 0)
    {
        $category = $this->getCategroyList();
        $result = array();
        if(! isset($category[$cid]))
            return $result;
        while(true)
        {
            $result = array($cid => $category[$cid]) + $result;
            $cid = $category[$cid]['parent_id'];
            if ($cid == 0) {
                break;
            }
        }
        return $result;
    }

    public function getChildren($cid = 0, $filter = true)
    {
        $category = $this->getCategroyList();
        $result = array();
        if(! isset($category[$cid]))
            return $result;
        $flag = false;
        $floor = $category[$cid]['floor'];
        foreach($category as $item)
        {
            if($flag && ($item['floor'] <= $floor))
            {
                break;
            }
            if($cid == $item['class_id'])
            {
                $flag = true;
                $floor = $item['floor'];
            }
            if($flag)
            {
                if($filter)
                {
                    !isset($item['is_parent']) && $result[$item['class_id']] = $item;
                }
                else
                {
                    $result[$item['class_id']] = $item;
                }
            }
        }
        return $result;
    }

    public function getClan($cid = 0)
    {
        $category = $this->getCategroyList();
        $result = array();
        foreach($category as $item)
        {
            if($cid == $item['ancestor'])
            {
                $result[$item['class_id']] = $item;
            }
        }
        return $result;
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