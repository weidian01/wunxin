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
     * @name 获取设计图评论 -- 通过用户ID
     *
     * @param $uid
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getCommentByUid($uid, $limit = 20, $offset = 0)
    {
        $data = $this->db->get_where('design_comment', array('uid' => $uid), $limit, $offset)->array_result();

        return empty ($data) ? null : $data;
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
        $data = $this->db->get_where('design_comment', array('did' => $did), $limit, $offset)->array_result();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取评论 -- 通过评论ID
     *
     * @param $cid
     * @return null | array
     */
    public function getDesignCommentByCid($cid)
    {
        $data = $this->db->get_where('design_comment', array('comment_id' => $cid))->array_result();

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
        return $this->db->insert_id();
    }

    /**
     * 删除设计图评论 -- 通过评论ID
     * @param $cId
     * @return bool
     */
    public function deleteDesignCommentByCommentId($cId)
    {
        $this->db->delete('design_comment', array('comment_id' => $cId));

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
        $data = $this->db->get_where('design_comment_reply', array('comment_id' => $cid), $limit, $offset)->array_result();

        return empty ($data) ? null : $data;
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
            'ip' => $rInfo['ip'],
            'content' => $rInfo['content'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->updateCommentReplyNum($rInfo['comment_id']);

        $this->db->insert('design_comment_reply', $data);
        return $this->db->insert_id();
    }

    /**
     * 删除一个产品评论回复 -- 通过回复ID
     *
     * @param $rId
     * @return bool
     */
    public function deleteDesignCommentReplyByReplyId($rId)
    {
        $this->db->delete('design_comment_reply', array('id' => $rId));

        return true;
    }
}
