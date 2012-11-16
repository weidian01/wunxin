<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-16
 * Time: 下午3:21
 * To change this template use File | Settings | File Templates.
 */
class coupon extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        if(! $this->input->is_ajax_request()){
            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }
    }

    //优惠卷首页
    public function index()
    {
        $this->load->view('coupon/index');
    }
}
