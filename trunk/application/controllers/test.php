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
        $pInfo = $this->product->getProductById(array(1,2,3,4),'pid, did, class_id, uid, pname, market_price, sell_price');

        $this->load->model('promotion/model_promotion', 'promotion');

        if($this->promotion->is_promotion_product() === TRUE)
        {
            foreach($pInfo as $p)
            {
                $p['num'] = 1;
                $this->promotion->add_product($p);
            }
            $this->promotion->use_promotion(array(1,3,4,5));
            $this->promotion->compute();
            $tmp='';
        }
        else
        {
            die('not promotion!');
        }
        echo '<pre>';
        //print_r($this->promotion->get_promotion());

        //print_r($this->promotion->result());
    }
}
