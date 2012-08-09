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
                $key && $value && $param[$key] = urldecode($value);
            }
            $param && ksort($param); //参数排序
        }
        //var_dump($param);
        return $param;
    }

    /**
     * 产品列表
     */
    public function category()
    {
        $this->HTTPLastModified();

        $category = (int)$this->uri->rsegment(3, 1);
        $pageno = (int)$this->uri->rsegment(4, 1);
        $pageno === 0 && $pageno = 1;
        $query = $this->uri->rsegment(5, '');
        $param = self::parse_param($query);
        //$this->load->database();
        //$this->db->cache_on();
        //$this->db->cache_off();
        //获取分类信息
        $this->load->model('product/Model_Product_Category', 'cate');
        $cate_info = isset($this->channel[$category]) ? $this->channel[$category]:null;

        if ($cate_info) {
            $classes = $class_id = array_keys($this->cate->getChildren($category));
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
                $num = $this->product->getProductCount($where);
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
            //print_r($this->cate->getClan($this->channel[$category]['ancestor']));
            $this->load->view('product/product/category', array(
                'title' => "{$cate_info['title']} 分类列表",
                'category' => $category,
                'nav'=>$this->cate->getParents($category),
                'ancestor'=> $this->channel[$category]['ancestor'],
                'clan'=>$this->cate->getClan($this->channel[$category]['ancestor']),
                'param' => $param,
                'modelAttr' => $modelAttr,
                'products' => $products,
                'pageHTML' => $pageHTML, 'pageNUM' => $pageNUM,
                'salesRank' => $this->salesRank($class_id),
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
        $this->HTTPLastModified();

        $pid = (int)$this->uri->rsegment(3, 1);
        $this->load->model('product/Model_Product', 'product');
        $product = $this->product->getProductById($pid);
        if($product)
        {
            $this->load->model('design/Model_Design', 'design');
            $design = $this->design->getDesignByDid($product['did'], 'did, dname, ddetail');

            $this->load->model('user/Model_User', 'user');
            $designer = $this->user->getUserInfoById($product['uid'], 'uid, introduction');


            //产品图片
            $photo = $this->product->getProductPhoto($pid);
            //相同款式
            $tmp = $this->product->getProductByStyleNo($product['style_no'],'pid,color_id');
            $alike = $color_id = $color = array();
            foreach($tmp as $v)
            {
                $alike[$v['pid']] = $v;
                $color_id[] = $v['color_id'];
            }
            $this->load->model('product/Model_Product_Color', 'color');
            $tmp = $this->color->getColorById($color_id);
            foreach($tmp as $v)
            {
                $color[$v['color_id']] = $v;
            }
            foreach($alike as $k=>$v)
            {
                $alike[$k]['color'] = empty($color[$v['color_id']]) ? '' : $color[$v['color_id']];
            }
            $this->load->view('product/product/info', array(
                'nav' => $this->cate->getParents($product['class_id']),
                'product' => $product,
                'photo' => $photo,
                'alike' => $alike,
                'psize' => $this->product->getProductSize($pid),
                'design' => $design,
                'designer' => $designer,
                'salesRank' => $this->salesRank($product['class_id'], $product['brand_id']),
            ));
            //$html = $str = preg_replace('/\s+/', ' ', $this->output->get_output());
            //file_put_contents(WEBROOT . 'product/' . $pid . '.html', $html, LOCK_EX);
        }
        else
        {
            show_404("产品不存在");
        }
    }

    /**
     * 搜索产品
     */
    public function search()
    {
        $keyword = $this->input->get('keyword');
        $offset = max((int)$this->input->get('offset'), 0);
        $this->load->model('product/Model_Product', 'product');
        if ($keyword == false) {
            $like = null;
        }
        else
        {
            $keyword = $this->db->escape_like_str($keyword);
            $like = "pname LIKE '%{$keyword}%'";
        }
        $products = $this->product->getProductList($limit = 32, $offset, "pid, did, pname, market_price, sell_price", $like, $order = null);

        if($this->input->is_ajax_request() !== true)
        {
            $this->load->view('product/product/search', array(
                'title' => "{$keyword} 搜索",
                'keyword' => $keyword,
                'clan'=>$this->channel,
                'products' => $products,
                'pageHTML' => '',//$pageHTML,
                'salesRank' => $this->salesRank(),
            ));
        }
        else
        {
            self::json_output($products, true);
        }
    }

    /**
     * 删除产品
     */
    public function deleteProduct()
    {
        $pId = $this->input->get_post('pid');

        $response = array('error' => '0', 'msg' => '删除产品成功', 'code' => 'delete_design_success');

        do {
            if (empty ($pId)) {
                $response = error(20025);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('product/Model_Product', 'product');
            $status = $this->product->deleteProduct($pId, $this->uInfo['uid']);
            if (!$status) {
                $response = error(20026);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 销量榜
     * @param $class_id
     * @param null $brand_id
     * @return array
     */
    private function salesRank($class_id = null, $brand_id = null)
    {
        $where = '';
        $this->load->model('product/Model_Product', 'product');
        //同类别
        if($class_id){
            if(is_array($class_id))
            {
                $where = "class_id IN (".implode(',', $class_id).")";;
            }
            else
            {
                $where = "class_id = $class_id";
            }
            $rank[1] = $this->product->getProductList($limit = 10, $offset = 0, $field= "pid, pname, sell_price", $where,'sales DESC');
        }
        //所有分类
        $rank[2] = $this->product->getProductList($limit = 10, $offset = 0, $field= "pid, pname, sell_price", null,'sales DESC');
        //同品牌
        if($brand_id)
        {
            $where .= " AND brand_id = {$brand_id}";
            $rank[3] = $this->product->getProductList($limit = 10, $offset = 0, $field= "pid, pname, sell_price", $where,'sales DESC');
        }
        //var_dump($rank);
        return $rank;
    }
}