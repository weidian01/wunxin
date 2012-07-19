<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->isLogin()) {
            //redirect();
        }

        if(! $this->input->is_ajax_request()){
            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }
    }

    /**
     * 展示登陆页面.
     */
    public function index()
    {
        /*
        if ($this->isLogin()) {
            $referer = $this->input->server('HTTP_REFERER');
            $referer = empty ($referer) ? config_item('base_url') : $referer;
            $this->load->helper('url');
            redirect($referer);
        }
        //*/
        $redirect_url = $this->input->get_post('redirect_url');
        $source = $this->input->get_post('source');

        $this->load->view('user/login', array('redirect_url' => $redirect_url, 'source' => $source));
    }

    /**
     * 提交登陆
     */
    public function submit()
    {
        /*
        if ($this->isLogin()) {
            $referer = $this->input->server('HTTP_REFERER');
            $referer = empty ($referer) ? config_item('base_url') : $referer;
            $this->load->helper('url');
            redirect($referer, 'refresh');
        }
        //*/

        $this->load->helper('validation');
        $this->load->helper('cookie');

        $username = $this->input->get_post('username');
        $password = $this->input->get_post('password');
        $source = intval($this->input->get_post('source'));
        $redirect_url = $this->input->get_post('redirect_url');
        $redirect_url = is_url($redirect_url) ? $redirect_url : config_item('base_url'); //跳转地址
        $expire = $this->input->get_post('remember') ? (86400 * 360) : 0; //是否记录登录状态

        $response = error(10000);
        $response['redirect_url'] = $redirect_url;

        do {
            if ($this->isLogin()) {
                break;
            }

            if (!is_username($username)) {
                $response = error(10001);
                break;
            }

            if (!length_limit($password, 6, 32)) {
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

            //设置用户登陆状态
            set_cookie('auth', authcode("{$uInfo['uid']}\t{$uInfo['uname']}\t{$uInfo['password']}", 'ENCODE'), $expire);
            //$this->set_user_cookie($uInfo);

            //记录用户登陆日志
            $ip = $this->input->ip_address();
            $this->load->model('user/Model_User_Log', 'userlog');
            $this->userlog->record_login_log($uInfo['uid'], $ip, $source);

        } while (false);

        echo self::json_output($response);
    }

    /**
     * 退出登陆
     */
    public function login_out()
    {
        $this->load->helper('url');
        $this->load->helper('cookie');
        delete_cookie('auth');

        unset ($this->uInfo);
        
        redirect(config_item('base_url'));
    }

    public function getUserInfo ()
    {
        $response = error(10009);

        if ($this->isLogin()) {
            $response = error(10000);
            $response['user_info'] = $this->uInfo;
        }

        self::json_output($response);
    }

    /**
     * 设置用户登陆cookie
     *
     * @private    public
     * @param    string    用户信息
     * @param    string    过期时间
     * @return    void
     */
//    private function set_user_cookie(array $cInfo, $expire = 86400)
//    {
//        $this->input->set_cookie('uid', $cInfo['uid'], $expire);
//        $this->input->set_cookie('username', $cInfo['uname'], $expire);
//        $this->input->set_cookie('password', $cInfo['password'], $expire);
//        //return filter_var($url, FILTER_VALIDATE_URL);
//    }


    /**
     * 清除用户cookie
     *
     * @access    public
     * @return    void
     */
//    private function delete_user_cookie()
//    {
//        $expire = TIMESTAMP - 86400;
//
//        $this->input->set_cookie('uid', '', $expire);
//        $this->input->set_cookie('username', '', $expire);
//        $this->input->set_cookie('password', '', $expire);
//    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */