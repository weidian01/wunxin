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

    public function userDetail()
    {
        $uid = $this->uri->segment(4, 1);
        if (!$uid) {
            show_error('用户ID为空');
        }

        //登陆日志 开始
        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('user/Model_User_Log', 'logs');
        $totalNum = $this->logs->getUserLoginLogCount($uid);
        $loginLogData = $this->logs->getUserLoginLogList($uid, $Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/user/userDetail/'.$uid;
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();
        //登陆日志 结束

        //用户信息
        $this->load->model('user/Model_User', 'user');
        $userBasicInfo = $this->user->getUserAllInfoById($uid);

        //收货地址
        $this->load->model('user/Model_User_Recent', 'recent');
        $recentData = $this->recent->getUserRecentAddressByUid($uid, 1000);

        //用户发票
        $this->load->model('order/Model_Order_Invoice', 'invoice');
        $invoiceData = $this->invoice->getUserInvoiceByuId($uid, 1000);

        //升级日志
        $this->load->model('user/Model_User_Level', 'level');
        $levelData = $this->level->getUserLevelList($uid, 1000);

        //消费日志
        $this->load->model('user/Model_User_Consume', 'consume');
        $consumeData = $this->consume->getUserConsumeList($uid, 1000);

        //找回密码日志
        $this->load->model('user/Model_User_Retrieve', 'retrieve');
        $retrieveData = $this->retrieve->getUserRetrieveList($uid, 1000);

        //积分日志
        $this->load->model('user/Model_User_Integral', 'integral');
        $integralData = $this->integral->getUserIntegralList($uid, 1000);

        //申请返现日志
        $this->load->model('user/Model_User_Apply_Cash_Back', 'acb');
        $acbData = $this->acb->getUserAcbList($uid, 1000);

        //echo '<pre>';print_r($userBasicInfo);exit;
        $data = array(
            'page_html' => $pageHtml,
            'login_log_data' => $loginLogData,
            'user_info' => $userBasicInfo,
            'recent_data' => $recentData,
            'invoice_data' => $invoiceData,
            'level_up_data' => $levelData,
            'consume_data' => $consumeData,
            'retrieve_data' => $retrieveData,
            'integral_data' => $integralData,
            'acb_data' => $acbData,

        );
        $this->load->view('/administrator/user/detail', $data);
    }
}
