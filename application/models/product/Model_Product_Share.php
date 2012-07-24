<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Product_Share extends MY_Model
{
    /**
     * @name 产品晒单
     *
     * @param array $sInfo
     * @return bool
     */
    public function productShare($sInfo)
    {
        $tableName = 'wx_share';
        $checkStatus = $this->batchCheckTableField($tableName, $sInfo, true);
        if (!$checkStatus) return false;

        $data = array(
            'pid' => $sInfo['pid'],
            'uid' => $sInfo['uid'],
            'title' => $sInfo['title'],
            'content' => $sInfo['content'],
            'ip' => $sInfo['ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('share', $data);
        return $this->db->insert_id();
    }

    /**
     * 保存产品晒单图片
     *
     * @param array $siInfo
     * @return boolean
     */
    public function saveProductShareImage(array $siInfo)
    {
        $data = array(
            'share_id' => $siInfo['share_id'],
            'img_addr' => $siInfo['img_addr'],
            'descr' => $siInfo['descr'],
            'is_cover' => $siInfo['is_cover'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('share_images', $data);
        return $this->db->insert_id();
    }

    /**
     * 获取产品的晒单
     *
     * @param int $pId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getProductShareByPid($pId, $limit = 20, $offset = 0)
    {
        return $this->db->select('*')->get_where('share', array('uid' => $pId), $limit, $offset)->result_array();
    }

    /**
     * 获取用户的晒单
     *
     * @param int $uId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getProductShareByUid($uId, $limit = 20, $offset = 0)
    {
        return $this->db->select('*')->get_where('share', array('uid' => $uId), $limit, $offset)->result_array();
    }

    /**
     * 获取用户的晒单及晒单图片
     *
     * @param int $uId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getProductShareAndImagesByUid($uId, $limit = 20, $offset = 0)
    {
        $data =  $this->db->select('*')->get_where('share', array('uid' => $uId), $limit, $offset)->result_array();

        foreach ($data as $k => $v) {
            $shareId = $v['share_id'];

            $data[$k]['share_images'] = $this->getProductShareImage($shareId);
        }

        return $data;
    }

    /**
     * 获取用户的晒单数量
     *
     * @param $uId
     * @return int
     */
    public function getProductShareCount($uId)
    {
        $this->db->select('*')->from('share')->where('uid', $uId);

        return $this->db->count_all_results();
    }

    /**
     * 获取产品分享图片
     *
     * @param $shareId
     * @return array
     */
    public function getProductShareImage($shareId)
    {
        return $this->db->select('*')->get_where('share_images', array('share_id' => $shareId))->result_array();
    }

    /**
     * @param $imgId
     * @return mixed
     */
    public function likeProductShareImage($imgId)
    {
        $data = array('is_like' => 'is_like+1');
        $this->db->where('id', $imgId);
        return $this->db->set($data, '', false)->update('share_images');
    }

    /**
     * 获取晒单信息
     *
     * @param int $shareId
     */
    public function getShareByShareId($shareId)
    {

    }

    /**
     * @param $sid
     * @param $sInfo
     * @return mixed
     */
    public function shareComment($sid, $sInfo)
    {
        $data = array(
            'share_id' => $sid,
            'uid' => $sInfo['uid'],
            'uname' => $sInfo['uname'],
            'content' => $sInfo['content'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('share_comment', $data);
        return $this->db->insert_id();
    }
}
