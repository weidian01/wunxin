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
     * @return mixed
     */
    abstract function init($conf);

    /**
     * 根据原价和规则计算最终价格
     * @abstract
     * @param $price
     * @return mixed
     */
    abstract function compute($price);
}