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
        //echo '<pre>';print_r($data);exit;
        $jobs = array(
            '1' => '企业雇主/企业经营者',
            '2' => '高级行政人员(行政总裁、总经理、董事等)',
            '3' => '中层管理人员(总监、经理、主任等)',
            '4' => '专业人士(会计师、律师、工程师、医生、教师等)',
            '5' => '办公职员(一般文职、业务、办事人员等)',
            '6' => '工人/蓝领',
            '7' => '公务员、公共事业单位员工',
            '8' => '自由职业者',
            '9' => '军人',
            '10' => '学生',
            '11' => '退休/无业人员',
            '12' => '家庭主妇',
            '13' => '其他',
        );

        $income = array(
            '1' => '2000元以下',
            '2' => '2000～3999元',
            '3' => '4000～5999元',
            '4' => '6000～7999元',
            '5' => '8000～9999元',
            '6' => '10000～15000元',
            '7' => '15000元以上'
        );

        $bodyType = array(
            '1' => '偏瘦',
            '2' => '均称',
            '3' => '偏胖',
            '4' => '肥胖'
        );

        $industry = array(
            '1' => '政府机关/社会团体',
            '2' => '邮电通讯',
            '3' => 'IT业/互联网',
            '4' => '商业/贸易',
            '5' => '旅游/餐饮/酒店',
            '6' => '银行/金融/证券/保险/投资',
            '7' => '健康/医疗服务',
            '8' => '建筑/房地产',
            '9' => '交通运输/物流仓储',
            '10' => '法律/司法',
            '11' => '文化/娱乐/体育',
            '12' => '媒介/广告/咨询',
            '13' => '教育/科研',
            '14' => '林业/农业/牧业/渔业',
            '15' => '制造业(轻工业)',
            '16' => '制造业(重工业)',
            '17' => '能源/公用事业',
            '18' => '其他',

        );



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

        $areaData = $this->area->getAreaList($areaId);

        $vData = array(
            'uinfo' => $data,
            'jobs' => $jobs,
            'income' => $income,
            'province_data' => $provinceData,
            'city_data' => $cityData,
            'area_data' => $areaData,
            'body_type' => $bodyType,
            'industry' => $industry,
        );


        $this->load->view('user/center/profile', $vData);
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
