<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class register extends MY_Controller
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
     * 显示注册页面
     */
    public function index()
    {
        $redirect_url = $this->input->get_post('redirect_url');
        $source = $this->input->get_post('source');

        $this->load->view('user/register', array('redirect_url' => $redirect_url, 'source' => $source));
    }

    /**
     * 接受注册表单信息页面
     */
    public function submit()
    {
        $this->load->helper('validation');

        $username = $this->input->get_post('username');
        $password = $this->input->get_post('password');
        $repassword = $this->input->get_post('repassword');
        $verifyCode = $this->input->get_post('verify_code');
        $redirect_url = $this->input->get_post('redirect_url');
        $redirect_url = is_url($redirect_url) ? $redirect_url : '/user/login/';
        $source = $this->input->get_post('source');
        $source = $source ? $source : 1;

        $response = array('error' => '0', 'msg' => '注册用户成功', 'code' => 'register_user_success');
        $response['redirect_url'] = $redirect_url;

        do {
            if (!is_username($username)) {
                $response = error(10001);
                break;
            }
            if ($password !== $repassword) {
                $response = error(10003);
                break;
            }

            if (!length_limit($password, 6, 32)) {
                $response = error(10004);
                break;
            }

            if ('' === $verifyCode || md5(strtolower($verifyCode)) !== ($this->getVerifyCode())) {
                $response = error(10005);
                break;
            }

            $this->load->model('user/Model_User', 'user');
            if ($this->user->userNameIsExist($username)) {
                $response = error(10002);
                break;
            }

            $this->usetVerifyCode();

            $data = array(
                'uname' => $username,
                'password' => $password,
                'nickname' => $username,
                'source' => $source,
            );
            $uid = $this->user->registerUser($data);
            if (!$uid) {
                $response = error(10008);
                break;
            }
        } while (false);

        echo self::json_output($response);
    }

    /**
     * 检查用户名是否存在
     */
    public function checkUserName()
    {
        $username = $this->input->get_post('username');

        $this->load->helper('validation');

        $response = error(10035);

        if (!is_username($username)) {
            $response = error(10001);
        }
        else
        {
            $this->load->model('user/Model_User', 'user');
            if ($this->user->userNameIsExist($username)) {
                $response = error(10002);
            }
        }

        echo self::json_output($response);
    }

    /**
     * 显示验证码图片
     */
    public function verifyCode()
    {
        $code = $this->setVerifyCode();
        //$this->input->set_cookie('verify_code', $code, 60);
        $this->lib('captcha', array('code'=>$code));
        $this->captcha->display();
    }

    public function checkVerifyCode()
    {
        $verifyCode = $this->input->get_post('verify_code');

        //$vc = md5(strtolower($verifyCode));

        if ('' === $verifyCode || md5(strtolower($verifyCode)) !== ($this->getVerifyCode())) {
            $response = error(10005);
        } else {
            $response = array('error' => '0', 'msg' => '验证成功', 'code' => 'verify_success');
        }

        self::json_output($response, true);
    }

    public function show()
    {
        echo $this->getVerifyCode();
    }

    /**
     * 生成验证码
     * @param int $lenght
     * @return mixed
     */
    private function setVerifyCode($lenght = 4)
    {

        $this->load->helper('string');
        $rand_str =  str_replace(array('0','O','1','l'), array('o','o','L','L'), random_string('alnum', $lenght));
        $newdata = array('verifyCode'  => md5(strtolower($rand_str)));
        $this->lib('session');
        $this->session->set_userdata($newdata);
        return $rand_str;
    }

    /**
     * 获取验证码
     * @return mixed
     */
    private function getVerifyCode()
    {
        $this->lib('session');
        return $this->session->userdata('verifyCode');
    }

    /**
     * 销毁验证码
     * @return mixed
     */
    private function usetVerifyCode()
    {
        $this->lib('session');
        $this->session->unset_userdata('verifyCode');
        return;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */