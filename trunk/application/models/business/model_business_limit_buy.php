<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-16
 * Time: 下午6:51
 * To change this template use File | Settings | File Templates.
 */
class model_business_limit_buy extends MY_Model
{
    public function getList()
    {
        $data = $this->db
            ->select()
            ->order_by('create_time', 'desc')
            ->get_where('limit_buy')
            ->result_array();

        return $data;
    }

    public function getListAndProduct()
    {
        $this->db->select();
        
    }
}
