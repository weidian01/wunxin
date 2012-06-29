<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-28
 * Time: 下午5:23
 * To change this template use File | Settings | File Templates.
 */
class product_collocation extends MY_Controller
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
     * 产品搭配列表
     */
    public function pcList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $pcId = intval($this->uri->segment(5, 0));
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('product/Model_Product_Collocation', 'pc');
        if ($pcId) {
            $totalNum = $this->pc->getProductPcCount($pcId);
            $data = $this->pc->getProductPcList($pcId, $Limit, $offset);
        } else {
            $totalNum = $this->pc->getPcCount();
            $data = $this->pc->getPcList($Limit, $offset);
        }

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/product_collocation/pcList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
        $info = array('data' => $data, 'pc_id' => $pcId, 'page_html' => $pageHtml, 'current_page' => $currentPage);

        //echo '<pre>';print_r($cdata);exit;
        $this->load->view('/administrator/product/product_collocation/list', $info);
    }

    /**
     * 添加产品搭配
     */
    public function pcAdd()
    {
        $this->load->view('/administrator/product/product_collocation/create', array('type' => 'add'));
    }

    /**
     * 产品搭配保存
     */
    public function pcSave()
    {
        $data['pid'] = intval($this->input->get_post('pid'));
        $data['spid'] = intval($this->input->get_post('spid'));
        $data['sort'] = intval($this->input->get_post('sort'));

        if (empty ($data['pid']) || empty ($data['spid']) || empty ($data['sort'])) {
            show_error('参数不全');
        }

        $this->load->model('product/Model_Product', 'product');
        $productData = $this->product->getProductById($data['pid']);
        if (!$productData) {
            show_error('添加产品搭配， 产品不存在');
        }

        $pcProductData = $this->product->getProductById($data['spid']);
        if (!$pcProductData) {
            show_error('添加产品搭配， 被搭配产品不存在');
        }

        $this->load->model('product/Model_Product_Collocation', 'pc');
        $status = $this->pc->pcAdd($data);
        if (!$status) {
            show_error('添加产品搭配失败');
        }

        redirect('/administrator/product_collocation/pcList/');
    }

    /**
     * 修改产品搭配
     */
    public function pcEdit()
    {
        $pcId = intval($this->uri->segment(4, 0));
        if (!$pcId) {
            show_error('产品搭配ID为空');
        }

        $this->load->model('product/Model_Product_Collocation', 'pc');
        $data = $this->pc->getPcByPcId($pcId);

        $this->load->view('/administrator/product/product_collocation/create', array('type' => 'edit', 'info' => $data));
    }

    /**
     * 保存修改产品搭配
     */
    public function pcEditSave()
    {
        $data['pid'] = intval($this->input->get_post('pid'));
        $data['spid'] = intval($this->input->get_post('spid'));
        $data['sort'] = intval($this->input->get_post('sort'));
        $pcId = intval($this->input->get_post('id'));

        if (empty ($data['pid']) || empty ($data['spid']) || empty ($data['sort'])) {
            show_error('参数不全');
        }

        $this->load->model('product/Model_Product', 'product');
        $productData = $this->product->getProductById($data['pid']);
        if (!$productData) {
            show_error('添加产品搭配， 产品不存在');
        }

        $pcProductData = $this->product->getProductById($data['spid']);
        if (!$pcProductData) {
            show_error('添加产品搭配， 被搭配产品不存在');
        }

        $this->load->model('product/Model_Product_Collocation', 'pc');
        $status = $this->pc->pcEdit($data, $pcId);
        if (!$status) {
            show_error('修改产品搭配失败');
        }

        redirect('/administrator/product_collocation/pcList/');
    }

    /**
     * 搜索产品搭配
     */
    public function search()
    {
        $sType = intval($this->input->get_post('s_type'));
        $keyword = $this->input->get_post('keyword');

        if (!$keyword) {
            show_error('搭配产品ID为空');
        }

        $this->load->model('product/Model_Product_Collocation', 'pc');
        switch ($sType)
        {
            case '1': $data[] = $this->pc->getPcByPcId($keyword, 1000);break;
            case '2': $data = $this->pc->getProductPcList($keyword, 1000);break;
            default:$data[] = $this->pc->getPcByPcId($keyword);
        }

        $this->load->view('/administrator/product/product_collocation/list', array('data' => $data, 's_type' => $sType, 'keyword' => $keyword));
    }

    /**
     * 删除产品搭配
     */
    public function pcDelete()
    {
        $pcId = $this->uri->segment(4, 0);
        $currentPage = $this->uri->segment(5, 1);

        if (!$pcId) {
            show_error('产品搭配ID为空');
        }

        $this->load->model('product/Model_Product_Collocation', 'pc');
        $status = $this->pc->deletePcByPcId($pcId);
        if (!$status) {
            show_error('删除产品搭配失败');
        }

        redirect('/administrator/product_collocation/pcList/'.$currentPage);
    }
}
