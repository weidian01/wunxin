<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-12-10
 * Time: 上午10:32
 * To change this template use File | Settings | File Templates.
 */
class tools extends MY_Controller
{
    /**
     * 导入产品属性
     */
    public function exportProductAttr()
    {
        set_time_limit(0);
        //ob_start();
        $data = $this->db->get_where('wx_z_product_attr', array('id >' => 22195) )->result_array();

        foreach ($data as $v) {
            $pAddr = trim($v['url']);

            $pData = $this->db->select('pid, model_id, product_taobao_addr')->get_where('wx_product', array('product_taobao_addr' => $pAddr))->result_array();
            if (empty ($pData)) {

                echo '产品不存在:',$v['id'],$v['url'].'<br/>';
                //ob_flush();
                //flush();
                //continue;
            } else {
                //p($pData);exit;
                foreach ($pData as $pv) {
                    if (!$pv['model_id']){
                        p($pData);exit;
                    }
                    $t = $this->db->get_where('wx_product_attrs', array('pid' => $pv['pid'], 'value_id' => $v['value_id']))->row_array();
                    if (empty ($t)) {
                        $iData = array(
                            'pid' => $pv['pid'],
                            'attr_id' => $v['attr_id'],
                            'model_id' => $pv['model_id'],
                            'value_id' => $v['value_id'],
                        );

                        $this->db->insert('wx_product_attrs', $iData);
                    } else {
                        //p($t);exit;
                        echo 'error:',$t['pid'],'<br/>';
                    }
                }

            }
        }
    }

    /**
     * 导出产品默认属性 -- 品类
     */
    public function exportProductDefaultAttr()
    {
        $pData = $this->db->select('pid, class_id, model_id')->get_where('wx_product', array('pid >' => 1604) )->result_array();

        foreach ($pData as $v) {
            $tmp = array('pid' => $v['pid'], 'attr_id' => 175, 'model_id' => $v['model_id']);
            switch ($v['model_id']) {
                case 1: $tmp['value_id'] = 288;break;//T恤
                case 3: $tmp['value_id'] = 289 ;break;//卫衣
                case 5: $tmp['value_id'] = 302 ;break;//衬衫
                case 7: $tmp['value_id'] = 291 ;break;//裤装
                case 9: $tmp['value_id'] = 292 ;break;//POLO衫
                case 11: $tmp['value_id'] = 290 ;break;//棉服
                case 13: $tmp['value_id'] = 294 ;break;//背心
                case 15: $tmp['value_id'] = 295 ;break;//裙装
            }

            $this->db->insert('wx_product_attrs', $tmp);


        }
    }
}
