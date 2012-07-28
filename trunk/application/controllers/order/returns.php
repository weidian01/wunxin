<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-7-29
 * Time: 上午5:38
 * To change this template use File | Settings | File Templates.
 */ 
class returns extends MY_Controller
{
    public function cancel()
    {
        $returnId = $this->input->get_post('return_id');

        $response = array('error' => '0', 'msg' => '取消退换货申请成功', 'code' => 'cancel_return_success');

        do {
            if (empty ($returnId) ) {
                $response = error(30017);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('order/Model_Order_Return', 'return');
            $status = $this->return->cancelReturnApply($returnId, $this->uInfo['uid']);
            if (!$status) {
                $response = error(30018);
                break;
            }
        } while (false);

        echo json_encode($response);
    }
}
