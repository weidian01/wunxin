<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-25
 * Time: 下午7:14
 * To change this template use File | Settings | File Templates.
 */
class crawl extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        ini_set('memory_limit','2048M');
        set_time_limit(0);
    }

    public function index()
    {
        $this->load->helper('html_dom');
        echo __METHOD__;
        $html = file_get_contents('http://nervermore.tmall.com/search.htm?pageNum=1');

//        <div class="desc">
//        <a data-spm-anchor-id="a1z10.3.17.33" data-spm-wangpu-module-id="17-5399066998" target="_blank" href="http://detail.tmall.com/item.htm?spm=a1z10.3.17.33.2e72c8&amp;id=13785149680&amp;" class="permalink" style="">
//        大力水手 情侣装 情侣 T恤 短袖 纯棉 夏装 2012韩版卡通休闲宽松
//        </a>
//        </div>
        preg_match_all('/<div class="desc">\s<a.*?href="(.*?)".*?>.*?\s<\/a>\s<\/div>/s', $html, $matches);
        echo '<pre>';print_r($matches);
    }

    /**
     * http://nervermore.tmall.com
     */
    public function nervermore()
    {
        set_time_limit(0);
        $limit = 10;
        $start = 1;
        $end   = 119;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/nervermore/');
        //$config = array('dir' => 'G:\\wamp\\www\\wunxin\\m_data\\nervermore\\');

        $url = 'http://nervermore.tmall.com/search.htm?pageNum=';

        for ($i = $start; $i <= $end; $i++)
        {
            $html = file_get_contents($url.$i);
            preg_match_all('/<div class="desc">\s<a.*?href="(.*?)".*?>.*?\s<\/a>\s<\/div>/s', $html, $matches);
            //echo '<pre>';print_r($matches);
            $crawl = new crawl_tools($config);
            $urlArray = array();

            foreach($matches[1] as $item)
            {
                $uri = parse_url($item);
                parse_str($uri['query'], $pram);
                //* 抓取漏抓的页面
                $fileName = $config['dir'].intToPath($pram['id']).'index.html';
                if (file_exists(($fileName))) continue;
                //*/
        	    $urlArray[$pram['id']] = $item;
            }
            //echo '<pre>';print_r($urlArray);die;//continue;
            if (empty ($urlArray)) continue;
            $crawl->crawlList($urlArray);
            unset ($crawl);
        }
    }

    /**
     * http://agitation.tmall.com
     */
    public function agitation()
    {
        $limit = 2;
        $start = 1;
        $end   = 81;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/agitation/class/');

        $url = 'http://agitation.tmall.com/search.htm?spm=a1z10.3.17.70.fe468b&search=y&viewType=grid&orderType=_coefp&pageNum=%d#anchor';

        for ($i = $start; $i < $end; $i = $i + $limit)
        {
            $crawl = new crawl_tools($config);
            echo $i."\n";
            echo $i+$limit."\n";
            $urlArray = array();

            for ($ii = $i; $ii <= $i+$limit; $ii++)
            {
                //* 抓取漏抓的页面
                $fileName = $config['dir'].intToPath($ii).'index.html';
                if (file_exists(($fileName))) continue;
                //*/

                $urlArray[$ii] = sprintf($url, $ii);
            }
            //echo '<pre>';print_r($urlArray);continue;

            //*抓取漏抓的页面
            if (empty ($urlArray)) continue;
            //*/
            usleep(100000);
            $crawl->crawlList($urlArray);
            unset ($crawl);
        }

    }

    /**
     * iverycd.com
     */
    public function iverycd_com()
    {
        //http://www.iverycd.com/details/354587/
        $limit = 100;
        $start = 11;
        $end   = 354900;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/iverycd/');

        $url = 'http://www.iverycd.com/details/%d/';

        for ($i = $start; $i < $end; $i = $i + $limit)
        {
            //$this->load->library('crawl_tools', $config);
            $crawl = new crawl_tools($config);
            echo $i."\n";
            //echo $i+$limit."\n";
            $urlArray = array();

            for ($ii = $i; $ii < $i+$limit; $ii++)
            {
                //* 抓取漏抓的页面
                $fileName = $config['dir'].intToPath($ii).'index.html';
                if (file_exists(($fileName))) continue;
                //*/

        	    $urlArray[$ii] = sprintf($url, $ii);
            }
            //echo '<pre>';print_r($urlArray);continue;

            //*抓取漏抓的页面
            if (empty ($urlArray)) continue;
            //*/

            $crawl->crawlList($urlArray);
            $crawl ='';unset ($crawl);
        }
    }

    /**
     * yyets.com
     */
    public function yyets_com()
    {
        $limit = 100;
        $start = 24001;
        $end   = 28000;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/yyets/');

        $url = 'http://www.yyets.com/php/resource/%d';

        for ($i = $start; $i < $end; $i = $i + $limit)
        {
            //$this->load->library('crawl_tools', $config);
            $crawl = new crawl_tools($config);
            echo $i."\n";
            //echo $i+$limit."\n";
            $urlArray = array();

            for ($ii = $i; $ii < $i+$limit; $ii++)
            {
                //* 抓取漏抓的页面
                $fileName = $config['dir'].intToPath($ii).'index.html';
                if (file_exists(($fileName))) continue;
                //*/

        	    $urlArray[$ii] = sprintf($url, $ii);
            }
            //echo '<pre>';print_r($urlArray);continue;

            //*抓取漏抓的页面
            if (empty ($urlArray)) continue;
            //*/

            $crawl->crawlList($urlArray);
            $crawl ='';unset ($crawl);
        }
    }

    /**
     * 抓取simplecd 分页页面
     */
    public function simplecd_me_page()
    {
        $limit = 30;
        $start = 1;
        $end   = 20400;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/simplecd/page/');

        $url = 'http://simplecd.me/category/?page=%d';

        for ($i = $start; $i <= $end; $i = $i + $limit)
        {
            //$this->load->library('crawl_tools', $config);
            $crawl = new crawl_tools($config);
            echo $i."\n";
            //echo $i+$limit."\n";
            $urlArray = array();

            for ($ii = $i; $ii < $i+$limit; $ii++)
            {
                //* 抓取漏抓的页面
                $fileName = $config['dir'].intToPath($ii).'index.html';
                if (file_exists($fileName) && filesize($fileName) > 15000) continue;
                //*/

        	    $urlArray[$ii] = sprintf($url, $ii);
            }
            //echo '<pre>';print_r($urlArray);continue;

            //*抓取漏抓的页面
            if (empty ($urlArray)) continue;
            //*/

            $crawl->crawlList($urlArray);
            $crawl ='';unset ($crawl);
        }
    }

    /**
     * 抓取simplecd 页面 simplecd.me
     */
    public function simplecd_me()
    {
        $limit = 30;
        $start = 0;
        $end   = 420000;

        $this->load->model('tools');
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/simplecd/');

        //$url = 'http://www.2tu.cc/Html/GP%d.html';

        for ($i = $start; $i < $end; $i = $i + $limit)
        {
            $crawl = new crawl_tools($config);
            //echo $i."\n";
            //echo $i+$limit."\n";
            $urlArray = array();

            echo $limit.'--'.$i."\n";//continue;
            $field = 'id, source_link';
            $data = $this->tools->getSimpleCdLinkList($field, $limit, $i);
//print_r($data);
            if ( empty ($data) ) continue;
            //print_r($data);exit;

            foreach ($data as $v)
            {
                if (empty ($v['source_link'])) continue;

                //* 抓取漏抓的页面
                $fileName = $config['dir'].intToPath($v['id']).'index.html';
                if (file_exists($fileName) && filesize($fileName) > 15000) continue;
                //*/

        	    $urlArray[$v['id']] = 'http://simplecd.me'.$v['source_link'];//sprintf($url, $ii);
            }
            //echo '<pre>';print_r($urlArray);exit;//continue;

            //*抓取漏抓的页面
            if (empty ($urlArray)) continue;
            //*/

            $crawl->crawlList($urlArray);
            unset ($crawl);
        }
    }

    /**
     * 抓取simplecd 下载链接页面 simplecd.me
     */
    public function simplecd_me_download_link()
    {
        $limit = 30;
        $start = 0;
        $end   = 4200000;

        $this->load->model('tools');
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/simplecd/download_link/');

        //$url = 'http://www.2tu.cc/Html/GP%d.html';

        for ($i = $start; $i < $end; $i = $i + $limit)
        {
            $crawl = new crawl_tools($config);
            //echo $i."\n";
            //echo $i+$limit."\n";
            $urlArray = array();

            echo $limit.'--'.$i."\n";//continue;
            $field = 'id, source_download_link';
            $data = $this->tools->getSimpleCdDownloadLinkList($field, $limit, $i);

            if ( empty ($data) ) continue;
            //print_r($data);exit;

            foreach ($data as $v)
            {
                if (empty ($v['source_download_link'])) continue;

                //* 抓取漏抓的页面
                $fileName = $config['dir'].intToPath($v['id']).'index.html';
                if (file_exists($fileName) && filesize($fileName) > 15000) continue;
                //*/

        	    $urlArray[$v['id']] = $v['source_download_link'];//sprintf($url, $ii);
            }
            //echo '<pre>';print_r($urlArray);exit;//continue;

            //*抓取漏抓的页面
            if (empty ($urlArray)) continue;
            //*/

            $crawl->crawlList($urlArray);
            unset ($crawl);
        }
    }
}
