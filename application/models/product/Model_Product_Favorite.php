<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Product_Favorite extends MY_Model
{
    /**
     * @name 产品收藏
     *
     * @param array $fInfo
     * @return bool
     */
    public function productFavorite(array $fInfo)
    {
        $tableName = 'product_favorite';
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

    public function getUserProductFavorite($uId, $limit = 20, $offset = 0)
    {
        $this->db->select('*')->get_where('product_favorite', array('uid' => $uId), $limit, $offset);
    }
}
