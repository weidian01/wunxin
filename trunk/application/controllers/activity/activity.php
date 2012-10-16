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
        $data = array(
            'title' => '限时抢购',
        );
        $this->load->view('activity/qiang_gou', $data);
    }
}
