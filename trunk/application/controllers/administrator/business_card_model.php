<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-25
 * Time: 下午4:28
 * To change this template use File | Settings | File Templates.
 */
class business_card_model extends MY_Controller
{
    public $cardType = array(
        array('id' => '1', 'name' => '礼物卡',),
        array('id' => '2', 'name' => '代金卷',),
        array('id' => '3', 'name' => '返现卡',),
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
     * 卡模型列表
     */
    public function cardModelList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('/business/Model_Gift_Card_Model', 'model');
        $totalNum = $this->model->getCardModelCount();
        $data = $this->model->getCardModelList($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/business_card_model/cardModelList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/business/card/model_list', array('data' => $data, 'card_type' => $this->cardType, 'page_html' => $pageHtml, 'current_page' => $currentPage));
    }

    /**
     * 添加卡模型
     */
    public function cardModelAdd()
    {
        $this->load->view('/administrator/business/card/model_create', array('type' => 'add', 'card_type' => $this->cardType));
    }

    /**
     * 卡模型保存
     */
    public function cardModelSave()
    {
        $cardName = $this->input->get_post('card_name');
        $cardType = intval($this->input->get_post('card_type'));
        $cardAmount = intval($this->input->get_post('card_amount'));
        $cardNum = $this->input->get_post('card_num');

        if (empty ($cardName) || empty ($cardType) || empty ($cardAmount) || empty ($cardNum)) {
            show_error('参数不全');
        }

        $data = array(
            'card_name' => $cardName,
            'card_type' => $cardType,
            'card_amount' => $cardAmount,
            'card_num' => $cardNum,
        );
        $this->load->model('/business/Model_Gift_Card_Model', 'model');
        $lastId = $this->model->addCardModel($data);
        if (!$lastId) {
            show_error('添加卡模型失败');
        }

        redirect('/administrator/business_card_model/cardModelList/');
    }

    /**
     * 卡模型修改
     */
    public function cardModelEdit()
    {
        $mId = $this->uri->segment(4, 1);

        $this->load->model('/business/Model_Gift_Card_Model', 'model');
        $data = $this->model->getCardModelByMid($mId);
//echo '<pre>';print_r($data);exit;
        $this->load->view('/administrator/business/card/model_create', array('info' => $data, 'type' => 'edit', 'card_type' => $this->cardType));
    }

    /**
     * 卡模型修改保存
     */
    public function cardModelEditSave()
    {
        $cardName = $this->input->get_post('card_name');
        $cardType = intval($this->input->get_post('card_type'));
        $cardAmount = intval($this->input->get_post('card_amount'));
        $cardNum = $this->input->get_post('card_num');
        $modelId = $this->input->get_post('model_id');

        if (empty ($cardName) || empty ($cardType) || empty ($cardAmount) || empty ($cardNum) || empty ($modelId)) {
            show_error('参数不全');
        }

        $data = array(
            'card_name' => $cardName,
            'card_type' => $cardType,
            'card_amount' => $cardAmount,
            'card_num' => $cardNum,
        );
        $this->load->model('/business/Model_Gift_Card_Model', 'model');
        $lastId = $this->model->editCardModel($data, $modelId);
        if (!$lastId) {
            show_error('修改卡模型失败');
        }

        redirect('/administrator/business_card_model/cardModelList/');
    }

    /**
     * 卡模型删除
     */
    public function cardModelDelete()
    {
        $aId = $this->uri->segment(4, 1);
        $currentPage = $this->uri->segment(5, 1);
        if (!$aId) {
            show_error('卡模型ID为空');
        }

        $this->load->model('/business/Model_Gift_Card_Model', 'model');
        $this->model->cardModelDelete($aId);

        redirect('/administrator/business_card_model/cardModelList/'.$currentPage);
    }
}
