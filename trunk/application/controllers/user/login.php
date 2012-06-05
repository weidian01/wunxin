<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class login extends MY_Controller
{

    /**
     * 展示登陆页面.
     */
    public function index()
    {
        echo '123';
    }

    /**
     * 提交登陆
     */
    public function submit()
    {
        $this->load->helper('validation');
        $this->load->helper('cookie');

        $username = $this->input->get_post('username');
        $password = $this->input->get_post('password');
        $source   = intval( $this->input->get_post('source') );
        $redirect_url = $this->input->get_post('redirect_url');
        $redirect_url = is_url($redirect_url) ? $redirect_url : config_item('base_url');

        $response['code'] = '0';
        $response['msg'] = $redirect_url;

        do {
            if (get_user_cookie()) {
                break;
            }
            if (!is_username($username)) {
                $response = error(10001);
                break;
            }
            if (!length_limit($password, 8, 16)) {
                $response = error(10004);
                break;
            }

            $this->load->model('user/Model_User', 'user');
            $uInfo = $this->user->userLogin($username, $password);

            if ($uInfo === 1) {
                $response = error(10006);
                break;
            } elseif ($uInfo === 2) {
                $response = error(10007);
                break;
            }

            //$response['user_info'] = $uInfo;

            //设置用户登陆状态
            set_user_cookie($uInfo);

            //记录用户登陆日志
            $ip = $this->input->ip_address();
            $this->load->model('user/Model_User_Log', 'userlog');
            $this->userlog->record_login_log($uInfo['uid'],$ip, $source);

        } while (false);

        echo json_encode($response);
    }
    /**
     * 退出登陆
     */
    public function login_out()
    {
        $this->load->helper('url');
        $this->load->helper('cookie');

        delete_user_cookie();

        redirect(config_item('base_url'), 'refresh');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */