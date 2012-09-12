<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-9-10
 * Time: 下午11:00
 * To change this template use File | Settings | File Templates.
 */
class model_analysis_metrue extends MY_Model
{
    public $data = array();

    /**
     * 分析metrue分页
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

        preg_match_all('/<div class="desc">\s<a.*?href="(.*?)".*?>(.*?)\s<\/a>\s<\/div>/s', $content, $matches);

        $link = array();
        foreach ($matches[1] as $k=>$v) {
            $link[] = array('pname' => trim($matches[2][$k]), 'plink' => $v);
        }
        $this->data = $link;
        unset ($link);
        //echo '<pre>';print_r($matches);exit;
    }

    /**
     * 保存metrue分页
     */
    public function save_class()
    {
        if (empty ($this->data)) return false;

        foreach ($this->data as $v) {
            $data = array(
                'shop_domain' => 'metrue',
                'pname' => $v['pname'],
                'plink' => $v['plink'],
                'create_time' => date('Y-m-d H:i:s'),
            );

            $this->db->insert('taobao_product_link', $data);
            //return $this->db->insert_id();
        }
    }
}
