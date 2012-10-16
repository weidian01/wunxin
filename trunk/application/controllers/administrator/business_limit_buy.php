<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-16
 * Time: 下午5:19
 * To change this template use File | Settings | File Templates.
 */
class business_limit_buy extends MY_Controller
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
     * 限时抢购列表
     */
    public function lists()
    {
        $this->load->model('business/model_business_limit_buy', 'lb');
        $data = $this->lb->getList();
//echo '<pre>';print_r($data);exit;
        $this->load->view('/administrator/business/limit_buy/list', array('data' => $data));
    }

    /**
     * 限时抢购创建
     */
    public function create()
    {
        $this->load->view('/administrator/business/limit_buy/create', array('type' => 'add'));
    }

    /**
     * 限时抢购保存
     */
    public function save()
    {

    }

    /**
     * 限时抢购编辑
     */
    public function edit()
    {

    }

    /**
     * 限时抢购编辑保存
     */
    public function edit_save()
    {

    }

    /**
     * 限时抢购分类列表
     */
    public function c_list()
    {
        $this->load->model('business/model_business_limit_buy_category', 'category');
        $category = $this->category->getCategoryList();

        $this->load->view('/administrator/business/limit_buy/c_list', array('category' => $category));
    }

    /**
     * 限时抢购分类创建
     */
    public function c_create()
    {
        $this->load->view('/administrator/business/limit_buy/c_create', array('type' => 'add'));
    }

    /**
     * 限时抢购分类保存
     */
    public function c_save()
    {
        $this->load->model('business/model_business_limit_buy_category', 'category');
        $data['name'] = $this->input->post('cname');
        $data['parent_id'] = $this->input->post('parent_id');
        $data['sort'] = $this->input->post('sort');
        $data['title'] = $this->input->post('title');
        $data['keywords'] = $this->input->post('keywords');
        $data['descr'] = $this->input->post('descr');
        $class_id = $this->input->post('class_id');

        if (!$data['name'])
            show_error('分类名称不能为空');

        $this->category->save($data, $class_id);
        $this->load->helper('url');
        redirect('administrator/business_limit_buy/c_list');
    }

    /**
     * 限时抢购分类编辑
     */
    public function c_edit()
    {
        $class_id = $this->uri->segment(4, 0);
        if (!$class_id) {
            show_error('分类id为空');
        }
        $this->load->model('business/model_business_limit_buy_category', 'category');
        $info = $this->category->getCategoryById($class_id);
        if (!$info) {
            show_error('分类信息不存在');
        }
        $category = $this->category->getCategoryList();
        $this->load->model('product/Model_Product_Model', 'mod');
        $model = $this->mod->getModelList(500);

        $data = array('category' => $category, 'class_id' => $class_id, 'info' => $info, 'h1Title' => '编辑设计图分类', 'type' => 'add');
        $this->load->view('/administrator/business/limit_buy/c_create', $data);
    }

    public function c_del()
    {
        $class_id = $this->uri->segment(4, 0);
        if (!$class_id) {
            show_error('分类id为空');
        }
        $this->load->model('business/model_business_limit_buy_category', 'category');

        if ($this->category->isAlone($class_id)) {
            $this->category->delete($class_id);
            $this->load->helper('url');
            redirect('/administrator/business_limit_buy/c_list');
        } else {
            show_error('该分类下存在子类,不可删除');
        }
    }
}