<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class cart extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        if(! $this->input->is_ajax_request()){
            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }
    }

    /**
     * 购物车首页
     */
    public function index()
    {
        $this->load->model('product/Model_Product', 'product');
        //($limit = 20, $offset = 0, $field= "*", $where = null, $order = null)
        $salesRecommend = $this->product->getProductList(12, 0, 'pid,pname,market_price,sell_price', array('status' => 1, 'shelves' => 1), 'sales desc');

        $favoriteRecommend = $this->product->getProductList(12, 0, 'pid,pname,market_price,sell_price', array('status' => 1, 'shelves' => 1), 'favorite_num desc');

        $this->load->view('cart/index', array('sales' => $salesRecommend, 'favorite' => $favoriteRecommend));
    }

    /**
     * 使用促销活动
     */
    public function usePromotion()
    {
        $promotionId = intval($this->input->get_post('promotion_id'));

        $response = array('error' => '0', 'msg' => '使用活动成功', 'code' => 'use_promotion_success');

        do {
            if (!$promotionId) {
                $response = error(60020);
                break;
            }

            $this->load->model('promotion/model_promotion', 'promotion');
            $promotionData = $this->promotion->is_promotion($promotionId);
            if (empty ($promotionData)) {
                $response = error(60021);
                break;
            }

            $this->setPromotion(array('promotion_id' => $promotionId));
        } while (false);


        self::json_output($response);
    }

    /**
     * 删除活动
     */
    public function deletePromotion()
    {
        $promotionId = intval($this->input->get_post('promotion_id'));

        $response = array('error' => '0', 'msg' => '删除活动成功', 'code' => 'delete_promotion_success');

        do {
            if (!$promotionId) {
                $response = error(60022);
                break;
            }

            $this->setPromotion(array('promotion_id' => $promotionId), false);
        } while (false);

        self::json_output($response);
    }

    /**
     * 初始化购物车
     */
    public function getCart()
    {
        $cData = array();
        $cData['cart'] = $this->getCartToCookie();
        //$promotion = $this->getUsedPromotion();

        if (!empty ($cData['cart'])) {
            $data = $this->calculateDiscount($cData['cart'], array('unused_promotion', 'used_promotion'));

            //* 活动信息
            $cData['activity'] = $data['unused_promotion']; //获取可选未使用的活动列表

            $cData['cart'] = $data['product'];
        }
//p($data);exit;

        //echo '<pre>';print_r($cData['cart']);exit;
        $this->json_output($cData);
    }

    /**
     * 添加产品到购物中 -- cookie
     */
    public function addToCart ()
    {
        $pId = intval($this->input->get_post('pid'));
        $pNum = intval($this->input->get_post('p_num')) ? intval($this->input->get_post('p_num')) : 1;
        $pSize = strtolower($this->input->get_post('p_size'));
        $pAdditionalInfo = $this->input->get_post('additional_info');

        $response = array('error' => '0', 'msg' => '添加产品到购物车成功', 'code' => 'add_products_to_cart_successful');

        do {
            if (empty ($pId) || empty ($pSize)) {
                $response = error(60003);
                break;
            }

            $this->load->model('product/Model_Product', 'product');
            $pInfo = $this->product->getProductById($pId);

            /**
            if (empty ($pInfo)) {
                $response = error(20002);
                break;
            }
            //*/

            $size = $this->product->getProductSize($pId, $pSize);

            if (empty ($size) || empty ($pInfo)) {
                $response = error(20002);
                break;
            }

            $cInfo = array(
                'pid' => $pInfo['pid'],
                'pname' => $pInfo['pname'],
                'product_price' => ($pInfo['sell_price']),
                'product_num' => $pNum,
                'size_id' => $size['size_id'],
                'product_size' => $size['abbreviation'],
                'additional_info' => $pAdditionalInfo,
            );

            $status = $this->setCartToCookie($cInfo);
            if (!$status) {
                $response = error(60002);
                break;
            }

            $response['pinfo'] = $pInfo;
        } while (false);

        self::json_output($response,true);
    }

    /**
     * 删除购物车中产品
     */
    public function deleteCartProduct()
    {
        $pId = intval($this->input->get_post('pid'));

        $response = array('error' => '0', 'msg' => '删除/重新添加产品至购物车中成功', 'code' => 'remove_re_add_product_to_shopping_cart_success');

        do {
            if ($pId < 0) {
                $response = error(60010);
                break;
            }

            /*
            $this->load->model('Model_Cart', 'cart');
            $status = $this->cart->deleteAndReAddCartProduct($this->uInfo['uid'], $cId, $oType);
            if (!$status) {
                $response = error(60009);
                break;
            }
            //*/
            $cData = $this->getCartToCookie();

            foreach ($cData as $k=>$v) {
                if ($pId == $v['pid']) {
                    unset ($cData[$k]);
                }
            }
            /*
            if (!empty ($cData[$id])) {
                unset ($cData[$id]);
            }
            //*/
            //echo '<pre>';print_r($cData);exit;
            $this->input->set_cookie('cart_info', empty ($cData) ? '' : json_encode($cData), config_item('cookie_cart_expires'));

            //$response = error(60009);
        } while (false);

        self::json_output($response);
    }

    /**
     *
     * 更改购物车产品数量
     */
    public function changeQuantity()
    {
        $pId = intval($this->input->get_post('pid'));
        $num = intval($this->input->get_post('num'));

        $response = array('error' => '0', 'msg' => '更改购物车产品数量成功', 'code' => 'change_cart_products_successful');

        do {
            if ($num === 0 || $num < 0) {
                $response = error(60007);
                break;
            }

            $cData = $this->getCartToCookie();
            if (!$cData) {
                $response = error(60018);
                break;
            }
            foreach ($cData as $k=>$v) {
                if ($pId == $v['pid']) {
                    $cData[$k]['product_num'] = $num;
                }
            }

            $status = $this->input->set_cookie('cart_info', empty ($cData) ? '' : json_encode($cData), config_item('cookie_cart_expires'));
            /*/
            if (!false) {
                $response = error(60005);
                break;
            }
            //*/
        } while (false);

        $this->json_output($response);
    }

    /**
     * 购物车产品存储到数据库  未解决，如用户已存入，然后改数量后再存入，将不会把改后的数量放进库里。
     */
    public function cartStorageToDatabase()
    {
        $response = array('error' => '0', 'msg' => '存储用户购物车中产品到数据库成功', 'code' => 'storage_user_shopping_cart_product_to_database_success');

        do {
            $cData = $this->getCartToCookie();

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('product/Model_Product', 'product');
            $this->load->model('Model_Cart', 'cart');

            foreach ($cData as $v) {
                $this->cart->deleteCartItem($this->uInfo['uid'], $v['pid']);
            }

            foreach ($cData as $cv) {
                $pInfo = $this->product->getProductById($cv['pid']);

                $sInfo = array(
                    'pid' => $pInfo['pid'],
                    'pname' => $pInfo['pname'],
                    'product_price' => $pInfo['sell_price'],
                    'product_num' => $cv['product_num'],
                    'product_size' => $cv['product_size'],
                    'additional_info' => $cv['additional_info'],
                );

                $status = $this->cart->addProductToCart($this->uInfo['uid'], $sInfo);
                /*
                if (!$status) {
                    $response = error(60019);
                    break;
                }
                //*/
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 取出用户购物中所有产品
     */
    public function removeCartProduct()
    {
        $response = array('error' => '0', 'msg' => '取出用户购物车中产品成功', 'code' => 'remove_user_shopping_cart_product_success');

        do {
            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('Model_Cart', 'cart');
            $cartDatabaseInfo = $this->cart->getUserCartProductByUid($this->uInfo['uid']);
            $this->cart->emptyUserCart($this->uInfo['uid']);

            $cartCookieInfo = $this->getCartToCookie();

            //将cookie与数据库中的数据合并, 以cookie中数据为主
            $data = empty ($cartCookieInfo) ? $cartDatabaseInfo : $cartCookieInfo;

            if (!empty ($cartCookieInfo) && !empty ($cartDatabaseInfo)) {

                foreach ($cartCookieInfo as $cv)
                {
                    foreach ($cartDatabaseInfo as $k=>$dv)
                    {
                        if ($dv['pid'] == $cv['pid'])
                        {
                            unset ($cartDatabaseInfo[$k]);
                        }
                    }
                }
            }

            //* 将数据中存在的产品与现有购物车中产品合并
            if (! empty ($cartDatabaseInfo)) {
                foreach ($cartDatabaseInfo as $dv) {
                    $tmpData = array(
                        'pid' => $dv['pid'],
                        'pname' => $dv['pname'],
                        'product_price' => ($dv['product_price']),
                        'product_num' => ($dv['product_num']),
                        'size_id' => ($dv['product_size']),
                        'product_size' => ($dv['product_size']),
                        'additional_info' => ($dv['additional_info']),
                    );
                    $data[] = $tmpData;
                }
            }
            //*/

            $jData = empty ($data) ? '' : json_encode($data);

            $this->input->set_cookie('cart_info', $jData, config_item('cookie_cart_expires'));
        } while (false);

        $this->json_output($response);
    }

    /**
     * 清空用户购物车
     */
    public function emptyCart()
    {
        //$uId = intval($this->input->get_post('uid'));

        $response = array('error' => '0', 'msg' => '清空用户购物车成功', 'code' => 'empty_shopping_cart_success');

        $this->input->set_cookie('cart_info', '', -100);

        $this->json_output($response);
    }
}