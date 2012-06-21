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
        1 => '今日推荐',
        2 => '设计图推荐',
        3 => '广告推荐',
        4 => '男款T恤推荐',
        5 => '女款T恤推荐',
        6 => '情侣T恤推荐',
        7 => '亲子T恤推荐',
        8 => '设计师推荐',
        9 => '首页转播图'
    );

    /**
     * 推荐列表
     */
    public function recommendList()
    {
        $cId = $this->uri->segment(4, 1);

        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');

        $totalNum = $this->recommend->getNewsCategoryCount($cId);
        $data = $this->recommend->getNewsCategoryList($cId, $Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/home_recommend/recommendList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/recommend/list', array('data' => $data, 'class_data' => $this->position, 'page_html' => $pageHtml));
    }

    /**
     * 推荐添加
     */
    public function recommendAdd()
    {

    }

    public function recommendSave()
    {

    }

    public function recommendEdit()
    {

    }

    public function recommendEditSave()
    {

    }

    public function recommendDelete()
    {

    }
}
