<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午9:52
 * To change this template use File | Settings | File Templates.
 */
class giftCard extends MY_Controller
{
    /**
     * 卡绑定
     */
    public function cardBanding()
    {
        $cardNo = $this->input->get_post('card_no');
        $cardPassword = $this->input->get_post('card_password');

        $response = array('error' => '0', 'msg' => '绑定卡成功', 'code' => 'banding_card_success');

        do {
            if (empty ($cardNo) || empty ($cardPassword)) {
                $response = error(70003);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('business/Model_Gift_Card', 'card');
            $cardInfo = $this->card->getCardInfoByCid($cardNo);
            

            //卡是否存在
            if (empty ($cardInfo)) {
                $response = error(70017);
                break;
            }

            $this->load->model('business/Model_Gift_Card_model', 'model');
			$modelInfo = $this->model->getCardModelByMid($cardInfo['model_id']);

            //判断有效期
            if ($modelInfo['end_time'] < date('Y-m-d H:i:s', TIMESTAMP)) {
                $response = error(70018);
                break;
            }

            //判断卡是否绑定
            if ($cardInfo['status'] == 2) {
                $response = error(70022);
                break;
            }

			if ($cardInfo['status'] == 0) {
                $response = error(70036);
                break;
            }

            //判断卡的归属
            if ($cardInfo['uid'] != $this->uInfo['uid']) {
                $response = error(70019);
                break;
            }

            //判断卡余额
            if ($cardInfo['card_amount'] <= 0) {
                $response = error(70021);
                break;
            }

            //验证卡密码
            $verify = $this->card->cardVerify($cardNo, $cardPassword);
            if (!$verify) {
                $response = error(70020);
                break;
            }

            $data = array(
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'status' => 2
            );

            $status = $this->card->cardBinding($cardNo, $data);
            if (!$status) {
                $response = error(70002);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    public function cardDelete()
    {
        $cardNo = $this->input->get_post('card_no');

        $response = array('error' => '0', 'msg' => '删除礼物卡成功', 'code' => 'delete_gift_card_success');

        do {
            if (empty ($cardNo)) {
                $response = error(70011);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('business/Model_Gift_Card', 'card');
            $status = $this->card->deleteCardByCardNo($cardNo, $this->uInfo['uid']);
            if (!$status) {
                $response = error(70002);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 使用绑定卡 -- 在订单支付过程
     */
    public function useBandingCard()
    {
        $cardNo = $this->input->get_post('card_number');
        $useAmount = (int)$this->input->get_post('use_amount');
        $useAmount = $useAmount;
//p($cardNo);exit;
        $response = array('error' => '0', 'msg' => '使用礼物卡成功', 'code' => 'use_gift_card_success');

        $return = array(
            '0' => '',
            '1' => '',
            '2' => 70018,//有效期
            '3' => 70016,//判断卡是否绑定
            '4' => 70019,//判断卡的归属
            '5' => 70023,//判断卡余额
            '6' => 70037,//订单产品不在此卡使用范围
            '7' => 70038,//订单不符合此卡使用此规则
        );

        do {
            if (empty ($cardNo) || empty ($useAmount)) {
                $response = error(70015);
                break;
            }

            //是否登陆
            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('business/Model_Gift_Card', 'cards');
            $cardInfo = $this->cards->getUserCardInfo($cardNo, $this->uInfo['uid']);
            //卡是否存在
            if (empty ($cardInfo)) {
                $response = error(70017);
                break;
            }

            //判断卡余额
            if ($cardInfo['card_amount'] <= 0) {
                $response = error(70021);
                break;
            }

            $this->load->model('business/Model_Gift_Card_model', 'model');
            $modelInfo = $this->model->getCardModelByMid($cardInfo['model_id']);

            //判断卡模型信息
            if (empty ($modelInfo)) {
                $response = error(70024);
                break;
            }

            //判断是否是取消使用卡,如果是取消卡，而不往下执行
            $cardList = $this->getUseCard();
            if (isset ($cardList[$cardNo])) {
                unset ($cardList[$cardNo]);
                $response = error(70033);
                $response['save_price'] = array_sum($cardList);
                $this->setUseCard($cardList);
                break;
            }
            $cardList[$cardNo] = $useAmount;

            $cartData = $this->getCartToCookie();
            $cartDataNeedProcess = $this->calculateDiscount($cartData);

            $this->load->model('card/model_card', 'card');
            $cardData = $this->card->get_card_by_no(array_keys($cardList));

            foreach ($cardData as $k=>$v) {
                $cardData[$k]['use_amount'] = $cardList[$v['card_no']];
            }

            //检测单张卡
            $cardCheckStatus = $this->card->check_card($cardData, $this->uInfo['uid'], $cartDataNeedProcess['products']);
            //p($cardCheckStatus);exit;
            if ($cardCheckStatus != '0') {
                $response = error($return[$cardCheckStatus]);
                break;
            }

            //获取卡抵冲金额
            $savePrice = $this->card->all_card_max_use_discount($cardData, $cartDataNeedProcess['products']);

            /*
            $orderPrice = 0;
            foreach ($cartDataNeedProcess as $cdnpv) {
                $orderPrice = $cdnpv['final_price'];
            }
            /**/
            //多张卡检测
            $checkAllCardStatus = $this->card->check_union($cardData);
            if (!$checkAllCardStatus) {
                $response = error(70031);
                break;
            }

//print_r($cardCheckStatus);d($checkAllCardStatus);exit;

            //判断购物车是否为空
            $data = $cartDataNeedProcess;
            if (empty ($data['products'])) {
                $response = error(60001);
                break;
            }

            $response['save_price'] = $savePrice;

            $this->setUseCard($cardList);
        } while (false);

        $this->json_output($response);
    }

    /**
     * 取消使用卡
     */
    public function unUseBandingCard()
    {
        $cardNo = $this->input->get_post('card_number');

        $response = array('error' => '0', 'msg' => '取消使用礼物卡成功', 'code' => 'un_use_gift_card_success');

        do {
            if (empty ($cardNo)) {
                $response = error(70033);
                break;
            }

            $cardList = $this->getUseCard();
            //print_r($cardList);
            unset ($cardList[$cardNo]);
            //print_r($cardList);
            $this->setUseCard($cardList);
        } while (false);

        $this->json_output($response);
    }
}
