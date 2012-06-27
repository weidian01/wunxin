<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-27
 * Time: 上午9:10
 * To change this template use File | Settings | File Templates.
 */
class Model_Design_Vote extends MY_Model
{
    /**
     * 添加设计图投票
     *
     * @param array $data
     * @return boolean
     */
    public function addVote(array $data)
    {
        $info = array(
            'uid' => $data['uid'],
            'uname' => $data['uname'],
            'did' => $data['did'],
            'score' => $data['score'],
            'ip' => $data['ip'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('design_vote', $info);
        return $this->db->insert_id();
    }

    /**
     * 获取投票信息 -- 通过投票ID
     *
     * @param $vId
     * @return null | array
     */
    public function getVoteByVid($vId)
    {
        $data = $this->db->select('*')->get_where('design_vote', array('score_id' => $vId))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取设计图投票列表
     *
     * @param $dId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getVoteByDid($dId, $limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->get_where('design_vote', array('did' => $dId), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取设计图投票数量
     *
     * @param $dId
     * @return int
     */
    public function getDesignVoteCount($dId)
    {
        $this->db->from('design_vote');
        $this->db->where('did', $dId);
        return $this->db->count_all_results();
    }

    /**
     * 获取投票列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getVoteList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('design_vote');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取投票数量
     *
     * @return int
     */
    public function getVoteCount()
    {
        $this->db->select('*')->from('design_vote');

        return $this->db->count_all_results();
    }

    /**
     * 删除投票 -- 通过投票ID
     *
     * @param $vId
     * @return boolean
     */
    public function deleteVoteByvId($vId)
    {
        return $this->db->delete('design_vote', array('score_id' => $vId));
    }

    /**
     * 删除投票 -- 通过设计图ID
     *
     * @param $dId
     * @return boolean
     */
    public function deleteVoteBydId($dId)
    {
        return $this->db->delete('design_vote', array('did' => $dId));
    }
}
