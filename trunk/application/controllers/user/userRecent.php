<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午3:10
 * To change this template use File | Settings | File Templates.
 */
class userRecent extends MY_Controller
{
    /**
     * 添加收货地址
     */
    public function addUserRecentAddress()
    {
        $recentName = $this->input->get_post('recent_name');
        $country = $this->input->get_post('country');
        $province = $this->input->get_post('province');
        $city = $this->input->get_post('city');
        $area = $this->input->get_post('area');
        $zipCode = $this->input->get_post('zipcode');
        $phoneNum = $this->input->get_post('phone_num');
        $callNum = $this->input->get_post('call_num');
        $detailAddress = $this->input->get_post('detail_address');

        $response = error(10020);

        do {
            if (empty ($recentName) || empty ($country) || empty ($city) || empty ($detail_address) || empty ($phone_num) || empty ($detail_address)) {
                $response = error(10027);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $data = array(
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'recent_name' => $recentName,
                'country' => $country,
                'province' => $province,
                'city' => $city,
                'area' => $area,
                'detail_address' => $detailAddress,
                'zipcode' => $zipCode,
                'phone_num' => $phoneNum,
                'call_num' => $callNum,
            );
            $this->load->model('user/Model_User_Recent', 'recent');
            $status = $this->recent->addUserRecipientAddress($data);
            if (!$status) {
                $response = error(10026);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 编辑收货地址
     */
    public function editUserRecentAddress()
    {
        $aId = intval($this->input->get_post('address_id'));

        $response = error(10029);

        do {
            if (empty ($aId)) {
                $response = error(10028);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('user/Model_User_Recent', 'recent');
            $aInfo = $this->recent->getUserRecentAddressByAid($aId);
            if ($this->uInfo['uid'] != $aInfo['uid']) {
                $response = error(99999);
                break;
            }

            $response['address_info'] = $aInfo;
        } while (false);

        $this->json_output($aInfo);
    }

    /**
     * 保存用户收货地址
     */
    public function saveUserRecentAddress()
    {
        $aId = intval($this->input->get_post('address_id'));
        $recentName = $this->input->get_post('recent_name');
        $country = $this->input->get_post('country');
        $province = $this->input->get_post('province');
        $city = $this->input->get_post('city');
        $area = $this->input->get_post('area');
        $zipCode = $this->input->get_post('zipcode');
        $phoneNum = $this->input->get_post('phone_num');
        $callNum = $this->input->get_post('call_num');
        $detailAddress = $this->input->get_post('detail_address');

        do {
            if (empty ($recentName) || empty ($country) || empty ($city) || empty ($detail_address) || empty ($phone_num) || empty ($detail_address)) {
                $response = error(10028);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('user/Model_User_Recent', 'recent');
            $aInfo = $this->recent->getUserRecentAddressByAid($aId);
            if ($aInfo['uid'] != $this->uInfo['uid']) {
                $response = error(99999);
                break;
            }

            $data = array(
                'recent_name' => $recentName,
                'country' => $country,
                'province' => $province,
                'city' => $city,
                'area' => $area,
                'zipcode' => $zipCode,
                'phone_num' => $phoneNum,
                'call_num' => $callNum,
                'detail_address' => $detailAddress,
            );
            $status = $this->recent->editRecentAddress($aId, $data);
            if (!$status) {
                $response = error(10030);
                break;
            }
        } while (false);
    }

    /**
     * 删除用户收货地址
     */
    public function deleteRecentAddress()
    {
        $aId = intval($this->input->get_post('address_id'));

        $response = error(10032);

        do {
            if (empty ($aId)) {
                $response = error(10033);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('user/Model_User_Recent', 'recent');
            $status = $this->recent->deleteUserRecentAddress($aId, $this->uInfo['uid']);
            if (!$status) {
                $response = error(10031);
                break;
            }
        } while (false);

        $this->json_output($response);
    }
}
