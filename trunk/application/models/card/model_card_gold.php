<?php
/**
 * 金象卡处理模型
 *
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-10
 * Time: 下午4:46
 * To change this template use File | Settings | File Templates.
 */
require(__DIR__ . DIRECTORY_SEPARATOR . 'card_abstract.php');
class model_card_gold extends card_abstruct
{
    /**
     * 生成规则
     *
     * @param $conf
     * @return string
     */
    public function buildRule($conf)
    {
        $limit = empty ($conf['limit']) ? '0' : $conf['limit'];
        $limitUseNum = empty ($conf['limit_use_num']) ? '0' : $conf['limit_use_num'];
        $limitProduct = empty ($conf['limit_product']) ? '0' : $conf['limit_product'];

        $rule = ($limit * 100).','.$limitUseNum.','.$limitProduct;
        return $rule;
    }

    /**
     * 解析规则
     *
     * @param $conf
     * @return array
     */
    public function resolvedRule($conf)
    {
        $rule = $conf['rule'];
        $ruleArray = explode(',', $rule);

        return $ruleArray;
    }

    public function result()
    {

    }

    /**
     * 使用检查
     *
     * @return bool
     */
    public function useCheck()
    {
        return true;
    }
}
