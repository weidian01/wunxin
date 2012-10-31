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
    }

    private function set_promotion_product()
    {
        $pid = array_keys($this->order_products);
        $promotion_id = array_keys($this->get_promotion());
        $this->db->select('*')->from('promotion_product');
        $this->db->where_in('pid', $pid);
        $this->db->where_in('promotion_id', $promotion_id);
        $data = $this->db->get()->result_array();
        foreach($data as $p)
        {
            $this->promotion_products[] = $p;
        }
    }

    /**
     * 是否有针对产品的活动进行中
     * @return bool
     */
    function is_promotion_product()
    {
        return $this->promotion ? TRUE : FALSE;
    }

    /**
     * 添加产品
     * @param $produt
     */
    function add_product($product)
    {
        $this->order_products[$product['pid']] = $product;
        return $this;
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
                if($this->promotion[$id]['pay_type'])
                {
                    $this->use_promotion['product'][] = $id;
                }
                else
                {
                    $this->use_promotion['order'][] = $id;
                }
            }
        }
        return ;
    }

    /**
     * 获得可使用的优惠活动
     * @return array
     */
    function get_promotion()
    {
        return $this->promotion;
    }

    /**
     * 对应单个产品的优惠活动
     */
    function promotionByOne()
    {
        ;
    }

    /**
     * 对应多个产品的优惠活动
     */
    function promotionByMore()
    {
        ;
    }

    /**
     * 对应订单的活动
     */
    function promotionByOrder()
    {
        ;
    }

    private function promotionInfo($promotion_id)
    {
        return isset($this->promotion[$promotion_id]) ? $this->promotion[$promotion_id] : null;
    }

    function compute()
    {
        $this->set_promotion_product();

        foreach($this->use_promotion['product'] as $promotion_id)
        {
            $p_info = $this->promotionInfo($promotion_id);
            $products = $this->get_product($promotion_id, $p_info);
            if($products)
            {
                switch ($p_info['promotion_type']) {
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
                $way->init($products);

                $way->compute();

            }
            p($products);
            p($way->result());
            die;
        }
        p($this);
    }

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
                if($promotion_id == $info['promotion_id'] && !isset($this->order_products[$info['pid']]['promotion_id']))
                {
                    $this->order_products[$info['pid']]['rule'] = array('rule'=>$info['rule'],'start_time'=>$info['start_time'], 'end_time'=>$info['end_time']);;
                    $return[$info['pid']] = $this->order_products[$info['pid']];
                }
            }
        }
        return $return;
    }

//    /**
//     * 处理产品参与活动后的价格
//     */
//    function compute()
//    {
//        if ($this->is_promotion_product()) {
//            foreach ($this->products as $key => $p) {
//                $price = NULL;
//                foreach ($this->promotion['one'] as $promotion) {
//                    if ($promotion['promotion_range'] == 0) {
//                        $rule['rule'] = $promotion['rule'];
//                        $rule['start_time'] = strtotime($promotion['start_time']);
//                        $rule['end_time'] = strtotime($promotion['end_time']);
//                    } else {
//                        $tmp = $this->get_promotion_product($p['pid'], $promotion['promotion_id']);
//                        if (!$tmp)
//                            continue;
//                        $rule['rule'] = $tmp['rule'];
//                        $rule['start_time'] = strtotime($tmp['start_time']);
//                        $rule['end_time'] = strtotime($tmp['end_time']);
//                    }
//                    switch ($promotion['promotion_type']) {
//                        case 1: //折扣
//                            $way = $this->load->model('promotion/Model_way_1', 'way', FALSE, TRUE);
//                            break;
//                        case 2: //第 N 件 X 折
//                            $way = $this->load->model('promotion/Model_way_2', 'way', FALSE, TRUE);
//                            break;
//                        case 3:
//                            $way = $this->load->model('promotion/Model_way_3', 'way', FALSE, TRUE);
//                            break;
//                        default:
//                            $way = NULL;
//                            break;
//                    }
//                    if ($way) {
//                        $way->init($rule);
//                        if (FALSE) { //$promotion['is_juxtaposed']
//                            if (!isset($price['share']['price'])) {
//                                $price['share']['price'] = $way->compute($p['sell_price'], 1);
//                                $price['share']['remark'] = $promotion['name'];
//
//                            } else {
//                                $price['share']['price'] = $way->compute($price['share']['price'], 1);
//                                $price['share']['remark'] .= '+' . $promotion['name'];
//                            }
//                        } else {
//                            $price[$promotion['promotion_id']] = array('price' => $way->compute($p['sell_price'], 1), 'remark' => $promotion['name']);
//                        }
//                    }
//                }
//
//                if ($price) {
//                    uasort($price, "self::cmp");
//                    //$this->products[$key]['price'] = $price[0]['price'];
//                    //$this->products[$key]['remark'] = $price[0]['remark'];
//                    $this->products[$key]['promotion'] = $price;
//                } else {
//                    $this->products[$key]['price'] = $p['sell_price'];
//                    $this->products[$key]['remark'] = '';
//                }
//            }
//        }
//    }

    function result()
    {
        //print_r($this->promotion);
        return $this->products;
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
}






