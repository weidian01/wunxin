<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-26
 * Time: 下午4:03
 * To change this template use File | Settings | File Templates.
 */
class Model_Activity_Prize extends MY_Model
{
    /**
     * 奖品添加
     *
     * @param array $data
     * @return boolean
     */
    public function prizeAdd(array $data)
    {
        $info = array(
            'activity_id' => $data['activity_id'],
            'prize_name' => $data['prize_name'],
            'img_addr' => $data['img_addr'],
            'number' => $data['number'],
            'descr' => $data['descr'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('activity_prize', $info);
        return $this->db->insert_id();
    }


    public function prizeEdit(array $data, $pId)
    {
        $info = array(
            'activity_id' => $data['activity_id'],
            'prize_name' => $data['prize_name'],
            'img_addr' => $data['img_addr'],
            'number' => $data['number'],
            'descr' => $data['descr'],
        );

        $this->db->where('id', $pId);
        return $this->db->update('activity_prize', $data);
    }

    /**
     * 获取奖品信息 -- 通过奖品ID
     *
     * @param $pId
     * @return null || array
     */
    public function getPrizeByPid($pId)
    {
        $data = $this->db->select('*')->from('activity_prize')->where('id', $pId)->get()->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取奖品列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getPrizeList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('activity_prize');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取奖品数量
     *
     * @return int
     */
    public function getPrizeCount()
    {
        $this->db->select('*')->from('activity_prize');

        return $this->db->count_all_results();
    }

    /**
     * 获取活动奖品列表
     *
     * @param $activityId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getActivityPrizeList($activityId, $limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('activity_prize');
        $this->db->where('activity_id', $activityId);
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取活动奖品数量
     *
     * @param $activityId
     * @return int
     */
    public function getActivityPrizeCount($activityId)
    {
        $this->db->select('*')->from('activity_prize')->where('activity_id', $activityId);

        return $this->db->count_all_results();
    }

    /**
     * 更新奖品图片
     *
     * @param $file
     * @param $pId
     * @return boolean
     */
    public function updatePrize($file, $pId)
    {
        $data = array(
            'img_addr' => $file,
        );

        $this->db->where('id', $pId);
        return $this->db->update('activity_prize', $data);
    }
    /**
     * 删除奖品
     *
     * @param $pId
     * @return boolean
     */
    public function deletePrize($pId)
    {
        return $this->db->delete('activity_prize', array('id' => $pId));
    }
}
