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
        //echo '<pre>';print_r($cdata);exit;
        $this->load->view('/administrator/article/list', array('data' => $data, 'class_data' => $cdata));
    }

    public function articleAdd()
    {

    }

    public function articleSave()
    {

    }

    public function articleEdit()
    {

    }

    public function articleEditSave()
    {

    }

    public function articleDelete()
    {

    }
}
