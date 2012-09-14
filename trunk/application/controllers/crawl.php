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

    public function index() { }

    /**
     * 共搜索到 1601 个符合条件的商品。 81页
     * http://agitation.tmall.com
     */
    public function agitation_class()
    {
        $start = 1;
        $end   = 81;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/agitation/class/');
        $url = 'http://agitation.tmall.com/search.htm?spm=a1z10.3.17.70.fe468b&search=y&viewType=grid&orderType=_coefp&pageNum=%d#anchor';
        $crawl = new crawl_tools($config);

        $num = 1;
        for ($i = $start; $i<= $end; $i++) {
            echo $i."\n";
            if ($num == 20) {$num=1;sleep(10);}

            $urls = sprintf($url, $i);
            $crawl->crawlOne($urls, $i);
            sleep(1);
            $num++;
        }
    }

    /**
     * 共搜索到 1601 个符合条件的商品。 81页
     * http://agitation.tmall.com
     */
    public function agitation()
    {
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/agitation/');
        $crawl = new crawl_tools($config);

        $this->load->model('other/model_crawl_analysis', 'ca');

        $field = 'id, pname, plink';
        $data = $this->ca->getTableProductLink($field, 10000, 0, array('shop_domain' => 'agitation'));

        $i = 1;
        foreach ($data as $v) {
            echo $v['id']."\n";

            $fileName = $config['dir'].intToPath($v['id']).'index.html';
            if (file_exists($fileName) && filesize($fileName) > 30978) {
                continue;
            } else {
                sleep(3);
            }

            if ($i == 50) { $i = 1; sleep(60); }

            if (empty ($v['plink'])) continue;

            $crawl->crawlOne($v['plink'], $v['id']);
            $i++;
            sleep(3);
        }

        unset ($data);
    }

    /**
     * 共搜索到 2393 个符合条件的商品。120页
     * http://nervermore.tmall.com
     */
    public function nervermore_class()
    {
        $start = 1;
        $end   = 120;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/nervermore/class/');
        $url = 'http://nervermore.tmall.com/search.htm?spm=a1z10.3.17.92.524ec4&search=y&viewType=grid&orderType=_hotsell&pageNum=%d#anchor';
        $crawl = new crawl_tools($config);

        $num = 1;
        for ($i = $start; $i<= $end; $i++) {
            echo $i."\n";
            if ($num == 30) {$num = 1; sleep(20);}

            $urls = sprintf($url, $i);
            $crawl->crawlOne($urls, $i);
            sleep(2);
            $num++;
        }
    }

    /**
     * 共搜索到 2393 个符合条件的商品。120页
     * http://nervermore.tmall.com
     */
    public function nervermore()
    {
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/nervermore/');
        $crawl = new crawl_tools($config);

        $this->load->model('other/model_crawl_analysis', 'ca');

        $field = 'id, pname, plink';
        //($field = '*', $limit = 20, $offset = 0, $where = null, $order = null)
        $data = $this->ca->getTableProductLink($field, 10000, 0, array('shop_domain' => 'nervermore'));

        $i = 1;
        foreach ($data as $v) {
            echo $v['id']."\n";

            $fileName = $config['dir'].intToPath($v['id']).'index.html';
            if (file_exists($fileName) && filesize($fileName) > 30978) {
                continue;
            } else {
                sleep(3);
            }

            if ($i == 50) { $i = 1; sleep(20); }

            if (empty ($v['plink'])) continue;

            $crawl->crawlOne($v['plink'], $v['id']);
            $i++;
        }

        unset ($data);
    }

    /**
     * 共搜索到 301 个符合条件的商品。16页
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
            //if ($num == 20) {$num=1;sleep(10);}

            $urls = sprintf($url, $i);
            $crawl->crawlOne($urls, $i);
            sleep(2);
        }
    }

    /**
     * 共搜索到 301 个符合条件的商品。16页
     * http://metrue.taobao.com
     */
    public function metrue()
    {
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/metrue/');
        $crawl = new crawl_tools($config);

        $this->load->model('other/model_crawl_analysis', 'ca');

        $field = 'id, pname, plink';
        $data = $this->ca->getTableProductLink($field, 10000, 0, array('shop_domain' => 'metrue'));

        $i = 1;
        foreach ($data as $v) {
            echo $v['id']."\n";

            $fileName = $config['dir'].intToPath($v['id']).'index.html';
            if (file_exists($fileName) && filesize($fileName) > 30978) {
                continue;
            } else {
                sleep(3);
            }

            if (empty ($v['plink'])) continue;

            if ($i == 50) { $i = 1; sleep(20); }

            $crawl->crawlOne($v['plink'], $v['id']);
            $i++;
        }

        unset ($data);
    }

    /**
     * 理想年代  共搜索到 205 个符合条件的商品。9页
     * http://lixiangniandaijn.tmall.com
     */
    public function lixiangniandaijn_class()
    {
        $start = 1;
        $end   = 9;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/lixiangniandaijn/class/');
        $url = 'http://lixiangniandaijn.tmall.com/search.htm?spm=a1z10.3.17.82.8da7d2&search=y&viewType=grid&orderType=_coefp&pageNum=%d#anchor';
        $crawl = new crawl_tools($config);

        for ($i = $start; $i<= $end; $i++) {
            echo $i."\n";

            $urls = sprintf($url, $i);
            $crawl->crawlOne($urls, $i);
            sleep(2);
        }
    }

    /**
     * 理想年代  共搜索到 205 个符合条件的商品。9页
     * http://lixiangniandaijn.tmall.com
     */
    public function lixiangniandaijn()
    {
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/lixiangniandaijn/');
        $crawl = new crawl_tools($config);

        $this->load->model('other/model_crawl_analysis', 'ca');

        $field = 'id, pname, plink';
        $data = $this->ca->getTableProductLink($field, 10000, 0, array('shop_domain' => 'lixiangniandaijn'));

        $i = 1;
        foreach ($data as $v) {
            echo $v['id']."\n";
            if ($i == 50) { $i = 1; sleep(20); }

            $fileName = $config['dir'].intToPath($v['id']).'index.html';
            if (file_exists($fileName) && filesize($fileName) > 30978) {
                continue;
            } else {
                sleep(3);
            }

            if (empty ($v['plink'])) continue;

            $crawl->crawlOne($v['plink'], $v['id']);
            $i++;
        }

        unset ($data);
    }

    /**
     * 衫国演义  共搜索到 141 个符合条件的商品。8页
     * http://shanguoyanyi.taobao.com
     */
    public function shanguoyanyi_class()
    {
        $start = 1;
        $end   = 8;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/shanguoyanyi/class/');
        $url = 'http://shanguoyanyi.taobao.com/search.htm?spm=a1z10.3.17.73.b29057&search=y&viewType=grid&orderType=_hotsell&pageNum=%d#anchor';
        $crawl = new crawl_tools($config);

        for ($i = $start; $i<= $end; $i++) {
            echo $i."\n";

            $urls = sprintf($url, $i);
            $crawl->crawlOne($urls, $i);
            sleep(2);
        }
    }

    /**
     * 衫国演义  共搜索到 141 个符合条件的商品。8页
     * http://shanguoyanyi.taobao.com
     */
    public function shanguoyanyi()
    {
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/shanguoyanyi/');
        $crawl = new crawl_tools($config);

        $this->load->model('other/model_crawl_analysis', 'ca');

        $field = 'id, pname, plink';
        $data = $this->ca->getTableProductLink($field, 10000, 0, array('shop_domain' => 'shanguoyanyi'));

        $i = 1;
        foreach ($data as $v) {
            echo $v['id']."\n";

            $fileName = $config['dir'].intToPath($v['id']).'index.html';
            if (file_exists($fileName) && filesize($fileName) > 30978) {
                continue;
            } else {
                sleep(3);
            }
            if (empty ($v['plink'])) continue;

            if ($i == 50) { $i = 1; sleep(20); }

            $crawl->crawlOne($v['plink'], $v['id']);
            $i++;
        }

        unset ($data);
    }

    /**
     * 共搜索到 1389 个符合条件的商品。58页
     * http://lekuchuangxiang.tmall.com
     */
    public function lekuchuangxiang_class()
    {
        $start = 1;
        $end   = 58;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/lekuchuangxiang/class/');
        $url = 'http://lekuchuangxiang.tmall.com/search.htm?spm=a1z10.3.17.82.26642&search=y&viewType=grid&orderType=_hotsell&pageNum=%d#anchor';
        $crawl = new crawl_tools($config);

        for ($i = $start; $i<= $end; $i++) {
            echo $i."\n";
            //if ($num == 30) {$num = 1;sleep(20);}

            $urls = sprintf($url, $i);
            $crawl->crawlOne($urls, $i);
            sleep(2);
        }
    }

    /**
     * 共搜索到 1389 个符合条件的商品。58页
     * http://lekuchuangxiang.tmall.com
     */
    public function lekuchuangxiang()
    {
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/lekuchuangxiang/');
        $crawl = new crawl_tools($config);

        $this->load->model('other/model_crawl_analysis', 'ca');

        $field = 'id, pname, plink';
        $data = $this->ca->getTableProductLink($field, 10000, 0, array('shop_domain' => 'lekuchuangxiang'));

        $i = 1;
        foreach ($data as $v) {
            echo $v['id']."\n";

            $fileName = $config['dir'].intToPath($v['id']).'index.html';
            if (file_exists($fileName) && filesize($fileName) > 30978) {
                continue;
            } else {
                sleep(3);
            }

            if (empty ($v['plink'])) continue;

            if ($i == 50) { $i = 1; sleep(20); }

            $crawl->crawlOne($v['plink'], $v['id']);
            $i++;
        }

        unset ($data);
    }

    /**
     * 共搜索到 527 个符合条件的商品。22页
     * http://tiexueyy.taobao.com
     */
    public function tiexueyy_class()
    {
        $start = 1;
        $end   = 22;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/tiexueyy/class/');
        $url = 'http://tiexueyy.taobao.com/search.htm?spm=a1z10.3.17.74.dc655d&search=y&viewType=grid&orderType=_hotsell&pageNum=%d#anchor';
        $crawl = new crawl_tools($config);

        for ($i = $start; $i<= $end; $i++) {
            echo $i."\n";

            $urls = sprintf($url, $i);
            $crawl->crawlOne($urls, $i);
            sleep(2);
        }
    }

    /**
     * 共搜索到 527 个符合条件的商品。22页
     * http://tiexueyy.taobao.com
     */
    public function tiexueyy()
    {
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/tiexueyy/');
        $crawl = new crawl_tools($config);

        $this->load->model('other/model_crawl_analysis', 'ca');

        $field = 'id, pname, plink';
        $data = $this->ca->getTableProductLink($field, 10000, 0, array('shop_domain' => 'tiexueyy'));

        $i = 1;
        foreach ($data as $v) {
            echo $v['id']."\n";

            $fileName = $config['dir'].intToPath($v['id']).'index.html';
            if (file_exists($fileName) && filesize($fileName) > 30978) {
                continue;
            } else {
                sleep(3);
            }

            if (empty ($v['plink'])) continue;

            if ($i == 50) { $i = 1; sleep(20); }

            $crawl->crawlOne($v['plink'], $v['id']);
            $i++;
        }

        unset ($data);
    }

    /**
     * 第七公社  共搜索到 614 个符合条件的商品。31页
     * http://diqigongshe.tmall.com
     */
    public function diqigongshe_class()
    {
        $start = 1;
        $end   = 31;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/diqigongshe/class/');
        $url = 'http://diqigongshe.tmall.com/search.htm?spm=a1z10.3.17.46.4ac2fa&search=y&viewType=grid&orderType=_hotsell&pageNum=%d#anchor';
        $crawl = new crawl_tools($config);

        for ($i = $start; $i<= $end; $i++) {
            echo $i."\n";

            $urls = sprintf($url, $i);
            $crawl->crawlOne($urls, $i);
            sleep(2);
        }
    }

    /**
     * 第七公社  共搜索到 614 个符合条件的商品。31页
     * http://diqigongshe.tmall.com
     */
    public function diqigongshe()
    {
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/diqigongshe/');
        $crawl = new crawl_tools($config);

        $this->load->model('other/model_crawl_analysis', 'ca');

        $field = 'id, pname, plink';
        $data = $this->ca->getTableProductLink($field, 10000, 0, array('shop_domain' => 'diqigongshe'));

        $i = 1;
        foreach ($data as $v) {
            echo $v['id']."\n";

            $fileName = $config['dir'].intToPath($v['id']).'index.html';
            if (file_exists($fileName) && filesize($fileName) > 30978) {
                continue;
            } else {
                sleep(3);
            }

            if (empty ($v['plink'])) continue;

            if ($i == 50) { $i = 1; sleep(20); }

            $crawl->crawlOne($v['plink'], $v['id']);
            $i++;
        }

        unset ($data);
    }

    /**
     * 共搜索到 527 个符合条件的商品。27页
     * http://jktee.tmall.com
     */
    public function jktee_class()
    {
        $start = 1;
        $end   = 27;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/jktee/class/');
        $url = 'http://jktee.tmall.com/search.htm?spm=a1z10.3.17.34.e632f9&search=y&viewType=grid&orderType=_hotsell&pageNum=%d#anchor';
        $crawl = new crawl_tools($config);

        for ($i = $start; $i<= $end; $i++) {
            echo $i."\n";

            $urls = sprintf($url, $i);
            $crawl->crawlOne($urls, $i);
            sleep(2);
        }
    }

    /**
     * 共搜索到 527 个符合条件的商品。27页
     * http://jktee.tmall.com
     */
    public function jktee()
    {
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/jktee/');
        $crawl = new crawl_tools($config);

        $this->load->model('other/model_crawl_analysis', 'ca');

        $field = 'id, pname, plink';
        $data = $this->ca->getTableProductLink($field, 10000, 0, array('shop_domain' => 'jktee'));

        $i = 1;
        foreach ($data as $v) {
            echo $v['id']."\n";

            $fileName = $config['dir'].intToPath($v['id']).'index.html';
            if (file_exists($fileName) && filesize($fileName) > 30978) {
                continue;
            } else {
                sleep(3);
            }

            if (empty ($v['plink'])) continue;

            if ($i == 50) { $i = 1; sleep(20); }

            $crawl->crawlOne($v['plink'], $v['id']);
            $i++;
        }

        unset ($data);
    }

    /**
     * 共搜索到 151 个符合条件的商品。8页
     * http://qianxibopin.tmall.com
     */
    public function qianxibopin_class()
    {
        $start = 1;
        $end   = 8;

        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/qianxibopin/class/');
        $url = 'http://qianxibopin.tmall.com/search.htm?spm=a1z10.3.17.39.325fc9&search=y&viewType=grid&orderType=_hotsell&pageNum=%d#anchor';
        $crawl = new crawl_tools($config);

        for ($i = $start; $i<= $end; $i++) {
            echo $i."\n";

            $urls = sprintf($url, $i);
            $crawl->crawlOne($urls, $i);
            sleep(2);
        }
    }

    /**
     * 共搜索到 151 个符合条件的商品。8页
     * http://qianxibopin.tmall.com
     */
    public function qianxibopin()
    {
        $this->load->helper('crawl_tools');
        $config = array('dir' => '/data/m_data/qianxibopin/');
        $crawl = new crawl_tools($config);

        $this->load->model('other/model_crawl_analysis', 'ca');

        $field = 'id, pname, plink';
        $data = $this->ca->getTableProductLink($field, 10000, 0, array('shop_domain' => 'qianxibopin'));

        $i = 1;
        foreach ($data as $v) {
            echo $v['id']."\n";

            $fileName = $config['dir'].intToPath($v['id']).'index.html';
            if (file_exists($fileName) && filesize($fileName) > 30978) {
                continue;
            } else {
                sleep(3);
            }

            if (empty ($v['plink'])) continue;

            if ($i == 50) { $i = 1; sleep(20); }

            $crawl->crawlOne($v['plink'], $v['id']);
            $i++;
        }

        unset ($data);
    }
}
