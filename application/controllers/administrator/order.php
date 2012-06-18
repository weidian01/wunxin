<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-11
 * Time: 下午2:18
 * To change this template use File | Settings | File Templates.
 */
class order extends MY_Controller
{
    public $searchType = array(
            1 => '订单ID',
            2 => '用户ID',
        );

    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    /**
     * 订单列表
     */
    public function orderList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('order/Model_Order', 'order');
        $totalNum = $this->order->getOrderCount();
        $data = $this->order->getOrderList($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/order/orderList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/order/order_list', array('data' => $data, 'page_html' => $pageHtml, 'searchType' => $this->searchType));
    }

    public function search()
    {
        $keyword = $this->input->get_post('keyword');
        $sType = $this->input->get_post('s_type');

        $this->load->model('order/Model_Order', 'order');
        switch ($sType) {
            case 1:
                $data = $this->order->getOrderByOrderSn($keyword);
                $orderData[] = $data;
                break;
            case 2:
                $orderData = $this->order->getOrderByUid($keyword);
                break;
            default:
                $data = $this->order->getOrderByOrderSn($keyword);
                $orderData[] = $data;
        }

        $this->load->view('/administrator/order/order_list', array('data' => $orderData, 'searchType' => $this->searchType, 'keyword' => $keyword, 'sType' => $sType));
    }

    /**
     * 订单详情
     */
    public function orderDetail()
    {
        $orderSn = $this->uri->segment(4, 0);

        $this->load->model('order/Model_Order', 'order');
        $this->load->model('order/Model_Order_Invoice', 'invoice');


        $oInfo = $this->order->getOrderAllInfoByOrderSn($orderSn);

        $this->load->view('/administrator/order/order_detail', array('data' => $oInfo));
    }

    /**
     * 订单编辑
     */
    public function orderDelete()
    {
        $orderSn = $this->uri->segment(4, 0);

        if (!$orderSn) {
            show_error('订单ID为空');
        }

        $this->load->model('order/Model_Order', 'order');
        $oInfo = $this->order->deleteOrderByOrderSn($orderSn);

        redirect('/administrator/order/orderList');
        //$this->load->view('/administrator/order/order_edit', array('data' => $oInfo));
    }
}
