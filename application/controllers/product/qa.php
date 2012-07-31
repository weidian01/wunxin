<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class qa extends MY_Controller
{
    /**
     * 提交疑难问答
     */
    public function addQa()
    {
        $pid = intval( $this->input->get_post('pid') );
        $title = $this->input->get_post('title');
        $content = $this->input->get_post('content');
        $ip = $this->input->get_post('ip');

        $response = array('error' => '0', 'msg' => '提交疑难问答成功', 'code' => 'qa_delivery_success');

        do {
            if (empty ($pid) || empty ($title) || empty ($content)) {
                $response = error(50010);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $data = array(
                'pid' => $pid,
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'title' => $title,
                'content' => $content,
                'ip' => $ip
            );

            $this->load->model('product/Model_Product_QA', 'qa');
            $status = $this->qa->addProductQA($data);
            if (!$status) {
                $response = error(50011);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 疑难问答是否有效
     */
    public function postProductQAIsValid()
    {
        $qaId = intval( $this->input->get_post('qa_id') );
        $operaType = intval( $this->input->get_post('opera_type') );

        $response = array('error' => '0', 'msg' => '疑难问答是否有效提供成功', 'code' => 'qa_whether_effective_delivery_successful');

        do {
            if (empty ($qaId)) {
                $response = error(50015);
                break;
            }

            $operaType = $operaType == 1 ? true : false;

            $this->load->model('product/Model_Product_QA', 'qa');
            $status = $this->qa->productQAIsValid($qaId, $operaType);
            if (!$status) {
                $response = error(50014);
                break;
            }

        } while (false);

        $this->json_output($response);
    }

    /**
     * 添加产品疑难问答回复
     */
    public function postProductQAReply()
    {
        $qaId = $this->input->get_post('qa_id');
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();

        $response = array('error' => '0', 'msg' => '疑难问答回复成功', 'code' => 'qa_whether_effective_reply_successful');

        do {
            if (empty ($qaId) || empty ($content)) {
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

            $this->load->model('product/Model_Product_QA', 'qa');
            $status = $this->qa->addProductQAReply($data);
            if (!$status) {
                $response = error(50017);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 删除产品问答
     */
    /*
    public function deleteProductQa()
    {
        $qaId = intval($this->input->get_post('qa_id'));

        $response = array('error' => '0', 'msg' => '删除产品问答成功', 'code' => 'delete_product_comment_success');

        do {
            if (empty ($qaId)) {
                $response = error(20024);
                break;
            }

            $uInfo = $this->isLogin();
            if (!$uInfo) {
                $response = error(10009);
                break;
            }

            $this->load->model('product/Model_Product_QA', 'qa');
            $status = $this->qa->deleteProductQAByQAId($qaId, $this->uInfo['uid']);
            if (!$status) {
                $response = error(20023);
                break;
            }
        } while (false);

        $this->json_output($response);
    }
    //*/
}
