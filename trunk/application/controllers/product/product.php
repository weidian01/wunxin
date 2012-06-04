<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Product extends MY_Controller
{
    /**
     * 用户收藏产品
     */
    public function productFavorite()
    {
        $pid = $this->input->get_post('pid');
        $uid = $this->input->get_post('uid');
        $ip = $this->input->ip_address();

        $this->load->model('user/Model_User', 'user');
        $this->load->model('product/Model_Product', 'product');


        do {
            $uInfo = $this->user->getUserById($uid);
            if (empty ($uInfo)) {
                $response = error(10006);
            }

            $pInfo = $this->product->productIsExist($pid);
            if (!$pInfo) {
                $response = error(20002);
            }

            $data = array(
                'pid' => $pid,
                'uid' => $uInfo['uid'],
                'uname' => $uInfo['uname'],
                'favorite_ip' => $ip['favorite_ip']
            );

            $this->product->productFavorite($data);

            $response = error(20003);
        } while (false);

        echo json_encode($response);
    }

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

    }
}