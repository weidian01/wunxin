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

        $data = $this->order->getOrderByUid($this->uInfo['uid'], $Limit, $offset);
        //echo '<pre>';print_r($data);exit;

        $this->load->model('product/Model_Product_Favorite', 'favorite');
        $favoriteRecommend = $this->favorite->getFavoriteProductRecommend(5);

        $this->load->view('user/center/center', array('data' => $data, 'page_html' => $pageHtml, 'total_num' => $totalNum, 'favorite_recommend' => $favoriteRecommend));
    }

    /**
     * @return mixed
     */
    public function orderDetail()
    {
        $orderSn = $this->uri->segment(4, 0);

        $this->load->model('order/Model_Order', 'order');
        $orderData = $this->order->getOrderByOrderSn($orderSn);

        $orderProduct = $this->order->getOrderAllProductByOrderSn($orderSn);

        $this->load->view('user/center/order_detail', array('order_data' => $orderData, 'order_product' => $orderProduct));
    }

    public function returns()
    {
        $Limit = 10;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('order/Model_Order_Return', 'return');
        $totalNum = $this->return->getUserReturnAndProductCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/returns/';
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

        $data = $this->return->getUserReturnAndProduct($this->uInfo['uid'], $Limit, $offset);

        $this->load->model('product/Model_Product_Favorite', 'favorite');
        $favoriteRecommend = $this->favorite->getFavoriteProductRecommend(5);
        //echo '<pre>';print_r($favoriteRecommend);exit;

        $this->load->view('user/center/return', array('data' => $data, 'page_html' => $pageHtml, 'total_num' => $totalNum, 'favorite_recommend' => $favoriteRecommend));
    }

    public function addReturn()
    {
        $pId = intval($this->input->get_post('pid'));
        $orderSn = intval($this->input->get_post('order_sn'));
//echo $pId,$orderSn;
        $this->load->view('user/center/add_return', array('pid' => $pId, 'order_sn' => $orderSn));
    }

    public function saveReturn()
    {
        $data['pid'] = intval($this->input->get_post('pid'));
        $data['order_sn'] = ($this->input->get_post('order_sn'));
        $data['type'] = intval($this->input->get_post('type'));
        $data['reason'] = intval($this->input->get_post('reason'));
        $data['descr'] = ($this->input->get_post('content'));
        //var_dump($_FILES['problem_one']['error'] != '0');
//echo '<pre>';print_r($_FILES['problem_two']);exit;
        if (
            empty ($data['pid']) ||
            empty ($data['order_sn']) ||
            empty ($data['type']) ||
            empty ($data['reason']) ||
            empty ($data['descr']) ||
            $_FILES['problem_one']['error'] != '0' ||
            $_FILES['problem_two']['error'] != '0'
        ) {
            show_error('请认真填写相关问题！');
        }

        //用户是否登陆
        if (!$this->isLogin()) {
            redirect('/user/login');
            return '';
        }
        $data['uid'] = $this->uInfo['uid'];

        $this->load->model('order/Model_Order_Return', 'return');
        $returnStatus = $this->return->getReturnByOrderSnAndPid($data['order_sn'], $data['pid']);
        if ($returnStatus) {
            show_error('已经申请过退换货!');
        }

        //是否订购过产品
        $this->load->model('order/Model_Order', 'order');
        $buyStatus = $this->order->userIsBuyProduct($data['uid'], $data['pid']);
        if (empty ($buyStatus)) {
            show_error('您并未购买过此产品或产品还未配送到!');
        }
//echo $buyStatus['pay_time'].'<br/>'.date('Y-m-d H:i:s');
        //订单是否超过30天
        $this->load->helper('time');
        $diffDay = timeDiff(strtotime($buyStatus['pay_time']), time());//echo '<pre>';print_r($diffDay);exit;
        if ($diffDay['day'] >= 30) {
            show_error('已过期，订单时间已超过30天。');
        }

        $this->load->helper('directory');
        $directory = 'upload'.DS.'return'.DS.date('Y_m_d').DS.date('H').DS;
        recursiveMkdirDirectory(WEBROOT . $directory);

        $config = array(
            'upload_path' => WEBROOT . $directory, 'allowed_types' => 'gif|jpg|png', 'max_size' => '4000', 'remove_spaces' => true,
            'overwrite' => false, 'max_width' => '0', 'max_height' => '0', 'file_name' => $data['order_sn'].'_'.$data['pid'].'_'.date('Ymd').'_one',
        );
        $this->load->library('upload', $config);
        //$this->upload->do_upload('problem_one');
        //echo $data['order_sn'].'_'.$data['pid'].'_'.date('Ymd').'_one';exit;'<pre>'.WEBROOT . $directory;print_r($this->upload);exit;

        if ($this->upload->do_upload('problem_one')) {
            $uData = $this->upload->data();
            $data['img_one'] = $directory . $uData['file_name'];
        } else {
            show_error('补充图片1，文件上传失败!');
        }

        $config = array(
            'upload_path' => WEBROOT . $directory, 'allowed_types' => 'gif|jpg|png', 'max_size' => '4000', 'remove_spaces' => true,
            'overwrite' => false, 'max_width' => '0', 'max_height' => '0', 'file_name' => $data['order_sn'].'_'.$data['pid'].'_'.date('Ymd').'_two',
        );
        $this->load->library('upload', $config);
        $directory = 'upload'.DS.'return'.DS.date('Y_m_d').DS.date('H').DS;
        recursiveMkdirDirectory(WEBROOT . $directory);
        if ($this->upload->do_upload('problem_two')) {
            $uData = $this->upload->data();
            $data['img_two'] = $directory . $uData['file_name'];
        } else {
            show_error('补充图片2，文件上传失败!');
        }

        $status = $this->return->addReturn($data);
        if (!$status) {
            show_error('添加退换货失败');
        }
        redirect('/user/center/returns');
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

        $this->load->model('product/Model_Product_Favorite', 'favorite');
        $favoriteRecommend = $this->favorite->getFavoriteProductRecommend(5);

        $this->load->view('user/center/share', array('data' => $data, 'page_html' => $pageHtml, 'favorite_recommend' => $favoriteRecommend));
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

        $data = $this->comment->getUserCommentAndProduct($this->uInfo['uid'], $Limit, $offset);

        $this->load->model('product/Model_Product_Favorite', 'favorite');
        $favoriteRecommend = $this->favorite->getFavoriteProductRecommend(5);

        $this->load->view('user/center/p_comment', array('data' => $data, 'page_html' => $pageHtml, 'total_num' => $totalNum, 'favorite_recommend' => $favoriteRecommend));
    }

    /**
     * 设计图评论
     */
    public function designComment()
    {
        $Limit = 10;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('design/Model_Design_Comment', 'comment');
        $totalNum = $this->comment->getUserCommentAndDesignCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/designComment/';
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

        $data = $this->comment->getUserCommentAndDesign($this->uInfo['uid'], $Limit, $offset);
//echo '<pre>';print_r($data);exit;
        $this->load->model('design/Model_Design_Favorite', 'favorite');
        $favoriteRecommend = $this->favorite->getUserFavoriteDesignRecommend(5);

        $this->load->view('user/center/d_comment', array('data' => $data, 'page_html' => $pageHtml, 'total_num' => $totalNum, 'favorite_recommend' => $favoriteRecommend));
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
        $this->load->view('user/center/u_comment', array('data' => $data, 'page_html' => $pageHtml, 'total_num' => $totalNum, 'favorite_recommend' => $favoriteRecommend));
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

    /**
     * 添加收货地址
     */
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
        $Limit = 10;
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

        $this->load->model('design/Model_Design_Favorite', 'favorite');
        $favoriteRecommend = $this->favorite->getUserFavoriteDesignRecommend(5);

        $this->load->view('user/center/design', array('data' => $data, 'page_html' => $pageHtml, 'favorite_recommend' => $favoriteRecommend));
    }

    /**
     * 我的产品
     */
    public function myProduct()
    {
        $Limit = 10;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('product/Model_Product', 'product');
        $totalNum = $this->product->getUserProductCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/myProduct/';
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

        $this->load->model('product/Model_Product_Favorite', 'favorite');
        $favoriteRecommend = $this->favorite->getFavoriteProductRecommend(5);

        $this->load->view('user/center/product', array('data' => $data, 'page_html' => $pageHtml, 'favorite_recommend' => $favoriteRecommend));
    }

    /**
     * 促销信息退订
     */
    public function salesInfo()
    {
        $this->load->model('business/Model_Mail_Subscription', 'mail');
        $data = $this->mail->getUserSubscribeList($this->uInfo['uid']);

        $this->load->view('user/center/sales_info', array('data' => $data));
    }

    /**
     * 礼品卡管理
     */
    public function giftCard()
    {
        $Limit = 10;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('business/Model_Gift_Card', 'card');
        $totalNum = $this->card->getUserCardInfoAndModelCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/giftCard/';
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

        $data = $this->card->getUserCardInfoAndModel($this->uInfo['uid'], $Limit, $offset);
//echo '<pre>';print_r($data);exit;
        $this->load->view('user/center/gift_card', array('data' => $data, 'page_html' => $pageHtml));
    }

    public function bingCard()
    {
        $this->load->view('user/center/bing_card');
    }

    public function systemProposal()
    {
        $this->load->view('user/center/add_system_proposal');
    }

    public function mySystemProposal()
    {
        $Limit = 15;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('other/Model_System_Proposal', 'sp');
        $totalNum = $this->sp->getUserSystemProposalCount($this->uInfo['uid']);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/user/center/mySystemProposal/';
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

        $data = $this->sp->getUserSystemProposal($this->uInfo['uid'], $Limit, $offset);

        $this->load->model('product/Model_Product_Favorite', 'favorite');
        $favoriteRecommend = $this->favorite->getFavoriteProductRecommend(5);

//echo '<pre>';print_r($data);exit;
        $this->load->view('user/center/system_proposal', array('data' => $data, 'page_html' => $pageHtml, 'favorite_recommend' => $favoriteRecommend));
    }
}
