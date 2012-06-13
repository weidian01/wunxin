<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午4:32
 * To change this template use File | Settings | File Templates.
 */
class product_model extends MY_Controller
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
     * 模型列表页面
     */
    public function index()
    {
        $this->load->model('product/Model_Product_Model', 'mod');
        $this->load->library('pagination');
        $num = $this->mod->getModelNum();
        $pagesize = 20;
        $config['base_url'] = site_url('administrator/product_model/index');
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
            $data = $this->mod->getModelList($pagesize, $page);
        }

        $this->load->view('administrator/product/model/index', array('models' => $data, 'page' => $this->pagination->create_links()));
    }


    public function edit()
    {
        $model_id = $this->uri->segment(4, 0);
        if (!$model_id) {
            show_error('模型id为空');
        }
        $this->load->model('product/Model_Product_Model', 'mod');
        $data = $this->mod->getModel($model_id);
        //echo '<pre>';print_r($data);
        $this->load->view('administrator/product/model/create', $data);
    }

    /**
     * 创建一个新模型页面
     */
    public function create()
    {
        $this->load->view('administrator/product/model/create');
    }

    /**
     * 创建一个新模型及其属性
     */
    public function save()
    {
        $model_name = $this->input->post('model_name', true);
        if (!$model_name) {
            show_error('模型名为空'); //error();
        }

        $model_id = $this->input->post('model_id');
        $attr_id = $this->input->post('attr_id');
        $attr_name = (array)$this->input->post('attr_name');
        $attr_type = $this->input->post('type');
        $attr_value = $this->input->post('attr_value');
        $attr_sort = $this->input->post('sort');

        //echo '<pre>';print_r($this->input->post());
        $attrs = array();

        foreach ($attr_name as $key => $item) {
            if (!$attr_name[$key] || !$attr_value[$key] || !$attr_type[$key])
                continue;
            if ($attr_id)
                $attrs[$key]['attr_id'] = $attr_id[$key];
            $attrs[$key]['attr_name'] = $attr_name[$key];
            $attrs[$key]['type'] = (int)$attr_type[$key];
            $attrs[$key]['attr_value'] = $attr_value[$key];
            $attrs[$key]['sort'] = (int)$attr_sort[$key];

        }

        if (! $attrs) {
            show_error('模型属性为空'); // error();
        }

        $this->load->model('product/Model_Product_Model', 'mod');
        if ($model_id && $attr_id) {
            $this->mod->update($model_id, $model_name, $attrs);
        } else {
            $this->mod->create($model_name, $attrs);
        }
        redirect('administrator/product_model/index');
    }

    /**
     *
     * @param $model_id
     */
    function del()
    {
        $model_id = $this->uri->segment(4, 0);

        if ($model_id) {
            $this->load->model('product/Model_Product_Model', 'mod');
            if ($this->mod->isUse($model_id)) {
                show_error('有产品正在使用该模型,无法删除'); // error();
            } else {
                $this->mod->delete($model_id);
            }
        }
        redirect('/administrator/product_model/index');
    }
}
