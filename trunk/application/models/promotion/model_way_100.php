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
class Model_Way_100 extends Model_Way
{

     private $order_amount = 0;

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
        foreach($this->products as $pid=>$product)
        {
            if(isset($product['sell_price']))
                $this->order_amount += $product['sell_price'];
        }
    }

    static function formatRule($conf)
    {
        list($return['limit'], $return['discount'])  = explode(',', $conf);
        return $return;
    }

    public function result()
    {
        $r = array('save'=>0, 'order'=>TRUE);
        if($this->order_amount < ($this->rule['limit'] * 100))
        {
            $r['order'] = FALSE;
        }
        else
        {
            $r['save'] = $this->order_amount - ($this->order_amount * ($this->rule['discount'] * 0.1));
        }
        return $r;
    }
}