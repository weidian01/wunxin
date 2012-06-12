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
    public function editActivity($aId, array $aInfo)
    {
        $data = array(
            'subject' => $aInfo['subject'],
            'start_time' => $aInfo['start_time'],
            'end_time' => $aInfo['end_time'],
            'descr' => $aInfo['descr'],
            'specification' => $aInfo['specification'],
        );

        $this->db->where('activity_id', $aId);
        $this->db->update('activity', $data);
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
        $data = $this->db->select('*')->get_where('activity', array('activity_id' => $aId, 'status' => 1))->row_array();

        return empty ($data) ? false : true;
    }

    /**
     * 获取活动奖品 -- 通过活动ID
     *
     * @param $aId
     * @return bool | array
     */
    public function getActivityPrizeByActivityId($aId)
    {
        $data = $this->db->select('*')->get_where('activity_prize', array('activity_id' => $aId))->result_array();

        return empty ($data) ? false : true;
    }

    /**
     * 获取活动评论
     *
     * @param $aId
     * @return bool  | array
     */
    public function getActivityCommentByActivityId($aId)
    {
        $data = $this->db->select('*')->get_where('activity_comment', array('activity_id' => $aId))->result_array();

        return empty ($data) ? false : true;
    }
}
