<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午10:13
 * To change this template use File | Settings | File Templates.
 */
class mailSubscription extends MY_Controller
{
    /**
     * 订阅邮件列表
     */
    public function subscribe()
    {
        $mailAddress = $this->input->get_post('mail_address');
        $getInfoType = $this->input->get_post('get_info_type');

        if (empty ($mailAddress) || empty ($getInfoType)) {

            $response = error(70001);

            if ($this->isLogin()) {
                $data = array(
                    'uid' => $this->uInfo['uid'],
                    'email_addr' => $mailAddress,
                    'get_info_type' => $getInfoType,
                );
            } else {
                $data = array(
                    'uid' => '',
                    'email_addr' => $mailAddress,
                    'get_info_type' => $getInfoType,
                );
            }

            $this->load->model('business/Model_Mail_Subscription', 'mail');
            $status = $this->mail->subscribe($data);
            if (!$status) {
                $response = error(70006);
            }
        } else {
            $response = error(70007);
        }

        $this->json_output($response);
    }

    /**
     * 退订邮件列表
     */
    public function unSubscribe()
    {
        $mailAddress = $this->input->get_post('mail_address');

        if (empty ($mailAddress)) {
            $response = error(70010);
        } else {
            $response = error(70008);
            $this->load->model('business/Model_Mail_Subscription', 'mail');
            $status = $this->mail->unSubscribe($mailAddress);
            if (!$status) {
                $response = error(70009);
            }
        }

        $this->json_output($response);
    }
}
