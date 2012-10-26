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
     * 产品
     * @var array
     */
    private $products = array();


    /**
     * 促销活动
     * @var array
     */
    private $promotion = array();

    function __construct()
    {
        parent::__construct();
        $this->get_promotion();
    }

    /**
     * 获取当前促销信息
     */
    function get_promotion()
    {
        $date = date('Y-m-d H:i:s');
        $this->db->select('*')->from('promotion');
        $this->db->where(array('start_time <=' => $date, 'end_time >=' => $date));
        $this->db->order_by('priority', 'DESC');
        $promotion = $this->db->get()->result_array();

        foreach ($promotion as $p) {
            if ($p['pay_type'])
                $this->promotion['product'][] = $p;
            else
                $this->promotion['order'][] = $p;
        }
    }

    /**
     * 是否有针对产品的活动进行中
     * @return bool
     */
    function is_promotion_product()
    {
        return isset($this->promotion['product']) ? TRUE : FALSE;
    }

    /**
     * 是否有针对订单的活动进行中
     * @return bool
     */
    function is_promotion_order()
    {
        return isset($this->promotion['order']) ? TRUE : FALSE;
    }

    /**
     * 添加产品
     * @param $produt
     */
    function add_product(array $product)
    {
        $this->products[$product['pid']] = $product;
        return $this;
    }

    /**
     * 处理产品参与活动后的价格
     */
    function compute()
    {
        if ($this->is_promotion_product()) {
            foreach ($this->products as $key => $p) {
                $price = NULL;
                foreach ($this->promotion['product'] as $promotion) {
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

    function result()
    {
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






