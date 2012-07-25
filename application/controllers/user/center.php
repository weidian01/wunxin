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

    public function orderDetail()
    {
        $orderSn = $this->uri->segment(4, 0);

        if (empty ($orderSn)) {
            redirect('/user/center/index');
            return ;
        }

        $this->load->model('order/Model_Order', 'order');
        $orderData = $this->order->getOrderByOrderSn($orderSn);

        $orderProduct = $this->order->getOrderAllProductByOrderSn($orderSn);

        $this->load->view('user/center/order_detail', array('order_data' => $orderData, 'order_product' => $orderProduct));
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
        $Limit = 15;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('product/Model_Product_Share', 'share');
        $totalNum = $this->share->getProductShareCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/share/';
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

        $data = $this->share->getProductShareAndImagesByUid($this->uInfo['uid'], $Limit, $offset);

        $this->load->view('user/center/share', array('data' => $data, 'page_html' => $pageHtml));
    }

    /**
     * 产品收藏
     */
    public function productFavorite()
    {
        $Limit = 15;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('product/Model_Product_Favorite', 'favorite');
        $totalNum = $this->favorite->getUserProductFavoriteCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/productFavorite/';
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

        $data = $this->favorite->getUserProductFavorite($this->uInfo['uid'], $Limit, $offset);

        $this->load->view('user/center/p_favorite', array('data' => $data, 'page_html' => $pageHtml));
    }

    /**
     * 设计师收藏
     */
    public function designerFavorite()
    {
        $Limit = 15;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $totalNum = $this->favorite->getUserDesignerFavoriteCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/designerFavorite/';
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

        $data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid'], $Limit, $offset);

        $this->load->view('user/center/u_favorite', array('data' => $data, 'page_html' => $pageHtml));
    }

    /**
     * 设计图收藏
     */
    public function designFavorite()
    {
        $Limit = 15;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('design/Model_Design_Favorite', 'favorite');
        $totalNum = $this->favorite->getUserFavoriteDesignCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/designFavorite/';
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

        $data = $this->favorite->getUserFavoriteDesignByUid($this->uInfo['uid'], $Limit, $offset);

        $this->load->view('user/center/d_favorite', array('data' => $data, 'page_html' => $pageHtml));
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
        //$this->load->model('user/Model_Designer_Favorite', 'favorite');
        //$data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/profile');
    }

    /**
     * 产品评论
     */
    public function productComment()
    {
        $Limit = 15;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('product/Model_Product_Comment', 'comment');
        $totalNum = $this->comment->getCommentCountByuId($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/productComment/';
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

        $data = $this->comment->getCommentByUid($this->uInfo['uid'], $Limit, $offset);

        $this->load->view('user/center/p_comment', array('data' => $data, 'page_html' => $pageHtml));
    }

    /**
     * 设计师留言
     */
    public function designerComment()
    {
        $Limit = 15;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('user/Model_Designer_Comment', 'comment');
        $totalNum = $this->comment->getDesignerCommentByUidCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/designerComment/';
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

        $data = $this->comment->getDesignerCommentByUid($this->uInfo['uid'], $Limit, $offset);

        $this->load->view('user/center/d_comment', array('data' => $data, 'page_html' => $pageHtml));
    }

    /**
     * 产品问答
     */
    public function qa()
    {
        $Limit = 15;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('product/Model_Product_QA', 'qa');
        $totalNum = $this->qa->getProductQaCountByuId($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/qa/';
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

        $data = $this->qa->getProductQAByUid($this->uInfo['uid'], $Limit, $offset);

        $this->load->view('user/center/qa', array('data' => $data, 'page_html' => $pageHtml));
    }

    /**
     * 收货地址管理
     */
    public function recentAddress()
    {
        $Limit = 15;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('user/Model_User_Recent', 'recent');
        $totalNum = $this->recent->getUserRecentAddressCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/recentAddress/';
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

        $data = $this->recent->getUserRecentAddressByUid($this->uInfo['uid'], $Limit, $offset);

        $this->load->view('user/center/recent', array('data' => $data, 'page_html' => $pageHtml));
    }

    /**
     * 我的设计图
     */
    public function myDesign()
    {
        $Limit = 15;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('design/Model_Design', 'design');
        $totalNum = $this->design->getUserDesignCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/myDesign/';
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

        $data = $this->design->getDesignByUid($this->uInfo['uid'], $Limit, $offset);

        $this->load->view('user/center/design', array('data' => $data, 'page_html' => $pageHtml));
    }

    /**
     * 我的产品
     */
    public function myProduct()
    {
        $Limit = 15;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('product/Model_Product', 'product');
        $totalNum = $this->product->getUserProductCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/myDesign/';
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

        $data = $this->product->getUserProduct($this->uInfo['uid'], $Limit, $offset);

        $this->load->view('user/center/product', array('data' => $data, 'page_html' => $pageHtml));
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
