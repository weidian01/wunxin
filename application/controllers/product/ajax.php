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

    public function hotComment()
    {
        $this->load->model('product/Model_Product', 'product');

        $response = $this->product->getProductList(10, 0, array('pid'=>"pid, pname, sell_price"), null, 'comment_num DESC');
        if($response)
        {
            $pids = array_keys($response);
            $this->load->model('product/Model_Product_comment', 'comment');
            $tmp = $this->comment->getCommentByPid($pids, 10, 0, 'pid, uid, uname, title, content', "1=1 GROUP BY pid");
            foreach ($tmp as $key => $item) {
                $response[$item['pid']] += $item;
            }
            //print_r($response);
        }
        self::json_output($response, true);
    }
    public function productByUser()
    {
        $uid = $this->input->get_post('uid');
        $this->load->model('product/Model_Product', 'product');
        $response = $this->product->getUserProduct($uid, 6, 0, 'pid, pname, sell_price');
        //$response = array();
        self::json_output($response, true);
    }

}