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
        $cardAmount = $cardAmount * 100;
        $cardNum = $this->input->get_post('card_num');
        $descr = $this->input->get_post('descr');
        $endTime = $this->input->get_post('end_time');
        $modelId = $this->input->get_post('model_id');
        $rule = '';
        if ($cardType == CARD_MILLION || $cardType == CARD_THOUSAND) {
            $rule = $this->input->get_post('rule');
            $rule = $rule * 100;
        }

        if (empty ($cardName) || empty ($cardType) || empty ($cardAmount) || empty ($cardNum) || empty ($descr) || empty ($endTime)) {
            show_error('参数不全');
        }

        $configCardType = config_item('card_type');
        if (!array_key_exists($cardType, $configCardType)) {
            show_error('意外的卡类型！');
        }

        /*
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
        //*/
        $data = array(
            'card_name' => $cardName,
            'card_type' => $cardType,
            'card_amount' => $cardAmount,
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
        $data = $this->model->getCardModel($mId);

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
        $mId = $this->uri->segment(4, 0);
        $currentPage = $this->uri->segment(5, 1);
        if (!$mId) {
            show_error('卡模型ID为空');
        }

        $this->load->model('/business/Model_Gift_Card', 'card');
        $cardData = $this->card->getCardByMId($mId);
        if (!empty ($cardData)) {
            show_error('此卡模型下还有卡！');
        }

        $this->load->model('/business/Model_Gift_Card_Model', 'model');
        $this->model->cardModelDelete($mId);

        redirect('/administrator/business_card_model/cardModelList/'.$currentPage);
    }

    /**
     * 生成卡
     */
    public function generationCard()
    {
        $mId = (int)$this->input->get_post('model_id');

        $response = array('error' => '0', 'msg' => '生成礼品卡成功', 'code' => 'generation_gift_card_success');

        do {
            if (empty ($mId)) {
                $response = error(70026);
                break;
            }

            $this->load->model('/business/Model_Gift_Card_Model', 'model');
            $modelData = $this->model->getCardModel($mId);

            if (empty ($modelData)) {
                $response = error(70024);
                break;
            }

            if ($modelData['card_amount'] < 1) {
                $response = error(70021);
                break;
            }
            $cardAmount = $modelData['card_amount'];

            if ($modelData['card_num'] < 1) {
                $response = error(70027);
                break;
            }
            $cardNum = $modelData['card_num'];

            if ($modelData['end_time'] < date('Y-m-d H:i:s', TIMESTAMP)) {
                $response = error(70018);
                break;
            }

            $this->load->model('business/model_gift_card', 'card');
            $cardData = $this->card->getCardCountByMId($mId);

            //判断当前卡数量是否大于或等于模型中的卡数量
            if ($cardData >= $cardNum) {
                $this->model->updateCardModel(array('is_generation' => '1'), $mId);
                break;
            }

            //最终要生成多少张卡
            $randNum = mt_rand(10000, 99999);
            $cardNum = $cardNum - $cardData;
            $generationNum = $randNum + $cardNum;

            $model_id = str_pad($mId, 6, '0', STR_PAD_LEFT);
            for ($i = $randNum; $i < $generationNum; $i++) {
                $unIqId = str_pad($i, 10, '0', STR_PAD_LEFT);
                $cardNo = $model_id.$unIqId;
                $password = mt_rand(100000, 999999);

                $data = array(
                    'card_no' => $cardNo,
                    'model_id' => $mId,
                    'card_amount' => $cardAmount,
                    'card_pass' => $password,
                    'integral' => $cardAmount,
                    'end_time' => $modelData['end_time'],
                );

                $this->card->addCard($data);
            }

            $this->model->updateCardModel(array('is_generation' => '1'), $mId);
        } while (false);

        $this->json_output($response);
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

    public function cardProduct()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;
        $where = null;
        $modelId = $this->uri->segment(4, 0);

        if ($modelId) {
            $where['model_id'] = $modelId;
        }

        $this->load->model('/business/Model_Gift_Card_model', 'model');
        $modelData = $this->model->getCardModelList(1000);

        $this->load->model('/business/model_gift_card_product', 'c_product');
        $totalNum = $this->c_product->getProductCount($where);
        $data = $this->c_product->getList($Limit, $offset, '*', $where);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/business_card_model/cardProduct/'.$modelId;
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $info = array(
            'data' => $data,
            'model' => $modelData,
            'page_html' => $pageHtml,
            'current_page' => $currentPage,
            'card_type' => config_item('card_type'),
        );
        $this->load->view('/administrator/business/card/card_product_list', $info);
    }

    /**
     * 加入礼物卡销售
     */
    public function joinSales()
    {
        $keyword = $this->input->get_post('keyword');
        $sType = $this->input->get_post('s_type');
        $pageHtml = '';

        $modelId = $this->uri->segment(4, 0);
        if (empty ($modelId)) {
            show_error('参数不全！');
        }

        $this->load->model('/business/Model_Gift_Card_model', 'model');
        $modelData = $this->model->getCardModel($modelId);
        if (empty ($modelData)) {
            show_error('卡模型不存在！');
        }

        if ($modelData['card_type'] == CARD_GOLD || $modelData['card_type'] == CARD_MILLION) {
            show_error('此活动针对所有产品，不需要添加产品！');
        }

        $this->load->model('product/Model_Product', 'product');

        if (!empty ($keyword) || !empty ($sType)) {
            switch ($sType) {
                case 1:
                    $tmpData = $this->product->getProductById($keyword);
                    $data[] = empty ($tmpData) ? null : $tmpData;
                    break;
                case 2:
                    $data = $this->product->getProductList(1000, 0,'*',' pname like \'%'.$keyword.'%\'');//($limit = 20, $offset = 0, $field= "*", $where = null, $order = null)
                    break;
                default:
                    $tmpData = $this->product->getProductById($keyword);
                    $data[] = empty ($tmpData) ? null : $tmpData;
            }
        } else {
            $this->load->library('pagination');
            $num = $this->product->getProductCount();
            $pageSize = 20;
            $config['base_url'] = site_url('administrator/business_card_model/joinSales/'.$modelId);
            $config['total_rows'] = $num;
            $config['per_page'] = $pageSize;
            $config['use_page_numbers'] = TRUE;
            $config['uri_segment'] = 5;
            $config['num_links'] = 10;
            $config['anchor_class'] = 'class="number" ';
            $this->pagination->initialize($config);

            $page = $this->uri->segment(5, 1);
            $data = array();
            if ($num) {
                $page = (abs($page) - 1) * $pageSize;
                $data = $this->product->getProductList($pageSize, $page);
            }
            $pageHtml = $this->pagination->create_links();
        }

        $info = array(
            'list' => $data,
            'searchType' => $this->searchType,
            'page' => $pageHtml,
            'card_model' => $modelData,
            'model_id' => $modelId,
            'keyword' => $keyword,
            'sType' => $sType,
        );
        $this->load->view('administrator/business/card/join_sales', $info);
    }

    /**
     * 加入产品
     */
    public function joinProduct()
    {
        $modelId = $this->input->get_post('model_id');
        $pId = $this->input->get_post('pid');

        $response = array('error' => '0', 'msg' => '产品加入礼品卡销售成功', 'code' => 'product_join_gift_card_sales_success');

        do {
            if (empty ($modelId) || empty ($pId)) {
                $response = error(70034);
                break;
            }

            $this->load->model('/business/Model_Gift_Card_model', 'model');
            $modelData = $this->model->getCardModel($modelId);
            if (empty ($modelData)) {
                $response = error(70024);
                break;
            }

            $this->load->model('product/Model_Product', 'product');
            $productData = $this->product->getProductById($pId);
            if (empty ($productData)) {
                $response = error(20002);
                break;
            }

            $data = array(
                'model_id' => $modelId,
                'card_type' => $modelData['card_type'],
                'pid' => $pId,
                'pname' => $productData['pname'],
                'sell_price' => $productData['sell_price'],
            );
            $this->load->model('/business/Model_Gift_Card_product', 'c_product');
            //$this->c_product->deleteProductByPM($pId, $modelId);
            $lastId = $this->c_product->addProduct($data);
            if (!$lastId) {
                $response = error(70035);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 删除产品
     */
    public function productDelete()
    {
        $id = intval($this->uri->segment(4, 0));
        if (empty ($id)) {
            show_error('参数不全！');
        }

        $this->load->model('/business/model_gift_card_product', 'c_product');
        $this->c_product->deleteProduct($id);

        $this->load->helper('url');
        redirect('/administrator/business_card_model/cardProduct/');
    }
}
