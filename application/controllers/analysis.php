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
        'agitation'=>array(
            'name' => '//',
            'size' => '//',
            'color' => '//',
            'price' => '//',
            'attribute' => '//',
            'intro' => '//',
        ),
    );

    public function parse_content()
    {
        $website = $this->input->get('website');
        $match = isset($this->match[$website]) ? $this->match[$website] : false;
        if(!$match)
        {
            die("no Not Found {$website}");
        }
        $links = $this->db->get_where('taobao_product_link', array('shop_domain' => $website))->result_array('id');
        p($links);
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
            $this->lekuchuangxiang->analysis_class($data);
            $this->lekuchuangxiang->save_class();
            //echo $fileName;exit;
        }
    }
}
