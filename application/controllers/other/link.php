<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-11
 * Time: 下午2:23
 * To change this template use File | Settings | File Templates.
 */
class link extends MY_Controller
{
    public function index()
    {
        $data = array(
            'title' => '友情链接',
        );
        $this->load->view('/other/link', $data);
    }

    public function apply()
    {
        $siteName = $this->input->get_post('site_name');
        $siteAddr = $this->input->get_post('site_addr');
        $email = $this->input->get_post('email');
        $siteIntro = $this->input->get_post('site_intro');
        $verifyCode = $this->input->get_post('verify_code');

        if (empty ($siteName) || empty ($siteAddr) || empty ($email) || empty ($siteIntro) ) {
            show_error('参数不全!');
        }

        //var_dump($this->getVerifyCode()); var_dump($verifyCode);
        if ('' === $verifyCode || md5(strtolower($verifyCode)) !== ($this->getVerifyCode())) {
            show_error('验证码错误!');
        }

        //site_name, site_addr, email, site_intro, create_time
        $data = array(
            'site_name' => $siteName,
            'site_addr' => $siteAddr,
            'email' => $email,
            'site_intro' => $siteIntro,
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('links', $data);
        $status = $this->db->insert_id();

        if (!$status) {
            show_error('申请请求失败!');
        }

        echo '<script>alert("申请成功，等待管理员审核！");window.location.href="/";</script>';
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
}
