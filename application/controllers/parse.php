<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-26
 * Time: 下午2:08
 * To change this template use File | Settings | File Templates.
 */
class parse extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ini_set('memory_limit','3072M');
        set_time_limit(0);
    }

    function size()
    {
        $this->load->database();
        $list = $this->db->get_where('taobao_product_data', array())->result_array();
        foreach($list as $item)
        {
            $data_id = $item['id'];
            $html_id = $item['link_id'];
            $file_path = $item['shop'];
            $html = $this->get_content($file_path, $html_id);
            $match = array(
            'size' => '/<li data-value="([0-9:]*?)"><a href="#"><span>(.*?)<\/span><\/a><\/li>/',   //多个
            'color' => array('/<li data-value="([0-9:]*?)" title="(.*?)".*?>.*?<a href="#" style="background:url\((.*?)_30x30.jpg\) center no-repeat;">/s','<li data-value="([0-9:]*?)" title="(.*?)".*?>'),            //多个
            );

            $info = array();
            //产品尺寸
            $matches = array();
            preg_match_all($match['size'], $html, $matches);
            isset($matches[1]) && $info['size'] = array_combine($matches[1], $matches[2]);

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
                $info['color'] = array_combine($tmp[1], $tmp[2]);
            }

            foreach($info['color'] as $ck => $color)
            {
                foreach($info['size'] as $sk => $size)
                {
                    $key =  ";{$sk};{$ck};";
                    if (true === strpos($html, $key))
                    {
                        $this->db->select('id');
                        $this->db->from('taobao_product_img');
                        $this->db->where(array('link_id'=>$data_id, 'key'=>trim($color)));
                        $r = $this->db->get()->row_array();
                        var_dump($r);
                        if(isset($r['id']) && $r['id'])
                        {
                            $this->db->insert('taobao_product_size',array('img_id' => $r['id'], "size"=>$size));
                        }
                    }
                }
            }

            die;
        }
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
}
