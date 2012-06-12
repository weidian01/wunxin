<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-11
 * Time: 下午1:10
 * To change this template use File | Settings | File Templates.
 */
class design extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    public function addDesign()
    {
        $this->load->view('/administrator/design/design_add');
    }

    public function designList()
    {
        $this->load->model('design/Model_Design', 'design');
        $designData = $this->design->getDesignList();

        $this->load->view('/administrator/design/design_list', array('data' => $designData));
    }

    public function editDesign()
    {
        $dId = $this->input->get_post('did');

        $this->load->model('design/Model_Design', 'design');
        $designData = $this->design->getDesignList();

        $this->load->view('/administrator/design/design_edit', array('data' => $designData));
    }
}
