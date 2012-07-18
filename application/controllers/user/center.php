<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-7-18
 * Time: 上午9:24
 * To change this template use File | Settings | File Templates.
 */
class center extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->isLogin()) {
            return ;
        }

        if(! $this->input->is_ajax_request()){
            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }
    }

    public function index()
    {
        $this->load->model('order/Model_Order', 'order');
        $data = $this->order->getOrderByUid(1);
        //echo '<pre>';print_r($data);exit;

        $this->load->view('user/center', array('data' => $data));
    }
}
