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

    /**
     * nervermore
     */
    public function nervermore()
    {

    }

    /**
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
     * 分析http://metrue.taobao.com 分页
     */
    public function metrue_class()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/metrue/class/';
        //$path = 'D:\wamp\www\wunxin\\';
        $limit = 82;
        $start = 1;

        $this->load->model('analysis/model_analysis_metrue', 'metrue');

        for ($i = $start; $i <= $limit; $i++) {
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
     * 分析人人影视
     */
    public function yyets_com()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/yyets/';
        //$path = 'D:\wamp\www\dy1010\\';
        $limit = 28000;
        $start = 24001;

        $this->load->model('analysis/yyets_com', 'yyetsCom');

        for ($i = $start; $i <= $limit; $i++) {

            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName) || filesize($fileName) < 18365) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);

            $this->yyetsCom->analysis($data);
            $this->yyetsCom->save();
        }
    }

    /**
     * 分析simplecd分页
     */
    public function simplecd_me_page()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/simplecd/page/';
        //$path = 'D:\wamp\www\dy1010\\';
        $limit = 20400;
        $start = 1;

        $this->load->model('analysis/simplecd_me', 'simplecdMe');

        for ($i = $start; $i <= $limit; $i++) {

            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName) || filesize($fileName) < 18365) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);

            $this->simplecdMe->analysis_page($data);
            $this->simplecdMe->save_page();
        }
    }

    /**
     * 分析simplecd资源
     */
    public function simplecd_me()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        //$path = '/data/m_data/simplecd/';
        $path = 'D:\wamp\www\dy1010\\';
        $limit = 400000;
        $start = 1;

        $this->load->model('analysis/simplecd_me', 'simplecdMe');

        for ($i = $start; $i <= $limit; $i++) {

            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName) || filesize($fileName) < 18365) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);

            $this->simplecdMe->analysis($data);
            $this->simplecdMe->save();
            exit;
        }
    }

    public function simplecd_me_download_link()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        $path = '/data/m_data/simplecd/';
        //$path = 'D:\wamp\www\dy1010\\';
        $limit = 420000;
        $start = 1;

        $this->load->model('analysis/simplecd_me', 'simplecdMe');

        for ($i = $start; $i <= $limit; $i++) {

            $fileName = $path.intToPath($i).'index.html';
            echo $i.'--'.$fileName."\n";//continue;

            if (!file_exists($fileName) || filesize($fileName) < 18365) continue;

            $data = array('file_name' => $fileName, 'source_id' => $i);

            $this->simplecdMe->analysis_download_link($data);
            $this->simplecdMe->save_download_link();
        }
    }
}