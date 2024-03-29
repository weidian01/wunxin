<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-6
 * Time: 下午9:47
 * To change this template use File | Settings | File Templates.
 */
class Model_System_Proposal extends MY_Model
{
    /**
     * 添加一条系统建议或意见
     *
     * @param array $sInfo
     * @return boolean
     */
    public function addSystemProposal(array $sInfo)
    {
        $data = array(
            'title' => $sInfo['title'],
            'content' => $sInfo['content'],
            'uid' => $sInfo['uid'],
            'uname' => $sInfo['uname'],
            'realname' => $sInfo['realname'],
            'telecall' => $sInfo['telecall'],
            'email' => $sInfo['email'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('system_proposal', $data);
        return $this->db->insert_id();
    }

    /**
     * 获取系统建议或意见列表
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getSystemProposalList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('system_proposal');
        $this->db->limit($limit, $offset);
        $this->db->order_by('create_time', 'desc');
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取系统建议或意见数量
     *
     * @return int
     */
    public function getSystemProposalCount()
    {
        $this->db->select('*')->from('system_proposal');

        return $this->db->count_all_results();
    }

    /**
     * 获取用户提供的系统建议或意见
     *
     * @param $uId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getUserSystemProposal($uId, $limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('system_proposal')->where('uid', $uId);
        $this->db->limit($limit, $offset);
        $this->db->order_by('create_time', 'desc');
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取用户提供的系统建议或意见数量
     *
     * @param $uId
     * @return int
     */
    public function getUserSystemProposalCount($uId)
    {
        $this->db->select('*')->from('system_proposal')->where('uid', $uId);

        return $this->db->count_all_results();
    }

    /**
     * 删除系统建议与意见
     *
     * @param $sId
     * @return boolean
     */
    public function deleteSystemProposal($sId)
    {
        return $this->db->delete('system_proposal', array('id' => $sId));
    }
}
