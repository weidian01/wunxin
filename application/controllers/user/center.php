<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-7-18
 * Time: 上午9:24
 * To change this template use File | Settings | File Templates.
 */
class center extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->isLogin()) {
            redirect("user/login");
        }

        if(! $this->input->is_ajax_request()){
            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }
    }

    /**
     * 我的订单
     */
    public function index()
    {
        $this->load->model('order/Model_Order', 'order');
        $data = $this->order->getOrderByUid($this->uInfo['uid']);
        //echo '<pre>';print_r($data);exit;

        $this->load->view('user/center/center', array('data' => $data));
    }

    public function returns()
    {
        $this->load->model('order/Model_Order', 'order');
        $data = $this->order->getOrderByUid(1);
        //echo '<pre>';print_r($data);exit;

        $this->load->view('user/center/center', array('data' => $data));
    }

    /**
     * 发票
     */
    public function invoice()
    {
        $Limit = 15;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('order/Model_Order_Invoice', 'invoice');
        $totalNum = $this->invoice->getUserInvoiceCount($this->uInfo['uid']);


        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/invoice/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();


        $data = $this->invoice->getUserInvoiceByuId($this->uInfo['uid'], $Limit, $offset);
        //$this->uInfo;

        $this->load->view('user/center/invoice', array('data' => $data, 'page_html' => $pageHtml));
    }

    /**
     * 晒单
     */
    public function share()
    {
        $this->load->model('product/Model_Product_Share', 'share');
        $data = $this->share->getProductShareByUid($this->uInfo['uid']);

        $this->load->view('user/center/share', array('data' => $data));
    }

    /**
     * 产品收藏
     */
    public function productFavorite()
    {
        $this->load->model('product/Model_Product_Favorite', 'favorite');
        $data = $this->favorite->getUserProductFavorite($this->uInfo['uid']);

        $this->load->view('user/center/p_favorite', array('data' => $data));
    }

    /**
     * 设计师收藏
     */
    public function designerFavorite()
    {
        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/u_favorite', array('data' => $data));
    }

    /**
     * 设计图收藏
     */
    public function designFavorite()
    {
        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/u_favorite', array('data' => $data));
    }

    /**
     * 个人资料
     */
    public function profile()
    {
        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/u_favorite', array('data' => $data));
    }

    /**
     * 修改密码
     */
    public function modifyPassword()
    {
        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/u_favorite', array('data' => $data));
    }

    /**
     * 产品评论
     */
    public function productComment()
    {
        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/u_favorite', array('data' => $data));
    }

    /**
     * 设计师评论
     */
    public function designerComment()
    {
        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/u_favorite', array('data' => $data));
    }

    /**
     * 产品问答
     */
    public function qa()
    {
        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/u_favorite', array('data' => $data));
    }

    /**
     * 收货地址管理
     */
    public function recentAddress()
    {
        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/u_favorite', array('data' => $data));
    }

    /**
     * 我的设计图
     */
    public function myDesign()
    {
        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/u_favorite', array('data' => $data));
    }

    /**
     * 我的产品
     */
    public function myProduct()
    {
        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/u_favorite', array('data' => $data));
    }

    /**
     * 促销信息退订
     */
    public function sales()
    {
        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/u_favorite', array('data' => $data));
    }

    /**
     * 礼品卡管理
     */
    public function giftCard()
    {
        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/u_favorite', array('data' => $data));
    }
}
