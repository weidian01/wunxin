<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午9:30
 * To change this template use File | Settings | File Templates.
 */
class favorite extends MY_Controller
{
    /**
     * 添加设计图收藏
     */
    public function add()
    {
        $dId = $this->input->get_post('design_id');
        $ip = $this->input->ip_address();

        $response = array('error' => '0', 'msg' => '设计图收藏成功', 'code' => 'add_design_favorite_success');

        do {
            if (empty ($dId)) {
                $response = error(40012);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('design/Model_Design', 'design');
            $dInfo = $this->design->getDesignByDid($dId);
            if (!$dInfo) {
                $response = error(40005);
                break;
            }
            $this->load->model('design/Model_Design_Favorite', 'favorite');
            $favoriteData = $this->favorite->getUserDesignFavorite($this->uInfo['uid'], $dId);
            if (!empty ($favoriteData)) {
                $response = error(40010);
                break;
            }

            $data = array(
                'did' => $dId,
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'ip' => $ip,
            );

            $status = $this->favorite->userFavoriteDesign($data);
            if (!$status) {
                $response = error(40011);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 删除设计图收藏
     */
    public function deleteFavorite()
    {
        $dId = $this->input->get_post('design_id');

        $response = array('error' => '0', 'msg' => '删除设计图收藏成功', 'code' => 'delete_design_favorite_success');

        do {
            if (empty ($dId)) {
                $response = error(40015);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('design/Model_Design_Favorite', 'favorite');
            $status = $this->favorite->deleteUserFavoriteDesignByDid($dId, $this->uInfo['uid']);
            if (!$status) {
                $response = error(40014);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 清空设计图收藏
     */
    public function emptyFavorite()
    {
        if (!$this->isLogin()) {
            $response = error(10009);
        } else {
            $this->load->model('design/Model_Design_Favorite', 'favorite');
            $status = $this->favorite->emptyUserProductFavoriteByUid($this->uInfo['uid']);
            $response = $status ? array('error' => '0', 'msg' => '清空设计图收藏成功', 'code' => 'empty_design_favorite_success') : error(40017);
        }

        $this->json_output($response);
    }
}
