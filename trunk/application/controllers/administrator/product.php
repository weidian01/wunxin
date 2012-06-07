<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午4:32
 * To change this template use File | Settings | File Templates.
 */
class product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ( !$this->AdminIsLogin() ) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    /**
     * 模型列表页面
     */
    public function model_list()
    {
        $page = $this->uri->segment(4,1);
        $pagesize = 20;
        $page = (abs($page) - 1) * $pagesize;
        $this->load->model('product/Model_Product_Model', 'mod');
        $data = $this->mod->getModelList($pagesize, $page);
        $this->load->view('administrator/product/model_list', array('models' => $data));
    }


    public function model_edit()
    {
        $model_id = $this->uri->segment(4,0);
        if(! $model_id)
        {
            show_error('模型id为空');
        }
        $this->load->model('product/Model_Product_Model', 'mod');
        $data = $this->mod->getModel($model_id);
        echo '<pre>';print_r($data);
    }

    /**
     * 创建一个新模型页面
     */
    public function model_create()
    {
        $this->load->view('administrator/product/model_create', array('username' => $this->amInfo['am_uname']));
    }

    /**
     * 创建一个新模型及其属性
     */
    public function model_save()
    {
        $model_name = $this->input->post('model_name', true);
        if(! $model_name)
        {
            show_error('模型名为空'); //error();
        }
        $attr_name = $this->input->post('attr_name');
        $attr_type = $this->input->post('type');
        $attr_value = $this->input->post('attr_value');
        $attr_sort = $this->input->post('sort');
        //echo '<pre>';print_r($this->input->post());
        $attrs = array();

        foreach($attr_name as $key => $item)
        {
            if(! $attr_name[$key] || ! $attr_value[$key] || ! $attr_type[$key])
                continue;
            $attrs[$key]['name'] = $attr_name[$key];
            $attrs[$key]['type'] = (int)$attr_type[$key];
            $attrs[$key]['value'] = $attr_value[$key];
            $attrs[$key]['sort'] = (int)$attr_sort[$key];

        }

        if(! $attrs)
        {
            show_error('模型属性为空');// error();
        }

        $this->load->model('product/Model_Product_Model', 'mod');
        $this->mod->Model_create($model_name, $attrs);

    }
}
