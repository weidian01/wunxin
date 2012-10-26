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

require __DIR__.DIRECTORY_SEPARATOR.'Model_way.php';
class Model_Way_1 extends Model_Way
{
    /**
     * @param $conf      开始时间戳,结束时间戳,折扣
     * @return mixed|void
     */
    public function init($conf)
    {
        $this->conf['discount'] = $conf['rule'];
        $this->conf['start_time'] = $conf['start_time'];
        $this->conf['end_time'] = $conf['end_time'];
    }

    function compute($price=0, $num=1)
    {
        $time = time();
        if($time > $this->conf['start_time'] && $time < $this->conf['end_time'])
        {
            $price = ($price * ($num-1)) + ($price * $this->conf['discount'] * 0.1);
        }
        else
        {
            $price = $price * $num;
        }
        return $price;
    }
}