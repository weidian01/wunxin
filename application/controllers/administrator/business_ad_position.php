<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-25
 * Time: 上午9:25
 * To change this template use File | Settings | File Templates.
 */
class business_ad_position extends MY_Controller
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
     * 广告位置列表
     */
    public function positionList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('/business/Model_Ad_Position', 'position');
        $totalNum = $this->position->getPositionCount();
        $data = $this->position->getPositionList($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/business_ad_position/positionList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/business/ad/ad_position_list', array('data' => $data, 'page_html' => $pageHtml, 'current_page' => $currentPage));
    }

    /**
     * 广告位置添加
     */
    public function positionAdd()
    {
        $this->load->view('/administrator/business/ad/ad_position_create', array('type' => 'add'));
    }

    /**
     * 广告位置保存
     */
    public function positionSave()
    {
        $name = $this->input->get_post('name');
        $width = intval($this->input->get_post('width'));
        $height = intval($this->input->get_post('height'));
        $viewNum = intval($this->input->get_post('view_num'));
        $status = intval($this->input->get_post('status'));
        $descr = $this->input->get_post('descr');
//echo '<pre>';print_r($_REQUEST);exit;
        if (empty ($name) || empty ($width) || empty ($height) || empty ($viewNum) || empty ($descr)) {
            show_error('参数不全');
        }

        $info = array(
            'name' => $name,
            'width' => $width,
            'height' => $height,
            'status' => $status,
            'view_num' => $viewNum,
            'descr' => $descr,
        );
        $this->load->model('/business/Model_Ad_Position', 'position');
        $stat = $this->position->positionAdd($info);
        if (!$stat) {
            show_error('添加广告位置失败');
        }

        redirect('/administrator/business_ad_position/positionList');
    }

    /**
     * 广告位置修改
     */
    public function positionEdit()
    {
        $pId = $this->uri->segment(4, 1);
        $this->load->model('/business/Model_Ad_Position', 'position');
        $data =$this->position->getPositionByPid($pId);

        $this->load->view('/administrator/business/ad/ad_position_create', array('type' => 'edit', 'info' => $data));
    }

    /**
     * 广告位置修改保存
     */
    public function positionEditSave()
    {
        $name = $this->input->get_post('name');
        $width = intval($this->input->get_post('width'));
        $height = intval($this->input->get_post('height'));
        $viewNum = intval($this->input->get_post('view_num'));
        $status = intval($this->input->get_post('status'));
        $descr = $this->input->get_post('descr');
        $positionId = $this->input->get_post('position_id');
//echo '<pre>';print_r($_REQUEST);exit;
        if (empty ($name) || empty ($width) || empty ($height) || empty ($viewNum) || empty ($descr) || empty ($positionId)) {
            show_error('参数不全');
        }

        $info = array(
            'name' => $name,
            'width' => $width,
            'height' => $height,
            'status' => $status,
            'view_num' => $viewNum,
            'descr' => $descr,
        );
        $this->load->model('/business/Model_Ad_Position', 'position');
        $stat = $this->position->positionEdit($info, $positionId);
        if (!$stat) {
            show_error('修改广告位置失败');
        }

        redirect('/administrator/business_ad_position/positionList');
    }

    /**
     * 广告位置删除
     */
    public function positionDelete()
    {
        $pId = $this->uri->segment(4, 1);
        $currentPage = $this->uri->segment(5, 1);
        if (!$pId) {
            show_error('广告位置ID为空');
        }

        $this->load->model('/business/Model_Ad_Position', 'position');

        if ($this->position->isExistAd($pId)) {
            show_error('此广告位置下还有广告');
        }

        $this->position->positionDelete($pId);

        redirect('/administrator/business_ad_position/positionList/'.$currentPage);
    }
}
