<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午9:31
 * To change this template use File | Settings | File Templates.
 */
class Model_Product_Color extends MY_Model
{
    /**
     * 保存颜色
     *
     * @param array $data
     * @param int $color_id
     */
    public function save(array $data, $color_id = 0)
    {
        if ($color_id) {
            $this->db->where('color_id', $color_id);
            $this->db->update('color', $data);
        } else {
            $this->db->insert('color', $data);
        }
    }

    /**
     * 根据模型id 删除模型
     *
     * @param $color_id
     * @return boolean
     */
    function delete($color_id)
    {
        $this->db->where('color_id', $color_id);
        return $this->db->delete('color');
    }

    /**
     * 查看是否有产品使用该模型
     *
     * @param $color_id
     * @return bool
     */
    function isUse($color_id)
    {
        $this->db->from('product');
        $this->db->where('color_id', $color_id);
        $r = $this->db->count_all_results();
        return $r ? true : false;
    }

    /**
     * 获取根据模型id一个模型的详细内容(模型名称和其属性值)
     *
     * @param $color_id
     * @param $field
     * @return array
     */
    function getColorById($color_id, $field = '*')
    {
        $this->db->select($field)->from('color');
        if (is_array($color_id)) {
            return $this->db->where_in('color_id', $color_id)->get()->result_array();
        }
        return $this->db->where('color_id',$color_id)->get()->row_array();
    }

    /**
     * 获取模型列表
     *
     * @param int $offset
     * @param int $limit
     * @return array
     */
    function getList($limit = 20, $offset = 0, $field = '*', $where = null)
    {
        list($key, $field) = self::formatField($field);
        $where && $this->db->where($where);
        $data = $this->db->select($field)
            ->get_where('color', null, $limit, $offset)
            ->result_array($key);
        return $data;
    }

    /**
     * 获取模型数量
     *
     * @return int
     */
    function getNum()
    {
        $this->db->from('color');
        return $this->db->count_all_results();
    }


}
