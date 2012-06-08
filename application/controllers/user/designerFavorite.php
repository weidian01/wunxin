<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午1:55
 * To change this template use File | Settings | File Templates.
 */
class designerFavorite extends MY_Controller
{
    public function addDesignerFavorite()
    {
        $uid = $this->input->get_post('uid');
        $ip = $this->input->ip_address();

        $response = error(10013);

        do {
            if (empty ($uid)) {
                $response = error(10012);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('user/Model_User', 'user');
            $uInfo = $this->user->getUserById($uid);
            if (!$uInfo) {
                $response = error(10006);
                break;
            }

            $data = array(
                'uid' => $uid,
                'favorite_uid' => $this->uInfo['uid'],
                'favorite_uname' => $this->uInfo['uname'],
                'ip' => $ip
            );
            $this->load->model('user/Model_Designer_Favorite', 'favorite');
            $this->favorite->designerFavorite($data);
        } while (false);

        $this->json_output($response);
    }

    public function deleteDesignerFavorite()
    {

    }

    public function emptyDesignerFavorite()
    {

    }
}
