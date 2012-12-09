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
        $where = array();
        $tmp = $this->input->get('status');
        if(is_numeric($tmp))
            $where['status'] = $tmp;

        $tmp = $this->input->get('picking_status');
        if(is_numeric($tmp))
            $where['picking_status'] = $tmp;

        $tmp = $this->input->get('is_pay');
        if(is_numeric($tmp))
            $where['is_pay'] = $tmp;

        $tmp = $this->input->get('parent_id');
        if ($tmp !== false && $tmp !== '') {
            if ($tmp == 'child') {
                $where['parent_id >'] = 0;
            } else {
                $where['parent_id'] = $tmp;
            }
        }

        $this->load->model('order/Model_Order', 'order');
        $totalNum = $this->order->getOrderCount($where);
        $data = $this->order->getOrderList($Limit, $offset, $where);
        $pageHtml = '';
        if (isset($where['parent_id >'])) {
            $where['parent_id'] = $tmp;
            unset($where['parent_id >']);
        }
        if ($totalNum > $Limit) { //页数不足一页
            $this->load->library('pagination');
            $config['base_url'] = site_url('/administrator/order/orderList/');
            $where && $config['suffix'] = ('?' . http_build_query($where));
            $config['total_rows'] = $totalNum;
            $config['per_page'] = $Limit;
            $config['num_links'] = 10;
            $config['uri_segment'] = 4;
            $config['use_page_numbers'] = TRUE;
            $config['anchor_class'] = 'class="number"';
            $this->pagination->initialize($config);
            $pageHtml = $this->pagination->create_links();
        }

        $this->load->view('/administrator/order/order_list',
            array('data' => $data,
                'page_html' => $pageHtml,
                'searchType' => $this->searchType,
                'where' => $where
            )
        );

    }

    public function search()
    {
        $keyword = $this->input->get_post('keyword');
        $sType = $this->input->get_post('s_type');

        $this->load->model('order/Model_Order', 'order');
        $orderData = array();
        switch ($sType) {
            case 2:
                $keyword && $orderData = $this->order->getOrderByUid($keyword);
                break;
            case 1:
            default:
                $keyword && $orderData[] = $this->order->getOrderByOrderSn($keyword);
        }
        $this->load->view('/administrator/order/order_list', array('data' => $orderData, 'searchType' => $this->searchType, 'keyword' => $keyword, 'sType' => $sType));
    }

    /**
     * 订单详情
     */
    public function orderDetail()
    {
        $orderSn = $this->uri->segment(4, 0);
        if (!$orderSn) {
            show_error('订单ID为空');
        }

        $this->load->model('order/Model_Order', 'order');
        $this->load->model('order/Model_Order_Invoice', 'invoice');
        $this->load->model('order/Model_Order_Receiver', 'receiver');
        $this->load->model('order/Model_Order_Return', 'return');
        $this->load->model('order/Model_Order_Picking', 'picking');
        $this->load->model('user/Model_User', 'user');
        $this->load->model('order/Model_Order_Express', 'express');

        $oInfo = $this->order->getOrderAllInfoByOrderSn($orderSn); //获取订单信息
        $rInfo = $this->receiver->getReceiverByOrderSn($orderSn); //获取收货单信息
        $returnInfo = $this->return->getReturnByOrderSn($orderSn); //获取退换货信息
        $pInfo = $this->express->getPickingAndExpressCompanyByOrderSn($orderSn); //获取配货信息
        $uInfo = $this->user->getUserById($oInfo['uid']);

        $this->load->model('order/Model_Order_Express', 'express');
        $express = $this->express->getExpressCompany(100, 0);

        //echo '<pre>';print_r($oInfo);exit;

        $data = array(
            'data' => $oInfo,
            'receivable' => $rInfo,
            'return' => $returnInfo,
            'picking' => $pInfo,
            'userInfo' => $uInfo,
            'express' => $express,
        );

        $this->load->view('/administrator/order/order_detail', $data);
    }

    public function receivableList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('order/Model_Order_Receiver', 'receiver');
        $totalNum = $this->receiver->getReceiverCount();
        $data = $this->receiver->getReceiverList($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/order/receivableList/';
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

    /**
     * 系统确认订单,锁定该订单,用户不可取消
     */
    public function locking()
    {
        $order_sn = $this->input->get_post('order_sn');
        $this->db->update('order', array('status'=>ORDER_CONFIRM/*确认订单*/), array('order_sn' => $order_sn, 'is_pay'=>ORDER_PAY_SUCC/*支付成功*/, 'status'=>ORDER_NORMAL/*未确认订单*/));
        $flag = $this->db->affected_rows();
        self::json_output(array('error'=>$flag));
    }

    /**
     * 拆分订单,根据订单产品所在不同来源拆分成多个订单
     */
    public function split()
    {
        $order_sn = $this->input->get_post('order_sn');
        $this->load->model('order/Model_Order', 'order');
        $field = "pid,uid,uname,pname,market_price,sell_price,final_price,product_num,comment_status,share_status,product_size,color,presentation_integral,preferential,warehouse,ext";
        $order_product = $this->order->getOrderAllProductByOrderSn($order_sn, $field);
        if(!$order_product)
        {
            self::json_output(array('error'=>'订单下无产品'));//订单下无产品
            die;
        }

        $field = "parent_id,address_id,uid,uname,after_discount_price,discount_rate,before_discount_price,pay_type,defray_type,is_pay,order_source,pay_time,delivert_time,
        annotated,invoice,paid,need_pay,ip,invoice_payable,invoice_content,recent_name,recent_address,zipcode,phone_num,call_num,picking_status,status,is_print_price";
        $order_info = $this->order->getOrderByOrderSn($order_sn, $field);
        if($order_info['parent_id'] != 0)
        {
            self::json_output(array('error'=>'不可拆单'));//无法再次拆分订单
            die;
        }
        if($order_info['is_pay'] != ORDER_PAY_SUCC)
        {
            self::json_output(array('error'=>'订单未支付'));//未支付无法拆单
            die;
        }
        if($order_info['status'] != ORDER_CONFIRM)
        {
            self::json_output(array('error'=>'订单未确认'));//未确认无法拆单
            die;
        }

        //echo '<pre>';print_r($order_info);
        $split_order_product = array();
        foreach($order_product as $item)
        {
            if(isset($split_order_product[$item['warehouse']]['price']))
            {
                $split_order_product[$item['warehouse']]['price'] += $item['final_price'];
            }
            else
            {
                $split_order_product[$item['warehouse']]['price'] = $item['final_price'];
            }
            $split_order_product[$item['warehouse']]['products'][] = $item;
        }

        if(count($split_order_product) === 1)//如果产品只出自一个仓库则不用拆分订单
        {
            $this->db->update('order', array('parent_id' => $order_sn), array('order_sn' => $order_sn, 'parent_id' => 0, 'is_pay' => ORDER_PAY_SUCC, 'status' => ORDER_CONFIRM));
        }
        else
        {
            $this->db->update('order', array('parent_id' => -1), array('order_sn' => $order_sn, 'parent_id' => 0, 'is_pay' => ORDER_PAY_SUCC, 'status' => ORDER_CONFIRM));
            foreach($split_order_product as $item)
            {
                $order_info['parent_id'] = $order_sn;
                $order_info['before_discount_price'] = $item['price'];
                //print_r($order_info);
                $this->order->addOrderAndProduct($order_info, $item['products']);
            }
        }
        self::json_output(array('error'=>0));//未确认无法支付
        die;
    }
}
