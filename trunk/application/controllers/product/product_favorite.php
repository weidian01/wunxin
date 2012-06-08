<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 上午9:12
 * To change this template use File | Settings | File Templates.
 */
class product_favorite extends MY_Controller
{
    /**
     * 用户收藏产品
     */
    public function productFavorite()
    {
        $pid = $this->input->get_post('pid');
        $ip = $this->input->ip_address();

        $response = error(20010);

        do {
            if (empty ($pid)) {
                $response = error(20012);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('product/Model_Product', 'product');
            $pInfo = $this->product->productIsExist($pid);
            if (!$pInfo) {
                $response = error(20002);
                break;
            }

            $data = array(
                'pid' => $pid,
                'uid' => $this->uInfo['uid'],
                'favorite_ip' => $ip
            );
            $this->load->model('product/Model_Product_Favorite', 'favorite');
            $status = $this->favorite->productFavorite($data);
            if (!$status) {
                $response = error(20011);
                break;
            }
        } while (false);

        echo json_encode($response);
    }

    /**
     * 删除收藏
     */
    public function deleteFavorite()
    {
        $fid = $this->input->get_post('fid');

        $response = error(20013);

        do {
            if (empty ($pid)) {
                $response = error(20015);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('product/Model_Product_Favorite', 'favorite');
            $status = $this->favorite->deleteUserProductFavorite($fid);
            if (!$status) {
                $response = error(20014);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 清空收藏夹
     */
    public function emptyFavorite()
    {
        if (!$this->isLogin()) {
            $response = error(10009);
        } else {
            $this->load->model('product/Model_Product_Favorite', 'favorite');
            $status = $this->favorite->emptyUserProductFavorite($this->uInfo['uid']);
            $response = $status ? error(20016) : error(20017);
        }

        $this->json_output($response);
    }
}
