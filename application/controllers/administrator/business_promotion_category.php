<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-24
 * Time: 下午5:30
 * To change this template use File | Settings | File Templates.
 */
class business_promotion_category extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    public function lists()
    {
        $promotionId = intval($this->uri->segment(5, 0));
        //echo $promotionId;
        $where = null;
        if (!empty ($promotionId)) {
            $where = array('promotion_id' => $promotionId);
        }
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('/business/model_business_promotion_category', 'category');
        $totalNum = $this->category->getCategoryCount('*', $where);
        $data = $this->category->getCategoryList($Limit, $offset, '*', $where);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/business_promotion_category/lists/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
//echo '<pre>';print_r($data);exit;

        $this->load->model('/business/model_business_promotion', 'promotion');
        $promotion = $this->promotion->getPromotionList(10000);


        $vData = array(
            'category' => $data,
            'page_html' => $pageHtml,
            'current_page' => $currentPage,
            'promotion' => $promotion,
        );
        $this->load->view('/administrator/business/promotion/c_list', $vData);
    }

    public function create()
    {
        $promotionId = $this->uri->segment(4, 0);

        if (empty ($promotionId)) {
            show_error('促销活动ID为空！');
        }

        $this->load->model('/business/model_business_promotion', 'promotion');
        $info = $this->promotion->getPromotion($promotionId);
        if ( empty ($info) ) {
            show_error('促销活动不存在！');
        }

        $this->load->model('business/model_business_promotion_category', 'category');
        $category = $this->category->getCategoryList();
//echo '<pre>';print_r($category);exit;
        $data = array(
            'type' => 'add',
            'info' => array('promotion_id' => $promotionId),
            'promotion' => $info,
            'category' => $category,
        );
        $this->load->view('administrator/business/promotion/c_create', $data);
    }

    public function save()
    {
        $this->load->model('business/model_business_promotion_category', 'category');
        $data['name'] = $this->input->post('cname');
        $data['parent_id'] = $this->input->post('parent_id');
        $data['sort'] = $this->input->post('sort');
        $data['title'] = $this->input->post('title');
        $data['keywords'] = $this->input->post('keywords');
        $data['descr'] = $this->input->post('descr');
        $data['promotion_id'] = $this->input->post('promotion_id');
        $class_id = $this->input->post('class_id');

        if (!$data['name'])
            show_error('分类名称不能为空');

        $this->category->save($data, $class_id);
        $this->load->helper('url');
        redirect('administrator/business_promotion_category/lists');
    }

    public function edit()
    {
        $class_id = $this->uri->segment(4, 0);
        if (!$class_id) {
            show_error('分类id为空');
        }
        $this->load->model('business/model_business_promotion_category', 'category');
        $info = $this->category->getCategoryById($class_id);
        if (!$info) {
            show_error('分类信息不存在');
        }
        $category = $this->category->getCategoryList();

        $this->load->model('/business/model_business_promotion', 'promotion');
        $promotion = $this->promotion->getPromotion($info['promotion_id']);

        $data = array(
            'category' => $category,
            'class_id' => $class_id,
            'info' => $info,
            'type' => 'add',
            'promotion' => $promotion,
        );
        $this->load->view('/administrator/business/promotion/c_create', $data);
    }

    public function delete()
    {
        $class_id = $this->uri->segment(4, 0);
        if (!$class_id) {
            show_error('促销分类id为空');
        }
        $this->load->model('business/model_business_promotion_category', 'category');

        $this->load->model('/business/model_business_promotion_product', 'product');
        $productData = $this->product->getProductList(1, 0, 'promotion_id', array('cid' => $class_id));//($limit = 20, $offset = 0, $field = '*', $where = null, $order = null)
        if (!empty ($productData)) {
            show_error('该促销活动下还有产品!');
        }

        if ($this->category->isAlone($class_id)) {
            $this->category->delete($class_id);
            $this->load->helper('url');
            redirect('/administrator/business_promotion_category/lists');
        } else {
            show_error('该促销分类下存在子类,不可删除');
        }
    }
}
