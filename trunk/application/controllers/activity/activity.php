<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午10:28
 * To change this template use File | Settings | File Templates.
 */
class activity extends MY_Controller
{
    public function qiang()
    {
        $this->load->model('business/model_business_limit_buy_category', 'category');
        $category = $this->category->getCategoryList();

        $this->load->model('business/model_business_limit_buy', 'lb');
        $clbData = $this->lb->getCategoryAndLimitBuyList();

        $beforeLimitBuy = $this->lb->getBeforeLimitBuy();
        //echo '<pre>';print_r($beforeLimitBuy);exit;

        $defaultLimitBuy = $this->lb->getDefaultLimitBuy();

        $data = array(
            'title' => '限时抢购',
            'category' => $category,
            'info' => $clbData,
            'before_lb' => $beforeLimitBuy,
            'default_lb' => $defaultLimitBuy,
        );
        $this->load->view('activity/qiang_gou', $data);
    }
}
