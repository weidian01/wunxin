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
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('system_proposal', $data);
        return $this->db->insert_id();
    }

    /**
     * 获取系统建议或意见
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getSystemProposal($limit = 20, $offset = 0)
    {
        return $this->db->get_where('system_proposal', '', $limit, $offset)->array_result();
    }


}
