<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
/**
 * 折扣, 限时折扣
 */

_require(__DIR__.DIRECTORY_SEPARATOR.'Model_way.php');
class Model_Way_1 extends Model_Way
{
    /**
     * @param $conf      开始时间戳,结束时间戳,折扣
     * @return mixed|void
     */
    public function init($products, $rule='')
    {
        $this->products = $products;
    }

    function compute()
    {
        foreach($this->products as $pid=>$product)
        {
            $time = time();

            $rule = self::formatRule($product['rule']);

            if ($time > $rule['start_time'] && $time < $rule['end_time'])
            {
                $this->products[$pid]['final_price'] = ($product['sell_price'] * ($product['num']) * $rule['discount'] * 0.1);
            }
        }
    }

    static function formatRule($conf)
    {
        $return['discount'] = $conf['rule'];
        $return['start_time'] = strtotime($conf['start_time']);
        $return['end_time'] = strtotime($conf['end_time']);
        return $return;
    }
}