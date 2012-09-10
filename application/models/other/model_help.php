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


    public function getCategoryList($cId)
    {
        $this->db->select('*')->form('article')->where('');
    }
}
