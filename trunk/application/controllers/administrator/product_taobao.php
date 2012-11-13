<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午4:32
 * To change this template use File | Settings | File Templates.
 */
class product_taobao extends MY_Controller
{
    public $searchType = array(
        1 => '商品ID',
        2 => '商品名称',
    );

    private $product_html = '';

    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
        $this->load->helper('directory');
        set_time_limit(0);
    }

    /**
     * 列出分类列表
     */
    public function index()
    {
        $this->load->view('administrator/product/taobao/index');
    }

    private $match = array(
        'tmall'=>array( //ok
            'name' => '/<input type="hidden" name="title" value="(.*?)" \/>/',            //一个
            'size' => '/<li data-value="(.*?)"><a href="#"><span>(.*?)<\/span><\/a><\/li>/',   //多个
            'color' => array('/<li data-value="(\d+:\d+)" title="(.*?)".*?>.*?<a href="#" style="background:url\((.*?)_30x30.jpg\) center no-repeat;">/s','<li data-value="(.*?)" title="(.*?)".*?>'),            //多个
            'price' => "/'reservePrice' : '(.*?)',/",                                                              //多个
            'attribute' => array('/<div class="attributes-list".*?>.*?<ul>(.*?)<\/ul>/s','/<li.*?>(.*?)(?:：|:)(.*?)<\/li>/'),                                                          //
            'intro' => "/<script>\(function\(url\).*?new Date\(\);\}\)\('(.*?)'\);<\/script>/",
            'skuMap'=> '/"valItemInfo":(.*?)"isSevenDaysRefundment"/s',
            'desc_url'=>'/;(?:n|s)\.async\s?=\s?true;\s?(?:n|s)\.src\s?=\s?(?:\'|")(.*?)(?:\'|")/',
            'defimg'=>'/<div class="tb-pic tb-s60">\s*?<a href="#"><img src="(.*?)_60x60\.jpg" \/><\/a>\s*?<\/div>/s',
        ),
        'taobao'=>array( //ok
            'name' => '/<input type="hidden" name="title" value="(.*?)" \/>/',            //一个
            'size' => '/<li data-value="(.*?)"><a href="#"><span>(.*?)<\/span><\/a><\/li>/',   //多个
            'color' => array('/<li data-value="(\d+:\d+)" title="(.*?)".*?>.*?<a href="#" style="background:url\((.*?)_30x30.jpg\) center no-repeat;">/s','<li data-value="(.*?)" title="(.*?)".*?>'),            //多个
            'price' => "/'reservePrice' : '(.*?)',/",                                                              //多个
            'attribute' => array('/<div class="attributes-list".*?>.*?<ul>(.*?)<\/ul>/s','/<li.*?>(.*?)(?:：|:)(.*?)<\/li>/'),                                                          //
            'intro' => "/<script>\(function\(url\).*?new Date\(\);\}\)\('(.*?)'\);<\/script>/",
            'skuMap'=> '/"valItemInfo":(.*?)"isSevenDaysRefundment"/s',
            'desc_url'=>'/;(?:n|s)\.async\s?=\s?true;\s?(?:n|s)\.src\s?=\s?(?:\'|")(.*?)(?:\'|")/',
            'defimg'=>'/<div class="tb-pic tb-s60">\s*?<a href="#"><img src="(.*?)_60x60\.jpg" \/><\/a>\s*?<\/div>/s',
        ),
    );

    private function get_match($url)
    {
        $url_arr = parse_url($url);
        $template_type = NULL;
        switch($url_arr['host'])
        {
            case 'detail.tmall.com':
                $template_type = 'tmall';
                break;
            case 'item.taobao.com':
                $template_type = 'taobao';
                break;
        }
        //var_dump($template_type);

        $match = isset($this->match[$template_type]) ? $this->match[$template_type] : NULL;
        return $match;
    }

    public function confirm()
    {
        $url = $this->input->post('url');
        $url_arr = parse_url($url);

        $query = $unique_id = NULL;
        parse_str($url_arr['query'], $query);
        if(isset($query['id']))
        {
            $unique_id = $query['id'];
        }
        if($unique_id === NULL)
        {
            die("淘宝产品唯一号不存在");
        }

        //$this->load->helper('directory');

        $template_type = NULL;
        switch($url_arr['host'])
        {
            case 'detail.tmall.com':
                $template_type = 'tmall';
                break;
            case 'item.taobao.com':
                $template_type = 'taobao';
                break;
        }
        //var_dump($template_type);

        $match = isset($this->match[$template_type]) ? $this->match[$template_type] : NULL;
        if($match === NULL)
        {
            die("模版不存在");
        }

        $this->product_html = $html = self::get_html($url, $unique_id);
        //echo $html;
        $info = array();
        //$info['shop'] = $website;
        //$info['link_id'] = $item['id'];
        //$html = $this->get_content($website, $item['id']);


        $info['defimg'] = $this->get_product_defimg($match['defimg']);

        $info['name'] = $this->get_product_name($match['name']);

        //$info['price'] = $this->get_product_price($match['price']);


        //产品简介
        //$matches = array();
        //preg_match($match['intro'], $html, $matches);
        //isset($matches[1]) && $info['intro'] = trim($matches[1]);


        //$info['size'] = $this->get_product_size($match['size']);
        //$info['color'] = $this->get_product_color($match['color']);
        //$skuMap = $this->get_product_skuMap($match['skuMap']);
        //$skuMap = json_decode($skuMap, true);

        $desc = $this->get_product_desc($match['desc_url'], $unique_id);

        //echo $desc;
        $desc_img = $this->get_product_desc_img($desc);
        //p($desc_img);
        //p($skuMap);
        //p($info);

        $view_data['public'] = array('url'=> $url,'unique_id'=>$unique_id, 'pname'=>$info['name'], 'def_img'=>$info['defimg'], 'desc_img'=>$desc_img);
        //$view_data['private'] = $this->product_format($info, $skuMap);
        //p($view_data);
        $this->load->view('administrator/product/taobao/confirm', $view_data);
    }


    function confirm2()
    {
        $unique_id = $this->input->post('unique_id');

        if(!$unique_id) {
            die("淘宝产品唯一号不存在");
        }
        $pname = $this->input->post('pname');
        $url = $this->input->post('url');
        //p(get_defined_constants(true));die;
        //$this->load->helper('directory');
        $def_img = $this->input->post('def_img');
        $desc_img = $this->input->post('desc_img');

        $def_images = $desc_images = array();
        foreach($def_img as $i) {
            $def_images[] = self::get_pro_img($i, $unique_id);
        }
        //p($def_images);
        foreach($desc_img as $ii) {
            $desc_images[$ii] = trim(config_item('base_url'), '/').self::get_desc_img($ii, $unique_id);
        }
        //p($desc_images);

        $view_data['public'] = array('url'=> $url,'unique_id'=>$unique_id, 'pname'=>$pname, 'def_img'=>$def_images, 'desc_img'=>$desc_images);
        $this->load->view('administrator/product/taobao/confirm2', $view_data);
        //p($view_data);
    }

    function complete()
    {
        $unique_id = $this->input->post('unique_id');

        if(!$unique_id) {
            die("淘宝产品唯一号不存在");
        }
        $pname = $this->input->post('pname');
        $url = $this->input->post('url');
        $def_img = $this->input->post('def_img');
        $desc_img = $this->input->post('desc_img');
        $match = $this->get_match($url);
        $this->product_html = self::get_html($url, $unique_id);
        $desc = $this->get_product_desc($this->match['tmall']['desc_url'], $unique_id);
        //echo "尚未替换结束\n\n\n";
        if($desc_img)
        {
            $search  = $replace = array();
            foreach ($desc_img as $item) {
                list($search[], $replace[]) = explode('|||||', $item);
            }
            $desc = str_replace($search, $replace, $desc);
        }

        //echo "开始";
        //echo $desc, "结束\n\n\n";
        $desc = preg_replace('/<img[^<^>).]*?src="http:\/\/(?!wunxin).*?>/', '', $desc);
        $desc = preg_replace('/<b[\s<>br]*r>/', '<br>', $desc);

        //p($search);p($replace);
        //echo "替换后\n",$desc;
        //die;
        $info['size'] = $this->get_product_size($match['size']);
        $info['color'] = $this->get_product_color($match['color']);
        $skuMap = $this->get_product_skuMap($match['skuMap']);
        $skuMap = json_decode($skuMap, true);
        $pro_list = $this->product_format($info, $skuMap);
        //p($pro_list);die;
        $insert = array();
        foreach($pro_list as $kk=> $pp)
        {
            $insert[] = array('pname'=>$pname,
                'sell_price'=>$pp['price'],
                'style_no'=>md5($unique_id),
                'keyword'=>$pname,
                'def_img'=>$pp['img'],
                'descr'=>$pname,
                'product_taobao_addr'=> $url,
                'pcontent'=>$desc,
                'create_time'=>date("Y-m-d H:i:s"));
        }
        //p($insert);
        $result_id = array();
        $pro_photo = array();
        foreach($insert as $insert_item)
        {
            $_def_img = $insert_item['def_img'];
            $_def_img = $this->get_pro_img($_def_img, $unique_id);
            unset($insert_item['def_img']);
            $this->db->insert('product', $insert_item);
            $tmp_id = $this->db->insert_id();

            $source_file = rtrim(WEBROOT, '/') . $_def_img;
            $target_path = rtrim(WEBROOT, '/') . '/upload/product/' . intToPath($tmp_id);
            //echo '<br>';
            recursiveMkdirDirectory($target_path);
            $target_file = $target_path . (md5($tmp_id) . '.jpg');
            //copyImg($source_file, 0, 0, $target_file);
            copyImg($source_file, 0, 0, $target_file, $quality = 100, 1.2);
            copyImg($source_file, 350, 420, str_replace(md5($tmp_id).'.jpg', md5($tmp_id).'_M.jpg', $target_file), $quality = 100, 1.2);
            copyImg($source_file, 60, 60, str_replace(md5($tmp_id).'.jpg', md5($tmp_id).'_S.jpg', $target_file), $quality = 90, 1.2);
            copyImg($source_file, 164, 197, str_replace(md5($tmp_id).'.jpg', 'default.jpg', $target_file), $quality = 100, 1.2);
            copyImg($source_file, 50, 50, str_replace(md5($tmp_id).'.jpg', 'icon.jpg', $target_file), $quality = 90, 1.2);

            $create_time = date("Y-m-d H:i:s",TIMESTAMP);
            $pro_photo[] = array('pid'=>$tmp_id, 'img_addr'=>md5($tmp_id).'.jpg', 'is_default'=>1, 'create_time'=>$create_time);
            $_pro_photo = $this->copy_img($tmp_id, $def_img);
            //p($_pro_photo);
            foreach($_pro_photo as $photo)
            {
                $tmp['pid'] = $tmp_id;
                $tmp['img_addr'] = $photo;
                $tmp['is_default'] = 0;
                $tmp['create_time'] = $create_time;
                $pro_photo[] = $tmp;
            }
            $this->db->insert_batch('product_photo', $pro_photo);

            $result_id[] = $tmp_id;
        }
        //p($result_id);
        //p($insert);
        //p($def_img);
        //p($desc_img);
        foreach($result_id as $id)
        {
            echo "<a href=\"/administrator/product/edit/{$id}\" target=\"_blank\">{$id}</a><br>";
        }


        $query = '';
        foreach($result_id as $pid)
        {
            $query .= "&product_id[]={$pid}";
        }
        header("Location:http://wunxin.com/administrator/product_taobao/show_result?{$query}");
    }

    public function show_result()
    {
        $product_id = $this->input->get("product_id");
        //foreach($product_id as $id)
        //{
        //    echo "<a href=\"/administrator/product/edit/{$id}\" target=\"_blank\">{$id}</a><br>";
        //}
        $this->load->view('administrator/product/taobao/show_result', array("product_id"=>$product_id));
    }

    function get_product_info()
    {
        $url = $this->input->post('url');
        $spare = $this->input->post('spare');
        $unique_id = self::get_unique_id($url);

        $this->product_html = self::get_html($url, $unique_id);
        $match = $this->get_match($url);
        $info['size'] = $this->get_product_size($match['size']);
        $info['color'] = $this->get_product_color($match['color']);
        $skuMap = $this->get_product_skuMap($match['skuMap']);
        $skuMap = json_decode($skuMap, true);
        $pro_list = $this->product_format($info, $skuMap);
        //p($match);
        //p($skuMap);
        if(isset($pro_list[$spare]))
        {
            p($pro_list[$spare]);
        }
        else
            p($pro_list);
    }

    static function get_unique_id($url)
    {
        $url_arr = parse_url($url);

        $query = $unique_id = NULL;
        parse_str($url_arr['query'], $query);
        if(isset($query['id']))
        {
            $unique_id = $query['id'];
        }
        return $unique_id;
    }

    function copy_img($pid, $img_list)
    {
        $r = array();
        foreach($img_list as $img)
        {
            $source_file = rtrim(WEBROOT, '/') . $img;
            $target_path = rtrim(WEBROOT, '/') . '/upload/product/' . intToPath($pid);
            $file_name = basename($img, '.jpg');
            recursiveMkdirDirectory($target_path);
            $target_file = $target_path . $file_name.'.jpg';
            //copyImg($source_file, 0, 0, $target_file);
            copyImg($source_file, 0, 0, $target_file, $quality = 100, 1.2);
            copyImg($source_file, 350, 420, str_replace($file_name.'.jpg', $file_name.'_M.jpg', $target_file), $quality = 100, 1.2);
            copyImg($source_file, 60, 60, str_replace($file_name.'.jpg', $file_name.'_S.jpg', $target_file), $quality = 90, 1.2);
            //copyImg($source_file, 164, 197, str_replace(md5($pid).'.jpg', 'default.jpg', $target_file), $quality = 100, 1.2);
            //copyImg($source_file, 50, 50, str_replace(md5($pid).'.jpg', 'icon.jpg', $target_file), $quality = 90, 1.2);
            $r[] = $file_name.".jpg";
        }
        return $r;

    }

    function product_format($info , $skuMap)
    {
        $result = array();
        if(isset($info['color']))
        {
            foreach($info['color'] as $item)
            {
                foreach($info['size'] as $size)
                {
                    $key = ";{$size['id']};{$item['id']};";
                    if(isset($skuMap['skuMap'][$key]))
                    {
                        if(!isset($result[$item['id']]))
                        {
                            $item['price'] = $skuMap['skuMap'][$key]['priceCent'];
                            $result[$item['id']] = $item;
                        }
                        $result[$item['id']]['size'][] = $size;
                    }
                }
            }
        }
        return $result;
    }

    static private function get_pro_img($url, $unique_id)
    {
        $file_name = md5($url).'.jpg';
        $path = WEBROOT . '/tmp/taobao_img/' . intToPath($unique_id);
        $file_path = $path . $file_name;
        if(! is_file($file_path)) {
            recursiveMkdirDirectory($path);
            $img = file_get_contents($url);
            file_put_contents($file_path, $img, LOCK_EX);
        }
        return '/tmp/taobao_img/' . intToPath($unique_id) . $file_name;
    }

    static private function get_desc_img($url, $unique_id)
    {
        $file_name = md5($url).'.jpg';
        $path = WEBROOT . 'upload/attached/tb_product/' . intToPath($unique_id);
        $file_path = $path . $file_name;
        if(! is_file($file_path)) {
            recursiveMkdirDirectory($path);
            $img = file_get_contents($url);
            file_put_contents($file_path, $img, LOCK_EX);
        }
        return '/upload/attached/tb_product/' . intToPath($unique_id) . $file_name;
    }

    static private function get_html($url, $unique_id)
    {
        $file_name = md5($url);
        $path = APPPATH . 'cache/taobao/'.intToPath($unique_id);
        $file_path = $path . $file_name;
        recursiveMkdirDirectory($path);

        if(is_file($file_path))
        {
            $html = file_get_contents($file_path);
        }
        else
        {
            $html = file_get_contents($url);
            file_put_contents($file_path, $html, LOCK_EX);
        }
        return iconv('GBK', "UTF-8//IGNORE", $html);
    }

    function get_product_desc($match='', $unique_id)
    {
        //n.async = true; n.src = 'http://dsc.taobaocdn.com/i2/131/520/13852771115/T1bif6XdlbXXcWeqbX.desc%7Cvar%5Edesc%3Bsign%5E030317aea1a674a5420ee444c463b8aa%3Blang%5Egbk%3Bt%5E1352211984'
        //s.async = true;s.src="
        $matches = array();
        $result = '';
        $desc = '';
        preg_match($match, $this->product_html, $matches);
        isset($matches[1]) && $result = trim($matches[1]);
        //p($matches);
        if($result)
        {
            $desc = self::get_html($result, $unique_id);
            preg_match('/var desc=\'(.*)\';/', $desc, $out);
            if(isset($out[1]) && $out[1])
            {
                $desc = $out[1];
            }
        }

        $pattern = '/<a.*?a>/i';
        $replacement = '';
        $html = preg_replace($pattern, $replacement, $desc);
        $html = strip_tags($html, '<img><br>');
        $desc = preg_replace('/<img title="超.*?</', '<', $html);
        return $desc;
    }

    function get_product_desc_img($desc)
    {
        $result = array();
        $matches = array();
        preg_match_all('/src="(.*?)"/', $desc, $matches);
        isset($matches[1]) && $result = $matches[1];
        return $result;
    }

    function get_product_skuMap($match)
    {
        $matches = array();
        $result = '';
        preg_match($match, $this->product_html, $matches);
        isset($matches[1]) && $result = trim($matches[1]);
        return trim($result, ',');
    }

    function get_product_name($match)
    {
        $matches = array();
        $result = '';
        preg_match($match, $this->product_html, $matches);
        isset($matches[1]) && $result = trim($matches[1]);
        return $result;
    }

    function get_product_price($match)
    {
        $matches = array();
        $result = '';
        preg_match($match, $this->product_html, $matches);
        isset($matches[1]) && $result = trim($matches[1]);
        return $result;
    }

    function get_product_defimg($match)
    {
        $result = array();
        $matches = array();
        preg_match_all($match, $this->product_html, $matches);
        isset($matches[1]) && $result = $matches[1];
        return $result;
    }

    function get_product_size($match)
    {
        $result = array();
        $matches = array();
        preg_match_all($match, $this->product_html, $matches);

        foreach($matches[1] as $key => $item)
        {
            $result[] = array('id'=>$item, 'name'=>$matches[2][$key]);
        }
        return $result;
    }

    function get_product_color($match)
    {
        $result = array();
        $matches = array();
        preg_match_all($match[0], $this->product_html, $matches);
        if(isset($matches[1]) && $matches[1])
        {
            $info['color'] = array_combine($matches[1], $matches[2]);
        }
        else
        {
            $tmp = array();
            preg_match_all($match[1], $this->product_html, $tmp);
            $info['color'] = array_flip($tmp[1]);
        }
        foreach ($matches[1] as $key => $item) {
            $result[] = array('id' => $item, 'color' => $matches[2][$key], 'img' => $matches[3][$key] . '_460x460.jpg');
        }
        return $result;
    }

    /**
     * 搜索产品
     */
    public function search()
    {
        $keyword = $this->input->get_post('keyword');
        $sType = $this->input->get_post('s_type');

        if (empty ($keyword) || empty ($sType)) {
            show_error('搜索参数不全');
        }

        $this->load->model('product/Model_Product', 'product');
        switch ($sType) {
            case 1:
                $data = $this->product->getProductById($keyword);
                $productData[] = empty ($data) ? null : $data;
                break;
            case 2:
                $productData = $this->product->getProductList(1000, 0,'*',' pname like \'%'.$keyword.'%\'');//($limit = 20, $offset = 0, $field= "*", $where = null, $order = null)
                break;
            default:
                $data = $this->product->getProductById($keyword);
                $productData[] = empty ($data) ? null : $data;
        }

        $this->load->view('/administrator/product/index', array('list' => $productData, 'searchType' => $this->searchType, 'sType' => $sType, 'keyword' => $keyword));
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
        $color = $this->color->getList(500, 0, array('color_id'=>'*'));
        foreach($color as $k=>$item)
        {
            if($item['parent_id'] != 0)
            {
                $color[$item['parent_id']]['children'][] = $item;
                unset($color[$k]);
            }
        }
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
        $tmp = $this->color->getList(500);
        $color = array();
        foreach($tmp as $v)
        {
            $color[$v['color_id']] =  $v;
        }
        foreach($color as $k=>$item)
        {
            if($item['parent_id'] != 0)
            {
                $color[$item['parent_id']]['children'][] = $item;
                unset($color[$k]);
            }
        }

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


            //* 暂用代码
            $pInfo = $this->product->getProductById($pid);
            $pData = $this->product->getProductByStyleNo($pInfo['style_no']);
            unset($data['pname']);unset($data['market_price']);unset($data['sell_price']);unset($data['cost_price']);
            unset($data['pcontent']);
            //echo '<pre>';print_r($data);exit;
            foreach ($pData as $pdv) {
                $this->product->editProduct($pdv['pid'], $data);
                $this->product->delProductAttrById($pdv['pid']);
                $this->product->delProductSizeById($pdv['pid']);
                $this->product->addProductSize($size, $pdv['pid']);
            }
            /*//

            /*原代码
            $this->product->editProduct($pid, $data);
            $delphoto = $this->input->post('delphoto');
            $delphoto && $this->product->delProductPhotoById($delphoto);
            $this->product->delProductAttrById($pid);
            $this->product->delProductSizeById($pid);
            //*/
        } else {  //添加产品信息需要的操作
            $data['create_time'] = date('Y-m-d H:i:s', TIMESTAMP);
            $pid = $this->product->addProduct($data);
        }

        // 原代码
        //$size && $this->product->addProductSize($size, $pid);


        //* 暂用代码
        $pInfo = $this->product->getProductById($pid);
        $pData = $this->product->getProductByStyleNo($pInfo['style_no']);
        //echo '<pre>';print_r($attr_value);exit;
        $attr = array();
        $i = 0;
        foreach ($pData as $pdv) {
            foreach ($attr_value as $attr_id => $item) {
                foreach ($item as $v) {
                    if ($v) {
                        $attr[$i]['pid'] = $pdv['pid'];
                        $attr[$i]['attr_id'] = $attr_id;
                        $attr[$i]['model_id'] = $data['model_id'];
                        $attr[$i]['attr_value'] = $v;
                        $i++;
                    }
                }
            }
        }
        //*/
        //echo '<pre>';print_r($attr);exit;
        /*原代码
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
        //*/

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
                    $fileName = substr($tmp['file_name'], 0, strpos($tmp['file_name'], '.'));//($tmp['file_name']);
                    $source_file = $config['upload_path'] . $tmp['file_name'];
                    $target_path = UPLOAD.'product'. DS . intToPath($pid);
                    recursiveMkdirDirectory($target_path);
                    $fileNameALL = ($fileName . '.jpg');

                    copyImg($source_file, 350, 420, str_replace($fileNameALL, $fileName.'_M.jpg', $target_path . $fileNameALL), 100, 1.2);
                    copyImg($source_file, 60, 60, str_replace($fileNameALL, $fileName.'_S.jpg', $target_path . $fileNameALL), 100, 1.2);

                    $product_photo[] = $fileNameALL;
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
            $img_path = UPLOAD . 'product' . DS . intToPath($default_photo['pid']) .$default_photo['img_addr'];

            copyImg($img_path, 164, 197, substr($img_path, 0, strrpos($img_path, '/')) . '/default' . substr($img_path, strpos($img_path, '.')), 100, 1.2);
            copyImg($img_path, 50, 50, substr($img_path, 0, strrpos($img_path, '/')) . '/icon' . substr($img_path, strpos($img_path, '.')), 100, 1.2);
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