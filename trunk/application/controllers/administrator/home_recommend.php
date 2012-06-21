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
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $totalNum = $this->recommend->getRecommendListCount();
        $data = $this->recommend->getRecommendList($Limit, $offset);

        /*
        if ($cId) {
            $totalNum = $this->recommend->getRecommendCategoryCount($cId);
            $data = $this->recommend->getRecommendCategoryList($cId, $Limit, $offset);
        } else {
            $totalNum = $this->recommend->getRecommendListCount();
            $data = $this->recommend->getRecommendList($Limit, $offset);
        }
        //*/

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/home_recommend/recommendList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/recommend/list', array('data' => $data, 'class_data' => $this->position, 'page_html' => $pageHtml, 'current_page' => $currentPage));
    }

    /**
     * 推荐添加
     */
    public function recommendAdd()
    {

        $this->load->view('/administrator/recommend/create', array('class_data' => $this->position, 'type' => 'add'));
    }

    public function recommendSave()
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
