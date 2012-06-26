<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-26
 * Time: 下午3:54
 * To change this template use File | Settings | File Templates.
 */
class Model_Activity_Comment extends MY_Model
{
    /**
     * 添加评论
     *
     * @param array $data
     * @return boolean
     */
    public function commentAdd(array $data)
    {
        $info = array(
            'activity_id' => $data['activity_id'],
            'uid' => $data['uid'],
            'title' => $data['title'],
            'content' => $data['content'],
            'ip' => $data['ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('activity_comment', $data);
        return $this->db->insert_id();
    }

    /**
     * 获取评论列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getCommentList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('activity_comment');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取评论数量
     *
     * @return int
     */
    public function getCommentCount()
    {
        $this->db->select('*')->from('activity_comment');

        return $this->db->count_all_results();
    }

    /**
     * 获取活动评论列表
     *
     * @param $activityId
     * @param int $limit
     * @param int $offset
     * @return null || array
     */
    public function getActivityCommentList($activityId, $limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('activity_comment');
        $this->db->where('activity_id', $activityId);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取活动评论数量
     *
     * @param $activityId
     * @return int
     */
    public function getActivityCommentCount($activityId)
    {
        $this->db->select('*')->from('activity_comment')->where('activity_id', $activityId);

        return $this->db->count_all_results();
    }

    /**
     * 删除评论
     *
     * @param $cId
     */
    public function deleteComment($cId)
    {
        return $this->db->delete('activity_comment', array('id' => $cId));
    }
}
