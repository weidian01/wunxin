<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-25
 * Time: 下午8:07
 * To change this template use File | Settings | File Templates.
 */
require 'Model_way.php';
class model_limit_buy extends Model_Way
{
    public function init($conf)
    {
        $this->conf = (int)$conf;
    }

    public function compute($price = 0, $num = 1)
    {
        $rule = intval($this->conf);
        $price = ($rule * $price) / 100;

        return round($price, 2);
    }
}
