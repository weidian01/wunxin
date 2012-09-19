<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-25
 * Time: 下午5:58
 * To change this template use File | Settings | File Templates.
 */
class crawl_tools
{
    public $dir = '/data/dy1010/';
    public $fileName = 'index.html';
    public $crawlType = 'file'; // file 文件， image 图片

    public function __construct(array $config)
    {
        ini_set('memory_limit','2048M');

        $this->dir = empty ($config['dir']) ? $this->dir : $config['dir'];
        $this->fileName = empty ($config['file_name']) ? $this->fileName : $config['file_name'];
        $this->crawlType = empty ($config['crawl_type']) ? $this->crawlType : $config['crawl_type'];
    }

    /**
     * 抓取单个URL的内容，并写入文件
     *
     * @param $url
     * @param int $id
     * @param bool $isReturn
     * @return bool|string
     */
    public function crawlOne($url, $id = 0, $isReturn = false)
    {
        if (empty($url)) return false;

        $opts = array( 'http'=>array( 'method'=>'GET', 'timeout'=>60 ) );

        $context = stream_context_create($opts);
        $content =file_get_contents($url, false, $context);

        if ($isReturn) {
            return $content;
        }

        return $this->writeContent($content, $id);
    }

    /**
     * 抓取URL列表，并写入文件
     *
     * @param array $urlArray
     * @return array|bool
     */
    public function crawlList(array $urlArray)
    {
        if (empty($urlArray)) return false;

        $return = array();
        $data = array();
        $handle = array();
        $mh = curl_multi_init(); // multi curl handler

        foreach ($urlArray as $k => $url) {
            $ch = curl_init();
            $option = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
                CURLOPT_FOLLOWLOCATION => 1,
                CURLOPT_MAXREDIRS => 7,
                CURLOPT_DNS_USE_GLOBAL_CACHE => true,
                CURLOPT_FAILONERROR => true,
                //CURLOPT_HEADER               => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_DNS_CACHE_TIMEOUT => 3600
            );

            curl_setopt_array($ch, $option); //设置请求选项
            curl_multi_add_handle($mh, $ch); // 把 curl resource 放进 multi curl handler 里
            $handle[$k] = $ch;
        }

        /* 避免CPU 负载100% 的问题 */
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active and $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        /* 读取内容 */
        foreach ($handle as $key => $ch) {
            $content = curl_multi_getcontent($ch);
            if (!empty($content)) {
                $this->writeContent($content, $key);
                $content = '';unset ($content);
            }
        }
        /* 释放 handle*/
        foreach ($handle as $ch) {
            curl_multi_remove_handle($mh, $ch);
        }

        curl_multi_close($mh);

        $urlArray = array();
        //return $return;
    }

    /**
     * 写入内容
     *
     * @param $content
     * @param int $key
     * @return bool|string
     */
    private function writeContent($content, $key = 0)
    {
        if ( empty ($content) ) return false;

        if ($this->crawlType == 'image') {
            $fileName = $key.'.jpg';
        } else {
            $fileName = empty ($this->fileName) ? md5($key) . '.html' : $this->fileName;
        }

        $fileName = $this->getDir($key).$fileName;
        file_put_contents($fileName, $content);

        if (file_exists($fileName)) chmod($fileName, 0777);

        return $fileName;
    }

    /**
     * 获取存储目录
     *
     * @param int $key
     * @return string
     */
    private function getDir($key = 0)
    {
        $middlePath = intToPath($key);

        $path = $this->dir.$middlePath;
        if (!is_dir($path)) {
            $this->createDir($path);
        }

        return $path;
    }

    /**
     * 逐级创建目录
     *
     * @param $path
     * @param int $mode
     * @return bool
     */
    private function createDir($path, $mode = 0777)
    {
        $pathArray = explode('/', $path);
        $nowPath = '';
        array_pop($pathArray);
        foreach ($pathArray as $key => $value) {
            if ('' == $value) {
                unset($pathArray[$key]);
            } else {
                $nowPath .= ($key == 0) ? $value : '/' . $value;

                if (!is_dir($nowPath)) {
                    if (!mkdir($nowPath, $mode)) {
                        mkdir($nowPath, $mode);
                        chmod($nowPath, $mode);
                        return false;
                    } else {
                        chmod($nowPath, $mode);
                    }
                }
            }
        }

        return true;
    }
}