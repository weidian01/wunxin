<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class product_qa extends MY_Controller
{
    /**
     * 提交疑难问答
     */
    public function postProductQa()
    {
        $pid = $this->input->get_post('pid');
        $uid = $this->input->get_post('uid');
        $qa_title = $this->input->get_post('qa_title');
        $qa_content = $this->input->get_post('qa_content');
        $ip = $this->input->get_post('ip');

        $response = error(50012);

        do {
            if (empty ($pid) || empty ($uid) || empty ($qa_title) || empty ($qa_content)) {
                $response = error(50010);
                break;
            }

            $uInfo = $this->isLogin();
            if (!$uInfo) {
                $response = error(10009);
                break;
            }

            $data = array(
                'pid' => $pid,
                'uid' => $uInfo['uid'],
                'uname' => $uInfo['uname'],
                'qa_title' => $qa_title,
                'qa_content' => $qa_content,
                'ip' => $ip
            );
            $this->load->model('comment/Model_Product_QA', 'qa');
            $status = $this->qa->addProductQA($data);
            if (!$status) {
                $response = error(50011);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    public function postProductQAIsValid()
    {
        $qaId = $this->input->get_post('qa_id');
        $operaType = $this->input->get_post('opera_type');

        $response = error(50013);

        do {
            if (empty ($qaId) || empty ($operaType)) {
                $response = error(50015);
                break;
            }

            $operaType = $operaType == 1 ? true : false;

            $this->load->mode('comment/Model_Product_QA', 'qa');
            $status = $this->qa->productQAIsValid($qaId, $operaType);
            if (!$status) {
                $response = error(50014);
                break;
            }

        } while (false);

        $this->json_output($response);
    }

    public function postProductQAReply()
    {
        $uid = $this->input->get_post('uid');
        $qaId = $this->input->get_post('qa_id');
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();

        $response = error(50016);

        do {
            if (empty ($uid) || empty ($commentId) || empty ($content)) {
                $response = error(50018);
                break;
            }

            $uInfo = $this->isLogin();
            if (!$uInfo) {
                $response = error(10009);
                break;
            }

            $data = array(
                'qa_id' => $qaId,
                'uid' => $uInfo['uid'],
                'uname' => $uInfo['uname'],
                'ip' => $ip,
                'reply_content' => $content
            );
            $this->load->mode('comment/Model_Product_QA', 'qa');
            $status = $this->qa->addProductQAReply($data);
            if (!$status) {
                $response = error(50017);
                break;
            }
        } while (false);

        $this->json_output($response);
    }


}
