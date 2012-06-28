<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-28
 * Time: 下午12:39
 * To change this template use File | Settings | File Templates.
 */
class business_integral_redemption extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    public function redemptionList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('business/Model_Business_Integral_Redemption', 'ir');
        $totalNum = $this->ir->getIntegralRedemptionCount();
        $data = $this->ir->getIntegralRedemptionList($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/business_integral_redemption/redemptionList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
        $info = array('data' => $data, 'page_html' => $pageHtml, 'current_page' => $currentPage);

        //echo '<pre>';print_r($cdata);exit;
        $this->load->view('/administrator/business/integral_redemption/list', $info);
    }

    public function redemptionAdd()
    {
        $this->load->view('/administrator/business/integral_redemption/create', array('type' => 'add'));
    }

    public function redemptionSave()
    {
        $data['pid'] = $this->input->get_post('pid');
        $data['redemption_integral'] = $this->input->get_post('redemption_integral');
        $data['redemption_price'] = $this->input->get_post('redemption_price') * 100;
        $data['start_time'] = $this->input->get_post('start_time');
        $data['end_time'] = $this->input->get_post('end_time');

        if (empty ($data['pid']) || empty ($data['redemption_integral']) || empty ($data['redemption_price']) || empty ($data['start_time']) || empty ($data['end_time'])) {
            show_error('参数不全');
        }

        $this->load->model('product/Model_Product', 'product');
        $productData = $this->product->getProductById($data['pid']);
        if (!$productData) {
            show_error('添加的积分换购产品不存在');
        }

        $data['price'] = $productData['sell_price'];
        $this->load->model('business/Model_Business_Integral_Redemption', 'ir');
        $lastId = $this->ir->addIntegralRedemption($data);
        if (!$lastId) {
            show_error('添加积分换购产品失败');
        }

        redirect('/administrator/business_integral_redemption/redemptionList');
    }

    public function redemptionEdit()
    {
        $irId = $this->uri->segment(4, 0);
        if (!$irId) {
            show_error('积分换购产品ID为空');
        }

        $this->load->model('business/Model_Business_Integral_Redemption', 'ir');
        $data = $this->ir->getIntegralRedemptionByirId($irId);

        $this->load->view('/administrator/business/integral_redemption/create', array('type' => 'edit', 'info' => $data));
    }

    public function redemptionEditSave()
    {
        $data['pid'] = $this->input->get_post('pid');
        $data['redemption_integral'] = $this->input->get_post('redemption_integral');
        $data['redemption_price'] = $this->input->get_post('redemption_price') * 100;
        $data['start_time'] = $this->input->get_post('start_time');
        $data['end_time'] = $this->input->get_post('end_time');
        $data['redemption_id'] = intval($this->input->get_post('redemption_id'));

        if (empty ($data['pid']) || empty ($data['redemption_integral']) || empty ($data['redemption_price']) || empty ($data['start_time']) || empty ($data['end_time']) || empty ($data['redemption_id'])) {
            show_error('参数不全');
        }

        $this->load->model('product/Model_Product', 'product');
        $productData = $this->product->getProductById($data['pid']);
        if (!$productData) {
            show_error('修改的积分换购产品不存在');
        }

        $data['price'] = $productData['sell_price'];
        $this->load->model('business/Model_Business_Integral_Redemption', 'ir');
        $lastId = $this->ir->editIntegralRedemption($data, $data['redemption_id']);
        if (!$lastId) {
            show_error('修改积分换购产品失败');
        }

        redirect('/administrator/business_integral_redemption/redemptionList');
    }

    public function redemptionDelete()
    {
        $irId = $this->uri->segment(4, 0);
        $currentPage = $this->uri->segment(5, 1);

        if (!$irId) {
            show_error('积分换购产品ID为空');
        }

        $this->load->model('business/Model_Business_Integral_Redemption', 'ir');
        $status = $this->ir->deleteIntegralRedemption($irId);
        if (!$status) {
            show_error('删除积分换购产品失败');
        }

        redirect('/administrator/business_integral_redemption/redemptionList/'.$currentPage);
    }
}
