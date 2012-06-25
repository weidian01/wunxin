<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-18
 * Time: 下午9:36
 * To change this template use File | Settings | File Templates.
 */
class article_category extends MY_Controller
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
     * 分类列表
     */
    public function categoryList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('article/Model_Article_Category', 'article');
        $totalNum = $this->article->getCategoryCount();
        $data = $this->article->getCategoryList($Limit, $offset);
        $cdata = $this->article->getCategoryList();

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/article_category/categoryList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
//echo '<pre>';print_r($cdata);exit;
        $this->load->view('/administrator/article/category/list', array('data' => $data, 'class_data' => $cdata));
    }

    /**
     * 添加分类
     */
    public function categoryAdd()
    {
        $this->load->model('article/Model_Article_Category', 'article');
        $data = $this->article->getCategoryList();

        $this->load->view('/administrator/article/category/create', array('data' => $data, 'type' => 'add'));
    }

    /**
     * 保存分类
     */
    public function categorySave()
    {
        $cName = $this->input->get_post('cname');
        $parentId = $this->input->get_post('parent_id');
        $sort = $this->input->get_post('sort');
        $path = $this->input->get_post('path');

        if (empty ($cName) || empty ($path)) {
            show_error('参数不全');
        }

        $data = array(
            'cname' => $cName,
            'parent_id' => $parentId,
            'sort' => $sort,
            'path' => $path,
        );

        $this->load->model('article/Model_Article_Category', 'article');
        $status = $this->article->addCategory($data);
        if (!$status) {
            show_error('添加分类失败');
        }

        redirect('/administrator/article_category/categoryList');
    }

    /**
     * 修改分类
     */
    public function categoryEdit()
    {
        $cId = $this->uri->segment(4, 1);
        if (!$cId) {
            show_error('分类ID为空');
        }

        $this->load->model('article/Model_Article_Category', 'article');
        $cData = $this->article->getCategoryById($cId);
        $data = $this->article->getCategoryList();

        $this->load->view('/administrator/article/category/create', array('info' => $cData, 'data' => $data, 'type' => 'edit'));
    }

    /**
     * 保存修改分类
     */
    public function categoryEditSave()
    {
        $cName = $this->input->get_post('cname');
        $parentId = $this->input->get_post('parent_id');
        $sort = $this->input->get_post('sort');
        $path = $this->input->get_post('path');
        $cId = $this->input->get_post('cid');

        if (empty ($cName) || empty ($sort) || empty ($path) || empty ($cId)) {
            show_error('参数不全');
        }

        $data = array(
            'cname' => $cName,
            'parent_id' => $parentId,
            'sort' => $sort,
            'path' => $path,
        );

        $this->load->model('article/Model_Article_Category', 'article');
        $status = $this->article->editCategory($data, $cId);
        if (!$status) {
            show_error('修改分类失败');
        }

        redirect('/administrator/article_category/categoryList');
    }

    /**
     * 删除分类
     */
    public function categoryDelete()
    {
        $cId = $this->uri->segment(4, 1);
        if (!$cId) {
            show_error('分类ID为空');
        }

        $this->load->model('article/Model_Article_Category', 'article');

        if (!$this->article->isAlone($cId)) {
            show_error('此分类下还有子类');
        }

        $this->article->deleteCategory($cId);

        redirect('/administrator/article_category/categoryList');
    }
}
