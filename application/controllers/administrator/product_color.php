<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午4:32
 * To change this template use File | Settings | File Templates.
 */
class product_color extends MY_Controller
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
    public function index()
    {
        $this->load->model('product/Model_Product_Color', 'color');
        $this->load->library('pagination');
        $num = $this->color->getNum();
        $pagesize = 20;
        $config['base_url'] = site_url('administrator/product_color/index');
        $config['total_rows'] = $num;
        $config['per_page'] = $pagesize;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 4;
        $config['num_links'] = 10;
        $config['anchor_class'] = 'class="number" ';
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4, 1);
        $data = array();
        if ($num) {
            $page = (abs($page) - 1) * $pagesize;
            $data = $this->color->getList($pagesize, $page);
        }
        $this->load->view('administrator/product/color/index', array('list' => $data, 'page' => $this->pagination->create_links()));
    }

    /**
     * 创建一个分类
     */
    public function create()
    {
        $this->load->helper('form');
        $this->load->view('administrator/product/color/create');
    }

    /**
     * 编辑一条分类信息
     */
    public function edit()
    {
        $id = $this->uri->segment(4, 0);
        if (!$id) {
            show_error('号码id为空');
        }
        $this->load->model('product/Model_Product_Color', 'color');
        $info = $this->color->getColorById($id);
        if (!$info) {
            show_error('号码信息不存在');
        }
        $this->load->helper('form');
        $this->load->view('administrator/product/color/create', $info);
    }

    public function save()
    {
        $data['china_name'] = $this->input->post('china_name');
        $data['english_name'] = $this->input->post('english_name');
        $data['code'] = $this->input->post('code');
        $data['descr'] = $this->input->post('descr');
        $color_id = $this->input->post('color_id');

        if (!$data['china_name'] || !$data['english_name'] || !$data['code'] || !$data['descr'])
            show_error('录入信息不全');

        if ($_FILES['image']['size'] > 0) {

            $config['upload_path'] = WEBROOT.'/images/color';
            $config['allowed_types'] = 'gif|jpg|png|jepg';
            $config['max_size'] = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                show_error($this->upload->display_errors());
                //$this->load->view('upload_form', $error);
            } else {
                $tmp = $this->upload->data();
                $data['image'] = $tmp['file_name'];
                //$this->load->view('upload_success', $data);
            }
        }

        $this->load->model('product/Model_Product_Color', 'color');
        $this->color->save($data, $color_id);
        redirect('administrator/product_color/index');
    }

    /**
     * 删除一个分类
     */
    public function del()
    {
        $id = $this->uri->segment(4, 0);
        if (!$id) {
            show_error('尺码id为空');
        }
        $this->load->model('product/Model_Product_Color', 'color');

        if ($this->color->isUse($id)) {
            show_error('有产品正在使用该颜色,不可删除');
        } else {
            $this->color->delete($id);
            redirect('/administrator/product_color/index');
        }

    }
}