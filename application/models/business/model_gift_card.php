<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-25
 * Time: 下午4:33
 * To change this template use File | Settings | File Templates.
 */
class Model_Gift_Card extends MY_Model
{
    /**
     * 用户绑定卡
     *
     * @param $cardNo
     * @param array $cInfo
     * @return boolean
     */
    public function cardBinding($cardNo, array $cInfo)
    {
        $data = array(
            'uid' => $cInfo['uid'],
            'uname' => $cInfo['uname'],
            'status' => 2
        );

        $this->db->where('card_no', $cardNo);
        return $this->db->update('card', $data);
    }

    /**
     * 验证卡密码
     *
     * @param $cardNo
     * @param $cardPassword
     * @return bool
     */
    public function cardVerify($cardNo, $cardPassword)
    {
        //$cardPassword = md5($cardPassword);

        $data = $this->db->select('*')->get_where('card', array('card_no' => $cardNo, 'card_pass' => $cardPassword, 'status' => 2))->row_array();

        return empty ($data) ? false : true;
    }

    /**
     * 卡是否绑定
     *
     * @param $cardNo
     * @return bool
     */
    public function cardIsBanding($cardNo)
    {
        $data = $this->db->select('*')->get_where('card', array('card_no' => $cardNo, 'status' => 2))->row_array();

        return empty ($data) ? false : true;
    }

    /**
     * 获取卡信息
     *
     * @param $cardNo
     * @return bool | array
     */
    public function getCardInfoByCid($cardNo)
    {
        $data = $this->db->select('*')->get_where('card', array('card_no' => $cardNo))->row_array();

        return $data;
    }

    /**
     * 获取用户卡信息
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @param null $where
     * @param null $order
     * @return mixed
     */
    public function getUserCard($uId, $limit = 20, $offset = 0, $where = null, $order = null)
    {
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $data = $this->db->select('*')->get_where('card', array('uid' => $uId, 'status' => 2), $limit, $offset)->result_array();

        return $data;
    }

    /**
     * 获取用户卡数量
     *
     * @param $uId
     * @return int
     */
    public function getUserCardInfoByCardNoAndUidCount($uId)
    {
        return $this->db->select('*')->from('card')->where('uid', $uId)->where('status', 2)->count_all_results();
    }

    /**
     * 获取卡数量
     * @param null $where
     * @return int
     */
    public function getCardCount($where = null)
    {
        $this->db->from('card');
        $where && $this->db->where($where);
        return $this->db->count_all_results();
    }

    /**
     * 获取卡信息 -- 通过卡模型ID
     *
     * @param $mId
     * @return mixed
     */
    public function getCardByMId($mId)
    {
        return $this->db->select('*')->from('card')->where('model_id', $mId)->get()->result_array();
    }

    /**
     * 领取卡
     *
     * @param $modelId
     */
    public function receiveCard($modelId)
    {
        $data = array(
           'is_receive' => '1',
        );

        $where = array(
            'is_receive' => '0',
            'status' => '1'
        );

        $this->db->where('model_id', $modelId);
        $this->db->where($where);
        $this->db->limit(1);
        $this->db->update('card', $data);

        if ($this->db->affected_rows()) {
            $this->db->select('*')->from('card')->where(array('model_id' => $modelId, 'is_receive' => '1'));
            return $this->db->order_by('id', 'desc')->limit(1)->get()->row_array();
        }
    }

    /**
     * 获取卡数量 -- 通过卡模型ID
     *
     * @param $mId
     * @return mixed
     */
    public function getCardCountByMId($mId)
    {
        return $this->db->select('*')->from('card')->where('model_id', $mId)->count_all_results();
    }

    /**
     * 获取卡列表
     *
     * @param int $limit
     * @param int $offset
     * @param string $field
     * @param int $where
     * @param $order
     * @return null | array
     */
    public function getCardList($limit = 20, $offset = 0, $field= '*', $where = null, $order = null)
    {
        list($key, $field) = self::formatField($field);
        $this->db->select($field);
        $this->db->from('card');
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $this->db->limit($limit, $offset);
        //$this->db->group_by('style_no');
        $data = $this->db->get()->result_array($key);
        return $data;
        //return $data;
    }

    /**
     * 获取用户的卡和卡模型信息
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null
     */
    public function getUserCardInfoAndModel($uId, $limit = 20, $offset = 0)
    {
        $field = 'id, card_no, card.model_id, card.card_amount, card_pass, end_time, integral, uid, uname, use_num, status, card.create_time,
        card_name, card_type, card_num';

        $this->db->select($field);
        $this->db->from('card');
        $this->db->join('card_model', 'card.model_id = card_model.model_id', 'left');
        $this->db->where('card.uid', $uId);
        $this->db->where('status', 2);
        $this->db->order_by('card.create_time', 'desc');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return $data;
    }

    /**
     * 获取用户的卡和卡模型信息数量
     *
     * @param $uId
     * @return mixed
     */
    public function getUserCardInfoAndModelCount($uId)
    {
        $this->db->select('*');
        $this->db->from('card');
        $this->db->join('card_model', 'card.model_id = card_model.model_id', 'left');
        $this->db->where('card.uid', $uId);
        $this->db->where('status', 2);

        return $this->db->count_all_results();
    }

    /**
     * 获取用户卡信息 -- 通过卡号
     *
     * @param $cardNo
     * @param $uId
     * @return null | array
     */
    public function getUserCardInfo($cardNo, $uId)
    {
        $data = $this->db->select('*')->get_where('card', array('uid' => $cardNo, 'uid' => $uId, 'status' => 2))->result_array();

        return $data;
    }

    /**
     * 删除卡
     *
     * @param $uId
     * @param $cardNo
     * @return boolean
     */
    public function deleteCardByCardNo($cardNo, $uId)
    {
        $data = array( 'status' => 0 );
        $this->db->where('card_no', $cardNo);
        $this->db->where('uid', $uId);

        return $this->db->update('card', $data);
    }

    /**
     * 删除卡
     *
     * @param array $where
     * @return mixed
     */
    public function deleteCard(array $where)
    {
        $data = array( 'status' => 0 );
        $this->db->where($where);

        return $this->db->update('card', $data);
    }

    /**
     * 卡使用
     *
     * @param $cardNo
     * @param $uId
     * @param $amount
     */
    public function useCard($cardNo, $uId, $amount)
    {
        $amount = (int)$amount;

        $this->db->where('card_no', $cardNo);
        $this->db->where('uid', $uId);
        $this->db->where('status', '2');
        $this->db->where('end_time >=', date('Y-m-d H:i:s', TIMESTAMP));

        $data = array(
            ''
        );
        return $this->db->update('card', $data);
    }

    /**
     * 添加卡
     *
     * @param array $data
     * @return mixed
     */
    public function addCard(array $data)
    {
        $info = array(
            'card_no' => $data['card_no'],
            'model_id' => $data['model_id'],
            'card_amount' => $data['card_amount'],
            'card_pass' => $data['card_pass'],
            'integral' => $data['integral'],
            'use_num' => '0',
            'status' => '1',
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('card', $info);
        return $this->db->insert_id();
    }
}
