<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Product extends MY_Controller
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
     * 解析属性参数
     * @static
     * @param $query
     * @return array
     */
    static private function parse_param($query)
    {
        $param = array();
        if ($query) {
            $tmp = explode('!', trim($query, '!.html'));
            foreach ($tmp as $item) {
                if (strpos($item, '-') === false) continue;
                list($key, $value) = explode('-', $item);
                $param[$key] = urldecode($value);
            }
            $param && ksort($param); //参数排序
        }
        return $param;
    }

    /**
     * 产品列表
     */
    public function category()
    {
        $category = (int)$this->uri->rsegment(3, 1);
        $pageno = (int)$this->uri->rsegment(4, 1);
        $pageno === 0 && $pageno = 1;
        $query = $this->uri->rsegment(5, '');
        $param = self::parse_param($query);
        $this->load->database();
        //$this->db->cache_on();
        //$this->db->cache_off();
        //获取分类信息
        $this->load->model('product/Model_Product_Category', 'cate');
        $cate_info = isset($this->channel[$category]) ? $this->channel[$category]:null;

        if ($cate_info) {
            $classes = array_keys($this->cate->getChildren($category));
            $classes = implode(',', $classes);

            $this->load->model('product/Model_Product_Model', 'mod');
            $modelAttr = $this->mod->getModelAttr($cate_info['model_id'], 1); //echo APPPATH;
            foreach ($modelAttr as $k => $v) {
                $modelAttr[$k]['attr_value'] = explode(',', $v['attr_value']);
            }
            $pids = $this->mod->getPidByAttr($param);

            $where = "class_id in ({$classes}) AND status=1 ";
            $where .= ($param && $pids) ? 'AND pid IN (' . implode(',', $pids) . ')' : '';
            if($param && !$pids) //参数有,产品id无 即使通过参数没有搜索到任何产品
            {
                $num = 0;
            }
            else
            {
                $this->load->model('product/Model_Product', 'product');
                $num = $this->product->getProductCout($where);
            }
            $products = array();
            $pageHTML = '';
            $pageNUM = 1;
            if ($num) {
                $pagesize = 32;
                $pageNUM = ceil($num / $pagesize);
                $config['base_url'] = "/category/{$category}";
                $param && $config['suffix'] = '/' . $query;
                $config['total_rows'] = $num;
                $config['per_page'] = $pagesize;
                $config['use_page_numbers'] = TRUE;
                $config['uri_segment'] = 3;
                $config['num_links'] = 4;
                $config['cur_tag_open'] = '<span class="current">';
                $config['cur_tag_close'] = '</span>';
                $config['prev_link'] = '上一页';
                $config['next_link'] = '下一页';
                $this->load->library('pagination');
                $this->pagination->initialize($config);
                $pageHTML = $this->pagination->create_links();
                $offset = (abs($pageno) - 1) * $pagesize;
                $products = $this->product->getProductList($pagesize, $offset, "pid, did, pname, market_price, sell_price", $where);
            }
            //$this->cache_view("category/\d+/?\d*");
            $this->load->view('product/product/category', array(
                'title' => "{$cate_info['title']} 分类列表",
                'category' => $category,
                'nav'=>$this->cate->getParents($category),
                'ancestor'=> $this->channel[$category]['ancestor'],
                'clan'=>$this->cate->getClan($this->channel[$category]['ancestor']),
                'param' => $param,
                'modelAttr' => $modelAttr,
                'products' => $products,
                'pageHTML' => $pageHTML, 'pageNUM' => $pageNUM
            ));
        } else {
            show_404("分类不存在");
        }
    }

    /**
     * 产品详情
     */
    public function info()
    {
        $pid = (int)$this->uri->rsegment(3, 1);
        $this->load->model('product/Model_Product', 'product');
        $product = $this->product->getProductById($pid);
        if($product)
        {
            //产品图片
            $photo = $this->product->getProductPhoto($pid);
            //相同款式
            $alike = $this->product->getProductByStyleNo($product['style_no'],'pid');
            $this->load->view('product/product/info', array(
                'nav' => $this->cate->getParents($product['class_id']),
                'product' => $product,
                'photo' => $photo,
                'alike' => $alike,
            ));
        }
        else
        {
            show_404("产品不存在");
        }
    }


}