<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-10
 * Time: 下午2:41
 * To change this template use File | Settings | File Templates.
 * status 0 成功， 1 参数不全， 2 卡不存在， 3 卡已过有效期，4 卡没有绑定， 5 卡不属于此用户，6 卡金额低于0，7 卡密码错误
 */
class model_card extends MY_Model
{
    public $cardInfo = null;
    public $productInfo = null;

    public function __construct(array $cardInfo, array $productInfo)
    {
        $this->cardInfo = $cardInfo;
        $this->productInfo = $productInfo;
    }

    /**
     * 检查卡
     */
    public function checkCard()
    {

    }

    public function getCardInfo()
    {
        $cardNo = array();
        $uid = array();
        foreach ($this->cardInfo as $v) {
            $cardNo[] = $v['card_no'];
        }
    }

    /**
     * 构造统一的返回值
     *
     * @param $status
     * @param $msg
     * @return array
     */
    public function returnData($status, $msg)
    {
        $return = array(
            'status' => $status,
            'msg' => $msg,
        );
        return $return;
    }
}
