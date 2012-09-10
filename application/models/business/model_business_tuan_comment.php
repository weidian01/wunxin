<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-27
 * Time: 上午11:25
 * To change this template use File | Settings | File Templates.
 */
class Model_Business_Tuan_Comment extends MY_Model
{
    /**
     * 添加团购评论
     *
     * @param array $data
     * @return boolean
     */
    public function addComment(array $data)
    {
        $info = array(
            'tuan_id' => $data['tuan_id'],
            'uid' => $data['uid'],
            'uname' => $data['uname'],
            'title' => $data['title'],
            'content' => $data['content'],
            'status' => $data['status'],
            'is_valid' => $data['is_valid'],
            'is_invalid' => $data['is_invalid'],
            'ip' => $data['ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('tuan_comment', $info);
        return $this->db->insert_id();
    }

    /**
     * 获取评论 -- 通过评论ID
     *
     * @param $cId
     * @return null | array
     */
    public function getCommentBycId($cId)
    {
        $data = $this->db->select('*')->get_where('tuan_comment', array('id' => $cId))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取团购评论列表
     *
     * @param $tId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getTuanCommentBytId($tId, $limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->get_where('tuan_comment', array('tuan_id' => $tId), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取团购评论数量
     *
     * @param $tId
     * @return int
     */
    public function getTuanCommentCount($tId)
    {
        $this->db->select('*')->from('tuan_comment')->where('tuan_id', $tId);

        return $this->db->count_all_results();
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
        $this->db->from('tuan_comment');
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
        $this->db->select('*')->from('tuan_comment');

        return $this->db->count_all_results();
    }

    /**
     * 删除评论信息 -- 通过评论ID
     *
     * @param $cId
     * @return boolean
     */
    public function deleteCommentBycId($cId)
    {
        return $this->db->delete('tuan_comment', array('id' => $cId));
    }

    /**
     * 删除团购评论信息 -- 通过团购ID
     *
     * @param $tId
     * @return boolean
     */
    public function deleteCommentBytId($tId)
    {
        return $this->db->delete('tuan_comment', array('tuan_id' => $tId));
    }
}
