<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Filter extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
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
            $param = explode('!', trim($query, '!.html'));
//            p($tmp);
//            foreach ($tmp as $item) {
//                if (strpos($item, '-') === false) continue;
//                list($key, $value) = explode('-', $item);
//                $key && $value && $param[$key] = urldecode($value);
//            }
//            $param && ksort($param); //参数排序
        }
        //var_dump($param);
        return $param;
    }

    /**
     * 产品列表
     */
    public function index()
    {
        //$this->HTTPLastModified();

        $category = (int)$this->uri->rsegment(3, 0);
        $pageno = max((int)$this->uri->rsegment(4, 1), 1);
        $query = $this->uri->rsegment(7, '');
        $param = self::parse_param($query);
        $orderby = $this->uri->rsegment(5, '0');
        //p($param);
        $rank = $this->uri->rsegment(6, '1');
        switch ($orderby) {
            case '1': //按价格
                $order = $rank == '0' ? "sell_price ASC" : "sell_price DESC" ;
                break;
            case '2': //按销量
                $order = $rank == '0' ? "sales ASC" : "sales DESC" ;
                break;
            case '3': //按上架时间
                $order = $rank == '0' ? "create_time ASC" : "create_time DESC" ;
                break;
            default://默认排序
                $order = null;
        }

        //$this->load->database();
        //$this->db->cache_on();
        //$this->db->cache_off();
        //获取分类信息
        $this->load->model('product/Model_Product_Category', 'cate');
        if($category === 0)
        {
            //print_r($this->channel);
            $cate_info = array('model_id'=>0, 'title'=>'全部产品');
        }
        else
        {
            $cate_info = isset($this->channel[$category]) ? $this->channel[$category]:null;
        }

        if ($cate_info) {
            $classes = $class_id = array_keys($this->cate->getChildren($category));
            $classes = implode(',', $classes);

            $this->load->model('product/Model_Product_Models', 'mod');
            $model_detail = $this->mod->get_model_detail($cate_info['model_id']);
            $pids = array();
            if($param)
            {
                $pids = $this->mod->get_pid_by_model_value($cate_info['model_id'], $param, array('pid'=>'pid'));
                $pids && $pids = array_keys($pids);
            }

            $where = '';
            $category && $where = "class_id in ({$classes}) AND";
            $where .= ' status=1';
            $where .=   ($param && $pids) ? ' AND pid IN (' . implode(',', $pids) . ')' : '';
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
                $pageno = $pageno > $pageNUM ? $pageNUM:$pageno;
                $config['base_url'] = "/category/{$category}";
                $config['suffix'] = $param ? "/{$orderby}/{$rank}/{$query}" : "/{$orderby}/{$rank}";
                $config['total_rows'] = $num;
                $config['per_page'] = $pagesize;
                $config['use_page_numbers'] = TRUE;
                $config['uri_segment'] = 3;
                $config['num_links'] = 4;
                $config['cur_tag_open'] = '<span class="current">';
                $config['cur_tag_close'] = '</span>';
                $config['prev_link'] = '上一页';
                $config['next_link'] = '下一页';
                //print_r($config);
                $this->load->library('pagination');
                $this->pagination->initialize($config);
                $pageHTML = $this->pagination->create_links();
                $offset = ($pageno - 1) * $pagesize;
                $products = $this->product->getProductList($pagesize, $offset, "pid, did, pname, market_price, sell_price", $where, $order);
            }
            //$this->cache_view("category/\d+/?\d*");
            //print_r($this->cate->getClan($this->channel[$category]['ancestor']));
            $this->load->view('product/product/filter', array(
                'title' => "{$cate_info['title']} 分类列表",
                'category' => $category,
                'nav'=> $this->cate->getParents($category),
                'ancestor'=> $category ? $this->channel[$category]['ancestor'] : 0,
                'clan'=> $category ? $this->cate->getClan($this->channel[$category]['ancestor']) : $this->channel,
                'param' => $param,
                'model_detail' => $model_detail,
                'productCount' => $num,
                'products' => $products,
                'pageHTML' => $pageHTML, 'pageNUM' => $pageNUM, 'pageno'=>$pageno, 'query'=>$query,
                'salesRank' => $this->salesRank($class_id),
                'orderby'=>$orderby,
                'orderrank'=>$rank,
            ));
            //print_r($this->channel);
        } else {
            show_404("分类不存在");
        }
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