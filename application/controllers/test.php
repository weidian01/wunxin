<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-2
 * Time: 上午11:18
 * To change this template use File | Settings | File Templates.
 */
class test extends MY_Controller
{

    function index()
    {
        $this->load->model('product/Model_Product', 'product');
        $pInfo = $this->product->getProductById(array(1,2,3),'pid, did, class_id, uid, pname, market_price, sell_price');
        //var_dump($pInfo);
        $this->load->model('promotion/model_promotion', 'promotion');

        if($this->promotion->is_promotion_product() === TRUE)
        {
            foreach($pInfo as $p)
            {
                $this->promotion->add_product($p);
            }

            $this->promotion->compute();
            $tmp='';
        }
        else
        {
            die('not promotion!');
        }
        print_r($this->promotion->promotion());
        print_r($this->promotion->result());
    }
}
