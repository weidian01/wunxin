<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-26
 * Time: 下午2:08
 * To change this template use File | Settings | File Templates.
 */
class import extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ini_set('memory_limit','3072M');
        set_time_limit(0);
    }

    function product()
    {
        $this->load->database();
        $this->db->select('i.id as img_id, i.shop as warehouse, d.id as data_id, d.name as pname, d.price as sell_price, d.type as size_type');
        $this->db->from('taobao_product_img i');
        $this->db->join('taobao_product_data d', 'i.link_id = d.id', 'left');
        $r = $this->db->get()->result_array();
        p($r);
    }
}