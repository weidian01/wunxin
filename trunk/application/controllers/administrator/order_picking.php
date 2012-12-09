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
        if(! $keyword)
        {
            redirect('administrator/order_picking/pickingList');
        }

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

    /**
     * 创建配货单
     */
    public function create()
    {
        $order_sn = $this->input->get_post('order_sn');
        $this->load->model('order/Model_Order', 'order');
        $order_info = $this->order->getOrderByOrderSn($order_sn, 'order_sn, address_id, picking_status, defray_type');

        if (!$order_info) {
            self::json_output(array("error" => 1, 'msg' => '订单不存在'));
        }

        if ($order_info['picking_status'] > 0) {
            self::json_output(array("error" => 3, 'msg' => '不可重复配货'));
        }

        $defrayType = $order_info['defray_type'];
        unset($order_info['picking_status']);
        unset($order_info['defray_type']);
        $order_info['ed_id'] = $this->input->post('ed_id');
        $order_info['logistics_orders_sn'] = $this->input->post('logistics_orders_sn');
        $order_info['descr'] = $this->input->post('descr');
        $order_info['status'] = 1;
        $order_product = $this->order->getOrderAllProductByOrderSn($order_sn, "`pid`,`pname`,`product_num`");
        if(!$order_product)
        {
            self::json_output(array("error"=>2,'msg'=>'订单内无产品'));
        }

        $this->load->model('order/Model_Order_Picking', 'picking');
        $pickingId = $this->picking->create($order_info, $order_product, $this->amInfo['am_uid']);

        //如果是通过支付宝支付的订单，即调用接口进行确认发货操作。
        if ($defrayType == 'alipay') {
            $this->load->model('order/model_order_receiver', 'receiver');
            $receiverData = $this->receiver->getReceiverByOrderSn($order_sn);

            $alipayOrderSn = explode('-', $receiverData[0]['extended_information']);
            //echo '<pre>';print_r($alipayOrderSn);exit;
            $alipayOrderSn = $alipayOrderSn[1];

            $logisticsName = '申通';
            if (!empty ($order_info['ed_id'])) {
                $this->load->model('order/Model_Order_express', 'express');
                $expressInfo = $this->express->getExpressCompanyById($order_info['ed_id']);

                if (!empty ($expressInfo['name'])) {
                    $logisticsName = $expressInfo['name'];
                }
            }

            $this->load->model('pay/Model_Pay_Alipay', 'alipay');
            $xmlDoc = $this->alipay->confirmSendGood($alipayOrderSn, $logisticsName, $order_info['logistics_orders_sn']);

            $doc = new DOMDocument();
            $doc->loadXML($xmlDoc);

            $response = '';
            if( ! empty($doc->getElementsByTagName( "is_success" )->item(0)->nodeValue) ) {
            	$response= $doc->getElementsByTagName( "is_success" )->item(0)->nodeValue;
            }

            $this->picking->updatePicking(array('ext' => $response), $pickingId);

            $xmlDoc = str_replace(array("\n", "\r"), array('', ''), $xmlDoc);
            log_message('CONFIRM_SEND_GOODS', $xmlDoc);
            /*
            $response = '';
            if( ! empty($doc->getElementsByTagName( "response" )->item(0)->nodeValue) ) {
            	$response= $doc->getElementsByTagName( "response" )->item(0)->nodeValue;
            }
            //*/


            //echo $response;

            //echo $url;exit;
        }

        self::json_output(array("error"=>0));  //正常
    }

    /**
     * 完成配货但
     */
    public function complete()
    {
        $picking_id = $this->input->get_post('picking_id');
        $this->load->model('order/Model_Order_Picking', 'picking');
        $info = $this->picking->getPickingByPid($picking_id);
        if(!$info)
        {
            self::json_output(array("error"=>2,'msg'=>'配货单不存在'));
        }
        $this->db->update('picking', array('status'=>2), array('picking_id'=>$picking_id, 'status'=>1));
        $this->db->update('order', array('picking_status'=>2), array('order_sn'=>$info['order_sn'], 'picking_status'=>1));
        self::json_output(array("error"=>0));  //正常
    }
}
