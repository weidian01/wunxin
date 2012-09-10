<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午6:44
 * To change this template use File | Settings | File Templates.
 */
class Model_Activity extends MY_Model
{
    /**
     * 添加活动
     *
     * @param $aInfo
     * @return boolean
     */
    public function addActivity(array $aInfo)
    {
        $data = array(
            'subject' => $aInfo['subject'],
            'start_time' => $aInfo['start_time'],
            'end_time' => $aInfo['end_time'],
            'descr' => $aInfo['descr'],
            'event_initiator' => $aInfo['event_initiator'],
            'initiator_name' => $aInfo['initiator_name'],
            'initiator_desc' => $aInfo['initiator_desc'],
            'specification' => $aInfo['specification'],
            'status' => $aInfo['status'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('activity', $data);
        return $this->db->insert_id();
    }

    /**
     * 编辑活动
     *
     * @param $aId
     * @param array $aInfo
     */
    public function editActivity(array $aInfo, $aId)
    {
        $data = array(
            'subject' => $aInfo['subject'],
            'start_time' => $aInfo['start_time'],
            'end_time' => $aInfo['end_time'],
            'descr' => $aInfo['descr'],
            'event_initiator' => $aInfo['event_initiator'],
            'initiator_name' => $aInfo['initiator_name'],
            'initiator_desc' => $aInfo['initiator_desc'],
            'specification' => $aInfo['specification'],
            'status' => $aInfo['status'],
        );

        $this->db->where('activity_id', $aId);
        return $this->db->update('activity', $data);
    }

    /**
     * 删除活动
     *
     * @param $aId
     * @return boolean
     */
    public function deleteActivity($aId)
    {
        $data = array(
            'status' => 0,
        );

        $this->db->where('activity_id', $aId);
        return $this->db->update('activity', $data);
    }

    /**
     * 获取活动信息
     *
     * @param $aId
     * @return bool | array
     */
    public function getActivityById($aId)
    {
        $data = $this->db->select('*')->get_where('activity', array('activity_id' => $aId))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取活动列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getActivityList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('activity');
        $this->db->limit($limit, $offset);
        //$this->db->where('status', '1');
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取活动数量
     *
     * @return int
     */
    public function getActivityCount()
    {
        $this->db->select('*')->from('activity');//->where('status', '1');

        return $this->db->count_all_results();
    }
}
