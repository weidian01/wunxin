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
        $man_recommend_2_3 = $this->recommend->query('select * from wx_recommend where cid=4 and emission in(2,3) order by sort desc limit 2');
        $woman_recommend_1_2_3_4_5_6 = $this->recommend->query('select * from wx_recommend where cid=5 and emission in(1,2, 3,4,5,6) order by sort desc limit 6');
        $lover_recommend = $this->recommend->getRecommendCategoryList(6, 1);
        $family_recommend = $this->recommend->query('select * from wx_recommend where cid=7 and emission in(1,2,3,4,5,6,7) order by sort desc limit 7;');
        $data = array(
            'title' => '万象网首页',
            'broadcast_recommend' => $broadcast_recommend,
            'day_recommend' => $day_recommend,
            'AD_recommend' => $AD_recommend,
            'man_recommend_2_3' => $man_recommend_2_3,
            'woman_recommend_1_2_3_4_5_6' => $woman_recommend_1_2_3_4_5_6,
            'lover_recommend' => $lover_recommend,
            'family_recommend' => $family_recommend,
        );
        $this->load->view('welcomes_index', $data);
    }
}