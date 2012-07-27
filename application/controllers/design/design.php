<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午9:50
 * To change this template use File | Settings | File Templates.
 */
class design extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        if(! $this->input->is_ajax_request()){
            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }
    }

    /**
     * 删除设计师
     */
    public function deleteDesign()
    {
        $dId = $this->input->get_post('did');

        $response = array('error' => '0', 'msg' => '删除产品成功', 'code' => 'delete_design_success');

        do {
            if (empty ($dId)) {
                $response = error(40025);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('design/Model_Design', 'design');
            $status = $this->design->deleteDesign($dId, $this->uInfo['uid']);
            if (!$status) {
                $response = error(40026);
                break;
            }
        } while (false);

        $this->json_output($response);
    }
}
