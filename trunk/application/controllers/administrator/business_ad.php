<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-25
 * Time: 上午11:30
 * To change this template use File | Settings | File Templates.
 */
class business_ad extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    /**
     * 广告列表
     */
    public function adList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('/business/Model_Ad', 'ad');
        $totalNum = $this->ad->getAdCount();
        $data = $this->ad->getAdList($Limit, $offset);

        $this->load->model('/business/Model_Ad_Position', 'position');
        $pData = $this->position->getPositionList(1000);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/business_ad/adList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/business/ad/ad_list', array('data' => $data, 'position_data' => $pData, 'page_html' => $pageHtml, 'current_page' => $currentPage));
    }

    /**
     * 添加广告
     */
    public function adAdd()
    {
        $this->load->model('/business/Model_Ad_Position', 'position');
        $pData = $this->position->getPositionList(1000);

        $this->load->view('/administrator/business/ad/ad_create', array('type' => 'add', 'position_data' => $pData));
    }

    /**
     * 广告保存
     */
    public function adSave()
    {
        $name = $this->input->get_post('name');
        $positionId = intval($this->input->get_post('position_id'));
        $adType = intval($this->input->get_post('ad_type'));
        $adContent = $this->input->get_post('ad_content');
        $status = intval($this->input->get_post('status'));
        $adLink = $this->input->get_post('ad_link');
        $sort = $this->input->get_post('sort');
        $startTime = $this->input->get_post('start_time');
        $endTime = $this->input->get_post('end_time');
        $descr = $this->input->get_post('descr');

        if (empty ($name) || empty ($positionId) || empty ($adType) || empty ($adLink) || empty ($startTime) || empty ($endTime) || empty ($descr)) {
            show_error('参数不全');
        }

        $data = array(
            'position_id' => $positionId,
            'ad_name' => $name,
            'ad_type' => $adType,
            'ad_content' => $adContent,
            'click_num' => '',
            'status' => $status,
            'ad_link' => $adLink,
            'sort' => $sort,
            'descr' => $descr,
            'start_time' => $startTime,
            'end_time' => $endTime,
        );
        $this->load->model('/business/Model_Ad', 'ad');
        $lastId = $this->ad->adAdd($data);
        if (!$lastId) {
            show_error('添加广告失败');
        }

        if (in_array($adType, array('1', '2')) && $_FILES['ad_content']['error'] == '0') {
            $this->load->helper('directory');
            $directory = 'upload' . DS . 'advert' . DS . date('Ymd') . DS;
            recursiveMkdirDirectory($directory);

            $config['upload_path'] = WEBROOT . $directory;
            $config['allowed_types'] = 'gif|jpg|png|swf';
            $config['max_size'] = '2000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['file_name'] = $lastId;

            $this->load->library('upload', $config);
    //echo '<pre>';print_r($_FILES);exit;
            if ($this->upload->do_upload('ad_content')) {
                $uData = $this->upload->data();

                $file = $directory . $uData['file_name'];
                $this->ad->updateAd($file, $lastId);
            } else {
                show_error('文件上传失败!');
            }
        }

        redirect('/administrator/business_ad/adList/');
    }

    /**
     * 广告修改
     */
    public function adEdit()
    {
        $aId = $this->uri->segment(4, 1);

        $this->load->model('/business/Model_Ad', 'ad');
        $data = $this->ad->getPositionByAid($aId);

        $this->load->model('/business/Model_Ad_Position', 'position');
        $pData = $this->position->getPositionList(1000);
//echo '<pre>';print_r($data);exit;
        $this->load->view('/administrator/business/ad/ad_create', array('info' => $data, 'type' => 'edit', 'position_data' => $pData));
    }

    /**
     * 广告修改保存
     */
    public function adEditSave()
    {
        $name = $this->input->get_post('name');
        $positionId = intval($this->input->get_post('position_id'));
        $adType = intval($this->input->get_post('ad_type'));
        $adContent = $this->input->get_post('ad_content');
        $status = intval($this->input->get_post('status'));
        $adLink = $this->input->get_post('ad_link');
        $sort = $this->input->get_post('sort');
        $startTime = $this->input->get_post('start_time');
        $endTime = $this->input->get_post('end_time');
        $descr = $this->input->get_post('descr');
        $adId = intval($this->input->get_post('ad_id'));

        if (empty ($adId) || empty ($name) || empty ($positionId) || empty ($adType) || empty ($adLink) || empty ($startTime) || empty ($endTime) || empty ($descr)) {
            show_error('参数不全');
        }

        $data = array(
            'position_id' => $positionId,
            'ad_name' => $name,
            'ad_type' => $adType,
            'ad_content' => $adContent,
            'click_num' => '',
            'status' => $status,
            'ad_link' => $adLink,
            'sort' => $sort,
            'descr' => $descr,
            'start_time' => $startTime,
            'end_time' => $endTime,
        );
        $this->load->model('/business/Model_Ad', 'ad');
        $stat = $this->ad->adEdit($data, $adId);
        if (!$stat) {
            show_error('修改广告失败');
        }

        if (in_array($adType, array('1', '2')) && $_FILES['ad_content']['error'] == '0') {
            $this->load->helper('directory');
            $directory = 'upload' . DS . 'advert' . DS . date('Ymd') . DS;
            recursiveMkdirDirectory($directory);

            $config['upload_path'] = WEBROOT . $directory;
            $config['allowed_types'] = 'gif|jpg|png|swf';
            $config['max_size'] = '2000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['file_name'] = $adId;
            $config['overwrite'] = true;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('ad_content')) {
                $uData = $this->upload->data();

                $file = $directory . $uData['file_name'];
                $this->ad->updateAd($file, $adId);
            } else {
                show_error('文件上传失败!');
            }
        }

        redirect('/administrator/business_ad/adList/');
    }

    /**
     * 广告删除
     */
    public function adDelete()
    {
        $aId = $this->uri->segment(4, 1);
        $currentPage = $this->uri->segment(5, 1);
        if (!$aId) {
            show_error('广告ID为空');
        }

        $this->load->model('/business/Model_Ad', 'ad');
        $this->ad->adDelete($aId);

        redirect('/administrator/business_ad/adList/'.$currentPage);
    }
}
