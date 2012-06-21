<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午4:32
 * To change this template use File | Settings | File Templates.
 */
class product extends MY_Controller
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
        $this->load->model('product/Model_Product', 'product');
        $this->load->library('pagination');
        $num = $this->product->getProductCout();
        $pagesize = 20;
        $config['base_url'] = site_url('administrator/product/index');
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
            $data = $this->product->getProductList($pagesize, $page);
        }
        //print_r($data);
        $this->load->view('administrator/product/index', array('list' => $data, 'page' => $this->pagination->create_links()));
    }

    /**
     * 创建一个产品
     */
    public function create()
    {
        $this->load->helper('form');
        $this->load->model('product/Model_Product_Category', 'category');
        $category = $this->category->getCategroyList();
        $this->load->model('product/Model_Product_Model', 'mod');
        $model = $this->mod->getModelList(500);
        $this->load->model('product/Model_Product_Color', 'color');
        $color = $this->color->getList(500);
        $this->load->view('administrator/product/create', array('category' => $category, 'model' => $model, 'color'=>$color));
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
        $this->load->view('administrator/product/create', $info);
    }

    public function save()
    {

        $i = 0;
        foreach ($_FILES['images'] as $key => $item) {
            foreach ($item as $k => $v) {
                $_FILES['image' . $k][$key] = $v;
            }
        }
        unset($_FILES['images']);
        if ($_FILES['image0']['size'] > 0) {
            $this->load->helper('directory');
            $date = date('Y/m/d', TIMESTAMP);
            $config['upload_path'] = UPLOAD . 'product' . DS . $date;
            recursiveMkdirDirectory($config['upload_path']);
            $config['allowed_types'] = 'gif|jpg|png|jepg';
            $config['max_size'] = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $config['encrypt_name'] = true;
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $product_photo = array();
            foreach ($_FILES as $key => $item) {
                if (!$this->upload->do_upload($key)) {
                    show_error($this->upload->display_errors());
                } else {
                    $tmp = $this->upload->data();
                    $product_photo[] = $date. '/' .$tmp['file_name'];
                }
            }

        }
        //echo '<pre>';print_r($this->input->post());die;
        $data['pname'] = $this->input->post('pname');
        $data['class_id'] = $this->input->post('class_id');
        $data['color_id'] = $this->input->post('color_id');
        $data['did'] = $this->input->post('did');
        $data['model_id'] = $this->input->post('model_id');
        $attr_value = $this->input->post('attr_value');
        $data['market_price'] = $this->input->post('market_price');
        $data['sell_price'] = $this->input->post('sell_price');
        $data['cost_price'] = $this->input->post('cost_price');
        $data['stock'] = $this->input->post('stock');
        $data['descr'] = $this->input->post('descr');
        $size = $this->input->post('size');
        //print_r($data);
        $pid = $this->input->post('pid');

        if (!$size || !$attr_value || !$data['pname'] || !$data['color_id'] || !$data['model_id'])
            show_error('录入信息不全');



        $this->load->model('product/Model_Product', 'product');
        if ($pid) {
            show_error('更新');
        } else {
            $pid = $this->product->addProduct($data);
            $size && $this->product->addProductSize($size, $pid);
            $product_photo && $this->product->addProductPhoto($product_photo, $pid);
            $attr = array();
            $i = 0;
            foreach ($attr_value as $attr_id => $item) {
                foreach ($item as $v) {
                    if ($v) {
                        $attr[$i]['pid'] = $pid;
                        $attr[$i]['attr_id'] = $attr_id;
                        $attr[$i]['model_id'] = $data['model_id'];
                        $attr[$i]['attr_value'] = $v;
                        $i++;
                    }
                }
            }
        }
        $attr && $this->product->addProductAttr($attr);
        redirect('administrator/product/index');
    }

    /**
     * 删除一个分类
     */
    public function del()
    {
        $id = $this->uri->segment(4, 0);
        if (!$id) {
            show_error('产品id为空');
        }
        $this->load->model('product/Model_Product', 'product');

        $this->product->deleteProduct($id);
        redirect('/administrator/product/index');
    }
}