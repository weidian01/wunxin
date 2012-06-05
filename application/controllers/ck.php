<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ck extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->model('user/Model_User', 'user');
        echo '<pre>';print_r($this->user->getUserAllInvoiceInfoByUid(1));exit;

        /*
        $orderData = array(
            array(
                'pid' => 1,
                'uid' => 1,
                'uname' => 'weidian01@gmail.com',
                'pname' => '潮人必备个性T恤-白色',
                'market_price' => 10,
                'sall_price' => 10,
                'product_num' => 1,
                'product_size' => 'S',
                'presentation_integral' => 10,
                'preferential' => 0,
                'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
            ),
            array(
                'pid' => 2,
                'uid' => 1,
                'uname' => 'weidian01@gmail.com',
                'pname' => '潮人必备个性T恤-红色',
                'market_price' => 10,
                'sall_price' => 10,
                'product_num' => 1,
                'product_size' => 'S',
                'presentation_integral' => 10,
                'preferential' => 0,
                'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
            ),
        );
        $this->load->model('order/order', 'order');
        $data = $this->order->addOrderProduct($orderData, 1);
        //*/

        /*
        $data = array(
            'uid' => 1,
            'uname' => 'weidian01@gmail.com',
            'recent_name' => '兰国宾',
            'country' => '中国',
            'province' => '北京',
            'city' => '北京市',
            'area' => '朝阳区',
            'detail_address' => '中国北京市朝阳区十六里桥',
            'zipcode' => '100010',
            'phone_num' => '13693573005',
            'call_num' => '',
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );



        $this->load->model('user/user', 'user');
        $data = $this->user->addOrderProduct($orderData, 1);
        //*/


        //*
        $productInfo = array(
            array(
                'pid' => 1,
                'pname' => '潮人必备个性T恤-红色',
                'product_price' => 10,
                'product_num' => 1,
                'product_img' => '/dd/a/ss.jpg',
            ),
            array(
                'pid' => 2,
                'pname' => '潮人必备个性T恤-白色',
                'product_price' => 10,
                'product_num' => 1,
                'product_img' => '/dd/a/ss.jpg',
            ),
        );
        $this->load->model('cart', 'cart');
        $data = $this->cart->addProductToCart($productInfo, 1);

        //*/
        //$this->user->userNameIsExist('asd');
        //$this->load->view('ck');
        //$db = this->load->database('aaa,',false)
        //this->db->query
        echo '<pre>';
        print_r($data);
    }

    public function aa()
    {
        echo 'aa';
        echo $this->input->get('bt');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */