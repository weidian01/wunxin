<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class newproduct extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $order = "create_time DESC";

        $offset = max((int)$this->input->get('offset'), 0);
        $this->load->model('product/Model_Product', 'product');

        $productCount = $this->product->getProductCount(NULL);
        $products = array();
        if($productCount)
        {
            $products = $this->product->getProductList($limit = 32, $offset, "pid, did, pname, market_price, sell_price", NULL, $order);
        }
        if($this->input->is_ajax_request() !== true)
        {
            $this->load->view('product/product/newproduct', array(
                'title' => '最新产品',
                'keyword' => '最新产品',
                'clan'=>$this->channel,
                'products' => $products,
                'productCount' => $productCount,
                //'pageHTML' => '',//$pageHTML,
                'salesRank' => $this->salesRank(),
            ));
        }
        else
        {
            self::json_output($products, true);
        }
    }

    /**
     * 销量榜
     * @param $class_id
     * @param null $brand_id
     * @return array
     */
    private function salesRank($class_id = null, $brand_id = null)
    {
        $where = '';
        $this->load->model('product/Model_Product', 'product');
        //同类别
        if($class_id){
            if(is_array($class_id))
            {
                $where = "class_id IN (".implode(',', $class_id).")";;
            }
            else
            {
                $where = "class_id = $class_id";
            }
            $rank[1] = $this->product->getProductList($limit = 10, $offset = 0, $field= "pid, pname, sell_price", $where,'sales DESC');
        }
        //所有分类
        $rank[2] = $this->product->getProductList($limit = 10, $offset = 0, $field= "pid, pname, sell_price", null,'sales DESC');
        //同品牌
        if($brand_id)
        {
            $where .= " AND brand_id = {$brand_id}";
            $rank[3] = $this->product->getProductList($limit = 10, $offset = 0, $field= "pid, pname, sell_price", $where,'sales DESC');
        }
        //var_dump($rank);
        return $rank;
    }
}
