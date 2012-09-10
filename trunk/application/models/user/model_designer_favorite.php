<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Designer_Favorite extends MY_Model
{
    /**
     * @name 收藏设计师
     *
     * @param array $fInfo
     * @return boolean
     */
    public function designerFavorite(array $fInfo)
    {
        $data = array(
            'favorite_uid' => $fInfo['favorite_uid'],
            'uid' => $fInfo['uid'],
            'uname' => $fInfo['uname'],
            'ip' => $fInfo['ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('designer_favorite', $data);
        return $this->db->insert_id();
    }

    /**
     * 获取用户收藏的设计师列表
     *
     * @param int $uId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getUserDesignerFavorite($uId, $limit = 20, $offset = 0)
    {
        return $this->db->select('*')->get_where('designer_favorite', array('favorite_uid' => $uId), $limit, $offset)->result_array();
    }

    /**
     * 获取用户收藏的设计师数量
     *
     * @param $uId
     * @return int
     */
    public function getUserDesignerFavoriteCount($uId)
    {
        $this->db->select('*')->from('designer_favorite')->where('favorite_uid', $uId);

        return $this->db->count_all_results();
    }

    public function getUserDesignerFavoriteAndUser($uId, $limit = 20, $offset = 0)
    {
        $field = 'fid, favorite_uid, designer_favorite.uid, designer_favorite.uname, ip, designer_favorite.create_time,
        favorite_num, nickname, lid, password, source, integral, amount, status, designer_favorite.create_time';

        $this->db->select($field)->from('designer_favorite')->join('user', 'designer_favorite.uid = user.uid')->where('designer_favorite.favorite_uid', $uId);
        $this->db->limit($limit, $offset)->order_by('designer_favorite.create_time', 'desc');

        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    public function getUserDesignerFavoriteAndUserCount($uId)
    {
        $field = 'designer_favorite_id, user.uid, favorite_uid, favorite_uname, ip,
        uname, nickname, lid, password, source, integral, amount, status, designer_favorite.create_time';

        $this->db->select($field)->from('designer_favorite')->join('user', 'designer_favorite.uid = user.uid')->where('designer_favorite.favorite_uid', $uId);

        return $this->db->count_all_results();
    }

    /**
     * 获取设计师收藏推荐
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserFavoriteRecommend($limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->from('user')->order_by('favorite_num', 'desc')->limit($limit, $offset)->get()->result_array();

        return empty ($data) ? null : $data;
    }


    /**
     * 获取用户收藏的某个设计师
     *
     * @param $uId
     * @param $fuId
     * @return null ｜array
     */
    public function getUserFavoriteDesigner($uId, $fuId)
    {
        $data = $this->db->select('*')->from('designer_favorite')->where('favorite_uid', $uId)->where('uid', $fuId)->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 删除一个用户收藏的产品
     *
     * @param int $fId
     * @param int $uid
     * @return boolean
     */
    public function deleteUserFavoriteFavorite($fId, $uid)
    {
        $this->db->where('fid', $fId);
        $this->db->where('favorite_uid', $uid);
        return $this->db->delete('designer_favorite');
    }

    /**
     * 删除用户收藏的设计师
     *
     * @param $fId
     * @return boolean
     */
    public function deleteUserFavoriteDesignerByfId($fId)
    {
        $this->db->where('designer_favorite_id', $fId);
        return $this->db->delete('designer_favorite');
    }

    /**
     * 清空用户收藏的设计师
     *
     * @param int $uId
     * @return boolean
     */
    public function emptyUserFavoriteFavorite($uId)
    {
        $this->db->where('favorite_uid', $uId);
        return $this->db->delete('designer_favorite');
    }

}
