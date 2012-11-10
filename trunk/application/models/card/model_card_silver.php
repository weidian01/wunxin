<?php
/**
 * 银象卡处理模型
 *
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-10
 * Time: 下午5:15
 * To change this template use File | Settings | File Templates.
 */
require(__DIR__ . DIRECTORY_SEPARATOR . 'card_abstract.php');
class model_card_silver extends card_abstruct
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

    public function useCheck()
    {
        $modelInfo = $this->db->get_where('card_model', array('model_id' => $this->card['model_id']));
        if (empty ($modelInfo)) {
            return false;
        }

        $ruleArray = $this->resolvedRule(array('rule' => $modelInfo['rule']));

        $totalPrice = 0;
        foreach ($this->product as $pv) {
            $totalPrice += $pv['final_price'];
        }

        if ($totalPrice > $ruleArray[0]) {
            return false;
        }

        foreach ($this->card as $cv) {

        }
    }

}
