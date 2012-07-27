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
}
