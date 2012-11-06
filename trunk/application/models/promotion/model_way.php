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
     * @abstract
     * @param $conf
     * @return mixed
     */
    abstract function init($product, $rule);

    /**
     * 根据原价和规则计算最终价格
     * @abstract
     * @param $price
     * @param $num
     * @return mixed
     */
    abstract function compute();

    public function result()
    {
        $result = array();
        foreach ($this->products as $p) {
            if ($p['final_price']) {
                $result[$p['pid']] = array('pid' => $p['pid'], 'final_price' => $p['final_price']);
            }
        }
        return $result;
    }
}