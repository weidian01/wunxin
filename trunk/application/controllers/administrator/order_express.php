<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-18
 * Time: 下午6:40
 * To change this template use File | Settings | File Templates.
 */
class order_express extends MY_Controller
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
     * 快递公司列表
     */
    public function expressList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('order/Model_Order_Express', 'express');
        $totalNum = $this->express->getExpressCompanyCount();
        $data = $this->express->getExpressCompany($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/order_receiver/userReceiverList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/order/express/express_list', array('data' => $data));
    }

    /**
     * 添加快递公司
     */
    public function addExpressCompany()
    {
        $this->load->view('/administrator/order/express/express_add', array('type' => 'add'));
    }

    /**
     * 保存快递公司
     */
    public function saveExpress()
    {
        $name = $this->input->get_post('name');
        $descr = $this->input->get_post('detail');
        $website = $this->input->get_post('website');
        $sort = $this->input->get_post('order');

        if (empty ($name) || empty ($descr) || empty ($website) || empty ($sort)) {
            show_error('参数不全');
        }

        $data = array(
            'name' => $name,
            'descr' => $descr,
            'website' => $website,
            'sort' => $sort,
        );
        $this->load->model('order/Model_Order_Express', 'express');
        $lastId = $this->express->addExpressCompany($data);
        if (!$lastId) {
            show_error('添加快递公司失败');
        }

        redirect('/administrator/order_express/expressList');
    }

    /**
     * 修改快递公司
     */
    public function editExpressCompany()
    {
        $eId = $this->uri->segment(4, 1);
        if (!$eId) {
            show_error('快递公司ID为空');
        }

        $this->load->model('order/Model_Order_Express', 'express');
        $data = $this->express->getExpressCompanyById($eId);

        $this->load->view('/administrator/order/express/express_add', array('type' => 'edit', 'data' => $data));
    }

    /**
     * 保存修改快递公司信息
     */
    public function saveEditExpressCompany()
    {
        $name = $this->input->get_post('name');
        $descr = $this->input->get_post('detail');
        $website = $this->input->get_post('website');
        $sort = $this->input->get_post('order');
        $eId = $this->input->get_post('eid');

        if (empty ($name) || empty ($descr) || empty ($website) || empty ($sort) || empty ($eId)) {
            show_error('参数不全');
        }

        $data = array(
            'name' => $name,
            'descr' => $descr,
            'website' => $website,
            'sort' => $sort,
        );
        $this->load->model('order/Model_Order_Express', 'express');
        $lastId = $this->express->editExpress($data, $eId);
        if (!$lastId) {
            show_error('修改快递公司失败');
        }

        redirect('/administrator/order_express/expressList');
    }

    /**
     * 删除快递公司
     */
    public function deleteExpressCompany()
    {
        $eId = $this->uri->segment(4, 1);
        if (!$eId) {
            show_error('快递公司ID为空');
        }

        $this->load->model('order/Model_Order_Express', 'express');
        $status = $this->express->deleteExpress($eId);
        if (!$status) {
            show_error('删除快递公司失败');
        }

        redirect('/administrator/order_express/expressList');
    }
}
