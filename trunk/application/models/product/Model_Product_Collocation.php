<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-28
 * Time: 下午5:28
 * To change this template use File | Settings | File Templates.
 */
class Model_Product_Collocation extends MY_Model
{
    /**
     * 添加产品搭配
     *
     * @param array $data
     * @return boolean
     */
    public function pcAdd(array $data)
    {
        $info = array(
            'pid' => $data['pid'],
            'spid' => $data['spid'],
            'sort' => $data['sort'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('product_collocation', $info);
        return $this->db->insert_id();
    }

    /**
     * 修改产品搭配
     *
     * @param array $data
     * @param $pcId
     * @return boolean
     */
    public function pcEdit(array $data, $pcId)
    {
        $info = array(
            'pid' => $data['pid'],
            'spid' => $data['spid'],
            'sort' => $data['sort'],
        );

        $this->db->where('id', $pcId);
        return $this->db->update('product_collocation', $info);
    }

    /**
     * 获取产品搭配信息 -- 通过搭配ID
     *
     * @param $pcId
     * @return null | array
     */
    public function getPcByPcId($pcId)
    {
        $data = $this->db->select('*')->from('product_collocation')->where('id', $pcId)->get()->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取产品搭配列表
     *
     * @param $pId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getProductPcList($pId, $limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('product_collocation');
        $this->db->where('pid', $pId);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取产品搭配数量
     *
     * @param $pId
     * @return int
     */
    public function getProductPcCount($pId)
    {
        $this->db->select('*')->from('product_collocation')->where('pid', $pId);

        return $this->db->count_all_results();
    }

    /**
     * 获取搭配列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getPcList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('product_collocation');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取搭配数量
     *
     * @return int
     */
    public function getPcCount()
    {
        $this->db->select('*')->from('product_collocation');

        return $this->db->count_all_results();
    }

    /**
     * 删除搭配 -- 通过搭配ID
     *
     * @param $pcId
     * @return boolean
     */
    public function deletePcByPcId($pcId)
    {
        return $this->db->delete('product_collocation', array('id' => $pcId));
    }
}
