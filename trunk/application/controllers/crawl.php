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
    public function agitation_class()
    {
        $start = 1;
        $end   = 82;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/agitation/class/');

        $url = 'http://agitation.tmall.com/search.htm?spm=a1z10.3.17.70.fe468b&search=y&viewType=grid&orderType=_coefp&pageNum=%d#anchor';

        $crawl = new crawl_tools($config);

        for ($i = $start; $i<= $end; $i++) {
            echo $i."\n";

            $urls = sprintf($url, $i);
            //echo $urls."<br/>";continue;
            $crawl->crawlOne($urls, $i);
            sleep(1);
        }
    }

    /**
     * http://agitation.tmall.com
     */
    public function agitation()
    {
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/agitation/');
        $crawl = new crawl_tools($config);

        $this->load->model('other/model_crawl_analysis', 'ca');

        $field = 'id, pname, plink';
        //($field = '*', $limit = 20, $offset = 0, $where = null, $order = null)
        $data = $this->ca->getTableProductLink($field, 10000, 0, array('shop_domain' => 'agitation'));

        $i = 1;
        foreach ($data as $v) {
            echo $v['id']."\n";

            if ($i == 100) {
                $i = 1;
                sleep(60);
            }

            if (empty ($v['plink'])) continue;

            $crawl->crawlOne($v['plink'], $v['id']);
            //sleep(2);
            $i++;
        }

        unset ($data);
    }

    /**
     * http://metrue.taobao.com
     */
    public function metrue_class()
    {
        $start = 1;
        $end   = 16;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/metrue/class/');

        $url = 'http://metrue.taobao.com/search.htm?spm=a1z10.3.17.50.dac1bb&search=y&viewType=grid&orderType=_hotsell&pageNum=%d#anchor';

        $crawl = new crawl_tools($config);

        for ($i = $start; $i<= $end; $i++) {
            echo $i."\n";

            $urls = sprintf($url, $i);
            //echo $urls."<br/>";continue;
            $crawl->crawlOne($urls, $i);
            usleep(300000);
        }
    }

    /**
     * http://metrue.taobao.com
     */
    public function metrue()
    {
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/metrue/');
        $crawl = new crawl_tools($config);

        $this->load->model('other/model_crawl_analysis', 'ca');

        $field = 'id, pname, plink';
        //($field = '*', $limit = 20, $offset = 0, $where = null, $order = null)
        $data = $this->ca->getTableProductLink($field, 10000, 0, array('shop_domain' => 'metrue'));

        $i = 1;
        foreach ($data as $v) {
            echo $v['id']."\n";

            if (empty ($v['plink'])) continue;

            if ($i == 100) {
                $i = 1;
                sleep(30);
            }

            $crawl->crawlOne($v['plink'], $v['id']);
            usleep(300000);
            $i++;
        }

        unset ($data);
    }
}
