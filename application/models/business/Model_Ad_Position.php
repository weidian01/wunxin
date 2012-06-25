<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-25
 * Time: 上午9:26
 * To change this template use File | Settings | File Templates.
 */
class Model_Ad_Position extends MY_Model
{
    /**
     * 获取广告位置列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getPositionList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('advert_position');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        if (empty ($data)) {
            return null;
        }

        foreach ($data as $v) {
            $tData[$v['position_id']] = $v;
        }
        unset ($data);

        return empty ($tData) ? null : $tData;
    }

    /**
     * 获取广告位置数量
     *
     * @return int
     */
    public function getPositionCount()
    {
        $this->db->select('*')->from('advert_position');

        return $this->db->count_all_results();
    }

    /**
     * 获取广告位置 -- 通过位置ID
     *
     * @param $pId
     * @return null | array
     */
    public function getPositionByPid($pId)
    {
        $data = $this->db->select('*')->from('advert_position')->where('position_id', $pId)->get()->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 添加广告位置
     *
     * @param array $data
     * @return boolean
     */
    public function positionAdd(array $data)
    {
        $info = array(
            'name' => $data['name'],
            'width' => $data['width'],
            'height' => $data['height'],
            'status' => $data['status'],
            'view_num' => $data['view_num'],
            'descr' => $data['descr'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('advert_position', $info);
        return $this->db->insert_id();
    }

    /**
     * 修改广告位置
     *
     * @param array $data
     * @param $pId
     * @return boolean
     */
    public function positionEdit(array $data, $pId)
    {
        $info = array(
            'name' => $data['name'],
            'width' => $data['width'],
            'height' => $data['height'],
            'status' => $data['status'],
            'view_num' => $data['view_num'],
            'descr' => $data['descr'],
        );

        $this->db->where('position_id', $pId);
        return $this->db->update('advert_position', $info);
    }

    /**
     * 广告位置删除
     *
     * @param $pId
     * @return boolean
     */
    public function positionDelete($pId)
    {
        return $this->db->delete('advert_position', array('position_id' => $pId));
    }

    /**
     * 检测此广告位置下是否有广告
     *
     * @param $pId
     * @return bool
     */
    public function isExistAd($pId)
    {
        $this->db->select('*')->from('advert')->where('position_id', $pId);
        $n = $this->db->count_all_results();

        return $n ? true : false;
    }
}
