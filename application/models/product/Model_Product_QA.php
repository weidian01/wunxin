<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
            'title' => $qInfo['title'],
            'content' => $qInfo['content'],
            'ip' => $qInfo['ip'],
            'qa_type' => $qInfo['qa_type'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('product_qa', $data);
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
     * @param string $fields
     * @param string $order
     * @return array
     */
    public function getProductQAByPid($pid, $limit = 20, $offset = 0, $fields = '*', $order = null)
    {
        list($key, $fields) = self::formatField($fields);
        $this->db->select($fields);
        $order && $this->db->order_by($order);
        return $this->db->get_where('product_qa', array('pid' => $pid), $limit, $offset)->result_array($key);
    }

    /**
     * 获取用户对产品疑难问答
     *
     * @param int $uId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getProductQAByUid($uId, $limit = 20, $offset = 0)
    {
        return $this->db->select('*')->get_where('product_qa', array('uid' => $uId), $limit, $offset)->result_array();
    }

    /**
     * 获取用户对产品疑难问答数量
     *
     * @param $uId
     * @return int
     */
    public function getProductQaCountByuId($uId)
    {
        $this->db->select('*')->from('product_qa')->where('uid', $uId);

        return $this->db->count_all_results();
    }

    /**
     * 获取产品提问数量
     *
     * @param $pId
     * @return int
     */
    public function getProductQaCount($pId)
    {
        $this->db->select('*')->from('product_qa')->where('pid', $pId);

        return $this->db->count_all_results();
    }

    /**
     * 获取用户对某个产品的疑难问答
     *
     * @param $uId
     * @param $pId
     * @return null | array
     */
    public function getUserProductQa($uId, $pId)
    {
        $data = $this->db->select('*')->get_where('product_qa', array('uid' => $uId, 'pid' =>$pId))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户产品问答
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserProductQaAndProduct($uId, $limit = 20, $offset = 0)
    {
        $field = 'qa_id, product_qa.pid, product_qa.uid, product_qa.uname, title, content, reply_content, ip, reply_time, is_reply, is_valid, is_invalid, reply_num, product_qa.create_time,
        did, class_id, color_id, model_id, brand_id, pname, market_price, sell_price, style_no, stock, warehouse, product_taobao_addr, keyword, descr, pcontent, source,
        expand, gender, size_type, status, check_status, shelves, cost_price, sales, favorite_num';

        $this->db->select($field);
        $this->db->from('product_qa');
        $this->db->join('product', 'product_qa.pid = product.pid', 'left');
        $this->db->where('product_qa.uid', $uId);
        $this->db->order_by('product_qa.create_time', 'desc');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户产品问答数量
     *
     * @param $uId
     * @return int
     */
    public function getUserProductQaAndProductCount($uId)
    {
        $this->db->select('*');
        $this->db->from('product_qa');
        $this->db->join('product', 'product_qa.pid = product.pid', 'left');
        $this->db->where('product_qa.uid', $uId);

        return $this->db->count_all_results();
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
        $data = array($field => $field.'+1');

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
     * @param $uId
     * @return bool
     */
    public function deleteProductQAByQAId($qaId, $uId)
    {
        $this->db->delete('product_qa_reply', array('qa_id' => $qaId, 'uid' => $uId));

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

        $this->updateQAReplyNum($rInfo['qa_id']);

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
