<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午9:36
 * To change this template use File | Settings | File Templates.
 */
class Model_Gift_Card_Model extends MY_Model
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
            'rule' => $info['rule'],
            'descr' => $info['descr'],
            'end_time' => $info['end_time'],
            'is_generation' => '0',
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
    public function editCardModel(array $mInfo, $mId)
    {
        $data = array(
            'card_name' => $mInfo['card_name'],
            'card_type' => $mInfo['card_type'],
            'card_amount' => $mInfo['card_amount'],
            'card_num' => $mInfo['card_num'],
            'rule' => $mInfo['rule'],
            'end_time' => $mInfo['end_time'],
            'descr' => $mInfo['descr'],
            'is_generation' => '0',
        );

        return $this->db->where('model_id', $mId)->update('card_model', $data);
    }

    /**
     * 获取卡模型列表
     *
     * @param int $limit
     * @param int $offset
     * @param string $field
     * @param null $where
     * @param null $orderBy
     * @return null
     */
    public function getCardModelList($limit = 20, $offset = 0, $field = '*', $where = null, $orderBy = null)
    {
        $this->db->select($field);
        $this->db->from('card_model');
        $where && $this->db->where($where);
        $orderBy && $this->db->order_by($orderBy);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array('model_id');

        return $data;
    }

    /**
     * 获取卡模型数量
     *
     * @param array $where
     * @return mixed
     */
    public function getCardModelCount($where = null)
    {
        $this->db->select('*')->from('card_model');
        $where && $this->db->where($where);

        return $this->db->count_all_results();
    }

    /**
     * 获取卡信息 -- 通过模型ID
     *
     * @param $mId
     * @return null | array
     */
    public function getCardModelByMid($mId)
    {
        $data = $this->db->select('*')->from('card_model')->where('model_id', $mId)->get()->row_array();

        return $data;
    }

    /**
     * 获取卡模型信息
     *
     * @param $mId
     * @return mixed
     */
    public function getCardModel($mId)
    {
        $data = $this->db->select('*')->from('card_model')->where('model_id', $mId)->get()->row_array();

        return $data;
    }

    /**
     * 更新卡模型
     *
     * @param array $data
     * @param $mId
     */
    public function updateCardModel(array $data, $mId)
    {
        $this->db->where('model_id', $mId);
        $this->db->update('card_model', $data);
    }

    /**
     * 删除卡模型
     *
     * @param $mId
     * @return boolean
     */
    public function cardModelDelete($mId)
    {
        return $this->db->delete('card_model', array('model_id' => $mId));
    }
}
