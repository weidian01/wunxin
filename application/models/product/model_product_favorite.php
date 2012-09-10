<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
     * @return boolean
     */
    public function favorite(array $fInfo)
    {
        $sql = "INSERT IGNORE INTO wx_product_favorite(pid, uid, uname, ip, create_time) values ";
        $sql .= "({$fInfo['pid']}, {$fInfo['uid']}, '".$fInfo['uname']."', '".$fInfo['ip']."', '".date('Y-m-d H:i:s', TIMESTAMP)."')";

        $this->db->query($sql);
        $lastId = $this->db->insert_id();

        //更新产品收藏数量
        if ($lastId) {

            $this->db->where('pid', $fInfo['pid']);
            $this->db->set('favorite_num', 'favorite_num+1', false);
            $this->db->update('product');

            return $lastId;
        }

        return false;
    }

    /**
     * 获取用户产品收藏
     *
     * @param $uId
     * @param $pId
     * @return null | array
     */
    public function getUserFavorite($uId, $pId)
    {
        $data = $this->db->select('*')->get_where('product_favorite', array('uid' => $uId, 'pid' => $pId))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户产品收藏
     *
     * @param int $uId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getUserProductFavorite($uId, $limit = 20, $offset = 0)
    {
        return $this->db->select('*')->get_where('product_favorite', array('uid' => $uId), $limit, $offset)->result_array();
    }

    /**
     * 获取用户产品收藏数量
     *
     * @param $uId
     * @return int
     */
    public function getUserProductFavoriteCount($uId)
    {
        $this->db->select('*')->from('product_favorite')->where('uid', $uId);

        return $this->db->count_all_results();
    }

    /**
     * 获取用户产品收藏 同时读取产品信息
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserFavoriteAndProduct($uId, $limit = 20, $offset = 0)
    {
        $field = 'product.pid, did, class_id, color_id, model_id, brand_id, pname, market_price, sell_price, style_no, stock, warehouse, product_taobao_addr,
        keyword, descr, pcontent, source, expand, gender, size_type, status, check_status, shelves, cost_price, sales, favorite_num,
        id, product_favorite.uid, product_favorite.uname, ip, product_favorite.create_time';

        $this->db->select($field);
        $this->db->from('product_favorite');
        $this->db->join('product', 'product_favorite.pid = product.pid');
        $this->db->where('product_favorite.uid', $uId);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户产品收藏 同时读取产品信息数量
     *
     * @param $uId
     * @return int
     */
    public function getUserFavoriteAndProductCount($uId)
    {
        $field = 'product.pid, did, class_id, color_id, model_id, brand_id, pname, market_price, sell_price, style_no, stock, warehouse, product_taobao_addr,
        keyword, descr, pcontent, source, expand, gender, size_type, status, check_status, shelves, cost_price, sales, favorite_num,
        id, product_favorite.uid, product_favorite.uname, ip, product_favorite.create_time';

        $this->db->select($field);
        $this->db->from('product_favorite');
        $this->db->join('product', 'product_favorite.pid = product.pid');
        $this->db->where('product_favorite.uid', $uId);
        return $this->db->count_all_results();
    }

    /**
     * 获取产品收藏推荐
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getFavoriteProductRecommend($limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->from('product')->order_by('favorite_num', 'desc')->limit($limit, $offset)->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 删除一个产品收藏
     *
     * @param int $fId
     * @return boolean
     */
    public function deleteUserProductFavorite($fId)
    {
        $this->db->where('id', $fId);
        return $this->db->delete('product_favorite');
    }

    /**
     * 清空用户产品收藏
     *
     * @param int $uId
     * @return boolean
     */
    public function emptyUserProductFavorite($uId)
    {
        $this->db->where('uid', $uId);
        return $this->db->delete('product_favorite');
    }
}
