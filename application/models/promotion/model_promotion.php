<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Promotion extends MY_Model
{
    /**
     * 购物车内产品
     * @var array
     */
    private $order_products = array();

    /**
     * 参与活动的产品
     * @var array
     */
    private $promotion_products = array();

    /**
     * 促销活动
     * @var array
     */
    private $promotion = array();

    /**
     * 使用什么优惠
     * @var array
     */
    private $use_promotion = array();

    function __construct()
    {
        parent::__construct();
        $this->set_promotion();
    }

    /**
     * 获取当前促销信息
     */
    private function set_promotion()
    {
        $date = date('Y-m-d H:i:s');
        $this->db->select('*')->from('promotion');
        $this->db->where(array('start_time <=' => $date, 'end_time >=' => $date));
        $this->db->order_by('priority', 'DESC');
        $promotion = $this->db->get()->result_array();

        foreach ($promotion as $p) {
            $this->promotion[$p['promotion_id']] = $p;
        }
        return ;
    }

    private function set_promotion_product()
    {
        $promotions = $this->get_promotion();
        if($promotions)
        {
            $promotion_id = array_keys($promotions);
            $pid = array();//array_keys($this->order_products);
            foreach($this->order_products as $item)
            {
                $pid[] = $item['pid'];
            }
            $this->db->select('*')->from('promotion_product');
            $pid && $this->db->where_in('pid', $pid);
            $this->db->where_in('promotion_id', $promotion_id);
            $data = $this->db->get()->result_array();
            if ($data) {
                foreach ($data as $p) {
                    $this->promotion_products[] = $p;
                }
            }
        }
        return ;
    }

    /**
     * 是否有针对产品的活动进行中
     * @return bool
     */
    function is_promotion($promotion_id)
    {
        return isset($this->promotion[$promotion_id]) ? TRUE : FALSE;
    }

    /**
     * 添加产品
     * @param $produt
     */
    function add_product($products)
    {
        foreach($products as $p)
        {
            $key = "{$p['pid']}-{$p['size_id']}";
            $this->order_products[$key] = $p;
        }
        $this->set_promotion_product();
        return ;
    }

    /**
     * 设置要试用的优惠活动
     * @param array $promotion_id
     */
    function use_promotion(array $promotion_id)
    {
        if($promotion_id)
        {
            foreach($promotion_id as $id)
            {
                if($this->is_promotion($id))
                {
                    if($this->promotion[$id]['pay_type'])
                    {
                        $this->use_promotion['product'][] = $id;
                    }
                    else
                    {
                        $this->use_promotion['order'][$id] = $id;
                    }
                }
            }
        }
        return ;
    }

    /**
     * 获取可用的优惠项目
     */
    function get_unused_promotion()
    {
        $unused = array();
        foreach ($this->promotion as $key=>$item) {
            if (!isset($item['used']) || $item['used'] != true) {
                $r = $this->discount($item['promotion_id']);
                //d($item['promotion_id']);d($r);
                if ($r['order']) {
                    $this->set_used_promotion($item['promotion_id'], $r['save'], FALSE);
                    $unused[] = $this->promotion[$key];
                }
            }
        }
        return $unused;
    }

    /**
     * 获取已用的优惠项目
     */
    function get_used_promotion()
    {
        $used = array();
        foreach($this->promotion as $item)
        {
            if(isset($item['used']) && $item['used'] == true)
            {
                $used[] = $item;
            }
        }
        return $used;
    }

    /**
     * 获得所有的优惠活动
     * @return array
     */
    function get_promotion()
    {
        return $this->promotion;
    }

    private function promotionInfo($promotion_id)
    {
        return isset($this->promotion[$promotion_id]) ? $this->promotion[$promotion_id] : null;
    }

    /**
     * 根据活动id 计算参与活动产品的优惠价格
     * @param $promotion_id
     * @return array
     */
    private function discount($promotion_id)
    {
        $p_info = $this->promotionInfo($promotion_id);
        $products = array();
        if($p_info['pay_type'] == 1)
        {
            $products = $this->get_product($promotion_id, $p_info);
        }
        elseif($p_info['pay_type'] == 0)
        {
            $products = $this->order_products;
        }

        if ($products) {
            switch ($p_info['promotion_type']) {
                case PROMOTION_TEMPLATE_DISCOUNT: //折扣
                    $way = $this->load->model('promotion/model_way_1', 'way1', FALSE, TRUE);
                    break;
                case PROMOTION_TEMPLATE_N_NUM_N_DISCOUNT: //单一产品 第 N 件 X 折
                    $way = $this->load->model('promotion/model_way_2', 'way2', FALSE, TRUE);
                    break;
                case PROMOTION_TEMPLATE_FULL_N_N_DISCOUNT: //指定范围 产品 满 N 件 X 折扣
                    $way = $this->load->model('promotion/model_way_3', 'way3', FALSE, TRUE);
                    break;
                case PROMOTION_TEMPLATE_ORDER_FULL_CUT_DISCOUNT: // 订单满X元 减Y元
                    $way = $this->load->model('promotion/model_way_100', 'way100', FALSE, TRUE);
                    break;
                case PROMOTION_TEMPLATE_ORDER_FULL_REBATE_DISCOUNT: //订单满X元 Y折
                    $way = $this->load->model('promotion/model_way_101', 'way101', FALSE, TRUE);
                    break;
                default:
                    $way = NULL;
                    break;
            }
            if($way)
            {
                //echo '<pre>';print_r($p_info['rule']);
                $way->init($products, $p_info['rule']);
                $way->compute();
                return $way->result();
            }
        }
        return array('save'=>0, 'order'=>array());
    }

    function compute()
    {
        /**
         * 以下针对产品优惠
         */
        if(isset($this->use_promotion['product']))
        {
            foreach($this->use_promotion['product'] as $promotion_id)
            {
                $use_products = $this->discount($promotion_id);
                if ($use_products['order']) {
                    $this->set_used_promotion($promotion_id, $use_products['save'], true);
                    $this->set_product_final_price($use_products['order'], $promotion_id);
                    $this->clear_promotion_products($use_products['order']);
                }
            }
        }

        /**
         * 以下针对订单优惠
         */
        if(isset($this->use_promotion['order']))
        {
            $clear = FALSE;
            foreach($this->use_promotion['order'] as $promotion_id)
            {
                $r = $this->discount($promotion_id);
                if ($r['order']) {
                    $this->set_used_promotion($promotion_id, $r['save'], true);
                    $clear = TRUE;
                    break;
                }
            }

            /**
             * 从可使用优惠中清除其他订单优惠信息,订单优惠信息不可重复
             * 所以使用过一次订单优惠,其他订单优惠则不可用
             */
            if($clear)
            {
                foreach($this->promotion as $key => $item)
                {
                    if($item['pay_type'] == 0 && (!isset($item['used']) || $item['used'] == false))
                    {
                        unset($this->promotion[$key]);
                    }
                }
            }
        }

        return ;
    }

    /**
     * 把已用的活动设置为使用过状态 used = 1
     * @param $promotion_id 活动id
     * @param $save         参与活动后节约金额
     * @return mixed
     */
    private function set_used_promotion($promotion_id, $save = 0, $use = false)
    {
        if(isset($this->promotion[$promotion_id]))
        {
            $use && $this->promotion[$promotion_id]['used'] = true;
            $this->promotion[$promotion_id]['save'] = $save;
        }
        return ;
    }

    /**
     * 设置产品最终优惠价格
     * @param $use_products
     * @param $promotion_id
     * @return mixed
     */
    private function set_product_final_price($use_products, $promotion_id)
    {
        //$this->set_used_promotion($promotion_id, 0, true);
        foreach($use_products as $key => $product)
        {
            $this->order_products[$key]['promotion_id'] = $promotion_id;
            $this->order_products[$key]['final_price'] = $product['final_price'];
        }
        return ;
    }

    /**
     * 使用过优惠的产品从活动产品列表中清除
     * @param $use_products
     * @return mixed
     */
    private function clear_promotion_products($use_products)
    {
        $keys = array();//array_keys($use_products);
        foreach($use_products as $v)
        {
            $keys[$v['pid']] = true;
        }
        foreach($this->promotion_products as $key => $product)
        {
            if(isset($keys[$product['pid']]))//if(in_array($product['pid'],$keys))
            {
                unset($this->promotion_products[$key]);
            }
        }
        return ;
    }

    /**
     * 获取参与某活动的所有产品
     * @param $promotion_id
     * @param $p_info
     * @return array
     */
    function get_product($promotion_id, $p_info)
    {
        $return = array();
        if($p_info['promotion_range'] == 0)
        {
            foreach($this->order_products as $pid => $info)
            {
                if(! isset($info['promotion_id']))
                {
                    $info['rule'] = array('rule'=>$p_info['rule'],'start_time'=>$p_info['start_time'], 'end_time'=>$p_info['end_time']);
                    $return[$pid] = $info;
                }
            }
        }
        else
        {
            foreach($this->promotion_products as $info)
            {
                //p($this->order_products);p($this->promotion_products);die;
                //$key = "{$info['pid']}-{$info['size_id']}";
                if($promotion_id == $info['promotion_id'] )
                {
                    foreach($this->order_products as $key => $item)
                    {
                       list($pid, $size_id) = explode('-', $key);
                       if($pid == $info['pid'] && ! isset($this->order_products[$key]['promotion_id']))
                       {
                           $item['rule'] = array('rule' => $info['rule'], 'start_time' => $info['start_time'], 'end_time' => $info['end_time']);
                           $return[$key] = $item;
                       }
                    }
                }
            }
        }
        return $return;
    }

    /**
     * 获取参与活动后的
     * @return array
     */
    function result()
    {
        //p($this->order_products);
        $r = array('products'=>array(),
            'cost_price'=>0,        //优惠前总金额
            'total_price'=>0,       //优惠后总金额
            'order_discount'=>0,    //订单优惠金额
            'product_discount'=>0   //产品优惠金额
        );
        //cost_price == total_price + order_discount +product_discount

        foreach($this->order_products as $p)
        {
            $key = "{$p['pid']}-{$p['size_id']}";
            if(isset($p['promotion_id']) && $p['promotion_id'])
            {
                $p['promotion_name'] = $this->promotion[$p['promotion_id']]['name'];
                $r['products'][$key] = $p;
            }
            else
            {
                $p['promotion_name'] = '';
                $p['promotion_id'] = 0;
                $p['final_price'] = $p['sell_price'] * $p['num'];
                $r['products'][$key] = $p;
            }
            $r['cost_price'] += ($p['sell_price'] * $p['num']);
            $r['total_price'] += $p['final_price'];
        }

        $used_promotion = $this->get_used_promotion();
        if($used_promotion)
        {
            $discount_price = 0;
            foreach($used_promotion as $pp)
            {
                if(isset($pp['used']) && $pp['used'] == true && $pp['pay_type'] == 0)
                {
                    $discount_price = $pp['save'];
                }
                if($pp['pay_type'] == 0 )
                {
                    $r['order_discount'] = $pp['save'];
                }
                else
                {
                    $r['product_discount'] = $pp['save'];
                }
            }
            $r['total_price'] -= $discount_price;
        }
        //p($r);
        return $r;
    }

    /**
     * 处理产品参与活动后的价格
     */
    /*
    function compute()
    {
        if ($this->is_promotion_product()) {
            foreach ($this->products as $key => $p) {
                $price = NULL;
                foreach ($this->promotion['one'] as $promotion) {
                    if ($promotion['promotion_range'] == 0) {
                        $rule['rule'] = $promotion['rule'];
                        $rule['start_time'] = strtotime($promotion['start_time']);
                        $rule['end_time'] = strtotime($promotion['end_time']);
                    } else {
                        $tmp = $this->get_promotion_product($p['pid'], $promotion['promotion_id']);
                        if (!$tmp)
                            continue;
                        $rule['rule'] = $tmp['rule'];
                        $rule['start_time'] = strtotime($tmp['start_time']);
                        $rule['end_time'] = strtotime($tmp['end_time']);
                    }
                    switch ($promotion['promotion_type']) {
                        case 1: //折扣
                            $way = $this->load->model('promotion/Model_way_1', 'way', FALSE, TRUE);
                            break;
                        case 2: //第 N 件 X 折
                            $way = $this->load->model('promotion/Model_way_2', 'way', FALSE, TRUE);
                            break;
                        case 3:
                            $way = $this->load->model('promotion/Model_way_3', 'way', FALSE, TRUE);
                            break;
                        default:
                            $way = NULL;
                            break;
                    }
                    if ($way) {
                        $way->init($rule);
                        if (FALSE) { //$promotion['is_juxtaposed']
                            if (!isset($price['share']['price'])) {
                                $price['share']['price'] = $way->compute($p['sell_price'], 1);
                                $price['share']['remark'] = $promotion['name'];

                            } else {
                                $price['share']['price'] = $way->compute($price['share']['price'], 1);
                                $price['share']['remark'] .= '+' . $promotion['name'];
                            }
                        } else {
                            $price[$promotion['promotion_id']] = array('price' => $way->compute($p['sell_price'], 1), 'remark' => $promotion['name']);
                        }
                    }
                }

                if ($price) {
                    uasort($price, "self::cmp");
                    //$this->products[$key]['price'] = $price[0]['price'];
                    //$this->products[$key]['remark'] = $price[0]['remark'];
                    $this->products[$key]['promotion'] = $price;
                } else {
                    $this->products[$key]['price'] = $p['sell_price'];
                    $this->products[$key]['remark'] = '';
                }
            }
        }
    }

    private function get_promotion_product($pid, $promotion_id)
    {
        $this->db->select('*')->from('promotion_product');
        $where = array('promotion_id' => $promotion_id, 'pid' => $pid);
        $this->db->where($where);
        return $this->db->get()->row_array();
    }

    static private function cmp($a, $b)
    {
        if ($a['price'] == $b['price']) {
            return 0;
        }
        return ($a['price'] < $b['price']) ? -1 : 1;
    }
    */
}






