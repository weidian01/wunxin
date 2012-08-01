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
    public function addFavorite()
    {
        $uid = $this->input->get_post('uid');
        $ip = $this->input->ip_address();

        $response = array('error' => '0', 'msg' => '收藏的设计师成功', 'code' => 'favorite_designer_success');

        do {
            if (empty ($uid)) {
                $response = error(10019);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            //获取被收藏的设计师信息
            $this->load->model('user/Model_User', 'user');
            $uInfo = $this->user->getUserById($uid);
            if (!$uInfo) {
                $response = error(10006);
                break;
            }

            //是否收藏过
            $this->load->model('user/Model_Designer_Favorite', 'favorite');
            $favoriteData = $this->favorite->getUserFavoriteDesigner($this->uInfo['uid'], $uid);
            if ( !empty ($favoriteData) ) {
                $response = error(10017);
                break;
            }

            $data = array(
                'favorite_uid' => $this->uInfo['uid'],
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'ip' => $ip
            );

            $status = $this->favorite->designerFavorite($data);
            if (!$status) {
                $response = error(10018);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 删除收藏的设计师
     */
    public function deleteDesignerFavorite()
    {
        $fid = intval($this->input->get_post('fid'));

        $response = array('error' => '0', 'msg' => '删除收藏的设计师成功', 'code' => 'delete_favorite_designer_success');

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
            $status = $this->favorite->emptyUserFavoriteFavorite($this->uInfo['uid']);
            $response = $status ? error(10023) : error(10024);
        }

        $this->json_output($response);
    }
}
