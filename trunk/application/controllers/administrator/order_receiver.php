<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-18
 * Time: 下午3:31
 * To change this template use File | Settings | File Templates.
 */
class order_receiver extends MY_Controller
{
    public $searchType = array(
        1 => '收款单ID',
        2 => '用户ID',
        3 => '订单ID',
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
     * 收款单列表
     */
    public function receivableList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('order/Model_Order_Receiver', 'receiver');
        $totalNum = $this->receiver->getReceiverCount();
        $data = $this->receiver->getReceiverList($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/order_receiver/receivableList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/order/receiver/receiver_list', array('data' => $data, 'page_html' => $pageHtml, 'searchType' => $this->searchType));
    }

    /**
     * 某个订单收款列表
     */
    public function orderReceiverList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;
        $orderSn = $this->uri->segment(4, 1);

        $this->load->model('order/Model_Order_Receiver', 'receiver');
        $totalNum = $this->receiver->getOrderSnReceiverCount($orderSn);
        $data = $this->receiver->getReceiverByOrderSn($orderSn, $Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/order_receiver/orderReceiverList/' . $orderSn;
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/order/receiver/receiver_list', array('data' => $data, 'page_html' => $pageHtml, 'searchType' => $this->searchType));
    }

    /**
     * 某个用户收款单列表
     */
    public function userReceiverList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;
        $uId = $this->uri->segment(4, 1);

        $this->load->model('order/Model_Order_Receiver', 'receiver');
        $totalNum = $this->receiver->getUserReceiverCount($uId);
        $data = $this->receiver->getReceiverByuId($uId, $Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/order_receiver/userReceiverList/' . $uId;
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/order/receiver/receiver_list', array('data' => $data, 'page_html' => $pageHtml, 'searchType' => $this->searchType));
    }

    public function search()
    {
        $keyword = $this->input->get_post('keyword');
        $sType = $this->input->get_post('s_type');

        $this->load->model('order/Model_Order_Receiver', 'receiver');
        switch ($sType) {
            case 1:
                $data = $this->receiver->getReceiverById($keyword);
                $rData[] = $data;
                break;
            case 2:
                $rData = $this->receiver->getReceiverByuId($keyword, 10000);
                break;
            case 3:
                $rData = $this->receiver->getReceiverByOrderSn($keyword, 10000);
                break;
            default:
                $data = $this->receiver->getReceiverById($keyword);
                $rData[] = $data;
        }

        $this->load->view('/administrator/order/receiver/receiver_list', array('data' => $rData, 'searchType' => $this->searchType, 'keyword' => $keyword, 'sType' => $sType));
    }
}
//echo '<pre>';print_r($data);exit;