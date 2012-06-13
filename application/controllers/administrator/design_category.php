<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-12
 * Time: 下午3:21
 * To change this template use File | Settings | File Templates.
 */
class design_category extends MY_Controller
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
        $this->load->model('design/Model_Design_Category', 'category');
        $category = $this->category->getCategoryList();
        $this->load->view('administrator/design/category/category_index', array('category' => $category));
    }

    /**
     * 创建一个分类
     */
    public function create()
    {
        $this->load->model('design/Model_Design_Category', 'category');
        $category = $this->category->getCategoryList();
        //$this->load->model('product/Model_Product_Model', 'mod');
        //$model = $this->mod->getModelList(500);
        $this->load->view('administrator/design/category/category_create', array('category' => $category, 'h1Title' => '添加设计图分类'));
    }

    /**
     * 编辑一条分类信息
     */
    public function edit()
    {
        $class_id = $this->uri->segment(4, 0);
        if (!$class_id) {
            show_error('分类id为空');
        }
        $this->load->model('design/Model_Design_Category', 'category');
        $info = $this->category->getCategoryById($class_id);
        if (!$info) {
            show_error('分类信息不存在');
        }
        $category = $this->category->getCategoryList();
        $this->load->model('product/Model_Product_Model', 'mod');
        $model = $this->mod->getModelList(500);
        $this->load->view('administrator/design/category/category_create', array('category' => $category, 'class_id' => $class_id, 'info' => $info, 'h1Title' => '编辑设计图分类'));
    }

    public function save()
    {
        $this->load->model('design/Model_Design_Category', 'category');
        $data['cname'] = $this->input->post('cname');
        $data['parent_id'] = $this->input->post('parent_id');
        $data['sort'] = $this->input->post('sort');
        $data['title'] = $this->input->post('title');
        $data['keywords'] = $this->input->post('keywords');
        $data['descr'] = $this->input->post('descr');
        $class_id = $this->input->post('class_id');

        if (!$data['cname'])
            show_error('分类名称不能为空');

        $this->category->save($data, $class_id);
        $this->load->helper('url');
        redirect('administrator/design_category/index');
    }


    /**
     * 删除一个分类
     */
    public function del()
    {
        $class_id = $this->uri->segment(4, 0);
        if (!$class_id) {
            show_error('分类id为空');
        }
        $this->load->model('design/Model_Design_Category', 'category');

        if ($this->category->isAlone($class_id)) {
            $this->category->delete($class_id);
            $this->load->helper('url');
            redirect('/administrator/design_category/index');
        } else {
            show_error('该分类下存在子类,不可删除');
        }

    }
}
