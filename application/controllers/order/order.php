<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-7-6
 * Time: 下午4:19
 * To change this template use File | Settings | File Templates.
 */
class order extends MY_Controller
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

    /**
     * 订单确认
     *
     * @return mixed
     */
    public function index()
    {
        $referer = $this->input->server('HTTP_REFERER');
        $referer = empty ($referer) ? config_item('base_url') : $referer;

        if (!$this->isLogin()) {
            echo "<script type='text/javascript'>alert('用户未登陆！');window.location.href = '".$referer."'</script>";
            return ;
        }

        $cartInfo = $this->getCartToCookie();
//echo '<pre>';print_r($cartInfo);exit;
        if (empty ($cartInfo)) {
            echo "<script type='text/javascript'>alert('购物车为空！');window.location.href = '".$referer."'</script>";
            return ;
        }

        $totalPrice = 0;
        $totalNum = 0;
        foreach ($cartInfo as $cv) {
            $totalPrice += $cv['product_price'] * $cv['product_num'];
            $totalNum += $cv['product_num'];
        }

        $this->load->model('other/Model_Area', 'area');
        $provinceData = $this->area->getProvinceList();

        $this->load->model('user/Model_User_Recent', 'recent');
        $recentData = $this->recent->getUserRecentAddressByUid($this->uInfo['uid']);

        $data = array (
            'cart_info' => $cartInfo,
            'total_price' => $totalPrice,
            'total_num' => $totalNum,
            'province_data' => $provinceData,
            'recent_data' => $recentData,
        );
        $this->load->view('order/order_confirm', $data);
    }

    /**
     * 提交订单
     */
    public function submit()
    {
        $addressId = $this->input->get_post('address_id');
        $payType = $this->input->get_post('pay_type');
        $delivertTime = $this->input->get_post('delivert_time');
        $annotated = $this->input->get_post('annotated');
        $cartData = $this->getCartToCookie();

        $response = error(30013);

        do {
            if (empty ($addressId) || empty ($payType) || empty ($delivertTime)) {
                $response = error(30015);
                break;
            }

            //购物车如果为空，则跳转到购物车页面
            if ( empty ($cartData) ) {
                redirect('/cart/');
                return false;
            }

            //获取用户收货地址
            $this->load->model('user/Model_User_Recent', 'recent');
            $recentData = $this->recent->getUserDefaultRecentAddressByaId($addressId, $this->uInfo['uid']);
            if (empty ($recentData)) {
                $response = error(30016);
                break;
            }

            $this->load->model('product/Model_Product', 'product');
            $this->load->model('product/Model_Product_Color', 'color');

            $productTmpData = array();
            $totalPrice = 0;
            foreach ($cartData as $cv) {
                $productData = $this->product->getProductById($cv['pid']);
                $totalPrice += ($productData['sell_price'] * $cv['product_num']);
                $productTmpData[$productData['pid']] = $productData;

            }

            //$discount = $this->userDiscount($totalPrice);

            $data = array(
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'after_discount_price' => $totalPrice,
                'discount_rate' => $totalPrice,
                'before_discount_price' => $totalPrice,
                'pay_type' => $payType,
                'order_source' => '1',
                'delivert_time' => $delivertTime,
                'annotated' => $annotated,
                'invoice' => '',
                'paid' => '0',
                'need_pay' => $totalPrice,
                'ip' => $this->input->ip_address(),
                'address_id' => $addressId,
                'invoice_payable' => '',
                'invoice_content' => '',
                'recent_name' => $recentData['recent_name'],
                'recent_address' => $recentData['province'].' '.$recentData['city'].' '.$recentData['area'].' '.$recentData['detail_address'],
                'zipcode' => $recentData['zipcode'],
                'phone_num' => $recentData['phone_num'],
                'call_num' => $recentData['call_num'],
            );

            $this->load->model('order/Model_Order', 'order');
            $orderId = $this->order->addOrder($data);
            if (!$orderId) {
                $response = error(30014);
                break;
            }
            $response['order_sn'] = $orderId;



            foreach ($cartData as $v) {
                //$productData = $this->product->getProductById($v['pid']);
                $productData = $productTmpData[$v['pid']];
                $colorData = $this->color->getColorById($productData['color_id']);
//echo '<pre>';print_r($colorData);exit;
                $orderProductData [] = array (
                    'order_sn' => $orderId,
                    'pid' => $productData['pid'],
                    'uid' => $this->uInfo['uid'],
                    'uname' => $this->uInfo['uname'],
                    'pname' => $productData['pname'],
                    'market_price' => $productData['market_price'],
                    'sall_price' => $productData['sell_price'],
                    'product_num' => $v['product_num'],
                    'color' => $colorData['china_name'],
                    'product_size' => $v['product_size'],
                    'presentation_integral' => fPrice($productData['sell_price']),
                    'preferential' => '',
                    'warehouse'=> $productData['warehouse'],
                );

                $this->order->addOrderProduct($orderProductData, $orderId);
            }

            $this->input->set_cookie('cart_info', '', -100);

        } while (false);

        $this->json_output($response);
    }

    /**
     * 订单成功页面
     */
    public function success()
    {
        $orderSn = $this->uri->segment(4, 0);

        if (empty ($orderSn)) {
            show_error('参数不全');
        }

        $this->load->model('order/Model_Order', 'order');
        $data = $this->order->getOrderByOrderSn($orderSn);

        if (empty ($data)) {
            show_error('未知的订单');
        }

        $this->load->model('product/Model_Product', 'product');
        $recommend = $this->product->getProductList(9, 0, '*', array('status' => 1, 'check_status' => '1', 'shelves' => 1), 'sales desc');

        $this->load->view('order/success', array('order' => $data, 'recommend' => $recommend));
    }

    /**
     * 根据用户等级计算打折
     *
     * @param $price
     * @return int
     */
    private function userDiscount($price)
    {
        $p = $price;
        $discount = 1;

        switch($this->uInfo['lid']) {
            case '1' : $p = ($price * 1);  $discount = 1;break;
            case '2' : $p = ($price * 0.98); $discount = 0.98; break;
            case '3' : $p = ($price * 0.95); $discount = 0.95; break;
        }

        return array ('price' => $p, 'discount' => $discount);
    }

    /**
     * 取消订单
     */
    public function cancelOrder()
    {
        $orderSn = $this->input->get_post('order_sn');

        $response = array('error' => '0', 'msg' => '取消订单成功', 'code' => 'cancel_order_success');

        do {
            if ( empty ($orderSn) ) {
                $response = error(30026);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('order/Model_Order', 'order');
            $data = $this->order->getOrderByOrderSn($orderSn);
            if ( empty ($data) ) {
                $response = error(30022);
                break;
            }

            if ( $data['is_pay'] == '1' || in_array($data['picking_status'], array('1', '2') ) ) {
                $response = error(30027);
                break;
            }

            $status = $this->order->cancelOrder($orderSn, $this->uInfo['uid']);
            if ( !$status ) {
                $response = error(30028);
                break;
            }
        } while (false);

        self::json_output($response);
    }

    /**
     * 获取城市数据
     */
    public function getCity()
    {
        $id = $this->input->get_post('id');

        $response = error(99004);
        if (!empty ($id)) {
            $this->load->model('other/Model_Area', 'area');
            $response = error(99005);
            $response['data'] = $this->area->getCityList($id);
        }

        echo self::json_output($response);
    }

    /**
     * 获取地址数据
     */
    public function getArea()
    {
        $id = $this->input->get_post('id');

        $response = error(99004);
        if (!empty ($id)) {
            $this->load->model('other/Model_Area', 'area');
            $response = error(99005);
            $response['data'] = $this->area->getAreaList($id);
        }

        echo self::json_output($response);
    }

    /**
     * 获取一个收货地址
     *
     * @return bool
     */
    public function getOneAddress()
    {
        $aId = $this->input->get_post('address_id');

        if (!$this->isLogin()) {
            return false;
        }

        $this->load->model('user/Model_User_Recent', 'recent');
        $data = $this->recent->getUserRecentAddressByAid($aId, $this->uInfo['uid']);

        $this->json_output($data);
    }

    /**
     * 保存地址信息
     */
    public function saveAddress()
    {
        $data['recent_name'] = $this->input->get_post('recent_name');
        $data['province'] = $this->input->get_post('province');
        $data['city'] = $this->input->get_post('city');
        $data['area'] = $this->input->get_post('area');
        $data['detail_address'] = $this->input->get_post('detail_address');
        $data['phone_num'] = $this->input->get_post('phone_num');
        $data['call_num'] = $this->input->get_post('area_num').'-'.$this->input->get_post('call_num');
        $data['email'] = $this->input->get_post('email');
        $data['zipcode'] = $this->input->get_post('post_code');
        $addressId = $this->input->get_post('address_id');

        $response = error(30009);

        do {
            if (empty ($data['recent_name']) || empty ($data['province']) || empty ($data['city']) || empty ($data['area']) || empty ($data['detail_address']) || empty ($data['phone_num'])) {
                $response = error(30011);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $data['uid'] = $this->uInfo['uid'];
            $data['uname'] = $this->uInfo['uname'];
            $data['country'] = '中国';
            $data['default_address'] = 1;
            $this->load->model('user/Model_User_Recent', 'recent');

            if ($addressId) {
                $status = $this->recent->editRecentAddress($addressId, $data);
                if (!$status) {
                    $response = error(30012);
                    break;
                }
            } else {
                $status = $this->recent->addUserRecipientAddress($data);
                if (!$status) {
                    $response = error(30010);
                    break;
                }
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 删除收货地址
     *
     * @return bool
     */
    public function deleteAddress()
    {
        $aId = $this->input->get_post('address_id');

        $this->load->model('user/Model_User_Recent', 'recent');

        if (!$this->isLogin()) {
            return false;
        }

        $this->recent->deleteUserRecentAddress($aId, $this->uInfo['uid']);
    }
}

