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
     * @name 获取产品信息 -- 通过产品ID
     *
     * @param int $pid
     * @return bool
     */
    public function getProductById($pid)
    {
        return $this->db->get_where('wx_product', array('pid' => $pid))->row_array();
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


}