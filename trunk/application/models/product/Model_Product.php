<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Product extends MY_Model
{
    /**
     * @name 产品收藏
     *
     * @param array $fInfo
     * @return bool
     */
    public function productFavorite(array $fInfo)
    {
        $tableName = 'wx_product_favorite';
        $checkStatus = $this->batchCheckTableField($tableName, $fInfo, true);
        if (!$checkStatus) return false;

        $data = array(
            'pid' => $fInfo['pid'],
            'uid' => $fInfo['uid'],
            'favorite_ip' => $fInfo['favorite_ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert($tableName, $data);
        return $this->db->insert_id();
    }

    /**
         * @name 获取产品信息 -- 通过产品ID
         *
         * @param int $pid
         * @return bool
         */
    public function getProductById($pid)
    {
        $this->db->get_where('wx_product', array('pid' => $pid))->row_array();
    }

    /**
     * @name 检测产品是否存在
     *
     * @param int $pid
     * @return bool
     */
    public function productIsExist($pid)
    {
        $pInfo = $this->db->get_where('wx_product', array('pid' => $pid))->row_array();

        return empty ($pInfo) ? false : true;
    }

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

        $this->db->insert('order', $data);
        return $this->db->insert_id();
    }




}