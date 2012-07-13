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
    /**
     * 产品列表
     */
    public function category()
    {
        $category = (int)$this->uri->rsegment(3, 1);
        $pageno = (int)$this->uri->rsegment(4, 1);
        $pageno === 0 && $pageno = 1;
        $query = $this->uri->rsegment(5, '');
        $param = array();
        if ($query) {
            $tmp = explode('!', trim($query, '!'));
            foreach ($tmp as $item) {
                if (strpos($item, '-') === false) continue;
                list($key, $value) = explode('-', $item);
                $param[$key] = urldecode($value);
            }
            $param && ksort($param); //参数排序
        }
        //print_r($param);
        $this->load->database();
        //$this->db->cache_on();
        //$this->db->cache_off();

        //获取分类信息
        $this->load->model('product/Model_Product_Category', 'cate');
        $cate_info = $this->cate->getCategroyById($category);

        if ($cate_info) {
            $this->load->model('product/Model_Product_Model', 'mod');
            $modelAttr = $this->mod->getModelAttr($cate_info['model_id'], 1); //echo APPPATH;
            foreach ($modelAttr as $k => $v) {
                $modelAttr[$k]['attr_value'] = explode(',', $v['attr_value']);
            }
            $pids = $this->mod->getPidByAttr($param);

            $where = "class_id={$category} AND status=1 ";
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
                'param' => $param,
                'modelAttr' => $modelAttr,
                'products' => $products,
                'pageHTML' => $pageHTML,
                'pageNUM' => $pageNUM
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
        echo 'product info';
    }


}