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
        $pid = (int)$this->input->get('pid');
        $response = error(20000);//产品分类步存在
        if ($class_id > 0) {
            $limit = max((int)$this->input->get('limit'), 1);
            $offset = max((int)$this->input->get('offset'), 0);

            $where = " class_id = {$class_id} AND pid != {$pid}";
            $this->load->model('product/Model_Product', 'product');
            $response = $this->product->getProductList($limit, $offset, "pid, pname, market_price, sell_price", $where);
        }
        self::json_output($response, true);
    }

    public function browseHistory()
    {
         ;
    }


}