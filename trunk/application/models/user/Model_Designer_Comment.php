<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Designer_Comment extends MY_Model
{
    /**
     * @name 获取设计师留言 -- 通过设计师ID
     *
     * @param int $designerId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getDesignerByUid($designerId, $limit = 20, $offset = 0)
    {
        return $this->db->get_where('user_message', array('designer_id' => $designerId), $limit, $offset)->array_result();
    }

    /**
     * @name 获取用户留言 -- 通过用户ID
     *
     * @param int $uid
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getDesignerCommentByUid($uid, $limit = 20, $offset = 0)
    {
        return $this->db->get_where('user_message', array('uid' => $uid), $limit, $offset)->array_result();
    }

    /**
     * @name 添加产品留言
     *
     * @param array $cInfo
     * @return boolean
     */
    public function addDesignerComment(array $cInfo)
    {
        $data = array(
            'designer_id' => $cInfo['designer_id'],
            'uid' => $cInfo['uid'],
            'uname' => $cInfo['uname'],
            'content' => $cInfo['comment_title'],
            'ip' => $cInfo['ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('user_message', $data);
        return $this->db->insert_id();
    }

    /**
     * 评论信息是否存在
     *
     * @param $mId
     * @return bool
     */
    public function designerCommentIsExist($mId)
    {
        $data = $this->db->get_where('user_message', array('message_id' => $mId))->row_result();

        return empty ($data) ? false : true;
    }


    /**
     * 删除产品留言 -- 通过留言ID
     * @param $cId
     * @return bool
     */
    public function deleteDesignerCommentByCommentId($cId)
    {
        $this->db->delete('user_message', array('message_id' => $cId));

        $this->db->delete('user_message_reply', array('message_id' => $cId));

        return true;
    }

    /**
     * 更新留言回复数量
     *
     * @param int $commentId
     * @return array
     */
    public function updateCommentReplyNum($commentId)
    {
        $data = array('reply_num' => 'reply_num+1');
        $this->db->where('message_id', $commentId);
        return $this->db->set($data, '', false)->update('user_message');
    }

    /**
     * @name 获取设计师留言回复
     *
     * @param $cid
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getReplyByCommentId($cid, $limit = 20, $offset = 0)
    {
        return $this->db->get_where('user_message_reply', array('message_id' => $cid), $limit, $offset)->array_result();
    }


    /**
     * @name 添加设计师留言回复
     *
     * @param array $rInfo
     * @return boolean
     */
    public function addProductCommentReply(array $rInfo)
    {
        $data = array(
            'message_id' => $rInfo['message_id'],
            'uid' => $rInfo['uid'],
            'uname' => $rInfo['uname'],
            'ip' => $rInfo['ip'],
            'content' => $rInfo['content'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->updateCommentReplyNum($rInfo['message_id']);

        $this->db->insert('product_reply', $data);
        return $this->db->insert_id();
    }

    /**
     * 删除一个设计师留言回复 -- 通过回复ID
     *
     * @param $rId
     * @return bool
     */
    public function deleteProductCommentReplyByReplyId($rId)
    {
        $this->db->delete('product_reply', array('id' => $rId));

        return true;
    }
}
