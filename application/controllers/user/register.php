<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class register extends CI_Controller
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
    public function index()
    {
        $this->load->view('user/reg');
    }

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

            if (!$verifyCode) {
                $response = error(10005);
                break;
            }

            $this->load->model('user/user', 'user');
            if ($this->user->userNameIsExist($username)) {
                $response = error(10002);
                break;
            }
        } while (false);

        if (! isset($response['error'])) {
            $data = array(
                'uname' => $username,
                'password' => $password,
                'nickname' => $username,
                'source' => $source,
            );
            $uid = $this->user->registerUser($data);
            if (!$uid) {
                $response['code'] = '10006';
                $response['msg'] = '注册用户失败';
            }
        }
        echo json_encode($response);
    }

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
            $this->load->model('user/user', 'user');
            if ($this->user->userNameIsExist($username)) {
                $response = error(10002);
            }
        }

        echo json_encode($response);
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */