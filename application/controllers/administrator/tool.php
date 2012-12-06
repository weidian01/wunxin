<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-12-6
 * Time: 下午12:24
 * To change this template use File | Settings | File Templates.
 */
class tool extends MY_Controller
{
    public $upFlag = array(
        '1' => '待抓取',
        '0' => '初始状态',
        '2' => '已抓取'
    );

    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    public function crawlProductList()
    {
        $limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $limit;


        $totalNum = $this->db->from('wx_z_product')->count_all_results();
        $data = $this->db->get_where('wx_z_product', array(), $limit, $offset)->result_array();

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/tool/crawlProductList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->model('product/model_product_brand', 'brand');
        $brands = $this->brand->getBrandList(100);

        $this->load->model('product/Model_Product_Category', 'category');
        $category = $this->category->getCategroyList();

        $brand = array();
        foreach ($brands as $v) {
            $brand[$v['bid']] = $v;
        }
        $info = array(
            'data' => $data,
            'page_html' => $pageHtml,
            'current_page' => $currentPage,
            'brand' => $brand,
            'category' => $category,
            'size_type' => config_item('size_type'),
            'up_flag' => $this->upFlag,
            //'color' => $color,
        );

        //echo '<pre>';print_r($category);exit;
        $this->load->view('/administrator/tool/crawl_product_list', $info);
    }

    public function crawlProductAdd()
    {
        $this->load->model('product/model_product_brand', 'brand');
        $brands = $this->brand->getBrandList(100);

        $this->load->model('product/Model_Product_Category', 'category');
        $category = $this->category->getCategroyList();

        $data = array(
            'up_flag' => $this->upFlag,
            'class' => $category,
            'brand' => $brands,
            //'color' => $color,
        );
        //p($color);exit;
        $this->load->view('/administrator/tool/crawl_product_add', $data);
    }

    public function crawlProductEdit()
    {
        $id = $this->uri->segment(4, 0);
        $currentPage = $this->uri->segment(5, 1);
        if (empty ($id)) {
            show_error('参数不全!');
        }

        $data = $this->db->get_where('wx_z_product', array('id' => $id))->row_array();
        if (empty ($data)) {
            show_error('数据不存在!');
        }

        $this->load->model('product/model_product_brand', 'brand');
        $brands = $this->brand->getBrandList(100);

        $this->load->model('product/Model_Product_Category', 'category');
        $category = $this->category->getCategroyList();

        $info = array(
            'info' => $data,
            'up_flag' => $this->upFlag,
            'class' => $category,
            'brand' => $brands,
            'current_page' => $currentPage,
            //'color' => $color,
        );
//p($data);exit;
        $this->load->view('/administrator/tool/crawl_product_add', $info);
    }

    public function crawlProductSave()
    {
        $url = $this->input->get_post('url');
        $sizeType = $this->input->get_post('size_type');
        $upFlag = $this->input->get_post('up_flag');
        $bId = $this->input->get_post('bid');
        $cId = $this->input->get_post('cid');
        //$colorId = $this->input->get_post('color_id');
        $id = $this->input->get_post('id');

        $currentPage = $this->input->get_post('current_page');

        $data = array(
            'url' => $url,
            'size_type' => $sizeType,
            'up_flag' => $upFlag,
            'bid' => $bId,
            'cid' => $cId,
            //'color_id' => $colorId,
        );


        if (!empty ($id)) {
            $this->db->where('id', $id);
            $this->db->update('wx_z_product', $data);
        } else {
            $this->db->insert('wx_z_product', $data);
        }

        $this->load->helper('url');
        redirect('/administrator/tool/crawlProductList/'.$currentPage);
    }

    public function crawl_product_delete()
    {
        $id = $this->uri->segment(4, 0);
        $currentPage = $this->uri->segment(5, 1);

        if (empty ($id)) {
            show_error('参数不全!');
        }

        $this->db->delete('wx_z_product', array('id' => $id));

        $this->load->helper('url');
        redirect('/administrator/tool/crawlProductList/'.$currentPage);
    }
}
