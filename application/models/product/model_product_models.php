<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午9:31
 * To change this template use File | Settings | File Templates.
 */
class Model_Product_Models extends MY_Model
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

        $attr_id = array();
        foreach ($attrs as $attr)
        {
            if($attr['attr_id'])
            {
                $attr_id[] = (int)$attr['attr_id'];
                $this->db->where('attr_id', $attr['attr_id']);
                $this->db->update('product_model_attr', array(
                    'type' => $attr['type'],
                    'attr_name' => $attr['attr_name'],
                    'attr_value' => $attr['attr_value'],
                    'sort' => $attr['sort'],
                    'search' => $attr['search'],
                    'display' => $attr['display'],
                ));
            }
            else
            {
                $this->db->insert('product_model_attr', array(
                    'model_id' => $model_id,
                    'type' => $attr['type'],
                    'attr_name' => $attr['attr_name'],
                    'attr_value' => $attr['attr_value'],
                    'sort' => $attr['sort'],
                    'search' => $attr['search'],
                    'display' => $attr['display'],
                ));
                $attr_id[] = $this->db->insert_id();
            }
        }

        if ($attr_id)
        {
            $this->db->where('model_id', $model_id);
            $this->db->where_not_in('attr_id', $attr_id);
            $this->db->delete('product_model_attr');
        }
        //DELETE FROM iwebshop_attribute WHERE model_id = 5  and id not in (16,14,17)
        //$this->db->update_batch('product_model_attr', $attrs, 'attr_id');
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
            $model['attrs'] = $this->getModelAttr($model_id);
        }
        return $model;
    }

    /**
     * 根据模型id 获取模型属性
     * @param $model_id
     * @param null $search null 全部 1 可搜索的属性 0不可搜索的属性
     * @return mixed
     */
    function getModelAttr($model_id, $search=null, $field="*")
    {
        $where = array('model_id' => $model_id);
        if($search !== null)
        {
            $where['search'] = $search;
        }
        list($key, $field) = self::formatField($field);
        return $this->db
            ->select($field)
            ->order_by('sort desc, search desc, display desc')
            ->get_where('product_model_attr', $where)
            ->result_array($key);
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
            ->from('product_models')
            ->limit($limit, $offset)
            ->get()
            ->result_array();
        return $data;
    }

    /**
     * 获取模型数量
     * @return mixed
     */
    function getModelNum()
    {
        $this->db->from('product_models');
        return $this->db->count_all_results();
    }

    /**
     * 根据属性获取符合条件的产品id
     * @param array $attrs
     * @return array
     */
    function getPidByAttr(array $attrs)
    {
        $num = count($attrs);
        $data = array();
        if ($num) {
            $where = '';
            foreach ($attrs as $key => $value) {
                $where .= "OR (attr_id='{$key}' AND attr_value='{$value}') ";
            }
            $where = ltrim($where, "OR");
            $result = $this->db->query("SELECT pid FROM (`wx_product_attr`)  WHERE {$where} GROUP BY pid HAVING(COUNT(pid) >= {$num}) ORDER BY NULL");
            if ($result->num_rows() > 0) {
                foreach ($result->result() as $row) {
                    $data[] = $row->pid;
                }
            }
        }
        return $data;
    }

    function getAttrByPID($pid, $field="*")
    {
        list($key, $field) = self::formatField($field);
        $data = $this->db
            ->select($field)
            ->get_where('product_attrs', array('pid'=>$pid))
            ->result_array($key);
        return $data;
    }


    /**********************************************************************************************/

    /**
     * 获取所有属性
     * @param string $field
     * @return mixed
     */
    function get_all_attr($field="*")
    {
        list($key, $field) = self::formatField($field);
        $data = $this->db
            ->select($field)
            ->get_where('product_models_conf_attr')
            ->result_array($key);
        return $data;
    }

    /**
     * 根据属性id获取属性信息
     * @param $attr_id
     * @param string $field
     * @return mixed
     */
    function get_attr_by_id($attr_id)
    {
        return $this->db->get_where('product_models_conf_attr', array('attr_id'=>$attr_id))->row_array();
    }

    /**
     * 保存属性
     * @param $data
     * @return mixed
     */
    function save_attr($data)
    {
        return $this->_save('product_models_conf_attr', 'attr_id', $data);
//        if(isset($data['attr_id']) && $data['attr_id'])
//        {
//            $this->db->where('attr_id', $data['attr_id']);
//            unset($data['attr_id']);
//            $this->db->update('product_models_conf_attr', $data);
//            return $this->db->affected_rows();
//        }
//        else
//        {
//            $this->db->insert('product_models_conf_attr', $data);
//            return $this->db->insert_id();
//        }
    }

    function get_values_by_attr_id($attr_id, $field="*")
    {
        list($key, $field) = self::formatField($field);
        $attr_id && $this->db->where(array("attr_id"=>$attr_id));
        $data = $this->db
            ->select($field)
            ->get_where('product_models_conf_value')
            ->result_array($key);
        return $data;
    }

    function get_value_by_id($value_id)
    {
        return $this->db->get_where('product_models_conf_value', array('value_id'=>$value_id))->row_array();
    }

    /**
     * 保存属性值
     * @param $data
     * @return mixed
     */
    function save_value($data)
    {
        return $this->_save('product_models_conf_value', 'value_id', $data);
//        if(isset($data['value_id']) && $data['value_id'])
//        {
//            $this->db->where('value_id', $data['value_id']);
//            unset($data['value_id']);
//            $this->db->update('product_models_conf_value', $data);
//            return $this->db->affected_rows();
//        }
//        else
//        {
//            $this->db->insert('product_models_conf_value', $data);
//            return $this->db->insert_id();
//        }
    }

    function get_model_by_id($model_id)
    {
        return $this->db->get_where('product_models', array('model_id' => $model_id))->row_array();
    }

    /**
     * 保存模型
     * @param $data
     * @return mixed
     */
    function save_model($data, $attrs)
    {
        p($attrs);
        $last_id = $this->_save('product_models', 'model_id', $data);
        $model_id = isset($data['model_id']) && $data['model_id'] ? $data['model_id']:$last_id;
        foreach($attrs as $key=>$value)
        {
            $attrs[$key]['model_id'] = $model_id;
        }
        $this->db->where('model_id', $model_id);
        $this->db->delete('product_models_attr');
        $attrs && $this->db->insert_batch('product_models_attr', $attrs);
        /*
        if((! isset($data['model_id']) || ! $data['model_id']) && $last_id) //(没有设置模型id || 模型id为空) && 获得最终插入id
        {
            foreach($attrs as $key=>$value)
            {
                $attrs[$key]['model_id'] = $last_id;
            }
            $this->db->insert_batch('product_models_attr',$attrs);
        }
        else
        {
            $del_id = array();
            foreach($attrs as $value)
            {
                $this->db->where('id', $value['id']);
                $del_id[] = $value['id'];
                unset($value['id']);
                $this->db->update('product_models_attr', $value);
            }

            if ($del_id)
            {
                $this->db->where_not_in('id', $del_id);
                $this->db->delete('product_models_attr');
            }
        }
        */
        return ;
    }

    private function _save($table_name, $primary = 'id', array $data)
    {
        if(isset($data[$primary]) && $data[$primary])
        {
            $this->db->where($primary, $data[$primary]);
            unset($data[$primary]);
            $this->db->update($table_name, $data);
            return $this->db->affected_rows();
        }
        else
        {
            unset($data[$primary]);
            $this->db->insert($table_name, $data);
            return $this->db->insert_id();
        }
    }

    public function get_model_attrs($model_id)
    {
        return $this->db->order_by('sort desc,search desc, display desc')->get_where('wx_product_models_attr', array('model_id' => $model_id))->result_array('attr_id');
    }

    public function get_model_value($model_id = 0, $attr_id = 0)
    {
        $where = array();
        $model_id && $where['model_id'] = $model_id;
        $attr_id && $where['attr_id'] = $attr_id;
        return $this->db->get_where('product_models_value', $where)->result_array('value_id');

    }

    public function get_model_detail($model_id)
    {
        $attrs = $this->get_model_attrs($model_id);
        $values = $this->get_model_value($model_id, $attr_id = 0);
        //p($attrs);p($values);
        foreach($values as $value)
        {
            if(isset($attrs[$value['attr_id']]))
            {
                $attrs[$value['attr_id']]['attrs'][$value['value_id']] = $value;
            }
        }
        foreach($attrs as $key => $attr)
        {
            !isset($attr['attrs']) && $attrs[$key]['attrs'] = array();
        }
        return $attrs;
    }

    function get_attr_by_pid($pid, $field="*")
    {
        list($key, $field) = self::formatField($field);
        $data = $this->db
            ->select($field)
            ->get_where('product_attrs', array('pid'=>$pid))
            ->result_array($key);
        return $data;
    }

    function get_pid_by_model_value($model_id, $value_id, $field="*")
    {
        if(! $value_id) return array();
        list($key, $field) = self::formatField($field);
        $this->db->select($field)->from('product_attrs');
        $model_id && $this->db->where(array('model_id'=>$model_id));
        $this->db->where_in('value_id',$value_id);
        return $this->db->get()->result_array($key);
    }
}
