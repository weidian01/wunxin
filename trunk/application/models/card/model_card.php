<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-10
 * Time: 下午2:41
 * To change this template use File | Settings | File Templates.
 * status 0 成功， 1 参数不全， 2 卡不存在， 3 卡已过有效期，4 卡没有绑定， 5 卡不属于此用户，6 卡金额低于0，7 卡密码错误
 */
class model_card extends MY_Model
{
    public $cards = array();

    public $productInfo = null;

    public function get_card_by_no($card_no)
    {
        $this->db->select('*')->from('card');
        //$this->db->where('uid', $uid);
        if(is_array($card_no))
        {
            return $this->db->where_in('card_no', $card_no)->get()->result_array();
        }
        return $this->db->where('card_no', $card_no)->get()->row_array();
    }

    public function get_card_model_by_id($model_id)
    {
        $this->db->select('*')->from('card_model');
        //$this->db->where('uid', $uid);
        if(is_array($model_id))
        {
            return $this->db->where_in('model_id', $model_id)->get()->result_array();
        }
        return $this->db->where('model_id', $model_id)->get()->row_array();
    }

    public function check_card($card_info, $uid)
    {
        foreach($card_info as $card)
        {
            if (empty ($card)) {
                return 1;
            }

            //判断有效期
            if (TIMESTAMP > strtotime($card['end_time'])) {
                return 2;
            }

            //判断卡是否绑定
            if ($card['status'] != 2) {
                return 3;
            }

            //判断卡的归属
            if ($card['uid'] != $uid) {
                return 4;
            }

            //判断卡余额
            if ($card['card_amount'] < ($card['use_amount'] * 100)) {
                return 5;
            }
        }
        return 0;
    }

    public function check_union($cards)
    {
        if(! $cards) //卡列表为空
        {
            return FALSE;
        }

        $model_id = array();
        foreach($cards as $card)
        {
            if(!isset($model_id[$card['model_id']]))
            {
                $model_id[$card['model_id']] = $card['model_id'];
            }
        }
        if(! $model_id) //模型id为空
        {
            return FALSE;
        }
        $this->db->select('*')->from('card_model');
        $this->db->where_in('model_id', $model_id);
        $models = $this->db->get()->result_array();
        if(! $models) //模型为空
        {
            return FALSE;
        }
        $return_model = array();
        foreach($models as $model)
        {
            if(! isset($return_model[$model['card_type']]))
            {
                $return_model[$model['card_type']] = TRUE;
            }
        }

        return count($return_model) > 1 ? FALSE:TRUE;
    }




    /**
     * 检查卡
     */
    public function checkCard()
    {

    }

    public function getCardInfo()
    {
        $cardNo = array();
        $uid = array();
        foreach ($this->cardInfo as $v) {
            $cardNo[] = $v['card_no'];
        }
    }

    /**
     * 构造统一的返回值
     *
     * @param $status
     * @param $msg
     * @return array
     */
    public function returnData($status, $msg)
    {
        $return = array(
            'status' => $status,
            'msg' => $msg,
        );
        return $return;
    }
}
