<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
# extends MY_Model
abstract class Model_way
{
    /**
     * 促销方式所需参数
     * @var null
     */
    protected $conf = NULL;

    /**
     * 初始化设置
     *
     * @abstract
     * @param $product
     * @param $rule
     * @return mixed
     */
    abstract function init($product, $rule);

    /**
     * 根据原价和规则计算最终价格
     *
     * @abstract
     * @return mixed
     */
    abstract function compute();

    public function result()
    {
        $cost_price  = $discount_price = 0;

        $result = array('save'=>0, 'order'=>array());
        foreach ($this->products as $key => $p) {
            $cost_price += ($p['sell_price'] * $p['num']);
            if (isset ($p['final_price'])) {
                $discount_price += $p['final_price'];
                $result['order'][$key] = array('pid' => $p['pid'], 'final_price' => $p['final_price']);
            }
            else
            {
                $discount_price += ($p['sell_price'] * $p['num']);
            }
        }
        $result['save'] = $cost_price  - $discount_price;//p($result);die;
        return $result;
    }
}