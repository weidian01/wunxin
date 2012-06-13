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
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    public function addDesign()
    {
        $this->load->model('design/Model_Design_Category', 'category');
        $category = $this->category->getCategoryList();

        $this->load->view('/administrator/design/design_add', array('category' => $category, 'h1Title' => '添加设计图'));
    }

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

        $this->load->view('/administrator/design/design_list', array('data' => $designData, 'page_html' => $pageHtml));
    }

    public function editDesign()
    {
        $dId = $this->input->get_post('did');

        $this->load->model('design/Model_Design', 'design');
        $designData = $this->design->getDesignList();

        $this->load->view('/administrator/design/design_edit', array('data' => $designData));
    }

    public function saveDesign()
    {
        $designName = $this->input->get_post('design_name');
        $designCategory = $this->input->get_post('design_category');
        $voteEndTime = $this->input->get_post('vote_end_time');
        $source = $this->input->get_post('source');
        $designImage = $this->input->get_post('design_image');
        $designDetail = $this->input->get_post('design_detail');

        if (empty ($designName) || empty ($designCategory) || empty ($voteEndTime) || empty ($designDetail)) {
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
        $directory = generationDesignDirectory($lastId);
        echo '<pre>';print_r($directory);exit;
        $config['upload_path'] = $directory;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['file_name'] = $directory;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('design_image')) {
            show_error('文件上传失败!');
        } else {

        }

    }
}
