<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午10:28
 * To change this template use File | Settings | File Templates.
 */
class activity extends MY_Controller
{
    /**
     * 限时抢购
     */
    public function qiang()
    {
        $promotionId = intval($this->uri->segment(4, 0));
        if (!$promotionId) {
            show_error('活动ID不存在！');
        }

        $date = date('Y-m-d H:i:s');
        $this->load->model('business/model_business_promotion', 'promotion');
        $promotion = $this->promotion->getPromotion($promotionId, 2, 0, '*', array('start_time <=' => $date, 'end_time >=' => $date));
        if (empty ($promotion)) {
            show_error('活动不存在！');
        }

        $this->load->model('business/model_business_promotion_product', 'product');
        $product = $this->product->getProductByPromotionId($promotionId);

        //getProductList($limit = 20, $offset = 0, $field = '*', $where = null, $order = null)
        $beforeWhere = array(
            'promotion_id' => $promotionId,
            'end_time <' => date('Y-m-d H:i:s', TIMESTAMP)
        );
        $beforeLimitBuy = $this->product->getProductList(5, 0, '*', $beforeWhere, 'sort desc');
        //echo '<pre>';print_r($beforeLimitBuy);exit;

        $defaultWhere = array(
            'promotion_id' => $promotionId,
            'start_time <=' => date('Y-m-d H:i:s', TIMESTAMP),
            'end_time >=' => date('Y-m-d H:i:s', TIMESTAMP),
            'cid' => '0',
        );
        $defaultLimitBuy = $this->product->getProductList(6, 0, '*', $defaultWhere, 'sort desc');

        $data = array(
            'promotion' => $promotion,
            'product' => $product,
            'before_lb' => $beforeLimitBuy,
            'default_lb' => $defaultLimitBuy,
            'sales_status' => config_item('sales_status'),
        );
        $this->load->view('activity/qiang_gou', $data);
    }

    /**
     * 问卷调查
     */
    public function survey()
    {
        $this->load->view('activity/survey');
    }

    /**
     * 回答问卷
     */
    public function reportAnswer()
    {
        $id = intval($this->input->get_post('id'));
        $reportId = intval($this->input->get_post('report_id'));
        $response = array('error' => '0', 'msg' => '回答成功', 'code' => 'answer_success');

        do {
            if (empty ($id) || empty ($reportId)) {
                $response = error(70013);
                break;
            }

            $this->load->database();
            $data = $this->db->get_where('survey', array('id' => $id))->row_array();
            //$data = $this->db->row_result();
            //echo '<pre>';print_r($data);exit;

            if (empty ($data)) {
                $response = error(70014);
                break;
            }

            $info = array(
               'answer_id' => $id,
               'report_id' => $reportId,
               'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
            );


            $this->db->insert('survey_log', $info);
        } while (false);

        self::json_output($response);
    }

    /**
     * 系统建议与意见
     */
    public function proposal()
    {
        $this->load->view('activity/proposal');
    }

    /**
     * 特价热卖
     */
    public function discount()
    {
        $promotionId = intval($this->uri->segment(4, 0));
        if (!$promotionId) {
            show_error('活动ID不存在！');
        }

        $date = date('Y-m-d H:i:s');
        $this->load->model('business/model_business_promotion', 'promotion');
        $promotion = $this->promotion->getPromotion($promotionId, 2, 0, '*', array('start_time <=' => $date, 'end_time >=' => $date));
        if (empty ($promotion)) {
            show_error('活动不存在！');
        }

        $this->load->model('business/model_business_promotion_product', 'product');
        $product = $this->product->getProductByPromotionId($promotionId, 20);
        //$this->product->getProductList();//($limit = 20, $offset = 0, $field = '*', $where = null, $order = null)
//echo '<pre>';print_r($product);exit;
        $info = array(
            'promotion' => $promotion,
            'product' => $product,
        );
        $this->load->view('activity/discount', $info);
    }

    public function hot_comment()
    {
        $cData = array();
        $limit = 10;//intval($this->input->get_post('limit'));
        $offset = intval($this->input->get_post('offset'));

        $productId = array();
        $this->load->model('product/Model_Product', 'product');
        $pid = $this->product->getProductList($limit, $offset, "pid,pname,comment_num", null, 'comment_num desc');
        if (!empty ($pid)) {
            foreach ($pid as $v) {
                $productId[] = $v['pid'];
            }

            $this->load->model('product/Model_Product_comment', 'comment');
            $commentData = $this->comment->getProductCommentById($productId, 73);

            $cData = array();
            foreach ($commentData as $cv) {
                $cData[$cv['pid']][] = $cv;
            }
        }


        if($this->input->is_ajax_request() !== true) {
            $info = array(
                'title' => '热门评论',
                'comment_data' => $cData,
            );
            $this->load->view('activity/hot_comment', $info);
        } else {


            self::json_output($cData, true);
        }
        //echo '<pre>';print_r($cData);exit;
    }
}
