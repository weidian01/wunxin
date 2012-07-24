<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Ajax extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

    }


    public function getProductByClass()
    {
        $class_id = (int)$this->input->get('class_id');
        $products = array();
        if ($class_id > 0) {
            $limit = max((int)$this->input->get('limit'), 1);
            $offset = max((int)$this->input->get('offset'), 0);

            $where = " class_id = {$class_id}";
            $this->load->model('product/Model_Product', 'product');
            $products = $this->product->getProductList($limit, $offset, "pid, pname, market_price, sell_price", $where);
        }
        self::json_output($products, true);
    }

    public function browseHistory()
    {
         ;
    }


}