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
        $type = $this->input->get_post('model_type');

        $where = array();
        if (!empty ($type)) {
            $where = 'card_type='.$type;
        }
//echo $where;
        $this->load->model('/business/Model_Gift_Card_Model', 'model');
        $totalNum = $this->model->getCardModelCount($where);
        $data = $this->model->getCardModelList($Limit, $offset, '*', $where);

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

        $info = array(
            'data' => $data,
            'card_type' => config_item('card_type'),
            'page_html' => $pageHtml,
            'current_page' => $currentPage,
        );
        $this->load->view('/administrator/business/card/model_list', $info);
    }

    /**
     * 添加卡模型
     */
    public function cardModelAdd()
    {
        $this->load->view('/administrator/business/card/model_create', array('type' => 'add', 'card_type' => config_item('card_type')));
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
        $descr = $this->input->get_post('descr');
        $endTime = $this->input->get_post('end_time');
        $modelId = $this->input->get_post('model_id');

        if (empty ($cardName) || empty ($cardType) || empty ($cardAmount) || empty ($cardNum) || empty ($descr) || empty ($endTime)) {
            show_error('参数不全');
        }

        $configCardType = config_item('card_type');
        if (!array_key_exists($cardType, $configCardType)) {
            show_error('意外的卡类型！');
        }

        $conf = array();
        switch ($cardType) {
            case CARD_GOLD:
                $this->load->model('card/model_card_gold', 'm_card');
                $conf['limit'] = $this->input->get_post('limit');
                $conf['limit_use_num'] = $this->input->get_post('limit_use_num');
                $conf['limit_product'] = $this->input->get_post('limit_product');
                break;
            case CARD_SILVER:
                $this->load->model('card/model_card_silver', 'm_card');
                $conf['limit'] = $this->input->get_post('limit');
                $conf['limit_use_num'] = $this->input->get_post('limit_use_num');
                $conf['limit_product'] = $this->input->get_post('limit_product');
                break;
            case CARD_COPPER:
                $this->load->model('card/model_card_copper', 'm_card');
                $conf['limit'] = $this->input->get_post('limit');
                $conf['limit_use_num'] = $this->input->get_post('limit_use_num');
                $conf['limit_product'] = $this->input->get_post('limit_product');
                break;
            default:
                $this->load->model('card/model_card_gold', 'm_card');
                $conf['limit'] = $this->input->get_post('limit');
                $conf['limit_use_num'] = $this->input->get_post('limit_use_num');
                $conf['limit_product'] = $this->input->get_post('limit_product');
        }

        $rule = $this->m_card->buildRule($conf);

        $data = array(
            'card_name' => $cardName,
            'card_type' => $cardType,
            'card_amount' => $cardAmount * 100,
            'card_num' => $cardNum,
            'rule' => $rule,
            'end_time' => $endTime,
            'descr' => $descr,
        );

        $this->load->model('/business/Model_Gift_Card_Model', 'model');

        if ($modelId) {
            $lastId = $this->model->editCardModel($data, $modelId);
        } else {
            $lastId = $this->model->addCardModel($data);
        }

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

        $info = array(
            'info' => $data,
            'type' => 'edit',
            'card_type' => config_item('card_type'),
        );
        $this->load->view('/administrator/business/card/model_create', $info);
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

    /**
     * 卡列表
     */
    public function cardList()
    {
        $searchType = array(
            '1' => '卡号',
            '2' => '模型ID',
            '3' => '用户ID',
        );
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;
        $keyword = $this->input->get_post('keyword');
        $sType = $this->input->get_post('s_type');

        $where = array();
        switch ($sType) {
            case '1': $where = 'card_no="'.$keyword.'"'; break;
            case '2': $where = 'model_id='.$keyword; break;
            case '3': $where = 'uid='.$keyword;break;
        }

        $this->load->model('/business/Model_Gift_Card_model', 'model');
        $modelData = $this->model->getCardModelList();
//p($_REQUEST);exit;
        $this->load->model('/business/Model_Gift_Card', 'card');
        $totalNum = $this->card->getCardCount($where);
        $data = $this->card->getCardList($Limit, $offset, '*', $where);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/business_card_model/cardList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $info = array(
            'data' => $data,
            'card_type' => config_item('card_type'),
            'page_html' => $pageHtml,
            'current_page' => $currentPage,
            'model_data' => $modelData,
            'searchType' => $searchType,
            'sType' => $sType,
            'keyword' => $keyword,
        );
        $this->load->view('/administrator/business/card/card_list', $info);
    }

    /**删除卡
    public function cardDelete()
    {
        $id = $this->uri->segment(4, 1);
        if (!$id) {
            show_error('卡ID为空');
        }

        $this->load->model('/business/Model_Gift_Card', 'card');
        $this->card->deleteCard(array('id' => $id));

        redirect('/administrator/business_card_model/cardModelList/');
    }
    //*/
}
