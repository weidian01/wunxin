<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
require 'Model_way.php';
class Model_Way_1 extends Model_Way
{
    function init($conf)
    {
        $this->conf = (int)$conf;
    }

    function compute($price=0, $num=1)
    {
        //echo $price, '-' ;
        $price = $this->conf * 0.1 * $price  * $num;
        //echo '<br>';
        return $price;
    }
}