<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午9:31
 * To change this template use File | Settings | File Templates.
 */
class Model_Product_Size extends MY_Model
{
    /**
     * @param array $data
     * @param int $size_id
     */
    public function save(array $data, $size_id = 0)
    {
        if ($size_id) {
            $this->db->where('size_id', $size_id);
            $this->db->update('size', $data);
        } else {
            $data['create_time'] = date('Y-m-d H:i:s', TIMESTAMP);
            $this->db->insert('size', $data);
        }
    }

    /**
     * 根据模型id 删除模型
     * @param $model_id
     */
    function delete($size_id)
    {
        $this->db->where('size_id', $size_id);
        $this->db->delete('size');
    }

    /**
     * 查看是否有产品使用该模型
     * @param $model_id
     * @return int
     */
    function isUse($size_id)
    {
        $this->db->from('product_size');
        $this->db->where('size_id', $size_id);
        $r = $this->db->count_all_results();
        return $r ? true : false;
    }

    /**
     * 获取根据模型id一个模型的详细内容(模型名称和其属性值)
     * @param $model_id
     * @return array
     */
    function getSizeById($size_id)
    {
        $info = $this->db
            ->select()
            ->get_where('size', array('size_id' => $size_id))
            ->row_array();
        return $info;
    }

    /**
     * 根据类型或的该类型下所有号码
     * @param $type
     * @return mixed
     */
    function getSizeByType($type, $field = '*')
    {
        $info = $this->db
            ->select($field)
            ->get_where('size', array('type' => $type))
            ->result_array();
        return $info;
    }

    /**
     * 获取模型列表
     * @param int $offset
     * @param int $limit
     * @return array
     */
    function getList($limit = 20, $offset = 0)
    {
        $data = $this->db
            ->select()
            ->get_where('size', null, $limit, $offset)
            ->result_array();
        return $data;
    }

    /**
     * 获取模型数量
     * @return mixed
     */
    function getNum()
    {
        $this->db->from('size');
        return $this->db->count_all_results();
    }


}
