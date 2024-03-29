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
                    if (false !== strpos($html, $key))
                    {
                        $this->db->select('id');
                        $this->db->from('taobao_product_img');
                        $this->db->where(array('link_id'=>$data_id, 'key'=>trim($color)));
                        $r = $this->db->get()->row_array();
                        if(isset($r['id']) && $r['id'])
                        {
                            $this->db->insert('taobao_product_size',array('img_id' => $r['id'], "size"=>$size));
                        }
                    }
                }
            }
            echo $data_id,'<br>';
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

    function sex()
    {
        $this->load->database();
        $list = $this->db->get_where('taobao_product_data', array())->result_array();
        foreach($list as $item)
        {
            $sex = 0;
            if(false !== strpos($item['name'], '男'))
            {
                $sex = 1;
            }
            if(false !== strpos($item['name'], '女'))
            {
                $sex = 2;
            }
            if(false !== strpos($item['name'], '情侣'))
            {
                $sex = 3;
            }
            if(false !== strpos($item['name'], '亲子'))
            {
                $sex = 4;
            }

            if($sex == 0)
            {
                $n = $v = false;
                if(false !== strpos($item['size'], '男'))
                {
                    $n = true;
                }
                if(false !== strpos($item['size'], '女'))
                {
                    $v = true;
                }

                if($n && $v)
                {
                    $sex = 5;
                }
                elseif($n)
                {
                    $sex = 1;
                }elseif($v)
                {
                    $sex = 2;
                }
            }
            $this->db->where('id', $item['id']);
            $this->db->update('taobao_product_data', array('sex'=>$sex));

        }
    }


    function type()
    {
        $this->load->database();
        $list = $this->db->get_where('taobao_product_data', array())->result_array();
        foreach($list as $item)
        {
            $type = 0;
            if(false !== strpos($item['name'], '恤'))
            {
                $type = 1;
            }
            if(false !== strpos($item['name'], '卫衣'))
            {
                $type = 2;
            }
            if(false !== strpos($item['name'], '衬衫'))
            {
                $type = 3;
            }
            if(false !== strpos($item['name'], '裤'))
            {
                $type = 4;
            }
            $this->db->where('id', $item['id']);
            $this->db->update('taobao_product_data', array('type'=>$type));

        }
    }


    private $match = array(
        'lixiangniandaijn'=>array( //ok
            0=>'/<ul id="J_UlThumb" class="tb-thumb tb-clearfix">(.*?)<\/ul>/s',
            1=>'/<img src="(.*?)_60x60.jpg" \/>/',
        ),
        'lekuchuangxiang'=>array( //ok
            0=>'/<ul id="J_UlThumb" class="tb-thumb tb-clearfix">(.*?)<\/ul>/s',
            1=>'/<img src="(.*?)_60x60.jpg" \/>/',
        ),
        'diqigongshe'=>array( //ok
            0=>'/<ul id="J_UlThumb" class="tb-thumb tb-clearfix">(.*?)<\/ul>/s',
            1=>'/<img src="(.*?)_60x60.jpg" \/>/',
        ),
    );

    function img()
    {
        $this->load->database();
        $range = array('lixiangniandaijn','lekuchuangxiang','diqigongshe');
        foreach($range as $shop)
        {
            $list = $this->db->get_where('wx_taobao_product_link', array('shop_domain'=>$shop))->result_array();
            $match = $this->match[$shop];
            foreach($list as $v)
            {
                $html = $this->get_content($shop, $v['id']);
                $matches = array();
                preg_match($match[0], $html, $matches);
                //isset($matches[1]) && $info['intro'] = trim($matches[1]);
                if(isset($matches[1]) && $matches[1])
                {
                    preg_match_all($match[1], $matches[1], $out);
                    if(isset($out[1]) && $out[1])
                    {
                        foreach($out[1] as $img)
                        {
                            $this->db->insert('taobao_product_img_2',array('link_id'=>$v['id'], 'name'=>$img, 'shop'=>$shop));
                        }
                    }
                }
                echo $v['id'], "\n";
            }
        }
    }
}
