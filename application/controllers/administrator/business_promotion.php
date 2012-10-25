<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-23
 * Time: 下午2:59
 * To change this template use File | Settings | File Templates.
 */
class business_promotion extends MY_Controller
{
    public $promotionType = array(
        '1' => '限时抢购',
        '2' => '特价热卖',
    );

    public $promotion_range = array(
        '1' => '全系统',
        '2' => '特定产品',
    );

    public $searchType = array(
        1 => '商品ID',
        2 => '商品名称',
    );

    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    /**
     * 促销活动列表
     */
    public function lists()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('/business/model_business_promotion', 'promotion');
        $totalNum = $this->promotion->getPromotionCount();
        $data = $this->promotion->getPromotionList($Limit, $offset);
//echo '<pre>';print_r($data);exit;
        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/business_promotion/lists/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $vData = array(
            'data' => $data,
            'page_html' => $pageHtml,
            'current_page' => $currentPage,
            'promotion_type' => $this->promotionType,
            'promotion_range' => $this->promotion_range,
        );
        $this->load->view('/administrator/business/promotion/list', $vData);
    }

    /**
     * 添加促销活动
     */
    public function create()
    {
        $data = array(
            'type' => 'add',
            'promotion_type' => $this->promotionType,
            'promotion_range' => $this->promotion_range,
        );
        $this->load->view('/administrator/business/promotion/create', $data);
    }

    /**
     * 保存促销活动
     */
    public function save()
    {
        $data['name'] = $this->input->get_post('name');
        $data['promotion_range'] = intval($this->input->get_post('promotion_range'));
        $data['promotion_type'] = intval($this->input->get_post('promotion_type'));
        $data['start_time'] = $this->input->get_post('start_time');
        $data['end_time'] = $this->input->get_post('end_time');
        $data['descr'] = $this->input->get_post('descr');
        $data['is_juxtaposed'] = intval($this->input->get_post('is_juxtaposed'));
        $data['priority'] = intval($this->input->get_post('priority'));
        $promotionId = intval($this->input->get_post('promotion_id'));

        if ( empty ($data['name']) ||
            empty ($data['promotion_range']) ||
            empty ($data['promotion_type']) ||
            empty ($data['start_time']) ||
            empty ($data['end_time']) ||
            empty ($data['descr']) ) {
            show_error('参数不全！');
        }

        if (strtotime($data['start_time']) >= strtotime($data['end_time'])) {
            show_error('开始时间不能大于或等于结束时间！');
        }

        $this->load->model('/business/model_business_promotion', 'promotion');

        if ($promotionId) {
            $status = $this->promotion->editPromotion($data, $promotionId);
        } else {
            $status = $this->promotion->addPromotion($data);
        }
        if (!$status) {
            show_error('添加/修改促销活动失败！');
        }

        $this->load->helper('url');
        redirect('administrator/business_promotion/lists');
    }

    /**
     * 编辑促销活动
     */
    public function edit()
    {
        $id = $this->uri->segment(4, 0);
        if (!$id) {
            show_error('促销活动id为空');
        }

        $this->load->model('/business/model_business_promotion', 'promotion');
        $data = $this->promotion->getPromotion($id);
        if ( empty ($data) ) {
            show_error('促销活动不存在！');
        }

        $info = array(
            'type' => 'add',
            'info' => $data,
            'promotion_type' => $this->promotionType,
            'promotion_range' => $this->promotion_range,
        );
        $this->load->view('/administrator/business/promotion/create', $info);
    }

    /**
     * 删除促销活动
     */
    public function delete()
    {
        $id = $this->uri->segment(4, 0);
        if (!$id) {
            show_error('促销活动id为空');
        }

        $this->load->model('/business/model_business_promotion', 'promotion');

        $status = $this->promotion->deletePromotion($id);
        if (!$status) {
            show_error('删除促销活动失败！');
        }

        $this->load->helper('url');
        redirect('administrator/business_promotion/lists');
    }



}