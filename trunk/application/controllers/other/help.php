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

        if (empty ($id)) {
            show_error('参数不全！');
        }

        $this->load->model('other/Model_Help', 'help');
        $data = $this->help->getHelpById($id);
//echo '<pre>';print_r($data);exit;

        $this->load->view('other/help', array('data' => $data));
    }

    public function is_valid()
    {
        $id = intval($this->input->get_post('id'));
        $type = intval($this->input->get_post('type'));

        $response = array('error' => '0', 'msg' => '登陆成功', 'code' => 'login_success');

        do {
            if (empty ($id) ) {
                $response = error(99006);
                break;
            }

            $this->load->model('other/Model_Help', 'help');
            $status = $this->help->isValid($id, $type);

            if (!$status) {
                $response = error(99007);
                break;
            }
        } while (false);

        echo self::json_output($response);
    }
}
