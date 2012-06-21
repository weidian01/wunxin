<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-18
 * Time: 下午6:29
 * To change this template use File | Settings | File Templates.
 */
class Model_Order_Express extends MY_Model
{
    /**
     * 获取配货和快递公司信息 -- 通过订单号
     * @param $orderSn
     * @return null | array
     */
    public function getPickingAndExpressCompanyByOrderSn($orderSn)
    {
        $this->db->select('*');
        $this->db->from('picking');
        $this->db->join('express_delivery_company', 'picking.ed_id = express_delivery_company.ed_id', 'left');
        $this->db->where('picking.order_sn', $orderSn);
        $this->db->where('express_delivery_company.status', 1);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取快递公司列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getExpressCompany($limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->from('express_delivery_company')->where('status', 1)->limit($limit, $offset)->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取快递公司数量
     *
     * @return int
     */
    public function getExpressCompanyCount()
    {
        $this->db->select('*')->from('express_delivery_company')->where('status', 1);

        return $this->db->count_all_results();
    }

    /**
     * 获取快递公司信息
     *
     * @param $id
     * @return null | array
     */
    public function getExpressCompanyById($id)
    {
        $data = $this->db->select('*')->from('express_delivery_company')->where('ed_id', $id)->where('status', 1)->get()->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 添加快递公司
     *
     * @param array $eData
     * @return boolean
     */
    public function addExpressCompany(array $eData)
    {
        $data = array(
            'name' => $eData['name'],
            'descr' => $eData['descr'],
            'website' => $eData['website'],
            'sort' => $eData['sort'],
            'status' => 1,
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('express_delivery_company', $data);
        return $this->db->insert_id();
    }

    /**
     * 编辑快递公司
     *
     * @param array $eData
     * @param $eId
     * @return boolean
     */
    public function editExpress(array $eData, $eId)
    {
        $data = array(
            'name' => "'".$eData['name']."'",
            'descr' => "'".$eData['descr']."'",
            'website' => "'".$eData['website']."'",
            'sort' => $eData['sort'],
        );

        $this->db->where('ed_id', $eId);
        return $this->db->set($data, '', false)->update('express_delivery_company');
    }

    /**
     * 删除快递公司
     *
     * @param $eId
     * @return boolean
     */
    public function deleteExpress($eId)
    {
        $data = array('status' => 0);
        $this->db->where('ed_id', $eId);
        return $this->db->set($data, '', false)->update('express_delivery_company');
    }
}
