<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class product_share extends MY_Controller
{
    /**
     * 晒单
     */
    public function productShare()
    {
        $pid = $this->input->get_post('pid');
        $uid = $this->input->get_post('uid');
        $title = $this->input->get_post('title');
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();

        //$shareImage = $this->input->get_post();

        $response = error(20004);

        do {
            if (empty ($pid) || empty ($uid) || empty ($title) || empty ($content)) {
                $response = error(20006);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('order/Model_order', 'order');
            $data = $this->order->userIsBuyProduct(1, 1); //($uid, $pid);
            if (empty ($data)) {
                $response = error(50002);
                break;
            }

            $data = array(
                'pid' => $pid,
                'uid' => $this->uInfo['uid'],
                'title' => $title,
                'content' => $content,
                'ip' => $ip
            );
            $this->load->model('product/Model_Product_Share', 'share');
            $status = $this->share->productShare($data);
            if (!$status) {
                $response = error(20005);
                break;
            }

            $data = array(
                'share_id' => $status,
                'img_addr' => $siInfo['img_addr'],
                'descr' => $siInfo['descr'],
                'is_cover' => $siInfo['is_cover']
            );
            $this->share->saveProductShareImage($data);
        } while (false);

        $this->json_output($response);
    }

    /**
     * 喜欢晒单产品图片
     */
    public function likeShareImage()
    {
        $imgId = $this->input->get_post('img_id');

        $response = error(20007);

        do {
            if (empty ($imgId)) {
                $response = error(20009);
                break;
            }

            $this->load->model('product/Model_Product_Share', 'share');
            $status = $this->share->likeProductShareImage($imgId);
            if (!$status) {
                $response = error(20008);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 添加晒单评论
     */
    public function shareComment()
    {
        $sId = $this->input->get_post('sid');
        $content = $this->input->get_post('content');

        $response = error(20018);

        do {
            if (empty ($sId) || empty ($content)) {
                $response = error(20020);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $data = array(
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'content' => $content,
            );
            $this->load->model('product/Model_Product_Share', 'share');
            $status = $this->share->shareComment($sId, $data);
            if (!$status) {
                $response = error(20019);
                break;
            }
        } while (false);

        $this->json_output($response);
    }
}
