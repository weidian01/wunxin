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
            show_error('产品id为空');
        }

        $this->load->model('product/Model_Product', 'product');
        $info = $this->product->getProductById($id);

        if(! $info)
        {
             show_error('该产品不存在');
        }
        $tmp = $this->product->getProductAttr($id);
        $pattr = array();
        foreach($tmp as $v)
        {
            $pattr[$v['attr_id']][] = $v['attr_value'];
        }
        //print_r($pattr);

        $tmp = $this->product->getProductSize($id);

        $psize = array();
        foreach($tmp as $v)
        {
            $psize[] = $v['size_id'];
        }
        //print_r($psize);

        $photo = $this->product->getProductPhoto($id);
        //print_r($photo);

        $this->load->helper('form');
        $this->load->model('product/Model_Product_Category', 'category');
        $category = $this->category->getCategroyList();
        $this->load->model('product/Model_Product_Model', 'mod');
        $model = $this->mod->getModelList(500);
        $attr = $this->mod->getModel($info['model_id']);

        if (isset($attr['attrs'])) {
            foreach ($attr['attrs'] as $key => $item) {
                $attr['attrs'][$key]['attr_value'] = explode(',', $item['attr_value']);
            }
        } else {
            $attr['attrs'] = array();
        }
        //print_r($attr);

        $this->load->model('product/Model_Product_Size', 'size');
        //print_r($size);
        $this->load->model('product/Model_Product_Color', 'color');
        $color = $this->color->getList(500);
        $this->load->view('administrator/product/create', array(
            'info' => $info,
            'category' => $category,
            'model' => $model,
            'color' => $color,
            'attrs' => $attr['attrs'],
            'pattr' => $pattr,
            'photo' => $photo,
            'size' => $this->size->getSizeByType($info['size_type'], 'size_id,name'),
            'psize' => $psize,
        ));
    }

    public function save()
    {
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
        $data['status'] = $this->input->post('status');
        $data['keyword'] = $this->input->post('keyword');
        $data['descr'] = $this->input->post('descr');
        $data['pcontent'] = $this->input->post('pcontent');
        $data['size_type'] = $this->input->post('size_type');
        $size = $this->input->post('size');
        $data['warehouse'] = $this->input->post('warehouse');
        $data['product_taobao_addr'] = $this->input->post('product_taobao_addr');

        //var_dump($size);
        $pid = $this->input->post('pid');

        if (!$size || !$attr_value || !$data['pname'] || !$data['color_id'] || !$data['model_id'])
            show_error('录入信息不全');

        $this->load->model('product/Model_Product', 'product');
        if ($pid) { //更新产品信息需要的操作
            $this->product->editProduct($pid, $data);
            $delphoto = $this->input->post('delphoto');
            $delphoto && $this->product->delProductPhotoById($delphoto);
            $this->product->delProductAttrById($pid);
            $this->product->delProductSizeById($pid);
        } else {  //添加产品信息需要的操作
            $data['create_time'] = date('Y-m-d H:i:s', TIMESTAMP);
            $pid = $this->product->addProduct($data);
        }
        $size && $this->product->addProductSize($size, $pid);
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

        foreach ($_FILES['images'] as $key => $item) {
            foreach ($item as $k => $v) {
                $_FILES['image' . $k][$key] = $v;
            }
        }
        unset($_FILES['images']);
        if ($_FILES['image0']['size'] > 0) {
            $this->load->helper('directory');
            //$date = date('Y/m/d', TIMESTAMP);
            $path = intToPath($pid);
            $config['upload_path'] = UPLOAD . 'product' . DS . $path;
            recursiveMkdirDirectory($config['upload_path']);
            $config['allowed_types'] = 'gif|jpg|png|jepg';
            $config['max_size'] = '1000';
            //$config['max_width'] = '1024';
            //$config['max_height'] = '768';
            $config['encrypt_name'] = true;
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $product_photo = array();
            foreach ($_FILES as $key => $item) {
                if (!$this->upload->do_upload($key)) {
                    show_error($this->upload->display_errors());
                } else {
                    $tmp = $this->upload->data();
                    $source_file = $config['upload_path'] . $tmp['file_name'];
                    copyImg($source_file, 350, 420, str_replace('.', '_M.', $source_file));
                    copyImg($source_file, 60, 60, str_replace('.', '_S.', $source_file));
                    $product_photo[] = $path . $tmp['file_name'];
                }
            }
        }

        $default_photo = $this->input->post('default_photo');
        $default_photo && $this->product->setProductDefaultPhoto($pid, $default_photo);
        $product_photo && $this->product->addProductPhoto($product_photo, $pid, $default_photo);
        $attr && $this->product->addProductAttr($attr);
        /*生成默认图片*/
        $default_photo = $this->db->get_where('product_photo',array('pid'=>$pid, 'is_default'=>1))->row_array();
        if($default_photo)
        {
            $img_path = UPLOAD . 'product' . DS .$default_photo['img_addr'];
            copyImg($img_path, 164, 220, substr($img_path, 0, strrpos($img_path, '/')) . '/default' . substr($img_path, strpos($img_path, '.')));
            copyImg($img_path, 50, 50, substr($img_path, 0, strrpos($img_path, '/')) . '/icon' . substr($img_path, strpos($img_path, '.')));
        }
        /*生成默认图片*/
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