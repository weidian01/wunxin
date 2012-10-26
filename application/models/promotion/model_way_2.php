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
require __DIR__.DIRECTORY_SEPARATOR.'Model_way.php';
class Model_Way_2 extends Model_Way
{
    /**
     * @param $conf      数量,折扣
     * @return mixed|void
     */
    public function init($conf)
    {
        list($this->conf['num'], $this->conf['discount']) = explode(',', $conf['rule']);
    }

    public public function compute($price=0, $num=1)
    {
        if($this->conf['num'] > $num)
        {
            $price = $price * $num;
        }
        else
        {
            $price = ($price * ($num-1)) + ($price * $this->conf['discount'] * 0.1);
        }
        return $price;
    }
}