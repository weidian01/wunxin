<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-25
 * Time: 下午8:03
 * To change this template use File | Settings | File Templates.
 */
require 'Model_way.php';
class model_discount extends Model_Way
{
    public function init($conf)
    {
        $this->conf = (int)$conf;
    }

    public function compute($price=0, $num=1)
    {
        $rule = intval($this->conf);
        $price = ($rule * $price) / 100;

        return round($price, 2);
    }
}
