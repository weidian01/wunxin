<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-20
 * Time: 下午5:55
 * To change this template use File | Settings | File Templates.
 */
class article extends MY_Controller
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
     * 文章列表
     */
    public function articleList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('article/Model_Article', 'article');
        $this->load->model('article/Model_Article_Category', 'category');
        $totalNum = $this->article->getNewsCount();
        $data = $this->article->getNewsList($Limit, $offset);
        $cdata = $this->category->getCategoryList();

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/article/articleList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
//echo '<pre>';print_r($data);exit;
        $this->load->view('/administrator/article/list', array('data' => $data, 'class_data' => $cdata, 'page_html' => $pageHtml, 'current_page' => $currentPage));
    }

    /**
     * 分类文章列表
     */
    public function articleCLass()
    {
        $cId = $this->uri->segment(4, 1);
        if (!$cId) {
            show_error('分类ID为空');
        }

        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('article/Model_Article', 'article');
        $this->load->model('article/Model_Article_Category', 'category');
        $totalNum = $this->article->getNewsCategoryCount($cId);
        $data = $this->article->getNewsCategoryList($cId, $Limit, $offset);
        $cdata = $this->category->getCategoryList($cId);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/article/articleList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/article/list', array('data' => $data, 'class_data' => $cdata, 'page_html' => $pageHtml));
    }

    /**
     * 添加文章
     */
    public function articleAdd()
    {
        $this->load->model('article/Model_Article_Category', 'category');
        $data = $this->category->getCategoryList();

        $this->load->view('/administrator/article/create', array('class_data' => $data, 'type' => 'add'));
    }

    /**
     * 保存文章
     */
    public function articleSave()
    {
        $title = $this->input->get_post('title');
        $cid = $this->input->get_post('cid');
        $keyword = $this->input->get_post('keyword');
        $descr = $this->input->get_post('descr');
        $visiblity = $this->input->get_post('visiblity');
        $top = $this->input->get_post('top');
        $content = $this->input->get_post('content');

        if (empty ($title) || empty ($keyword) || empty ($descr) || empty ($content)) {
            show_error('参数不全');
        }

        $data = array(
            'cid' => $cid,
            'title' => $title,
            'content' => $content,
            'keywords' => $keyword,
            'descr' => $descr,
            'visiblity' => $visiblity,
            'top' => $top,
        );
        $this->load->model('article/Model_Article', 'article');
        $status = $this->article->addNews($data);
        if (!$status) {
            show_error('添加文章失败');
        }

        redirect('/administrator/article/articleList');
    }

    /**
     * 文章修改
     */
    public function articleEdit()
    {
        $id = $this->uri->segment(4, 1);
        if (!$id) {
            show_error('文章ID为空');
        }

        $this->load->model('article/Model_Article', 'article');
        $data = $this->article->getNewsById($id);

        $this->load->model('article/Model_Article_Category', 'category');
        $cData = $this->category->getCategoryList();

        $this->load->view('/administrator/article/create', array('info' => $data, 'class_data' => $cData, 'type' => 'edit'));
    }

    /**
     * 保存修改文章
     */
    public function articleEditSave()
    {
        $title = $this->input->get_post('title');
        $cid = $this->input->get_post('cid');
        $keyword = $this->input->get_post('keyword');
        $descr = $this->input->get_post('descr');
        $visiblity = $this->input->get_post('visiblity');
        $top = $this->input->get_post('top');
        $content = htmlspecialchars( stripslashes($_REQUEST['content']));//$this->input->get_post('content');
        $id = $this->input->get_post('id');
        //echo '<pre>';print_r($_REQUEST);exit;
//echo $content;exit;
        if (empty ($title) || empty ($keyword) || empty ($descr) || empty ($content)) {
            show_error('参数不全');
        }

        $data = array(
            'cid' => $cid,
            'title' => $title,
            'content' => $content,
            'keywords' => $keyword,
            'descr' => $descr,
            'visiblity' => $visiblity,
            'top' => $top,
        );
        $this->load->model('article/Model_Article', 'article');
        $status = $this->article->editNews($data, $id);
        if (!$status) {
            show_error('修改文章失败');
        }

        redirect('/administrator/article/articleList');
    }

    /**
     * 删除文章
     */
    public function articleDelete()
    {
        $id = $this->uri->segment(4, 1);
        $currentPage = $this->uri->segment(5, 1);
        if (!$id) {
            show_error('文章ID为空');
        }

        $this->load->model('article/Model_Article', 'article');
        $status = $this->article->deleteNewsByNewsId($id);
        if (!$status) {
            show_error('删除文章失败');
        }

        redirect('/administrator/article/articleList/'.$currentPage);
    }
}
