<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
        $tableName = 'design_favorite';
        $checkStatus = $this->batchCheckTableField($tableName, $dInfo, true);
        if (!$checkStatus) return false;

        $data = array(
            'did' => $dInfo['did'],
            'uid' => $dInfo['uid'],
            'uname' => $dInfo['uname'],
            'ip' => $dInfo['ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert($tableName, $data);
        return $this->db->insert_id();
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
        return $this->db->select('*')->get_where('design_favorite', array('uid' => $uId), $limit, $offset);
    }

    /**
     * 删除一个用户收藏的设计图
     *
     * @param int $dId
     * @return boolean
     */
    public function deleteUserFavoriteDesignByDid($dId)
    {
        $this->db->where('id', $dId);
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
