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


    }
}
