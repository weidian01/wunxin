<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-12-5
 * Time: 下午8:38
 * To change this template use File | Settings | File Templates.
 */

class into extends MY_Controller
{
    const TIMEOUT = 0;

    private $class = array();

    private $brand = array();

    private $size = array();

    private $product_html = '';

    private $match = array(
        'tmall'=>array( //ok
            'name' => '/<input type="hidden" name="title" value="(.*?)" \/>/',            //一个
                      //<li data-value="20509:28314"><a href="#"><span>S</span></a></li>
            'size' => '/<li data-value="(.*?)"><a href="#"><span>(.*?)<\/span><\/a><\/li>/',   //多个
            'color' => array('/<li data-value="(\d+:\d+)" title="(.*?)".*?>.*?<a href="#" style="background:url\((.*?)_30x30.jpg\) center no-repeat;">/s','<li data-value="(.*?)" title="(.*?)".*?>'),            //多个
            'price' => "/'reservePrice' : '(.*?)',/",                                                              //多个
            'attribute' => array('/<div class="attributes-list".*?>.*?<ul>(.*?)<\/ul>/s','/<li.*?>(.*?)(?:：|:)(.*?)<\/li>/'),                                                          //
            'intro' => "/<script>\(function\(url\).*?new Date\(\);\}\)\('(.*?)'\);<\/script>/",
            'skuMap'=> '/"valItemInfo":(.*?)"isSevenDaysRefundment"/s',
            'desc_url'=>'/;(?:n|s)\.async\s?=\s?true;\s?(?:n|s)\.src\s?=\s?(?:\'|")(.*?)(?:\'|")/',
            'defimg'=>'/<div class="tb-pic tb-s60">\s*?<a href="#"><img src="(.*?)_60x60\.jpg" \/><\/a>\s*?<\/div>/s',
            'attribute' => array('/<div class="attributes-list".*?>.*?<ul>(.*?)<\/ul>/s','/<li.*?>(.*?)(?:：|:)(.*?)<\/li>/'),
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

    public function __construct()
    {
        parent::__construct();
        ini_set('memory_limit', '3072M');
        $this->load->helper('directory');
        set_time_limit(0);
    }

    public function lixiangniandai()
    {
        $list = $this->db->select('pid, product_taobao_addr')->group_by('product_taobao_addr')->get_where('product',array('brand_id'=>1))->result_array();
        foreach($list as $v)
        {
            sleep(8);
            $url = $v['product_taobao_addr'];
            echo $v['pid'],"\t",$url,"\n";

            $tmp = $this->db->select('id, url')->get_where('z_product_attr',array('url'=>$url))->row_array();
            if ($tmp) {
                echo 'pass',"\n\n";
                continue;
            }

            $unique_id = self::get_unique_id($url);
            $match = $this->get_match($url);
            $this->product_html = $html = self::get_html($url, $unique_id);

            $product_attr = $this->get_product_attr($match['attribute']);
            if($product_attr)
            {
                $this->insert_product_attr($url, $product_attr);
            }
            else
            {
               echo 'none',"\n\n";
            }

        }
    }

    public function index()
    {   die('走错门了');
        while(true)
        {
            $urls = $this->get_product_url(100);//每次取100个
            if($urls)
            {
                foreach($urls as $v)
                {
                    //echo $v['url']."\n";continue;
                    sleep(5);
                    $info = array();

                    $product_model_id = $info['model_id'] = $this->get_class_model_id($v['cid']);
                    $brand = $this->get_brand($v['bid']);
                    $size_conf = $this->_get_product_size($v['size_type']);
                    //p($size_conf);

                    $url = $v['url'];//'http://detail.tmall.com/item.htm?spm=a1z10.3.0.157.ghkVEg&id=15132024033&';//
                    $unique_id = self::get_unique_id($url);
                    $match = $this->get_match($url);
                    //p($match);
                    if(!$unique_id || !$match)
                    {
                        //没有卫衣id 无模版的 up_flag 更新成9
                        $this->up($v['id'], array('up_flag'=>9));
                        continue;
                    }

                    $this->product_html = $html = self::get_html($url, $unique_id);

                    $product_attr = $this->get_product_attr($match['attribute']);

                    $this->insert_product_attr($url, $product_attr);

                    $def_img = $this->get_product_defimg($match['defimg']);

                    $product_name = $this->get_product_name($match['name']);

                    $desc = $this->get_product_desc($match['desc_url'], $unique_id);

                    $desc_img = $this->get_product_desc_img($desc);

                    //p($desc);
                    //p($desc_img);

                    $def_images = $desc_images = array();
                    foreach($def_img as $i) {
                        $def_images[] = self::get_pro_img($i, $unique_id);
                    }
                    //p($def_images);die;
                    foreach($desc_img as $ii) {
                        $desc_images[$ii] = trim(config_item('base_url'), '/').self::get_desc_img($ii, $unique_id);
                    }
                    //p($desc_images);

                    if($desc_images)
                    {
                        $search = $replace = array();
                        foreach ($desc_images as $key => $item) {
                            $search[] =$key;
                            $replace[] = $item;
                        }
                        $desc = str_replace($search, $replace, $desc);
                    }
                    $desc = preg_replace('/<img[^<^>).]*?src="http:\/\/(?!www\.wunxin).*?>/', '', $desc);
                    $desc = preg_replace('/<b[\s<>br]*r>/', '<br>', $desc);
                    //echo $desc;

                    $info['size'] = $this->get_product_size($match['size']);

                    $info['color'] = $this->get_product_color($match['color']);
                    $skuMap = $this->get_product_skuMap($match['skuMap']);
                    $skuMap = json_decode($skuMap, true);
                    $pro_list = $this->product_format($info, $skuMap);

                    //p($info);
                    //p($pro_list);//die;
                    $insert = array();
                    foreach($pro_list as $kk=> $pp)
                    {
                        $spare = $this->check_unique($kk);
                        if($spare)
                        {   //重复入库
                            $this->up($v['id'], array('up_flag'=>8));
                        }
                        $insert[] = array(
                            'class_id' => $v['cid'],
                            'model_id'=>$product_model_id,
                            'warehouse' => $brand['ename'],
                            'brand_id' =>  $brand['bid'],
                            'uname' =>  $brand['name'],
                            'pname'=>$product_name,
                            'market_price'=> $pp['price'] * 1.1,
                            'sell_price'=>$pp['price'],
                            'style_no'=>md5($unique_id),
                            'keyword'=>$product_name,
                            'def_img'=>$pp['img'],
                            'descr'=>$product_name,
                            'product_taobao_addr'=> $url,
                            'pcontent'=>$desc,
                            'create_time'=>date("Y-m-d H:i:s"),
                            'size_type' => $v['size_type'],
                            'size' => $this->get_product_sizeinfo($pp['size'], $size_conf),
                            'spare' => $kk,
                        );
                    }
                    //p($insert);die;

                    foreach($insert as $insert_item)
                    {
                        $product_size = $insert_item['size'];
                        unset($insert_item['size']);
                        $pro_photo = array();
                        $_def_img = $insert_item['def_img'];
                        $_def_img = $this->get_pro_img($_def_img, $unique_id);
                        unset($insert_item['def_img']);
                        $this->db->insert('product', $insert_item);
                        $tmp_id = $this->db->insert_id();
                        $this->insert_product_size($tmp_id, $product_size);
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
                        $_pro_photo = $this->copy_img($tmp_id, $def_images);
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
                        echo $tmp_id,"\n";
                    }
                    $this->up($v['id'], array('up_flag'=>2));
                    //die;
                }
            }
            else
            {
                break;
            }
        }
    }

    /**
     * 通过url 获取淘宝唯一id
     * @static
     * @param $url
     * @return null
     */
    static function get_unique_id($url)
    {
        $url_arr = parse_url($url);

        $query = $unique_id = NULL;
        parse_str($url_arr['query'], $query);
        if(isset($query['id']))
        {
            $unique_id = $query['id'];
        }
        if($unique_id === NULL)
        {
            return NULL;
        }
        return $unique_id;
    }

    /**
     * 获取带插入产品url
     */
    private function get_product_url($num)
    {
        $query = $this->db->get_where('z_product', array('up_flag' => 1), $num, 0);
        return $query->result_array();
    }

    /**
     * 通过url 获取淘宝产品页面html
     * @static
     * @param $url
     * @param $unique_id
     * @return string
     */
    static private function get_html($url, $unique_id)
    {
        $file_name = md5($url);
        $path = APPPATH . 'cache/taobao/'.intToPath($unique_id);
        $file_path = $path . $file_name;
        recursiveMkdirDirectory($path);

        if(is_file($file_path) && filemtime($file_path) > (time()-self::TIMEOUT))
        {
            $html = file_get_contents($file_path);
        }
        else
        {
            $html = file_get_contents($url, FALSE, stream_context_create(array('http' => array('timeout' => 60))));
            file_put_contents($file_path, $html, LOCK_EX);
        }
        return iconv('GBK', "UTF-8//IGNORE", $html);
    }

    /**
     * 获取分类试用的模型
     * @param $cid
     * @return int
     */
    private function get_class_model_id($cid)
    {
        if(! isset($this->class[$cid]))
        {
            $this->class[$cid] = $this->db->select('model_id')->get_where('product_category', array('class_id' => $cid))->row_array();
        }
        return isset($this->class[$cid]) ? $this->class[$cid]['model_id'] : 0;
    }

    /**
     * @param $size_type
     */
    private function _get_product_size($size_type)
    {
        if(! isset($this->size[$size_type]))
        {
            $this->size[$size_type] = $this->db->select('*')->get_where('size', array('type' => $size_type))->result_array();
        }
        return $this->size[$size_type];
    }

    /**
     * 获取品牌信息
     * @param $bid
     * @return mixed
     */
    private function get_brand($bid)
    {
        if(! isset($this->brand[$bid]))
        {
            $this->brand = $this->db->select('*')->get_where('product_brand', array('bid' => $bid))->result_array('bid');
        }
        return $this->brand[$bid];
    }

    /**
     * 匹配产品号码并获得号码id等
     * @param $pid
     * @param $info
     * @param $size_type
     * @return array
     */
    private function matching_size($pid ,$info, $size_type)
    {
        $size = $this->get_product_size($size_type);
        $result = $scope = array();

        foreach($size as $v)
        {
            $v['name'] = strtoupper($v['name']);
            $scope[$v['name']] = $v['size_id'];
        }

        foreach($info as $vv)
        {
            $key = strtoupper($vv['name']);
            if(isset($scope[$key]))
            {
                $result = array('pid' => $pid, 'size_id' => $scope[$key], 'abbreviation' => $key);
            }
        }
        return $result;
    }

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

    /**
     * 获取产品名称
     * @param $match
     * @return string
     */
    function get_product_name($match)
    {
        $matches = array();
        $result = '';
        preg_match($match, $this->product_html, $matches);
        isset($matches[1]) && $result = trim($matches[1]);
        return $result;
    }

    /**
     * 产品图片
     * @param $match
     * @return array
     */
    function get_product_defimg($match)
    {
        $result = array();
        $matches = array();
        preg_match_all($match, $this->product_html, $matches);
        isset($matches[1]) && $result = $matches[1];
        return $result;
    }

    /**
     * 更新抓取列表
     * @param $id
     * @param $data
     */
    private function up($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('z_product', $data);
    }

    /**
     * 获取产品简介
     * @param string $match
     * @param $unique_id
     * @return mixed|string
     */
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

    static private function get_pro_img($url, $unique_id)
    {
        $file_name = md5($url).'.jpg';
        $path = WEBROOT . '/tmp/taobao_img/' . intToPath($unique_id);
        $file_path = $path . $file_name;
        if(! is_file($file_path)) {
            recursiveMkdirDirectory($path);
            $img = file_get_contents($url, FALSE, stream_context_create(array('http' => array('timeout' => 60))));
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
            $img = file_get_contents($url, FALSE, stream_context_create(array('http' => array('timeout' => 60))));
            file_put_contents($file_path, $img, LOCK_EX);
        }
        //echo $file_path;
        //p(getimagesize($file_path));
        return '/upload/attached/tb_product/' . intToPath($unique_id) . $file_name;
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

    function get_product_skuMap($match)
    {
        $matches = array();
        $result = '';
        preg_match($match, $this->product_html, $matches);
        isset($matches[1]) && $result = trim($matches[1]);
        return trim($result, ',');
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
                    $key = isset($skuMap['skuMap'][$key]) ? $key : ";{$item['id']};{$size['id']};";
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

    /**
     * 获取产品在万象对应的尺码信息
     * @param $product_size
     * @param $size_conf
     * @return array
     */
    function get_product_sizeinfo($product_size, $size_conf)
    {
        $r = array();
        //p($product_size);p($size_conf);
        foreach($product_size as $v)
        {
            $up_name = strtoupper($v['name']);
            if($up_name)
            {
                foreach($size_conf as $vv)
                {
                    if($up_name == strtoupper($vv['name']))
                    {
                        $r[] = array('size_id'=>$vv['size_id'],'abbreviation'=>$vv['abbreviation']);
                    }
                }
            }
        }
        return $r;
    }

    function insert_product_size($pid, $size)
    {
        if (empty ($size) || !is_array($size)) return false;

        foreach($size as $key => $item)
        {
            $size[$key]['pid'] = $pid;
        }
        $this->db->insert_batch('product_size', $size);

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

    function check_unique($spare)
    {
        $this->db->select('spare');
        return $this->db->get_where('product',array('spare'=>$spare), 1, 0)->row_array();
    }

    function get_product_attr($match)
    {
        preg_match($match[0], $this->product_html, $matches);//p($matches);
        $attr = array();
        if(isset($matches[1]) && $matches[1])
        {
            preg_match_all($match[1], $matches[1], $out, PREG_SET_ORDER);

            foreach($out as $v)
            {
                $attr[$v[1]] = self::font_foramt($v[2]);
            }
            $info['attribute'] = $attr;
        }
        return $attr;
    }

    static function font_foramt($str)
    {
        $str = str_replace('&nbsp;', '', $str);
        return preg_replace_callback('/&#(\d+);/', 'self::font', $str);
    }

    static function font($v) {
        return mb_convert_encoding(pack('n', $v[1]), 'UTF-8', 'ucs-2');
        //return iconv('ucs-2', 'UTF-8//ignore', pack('n', $v[1]));
    }

    function insert_product_attr($url, $data)
    {
        $insert = array();
        foreach($data as $k=>$v)
        {
            $insert[] = array('url'=>$url, 'attr_name'=>$k, 'attr_value'=>$v);
        }
        $this->db->insert_batch('z_product_attr', $insert);
    }
}
