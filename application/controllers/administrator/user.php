<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-26
 * Time: 下午7:00
 * To change this template use File | Settings | File Templates.
 */
class user extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    public function userList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('user/Model_User', 'user');
        $totalNum = $this->user->getUserCount();
        $data = $this->user->getUserList($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/user/userList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
        //echo '<pre>';print_r($data);exit;
        $this->load->view('/administrator/user/list', array('data' => $data, 'page_html' => $pageHtml, 'current_page' => $currentPage));
    }

    public function search()
    {
        $sType = $this->input->get_post('s_type');
        $keyword = $this->input->get_post('keyword');

        $this->load->model('user/Model_User', 'user');
        switch ($sType) {
            case 1:
                $info = $this->user->getUserById($keyword);
                $data[] = $info;
                break;
            case 2:
                $info = $this->user->getUserByName($keyword);
                $data[] = $info;
                break;
            default: show_error('未知的搜索类型');
        }

        $this->load->view('/administrator/user/list', array('data' => $data));
    }
}
