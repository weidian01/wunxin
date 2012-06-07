<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Cart extends MY_Model
{
    /**
     * 获取用户购物车中所有产品
     *
     * @param $uid
     * @return null || array
     */
    public function getUserCartProductByUid($uid)
    {
        $data = $this->db->select('*')->get_where('shopping_cart', array('uid' => $uid, 'status' => 1))->row_array();

        return empty ($data) ? null : $data;
    }

    public function addProductToCart($uid, array $pInfo)
    {
        $data = array(
            'uid' => $uid,
            'pid' => $pInfo['pid'],
            'pname' => $pInfo['pname'],
            'product_price' => $pInfo['product_price'],
            'product_num' => $pInfo['product_num'],
            'product_img' => $pInfo['product_img'],
            'product_size' => $pInfo['product_size'],
            'additional_info' => $pInfo['additional_info'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );
        $this->db->insert('shopping_cart', $data);
        return $this->db->insert_id();
    }

    /**
     * @name 批量将产品加入到购物车中
     *
     * @param $uid 用户ID
     * @param $pInfo 产品信息
     * @return boolean
     */
    public function batchAddProductToCart($uid, array $pInfo)
    {
        $data = array();
        foreach ($pInfo as $v) {
            $data = array(
                'uid' => $uid,
                'pid' => $v['pid'],
                'pname' => $v['pname'],
                'product_price' => $v['product_price'],
                'product_num' => $v['product_num'],
                'product_img' => $v['product_img'],
                'product_size' => $v['product_size'],
                'additional_info' => $v['additional_info'],
                'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
            );

            $this->db->insert('shopping_cart', $data);
            $this->db->insert_id();
        }
        return true;
    }

    /**
     * @name 修改购物车中某个产品的数量
     *
     * @param $uid 用户ID
     * @param $cid 购物车ID
     * @param $number 产品数量
     * @return boolean
     */
    public function modifyProductNum($uid, $cid, $number)
    {
        $number = intval($number);
        $data = array('product_num' => $number);

        return $this->db->where('cart_id', $cid)->where('uid', $uid)->update('shopping_cart', $data);
    }

    /**
     * @name 删除/重新添加某个产品到购物车中
     *
     * @param $uid 用户ID
     * @param $cid 购物车ID
     * @param $status 状态，0删除，1重新添加
     * @return boolean
     */
    public function deleteAndReAddCartProduct($uid, $cid, $status = 0)
    {
        $this->db->where('cart_id', $cid);
        $this->db->where('uid', $uid);
        return $this->db->update('shopping_cart', array('status' => $status));
    }

    /**
     * @name 清空用户购物车
     *
     * @param $uid 用户ID
     * @return boolean
     */
    public function emptyUserCart($uid)
    {
        return $this->db->delete('shopping_cart', array('uid' => $uid));
    }
}
