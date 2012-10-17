<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-26
 * Time: 下午2:08
 * To change this template use File | Settings | File Templates.
 */
class import extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        ini_set('memory_limit','3072M');
        set_time_limit(0);
    }

    function product()
    {
        $this->load->helper('directory');
        $this->load->database();
        $this->db->select('i.id as img_id, i.shop as warehouse, d.id as data_id, d.name as pname, d.price as sell_price, d.type as size_type, d.sex, l.plink as product_taobao_addr');
        $this->db->from('taobao_product_img i');
        $this->db->join('taobao_product_data d', 'i.link_id = d.id', 'left');
        $this->db->join('taobao_product_link l', 'l.id = d.link_id', 'left');
        $r = $this->db->get()->result_array();
        foreach($r as $v)
        {
            $attr = $this->db->get_where('taobao_product_attr', array('link_id'=>$v['data_id'], '`key` !='=>'颜色', '`key` != '=>'尺码', '`key`  !='=>'品牌'))->result_array();
            $size = $this->db->get_where('taobao_product_size', array('img_id'=>$v['img_id']))->result_array();
            foreach($attr as $va)
            {
                $tmp_attr = $this->getmodel($v['size_type'], $va['key'], $v['sex']);
                $tmp_attr['pid'] = $v['img_id'];
                $tmp_attr['attr_value'] = $va['name'];
                $this->db->insert('product_attr', $tmp_attr);
            }
            //p($size);
            foreach($size as $vs)
            {
                $tmp_size = $this->getsize($v['size_type'], $vs['size']);
                $tmp_size['pid'] = $v['img_id'];
                $this->db->insert('product_size', $tmp_size);
            }

            //将产品信息插入到产品表 wx_product
            {
                $v['pid'] = $v['img_id'];
                $v['style_no'] = md5($v['data_id']);
                $v['create_time'] = date('Y-m-d H:i:s');
                $v['gender'] = $v['sex'];
                $v['sell_price'] = $v['sell_price'] * 100;
                $v['market_price'] = $v['sell_price']*1.1;
                $v['keyword'] = $v['descr'] = $v['pname'];
                unset($v['img_id'], $v['data_id'], $v['sex']);
                if($v['warehouse'] == 'lixiangniandaijn')
                {
                    $v['brand_id'] = 1;
                    $v['uid'] = 1001;
                    $v['uname'] = '理想年代';
                } elseif ($v['warehouse'] == 'lekuchuangxiang') {
                    $v['brand_id'] = 2;
                    $v['uid'] = 1002;
                    $v['uname'] = '乐酷创想';
                } elseif ($v['warehouse'] == 'diqigongshe') {
                    $v['brand_id'] = 3;
                    $v['uid'] = 1003;
                    $v['uname'] = '第七公社';
                }
                $source_file = '/data/m_data/images/' . intToPath($v['pid']) . $v['pid'] . '.jpg';
                $target_path = '/data/www/wunxin/web/upload/product/' . intToPath($v['pid']);
                recursiveMkdirDirectory($target_path);
                $target_file = $target_path . (md5($v['pid']) . '.jpg');
                //copyImg($source_file, 0, 0, $target_file);
                copyImg($source_file, 0, 0, $target_file, $quality = 100, 1.2);
                copyImg($source_file, 350, 420, str_replace(md5($v['pid']).'.jpg', md5($v['pid']).'_M.jpg', $target_file), $quality = 100, 1.2);
                copyImg($source_file, 60, 60, str_replace(md5($v['pid']).'.jpg', md5($v['pid']).'_S.jpg', $target_file), $quality = 90, 1.2);
                copyImg($source_file, 164, 197, str_replace(md5($v['pid']).'.jpg', 'default.jpg', $target_file), $quality = 100, 1.2);
                copyImg($source_file, 50, 50, str_replace(md5($v['pid']).'.jpg', 'icon.jpg', $target_file), $quality = 90, 1.2);
                $this->db->insert('product_photo', array('pid'=>$v['pid'], 'img_addr'=>(md5($v['pid']) . '.jpg'), 'is_default'=>1, 'create_time'=>date('Y-m-d H:i:s')));
                $this->db->insert('product',$v);
            }
            echo $v['pid'],"\n";
            //die;
        }
    }

    private function getmodel($type, $key, $sex)
    {
//        <option value="1" >T恤</option>
//        <option value="2" >卫衣</option>
//        <option value="3" >衬衫</option>
//        <option value="4" >裤子</option>
        if($type==0)
        {
            $type == 1;
        }

        if($sex == 1)
        {
            $model_id = $type * 2 - 1;
        }
        elseif($sex == 2)
        {
            $model_id = $type * 2;
        }
        else
        {
            $model_id = $type * 2 - 1;
        }

        $this->db->select('attr_id, model_id');
        return $this->db->get_where('product_model_attr', array('model_id'=>$model_id, 'attr_name'=>$key))->row_array();
    }

    private function getsize($type, $name)
    {
        $name = strtoupper($name);
        $this->db->select('size_id, abbreviation');
        return $this->db->get_where('size', array('type'=>$type, 'name'=>$name))->row_array();
    }

    function img()
    {
        $this->load->helper('directory');
        $this->load->database();
        $this->db->select('d.link_id as link_id, i.id as img_id');
        $this->db->from('wx_taobao_product_img i');
        $this->db->join('wx_taobao_product_data d', 'i.link_id=d.id', 'left');
        //select d.link_id as link_id, i.id as img_id from `wx_taobao_product_img` i left join `wx_taobao_product_data` d on i.link_id=d.id
        $r = $this->db->get()->result_array();
        //p($r);
        foreach($r as $i)
        {
            $images = $this->db->get_where('taobao_product_img_2', array('link_id'=>$i['link_id']))->result_array();
            foreach($images as $img)
            {
                $source_file = '/data/m_data/append_image/' . intToPath($img['id']) . $img['id'] . '.jpg';
                $target_path = '/data/www/wunxin/web/upload/product/' . intToPath($i['img_id']);
                recursiveMkdirDirectory($target_path);
                $img_name = md5("{$i['img_id']}-{$img['id']}");
                $target_file = $target_path . ($img_name . '.jpg');
                //copyImg($source_file, 0, 0, $target_file);
                copyImg($source_file, 0, 0, $target_file, $quality = 100, 1.2);
                copyImg($source_file, 350, 420, str_replace($img_name.'.jpg', $img_name.'_M.jpg', $target_file), $quality = 100, 1.2);
                copyImg($source_file, 60, 60, str_replace($img_name.'.jpg', $img_name.'_S.jpg', $target_file), $quality = 90, 1.2);
                //copyImg($source_file, 164, 197, str_replace($img_name.'.jpg', 'default.jpg', $target_file), $quality = 100, 1.2);
                //copyImg($source_file, 50, 50, str_replace($img_name.'.jpg', 'icon.jpg', $target_file), $quality = 90, 1.2);
                $this->db->insert('product_photo', array('pid'=>$i['img_id'], 'img_addr'=>($img_name . '.jpg'), 'is_default'=>0, 'create_time'=>date('Y-m-d H:i:s')));
            }
            echo $i['img_id'],"\n";
        }
    }

    public function toDefault()
    {
        $this->load->helper('directory');
        $this->load->database();

        //id, pid, img_addr, is_default, create_time
        $this->db->select('id, pid, img_addr, is_default, create_time');
        $this->db->from('wx_product_photo');
        $this->db->where('is_default', '1');
        $r = $this->db->get()->result_array();

        foreach ($r as $v) {
            $source_file = '/data/m_data/images/' . intToPath($v['pid']) . $v['pid'] . '.jpg';
            $target_path = '/data/www/wunxin/web/upload/product/' . intToPath($v['pid']);
            recursiveMkdirDirectory($target_path);
            $target_file = $target_path . (md5($v['pid']) . '.jpg');
            //copyImg($source_file, 0, 0, $target_file);
            copyImg($source_file, 0, 0, $target_file, $quality = 100, 1.2);
            copyImg($source_file, 350, 420, str_replace(md5($v['pid']).'.jpg', md5($v['pid']).'_M.jpg', $target_file), $quality = 100, 1.2);
            copyImg($source_file, 60, 60, str_replace(md5($v['pid']).'.jpg', md5($v['pid']).'_S.jpg', $target_file), $quality = 90, 1.2);
            copyImg($source_file, 164, 197, str_replace(md5($v['pid']).'.jpg', 'default.jpg', $target_file), $quality = 100, 1.2);
            copyImg($source_file, 50, 50, str_replace(md5($v['pid']).'.jpg', 'icon.jpg', $target_file), $quality = 90, 1.2);
//die;

            echo $v['pid']."\n";
            //copyImg();
        }

//print_r($r);

    }

    function intro_img()
    {
        $this->load->helper('directory');
        $this->load->database();

        $this->db->select('*');
        $this->db->from('taobao_product_relation');
        $r = $this->db->get()->result_array();


        recursiveMkdirDirectory($target_path);

        foreach($r as $v)
        {
            $source_file = '/data/m_data/intro_image/' . intToPath($v['pid']) . $v['pid'] . '.jpg';
            $target_path = '/data/www/wunxin/web';
            $datedir = '/upload/attached/'.date('Y/m/d/');
            $target_file = $datedir . intToPath($v['intor_img_id']);
            $target = $target_path.$target_file;
            echo $target;die;
            copy($source_file, $target);
            if(file_exists($target))
            {
                continue;
            }

        }
    }

}