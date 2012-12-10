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
        if($cartInfo)
        {
            /****************校验购物车内产品开始*****************/
            $this->load->model('product/Model_Product', 'product');
            $order_pids = array();
            foreach($cartInfo as $item)
            {
                $order_pids[] = $item['pid'];
            }
            $productTmpData = $this->product->getProductById($order_pids, array('pid'=>'pid, pname, uid, uname, brand_id, color_id, market_price, sell_price, warehouse'), array('status'=>1));
            //p($productTmpData);
            foreach($cartInfo as $key => $item)
            {
                if(!isset($productTmpData[$item['pid']]))
                {   //清除购物车内不合法产品
                    unset($cartInfo[$key]);
                }
                else
                {   //设置金额
                    $cartInfo[$key]['product_price'] = $productTmpData[$item['pid']]['sell_price'];
                }
            }
            //p($cData);die;
            /****************校验购物车内产品结束*****************/
        }
        if (empty ($cartInfo)) {
            echo "<script type='text/javascript'>alert('购物车为空！');window.location.href = '".$referer."'</script>";
            return ;
        }

        $this->load->model('other/Model_Area', 'area');
        $provinceData = $this->area->getProvinceList();

        $this->load->model('user/Model_User_Recent', 'recent');
        $recentData = $this->recent->getUserRecentAddressByUid($this->uInfo['uid']);

        //计算活动价格
        $cData = $this->calculateDiscount($cartInfo);//p($cData['products']);
        //p($cData);
        $this->load->model('business/Model_gift_card_model', 'model');
        $cardModel = $this->model->getCardModelList(200);

        $this->load->model('business/Model_gift_card', 'card');
        $userCard = $this->card->getUserCard($this->uInfo['uid'], 100, 0, array('card_amount >' => 0));

        //礼品卡处理
        $giftCard = $this->getUseCard();

        //p($cardModel);exit;
        //p($cData);
        $data = array (
            'cart_info' => $cData,
            'province_data' => $provinceData,
            'recent_data' => $recentData,
            'gift_card' => $giftCard,
            'card_model' => $cardModel,
            'user_card' => $userCard,
            'need_use_card' => $this->getUseCard(),
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
        $isPrintPrice = $this->input->get_post('is_print_price');
        $cartData = $this->getCartToCookie();

        $response = array('error' => '0', 'msg' => '添加订单成功', 'code' => 'add_order_success');

        do {
            if (empty ($addressId) || empty ($payType) || empty ($delivertTime)) {
                $response = error(30015);
                break;
            }

            //购物车如果为空，则跳转到购物车页面
            if ( empty ($cartData) ) {
                $response = error(60001);
                break;
            }

            //获取用户收货地址
            $this->load->model('user/Model_User_Recent', 'recent');
            $recentData = $this->recent->getUserDefaultRecentAddressByaId($addressId, $this->uInfo['uid']);
            if (empty ($recentData)) {
                $response = error(30016);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('product/Model_Product', 'product');
            $this->load->model('product/Model_Product_Color', 'color');
            //p($cartData);
            /****************校验购物车内产品开始*****************/
            $order_pids = array();
            foreach($cartData as $item)
            {
                $order_pids[] = $item['pid'];
            }
            $productTmpData = $this->product->getProductById($order_pids, array('pid'=>'pid, pname, uid, uname, brand_id, color_id, market_price, sell_price, warehouse'), array('status'=>1));
            //p($productTmpData);
            foreach($cartData as $key => $item)
            {
                if(!isset($productTmpData[$item['pid']]))
                {   //清除购物车内不合法产品
                    unset($cartData[$key]);
                }
                else
                {   //设置金额
                    $cartData[$key]['product_price'] = $productTmpData[$item['pid']]['sell_price'];
                }
            }
            //购物车如果为空，则跳转到购物车页面
            if ( empty ($cartData) ) {
                $response = error(60001);
                break;
            }
            //p($cartData);die;
            /****************校验购物车内产品结束*****************/
            $cdData = $this->calculateDiscount($cartData);
            //p($cdData);die;
            //$productTmpData = array();
            $totalPrice = $cdData['total_price'];
//            foreach ($cdData['products'] as $cv) {
//                $productData = $this->product->getProductById($cv['pid']);
//                $productTmpData[$productData['pid']] = $productData;
//
//            }
            //p($productTmpData);die;
            //p($cdData);exit;
            //$discount = $this->userDiscount($totalPrice);

            $data = array(
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'after_discount_price' => $cdData['cost_price'],
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
                'is_print_price' => $isPrintPrice,
            );

            $this->load->model('order/Model_Order', 'order');
            $orderId = $this->order->addOrder($data);
            if (!$orderId) {
                $response = error(30014);
                break;
            }
            $response['order_sn'] = $orderId;

            foreach ($cdData['products'] as $v) {
                if(isset($productTmpData[$v['pid']]))
                {
                    $productData = $productTmpData[$v['pid']];
                    $colorData = $this->color->getColorById($productData['color_id']);

                    $orderProductData[] = array (
                        'order_sn' => $orderId,
                        'pid' => $productData['pid'],
                        'uid' => $this->uInfo['uid'],
                        'uname' => $this->uInfo['uname'],
                        'pname' => $productData['pname'],
                        'market_price' => $productData['market_price'],
                        'sell_price' => $productData['sell_price'],
                        'final_price' => $v['final_price'],
                        'product_num' => $v['num'],
                        'color' => $colorData['china_name'],
                        'product_size' => $v['product_size'],
                        'presentation_integral' => fPrice($productData['sell_price']),
                        'preferential' => '',
                        'ext' => $v['promotion_id'].'-'.$v['promotion_name'],
                        'warehouse'=> $productData['warehouse'],
                    );
                }
            }

            $this->order->addOrderProduct($orderProductData, $orderId);

            //获取订单产品 -- 活动处理后的价格
            $cartData = $this->getCartToCookie();
            $cartDataNeedProcess = $this->calculateDiscount($cartData);

            //消费卡
            $orderInfo = $this->order->getOrderByOrderSn($orderId);
            $cardList = $this->getUseCard();
            $this->load->model('card/model_card', 'card');

            //p($cardList);p($this->uInfo['uid']);p($orderInfo);exit;

            $this->card->consume($cardList, $this->uInfo['uid'], $orderInfo, $cartDataNeedProcess['products']);//($cards, $uid, $order)

            //清除购物车，活动，礼品卡
            //$cInfo = array('pid' => '','pname' => '','product_price' => '','product_num' => '','product_size' => '','additional_info' => '',);
            //$pData = array('promotion_id' => array('promotion_id' => 1),);

            //$this->setCartToCookie($cInfo, -100);
            //$this->setPromotion($pData, true, -100);
            //$this->setUseCard(array(), -100);

            $this->input->set_cookie('gift_card', '', -100);
            $this->input->set_cookie('cart_info', '', -100);
            $this->input->set_cookie('promotion', '', -100);

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
        $recommend = $this->product->getProductList(12, 0, '*', array('status' => 1, 'check_status' => '1', 'shelves' => 1), 'sales desc');

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
     * 处理礼品卡
     *
     * @return array
     */
    private function giftCard()
    {
        $giftCard = $this->input->cookie(config_item('cookie_prefix').'gift_card');
        $giftCard = json_decode(authcode($giftCard, 'DECODE'), true);

        if (empty ($giftCard)) $giftCard = array();

        $returnData = array();
        $totalPrice = 0;
        foreach ($giftCard as $v) {
            $totalPrice += $v['card_amount'];

            $returnData['card_list'][] = $v;
        }

        $returnData['total_price'] = $totalPrice;

        return $returnData;
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

    /**
     * 系统取消过期未支付的订单
     */
    public function systemCancelOrder()
    {
        $this->load->model('order/Model_Order', 'order');
        $this->load->model('product/model_product', 'product');

        $typeArray = array(PAY_ONLINE, PAY_CASHDELIVERY, PAY_POST, PAY_SELF, PAY_COMPANY);//支付类型,1 在线支付， 2 货到付款， 3 邮政汇款 ，4 来万象自提， 5 公司汇款
        foreach ($typeArray as $v) {
            switch ($v) {
                case PAY_ONLINE:$timeOut = TIME_OUT_PAY_ONLINE;break;//在线支付超时时间，1天。
                case PAY_CASHDELIVERY:$timeOut = TIME_OUT_PAY_CASHDELIVERY;break;//货到付款超时时间，14天。
                case PAY_POST:$timeOut = TIME_OUT_PAY_POST;break;//邮政支付超时时间，3天。
                case PAY_SELF:$timeOut = TIME_OUT_PAY_SELF;break;//来万象自提超时时间，7天。
                case PAY_COMPANY:$timeOut = TIME_OUT_PAY_COMPANY;break;//来万象自提超时时间，1天。
                default :$timeOut = TIME_OUT_PAY_ONLINE;//在线支付超时时间，1天。
            }

            //获取超时订单
            $where = array(
                'pay_type' => $v,
                'create_time <=' => date('Y-m-d H:i:s', TIMESTAMP - $timeOut),
            );

            $timeOutOrder = $this->order->getExpiredOrder(100, 0, '*', $where);

            foreach ($timeOutOrder as $tov) {
                $updateWhere = array(
                    'pay_type' => $v,
                    'order_sn' => $tov['order_sn'],
                );

                if (empty ($tov['order_sn'])) { continue; }

                $cancelOrderStatus = $this->order->cancelOrderBySystem($updateWhere);
                log_message('CANCEL_ORDER', $tov['order_sn'].'-'.$v);
                /*/更新产品库存
                if ($cancelOrderStatus) {
                    $orderProduct = $this->order->getOrderAllProductByOrderSn($tov['order_sn']);

                    foreach ($orderProduct as $opv) {
                        $pid = intval($opv['pid']);
                        $pNum = intval($opv['product_num']);

                        if (!$pid || !$pNum) { continue; }

                        //$this->product->updateProductStock($pid, $pNum);
                    }
                }
                //*/
            }
        }
    }
}

