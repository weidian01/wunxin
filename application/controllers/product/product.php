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
    public function productList()
    {
        $this->load->view('product/product_list');
    }

    /**
     * 产品详情
     */
    public function productInfo()
    {

    }


}