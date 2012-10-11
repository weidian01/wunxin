<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-7-19
 * Time: 下午2:42
 * To change this template use File | Settings | File Templates.
 */
class Model_Help extends MY_Model
{
    /**
     * 获取帮助文章 -- 通过帮助文章ID
     * @param $helpId
     * @return null | array
     */
    public function getHelpById($helpId)
    {
        $data = $this->db->select('*')->from('article')->where('id', $helpId)->get()->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取分类列表
     *
     * @param $cId
     */
    public function getCategoryList($cId)
    {
        $this->db->select('*')->form('article')->where('');
    }

    /**
     * 文章是否有效
     *
     * @param $id
     * @param $type
     * @return mixed
     */
    public function isValid($id, $type)
    {
        $field = $type ? 'is_valid' : 'is_invalid';

        $data = array($field => $field.'+1');
        $this->db->where('id', $id);
        return $this->db->set($data, '', false)->update('article');
    }
}
