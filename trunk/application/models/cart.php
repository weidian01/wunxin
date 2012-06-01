<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class cart extends CI_Model
{
    /**
     * @name 将产品加入到购物车中
     *
     * @param $productInfo 产品信息
     * @param $uid 用户ID
     * @return boolean
     */
    public function addProductToCart(array $productInfo, $uid)
    {
        $data = array();
        foreach ($productInfo as $v) {
            $data = array(
                'pid' => $v['pid'],
                'uid' => $uid,
                'pname' => $v['pname'],
                'product_price' => $v['product_price'],
                'product_num' => $v['product_num'],
                'product_img' => $v['product_img'],
                'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
            );
            $this->db->insert('shopping_cart', $data);
            $this->db->insert_id();
        }
    }

    /**
     * @name 修改购物车中某个产品的数量
     *
     * @param $uid 用户ID
     * @param $pid 产品ID
     * @param $number 产品数量
     * @return boolean
     */
    //此功能暂时实现不了
    public function modifyProductNum($uid, $pid, $number)
    {
        $data = array('product_num' => $number);
        return $this->db->where('uid', $uid)->where('pid', $pid)->update('shopping_cart', $data);
    }

    /**
     * @name 删除购物车中某个产品
     *
     * @param $uid 用户ID
     * @param $pid 产品ID
     * @return boolean
     */
    public function deleteCartProduct($uid, $pid)
    {
        return $this->db->delete('shopping_cart', array('uid' => $uid, 'pid' => $pid));
    }

    /**
     * @name 清空用户购物车
     *
     * @param $uid 用户ID
     * @return boolean
     */
    public function clearUserCart($uid)
    {
        return $this->db->delete('shopping_cart', array('uid' => $uid));
    }
}
