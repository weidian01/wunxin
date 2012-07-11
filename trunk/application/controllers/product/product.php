<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Product extends MY_Controller
{
    /**
     * 产品列表
     */
    public function thread()
    {
        $this->load->model('product/Model_Product_Model', 'mod');
        $this->db->cache_on();
        $this->mod->getModelAttr(1);
        //echo APPPATH;
        //$this->db->cache_off();
        //$this->output->cache(1);
        $this->load->view('product/product/thread');


    }

    /**
     * 产品详情
     */
    public function productInfo()
    {

    }


}