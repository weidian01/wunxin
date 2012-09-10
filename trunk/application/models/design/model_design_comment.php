<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Design_Comment extends MY_Model
{
    /**
     * 获取设计图评论列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getCommentList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('design_comment');
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
        $this->db->from('design_comment');
        return $this->db->count_all_results();
    }

    /**
     * @name 获取设计图评论 -- 通过用户ID
     *
     * @param $uid
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getCommentByUid($uid, $limit = 20, $offset = 0)
    {
        $data = $this->db->get_where('design_comment', array('uid' => $uid), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户评论数量 -- 通过用户ID
     *
     * @param $uId
     * @return int
     */
    public function getUserCommentCount($uId)
    {
        $this->db->from('design_comment');
        $this->db->where('uid', $uId);
        return $this->db->count_all_results();
    }

    /**
     * 获取用户设计图评论和设计图
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserCommentAndDesign($uId, $limit = 20, $offset = 0)
    {
        $field = 'comment_id, design_comment.did, design_comment.uid, design_comment.uname, title, content, ip, reply_num, design_comment.create_time,
        class_id, dname, ddetail, design_img, design_source, source_expand, status, vote_end_time, total_num, total_fraction, favorite_num';

        $this->db->select($field);
        $this->db->from('design_comment');
        $this->db->join('design', 'design_comment.did = design.did', 'left');
        $this->db->where('design_comment.uid', $uId);
        $this->db->order_by('design_comment.create_time', 'desc');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户设计图评论和设计图数量
     *
     * @param $uId
     * @return int
     */
    public function getUserCommentAndDesignCount($uId)
    {
        $this->db->select('*');
        $this->db->from('design_comment');
        $this->db->join('design', 'design_comment.did = design.did', 'left');
        $this->db->where('design_comment.uid', $uId);

        return $this->db->count_all_results();
    }

    /**
     * @name 获取设计图评论 -- 通过设计图ID
     *
     * @param int $did
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getDesignCommentByDid($did, $limit = 20, $offset = 0)
    {
        $data = $this->db->get_where('design_comment', array('did' => $did), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取设计图评论数量
     *
     * @param $dId
     * @return int
     */
    public function getDesignCommentCount($dId)
    {
        $this->db->from('design_comment');
        $this->db->where('did', $dId);
        return $this->db->count_all_results();
    }

    /**
     * 获取评论 -- 通过评论ID
     *
     * @param $cid
     * @return null | array
     */
    public function getDesignCommentByCid($cid)
    {
        $data = $this->db->get_where('design_comment', array('comment_id' => $cid))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * @name 添加设计图评论
     *
     * @param array $cInfo
     * @return boolean
     */
    public function addDesignComment(array $cInfo)
    {
        $data = array(
            'did' => $cInfo['did'],
            'uid' => $cInfo['uid'],
            'uname' => $cInfo['uname'],
            'title' => $cInfo['title'],
            'content' => $cInfo['content'],
            'ip' => $cInfo['ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('design_comment', $data);
        $lastId = $this->db->insert_id();
        if ($lastId) {
            $this->db->where('did', $cInfo['did']);
            $this->db->set('comment_num', 'comment_num+1', false);
            $this->db->update('design');
        }

        return $lastId;
    }

    /**
     * 删除设计图评论 -- 通过评论ID
     *
     * @param $cId
     * @param $uId
     * @return bool
     */
    public function deleteDesignCommentByCommentId($cId, $uId)
    {
        $this->db->delete('design_comment', array('comment_id' => $cId, 'uid' => $uId));

        $this->db->delete('design_comment_reply', array('comment_id' => $cId));

        return true;
    }

    /**
     * 更新评论回复数量
     *
     * @param int $commentId
     * @return array
     */
    public function updateCommentReplyNum($commentId)
    {
        $data = array('reply_num' => 'reply_num+1');
        $this->db->where('comment_id', $commentId);
        return $this->db->set($data, '', false)->update('design_comment');
    }

    /**
     * @name 获取设计图评论回复
     *
     * @param $cid
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getReplyByCommentId($cid, $limit = 20, $offset = 0)
    {
        $data = $this->db->get_where('design_comment_reply', array('comment_id' => $cid), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    public function getReplyCommentCount($cId)
    {
        $this->db->from('design_comment_reply');
        $this->db->where('comment_id', $cId);
        return $this->db->count_all_results();
    }

    /**
     * @name 添加设计图评论回复
     *
     * @param array $rInfo
     * @return boolean
     */
    public function addDesignCommentReply(array $rInfo)
    {
        $data = array(
            'comment_id' => $rInfo['comment_id'],
            'uid' => $rInfo['uid'],
            'uname' => $rInfo['uname'],
            'content' => $rInfo['content'],
            'ip' => $rInfo['ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );
        $this->db->insert('design_comment_reply', $data);
        $lastId = $this->db->insert_id();

        if ($lastId) {
            $this->updateCommentReplyNum($rInfo['comment_id']);
        }
        return $lastId;
    }

    /**
     * 删除一个产品评论回复 -- 通过回复ID
     *
     * @param $rId
     * @param $uId
     * @return bool
     */
    public function deleteDesignCommentReplyByReplyId($rId)
    {
        return $this->db->delete('design_comment_reply', array('id' => $rId));
    }
}
