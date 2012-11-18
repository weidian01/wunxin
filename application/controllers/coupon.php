<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-16
 * Time: 下午3:21
 * To change this template use File | Settings | File Templates.
 */
class coupon extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        if(! $this->input->is_ajax_request()){
            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }
    }

    //优惠卷首页
    public function index()
    {
        $modelId = intval($this->uri->segment(3, 0));

        $where = array(
            'end_time >=' => date('Y-m-d H:i:s', TIMESTAMP),
            'is_generation' => '1'
        );
        if (!empty ($modelId)) {
            $where['card_type'] = $modelId;
        }
        $this->load->model('business/model_gift_card_model', 'model');
        $data = $this->model->getCardModelList(20, 0, '*', $where);

        $this->load->model('business/model_gift_card', 'card');
        $needReceive = $this->card->getCardCount(array('model_id' => $modelId, 'is_receive' => '1' ));

        //($limit = 20, $offset = 0, $field = '*', $where = null, $orderBy = null)
        $recommend = $this->model->getCardModelList(10, 0, '*', array('is_generation' => '1'), 'receive_num desc');

        //echo '<pre>';print_r($data);exit;
        $this->load->view('coupon/index', array('data' => $data, 'model_id' => $modelId, 'needReceive' => $needReceive, 'recommend' => $recommend));
    }

    public function show()
    {
        $modelId = intval($this->uri->segment(3, 0));

        if (empty ($modelId)) {
            $this->load->helper('url');
            redirect('coupon/index');
            return;
        }

        $this->load->model('business/model_gift_card_model', 'model');
        $data = $this->model->getCardModel($modelId);

        $this->load->model('business/model_gift_card', 'card');
        $needReceive = $this->card->getCardCount(array('model_id' => $modelId, 'is_receive' => '1' ));

        $recommend = $this->model->getCardModelList(10, 0, '*', array('is_generation' => '1'), 'receive_num desc');

        $this->load->view('coupon/show', array('data' => $data, 'needReceive' => $needReceive, 'recommend' => $recommend));
    }

    //领取优惠卷
    public function receive()
    {
        $modelId = intval($this->input->get_post('id'));

        $response = array('error' => '0', 'msg' => '领取成功', 'code' => 'receive_success');

        do {
            if (empty ($modelId)) {
                $response = error(70029);
                break;
            }

            $this->load->model('business/model_gift_card', 'card');
            $data = $this->card->receiveCard($modelId);

            if (empty ($data)) {
                $response = error(70030);
                break;
            }

            $response['card'] = $data;
        } while (false);

        self::json_output($response);
    }
}
