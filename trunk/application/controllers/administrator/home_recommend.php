<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-21
 * Time: 下午1:42
 * To change this template use File | Settings | File Templates.
 */
class home_recommend extends MY_Controller
{
    public $position = array(
        1 => array('cname' => '今日推荐','cid' => 1),
        2 => array('cname' => '设计图推荐', 'cid' => 2),
        3 => array('cname' => '广告推荐', 'cid' => 3),
        4 => array('cname' => '男款T恤推荐', 'cid' => 4),
        5 => array('cname' => '女款T恤推荐', 'cid' => 5),
        6 => array('cname' => '情侣T恤推荐', 'cid' => 6),
        7 => array('cname' => '亲子T恤推荐', 'cid' => 7),
        8 => array('cname' => '设计师推荐', 'cid' => 8),
        9 => array('cname' => '首页转播图', 'cid' => 9),
    );

    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    /**
     * 推荐列表
     */
    public function recommendList()
    {
        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $day_recommend = $this->recommend->getRecommendCategoryList(1, 1000);
        $design_recommend = $this->recommend->getRecommendCategoryList(2, 1000);
        $AD_recommend = $this->recommend->getRecommendCategoryList(3, 1000);
        $man_recommend = $this->recommend->getRecommendCategoryList(4, 1000);
        $woman_recommend = $this->recommend->getRecommendCategoryList(5, 1000);
        $lover_recommend = $this->recommend->getRecommendCategoryList(6, 1000);
        $family_recommend = $this->recommend->getRecommendCategoryList(7, 1000);
        $designer_recommend = $this->recommend->getRecommendCategoryList(8, 1000);
        $broadcast_recommend = $this->recommend->getRecommendCategoryList(9, 1000);

        $data = array(
            'day_recommend' => $day_recommend,
            'design_recommend' => $design_recommend,
            'AD_recommend' => $AD_recommend,
            'man_recommend' => $man_recommend,
            'woman_recommend' => $woman_recommend,
            'lover_recommend' => $lover_recommend,
            'family_recommend' => $family_recommend,
            'designer_recommend' => $designer_recommend,
            'broadcast_recommend' => $broadcast_recommend,
        );

        $this->load->view('/administrator/recommend/list', $data);
    }

    /**
     * 推荐添加
     */
    public function recommendAdd()
    {

        $this->load->view('/administrator/recommend/create', array('class_data' => $this->position, 'type' => 'add'));
    }

    /**
     * 首页转播图保存
     */
    public function broadcastRecommendSave()
    {

    }

    /**
     * 今日推荐保存
     */
    public function dayRecommendSave()
    {

    }

    public function recommendDelete()
    {
        $id = $this->uri->segment(4, 1);
        $currentPage = $this->uri->segment(5, 1);
        if (!$id) {
            show_error('推荐ID为空');
        }

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $status = $this->recommend->deleteRecommend($id);
        if (!$status) {
            show_error('删除推荐失败');
        }

        redirect('/administrator/home_recommend/recommendList/'.$currentPage);
    }
}
