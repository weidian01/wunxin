<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午6:54
 * To change this template use File | Settings | File Templates.
 */
class Model_Design_Favorite extends MY_Model
{
    /**
     * @name 用户收藏设计图
     *
     * @param array $dInfo
     * @return boolean
     */
    public function userFavoriteDesign(array $dInfo)
    {
        $data = array(
            'did' => $dInfo['did'],
            'uid' => $dInfo['uid'],
            'uname' => $dInfo['uname'],
            'ip' => $dInfo['ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('design_favorite', $data);
        $lastId = $this->db->insert_id();
        if ($lastId) {
            $this->db->where('did', $dInfo['did']);
            $this->db->set('favorite_num', 'favorite_num+1', false);
            $this->db->update('design');
        }

        return $lastId;
    }

    /**
     * 获取用户收藏的产品
     *
     * @param $uId
     * @param $dId
     * @return null | array
     */
    public function getUserDesignFavorite($uId, $dId)
    {
        $data = $this->db->select('*')->get_where('design_favorite', array('uid' => $uId, 'did' => $dId))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户收藏的设计图
     *
     * @param int $uId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getUserFavoriteDesignByUid($uId, $limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->get_where('design_favorite', array('uid' => $uId), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }


    /**
     * 获取用户设计图收藏和设计图信息
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserDesignFavoriteAndDesign($uId, $limit = 20, $offset = 0)
    {
        $field = 'design.did, class_id, dname, ddetail, design_img, design_source, source_expand, status, vote_end_time, total_num, total_fraction, favorite_num, comment_num,
        id, design_favorite.uid, design_favorite.uname, ip, design_favorite.create_time';

        $this->db->select($field)->from('design_favorite')->join('design', 'design_favorite.did = design.did', 'left')->where('design_favorite.uid', $uId);
        $this->db->limit($limit, $offset)->order_by('design_favorite.create_time', 'desc');

        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户设计图收藏和设计图信息数量
     *
     * @param $uId
     * @return int
     */
    public function getUserDesignFavoriteAndDesignCount($uId)
    {
        $field = '*';

        $this->db->select($field)->from('design_favorite')->join('design', 'design_favorite.did = design.did', 'left')->where('design_favorite.uid', $uId);

        return $this->db->count_all_results();
    }

    /**
     * 获取用户收藏设计师推荐
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserFavoriteDesignRecommend($limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->from('design')->order_by('favorite_num', 'desc')->limit($limit, $offset)->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 删除设计图收藏
     *
     * @param int $dId
     * @return boolean
     */
    public function deleteDesignFavoriteByDid($dId)
    {
        $this->db->where('id', $dId);
        return $this->db->delete('design_favorite');
    }

    /**
     * 删除用户收藏的设计图
     *
     * @param $dId
     * @param $uId
     * @return boolean
     */
    public function deleteUserFavoriteDesignByDid($dId, $uId)
    {
        $this->db->where('id', $dId);
        $this->db->where('uid', $uId);
        return $this->db->delete('design_favorite');
    }

    /**
     * 清空用户收藏的设计图
     *
     * @param int $uId
     * @return boolean
     */
    public function emptyUserProductFavoriteByUid($uId)
    {
        $this->db->where('uid', $uId);
        return $this->db->delete('design_favorite');
    }

}
