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
     * 分析http://lixiangniandaijn.tmall.com 分页
     */
    public function lixiangniandaijn_class()
    {
        //error_reporting(E_ALL ^ E_NOTICE);
        //$path = '/data/m_data/lixiangniandaijn/class/';
        $path = 'D:\wamp\www\wunxin\\';
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
}
