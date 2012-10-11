<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-7-19
 * Time: 上午10:23
 * To change this template use File | Settings | File Templates.
 */
class help extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        /*
        if (!$this->isLogin()) {
            //return ;
        }
        if(! $this->input->is_ajax_request()){
            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }
        //*/
    }

    public function index()
    {
        $id = $this->uri->segment(4, 0);

        $this->load->model('other/Model_Help', 'help');
        $data = $this->help->getHelpById($id);
//echo '<pre>';print_r($data);exit;

        $this->load->view('other/help', array('data' => $data));
    }
}
