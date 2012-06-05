<?php
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

            $uInfo = $this->isLogin();
            if (!$uInfo) {
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
                'uid' => $uInfo['uid'],
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

    public function likeShareImage()
    {
        
    }

}
