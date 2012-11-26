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

        foreach ($pInfo as $k => $p)
        {
            $pInfo[$k]['num'] = 1;

        }
        $this->promotion->add_product($pInfo);
        $act = array(1,5,11);
        if($act)
        {

            //array(1,3,4,5)
            $this->promotion->use_promotion($act);//使用活动 1
            $this->promotion->compute();
        }

        $used_promotin = $this->promotion->get_used_promotion(); //获取试用成功的活动
        $unused_promotin = $this->promotion->get_unused_promotion(); //获取可选未使用的活动列表
        p($used_promotin);
        p($unused_promotin);
        p($this->promotion->result()); //获取使用过活动产品列表  包括参与过活动的最终价格
        p($this->promotion);
        //print_r($this->promotion->get_promotion());

        //print_r($this->promotion->result());
    }
}
