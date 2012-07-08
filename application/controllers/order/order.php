<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-7-6
 * Time: 下午4:19
 * To change this template use File | Settings | File Templates.
 */
class order extends MY_Controller
{
    public function index()
    {
        $referer = $this->input->server('HTTP_REFERER');
        $referer = empty ($referer) ? config_item('base_url') : $referer;

        if (!$this->isLogin()) {
            echo "<script type='text/javascript'>alert('用户未登陆！');window.location.href = '".$referer."'</script>";
            return ;
        }

        $cartInfo = $this->getCartToCookie();

        if (empty ($cartInfo)) {
            echo "<script type='text/javascript'>alert('购物车为空！');window.location.href = '".$referer."'</script>";
            return ;
        }

        $this->load->view('order/order_confirm');
    }
}
