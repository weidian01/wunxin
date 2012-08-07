<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-11
 * Time: 下午1:10
 * To change this template use File | Settings | File Templates.
 */
class design extends MY_Controller
{
    public $searchType = array(
        1 => '设计图ID',
        2 => '用户ID',
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
     * 添加设计图
     */
    public function addDesign()
    {
        $this->load->model('design/Model_Design_Category', 'category');
        $category = $this->category->getCategoryList();

        $this->load->view('/administrator/design/design_add', array('category' => $category, 'h1Title' => '添加设计图', 'type' => 'add'));
    }

    /**
     * 设计图列表
     */
    public function designList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('design/Model_Design', 'design');
        $totalNum = $this->design->getDesignCount();
        $designData = $this->design->getDesignList($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/design/designList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
//echo '<pre>';print_r($designData);exit;
        $this->load->view('/administrator/design/design_list', array('data' => $designData, 'page_html' => $pageHtml, 'searchType' => $this->searchType));
    }

    /**
     * 用户设计图列表
     */
    public function userDesignList()
    {
        $uId = $this->uri->segment(4, 0);
        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;

        if (!$uId) {
            show_error('用户ID为空');
        }

        $this->load->model('design/Model_Design', 'design');
        $totalNum = $this->design->getUserDesignCount($uId);
        $designData = $this->design->getDesignByUid($uId, $Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/design/userDesignList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/design/design_list', array('data' => $designData, 'page_html' => $pageHtml, 'searchType' => $this->searchType));
    }

    /**
     * 搜索
     */
    public function search()
    {
        $keyword = $this->input->get_post('keyword');
        $sType = $this->input->get_post('s_type');

        if (empty ($keyword) || empty ($sType)) {
            show_error('搜索参数不全');
        }

        $this->load->model('design/Model_Design', 'comment');
        switch ($sType) {
            case 1:
                $data = $this->comment->getDesignByDid($keyword);
                $designData[] = $data;
                break;
            case 2:
                $designData = $this->comment->getDesignByUid($keyword);
                break;
            default:
                $designData = $this->comment->getDesignByDid($keyword);
        }

        $this->load->view('/administrator/design/design_list', array('data' => $designData, 'searchType' => $this->searchType, 'sType' => $sType, 'keyword' => $keyword));
    }

    /**
     * 修改设计图
     */
    public function editDesign()
    {
        $dId = $this->uri->segment(4, 0);

        $this->load->model('design/Model_Design', 'design');
        $designData = $this->design->getDesignByDid($dId);

        $this->load->model('design/Model_Design_Category', 'category');
        $category = $this->category->getCategoryList();

        $this->load->view('/administrator/design/design_add', array('dInfo' => $designData, 'category' => $category, 'type' => 'edit'));
    }

    /**
     * 保存修改的设计图
     */
    public function editSaveDesign()
    {
        $designName = $this->input->get_post('design_name');
        $designCategory = $this->input->get_post('design_category');
        $voteEndTime = $this->input->get_post('vote_end_time');
        $source = $this->input->get_post('source');
        $designDetail = $this->input->get_post('design_detail');
        $designId = $this->input->get_post('did');

        if (empty ($designName) || empty ($designCategory) || empty ($voteEndTime) || empty ($designDetail) || empty ($designId)) {
            show_error('参数不全，请检测是否填写相关参数!');
        }

        $data = array(
            'class_id' => $designCategory,
            'dname' => $designName,
            'ddetail' => $designDetail,
            'source_expand' => '',
            'vote_end_time' => $voteEndTime,
            'uid' => 1,
            'uname' => 'admin',
            'design_source' => $source,
        );

        $this->load->model('design/Model_Design', 'design');
        $status = $this->design->editDesign($data, $designId);
        if (!$status) {
            show_error('修改设计图失败');
        }

        if ($_FILES['design_image']['error'] == 0) {
            $this->load->helper('directory');
            $directory = 'upload/design/'.intToPath($designId);
            recursiveMkdirDirectory(WEBROOT . $directory);

            $config['upload_path'] = WEBROOT . $directory;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['file_name'] = 'default';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('design_image')) {
                $uData = $this->upload->data();

                $file = $directory . $uData['file_name'];
                $this->design->updateDesignImage($file, $designId);
            } else {
                show_error('文件上传失败!');
            }
        }

        $this->load->helper('url');
        redirect('administrator/design/designList');
    }

    /**
     * 保存设计图
     */
    public function saveDesign()
    {
        $designName = $this->input->get_post('design_name');
        $designCategory = $this->input->get_post('design_category');
        $voteEndTime = $this->input->get_post('vote_end_time');
        $source = $this->input->get_post('source');
        $designImage = $this->input->get_post('design_image');
        $designDetail = $this->input->get_post('design_detail');
//var_dump($designDetail);exit;
        if (empty ($designName) || empty ($designCategory) || empty ($voteEndTime) || empty ($designDetail) || $_FILES['design_image']['error'] != 0) {
            show_error('参数不全，请检测是否填写相关参数!');
        }

        $data = array(
            'class_id' => $designCategory,
            'dname' => $designName,
            'ddetail' => $designDetail,
            'design_img' => $designImage,
            'source_expand' => '',
            'vote_end_time' => $voteEndTime,
            'uid' => 1,
            'uname' => 'admin',
            'design_source' => $source,
        );

        $this->load->model('design/Model_Design', 'design');
        $lastId = $this->design->addDesign($data);

        if (!$lastId) {
            show_error('添加设计图失败!');
        }
        $this->load->helper('directory');
        //$directory = intToPath($lastId);
        $directory = 'upload/design/'.intToPath($lastId);
        recursiveMkdirDirectory(WEBROOT . $directory);

        $config['upload_path'] = WEBROOT . $directory;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['file_name'] = 'default';

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('design_image')) {
            $uData = $this->upload->data();
            $file = $directory . $uData['file_name'];
            $this->design->updateDesignImage($file, $lastId);
            redirect('administrator/design/designList');
        } else {
            show_error('文件上传失败!');
        }
    }

    /**
     * 删除设计图
     */
    public function deleteDesign()
    {
        $dId = $this->uri->segment(4, 0);
        if (!$dId) {
            show_error('参数不全');
        }

        $this->load->model('design/Model_Design', 'design');
        $status = $this->design->deleteDesignByDid($dId);
        if (!$status) {
            show_error('删除设计图错误');
        }
        redirect('/administrator/design/designList');
    }
}