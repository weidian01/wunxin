<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Product_Comment extends MY_Model
{
    /**
     * @name 获取产品评论 -- 通过用户ID
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getCommentByUid($uId, $limit = 20, $offset = 0)
    {
        return $this->db->get_where('product_comment', array('uid' => $uId), $limit, $offset)->result_array();
    }

    /**
     * 获取用户产品评论数量
     *
     * @param $uId
     * @return int
     */
    public function getCommentCountByuId($uId)
    {
        $this->db->from('product_comment');
        $this->db->where(array('uid' => $uId));
        return $this->db->count_all_results();
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
    public function addProductComment(array $cInfo)
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
     * 评论是否有效
     *
     * @param $commentId
     * @param bool $type true 有效， false 无效
     * @return boolean
     */
    public function productCommentIsValid($commentId, $type = true)
    {
        $field = $type ? 'is_valid' : 'is_invalid';
        $data = array($field => $field . '+1');

        $this->db->where('comment_id', $commentId);
        return $this->db->set($data, '', false)->update('product_comment');
    }

    /**
     * 删除产品评论 -- 通过评论ID
     * @param $cId
     * @return bool
     */
    public function deleteProductCommentByCommentId($cId)
    {
        $this->db->delete('product_reply', array('comment_id' => $cId));

        $this->db->delete('product_comment', array('comment_id' => $cId));

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
        return $this->db->set($data, '', false)->update('product_comment');
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
    public function addProductCommentReply(array $rInfo)
    {
        $data = array(
            'comment_id' => $rInfo['comment_id'],
            'uid' => $rInfo['uid'],
            'uname' => $rInfo['uname'],
            'ip' => $rInfo['ip'],
            'reply_content' => $rInfo['reply_content'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->updateCommentReplyNum($rInfo['comment_id']);

        $this->db->insert('product_reply', $data);
        return $this->db->insert_id();
    }

    /**
     * 删除一个产品评论回复 -- 通过回复ID
     *
     * @param $rId
     * @return bool
     */
    public function deleteProductCommentReplyByReplyId($rId)
    {
        $this->db->delete('product_reply', array('id' => $rId));

        return true;
    }

    /**
     * 通过产品id获取评论信息
     * @param $pid
     * @param int $limit
     * @param int $offset
     * @param string $field
     * @return mixed
     */
    public function getCommentByPid($pid, $limit = 20, $offset = 0, $field = '*')
    {
        $this->db->select($field);
        $this->db->order_by("comment_id", "desc");
        return $this->db->get_where('product_comment', array('pid' => $pid), $limit, $offset)->result_array();
    }

    /**
     * 通过产品id获取评论数量
     * @param $pid
     * @return mixed
     */
    public function getCommentCountByPid($pid)
    {
        $this->db->from('product_comment');
        $this->db->where(array('pid' => $pid));
        return $this->db->count_all_results();
    }

    public function top($comment_id, $uid, $top = true)
    {
        $this->db->query("INSERT IGNORE INTO wx_product_comment_vote_log (`uid`, `cid`) VALUES ({$uid}, {$comment_id})");
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            $this->db->where('comment_id', $comment_id);
            if ($top) {
                $up = array('is_valid' => 'is_valid+1');
            } else {
                $up = array('is_invalid' => 'is_invalid+1');
            }
            $this->db->set($up, '', false)->update('product_comment');
            return true;
        }
        return false;
    }

    public function getAppraise($pid, $fields = array('rank','comfort', 'exterior'))
    {
        $re = array();
        foreach($fields as $field)
        {
            $sql = "SELECT {$field},COUNT({$field}) AS num FROM wx_product_comment WHERE pid = ? GROUP BY {$field} ORDER BY NULL";
            $query = $this->db->query($sql, array($pid));
            $re[$field] = self::formatAppraise($query->result_array(), $field);
        }
        return $re;
    }

    private static function formatAppraise($data, $name)
    {
        $re = array('star'=>array(5=>0, 4=>0, 3=>0, 2=>0, 1=>0),'point'=>0,'count'=>0);
        foreach ($data as $row) {
            $re['star'][$row[$name]] = $row['num'];
            $re['point'] += $row[$name] * $row['num'];
            $re['count'] += $row['num'];
        }
        return $re;
    }
}