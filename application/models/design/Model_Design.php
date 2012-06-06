<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午6:19
 * To change this template use File | Settings | File Templates.
 */
class Model_Design extends MY_Model
{
    /**
     * 获取设计图 -- 通过设计图ID
     *
     * @param $dId
     * @return array
     */
    public function getDesignByDid($dId)
    {
        return $this->db->select('*')->get_where('design', array('did' => $dId))->row_array();
    }

    /**
     * 获取设计图列表
     *
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function getDesignList($limit = 20, $offset = 0)
    {
        return $this->db->select('*')->get_where('design', '', $limit, $offset)->result_array();
    }


    public function deleteDesignByDid($dId)
    {

    }

    public function modifyDesignByDid($dId, $dInfo)
    {

    }

}
