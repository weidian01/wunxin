<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller
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
        echo '123';
    }

    public function submit()
    {
        $this->load->helper('validation');
        $this->load->helper('cookie');

        $username = $this->input->get_post('username');
        $password = $this->input->get_post('password');
        $redirect_url = $this->input->get_post('redirect_url');
        $redirect_url = is_url($redirect_url) ? $redirect_url : config_item('base_url');

        $response['code'] = '0';
        $response['msg'] = $redirect_url;

        do {
            if (get_user_cookie()) {
                break;
            }
            if (!is_username($username)) {
                $response['code'] = '10001';
                $response['msg'] = '用户名不合法';
                break;
            }
            if (!length_limit($password, 8, 16)) {
                $response['code'] = '10002';
                $response['msg'] = '密码不合法';
                break;
            }

            $this->load->model('user/user', 'user');
            $uInfo = $this->user->userLogin($username, $password);

            if ($uInfo === 1) {
                $response['code'] = '10003';
                $response['msg'] = '用户不存在';
                break;
            } elseif ($uInfo === 2) {
                $response['code'] = '10004';
                $response['msg'] = '用户密码错误';
                break;
            }

            //$response['user_info'] = $uInfo;

            //设置用户登陆状态
            set_user_cookie($uInfo);

        } while (false);


        echo json_encode($response);
    }

    public function login_out()
    {
        $this->load->helper('url');
        $redirect_url = $this->input->get_post('redirect_url');
        $redirect_url = is_url($redirect_url) ? $redirect_url : config_item('base_url');
        $this->load->helper('cookie');
        delete_user_cookie();

        redirect($redirect_url);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */