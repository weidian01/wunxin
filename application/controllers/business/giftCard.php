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
            $this->load->model('business/Model_Gift_Card_model', 'model');
            $cardInfo = $this->card->getCardInfoByCid($cardNo);
            $modelInfo = $this->model->getCardModelByMid($cardInfo['model_id']);

            //卡是否存在
            if (empty ($cardInfo)) {
                $response = error(70017);
                break;
            }

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

        $response = array('error' => '0', 'msg' => '使用礼物卡成功', 'code' => 'use_gift_card_success');

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

            $this->load->model('business/Model_Gift_Card', 'card');
            $cardInfo = $this->card->getCardInfoByCid($cardNo);

            //卡是否存在
            if (empty ($cardInfo)) {
                $response = error(70017);
                break;
            }

            $this->load->model('business/Model_Gift_Card_model', 'model');
            $modelInfo = $this->model->getCardModelByMid($cardInfo['model_id']);

            //判断卡模型信息
            if (empty ($modelInfo)) {
                $response = error(70024);
                break;
            }

            //判断有效期
            if ($modelInfo['end_time'] < date('Y-m-d H:i:s', TIMESTAMP)) {
                $response = error(70018);
                break;
            }

            //判断卡是否绑定
            if ($cardInfo['status'] != 2) {
                $response = error(70016);
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

            if ($useAmount > $cardInfo['card_amount']) {
                $response = error(70023);
                break;
            }

            //判断购物车是否为空
            $cData['cart'] = $this->getCartToCookie();
            $data = $this->calculateDiscount($cData['cart']);
            if (empty ($data['product'])) {
                $response = error(60001);
                break;
            }

            $giftCard = $this->input->cookie(config_item('cookie_prefix').'gift_card');
            $giftCard = json_decode(authcode($giftCard, 'DECODE'), true);

            $info = array(
                'card_no' => $cardInfo['card_no'],
                'card_pass' => $cardInfo['card_pass'],
                'card_amount' => $cardInfo['card_amount'],
                'uid' => $this->uInfo['uid'],
                'model_id' => $cardInfo['model_id'],
            );

            //处理多礼品卡 -- 唯一性
            $giftCard[$cardInfo['card_no']] = $info;

            switch ($modelInfo['card_type']) {
                case CARD_GOLD: $this->load->model('card/model_card_gold', 'm_card');break;
                case CARD_SILVER:$this->load->model('card/model_card_silver', 'm_card');break;
                case CARD_COPPER:$this->load->model('card/model_card_copper', 'm_card');break;
            }

            $cartInfo = $this->getCartToCookie();
            $cData = $this->calculateDiscount($cartInfo);
p($cData);p($info);
            //单个卡检查是否可以使用
            $this->m_card->init($info, $cData['product']);
            $useStatus = $this->m_card->useCheck();

            if (!$useStatus) {
                $response = error(70025);
                break;
            }


//p($giftCard);
            $this->input->set_cookie('gift_card', authcode(json_encode($giftCard), 'ENCODE'), 3600);

            //$this->load->model('card/model_card', 'm_card');
            //$this->m_card->a();


        } while (false);

        $this->json_output($response);
    }
}
