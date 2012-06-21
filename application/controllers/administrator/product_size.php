<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午4:32
 * To change this template use File | Settings | File Templates.
 */
class product_size extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    /**
     * 列出分类列表
     */
    public function index()
    {
        $this->load->model('product/Model_Product_Size', 'size');
        $this->load->library('pagination');
        $num = $this->size->getNum();
        $pagesize = 20;
        $config['base_url'] = site_url('administrator/product_size/index');
        $config['total_rows'] = $num;
        $config['per_page'] = $pagesize;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 4;
        $config['num_links'] = 10;
        $config['anchor_class'] = 'class="number" ';
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4, 1);
        $data = array();
        if ($num) {
            $page = (abs($page) - 1) * $pagesize;
            $data = $this->size->getList($pagesize, $page);
        }
        $this->load->view('administrator/product/size/index',array('list' => $data, 'page' => $this->pagination->create_links()));
    }

    /**
     * 创建一个分类
     */
    public function create()
    {
        //$this->load->model('product/Model_Product_Category', 'category');
        //$category = $this->category->getCategroyList();
        //$this->load->model('product/Model_Product_Model', 'mod');
        //$model = $this->mod->getModelList(500);
        $this->load->view('administrator/product/size/create');
    }

    /**
     * 编辑一条分类信息
     */
    public function edit()
    {
        $size_id = $this->uri->segment(4, 0);
        if (!$size_id) {
            show_error('号码id为空');
        }
        $this->load->model('product/Model_Product_Size', 'size');
        $info = $this->size->getSizeById($size_id);
        if (!$info) {
            show_error('号码信息不存在');
        }
        $this->load->view('administrator/product/size/create', $info);
    }

    public function save()
    {
        $this->load->model('product/Model_Product_Size', 'size');
        $data['name'] = $this->input->post('name');
        $data['type'] = $this->input->post('type');
        $data['abbreviation'] = $this->input->post('abbreviation');
        $data['descr'] = $this->input->post('descr');
        $size_id = $this->input->post('size_id');

        if (!$data['name'] || !$data['abbreviation'] || !$data['descr'] || !$data['type'])
            show_error('录入信息不全');

        $this->size->save($data, $size_id);
        redirect('administrator/product_size/index');
    }

    public function sizeinfo()
    {
        $type =  $this->input->get_post('type');
        $this->load->model('product/Model_Product_Size', 'size');
        $data = $this->size->getSizeByType($type,'size_id, name');
        echo self::json_output($data);
    }

    /**
     * 删除一个分类
     */
    public function del()
    {
        $size_id = $this->uri->segment(4, 0);
        if (!$size_id) {
            show_error('尺码id为空');
        }
        $this->load->model('product/Model_Product_Size', 'size');

        if ($this->size->isUse($size_id)) {
            show_error('有产品正在使用该尺码,不可删除');
        } else {
            $this->size->delete($size_id);
            redirect('/administrator/product_size/index');
        }

    }
}