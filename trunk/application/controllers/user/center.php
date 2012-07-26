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
        $Limit = 10;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('order/Model_Order', 'order');
        $totalNum = $this->order->getUserOrderCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/index/';
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


        //$data = $this->invoice->getUserInvoiceByuId($this->uInfo['uid'], $Limit, $offset);
        $data = $this->order->getOrderByUid($this->uInfo['uid'], $Limit, $offset);
        //$this->uInfo;

        $this->load->view('user/center/center', array('data' => $data, 'page_html' => $pageHtml, 'total_num' => $totalNum));
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
        $Limit = 10;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('product/Model_Product_Favorite', 'favorite');
        $totalNum = $this->favorite->getUserFavoriteAndProductCount($this->uInfo['uid']);

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

        $data = $this->favorite->getUserFavoriteAndProduct($this->uInfo['uid'], $Limit, $offset);

        $favoriteRecommend = $this->favorite->getFavoriteProductRecommend(5);

//echo '<pre>';print_r($favoriteRecommend);exit;
        $this->load->view('user/center/p_favorite', array('data' => $data, 'page_html' => $pageHtml, 'total_num' => $totalNum, 'favorite_recommend' => $favoriteRecommend));
    }

    /**
     * 设计师收藏
     */
    public function designerFavorite()
    {
        $Limit = 10;
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

        $data = $this->favorite->getUserDesignerFavoriteAndUser($this->uInfo['uid'], $Limit, $offset);

        $favoriteRecommend = $this->favorite->getUserFavoriteRecommend(5);
//echo '<pre>';print_r($favoriteRecommend);exit;
        $this->load->view('user/center/u_favorite', array('data' => $data, 'page_html' => $pageHtml, 'total_num' => $totalNum, 'favorite_recommend' => $favoriteRecommend));
    }

    /**
     * 设计图收藏
     */
    public function designFavorite()
    {
        $Limit = 10;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('design/Model_Design_Favorite', 'favorite');
        $totalNum = $this->favorite->getUserDesignFavoriteAndDesignCount($this->uInfo['uid']);

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

        $data = $this->favorite->getUserDesignFavoriteAndDesign($this->uInfo['uid'], $Limit, $offset);

        $favoriteRecommend = $this->favorite->getUserFavoriteDesignRecommend(5);
        //echo '<pre>';print_r($favoriteRecommend);exit;
        $this->load->view('user/center/d_favorite', array('data' => $data, 'page_html' => $pageHtml, 'total_num' => $totalNum, 'favorite_recommend' => $favoriteRecommend));
    }

    /**
     * 个人资料
     */
    public function profile()
    {

        $this->load->model('user/Model_User', 'user');
        $data = $this->user->getUserAllInfoById($this->uInfo['uid']);

        $jobs = config_item('jobs');
        $income = config_item('income');
        $bodyType = config_item('bodyType');
        $industry = config_item('industry');
        $educationLevel = config_item('educationLevel');
        $maritalStatus = config_item('maritalStatus');

        $this->load->model('other/Model_Area', 'area');
        $provinceData = $this->area->getProvinceList();
        $provinceId = 0;
        foreach ($provinceData as $v) {
            if ($data['province'] == $v['name']) { $provinceId = $v['id'];}
        }

        $cityData = $this->area->getCityList($provinceId);
        $areaId = 0;
        foreach ($cityData as $v) {
            if (trim($data['city']) == $v['name']) { $areaId = $v['id'];}
        }

        $vData = array(
            'uinfo' => $data,
            'jobs' => $jobs,
            'income' => $income,
            'province_data' => $provinceData,
            'city_data' => $cityData,
            'body_type' => $bodyType,
            'industry' => $industry,
            'education_level' => $educationLevel,
            'marital_status' => $maritalStatus,
        );

        $this->load->view('user/center/profile', $vData);
    }

    public function addUserHeader()
    {
        $this->load->view('user/center/add_header');
    }

    /**
     * 修改密码
     */
    public function modifyPassword()
    {
        //$this->load->model('user/Model_Designer_Favorite', 'favorite');
        //$data = $this->favorite->getUserDesignerFavorite($this->uInfo['uid']);

        $this->load->view('user/center/change_password');
    }

    /**
     * 产品评论
     */
    public function productComment()
    {
        $Limit = 10;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('product/Model_Product_Comment', 'comment');
        $totalNum = $this->comment->getUserCommentAndProductCount($this->uInfo['uid']);

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

        $this->load->model('product/Model_Product_Favorite', 'favorite');
        $data = $this->comment->getUserCommentAndProduct($this->uInfo['uid'], $Limit, $offset);

        $this->load->model('product/Model_Product_Favorite', 'favorite');
        $favoriteRecommend = $this->favorite->getFavoriteProductRecommend(5);

        $this->load->view('user/center/p_comment', array('data' => $data, 'page_html' => $pageHtml, 'favorite_recommend' => $favoriteRecommend));
    }

    /**
     * 设计师留言
     */
    public function designerComment()
    {
        $Limit = 10;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('user/Model_Designer_Comment', 'comment');
        $totalNum = $this->comment->getUserDesignerCommentAndDesignerCount($this->uInfo['uid']);

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

        $data = $this->comment->getUserDesignerCommentAndDesigner($this->uInfo['uid'], $Limit, $offset);

        $this->load->model('user/Model_Designer_Favorite', 'favorite');
        $favoriteRecommend = $this->favorite->getUserFavoriteRecommend(5);
//echo '<pre>';print_r($favoriteRecommend);exit;
        $this->load->view('user/center/u_comment', array('data' => $data, 'page_html' => $pageHtml, 'favorite_recommend' => $favoriteRecommend));
    }

    /**
     * 产品问答
     */
    public function qa()
    {
        $Limit = 10;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('product/Model_Product_QA', 'qa');
        $totalNum = $this->qa->getUserProductQaAndProductCount($this->uInfo['uid']);

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

        $data = $this->qa->getUserProductQaAndProduct($this->uInfo['uid'], $Limit, $offset);

        $this->load->model('product/Model_Product_Favorite', 'favorite');
        $favoriteRecommend = $this->favorite->getFavoriteProductRecommend(5);

        $this->load->view('user/center/qa', array('data' => $data, 'page_html' => $pageHtml, 'favorite_recommend' => $favoriteRecommend));
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


    public function addRecentAddress()
    {
        $this->load->model('other/Model_Area', 'area');
        $provinceData = $this->area->getProvinceList();

        $this->load->view('user/center/add_recent', array('province_data' => $provinceData,));
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
