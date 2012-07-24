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
        $tableName = 'designer_favorite';
        $checkStatus = $this->batchCheckTableField($tableName, $fInfo, true);
        if (!$checkStatus) return false;

        $data = array(
            'uid' => $fInfo['uid'],
            'favorite_uid' => $fInfo['uid'],
            'favorite_uname' => $fInfo['favorite_ip'],
            'ip' => $fInfo['ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert($tableName, $data);
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

    /**
     * 删除一个用户收藏的产品
     *
     * @param int $fId
     * @param int $uid
     * @return boolean
     */
    public function deleteUserFavoriteFavorite($fId, $uid)
    {
        $this->db->where('designer_favorite_id', $fId);
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
        $this->db->where('uid', $uId);
        return $this->db->delete('designer_favorite');
    }

}
