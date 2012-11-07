<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
/**
 * 限时抢购
 */
_require(__DIR__.DIRECTORY_SEPARATOR.'Model_way.php');
class Model_Way_3 extends Model_Way
{
    /**
     * @param $conf      开始时间戳,结束时间戳,折扣
     * @return mixed|void
     */
    public function init($products, $rule='')
    {
        $this->products = $products;
        $this->rule = self::formatRule($rule);
    }

    function compute()
    {
        $total = 0;
        foreach($this->products as $product)
        {
            $total += $product['num'];
        }

        if($total >= $this->rule['num'])
        {
            foreach($this->products as $pid=>$product)
            {
                $this->products[$pid]['final_price'] = ($product['sell_price'] * ($product['num']) * $this->rule['discount'] * 0.1);
            }
        }
    }

    static function formatRule($rule)
    {
        list($return['num'], $return['discount'])  = explode(',', $rule);
        return $return;
    }
}