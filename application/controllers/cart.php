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
        $this->load->view('cart/index');
    }

    /**
     * 初始化购物车
     */
    public function getCart()
    {
        $cData = $this->getCartToCookie();
//echo '<pre>';print_r($cData);exit;
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
                'product_price' => fPrice($pInfo['sell_price']),
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
        $id = intval($this->input->get_post('id'));

        $response = error(60008);

        do {
            if ($id < 0) {
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

            if (!empty ($cData[$id])) {
                unset ($cData[$id]);
            }
            //echo '<pre>';print_r($cData);exit;
            $this->input->set_cookie('cart_info', empty ($cData) ? '' : json_encode($cData), 10000000);

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
        $id = intval($this->input->get_post('id'));
        $num = intval($this->input->get_post('num'));

        $response = error(60004);

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

            if (!empty ($cData[$id])) {
                $cData[$id]['product_num'] = $num;
            }

            $status = $this->input->set_cookie('cart_info', empty ($cData) ? '' : json_encode($cData), 10000000);
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
     * 购物车产品存储到数据库
     */
    public function cartStorageToDatabase()
    {
        $response = error(60017);

        do {
            $cData = $this->getCartToCookie();

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('product/Model_Product', 'product');
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

                $this->load->model('Model_Cart', 'cart');
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
        $response = error(60014);

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

            if (! empty ($cartDatabaseInfo)) {
                $data = array_merge($data, $cartDatabaseInfo);
            }

            $jData = empty ($data) ? '' : json_encode($data);

            $this->input->set_cookie('cart_info', $jData, 10000000);
        } while (false);

        $this->json_output($response);
    }

    /**
     * 清空用户购物车
     */
    public function emptyCart()
    {
        //$uId = intval($this->input->get_post('uid'));

        $response = error(60011);

        $this->input->set_cookie('cart_info', '', -100);

        $this->json_output($response);
    }
}