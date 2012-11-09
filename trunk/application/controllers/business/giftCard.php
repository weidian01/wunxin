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
            //var_dump($this->card->cardVerify($cardNo, $cardPassword));exit;
            if (!$this->card->cardVerify($cardNo, $cardPassword)) {
                $response = error(70001);
                break;
            }

            if (!$this->card->cardIsBanding($cardNo)) {
                $response = error(70004);
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
     * 使用卡
     */
    public function useCard()
    {
        $cardNo = $this->input->get_post('card_number');
        $cardPassword = $this->input->get_post('card_password');

        $response = array('error' => '0', 'msg' => '使用礼物卡成功', 'code' => 'use_gift_card_success');

        do {
            if (empty ($cardNo) || empty ($cardPassword)) {
                $response = error(70015);
                break;
            }

            //是否登陆
            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('business/Model_Gift_Card', 'card');

            //卡是否存在
            $cardInfo = $this->card->getCardInfoByCid($cardNo);
            if (empty ($cardInfo)) {
                $response = error(70017);
                break;
            }

            //判断有效期
            if ($cardInfo['end_time'] < date('Y-m-d H:i:s', TIMESTAMP)) {
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

            //卡密码错误
            $verify = $this->card->cardVerify($cardNo, $cardPassword);
            if (!$verify) {
                $response = error(70020);
                break;
            }

            $cData['cart'] = $this->getCartToCookie();
            $data = $this->calculateDiscount($cData['cart']);
            if (empty ($data['product'])) {
                $response = error(60001);
                break;
            }

            $total_price = 0;
            foreach ($data['product'] as $k=>$v) {
                $total_price += $v['final_price'] * $v['num'];
            }

            if ($total_price < $cardInfo['card_amount']) {
                $cardBalance = $cardInfo['card_amount'] - $total_price;
                //$this->card->
            } else {

            }
        } while (false);
    }
}
