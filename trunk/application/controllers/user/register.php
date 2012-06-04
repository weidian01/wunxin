<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class register extends MY_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    /**
     * 显示注册页面
     */
    public function index()
    {
        $this->load->view('user/reg');
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
        $redirect_url = is_url($redirect_url) ? $redirect_url : config_item('base_url');
        $source = $this->input->get_post('source');
        $source = $source ? $source : 1;

        $response['code'] = '0';
        $response['msg'] = $redirect_url;
        do {
            if (!is_username($username)) {
                $response = error(10001);
                break;
            }
            if ($password !== $repassword) {
                $response = error(10003);
                break;
            }

            if (!length_limit($password, 8, 16)) {
                $response = error(10004);
                break;
            }

            if ('' === $verifyCode || strtolower($verifyCode) !== strtolower($this->getVerifyCode())) {
                $response = error(10005);
                break;
            }

            $this->load->model('user/Model_User', 'user');
            if ($this->user->userNameIsExist($username)) {
                $response = error(10002);
                break;
            }
        } while (false);

        $this->usetVerifyCode();

        if (! isset($response['error'])) {
            $data = array(
                'uname' => $username,
                'password' => $password,
                'nickname' => $username,
                'source' => $source,
            );
            $uid = $this->user->registerUser($data);
            if (!$uid) {
                $response = error(10008);
            }
        }
        echo json_encode($response);
    }

    /**
     * 检查用户名是否存在
     */
    public function checkUserName()
    {
        $username = $this->input->get_post('username');

        $this->load->helper('validation');

        $response['code'] = '0';
        $response['msg'] = '用户名可用';

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

        echo json_encode($response);
    }

    /**
     * 显示验证码图片
     */
    public function verifyCode()
    {
        $code = $this->setVerifyCode();
        $this->lib('codeimg', array('code'=>$code));
        $this->codeimg->display();
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
    private function setVerifyCode($lenght = 6)
    {

        $this->load->helper('string');
        $rand_str =  str_replace(array('0','O','1','l'), array('o','o','L','L'), random_string('alnum', $lenght));
        $newdata = array('verifyCode'  => $rand_str);
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