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
        $status = $this->db->insert_id();

        if ($status) {
            //更新产品晒单数量
            $this->db->where('pid', $sInfo['pid'])->set(array('share_num' => 'share_num+1'), '', false)->update('product');

            //更新订单产品评论状态
            $this->db->update('order_product', array('share_status' => 1), array('pid' => $sInfo['pid'], 'uid' => $sInfo['uid']));
        }

        return $status;
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
            'is_cover' => $siInfo['is_cover'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('share_images', $data);
        return $this->db->insert_id();
    }

    /**
     * 更新晒单图片描述信息
     *
     * @param array $data
     * @param $siId
     * @return boolean
     */
    public function updateShareImage(array $data, $siId)
    {
        $info = array(
            'title' => "'".$data['title']."'",
            'descr' => "'".$data['descr']."'",
            'is_cover' => $data['is_cover'],
        );

        return $this->db->where('id', $siId)->set($info, '', false)->update('share_images');
    }

    /**
     * 获取产品的晒单
     *
     * @param int $pId
     * @param int $limit
     * @param int $offset
     * @param string $fields
     * @param string $order
     * @return array
     */
    public function getProductShareByPid($pId, $limit = 20, $offset = 0, $fields = '*', $order = null)
    {
        list($key, $fields) = self::formatField($fields);
        $this->db->select($fields);
        $order && $this->db->order_by($order);
        return $this->db->get_where('share', array('pid' => $pId), $limit, $offset)->result_array($key);
    }

    /**
     * 根据产品id获取晒单数量
     * @param $pid
     * @return mixed
     */
    public function getProductShareCountByPid($pid)
    {
        $this->db->from('share');
        $this->db->where(array('pid' => $pid));
        return $this->db->count_all_results();
    }

    /**
     * 获取用户可以晒单的产品
     *
     * @param $uId
     * @return null | array
     */
    public function getUserShareProductList($uId)
    {
        $this->db->select('*');
        $this->db->from('order_product');
        $this->db->join('order', 'order.order_sn = order_product.order_sn');
        $this->db->where('order_product.uid', $uId);
        $this->db->where('order.is_pay', ORDER_PAY_SUCC);
        $this->db->where('order.picking_status', PICKING_COMPLETED);
        $this->db->where('order_product.share_status', 0);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
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
    public function getProductShareImage($shareId, $field = '*', $where = null, $order = null)
    {
        list($key, $field) = self::formatField($field);
        $this->db->select($field);
        $this->db->from('share_images');
        is_array($shareId) ? $this->db->where_in('share_id',$shareId):$this->db->where('share_id',$shareId);
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        return $this->db->get()->result_array($key);
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
     * 晒单评论
     *
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
