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
        foreach($this->products as $pid=>$product)
        {
            $time = time();
            //echo '<pre>';print_r($product);exit;
            $rule = self::formatRule($product['rule']);

            if ($time > $rule['start_time'] && $time < $rule['end_time'] && $product['num'] >= $rule['num'])
            {
                $this->products[$pid]['final_price'] = ($product['sell_price'] * ($product['num']-1) +  ($product['sell_price'] * $rule['discount'] * 0.1));
            }
        }
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