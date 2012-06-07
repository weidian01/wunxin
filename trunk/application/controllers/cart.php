<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class cart extends MY_Controller
{
    /**
     * 添加产品到购物车
     */
    public function addToCart()
    {
        $uId = intval($this->input->get_post('uid'));
        $pId = intval($this->input->get_post('pid'));
        $pNum = intval($this->input->get_post('p_num'));
        $pSize = $this->input->get_post('p_size');
        $pAdditionalInfo = $this->input->get_post('p_additional_info');

        $response = error(60001);

        do {
            if (empty ($uId) || empty ($pId)) {
                $response = error(60003);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('product/Model_Product', 'product');
            $pInfo = $this->product->getProductAndPhotoByPid($pId);
            if (!$pInfo) {
                $response = error(20002);
                break;
            }

            $cInfo = array(
                'pid' => $pInfo['pid'],
                'pname' => $pInfo['pname'],
                'product_price' => $pInfo['sell_price'],
                'product_num' => $pNum,
                'product_img' => $pInfo['img_addr'],
                'product_size' => $pSize,
                'additional_info' => $pAdditionalInfo,
            );
            $this->load->model('Model_Cart', 'cart');
            $status = $this->cart->addProductToCart($this->uInfo['uid'], $cInfo);
            if (!$status) {
                $response = error(60002);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 更改购物车产品数量
     */
    public function changeQuantity()
    {
        $uId = intval($this->input->get_post('uid'));
        $cId = intval($this->input->get_post('cid'));
        $num = intval($this->input->get_post('num'));

        $response = error(60004);

        do {
            if ($num === 0) {
                $response = error(60007);
                break;
            }

            if (empty ($uId) || empty ($cId)) {
                $response = error(60006);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('Model_Cart', 'cart');
            $status = $this->cart->modifyProductNum($this->uInfo['uid'], $cId, $num);
            if (!$status) {
                $response = error(60005);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 删除/重新添加产品至购物车中
     */
    public function deleteProduct()
    {
        $uId = intval($this->input->get_post('uid'));
        $cId = intval($this->input->get_post('cid'));
        $oType = intval($this->input->get_post('o_type'));
        $oType = $oType == 1 ? 1 : 0;

        $response = error(60008);

        do {
            if (empty ($uId) || empty ($cId)) {
                $response = error(60010);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('Model_Cart', 'cart');
            $status = $this->cart->deleteAndReAddCartProduct($this->uInfo['uid'], $cId, $oType);
            if (!$status) {
                $response = error(60009);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 清空用户购物车
     */
    public function emptyCart()
    {
        $uId = intval($this->input->get_post('uid'));

        $response = error(60011);

        do {
            if (empty ($uId) || empty ($cId)) {
                $response = error(60013);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('Model_Cart', 'cart');
            $status = $this->cart->emptyUserCart($this->uInfo['uid']);
            if (!$status) {
                $response = error(60009);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 转存入数据库
     */
    public function storageCartProduct()
    {

    }

    /**
     * 取出用户购物中所有产品
     */
    public function removeCartProduct()
    {
        $uId = intval($this->input->get_post('uid'));

        $response = error(60014);

        do {
            if (empty ($uId) || empty ($cId)) {
                $response = error(60016);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('Model_Cart', 'cart');
            $cInfo = $this->cart->getUserCartProductByUid($this->uInfo['uid']);
            if (!$cInfo) {
                $response = error(60015);
                break;
            }
            $response['user_cart_product'] = $cInfo;
        } while (false);

        $this->json_output($response);
    }
}