<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-21
 * Time: 下午1:42
 * To change this template use File | Settings | File Templates.
 */
class recommend_home extends MY_Controller
{
    public $position = array(
        1 => array('cname' => '今日推荐', 'cid' => 1),
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
        $searchKeyWord_recommend = $this->recommend->getRecommendCategoryList(10, 1000);

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
            'search_keyword_recommend' => $searchKeyWord_recommend,
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
        $name = $this->input->get_post('name');
        $imgAddr = $this->input->get_post('img_addr');
        $link = $this->input->get_post('link');
        $sort = intval($this->input->get_post('sort'));

        if (empty ($name) || empty ($link)) {
            show_error('参数错误');
        }

        $data = array(
            'cid' => 9,
            'title' => $name,
            'link' => $link,
            'img_addr' => '',
            'pid' => '',
            'sort' => $sort,
            'emission' => '',
        );

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $lastId = $this->recommend->recommendAdd($data);
        if (!$lastId) {
            show_error('添加首页转播图失败');
        }

        $this->load->helper('directory');
        $directory = 'upload' . DS . 'recommend' . DS . 'broadcast' . DS . date('Ymd') . DS;
        recursiveMkdirDirectory($directory);

        $config['upload_path'] = WEBROOT . $directory;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['file_name'] = $lastId;

        $this->load->library('upload', $config);
//echo '<pre>';print_r($_FILES);exit;
        if ($this->upload->do_upload('img_addr')) {
            $uData = $this->upload->data();

            $file = $directory . $uData['file_name'];
            $this->recommend->updateRecommend($file, $lastId);
        } else {
            show_error('文件上传失败!');
        }

        redirect('/administrator/recommend_home/recommendList');
    }

    /**
     * 今日推荐保存
     */
    public function dayRecommendSave()
    {
        $name = $this->input->get_post('name');
        $link = $this->input->get_post('link');
        $sort = intval($this->input->get_post('sort'));

        if (empty ($name) || empty ($link)) {
            show_error('参数错误');
        }

        $data = array(
            'cid' => 1,
            'title' => $name,
            'link' => $link,
            'img_addr' => '',
            'pid' => '',
            'sort' => $sort,
            'emission' => '',
        );

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $lastId = $this->recommend->recommendAdd($data);
        if (!$lastId) {
            show_error('添加今日失败');
        }

        $this->load->helper('directory');
        $directory = 'upload' . DS . 'recommend' . DS . 'day' . DS . date('Ymd') . DS;
        recursiveMkdirDirectory($directory);

        $config['upload_path'] = WEBROOT . $directory;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['file_name'] = $lastId;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('img_addr')) {
            $uData = $this->upload->data();

            $file = $directory . $uData['file_name'];
            $this->recommend->updateRecommend($file, $lastId);
        } else {
            show_error('文件上传失败!');
        }

