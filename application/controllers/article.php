<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-9-18
 * Time: 上午11:00
 * To change this template use File | Settings | File Templates.
 */
class article extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->isLogin()) {
            //redirect("user/login");
        }

        if(! $this->input->is_ajax_request()){
            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }
    }

    public function info()
    {
        $articleId = $this->uri->segment(3, 0);//$this->input->get_post('id');

        if (empty ($articleId)) {
            show_error('文章ID为空');
        }

        $this->load->model('article/Model_Article', 'article');
        $data = $this->article->getNewsById($articleId);

        if (empty ($data)) {
            //show_error('文章不存在');
        }

        $this->load->view('other/article', array('data' => $data));
    }

    public function dynamic()
    {
        $articleId = $this->uri->segment(3, 0);//$this->input->get_post('id');

        if (empty ($articleId)) {
            show_error('文章ID为空');
        }

        $this->load->model('article/Model_Article', 'article');
        $data = $this->article->getNewsById($articleId);

        if (empty ($data)) {
            //show_error('文章不存在');
        }

        $this->load->view('other/dynamic', array('data' => $data));
    }
}
