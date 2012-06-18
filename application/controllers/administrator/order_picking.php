<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-18
 * Time: 下午4:34
 * To change this template use File | Settings | File Templates.
 */
class order_picking extends MY_Controller
{
    public $searchType = array(
        1 => '配货单ID',
        2 => '订单ID',
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
     * 配货单列表
     */
    public function pickingList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('order/Model_Order_Picking', 'picking');
        $totalNum = $this->picking->getPickingCount();
        $data = $this->picking->getPicking($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/order_picking/pickingList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/order/picking/picking_list', array('data' => $data, 'page_html' => $pageHtml, 'searchType' => $this->searchType));
    }

    /**
     * 订单配货单列表
     */
    public function orderPickingList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;
        $orderSn = $this->uri->segment(4, 0);

        if (!$orderSn) {
            show_error('订单ID为空');
        }

        $this->load->model('order/Model_Order_Picking', 'picking');
        $totalNum = $this->picking->getPickingCountByOrderSn($orderSn);
        $data = $this->receiver->getPickingByOrderSn($orderSn, $Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/order_picking/orderPickingList/' . $orderSn;
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/order/picking/picking_list', array('data' => $data, 'page_html' => $pageHtml, 'searchType' => $this->searchType));
    }

    public function pickingDetail()
    {
        $pickingId = $this->uri->segment(4, 0);

        if (!$pickingId) {
            show_error('配货ID为空');
        }

        $this->load->model('order/Model_Order_Picking', 'picking');
        $pData = $this->picking->getPickingByPid($pickingId);

        $productData = $this->picking->getPickingProductInfoByPid($pickingId);
        //echo '<pre>';print_r($productData);exit;

        $this->load->view('/administrator/order/picking/picking_detail', array('data' => $pData, 'product_data' => $productData, 'searchType' => $this->searchType));
    }

    public function search()
    {
        $keyword = $this->input->get_post('keyword');
        $sType = $this->input->get_post('s_type');

        $this->load->model('order/Model_Order_Picking', 'picking');
        switch ($sType) {
            case 1:
                $data = $this->picking->getPickingByPid($keyword);
                $rData[] = $data;
                break;
            case 2:
                $rData = $this->picking->getPickingByOrderSn($keyword, 10000);
                break;
            default:
                $data = $this->picking->getPickingByPid($keyword);
                $rData[] = $data;
        }

        $this->load->view('/administrator/order/picking/picking_list', array('data' => $rData, 'searchType' => $this->searchType, 'keyword' => $keyword, 'sType' => $sType));
    }
}
