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

        $category = $this->uri->rsegment(3,1);
        $page = $this->uri->rsegment(4,1);
        $tmp = $this->uri->rsegment(5,array());
        if($tmp)
            $tmp = explode('!', trim($tmp, '!'));
        echo '<pre>';print_r($tmp);
        foreach($tmp as $item)
        {
           list($key, $value) = explode('-', $item);
           $param[$key] = $value;
        }
        print_r($param);
        echo $param_str = str_replace('=', '-', http_build_query($param, '!',''));
        //echo '<pre>';print_r($this->uri->rsegment_array());
        $this->load->model('product/Model_Product_Model', 'mod');
        //开启查询缓存
        $this->db->cache_on();
        $modelAttr = $this->mod->getModelAttr(1, 1);        //echo APPPATH;
        //$this->db->cache_off();

        foreach($modelAttr as $k=>$v)
        {
            $modelAttr[$k]['attr_value'] = explode(',', $v['attr_value']);
        }
        //echo '<pre>';print_r($modelAttr);

        //$this->cache_view("category/\d+/?\d*");

        $this->load->view('product/product/category',array('title'=>"分类列表",'category'=>$category,'modelAttr'=>$modelAttr));
    }

    /**
     * 产品详情
     */
    public function info()
    {
        echo 'product info';
    }


}