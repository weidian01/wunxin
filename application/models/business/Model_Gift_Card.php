<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午9:36
 * To change this template use File | Settings | File Templates.
 */
class Model_Gift_Card extends MY_Controller
{
    /**
     * 添加卡模型
     *
     * @param array $info
     * @return boolean
     */
    public function addCardModel(array $info)
    {
        $data = array(
            'card_name' => $info['card_name'],
            'card_type' => $info['card_type'],
            'card_amount' => $info['card_amount'],
            'card_num' => $info['card_num'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('card_model', $data);
        return $this->db->insert_id();
    }

    /**
     * 编辑卡模型
     *
     * @param $mId
     * @param array $mInfo
     * @return boolean
     */
    public function editCardModel($mId, array $mInfo)
    {
        $data = array(
            'card_name' => $mInfo['card_name'],
            'card_type' => $mInfo['card_type'],
            'card_amount' => $mInfo['card_amount'],
            'card_num' => $mInfo['card_num'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        return $this->db->where('model_id', $mId)->update('card_model', $data);
    }

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
     * 删除卡
     *
     * @param $cardNo
     * @return boolean
     */
    public function deleteCardByCardNo($cardNo)
    {
        $data = array(
            'status' => 0
        );
        $this->db->where('card_no', $cardNo);
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
