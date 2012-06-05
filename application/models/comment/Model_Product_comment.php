<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Product_comment extends MY_Model
{
    /**
     * @name 获取产品评论 -- 通过用户ID
     *
     * @param $uid
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getCommentByUid($uid, $limit = 20, $offset = 0)
    {
        return $this->db->get_where('product_comment', array('uid' => $uid), $limit, $offset)->array_result();
    }

    /**
     * @name 获取产品评论 -- 通过产品ID
     *
     * @param int $pid
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getProductCommentByPid($pid, $limit = 20, $offset = 0)
    {
        return $this->db->get_where('product_comment', array('uid' => $pid), $limit, $offset)->array_result();
    }

    /**
     * @name 添加产品评论
     *
     * @param array $cInfo
     * @return boolean
     */
    public function addComment(array $cInfo)
    {
        $data = array(
            'pid' => $cInfo['pid'],
            'uid' => $cInfo['uid'],
            'uname' => $cInfo['uname'],
            'comment_title' => $cInfo['comment_title'],
            'comment_content' => $cInfo['comment_content'],
            'ip' => $cInfo['ip'],
            'rank' => $cInfo['rank'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('product_comment', $data);
        return $this->db->insert_id();
    }

    /**
     * @name 获取产品评论回复
     *
     * @param $cid
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getReplyByCommentId($cid, $limit = 20, $offset = 0)
    {
        return $this->db->get_where('product_reply', array('comment_id' => $cid), $limit, $offset)->array_result();
    }

    /**
     * @name 添加产品评论回复
     *
     * @param array $rInfo
     * @return boolean
     */
    public function addReply(array $rInfo)
    {
        $data = array(
            'comment_id' => $rInfo['comment_id'],
            'uid' => $rInfo['uid'],
            'uname' => $rInfo['uname'],
            'ip' => $rInfo['ip'],
            'reply_content' => $rInfo['reply_content'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('product_reply', $data);
        return $this->db->insert_id();
    }
}
