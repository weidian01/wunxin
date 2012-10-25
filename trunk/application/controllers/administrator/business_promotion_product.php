<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-24
 * Time: 下午5:32
 * To change this template use File | Settings | File Templates.
 */
class business_promotion_product extends MY_Controller
{
    public $searchType = array(
        1 => '商品ID',
        2 => '商品名称',
    );

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
        $categoryId = intval($this->uri->segment(6, 0));
        //echo $promotionId;
        $where = null;
        if (!empty ($promotionId)) {
            $where = array('promotion_id' => $promotionId);
        }
        if (!empty ($categoryId)) {
            $where == null ? ( $where = array('cid' => $categoryId) ) : ( $where['cid'] = $categoryId );
        }
//echo '<pre>';print_r($where);//exit;
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('/business/model_business_promotion_product', 'product');
        $totalNum = $this->product->getProductCount('*', $where);
        $data = $this->product->getProductList($Limit, $offset, '*', $where);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/business_promotion_product/lists/';
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

        $this->load->model('/business/model_business_promotion_category', 'category');
        $category = $this->category->getCategoryList(10000);

        $vData = array(
            'data' => $data,
            'page_html' => $pageHtml,
            'current_page' => $currentPage,
            'promotion' => $promotion,
            'category' => $category,
            'promotion_id' => $promotionId,
        );
        $this->load->view('/administrator/business/promotion/p_list', $vData);
    }

    /**
     * 为活动添加产品
     */
    public function p_create()
    {
        $id = $this->uri->segment(4, 0);
        if (!$id) {
            show_error('促销活动id为空');
        }

        $keyword = $this->input->get_post('keyword');
        $sType = $this->input->get_post('s_type');
        $pageHtml = '';

        $this->load->model('/business/model_business_promotion', 'promotion');
        $pData = $this->promotion->getPromotion($id);

        if ($pData['promotion_range'] == '1') {
            show_error('此活动针对所有产品，不需要添加产品！');
        }

        $this->load->model('product/Model_Product', 'product');

        if (!empty ($keyword) || !empty ($sType)) {
            switch ($sType) {
                case 1:
                    $tmpData = $this->product->getProductById($keyword);
                    $data[] = empty ($tmpData) ? null : $tmpData;
                    break;
                case 2:
                    $data = $this->product->getProductList(1000, 0,'*',' pname like \'%'.$keyword.'%\'');//($limit = 20, $offset = 0, $field= "*", $where = null, $order = null)
                    break;
                default:
                    $tmpData = $this->product->getProductById($keyword);
                    $data[] = empty ($tmpData) ? null : $tmpData;
            }
        } else {
            $this->load->library('pagination');
            $num = $this->product->getProductCount();
            $pageSize = 20;
            $config['base_url'] = site_url('administrator/business_promotion/p_create/'.$id);
            $config['total_rows'] = $num;
            $config['per_page'] = $pageSize;
            $config['use_page_numbers'] = TRUE;
            $config['uri_segment'] = 5;
            $config['num_links'] = 10;
            $config['anchor_class'] = 'class="number" ';
            $this->pagination->initialize($config);

            $page = $this->uri->segment(5, 1);
            $data = array();
            if ($num) {
                $page = (abs($page) - 1) * $pageSize;
                $data = $this->product->getProductList($pageSize, $page);
            }
            $pageHtml = $this->pagination->create_links();
        }

        $info = array(
            'list' => $data,
            'searchType' => $this->searchType,
            'page' => $pageHtml,
            'promotion' => $pData,
            'promotion_id' => $id,
            'keyword' => $keyword,
            'sType' => $sType,
        );
        $this->load->view('administrator/business/promotion/p_create', $info);
    }

    /**
     * 添加产品加入促销活动
     */
    public function joinPromotion()
    {
        $promotionId = intval($this->uri->segment(4, 0));
        $productId = intval($this->uri->segment(5, 0));
        if (!$promotionId) {
            show_error('促销活动id为空！');
        }
        if (!$productId) {
            show_error('产品ID为空！');
        }

        $this->load->model('/business/model_business_promotion', 'promotion');
        $promotion = $this->promotion->getPromotion($promotionId);
        if ( empty ($promotion) ) {
            show_error('促销活动不存在！');
        }

        $this->load->model('/product/model_product', 'product');
        $pData = $this->product->getProductById($productId);
        if ( empty ($pData) ) {
            show_error('促销产品不存在！');
        }

        $this->load->model('business/model_business_promotion_category', 'category');
        $category = $this->category->getCategoryListByPromotionId($promotionId);

//echo '<pre>';print_r($category);exit;
        $info = array(
            'type' => 'add',
            'promotion' => $promotion,
            'product' => $pData,
            'category' => $category,
        );
        $this->load->view('administrator/business/promotion/join_promotion', $info);
    }

    public function save()
    {
        $data['promotion_id'] = intval($this->input->get_post('promotion_id'));
        $data['pid'] = intval($this->input->get_post('pid'));
        $data['pname'] = $this->input->get_post('pname');
        $data['cid'] = intval($this->input->get_post('cid'));
        $data['promotion_price'] = intval($this->input->get_post('promotion_price'));
        $data['start_time'] = $this->input->get_post('start_time');
        $data['end_time'] = $this->input->get_post('end_time');
        $data['inventory'] = intval($this->input->get_post('inventory'));
        $data['sort'] = intval($this->input->get_post('sort'));
        $data['sales_status'] = intval($this->input->get_post('sales_status'));

        if (empty ($data['promotion_id']) ||
            empty ($data['pid']) ||
            empty ($data['pname']) ||
            empty ($data['cid']) ||
            empty ($data['promotion_price']) ||
            empty ($data['start_time']) ||
            empty ($data['end_time']) ||
            empty ($data['inventory']) ||
            empty ($data['sales_status']) ) {
            show_error('参数为空！');
        }

        $this->load->model('/business/model_business_promotion', 'promotion');
        $promotion = $this->promotion->getPromotion($data['promotion_id']);
        if ( empty ($promotion) ) {
            show_error('促销活动不存在！');
        }

        $this->load->model('/product/model_product', 'product');
        $pData = $this->product->getProductById($data['pid']);
        if ( empty ($pData) ) {
            show_error('促销产品不存在！');
        }

        $this->load->model('/business/model_business_promotion_product', 'pp');
        $status = $this->pp->addProduct($data);
        if (!$status) {
            show_error('添加促销产品失败！');
        }

        $this->load->helper('url');
        redirect('administrator/business_promotion_product/lists/1/'.$data['promotion_id']);
    }

    /**
     * 删除促销产品
     */
    public function delete()
    {
        $id = $this->uri->segment(4, 0);
        if (!$id) {
            show_error('促销产品id为空');
        }

        $this->load->model('/business/model_business_promotion_product', 'product');

        $status = $this->product->deleteProduct($id);
        if (!$status) {
            show_error('删除促销活动失败！');
        }

        $this->load->helper('url');
        redirect('administrator/business_promotion_product/lists');
    }
}