        redirect('/administrator/recommend_home/recommendList');
    }

    /**
     * 设计图推荐保存
     */
    public function designRecommendSave()
    {
        $pid = $this->input->get_post('pid');
        $sort = $this->input->get_post('sort');
        if (empty ($pid) || empty ($sort)) {
            show_error('参数错误');
        }

        $data = array(
            'cid' => 2,
            'title' => '',
            'link' => '',
            'img_addr' => '',
            'pid' => $pid,
            'sort' => $sort,
            'emission' => '',
        );

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $lastId = $this->recommend->recommendAdd($data);
        if (!$lastId) {
            show_error('添加今日失败');
        }

        redirect('/administrator/recommend_home/recommendList');
    }

    /**
     * 广告推荐保存
     */
    public function adRecommendSave()
    {
        $name = $this->input->get_post('name');
        $link = $this->input->get_post('link');
        $sort = intval($this->input->get_post('sort'));

        if (empty ($name) || empty ($link)) {
            show_error('参数错误');
        }

        $data = array(
            'cid' => 3,
            'title' => $name,
            'link' => $link,
            'img_addr' => '',
            'pid' => '',
            'sort' => $sort,
            'emission' => '',
        );

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $lastId = $this->recommend->recommendAdd($data);
        if (!$lastId) {
            show_error('添加广告推荐失败');
        }

        $this->load->helper('directory');
        $directory = 'upload' . DS . 'recommend' . DS . 'ad' . DS . date('Ymd') . DS;
        recursiveMkdirDirectory($directory);

        $config['upload_path'] = WEBROOT . $directory;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['file_name'] = $lastId;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('img_addr')) {
            $uData = $this->upload->data();

            $file = $directory . $uData['file_name'];
            $this->recommend->updateRecommend($file, $lastId);
        } else {
            show_error('文件上传失败!');
        }

        redirect('/administrator/recommend_home/recommendList');
    }

    /**
     * 男款推荐保存
     */
    public function manRecommendSave()
    {
        $name = $this->input->get_post('name');
        $link = $this->input->get_post('link');
        $sort = intval($this->input->get_post('sort'));
        $emission = intval($this->input->get_post('emission'));
        $pId = $this->input->get_post('pid');

        if (in_array($emission, array('1', '4')) && empty ($pId)) {
            show_error('参数错误');
        }

        if (in_array($emission, array('2', '3')) && (empty ($name) || empty ($link))) {
            show_error('参数错误');
        }

        $data = array(
            'cid' => 4,
            'title' => $name,
            'link' => $link,
            'img_addr' => '',
            'pid' => $pId,
            'sort' => $sort,
            'emission' => $emission,
        );

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $lastId = $this->recommend->recommendAdd($data);
        if (!$lastId) {
            show_error('添加男款推荐失败');
        }
        if (in_array($emission, array('2', '3'))) {
            $this->load->helper('directory');
            $directory = 'upload' . DS . 'recommend' . DS . 'man' . DS . date('Ymd') . DS;
            recursiveMkdirDirectory($directory);

            $config['upload_path'] = WEBROOT . $directory;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['file_name'] = $lastId;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('img_addr')) {
                $uData = $this->upload->data();

                $file = $directory . $uData['file_name'];
                $this->recommend->updateRecommend($file, $lastId);
            } else {
                show_error('文件上传失败!');
            }
        }
        redirect('/administrator/recommend_home/recommendList');
    }

    /**
     * 女款推荐保存
     */
    public function womanRecommendSave()
    {
        $name = $this->input->get_post('name');
        $link = $this->input->get_post('link');
        $sort = intval($this->input->get_post('sort'));
        $emission = intval($this->input->get_post('emission'));
        $pId = $this->input->get_post('pid');

        if ($emission == '7' && empty ($pId)) {
            echo '1';
            show_error('参数错误');
        }

        if (in_array($emission, array('1', '2', '3', '4', '5', '6')) && (empty ($name) || empty ($link))) {
            echo '2';
            show_error('参数错误');
        }

        $data = array(
            'cid' => 5,
            'title' => $name,
            'link' => $link,
            'img_addr' => '',
            'pid' => $pId,
            'sort' => $sort,
            'emission' => $emission,
        );

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $lastId = $this->recommend->recommendAdd($data);
        if (!$lastId) {
            show_error('添加男款推荐失败');
        }
        if (in_array($emission, array('1', '2', '3', '4', '5', '6'))) {
            $this->load->helper('directory');
            $directory = 'upload' . DS . 'recommend' . DS . 'woman' . DS . date('Ymd') . DS;
            recursiveMkdirDirectory($directory);

            $config['upload_path'] = WEBROOT . $directory;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['file_name'] = $lastId;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('img_addr')) {
                $uData = $this->upload->data();

                $file = $directory . $uData['file_name'];
                $this->recommend->updateRecommend($file, $lastId);
            } else {
                show_error('文件上传失败!');
            }
        }
        redirect('/administrator/recommend_home/recommendList');
    }

    /**
     * 情侣推荐保存
     */
    public function loverRecommendSave()
    {
        $name = $this->input->get_post('name');
        $link = $this->input->get_post('link');
        $sort = intval($this->input->get_post('sort'));
        $emission = intval($this->input->get_post('emission'));
        $pId = $this->input->get_post('pid');

        if ($emission == '2' && empty ($pId)) {
            echo '1';
            show_error('参数错误');
        }

        if (in_array($emission, array('1')) && (empty ($name) || empty ($link))) {
            echo '2';
            show_error('参数错误');
        }

        $data = array(
            'cid' => 6,
            'title' => $name,
            'link' => $link,
            'img_addr' => '',
            'pid' => $pId,
            'sort' => $sort,
            'emission' => $emission,
        );

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $lastId = $this->recommend->recommendAdd($data);
        if (!$lastId) {
            show_error('添加男款推荐失败');
        }
        if (in_array($emission, array('1'))) {
            $this->load->helper('directory');
            $directory = 'upload' . DS . 'recommend' . DS . 'lover' . DS . date('Ymd') . DS;
            recursiveMkdirDirectory($directory);

            $config['upload_path'] = WEBROOT . $directory;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['file_name'] = $lastId;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('img_addr')) {
                $uData = $this->upload->data();

                $file = $directory . $uData['file_name'];
                $this->recommend->updateRecommend($file, $lastId);
            } else {
                show_error('文件上传失败!');
            }
        }
        redirect('/administrator/recommend_home/recommendList');
    }

    /**
     * 亲子推荐
     */
    public function familyRecommendSave()
    {
        $name = $this->input->get_post('name');
        $link = $this->input->get_post('link');
        $sort = intval($this->input->get_post('sort'));
        $emission = intval($this->input->get_post('emission'));
        $pId = $this->input->get_post('pid');

        if ($emission == '8' && empty ($pId)) {
            echo '1';
            show_error('参数错误');
        }

        if (in_array($emission, array('1','2','3','4','5','6','7')) && (empty ($name) || empty ($link))) {
            echo '2';
            show_error('参数错误');
        }

        $data = array(
            'cid' => 7,
            'title' => $name,
            'link' => $link,
            'img_addr' => '',
            'pid' => $pId,
            'sort' => $sort,
            'emission' => $emission,
        );

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $lastId = $this->recommend->recommendAdd($data);
        if (!$lastId) {
            show_error('添加男款推荐失败');
        }
        if (in_array($emission, array('1','2','3','4','5','6','7'))) {
            $this->load->helper('directory');
            $directory = 'upload' . DS . 'recommend' . DS . 'family' . DS . date('Ymd') . DS;
            recursiveMkdirDirectory($directory);

            $config['upload_path'] = WEBROOT . $directory;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['file_name'] = $lastId;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('img_addr')) {
                $uData = $this->upload->data();

                $file = $directory . $uData['file_name'];
                $this->recommend->updateRecommend($file, $lastId);
            } else {
                show_error('文件上传失败!');
            }
        }
        redirect('/administrator/recommend_home/recommendList');
    }

    public function designerRecommendSave()
    {
        $pid = $this->input->get_post('pid');
        $sort = $this->input->get_post('sort');
        if (empty ($pid)) {
            show_error('参数错误');
        }

        $data = array(
            'cid' => 8,
            'title' => '',
            'link' => '',
            'img_addr' => '',
            'pid' => $pid,
            'sort' => $sort,
            'emission' => '',
        );

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $lastId = $this->recommend->recommendAdd($data);
        if (!$lastId) {
            show_error('添加设计推荐失败');
        }

        redirect('/administrator/recommend_home/recommendList');
    }

    public function keywordRecommendSave()
    {
        $keyword = $this->input->get_post('keyword');
        $sort = $this->input->get_post('sort');
        if (empty ($keyword)) {
            show_error('参数错误');
        }

        $data = array(
            'cid' => 10,
            'title' => $keyword,
            'link' => '',
            'img_addr' => '',
            'pid' => '',
            'sort' => $sort,
            'emission' => '',
        );

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $lastId = $this->recommend->recommendAdd($data);
        if (!$lastId) {
            show_error('添加搜索关键词失败');
        }

        redirect('/administrator/recommend_home/recommendList');
    }

    public function recommendDelete()
    {
        $id = $this->uri->segment(4, 1);
        //$currentPage = $this->uri->segment(5, 1);
        if (!$id) {
            show_error('推荐ID为空');
        }

        $this->load->model('recommend/Model_Home_Recommend', 'recommend');
        $status = $this->recommend->deleteRecommend($id);
        if (!$status) {
            show_error('删除今日推荐失败');
        }

        redirect('/administrator/recommend_home/recommendList/');
    }
}
