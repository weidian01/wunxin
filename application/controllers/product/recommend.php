<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-8-1
 * Time: 下午2:48
 * To change this template use File | Settings | File Templates.
 */
class recommend extends MY_Controller
{
    /**
     * 获取产品收藏推荐
     */
    public function favoriteRecommend()
    {
        $number = $this->input->get_post('number');

        $this->load->model('product/Model_Product_Recommend', 'recommend');
        $data = $this->recommend->getProductFavoriteRecommend($number);

        $response = array('error' => '0', 'msg' => '获取成功', 'code' => 'get_success', 'data' => $data);
//sleep(1);
        self::json_output($response);
    }
}