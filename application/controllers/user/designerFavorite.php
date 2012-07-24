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
    /**
     * 添加设计收藏
     */
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

    /**
     * 删除收藏的设计师
     */
    public function deleteDesignerFavorite()
    {
        $fid = intval($this->input->get_post('fid'));

        $response = error(10020);

        do {
            if (empty ($fid)) {
                $response = error(10022);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('user/Model_Designer_Favorite', 'favorite');
            $status = $this->favorite->deleteUserFavoriteFavorite($fid, $this->uInfo['uid']);
            if (!$status) {
                $response = error(10021);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 清空设计师收藏夹
     */
    public function emptyDesignerFavorite()
    {
        if (!$this->isLogin()) {
            $response = error(10009);
        } else {
            $this->load->model('user/Model_Designer_Favorite', 'favorite');
            $status = $this->favorite->emptyUserProductFavorite($this->uInfo['uid']);
            $response = $status ? error(10023) : error(10024);
        }

        $this->json_output($response);
    }
}
