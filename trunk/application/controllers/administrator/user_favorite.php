<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-28
 * Time: 上午9:58
 * To change this template use File | Settings | File Templates.
 */
class user_favorite extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    /**
     * 用户收藏列表
     */
    public function favoriteList()
    {
        $uId = $this->uri->segment(4, 1);
        $type = $this->uri->segment(5, 1);
        if (!$uId) {
            show_error('用户ID为空');
        }

        //设计师收藏
        $this->load->model('/user/Model_Designer_Favorite', 'd_favorite');
        $designerFavoriteData = $this->d_favorite->getUserDesignerFavorite($uId);

        //产品收藏
        $this->load->model('/product/Model_Product_Favorite', 'p_favorite');
        $productFavoriteData = $this->p_favorite->getUserProductFavorite($uId);

        //设计图收藏
        $this->load->model('/design/Model_Design_Favorite', 'favorite');
        $designFavoriteData = $this->favorite->getUserFavoriteDesignByUid($uId);

        $data = array(
            'type' => $type,
            'uid' => $uId,
            'designer_favorite_data' => $designerFavoriteData,
            'product_favorite_data' => $productFavoriteData,
            'design_favorite_data' => $designFavoriteData,
        );

        $this->load->view('/administrator/user/favorite/list', $data);
    }

    /**
     * 删除收藏
     */
    public function favoriteDelete()
    {
        $fId = $this->uri->segment(4, 1);
        $uId = $this->uri->segment(5, 1);
        $type = $this->uri->segment(6, 0);

        if (!in_array($type, array('1', '2', '3'))) {
            show_error('删除类别错误');
        }

        if (!$uId) {
            show_error('用户ID为空');
        }

        if (!$fId) {
            show_error('收藏ID为空');
        }

        switch ($type) {
            case '1':
                $this->load->model('/user/Model_Designer_Favorite', 'favorite');
                $this->favorite->deleteUserFavoriteDesignerByfId($fId);
                break;
            case '2':
                $this->load->model('/product/Model_Product_Favorite', 'favorite');
                $this->favorite->deleteUserProductFavorite($fId);
                break;
            case '3':
                $this->load->model('/design/Model_Design_Favorite', 'favorite');
                $this->favorite->deleteDesignFavoriteByDid($fId);
                break;
        }

        redirect('/administrator/user_favorite/favoriteList/'.$uId.'/'.$type);
    }
}
