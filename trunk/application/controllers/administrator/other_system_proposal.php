<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-26
 * Time: 下午12:16
 * To change this template use File | Settings | File Templates.
 */
class other_system_proposal extends MY_Controller
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
     * 获取系统建议与意见列表
     */
    public function systemProposalList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('other/Model_System_Proposal', 'proposal');
        $totalNum = $this->proposal->getSystemProposalCount();
        $data = $this->proposal->getSystemProposalList($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/other_system_proposal/systemProposalList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        //$config['anchor_class'] = 'class="number"';
                //所有页码外围
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        //当前页码
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        //其他页码
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        //上一页
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        //下一页
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        //首页
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        //尾页
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
//echo '<pre>';print_r($cdata);exit;
        $this->load->view('/administrator/bootstrap/other/system_proposal/list', array('data' => $data, 'page_html' => $pageHtml, 'current_page' => $currentPage));
    }

    /**
     * 删除系统建议与意见
     */
    public function systemProposalDelete()
    {
        $id = $this->uri->segment(4, 1);
        $currentPage = $this->uri->segment(5, 1);
        if (!$id) {
            show_error('系统建议与意见ID为空');
        }

        $this->load->model('other/Model_System_Proposal', 'proposal');
        $status = $this->proposal->deleteSystemProposal($id);
        if (!$status) {
            show_error('删除系统建议与意见失败');
        }

        redirect('/administrator/other_system_proposal/systemProposalList/'.$currentPage);
    }
}
