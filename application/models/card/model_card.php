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

    private $card_product = array();

    private $card_model = array();

    /**
     * 通过卡号获取卡信息
     * @param $card_no
     * @return mixed
     */
    public function get_card_by_no($card_no)
    {
        $this->db->select('*')->from('card');
        //$this->db->where('uid', $uid);
        if(is_array($card_no))
        {
            $r = array();
            $cards = $this->db->where_in('card_no', $card_no)->get()->result_array('card_no');
            foreach($card_no as $card)
            {
                $r[$card] = $cards[$card];
            }
            return $r;
            //return $this->db->where_in('card_no', $card_no)->get()->result_array();
        }
        return $this->db->where('card_no', $card_no)->get()->row_array();
    }

    /**
     * 通过模型id获取卡模型信息
     * @param $model_id
     * @return mixed
     */
    public function get_card_model_by_id($model_id)
    {
        if (isset($this->card_model[$model_id])) {
            return $this->card_model[$model_id];
        }

        $this->db->select('*')->from('card_model');

        $model = $this->db->where('model_id', $model_id)->get()->row_array();

        $this->card_model[$model_id] = $model;
        return $model;
    }

    /**
     * 检查卡是否可用
     * @param $card_info
     * @param $uid
     * @return int
     */
    public function check_card($card_info, $uid, $products)
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
            if ($card['card_amount'] < ($card['use_amount'])) {
                return 5;
            }

            if(! $this->get_card_product($card['card_no'], $card['card_type'], $products))
            {
                return 6;
            }

            if(! $this->get_card_discount_limit($card, $products))
            {
                return 7;
            }

        }
        return 0;
    }

    /**
     * 检查所有卡最大充抵金额
     * @param $cards
     * @param $products
     * @return int
     */
    public function all_card_max_use_discount($cards, $products)
    {
        $card_max_use_discount = 0;

        foreach($cards as $card)
        {
            $card_max_use_discount += $this->get_card_discount_limit($card, $products, $card_max_use_discount);
        }

        return $card_max_use_discount;
    }

    public function get_card_discount_limit($card,  $products, $default = 0)
    {
        $card_model = $this->get_card_model_by_id($card['model_id']);
        $order_price = $total_price = 0;
        if ($card_model) {

            $card_product = $this->get_card_product($card['card_no'], $card_model['card_type'], $products);

            foreach($card_product as $product)
            {
                $order_price += $product['final_price'];
            }

            $order_price = $order_price - $default;
            $card['use_amount'] = min($card['use_amount'], $card['card_amount']);

            if($card_model['card_type'] <= 2)
            {
                return min($order_price, $card['use_amount']);
            }
            else
            {
                if($card_model['card_type'] == 3)
                {
                    foreach($products as $p) {
                        $total_price += $p['final_price'];
                    }
                }
                else if($card_model['card_type'] == 4)
                {
                    $total_price = $order_price;
                }


                return $total_price < $card_model['rule'] ? 0 : min($order_price, $card['use_amount']);
                //return $total_price < $card_model['rule'] ? 0 : $card['card_amount'];
            }
        }
        return $order_price;
    }

    /**
     * 获取卡的可消费产品
     * @param $card_no
     * @param $card_type
     * @return array
     */
    public function get_card_product($card_no, $card_type, $products)
    {
        if(isset($this->card_product[$card_no]))
        {
            return $this->card_product[$card_no];
        }

        if(in_array($card_type, array(1, 3)))
        {
            foreach($products as $p)
            {
                $this->card_product[$card_no][$p['pid']] = $p;
            }
        }
        else
        {
            $this->db->select('pid')->from('card_product');
            $this->db->where('card_type', $card_type);
            $this->db->where_in('pid', array_keys($products));
            $card_product = $this->db->get()->result_array();
            if($card_product)
            {
                foreach($card_product as $p) {
                    $this->card_product[$card_no][$p['pid']] = $products[$p['pid']];
                }
            }
        }

        return isset($this->card_product[$card_no]) ? $this->card_product[$card_no] : array();

    }

    /**
     * 检查卡之间是否可复用
     * @param $cards
     * @return bool
     */
    public function check_union($cards)
    {
        if(! $cards) //卡列表为空
        {
            return FALSE;
        }

        /**
        $model_id = array();
        foreach($cards as $card)
        {
            if(!isset($model_id[$card['model_id']]))
            {
                $model_id[$card['model_id']] = $card['model_id'];
            }
        }
        //p($cards);
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
            $return_model[$model['card_type']][] = TRUE;
        }
        p($return_model);
         * */
        $return_model = array();
        foreach($cards as $card)
        {
            $return_model[$card['card_type']][] = TRUE;
        }
        if(count($return_model) > 1 ||
            (isset ($return_model[3]) && count($return_model[3]) > 1) ||
            (isset ($return_model[4]) && count($return_model[4]) > 1)) //修改 -- 此处有notice
        {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * 卡消费
     *
     * @param $cards
     * @param $uid
     * @param $order
     * @return mixed
     */
    public function consume($cards, $uid, $order, $products)
    {
        $_cards = array_keys($cards);
        if (empty ($_cards)) {
            return false;
        }

        $cards_info = $this->get_card_by_no($_cards);
        foreach ($cards_info as $k=>$v) {
            $cards_info[$k]['use_amount'] = $cards[$v['card_no']];
        }

        if(0 !== $this->check_card($cards_info, $uid, $products))
        {
            return ;
        }

        if(! $this->check_union($cards_info))
        {
            return ;
        }

        $this->load->model("order/model_order_receiver", 'receiver');

        $date_time = date('Y-m-d H:i:s', TIMESTAMP);
        $total_amount = 0;
        $used_amount = 0;
        foreach($cards_info as $item)
        {
            $item['use_amount'] = $this->get_card_discount_limit($item, $products, $used_amount);
            $used_amount += $item['use_amount'];

//            $card_product = $this->get_card_product($item['card_no'], $item['card_type'], array_keys($products));
//            if($card_product == true && is_array($card_product))
//            {
//                $card_amount = 0;
//                foreach($products as $p)
//                {
//                    if(isset($card_product[$p['pid']]))
//                    {
//                        $card_amount += $p['final_price'];
//                    }
//                }
//                $card_amount && $item['card_amount'] = $card_amount;
//            }
//            if(in_array($item['card_type'], array(3,4)))
//            {
//                $item['use_amount'] = $item['card_amount'];
//            }
            if($item['use_amount'] > 0)
            {
                $item['use_amount'] = $item['use_amount'] > $item['card_amount'] ? $item['card_amount'] : $item['use_amount'];

                //万象卡和千象卡使用一次，将不留余额，直接清除
                $card_balance = ($item['card_type'] > 2) ? 0 : ($item['card_amount'] - $item['use_amount']);

                $this->db->where('card_no', $item['card_no'])
                    ->where('uid', $uid)->set(array('use_num' => 'use_num+1'), '', false)
                    ->update('card', array('card_amount'=>$card_balance));
                if($this->db->affected_rows())
                {
                    $data = array(
                        'order_sn' => $order['order_sn'],
                        'uid' => $uid,
                        'uname' => '',
                        'amount' => $item['use_amount'],
                        'pay_time' => $date_time,
                        'pay_type' => 4, //万象卡
                        'pay_account' => '',
                        'extended_information' => $item['card_no'],
                        'create_time' => $date_time
                    );
                    $this->receiver->addReceiver($data);
                    $total_amount += $data['amount'];
                }
            }

        }

        $up_order = array();
        if(! $total_amount)
        {
            return ;
        }
        if($total_amount < $order['after_discount_price'])
        {
            $up_order['paid'] = $total_amount;
        }
        else
        {
            $up_order['paid'] = $total_amount;
            $up_order['is_pay'] = 1;
        }
        $up_order && $this->db->where("order_sn", $order['order_sn'])->update('order', $up_order);
        return ;
    }
}
