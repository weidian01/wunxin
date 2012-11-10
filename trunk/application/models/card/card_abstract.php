<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-10
 * Time: 下午4:40
 * To change this template use File | Settings | File Templates.
 */
abstract class card_abstruct
{
    protected $card = null;
    protected $product = null;

    protected function init($card, $product)
    {
        $this->card = $card;
        $this->product = $product;
    }
    /**
     * 生成规则
     */
    abstract function buildRule($conf);

    /**
     * 解析规则
     */
    abstract function resolvedRule($conf);

    /**
     * 生成结果
     */
    abstract function result();
}
