<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-16
 * Time: 下午5:19
 * To change this template use File | Settings | File Templates.
 */
class business_limit_buy extends MY_Controller
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
     * 限时抢购列表
     */
    public function lists()
    {
        $this->load->model('business/model_business_limit_buy', 'lb');
        $data = $this->lb->getList();

        $this->load->model('business/model_business_limit_buy_category', 'category');
        $category = $this->category->getCategoryList();

//echo '<pre>';print_r($data);exit;
        $this->load->view('/administrator/business/limit_buy/list', array('data' => $data, 'category' => $category));
    }

    /**
     * 限时抢购创建
     */
    public function create()
    {
        $this->load->model('business/model_business_limit_buy_category', 'category');
        $category = $this->category->getCategoryList();

        $this->load->view('/administrator/business/limit_buy/create', array('type' => 'add', 'category' => $category));
    }

    /**
     * 限时抢购保存
     */
    public function save()
    {
        $data['cid'] = $this->input->get_post('cid');
        $data['pid'] = $this->input->get_post('pid');
        $data['pname'] = $this->input->get_post('pname');

        $data['start_time'] = $this->input->get_post('start_time');
        $data['end_time'] = $this->input->get_post('end_time');
        $data['inventory'] = $this->input->get_post('inventory');
        $data['limit_buy_price'] = $this->input->get_post('limit_buy_price');
        $data['sort'] = $this->input->get_post('sort');
        $data['sales_status'] = $this->input->get_post('sales_status');

        if (//empty ($data['cid']) ||
            empty ($data['pid']) ||
            empty ($data['pname']) ||
            empty ($data['start_time']) ||
            empty ($data['end_time']) ||
            empty ($data['inventory']) ||
            empty ($data['limit_buy_price']) ) {
            show_error('参数不全');
        }

        $this->load->model('product/Model_Product', 'product');
        $productData = $this->product->getProductById($data['pid']);
        if (!$productData) {
            show_error('添加的限时抢购产品不存在');
        }

        $data['sell_price'] = $productData['sell_price'];

        $this->load->model('business/model_business_limit_buy', 'lb');
        $lastId = $this->lb->addLimitBuy($data);
        if (!$lastId) {
            show_error('添加限时抢购失败');
        }

        if ($_FILES['product_image']['error'] == '0') {//echo 'f';
            $this->load->helper('directory');
            $directory = 'upload' . DS . 'activity' . DS . 'limit_buy' . DS . date('Ymd') . DS;
            recursiveMkdirDirectory($directory);

            $config['upload_path'] = WEBROOT . $directory;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['file_name'] = $lastId;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('product_image')) {
                $uData = $this->upload->data();

                $file = $directory . $uData['file_name'];
                $this->lb->updateImage($file, $lastId);
            } else {
                show_error('文件上传失败!');
            }
        }

        redirect('administrator/business_limit_buy/lists');
    }

    /**
     * 限时抢购编辑
     */
    public function edit()
    {
        $id = $this->uri->segment(4, 0);
        if (!$id) {
            show_error('限时抢购id为空');
        }

        $this->load->model('business/model_business_limit_buy_category', 'category');
        $category = $this->category->getCategoryList();

        $this->load->model('business/model_business_limit_buy', 'lb');
        $data = $this->lb->getLimitBuy($id);

        //echo '<pre>';print_r($data);exit;
        $this->load->view('/administrator/business/limit_buy/create', array('type' => 'edit', 'category' => $category, 'info' => $data));
    }

    /**
     * 限时抢购编辑保存
     */
    public function edit_save()
    {
        $id = $this->input->get_post('id');
        $data['cid'] = $this->input->get_post('cid');
        $data['pid'] = $this->input->get_post('pid');
        $data['pname'] = $this->input->get_post('pname');

        $data['start_time'] = $this->input->get_post('start_time');
        $data['end_time'] = $this->input->get_post('end_time');
        $data['inventory'] = $this->input->get_post('inventory');
        $data['limit_buy_price'] = $this->input->get_post('limit_buy_price');
        $data['sort'] = $this->input->get_post('sort');
        $data['sales_status'] = $this->input->get_post('sales_status');

        if (empty ($id) ||
            //empty ($data['cid']) ||
            empty ($data['pid']) ||
            empty ($data['pname']) ||
            empty ($data['start_time']) ||
            empty ($data['end_time']) ||
            empty ($data['inventory']) ||
            empty ($data['limit_buy_price']) ) {
            show_error('参数不全');
        }

        $this->load->model('product/Model_Product', 'product');
        $productData = $this->product->getProductById($data['pid']);
        if (!$productData) {
            show_error('修改的限时抢购不存在');
        }

        $data['sell_price'] = $productData['sell_price'];

        $this->load->model('business/model_business_limit_buy', 'lb');
        $lastId = $this->lb->updateLimitBuy($data, $id);

        if (!$lastId) {
            show_error('修改限时抢购失败');
        }
        $lastId = $id;

        if ($_FILES['product_image']['error'] == '0') {//echo 'f';
            $this->load->helper('directory');
            $directory = 'upload' . DS . 'activity' . DS . 'limit_buy' . DS . date('Ymd') . DS;
            recursiveMkdirDirectory($directory);

            $config['upload_path'] = WEBROOT . $directory;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['file_name'] = $lastId;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('product_image')) {
                $uData = $this->upload->data();

                $file = $directory . $uData['file_name'];
                $this->lb->updateImage($file, $lastId);
            } else {
                //echo '<pre>';print_r($this->upload);exit;
                show_error('文件上传失败!');
            }
        }

        redirect('administrator/business_limit_buy/lists');
    }

    public function del()
    {
        $id = $this->uri->segment(4, 0);
        if (!$id) {
            show_error('限时抢购id为空');
        }
        $this->load->model('business/model_business_limit_buy', 'lb');

        $this->lb->delete($id);
        $this->load->helper('url');
        redirect('/administrator/business_limit_buy/lists');
    }

    /**
     * 限时抢购分类列表
     */
    public function c_list()
    {
        $this->load->model('business/model_business_limit_buy_category', 'category');
        $category = $this->category->getCategoryList();

        $this->load->view('/administrator/business/limit_buy/c_list', array('category' => $category));
    }

    /**
     * 限时抢购分类创建
     */
    public function c_create()
    {
        $this->load->model('business/model_business_limit_buy_category', 'category');
        $category = $this->category->getCategoryList();

        $this->load->view('/administrator/business/limit_buy/c_create', array('type' => 'add', 'category' => $category));
    }

    /**
     * 限时抢购分类保存
     */
    public function c_save()
    {
        $this->load->model('business/model_business_limit_buy_category', 'category');
        $data['name'] = $this->input->post('cname');
        $data['parent_id'] = $this->input->post('parent_id');
        $data['sort'] = $this->input->post('sort');
        $data['title'] = $this->input->post('title');
        $data['keywords'] = $this->input->post('keywords');
        $data['descr'] = $this->input->post('descr');
        $class_id = $this->input->post('class_id');

        if (!$data['name'])
            show_error('分类名称不能为空');

        $this->category->save($data, $class_id);
        $this->load->helper('url');
        redirect('administrator/business_limit_buy/c_list');
    }

    /**
     * 限时抢购分类编辑
     */
    public function c_edit()
    {
        $class_id = $this->uri->segment(4, 0);
        if (!$class_id) {
            show_error('分类id为空');
        }
        $this->load->model('business/model_business_limit_buy_category', 'category');
        $info = $this->category->getCategoryById($class_id);
        if (!$info) {
            show_error('分类信息不存在');
        }
        $category = $this->category->getCategoryList();
        $this->load->model('product/Model_Product_Model', 'mod');
        $model = $this->mod->getModelList(500);

        $data = array('category' => $category, 'class_id' => $class_id, 'info' => $info, 'h1Title' => '编辑设计图分类', 'type' => 'add');
        $this->load->view('/administrator/business/limit_buy/c_create', $data);
    }

    public function c_del()
    {
        $class_id = $this->uri->segment(4, 0);
        if (!$class_id) {
            show_error('分类id为空');
        }
        $this->load->model('business/model_business_limit_buy_category', 'category');

        if ($this->category->isAlone($class_id)) {
            $this->category->delete($class_id);
            $this->load->helper('url');
            redirect('/administrator/business_limit_buy/c_list');
        } else {
            show_error('该分类下存在子类,不可删除');
        }
    }
}