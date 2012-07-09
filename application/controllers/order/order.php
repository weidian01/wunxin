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
            $this->load->model('user/Model_User_Recent', 'recent');
            $status = $this->recent->addUserRecipientAddress($data);
            if (!$status) {
                $response = error(30010);
                break;
            }

        } while (false);

        $this->json_output($response);
    }
}
