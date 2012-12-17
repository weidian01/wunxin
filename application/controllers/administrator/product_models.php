<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午4:32
 * To change this template use File | Settings | File Templates.
 */
class product_models extends MY_Controller
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
     * 模型列表页面
     */
    public function index()
    {
        $this->load->model('product/Model_Product_Model', 'mod');
        $this->load->library('pagination');
        $num = $this->mod->getModelNum();
        $pagesize = 20;
        $config['base_url'] = site_url('administrator/product_model/index');
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
            $data = $this->mod->getModelList($pagesize, $page);
        }

        $this->load->view('administrator/product/models/index', array('models' => $data, 'page' => $this->pagination->create_links()));
    }


    public function edit()
    {
        $model_id = $this->uri->segment(4, 0);
        if (!$model_id) {
            show_error('模型id为空');
        }
        $this->load->model('product/Model_Product_Model', 'mod');
        $data = $this->mod->getModel($model_id);
        //echo '<pre>';print_r($data);
        $this->load->view('administrator/product/models/create', $data);
    }

    /**
     * 创建一个新模型页面
     */
    public function create()
    {
        $this->load->view('administrator/product/models/create');
    }

    /**
     * 创建一个新模型及其属性
     */
    public function save()
    {
        $model_name = $this->input->post('model_name', true);
        if (!$model_name) {
            show_error('模型名为空'); //error();
        }

        $model_id = $this->input->post('model_id');
        $attr_id = $this->input->post('attr_id');
        $attr_name = (array)$this->input->post('attr_name');
        $attr_type = $this->input->post('type');
        $attr_value = $this->input->post('attr_value');
        $attr_sort = $this->input->post('sort');
        $attr_search = $this->input->post('search');
        $attr_display = $this->input->post('display');

        //echo '<pre>';print_r($this->input->post());
        $attrs = array();

        foreach ($attr_name as $key => $item) {
            if (!$attr_name[$key] || !$attr_value[$key] || !$attr_type[$key])
                continue;
            if ($attr_id)
                $attrs[$key]['attr_id'] = $attr_id[$key];
            $attrs[$key]['attr_name'] = $attr_name[$key];
            $attrs[$key]['type'] = (int)$attr_type[$key];
            $attrs[$key]['attr_value'] = $attr_value[$key];
            $attrs[$key]['sort'] = (int)$attr_sort[$key];
            $attrs[$key]['search'] = $attr_search[$key] ? 1:0;
            $attrs[$key]['display'] = $attr_display[$key] ? 1:0;

        }

        if (! $attrs) {
            show_error('模型属性为空'); // error();
        }

        $this->load->model('product/Model_Product_Model', 'mod');
        if ($model_id && $attr_id) {
            $this->mod->update($model_id, $model_name, $attrs);
        } else {
            $this->mod->create($model_name, $attrs);
        }
        redirect('administrator/product_models/index');
    }

    /**
     *
     * @param $model_id
     */
    function del()
    {
        $model_id = $this->uri->segment(4, 0);

        if ($model_id) {
            $this->load->model('product/Model_Product_Model', 'mod');
            if ($this->mod->isUse($model_id)) {
                show_error('有产品正在使用该模型,无法删除'); // error();
            } else {
                $this->mod->delete($model_id);
            }
        }
        redirect('/administrator/product_model/index');
    }

    public function get_model_attr()
    {
        $model_id = $this->input->get_post('model_id');
        $this->load->model('product/Model_Product_Models', 'mod');
        $data = $this->mod->get_model_detail($model_id);
        //p($data);
        self::json_output($data);
    }


    /*************************属性管理开始*************************/
    public function attrs_index()
    {
        $this->load->model('product/Model_Product_Models', 'mod');
        $attrs = $this->mod->get_all_attr();
        $this->load->view('administrator/bootstrap/product/models/attrs_index', array('attrs' => $attrs));

    }

    public function attrs_edit()
    {
        $attr_id = $this->uri->segment(4, 0);
        $this->load->model('product/Model_Product_Models', 'mod');
        $attr = $this->mod->get_attr_by_id($attr_id);
        if(! $attr)
        {
            show_404("属性不存在");
        }
        //p($attr);
        $this->load->view('administrator/bootstrap/product/models/attrs_create', $attr);
    }

    public function attrs_create()
    {
        $this->load->view('administrator/bootstrap/product/models/attrs_create');
    }

    public function attrs_save()
    {
        $input['attr_id'] = $this->input->post('attr_id');
        $input['attr_name'] = $this->input->post('attr_name');

        if(! $input['attr_name'])
        {
            die("属性名称不可为空");
        }

        $this->load->model('product/Model_Product_Models', 'mod');

        $this->mod->save_attr($input);
        redirect('/administrator/product_models/attrs_index');
    }

    public function attrs_del()
    {
        die('功能开发中');
        //redirect('/administrator/product_model/index');
    }
    /*************************属性管理结束*************************/

    /*************************属性值管理开始*************************/
    public function value_index()
    {
        $attr_id = $this->input->get('attr_id');
        $this->load->model('product/Model_Product_Models', 'mod');
        $attrs = $this->mod->get_all_attr(array('attr_id'=>'*'));
        $values = $this->mod->get_values_by_attr_id($attr_id);
        $this->load->view('administrator/bootstrap/product/models/value_index', array('attrs' => $attrs, 'values'=>$values));

    }

    public function value_edit()
    {
        $value_id = $this->uri->segment(4, 0);
        $this->load->model('product/Model_Product_Models', 'mod');
        $value = $this->mod->get_value_by_id($value_id);
        if(! $value)
        {
            die("属性不存在");
        }
        $attrs = $this->mod->get_all_attr(array('attr_id'=>'*'));
        //p($value);p($attrs);
        $this->load->view('administrator/bootstrap/product/models/value_create', array('attrs'=>$attrs, 'value'=>$value));
    }

    public function value_create()
    {
        $this->load->model('product/Model_Product_Models', 'mod');
        $attrs = $this->mod->get_all_attr(array('attr_id'=>'*'));
        $this->load->view('administrator/bootstrap/product/models/value_create', array('attrs'=>$attrs));
    }

    public function value_save()
    {
        $input['attr_id'] = $this->input->post('attr_id');
        $input['value_id'] = $this->input->post('value_id');
        $input['value_name'] = $this->input->post('value_name');

        if(! $input['attr_id'])
        {
           die("属性id不可为空");
        }

        if(! $input['value_name'])
        {
           die("属性值名称不可为空");
        }

        $this->load->model('product/Model_Product_Models', 'mod');

        $last_id = $this->mod->save_value($input);
        $last_id = $input['attr_id'] ? $input['attr_id'] : $last_id;
        redirect("/administrator/product_models/value_index/?attr_id={$last_id}");
    }

    public function value_del()
    {
        die('功能开发中');
        //redirect('/administrator/product_model/index');
    }
    /*************************属性值管理结束*************************/


    /**
     * 模型列表页面
     */
    public function model_index()
    {
        $this->load->model('product/Model_Product_Models', 'mod');
        $this->load->library('pagination');
        $num = $this->mod->getModelNum();
        $pagesize = 20;
        $config['base_url'] = site_url('administrator/product_model/index');
        $config['total_rows'] = $num;
        $config['per_page'] = $pagesize;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 4;
        $config['num_links'] = 10;
        //$config['anchor_class'] = 'class="number" ';

        //所有页码外围
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        //当前页码
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        //其他页码
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        //上一页
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        //下一页
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        //首页
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        //尾页
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = $this->uri->segment(4, 1);
        $data = array();
        if ($num) {
            $page = (abs($page) - 1) * $pagesize;
            $data = $this->mod->getModelList($pagesize, $page);
        }

        $this->load->view('administrator/bootstrap/product/models/model_index', array('models' => $data, 'page' => $this->pagination->create_links()));
    }

    public function model_create()
    {
        $this->load->model('product/Model_Product_Models', 'mod');
        $attrs = $this->mod->get_all_attr();
        //p($attrs);
        $this->load->view('administrator/bootstrap/product/models/model_create', array('attrs'=>$attrs, 'attr_conf'=>array()));
    }

    public function model_edit()
    {
        $model_id = $this->uri->segment(4, 0);
        $this->load->model('product/Model_Product_Models', 'mod');
        $model = $this->mod->get_model_by_id($model_id);
        $attr_conf = $this->mod->get_model_attrs($model_id);
        $attrs = $this->mod->get_all_attr(array('attr_id'=>'*'));
        //p($attrs);p($attr_conf);
        $this->load->view('administrator/bootstrap/product/models/model_create',  array('attr_conf'=>$attr_conf, 'attrs'=>$attrs, 'model'=>$model));
    }

    public function model_save()
    {
        $input['model_id'] = $this->input->post('model_id');
        $input['model_name'] = $this->input->post('model_name');
        $post['id'] = (array)$this->input->post('id');
        $post['attr_id'] = (array)$this->input->post('attr_id');
        $post['type'] = (array)$this->input->post('type');
        $post['sort'] = (array)$this->input->post('sort');
        $post['search'] = (array)$this->input->post('search');
        $post['display'] = (array)$this->input->post('display');

        if(! $input['model_name'])
        {
           die("模型名称不可为空");
        }

        $this->load->model('product/Model_Product_Models', 'mod');
        $attrs = $this->mod->get_all_attr(array('attr_id'=>'*'));

        $attr_conf = array();
        foreach ($post['attr_id'] as $key => $attr_id)
        {
            if($post['attr_id'][$key] && isset($attrs[$attr_id]))
            {
                //isset($post['id'][$key]) && $post['id'][$key] && $attr_conf[$attr_id]['id'] = $post['id'][$key];
                $attr_conf[$attr_id]['attr_id'] = $post['attr_id'][$key];
                $attr_conf[$attr_id]['attr_name'] = $attrs[$attr_id]['attr_name'];
                $attr_conf[$attr_id]['type'] = (int)$post['type'][$key];
                $attr_conf[$attr_id]['sort'] = (int)$post['sort'][$key];
                $attr_conf[$attr_id]['search'] = $post['search'][$key] ? 1 : 0;
                $attr_conf[$attr_id]['display'] = $post['display'][$key] ? 1 : 0;
            }
        }
        //p($attr_conf);die;
        $this->mod->save_model($input, $attr_conf);
        redirect("/administrator/product_models/model_index");
    }

    public function model_del()
    {
        die('功能开发中');
    }

    public function model_attr_value_edit()
    {
        $model_id = $this->uri->segment(4, 0);
        $attr_id = $this->uri->segment(5, 0);
        if(!$model_id)
        {
            die('模型id为空');
        }

        if(!$attr_id)
        {
            die('属性id为空');
        }



        $this->load->model('product/Model_Product_Models', 'mod');
        $attrData = $this->mod->get_attr_by_id($attr_id);
        $modelData = $this->mod->getModel($model_id);

        $attrs = $this->mod->get_values_by_attr_id($attr_id, array('value_id'=>"*"));
        $values = $this->mod->get_model_value($model_id, $attr_id);

        $data = array(
            'model_id'=>$model_id,
            'attr_id'=>$attr_id,
            'attrs'=>$attrs,
            'values'=>$values,
            'attr_data' => $attrData,
            'model_data' => $modelData,
        );
        $this->load->view('administrator/bootstrap/product/models/model_attr_value_edit',  $data);
    }

    public function model_attr_value_save()
    {
        $model_id = $this->input->post('model_id');
        $attr_id = $this->input->post('attr_id');
        $value_id = $this->input->post('value_id');

        if(!$model_id)
        {
            die('模型id为空');
        }

        if(!$attr_id)
        {
            die('属性id为空');
        }

        $this->load->model('product/Model_Product_Models', 'mod');
        $attrs = $this->mod->get_values_by_attr_id($attr_id, array('value_id'=>"*"));

        $insert = array();
        if($value_id)
        {
            foreach($value_id as $key=>$id)
            {
                if(isset($attrs[$id]))
                {
                    $insert[$key] = $attrs[$id];
                    $insert[$key]['model_id'] = $model_id;
                }
            }
            if($insert)
            {
                $this->db->where(array('model_id'=> $model_id,'attr_id'=>$attr_id));
                $this->db->delete('product_models_value');
                $this->db->insert_batch('product_models_value', $insert);
            }
        }
        redirect("/administrator/product_models/model_attr_value_edit/{$model_id}/{$attr_id}");
    }
}
