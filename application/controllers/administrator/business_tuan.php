<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-27
 * Time: 上午10:41
 * To change this template use File | Settings | File Templates.
 */
class business_tuan extends MY_Controller
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
     * 团购列表
     */
    public function tuanList()
    {
        $Limit = 20;
        $currentPage = $this->uri->segment(4, 1);
        $offset = ($currentPage - 1) * $Limit;

        $this->load->model('/business/Model_Business_Tuan', 'tuan');
        $totalNum = $this->tuan->getTuanCount();
        $data = $this->tuan->getTuanList($Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/business_tuan/tuanList/';
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $this->load->view('/administrator/business/tuan/list', array('data' => $data, 'page_html' => $pageHtml, 'current_page' => $currentPage));
    }

    /**
     * 查看团购详情
     */
    public function tuanView()
    {
        $tuanId = $this->uri->segment(4, 1);
        if (!$tuanId) {
            show_error('团购ID为空');
        }

        $this->load->model('business/Model_Business_Tuan', 'tuan');
        $this->load->model('business/Model_Business_Tuan_Comment', 'comment');
        $tuanData = $this->tuan->getTuanBytId($tuanId);

        $Limit = 20;
        $currentPage = $this->uri->segment(5, 1);
        $offset = ($currentPage - 1) * $Limit;

        $totalNum = $this->comment->getTuanCommentCount($tuanId);
        $commentData = $this->comment->getTuanCommentBytId($tuanId, $Limit, $offset);

        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/administrator/business_tuan/tuanView/'.$tuanId;
        $config['total_rows'] = $totalNum;
        $config['per_page'] = $Limit;
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['anchor_class'] = 'class="number"';
        $this->pagination->initialize($config);
        $pageHtml = $this->pagination->create_links();

        $data = array(
            'tuan_data' => $tuanData,
            'comment_data' => $commentData,
            'comment_page_html' => $pageHtml,
            'current_page' => $currentPage
        );

        $this->load->view('/administrator/business/tuan/detail', $data);
    }

    /**
     * 添加团购
     */
    public function tuanAdd()
    {
        $this->load->view('/administrator/business/tuan/create', array('type' => 'add'));
    }

    /**
     * 团购保存
     */
    public function tuanSave()
    {
        $data['pid'] = $this->input->get_post('pid');
        $data['pname'] = $this->input->get_post('pname');

        $data['start_time'] = $this->input->get_post('start_time');
        $data['end_time'] = $this->input->get_post('end_time');
        $data['inventory'] = $this->input->get_post('inventory');
        $data['discount_rate'] = $this->input->get_post('discount_rate');
        $data['descr'] = $this->input->get_post('descr');
        $data['detail'] = $this->input->get_post('detail');

        if (empty ($data['pid']) ||
            empty ($data['pname']) ||
            empty ($data['start_time']) ||
            empty ($data['end_time']) ||
            empty ($data['inventory']) ||
            empty ($data['discount_rate']) ||
            empty ($data['descr']) ||
            empty ($data['detail'])) {
            show_error('参数不全');
        }

        $this->load->model('product/Model_Product', 'product');
        $productData = $this->product->getProductById($data['pid']);
        if (!$productData) {
            show_error('添加的团购产品不存在');
        }

        $data['sell_price'] = $productData['sell_price'];
        $data['status'] = 1;
        $data['tuan_num'] = '';
        $data['product_images'] = '';
        $data['save'] = (intval($productData['sell_price']) * (100 - $data['discount_rate'])) / 100;
        $data['tuan_price'] = intval($productData['sell_price']  / 100) * $data['discount_rate'];

        $this->load->model('business/Model_Business_Tuan', 'tuan');
        $lastId = $this->tuan->addTuan($data);
        if (!$lastId) {
            show_error('添加团购失败');
        }

        if ($_FILES['img_addr']['error'] == '0') {echo 'f';
            $this->load->helper('directory');
            $directory = 'upload' . DS . 'activity' . DS . 'tuan' . DS . date('Ymd') . DS;
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

            if ($this->upload->do_upload('img_addr')) {
                $uData = $this->upload->data();

                $file = $directory . $uData['file_name'];
                $this->tuan->updateTuanProductImage($file, $lastId);
            } else {
                show_error('文件上传失败!');
            }
        }

        redirect('administrator/business_tuan/tuanList');
    }

    /**
     * 团购编辑
     */
    public function tuanEdit()
    {
        $tuanId = $this->uri->segment(4, 0);
        if (!$tuanId) {
            show_error('团购ID为空');
        }

        $this->load->model('business/Model_Business_Tuan', 'tuan');
        $data = $this->tuan->getTuanBytId($tuanId);

        $this->load->view('/administrator/business/tuan/create', array('type' => 'edit', 'info' => $data));
    }


    /**
     * 团购修改保存
     */
    public function tuanEditSave()
    {
        $data['pid'] = $this->input->get_post('pid');
        $data['pname'] = $this->input->get_post('pname');
        $data['start_time'] = $this->input->get_post('start_time');
        $data['end_time'] = $this->input->get_post('end_time');
        $data['inventory'] = $this->input->get_post('inventory');
        $data['discount_rate'] = $this->input->get_post('discount_rate');
        $data['descr'] = $this->input->get_post('descr');
        $data['detail'] = $this->input->get_post('detail');
        $tuanId = $this->input->get_post('tuan_id');

        if (empty ($tuanId) ||
            empty ($data['pid']) ||
            empty ($data['pname']) ||
            empty ($data['start_time']) ||
            empty ($data['end_time']) ||
            empty ($data['inventory']) ||
            empty ($data['discount_rate']) ||
            empty ($data['descr']) ||
            empty ($data['detail'])) {
            show_error('参数不全');
        }

        $this->load->model('product/Model_Product', 'product');
        $productData = $this->product->getProductById($data['pid']);
        if (!$productData) {
            show_error('修改的团购产品不存在');
        }

        $data['sell_price'] = $productData['sell_price'];
        $data['status'] = 1;
        $data['tuan_num'] = '';
        //$data['img_addr'] = '';
        $data['save'] = (intval($productData['sell_price']) * (100 - $data['discount_rate'])) / 100;
        $data['tuan_price'] = intval($productData['sell_price']  / 100) * $data['discount_rate'];

        $this->load->model('business/Model_Business_Tuan', 'tuan');
        $lastId = $this->tuan->editTuan($data, $tuanId);
        if (!$lastId) {
            show_error('修改团购失败');
        }

        if ($_FILES['img_addr']['error'] == '0') {echo 'f';
            $this->load->helper('directory');
            $directory = 'upload' . DS . 'activity' . DS . 'tuan' . DS . date('Ymd') . DS;
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

            if ($this->upload->do_upload('img_addr')) {
                $uData = $this->upload->data();

                $file = $directory . $uData['file_name'];
                $this->tuan->updateTuanProductImage($file, $lastId);
            } else {
                show_error('文件上传失败!');
            }
        }

        redirect('administrator/business_tuan/tuanList');
    }

    /**
     * 删除团购评论
     */
    public function deleteTuanComment()
    {
        $commentId = $this->uri->segment(4, 0);
        $tuanId = $this->uri->segment(5, 0);

        if (!$commentId || !$tuanId) {
            show_error('参数不全');
        }

        $this->load->model('business/Model_Business_Tuan_Comment', 'comment');
        $status = $this->comment->deleteCommentBycId($commentId);
        if (!$status) {
            show_error('删除评论信息失败');
        }

        redirect('administrator/business_tuan/tuanView/'.$tuanId);
    }
}
