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
        $cardPassword = md5($cardPassword);

        $data = $this->db->select('*')->get_where('card', array('card_no' => $cardNo, 'card_pass' => $cardPassword))->row_array();

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
        $data = $this->db->select('*')->get_where('card', array('card_no' => $cardNo, 'status' => 1))->row_array();

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
        $data = $this->db->select('*')->get_where('card', array('uid' => $cardNo, 'status' => 1))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户卡信息
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserCardInfoByCardNoAndUid($uId, $limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->get_where('card', array('uid' => $uId, 'status' => 1), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户卡数量
     *
     * @param $uId
     * @return int
     */
    public function getUserCardInfoByCardNoAndUidCount($uId)
    {
        return $this->db->select('*')->from('card')->where('uid', $uId)->where('status', 1)->count_all_results();
    }

    public function getUserCardInfoAndModel($uId, $limit = 20, $offset = 0)
    {
        $field = 'id, card_no, card.model_id, card.card_amount, card_pass, start_time, end_time, integral, uid, uname, use_num, status, card.create_time,
        card_name, card_type, card_num';

        $this->db->select($field);
        $this->db->from('card');
        $this->db->join('card_model', 'card.model_id = card_model.model_id', 'left');
        $this->db->where('card.uid', $uId);
        $this->db->where('status', 2);
        $this->db->order_by('card.create_time', 'desc');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

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
     * 获取信息卡列表
     *
     * @param $cardNo
     * @param $uId
     * @return null | array
     */
    public function getUserCardInfo($cardNo, $uId)
    {
        $data = $this->db->select('*')->get_where('card', array('uid' => $cardNo, 'uid' => $uId, 'status' => 1))->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 删除卡
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
     * 卡使用
     *
     * @param $cardNo
     */
    public function cardUse($cardNo)
    {

    }
}
