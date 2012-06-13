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
    function create($model_name, array $attrs)
    {
        $this->db->insert('product_model', array('model_name' => $model_name));
        $model_id = $this->db->insert_id();
        if (!$model_id) {
            return false;
        }

        foreach ($attrs as $key => $attr) {
//            $this->db->insert('product_model_attr', array(
//                'model_id' => $model_id,
//                'type' => $attr['type'],
//                'attr_name' => $attr['attr_name'],
//                'attr_value' => $attr['attr_value'],
//                'sort' => $attr['sort'],
//            ));
            $attrs[$key]['model_id'] = $model_id;

        }
        $this->db->insert_batch('product_model_attr',$attrs);
        return true;
    }

    /**
     * 更新模型内容
     * @param $model_name
     * @param array $attrs
     */
    function update($model_id, $model_name, array $attrs)
    {
        $this->db->where('model_id', $model_id);
        $this->db->update('product_model', array('model_name'=>$model_name));

//        foreach ($attrs as $attr) {
//            $this->db->where('attr_id', $attr['attr_id']);
//            $this->db->update('product_model_attr', array(
//                'type' => $attr['type'],
//                'attr_name' => $attr['attr_name'],
//                'attr_value' => $attr['attr_value'],
//                'sort' => $attr['sort'],
//            ));
//        }
        $this->db->update_batch('product_model_attr', $attrs, 'attr_id');
    }

    /**
     * 根据模型id 删除模型
     * @param $model_id
     */
    function delete($model_id)
    {
        $this->db->where('model_id', $model_id);
        $this->db->delete('product_model');

        $this->db->where('model_id', $model_id);
        $this->db->delete('product_model_attr');
    }

    /**
     * 查看是否有产品使用该模型
     * @param $model_id
     * @return int
     */
    function isUse($model_id)
    {
        $this->db->from('product_attr');
        $this->db->where('model_id', $model_id);
        $r = $this->db->count_all_results();
        return $r ? true : false;
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

    /**
     * 获取模型数量
     * @return mixed
     */
    function getModelNum()
    {
        $this->db->from('product_model');
        return $this->db->count_all_results();
    }


}
