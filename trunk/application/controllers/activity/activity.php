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
        $this->load->model('business/model_business_limit_buy_category', 'category');
        $category = $this->category->getCategoryList();

        $this->load->model('business/model_business_limit_buy', 'lb');
        $clbData = $this->lb->getCategoryAndLimitBuyList();

        $beforeLimitBuy = $this->lb->getBeforeLimitBuy();
        //echo '<pre>';print_r($beforeLimitBuy);exit;

        $defaultLimitBuy = $this->lb->getDefaultLimitBuy();

        $data = array(
            'title' => '限时抢购',
            'category' => $category,
            'info' => $clbData,
            'before_lb' => $beforeLimitBuy,
            'default_lb' => $defaultLimitBuy,
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
}
