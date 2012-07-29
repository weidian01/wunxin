<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午6:06
 * To change this template use File | Settings | File Templates.
 */
class user extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 修改用户信息
     */
    public function saveUserInfo()
    {
        $nickname = $this->input->get_post('nickname');
        $data['real_name'] = $this->input->get_post('realname');
        $data['sex'] = $this->input->get_post('sex');
        $data['birthday'] = $this->input->get_post('birthday');
        $data['marital_status'] = $this->input->get_post('marital_status');
        $data['education_level'] = $this->input->get_post('education_level');
        $data['job'] = $this->input->get_post('job');
        $data['industry'] = $this->input->get_post('industry');
        $data['income'] = $this->input->get_post('income');
        $data['height'] = $this->input->get_post('height');
        $data['weight'] = $this->input->get_post('weight');
        $data['body_type'] = $this->input->get_post('body_type');
        $data['website'] = $this->input->get_post('website');
        $data['introduction'] = $this->input->get_post('introduction');
        $data['interest'] = $this->input->get_post('interest');
        $data['province'] =$this->input->get_post('province');
        $data['city'] =$this->input->get_post('city');
        $data['family_call'] =$this->input->get_post('family_call');
        $data['company_call'] =$this->input->get_post('company_call');
        $data['phone'] =$this->input->get_post('phone');
        $data['qq'] =$this->input->get_post('qq');
        $data['detail_address'] =$this->input->get_post('detail_address');
        $data['zipcode'] =$this->input->get_post('zipcode');
        $data['id_card'] =$this->input->get_post('id_card');
        $data['bank_name'] =$this->input->get_post('bank_name');
        $data['bank_account'] =$this->input->get_post('bank_account');
//print_r($data);exit;
        $response = array('error' => '0', 'msg' => '保存用户信息成功', 'code' => 'save_user_info_success');

        do {
            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('user/Model_User', 'user');
            $nStatus = $this->user->modifyUserNickName($this->uInfo['uid'], $nickname);
            if (!$nStatus) {
                $response = error(10039);
                break;
            }

            $uStatus = $this->user->modifyDetailUser($this->uInfo['uid'], $data);
            if (!$uStatus) {
                $response = error(10040);
                break;
            }

        } while (false);

        self::json_output($response);
    }

    public function getUserHeader()
    {
        $uId = intval( $this->input->get_post('uid') );
        $type = intval( $this->input->get_post('type') );//1为default, 其他为icon

        $imgName = ($type == 1) ? 'default.jpg' : 'icon.jpg';

        if ( empty ($uId) ) {
            return '';
        }

        $this->load->model('user/Model_User', 'user');
        $userInfo = $this->user->getUserById($uId);

        if (empty ($userInfo)) {
            return '';
        }
        $header = '';
        //var_dump($userInfo['header']);
        if ($userInfo['header'] <= 0) {
            $header = '/images/avatar/avatar1.jpg';
        } else {
            $header = '/upload'.DS.'designer'.DS.intToPath($uId).$imgName;
        }

        header('Accept-Ranges: bytes');
        header('Content-Length: ' . filesize(config_item('base_url').$header));
        header('Keep-Alive: timeout=15, max=2469');
        echo file_get_contents(config_item('base_url').$header));
        file_put_contents("cookieLog.txt", $_SERVER['REQUEST_URI']);
        //header( 'Content-Type:text/xml');
        //echo $header;
    }
}
