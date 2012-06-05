<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class product_comment extends MY_Controller
{
    public function postProductComment()
    {
        $uid = $this->input->get_post('uid');
        $pid = $this->input->get_post('pid');
        $title = $this->input->get_post('title');
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();
        $rank = $this->input->get_post('rank');

        $this->load->model('order/Model_order', 'order');
        $this->order->userIsBuyProduct(1, 1);
    }
}
