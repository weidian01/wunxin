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
     * 编辑设计图
     *
     * @param array $dInfo
     * @param int $dId
     * @return boolean
     */
    public function editDesign(array $dInfo, $dId)
    {
        /*
        $data = array(
            'class_id' => $dInfo['class_id'],
            'dname' => $dInfo['dname'],
            'ddetail' => $dInfo['ddetail'],
            'design_img' => $dInfo['design_img'],
            'source_expand' => $dInfo['source_expand'],
            'status' => 1,
            'vote_end_time' => $dInfo['vote_end_time'],
        );
        //*/

        $this->db->where('did', $dId);
        return $this->db->update('design', $dInfo);
    }

    public function updateDesignImage($imgPath, $dId)
    {
        $data = array(
            'design_img' => $imgPath,
        );

        $this->db->where('did', $dId);
        return $this->db->update('design', $data);
    }

    /**
     * 添加设计图
     *
     * @param array $dInfo
     * @return boolean
     */
    public function addDesign(array $dInfo)
    {
        $data = array(
            'class_id' => $dInfo['class_id'],
            'dname' => $dInfo['dname'],
            'ddetail' => $dInfo['ddetail'],
            'design_img' => $dInfo['design_img'],
            'source_expand' => $dInfo['source_expand'],
            'status' => 1,
            'vote_end_time' => $dInfo['vote_end_time'],
            'uid' => $dInfo['uid'],
            'uname' => $dInfo['uname'],
            'design_source' => $dInfo['design_source'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('design', $data);
        return $this->db->insert_id();
    }

    /**
     * 获取设计图 -- 通过设计图ID
     *
     * @param $dId
     * @return array
     */
    public function getDesignByDid($dId)
    {
        $data = $this->db->select('*')->get_where('design', array('did' => $dId, 'status' => 1))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户设计图
     *
     * @param $uId
     * @param $limit
     * @param $offset
     * @return null || array
     */
    public function getDesignByUid($uId, $limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->order_by('create_time', 'desc')->get_where('design', array('uid' => $uId, 'status' => 1), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户设计图数量
     *
     * @param $uId
     * @return int
     */
    public function getUserDesignCount($uId)
    {
        $this->db->from('design');
        $this->db->where('uid', $uId);
        $this->db->where('status', 1);
        return $this->db->count_all_results();
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
        return $this->db->select('*')->get_where('design', array('status' => 1), $limit, $offset)->result_array();
    }

    /**获取设计数量
     *
     * @return int
     */
    public function getDesignCount()
    {
        $this->db->from('design');
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }

    /**
     * 删除设计图 -- 通过设计图ID
     *
     * @param $dId
     * @return boolean
     */
    public function deleteDesignByDid($dId)
    {
        $this->db->where('did', $dId);
        return $this->db->update('design', array('status' => 0));
    }

    /**
     * 物理删除设计图
     *
     * @param $dId
     * @param $uId
     * @return boolean
     */
    public function deleteDesign($dId, $uId)
    {
        $this->db->where('did', $dId);
        $this->db->where('uid', $uId);

        return $this->db->delete('design');
    }
}
