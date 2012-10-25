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
        $this->db->order_by('priority','DESC');
        $this->promotion = $this->db->get()->result_array();
    }

    /**
     * 是否有活动进行中
     * @return bool
     */
    function is_promotion()
    {
        return $this->promotion ? TRUE : FALSE;
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

    function compute()
    {

        foreach($this->products as $key=>$p)
        {
            $price = NULL;
            foreach($this->promotion as $promotion)
            {
                if($promotion['promotion_range'] == 0)
                {
                    $rule = $promotion['rule'];
                }
                else
                {
                    $tmp = $this->get_promotion_product($p['pid'], $promotion['promotion_id']);
                    if(!$tmp)
                        continue;
                    $rule = $tmp['rule'];
                }
                switch($promotion['promotion_type'])
                {
                    case 1:
                        $way = $this->load->model('promotion/Model_way_1', 'way', FALSE, TRUE);
                        break;
                    case 2:
                        $way = $this->load->model('promotion/Model_way_2', 'way', FALSE, TRUE);
                        break;
                    case 3:
                        $way = $this->load->model('promotion/Model_way_3', 'way', FALSE, TRUE);
                        break;
                    default:
                        $way = NULL;
                        break;
                }
                if($way)
                {
                    $way->init($rule);
                    if($promotion['is_juxtaposed'])
                    {
                        if(!isset($price['share']['price']))
                        {
                            $price['share']['price'] = $way->compute($p['sell_price']);
                            $price['share']['remark'] = $promotion['name'];

                        }
                        else
                        {
                            $price['share']['price'] = $way->compute($price['share']['price']);
                            $price['share']['remark'] .= '+'.$promotion['name'];
                        }
                    }
                    else
                    {
                        $price[] = array('price'=>$way->compute($p['sell_price']), 'remark'=>$promotion['name']);
                    }

                }


            }

            if($price)
            {
                usort($price, "self::cmp");
                $this->products[$key]['price'] = $price[0]['price'];
                $this->products[$key]['remark'] = $price[0]['remark'];
            }
            else
            {
                $this->products[$key]['price'] = $p['sell_price'];
                $this->products[$key]['remark'] = '';
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
        $this->db->where(array('promotion_id' => $promotion_id, 'pid' => $pid));
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






