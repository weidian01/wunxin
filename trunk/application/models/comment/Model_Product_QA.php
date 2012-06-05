<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Product_QA extends MY_Model
{
    /**
     * 添加产品疑难问答
     *
     * @param array $qInfo
     * @return boolean
     */
    public function addProductQA(array $qInfo)
    {
        $data = array(
            'pid' => $qInfo['pid'],
            'uid' => $qInfo['uid'],
            'uname' => $qInfo['uname'],
            'qa_title' => $qInfo['qa_title'],
            'qa_content' => $qInfo['qa_content'],
            'ip' => $qInfo['ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('product_comment', $data);
        return $this->db->insert_id();
    }

    /**
     * 疑难问答管理员回复
     *
     * @param int $qaId
     * @param array $rInfo
     * @return boolean
     */
    public function addProductQaAdminReply($qaId, array $rInfo)
    {
        $data = array(
            'reply_content' => $rInfo['content'],
            'reply_time' => date('Y-m-d H:i:s', TIMESTAMP),
            'is_reply' => 1
        );

        $this->db->where('qa_id', $qaId);
        return $this->db->set($data, '', false)->update('product_qa');
    }

    /**
     * 获取产品疑难问答 -- 通过产品ID
     *
     * @param int $pid
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getProductQAByPid($pid, $limit = 20, $offset = 0)
    {
        return $this->db->select('*')->get_where('product_qa', array('pid' => $pid), $limit, $offset)->result_array();
    }

    /**
     * 获取产品疑难问答 -- 通过用户ID
     *
     * @param int $uid
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getProductQAByUid($uid, $limit = 20, $offset = 0)
    {
        return $this->db->select('*')->get_where('product_qa', array('uid' => $uid), $limit, $offset)->result_array();
    }

    /**
     * 疑难问答是否有效
     *
     * @param $qaId
     * @param bool $type true 有效， false 无效
     * @return boolean
     */
    public function productQAIsValid($qaId, $type = true)
    {
        $field = $type ? 'is_valid' : 'is_invalid';
        $data = array($field => $field . '+1');

        $this->db->where('qa_id', $qaId);
        return $this->db->set($data, '', false)->update('product_qa');
    }

    /**
     * 更新疑难问答回复数量
     *
     * @param int $qaId
     * @return array
     */
    public function updateQAReplyNum($qaId)
    {
        $data = array('reply_num' => 'reply_num+1');
        $this->db->where('qa_id', $qaId);
        return $this->db->set($data, '', false)->update('product_qa');
    }

    /**
     * 删除产品疑难问答 -- 通过疑难问答ID
     * @param $qaId
     * @return bool
     */
    public function deleteProductQAByQAId($qaId)
    {
        $this->db->delete('product_qa_reply', array('qa_id' => $qaId));

        $this->db->delete('product_qa', array('qa_id' => $qaId));

        return true;
    }

    /**
     * @name 添加产品疑难问答回复
     *
     * @param array $rInfo
     * @return boolean
     */
    public function addProductQAReply(array $rInfo)
    {
        $data = array(
            'qa_id' => $rInfo['qa_id'],
            'uid' => $rInfo['uid'],
            'uname' => $rInfo['uname'],
            'ip' => $rInfo['ip'],
            'reply_content' => $rInfo['reply_content'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('product_qa_reply', $data);
        return $this->db->insert_id();
    }

    /**
     * 删除一个产品疑难问答回复 -- 通过回复ID
     *
     * @param $rId
     * @return bool
     */
    public function deleteProductCommentReplyByReplyId($rId)
    {
        $this->db->delete('product_qa_reply', array('id' => $rId));

        return true;
    }


}
