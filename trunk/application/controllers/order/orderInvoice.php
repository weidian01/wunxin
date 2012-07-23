<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午7:02
 * To change this template use File | Settings | File Templates.
 */
class orderInvoice extends MY_Controller
{
    /**
     * 添加发票
     */
    public function addInvoice()
    {
        $payable = trim($this->input->get_post('invoice_payable'));
        $content = trim($this->input->get_post('invoice_content'));

        $response = error(30002);

        do {
            if (empty ($invoicePayable) || empty ($invoice_content)) {
                $response = error(30004);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }
            $this->load->model('user/Model_Order_Invoice', 'invoice');
            $status = $this->invoice->addOrderInvoice($this->uInfo['uid'], $payable, $content);
            if (!$status) {
                $response = error(30003);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 编码发票 -- 暂时功能未实现
     */
    public function editInvoice()
    {
        $iId = intval($this->input->get_post('invoice_id'));
        $uId = intval($this->input->get_post('uid'));

        if (empty ($iId) || empty ($uId)) {
            show_error('参数不全!');
        }

        if (!$this->isLogin()) {
            $response = error(10009);
        }
    }

    /**
     * 删除发票
     */
    public function deleteInvoice()
    {
        $iId = intval($this->input->get_post('invoice_id'));
        //$uId = intval($this->input->get_post('uid'));

        $response = error(30006);

        do {
            if (empty ($iId)) {
                $response = error(30008);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }
/*
            if ($uId != $this->uInfo['uid']) {
                $response = error(99999);
                break;
            }
*/
            $this->load->model('order/Model_Order_Invoice', 'invoice');
            $status = $this->invoice->deleteInvoice($iId, $this->uInfo['uid']);
            //var_dump($status);
            if (!$status) {
                $response = error(30007);
                break;
            }
        } while (false);

        $this->json_output($response);
    }
}
