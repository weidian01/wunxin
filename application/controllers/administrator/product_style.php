<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午4:32
 * To change this template use File | Settings | File Templates.
 */
class product_style extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    /**
     * 列出分类列表
     */
    public function create()
    {
        $this->load->view('administrator/bootstrap/product/style/create');
    }

    public function save()
    {
        $pid = trim($this->input->post('pid'), ', ');
        $pid = explode(',', $pid);
        if ($pid) {
            $re = array();
            $this->db->select('pid');
            $this->db->from('product');
            $this->db->where_in('pid', $pid);
            $data = $this->db->get()->result_array();
            foreach ($data as $v) {
                $re[] = $v['pid'];
            }
            if ($re) {
                sort($re);
                $style_no = md5(implode('-', $re));
                $this->db->where_in('pid', $re);
                $this->db->update('product', array('style_no' => $style_no));
            }
        }
        redirect('administrator/product_style/create');
    }
}