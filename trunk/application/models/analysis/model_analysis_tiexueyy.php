<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-9-12
 * Time: 下午6:10
 * To change this template use File | Settings | File Templates.
 */
class model_analysis_tiexueyy extends MY_Model
{
    public $data = array();

    /**
     * 分析tiexueyy分页
     *
     * @param array $arr
     * @return bool
     */
    public function analysis_class(array $arr)
    {
        $content = $this->getFileContent($arr['file_name']);

        if (empty ($content)) return false;

        //来源网站ID
        $this->data['source_id'] = $arr['source_id'];

        preg_match("/<ul class=\"shop-list\">(.*)<\/ul>/sU", $content, $codeBlock);

        preg_match_all('/<div class="desc">\s<a.*?href="(.*?)".*?>(.*?)\s<\/a>\s<\/div>/s', $codeBlock[1], $matches);

        $link = array();
        foreach ($matches[1] as $k=>$v) {
            $link[] = array('pname' => trim($matches[2][$k]), 'plink' => $v);
        }
        //echo count($link)."\n";return;
        $this->data = $link;
        unset ($link);
        //echo '<pre>';print_r($matches);exit;
    }

    /**
     * 保存lekuchuangxiang分页
     */
    public function save_class()
    {
        if (empty ($this->data)) return false;

        foreach ($this->data as $v) {
            $data = array(
                'shop_domain' => 'tiexueyy',
                'pname' => $v['pname'],
                'plink' => $v['plink'],
                'create_time' => date('Y-m-d H:i:s'),
            );

            $this->db->insert('taobao_product_link', $data);
            //return $this->db->insert_id();
        }
    }
}
