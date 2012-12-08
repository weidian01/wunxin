<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
/**
 * 第 N 件 X 折
 */
_require(__DIR__.DIRECTORY_SEPARATOR.'Model_way.php');
class Model_Way_2 extends Model_Way
{
    /**
     * @param $products
     * @param string $rule 数量,折扣
     * @return mixed|void
     */
    public function init($products, $rule='')
    {
        $this->products = $products;
    }

    public function compute()
    {
        $time = time();
        $group = $this->grouping();//p($group);
        foreach($group as $pid=>$products)
        {
            $total = 0;
            $key = $rule = NULL;
            foreach ($products as $k => $product)
            {
                $key === NULL && $key = $k;
                $rule === NULL && $rule = self::formatRule($product['rule']);
                $total += $product['num'];
            }
        }
        if($total >= $rule['num'] && $time > $rule['start_time'] && $time < $rule['end_time'])
        {
            $this->products[$key]['final_price'] = ($this->products[$key]['sell_price'] * ($this->products[$key]['num'] - 1) + ($this->products[$key]['sell_price'] * $rule['discount'] * 0.1));
        }
        //p($this->products);
    }

    private function grouping()
    {
        $group = array();
        foreach($this->products as $key=>$product)
        {
            list($pid, $size_id) = explode('-', $key);
            $group[$pid][$key] = $product;
        }
        return $group;
    }

    static function formatRule($conf)
    {
        //echo '<pre>';print_r($conf);//exit;
        list($return['num'],$return['discount']) = explode(',', $conf['rule']);
        $return['start_time'] = strtotime($conf['start_time']);
        $return['end_time'] = strtotime($conf['end_time']);
        return $return;
    }
}