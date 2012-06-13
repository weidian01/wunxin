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
        $this->load->model('product/Model_Design_Category', 'category');
        $category = $this->category->getCategroyList();
        $this->load->model('product/Model_Product_Model', 'mod');
        $model = $this->mod->getModelList(500);
        $this->load->view('administrator/product/category/create', array('category' => $category, 'model' => $model));
    }
}
