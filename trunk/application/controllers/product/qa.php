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
        $qaType = $this->input->get_post('qa_type');
        $ip = $this->input->ip_address();

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

            $this->load->model('product/Model_Product', 'product');
            $product = $this->product->getProductById($pid);
            if ( empty ($product) ) {
                $response = error(20002);
                break;
            }

            //是否提问过
            $this->load->model('product/Model_Product_QA', 'qa');
            $qaData = $this->qa->getUserProductQa($this->uInfo['uid'], $pid);
            if ( !empty ($qaData) ) {
                $response = error(20027);
                break;
            }

            $data = array(
                'pid' => $pid,
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'title' => $title,
                'content' => $content,
                'ip' => $ip,
                'qa_type' => $qaType,
            );

            $this->load->model('product/Model_Product_QA', 'qa');
            $status = $this->qa->addProductQA($data);
            if (!$status) {
                $response = error(50011);
                break;
            }
        } while (false);

        self::json_output($response);
    }

    /**
     * 检查是否可以对产品提问
     */
    public function checkQaProduct()
    {
        $pid = intval( $this->input->get_post('pid') );

        $response = array('error' => '0', 'msg' => '检查成功', 'code' => 'check_success');

        do {
            if (empty ($pid)) {
                $response = error(50010);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('product/Model_Product', 'product');
            $product = $this->product->getProductById($pid);
            if ( empty ($product) ) {
                $response = error(20002);
                break;
            }

            //是否提问过
            $this->load->model('product/Model_Product_QA', 'qa');
            $qaData = $this->qa->getUserProductQa($this->uInfo['uid'], $pid);
            if ( !empty ($qaData) ) {
                $response = error(20027);
                break;
            }

            $response['data'] = $product;
            $response['data']['qa_num'] = $this->qa->getProductQaCount($pid);
        } while (false);

        self::json_output($response);
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

        self::json_output($response);
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

        self::json_output($response);
    }

    /**
     * 删除产品问答
     */
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

        self::json_output($response);
    }

    public function ajaxGetQaByPid()
    {
        $pid = $this->input->get_post('pid');
        $limit = max(10, $this->input->get_post('limit'));
        $offset = max(0, $this->input->get_post('offset'));

        $this->load->model('product/Model_Product_QA', 'qa');
        $response  = error(20002);
        if($pid > 0)
        {
            $field = 'qa_id, user.uid, user.uname, title, content, reply_content, reply_time, product_qa.create_time,nickname';
            $response = $this->qa->getProductQaAndUserByPid($pid, $limit, $offset, $field, 'qa_id ASC');
        }
        self::json_output($response , true);
    }
}
