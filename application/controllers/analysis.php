<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-26
 * Time: 下午2:08
 * To change this template use File | Settings | File Templates.
 */
class analysis extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        ini_set('memory_limit','3072M');
        set_time_limit(0);
    }

    public function nervermore()
    {
        ;
    }

    private $match = array(
        /*'agitation'=>array( //ok
            'name' => '/<input type="hidden" name="title" value="(.*?)" \/>/',            //一个
            'size' => '/<li data-value=".*?"><a href="#"><span>(.*?)<\/span><\/a><\/li>/',   //多个
            'color' => array('/<li data-value=".*?" title="(.*?)".*?>.*?<a href="#" style="background:url\((.*?)_30x30.jpg\) center no-repeat;">/s','<li data-value=".*?" title="(.*?)".*?>'),            //多个
            'price' => '/<strong id="J_StrPrice" >(.*?)<\/strong><span class="yuan">元<\/span>/',                                                              //多个
            'attribute' => array('/<div class="attributes-list".*?>.*?<ul>(.*?)<\/ul>/s','/<li.*?>(.*?):(.*?)<\/li>/'),                                                          //
            'intro' => "/<script>\(function\(url\).*?new Date\(\);\}\)\('(.*?)'\);<\/script>/",
        ),*/
        /*'openyourmind'=>array(//ok
            'name' => '/<h3>(.*?)<\/h3>/',
            'size' => '/<li data-value=".*?".*?>\s?<a href="#">\s?<span>(.*?)<\/span>\s?<\/a>.*?<\/li>/',   //多个
            'color' => '/<li data-value=".*?" title="(.*?)".*?>/',            //多个
            'price' => '/<strong id="J_StrPrice" >(.*?)<\/strong>/',                                                              //多个
            'attribute' => array('/<ul class="attributes-list".*?>\s.*?(.*?)<\/ul>/s','/<li.*?>(.*?):(.*?)<\/li>/'),                                                          //
            'intro' => '//',
        ),*/
        /*'nervermore'=>array(  //ok
            'name' => '/<input type="hidden" name="title" value="(.*?)" \/>/',            //一个
            'size' => '/<li data-value=".*?"><a href="#"><span>(.*?)<\/span><\/a><\/li>/',   //多个
            'color' => array('/<li data-value=".*?" title="(.*?)".*?>.*?<a href="#" style="background:url\((.*?)_30x30.jpg\) center no-repeat;">/s','<li data-value=".*?" title="(.*?)".*?>'),            //多个
            'price' => '/<strong id="J_StrPrice" >(.*?)<\/strong><span class="yuan">元<\/span>/',                                                              //多个
            'attribute' => array('/<div class="attributes-list".*?>.*?<ul>(.*?)<\/ul>/s','/<li.*?>(.*?):(.*?)<\/li>/'),                                                          //
            'intro' => "/<script>\(function\(url\).*?new Date\(\);\}\)\('(.*?)'\);<\/script>/",
        ),*/
        /*'metrue'=>array(  //ok
            'name' => '/<h3>(.*?)<\/h3>/',
            'size' => '/<li data-value=".*?".*?>\s?<a href="#">\s?<span>(.*?)<\/span>\s?<\/a>.*?<\/li>/',   //多个
            'color' => array('/<li data-value=".*?" title="(.*?)".*?>.*?<a href="#" style="background:url\((.*?)_30x30.jpg\) center no-repeat;".*?>/s','<li data-value=".*?" title="(.*?)".*?>'),            //多个
            'price' => '/<strong id="J_StrPrice" >(.*?)<\/strong>/',                                                              //多个
            'attribute' => array('/<ul class="attributes-list".*?>\s.*?(.*?)<\/ul>/s','/<li.*?>(.*?):(.*?)<\/li>/'),                                                          //
            'intro' => '/\(function\(\)\{var s=document.*?s\.src="(.*?)";document.*?<\/script>/s',
        ),*/
        'lixiangniandaijn'=>array( //ok
            'name' => '/<input type="hidden" name="title" value="(.*?)" \/>/',            //一个
            'size' => '/<li data-value=".*?"><a href="#"><span>(.*?)<\/span><\/a><\/li>/',   //多个
            'color' => array('/<li data-value=".*?" title="(.*?)".*?>.*?<a href="#" style="background:url\((.*?)_30x30.jpg\) center no-repeat;">/s','<li data-value=".*?" title="(.*?)".*?>'),            //多个
            'price' => '/<strong id="J_StrPrice" >(.*?)<\/strong><span class="yuan">元<\/span>/',                                                              //多个
            'attribute' => array('/<div class="attributes-list".*?>.*?<ul>(.*?)<\/ul>/s','/<li.*?>(.*?)(?:：|:)(.*?)<\/li>/'),                                                          //
            'intro' => "/<script>\(function\(url\).*?new Date\(\);\}\)\('(.*?)'\);<\/script>/",
        ),
        /*'shanguoyanyi'=>array(  //ok
            'name' => '/<h3>(.*?)<\/h3>/',
            'size' => '/<li data-value=".*?".*?>\s?<a href="#">\s?<span>(.*?)<\/span>\s?<\/a>.*?<\/li>/',   //多个
            'color' => array('/<li data-value=".*?" title="(.*?)".*?>.*?<a href="#" style="background:url\((.*?)_30x30.jpg\) center no-repeat;".*?>/s','<li data-value=".*?" title="(.*?)".*?>'),            //多个
            'price' => '/<strong id="J_StrPrice" >(.*?)<\/strong>/',                                                              //多个
            'attribute' => array('/<ul class="attributes-list".*?>\s.*?(.*?)<\/ul>/s','/<li.*?>(.*?)(?:：|:)(.*?)<\/li>/'),                                                          //
            'intro' => '/\(function\(\)\{var s=document.*?s\.src="(.*?)";document.*?<\/script>/s',
        ),*/
        'lekuchuangxiang'=>array( //ok
            'name' => '/<input type="hidden" name="title" value="(.*?)" \/>/',            //一个
            'size' => '/<li data-value=".*?"><a href="#"><span>(.*?)<\/span><\/a><\/li>/',   //多个
            'color' => array('/<li data-value=".*?" title="(.*?)".*?>.*?<a href="#" style="background:url\((.*?)_30x30.jpg\) center no-repeat;">/s','<li data-value=".*?" title="(.*?)".*?>'),            //多个
            'price' => '/<strong id="J_StrPrice" >(.*?)<\/strong><span class="yuan">元<\/span>/',                                                              //多个
            'attribute' => array('/<div class="attributes-list".*?>.*?<ul>(.*?)<\/ul>/s','/<li.*?>(.*?)(?:：|:)(.*?)<\/li>/'),                                                          //
            'intro' => "/<script>\(function\(url\).*?new Date\(\);\}\)\('(.*?)'\);<\/script>/",
        ),
        /*'tiexueyy'=>array( //ok
            'name' => '/<h3>(.*?)<\/h3>/',
            'size' => '/<li data-value=".*?".*?>\s?<a href="#">\s?<span>(.*?)<\/span>\s?<\/a>.*?<\/li>/',   //多个
            'color' => '/<li data-value=".*?" title="(.*?)".*?>.*?<a href="#" style="background:url\((.*?)_30x30.jpg\) center no-repeat;">/s',
            'price' => '/<strong id="J_StrPrice" >(.*?)<\/strong>/',                                                              //多个
            'attribute' => array('/<ul class="attributes-list".*?>\s.*?(.*?)<\/ul>/s','/<li.*?>(.*?):(.*?)<\/li>/'),                                                          //
            'intro' => '//',
        ),*/
        'diqigongshe'=>array( //ok
            'name' => '/<input type="hidden" name="title" value="(.*?)" \/>/',            //一个
            'size' => '/<li data-value=".*?"><a href="#"><span>(.*?)<\/span><\/a><\/li>/',   //多个
            'color' => array('/<li data-value=".*?" title="(.*?)".*?>.*?<a href="#" style="background:url\((.*?)_30x30.jpg\) center no-repeat;">/s','<li data-value=".*?" title="(.*?)".*?>'),            //多个
            'price' => '/<strong id="J_StrPrice" >(.*?)<\/strong><span class="yuan">元<\/span>/',                                                              //多个
            'attribute' => array('/<div class="attributes-list".*?>.*?<ul>(.*?)<\/ul>/s','/<li.*?>(.*?)(?:：|:)(.*?)<\/li>/'),                                                          //
            'intro' => "/<script>\(function\(url\).*?new Date\(\);\}\)\('(.*?)'\);<\/script>/",
        ),
    );

    public function parse_content()
    {

        $website = $this->input->get('website');
        $match = isset($this->match[$website]) ? $this->match[$website] : false;
        if(!$match)//店铺步存在
        {
            die("Not Found {$website} !");
        }
        $shop_domain = array('shop_domain' => $website);
        $this->load->database();
        $links = $this->db->get_where('taobao_product_link', $shop_domain)->result_array('id');
        if(!$links)//店铺产品为空
        {
            $this->db->close();
            die("This Shop({$website}) Is Empty !");
        }
        //p($links);
        foreach($links as $item)
        {
            $info = array();
            $info['shop'] = $website;
            $info['link_id'] = $item['id'];
            $info['type'] = 0;
            $html = $this->get_content($website, $item['id']);

            //产品名称
            $matches = array();
            preg_match($match['name'], $html, $matches);
            isset($matches[1]) && $info['name'] = trim($matches[1]);
            if(isset($info['name']))
            {
                if ($info['type'] === 0) {
                    $findme = '卫衣';
                    $pos = strpos($info['name'], $findme);
                    $pos !== false && $info['type'] = 1;
                }

                if ($info['type'] === 0) {
                    $findme = '裤';
                    $pos = strpos($info['name'], $findme);
                    $pos !== false && $info['type'] = 2;
                }

                if ($info['type'] === 0) {
                    $findme = '裙';
                    $pos = strpos($info['name'], $findme);
                    $pos !== false && $info['type'] = 3;
                }
            }

            //产品价格
            $matches = array();
            preg_match($match['price'], $html, $matches);
            isset($matches[1]) && $info['price'] = trim($matches[1]);

            //产品简介
            $matches = array();
            preg_match($match['intro'], $html, $matches);
            isset($matches[1]) && $info['intro'] = trim($matches[1]);

            //产品尺寸
            $matches = array();
            preg_match_all($match['size'], $html, $matches);
            isset($matches[1]) && $info['size'] = implode(',', $matches[1]);

            //产品颜色
            $matches = array();
            preg_match_all($match['color'][0], $html, $matches);
            if(isset($matches[1]) && $matches[1])
            {
                $info['color'] = array_combine($matches[1], $matches[2]);
                //$info['color'] = json_encode($c);
            }
            else
            {
                $tmp = array();
                preg_match_all($match['color'][1], $html, $tmp);
                $info['color'] = array_flip($tmp[1]);
            }

            //产品属性
            $matches = array();
            preg_match($match['font_foramt'][0], $html, $matches);//p($matches);
            if(isset($matches[1]) && $matches[1])
            {
                preg_match_all($match['attribute'][1], $matches[1], $out, PREG_SET_ORDER);
                $attr = array();
                foreach($out as $v)
                {
                    $attr[$v[1]] = self::font_foramt($v[2]);
                }
                $info['attribute'] = $attr;
            }
            $this->save($info, $website);
            //$html = str_replace('TShop.renderDesc(desc);', 'alert(desc);TShop.renderDesc(desc);', $html);
            //p($html);
            //die;
            echo $item['id'],'<br>';//die;
        }

    }

    function save($info, $website)
    {
        $attribute = $info['attribute'];unset($info['attribute']);
        $color = $info['color'];unset($info['color']);
        $this->db->insert('taobao_product_data', $info, true);
        $id = $this->db->insert_id();
        if($id)
        {
            foreach($color as $k => $c)
            {
                $img = array();
                $img['link_id'] = $id;
                $img['key'] = $k;
                $img['name'] = $c;
                $img['shop'] = $website;
                $this->db->insert('taobao_product_img', $img, true);
            }

            foreach($attribute as $key => $item)
            {
                $data = array();
                $data['link_id'] = $id;
                $data['key'] = $key;
                $data['name'] = $item;
                $data['shop'] = $website;
                $this->db->insert('taobao_product_attr', $data, true);
            }
        }
    }

    static function font_foramt($str)
    {
        $str = str_replace('&nbsp;', '', $str);
        return preg_replace_callback('/&#(\d+);/', 'foo', $str);
    }


    private function get_content($website, $id)
    {
        //$path = "G:/wamp/www/wunxin/m_data/{$website}/";
        $path = "/data/m_data/".$website.'/';
        $fileName = $path.intToPath($id).'index.html';
        if (!file_exists($fileName)) return false;
        $file_content = file_get_contents($fileName);
        return iconv('GBK', "UTF-8//IGNORE", $file_content);
    }

    /**
     * 共搜索到 1601 个符合条件的商品。 81页
     * 分析http://agitation.tmall.com 分页
     */
    public function agitation_class()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/agitation/class/';
        //$path = 'D:\wamp\www\wunxin\\';
        $limit = 82;
        $start = 1;

        $this->load->model('analysis/model_analysis_agitation', 'agitation');

        for ($i = $start; $i <= $limit; $i++) {
            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName)) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);
            $this->agitation->analysis_class($data);
            $this->agitation->save_class();
            //echo $fileName;exit;
        }
    }

    /**
     * 共搜索到 2393 个符合条件的商品。120页
     * 分析http://nervermore.tmall.com 分页
     */
    public function nervermore_class()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/nervermore/class/';
        //$path = 'D:\wamp\www\wunxin\\';
        $limit = 120;
        $start = 1;

        $this->load->model('analysis/model_analysis_nervermore', 'nervermore');

        for ($i = $start; $i <= $limit; $i++) {
            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName)) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);
            $this->nervermore->analysis_class($data);
            $this->nervermore->save_class();
            //echo $fileName;exit;
        }
    }

    /**
     * 共搜索到 301 个符合条件的商品。16页
     * 分析http://metrue.taobao.com 分页
     */
    public function metrue_class()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/metrue/class/';
        //$path = 'D:\wamp\www\wunxin\\';
        $end = 16;
        $start = 1;

        $this->load->model('analysis/model_analysis_metrue', 'metrue');

        for ($i = $start; $i <= $end; $i++) {
            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName)) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);
            $this->metrue->analysis_class($data);
            $this->metrue->save_class();
            //echo $fileName;exit;
        }
    }

    /**
     * 共搜索到 205 个符合条件的商品。9页
     * 分析http://lixiangniandaijn.tmall.com 分页
     */
    public function lixiangniandaijn_class()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/lixiangniandaijn/class/';
        //$path = 'D:\wamp\www\wunxin\\';
        $end = 9;
        $start = 1;

        $this->load->model('analysis/model_analysis_lixiangniandaijn', 'lixiangniandaijn');

        for ($i = $start; $i <= $end; $i++) {
            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName)) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);
            $this->lixiangniandaijn->analysis_class($data);
            $this->lixiangniandaijn->save_class();
            //echo $fileName;exit;
        }
    }

    /**
     * 共搜索到 141 个符合条件的商品。8页
     * 分析http://shanguoyanyi.tmall.com 分页
     */
    public function shanguoyanyi_class()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/shanguoyanyi/class/';
        //$path = 'D:\wamp\www\wunxin\\';
        $end = 8;
        $start = 1;

        $this->load->model('analysis/model_analysis_shanguoyanyi', 'shanguoyanyi');

        for ($i = $start; $i <= $end; $i++) {
            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName)) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);
            $this->shanguoyanyi->analysis_class($data);
            $this->shanguoyanyi->save_class();
            //echo $fileName;exit;
        }
    }

    /**
     * 共搜索到 1389 个符合条件的商品。58页
     * http://lekuchuangxiang.tmall.com
     */
    public function lekuchuangxiang_class()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/lekuchuangxiang/class/';
        //$path = 'D:\wamp\www\wunxin\\';
        $end = 58;
        $start = 1;

        $this->load->model('analysis/model_analysis_lekuchuangxiang', 'lekuchuangxiang');

        for ($i = $start; $i <= $end; $i++) {
            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName)) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);
            $this->lekuchuangxiang->analysis_class($data);
            $this->lekuchuangxiang->save_class();
            //echo $fileName;exit;
        }
    }

    /**
     * 共搜索到 527 个符合条件的商品。22页
     * http://tiexueyy.taobao.com
     */
    public function tiexueyy_class()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/tiexueyy/class/';
        //$path = 'D:\wamp\www\wunxin\\';
        $end = 22;
        $start = 1;

        $this->load->model('analysis/model_analysis_tiexueyy', 'tiexueyy');

        for ($i = $start; $i <= $end; $i++) {
            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName)) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);
            $this->tiexueyy->analysis_class($data);
            $this->tiexueyy->save_class();
            //echo $fileName;exit;
        }
    }

    /**
     * 第七公社  共搜索到 614 个符合条件的商品。31页
     * http://diqigongshe.tmall.com
     */
    public function diqigongshe_class()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/diqigongshe/class/';
        //$path = 'D:\wamp\www\wunxin\\';
        $end = 31;
        $start = 1;

        $this->load->model('analysis/model_analysis_diqigongshe', 'diqigongshe');

        for ($i = $start; $i <= $end; $i++) {
            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName)) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);
            $this->diqigongshe->analysis_class($data);
            $this->diqigongshe->save_class();
            //echo $fileName;exit;
        }
    }

    /**
     * 共搜索到 527 个符合条件的商品。27页
     * http://jktee.tmall.com
     */
    public function jktee_class()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/jktee/class/';
        //$path = 'D:\wamp\www\wunxin\\';
        $end = 31;
        $start = 1;

        $this->load->model('analysis/model_analysis_jktee', 'jktee');

        for ($i = $start; $i <= $end; $i++) {
            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName)) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);
            $this->jktee->analysis_class($data);
            $this->jktee->save_class();
            //echo $fileName;exit;
        }
    }

    /**
     * 共搜索到 151 个符合条件的商品。8页
     * http://qianxibopin.tmall.com
     */
    public function qianxibopin_class()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/qianxibopin/class/';
        //$path = 'D:\wamp\www\wunxin\\';
        $end = 8;
        $start = 1;

        $this->load->model('analysis/model_analysis_qianxibopin', 'qianxibopin');

        for ($i = $start; $i <= $end; $i++) {
            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName)) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);
            $this->qianxibopin->analysis_class($data);
            $this->qianxibopin->save_class();
            //echo $fileName;exit;
        }
    }
}

function foo($v) {
    return iconv('ucs-2', 'UTF-8', pack('n', $v[1]));
}