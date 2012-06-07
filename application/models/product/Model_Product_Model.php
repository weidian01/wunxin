<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午9:31
 * To change this template use File | Settings | File Templates.
 */
class Model_Product_Model extends MY_Model
{
    /**
     * 创建一个属性
     * @param $model_name
     * @param array $attrs
     * array(
            array('name'=>'属性1','value'=>'1,2,3,4,5','type'=>1,'sort'=>1),
            array('name'=>'属性2','value'=>'1,2,3,4,5','type'=>2,'sort'=>2)
     * )
     * @return bool
     */
    function Model_create($model_name, array $attrs)
    {
        $this->db->insert('product_model', array('model_name' => $model_name));
        $model_id = $this->db->insert_id();
        if (!$model_id) {
            return false;
        }

        foreach ($attrs as $attr) {
            $this->db->insert('product_model_attr', array(
                'model_id' => $model_id,
                'type' => $attr['type'],
                'attr_name' => $attr['name'],
                'attr_value' => $attr['value'],
                'sort' => $attr['sort'],
            ));
        }
        return true;
    }

    /**
     * 更新模型内容
     * @param $model_name
     * @param array $attrs
     */
    function model_update($model_name, array $attrs)
    {

    }

    /**
     * 根据模型id 删除模型
     * @param $model_id
     */
    function model_delete($model_id)
    {

    }

    /**
     * 获取根据模型id一个模型的详细内容(模型名称和其属性值)
     * @param $model_id
     * @return array
     */
    function getModel($model_id)
    {
        $model = $this->db
            ->select('model_id, model_name')
            ->get_where('product_model', array('model_id' => $model_id))
            ->row_array();
        if ($model) {
            $model['attrs'] = $this->db
                ->select('attr_id, model_id, type, attr_name, attr_value, sort')
                ->order_by('sort', 'desc')
                ->get_where('product_model_attr', array('model_id' => $model_id))
                ->result_array();
        }
        return $model;
    }

    /**
     * 获取模型列表
     * @param int $offset
     * @param int $limit
     * @return array
     */
    function getModelList($limit = 20, $offset = 0)
    {
        $data = $this->db
            ->select('model_id, model_name')
            ->get_where('product_model', null, $limit, $offset)
            ->result_array();
        return $data;
    }


}
