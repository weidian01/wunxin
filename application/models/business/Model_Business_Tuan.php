<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-27
 * Time: 上午10:43
 * To change this template use File | Settings | File Templates.
 */
class Model_Business_Tuan extends MY_Model
{
    /**
     * 添加团购
     *
     * @param array $data
     * @return boolean
     */
    public function addTuan(array $data)
    {
        $info = array(
            'pid' => $data['pid'],
            'pname' => $data['pname'],
            'img_addr' => $data['img_addr'],
            'sell_price' => $data['sell_price'],
            'tuan_price' => $data['tuan_price'],
            'status' => $data['status'],
            'inventory' => $data['inventory'],
            'tuan_num' => $data['tuan_num'],
            'detail' => $data['detail'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'discount_rate' => $data['discount_rate'],
            'save' => $data['save'],
            'descr' => $data['descr'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('tuan_product', $info);
        return $this->db->insert_id();
    }

    /**
     * 修改团购信息
     *
     * @param array $data
     * @param $tId
     * @return boolean
     */
    public function editTuan(array $data, $tId)
    {
        $info = array(
            'pid' => $data['pid'],
            'pname' => $data['pname'],
            'img_addr' => $data['img_addr'],
            'sell_price' => $data['sell_price'],
            'tuan_price' => $data['tuan_price'],
            'status' => $data['status'],
            'inventory' => $data['inventory'],
            'tuan_num' => $data['tuan_num'],
            'detail' => $data['detail'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'discount_rate' => $data['discount_rate'],
            'save' => $data['save'],
            'descr' => $data['descr'],
        );

        return $this->db->update('tuan_product', $info, array('tuan_id' => $tId));
    }

    /**
     * 获取团购信息 -- 通过团购ID
     *
     * @param $tId
     * @return null | array
     */
    public function getTuanBytId($tId)
    {
        $data = $this->db->select('*')->get_where('tuan_product', array('tuan_id' => $tId))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取团购列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getTuanList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('tuan_product');
        $this->db->limit($limit, $offset);
        $this->db->order_by("create_time", 'desc');
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取团购数量
     *
     * @return int
     */
    public function getTuanCount()
    {
        $this->db->select('*')->from('tuan_product');

        return $this->db->count_all_results();
    }

    /**
     * 更新团购产品图片
     *
     * @param $file
     * @param $tId
     * @return boolean
     */
    public function updateTuanProductImage($file, $tId)
    {
        $data = array(
            'img_addr' => $file,
        );

        $this->db->where('tuan_id', $tId);
        return $this->db->update('tuan_product', $data);
    }
}
