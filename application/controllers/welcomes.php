<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-25
 * Time: 下午6:24
 * To change this template use File | Settings | File Templates.
 */
class welcomes extends MY_Controller
{
    public function index()
    {
        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $broadcast_recommend = $this->recommend->getRecommendCategoryList(9, 10);
        $day_recommend = $this->recommend->getRecommendCategoryList(1, 6);
        $AD_recommend = $this->recommend->getRecommendCategoryList(3, 3);
//echo '<pre>';print_r($AD_recommend);exit;
        $data = array(
            'title' => '万象网首页',
            'broadcast_recommend' => $broadcast_recommend,
            'day_recommend' => $day_recommend,
            'AD_recommend' => $AD_recommend,
        );
        $this->load->view('welcomes_index', $data);
    }
}