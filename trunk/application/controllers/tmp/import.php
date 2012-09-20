<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-26
 * Time: 下午2:08
 * To change this template use File | Settings | File Templates.
 */
class inport extends MY_Controller
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
        //$this->db->select('id');
        $this->db->from('taobao_product_img i');
        $this->db->join('taobao_product_data a', 'i.link_id = a.id', 'left');
        $r = $this->db->get()->result_array();
        p($r);
    }
}