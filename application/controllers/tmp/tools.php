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
        $data = $this->db->get_where('wx_z_product_value')->result_array();

        foreach ($data as $v) {
            $pAddr = trim($v['url']);

            $pData = $this->db->select('pid, model_id, product_taobao_addr')->get_where('wx_product', array('product_taobao_addr' => $pAddr))->row_array();
            if (empty ($pData)) {

                echo '产品不存在:',$v['id'],$v['url'].'<br/>';
                //ob_flush();
                //flush();
                //continue;
            } else {
                $t = $this->db->get_where('wx_product_attrs', array('pid' => $pData['pid'], 'value_id' => $v['value_id']))->result_array();
                if (empty ($t)) {
                    $iData = array(
                        'pid' => $pData['pid'],
                        'attr_id' => $v['attr_id'],
                        'model_id' => $pData['model_id'],
                        'value_id' => $v['value_id'],
                    );

                    $this->db->insert('wx_product_attrs', $iData);
                }
            }

            //$sql = "insert into wx_product_attrs(pid,attr_id,model_id,value_id) values()";


        }

    }
}
