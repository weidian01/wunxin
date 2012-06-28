<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_Order_Invoice extends MY_Model
{

    /**
     * @name 增加发票信息
     *
     * @param $uid 用户ID
     * @param $payable 发票抬头
     * @param $content 发票内容
     * @return array
     */
    public function addOrderInvoice($uid, $payable, $content = '1')
    {
        $this->db->update('invoice', array('default' => 0), array('uid' => $uid));

        $data = array(
            'uid' => $uid,
            'invoice_payable' => $payable,
            'invoice_content' => $content,
            'default' => 1,
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
        );

        $this->db->insert('invoice', $data);
        return $this->db->insert_id();
    }

    /**
     * 根据发票id和uid设置为默认
     *
     * @param $invoice_id
     * @param $uid
     * @return bool
     */
    public function setDefaultInvoice($invoice_id, $uid)
    {
        $this->db->update('invoice', array('default' => 1), array('invoice_id' => $invoice_id, 'uid' => $uid));
        if ($this->db->affected_rows()) {
            $this->db->update('invoice', array('default' => 0), array('invoice_id != ' => $invoice_id, 'uid' => $uid));
        }
        return true;
    }

    /**
     * 根据发表号和uid删除备选发票信息
     * @param $invoice_id
     * @param $uid
     */
    public function deleteInvoice($invoice_id, $uid)
    {
        $this->db->delete('invoice', array('invoice_id' => $invoice_id, 'uid' => $uid));
    }

    /**
     * 编辑发票信息
     *
     * @param $invoice_id
     * @param $iInfo
     * @return mixed
     */
    public function editInvoice($invoice_id, $iInfo)
    {
        $data = array(
            'invoice_payable' => $iInfo['invoice_payable'],
            'invoice_content' => $iInfo['invoice_content']
        );

        return $this->db->update('invoice', $data, array('invoice_id != ' => $invoice_id));
    }

    /**
     * 获取发票信息 -- 通过发票ID
     * @param $iId
     * @return null | array
     */
    public function getInvoiceByiId($iId)
    {
        $data = $this->db->select('*')->get_where('invoice', array('invoice_id' => $iId))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户发票信息列表
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserInvoiceByuId($uId, $limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->get_where('invoice', array('uid' => $uId), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户发票信息数量
     *
     * @param $uId
     * @return int
     */
    public function getUserInvoiceCount($uId)
    {
        $this->db->select('*')->from('invoice')->where('uid', $uId);

        return $this->db->count_all_results();
    }
}
