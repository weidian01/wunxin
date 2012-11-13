<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-25
 * Time: 上午11:24
 * To change this template use File | Settings | File Templates.
 */
class Model_Ad extends MY_Model
{
    /**
     * 获取广告列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getAdList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('advert');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取广告数量
     *
     * @return int
     */
    public function getAdCount()
    {
        $this->db->select('*')->from('advert');

        return $this->db->count_all_results();
    }

    /**
     * 获取广告 -- 通过广告ID
     *
     * @param $aId
     * @return null | array
     */
    public function getPositionByAid($aId)
    {
        $data = $this->db->select('*')->from('advert')->where('ad_id', $aId)->get()->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取广告 -- 通过广告位置ID
     *
     * @param $position_id
     * @param int $limit
     * @param int $offset
     * @param string $field
     * @param null $where
     * @param null $order
     * @param null $groupBy
     * @return mixed
     */
    public function getAdvertByPositionId($position_id, $limit = 20, $offset = 0, $field = '*', $where = null, $order = null, $groupBy = null)
    {
        $this->db->select($field)->from('advert');
        $this->db->limit($limit, $offset);
        $where && $this->db->where($where);
        $order && $this->db->order_by($order);
        $groupBy && $this->db->group_by($groupBy);

        return $this->db->where('position_id', $position_id)->get()->result_array();
    }

    /**
     * 添加广告
     *
     * @param array $data
     * @return boolean
     */
    public function adAdd(array $data)
    {
        $info = array(
            'position_id' => $data['position_id'],
            'ad_name' => $data['ad_name'],
            'ad_type' => $data['ad_type'],
            'click_num' => $data['click_num'],
            'status' => $data['status'],
            'ad_link' => $data['ad_link'],
            'sort' => $data['sort'],
            'descr' => $data['descr'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'template' => $data['template'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('advert', $info);
        return $this->db->insert_id();
    }

    /**
     * 修改广告
     *
     * @param array $data
     * @param $aId
     * @return boolean
     */
    public function adEdit(array $data, $aId)
    {
        $info = array(
            'position_id' => $data['position_id'],
            'ad_name' => $data['ad_name'],
            'ad_type' => $data['ad_type'],
            'click_num' => $data['click_num'],
            'status' => $data['status'],
            'ad_link' => $data['ad_link'],
            'sort' => $data['sort'],
            'descr' => $data['descr'],
            'start_time' => $data['start_time'],
            'template' => $data['template'],
            'end_time' => $data['end_time'],
        );

        $this->db->where('ad_id', $aId);
        return $this->db->update('advert', $info);
    }

    /**
     * 更新广告信息
     *
     * @param $content
     * @param $aId
     * @return boolean
     */
    public function updateAd($content, $aId)
    {
        $data = array(
            'ad_content' => $content,
        );

        $this->db->where('ad_id', $aId);
        return $this->db->update('advert', $data);
    }

    /**
     * 广告删除
     *
     * @param $aId
     * @return boolean
     */
    public function adDelete($aId)
    {
        return $this->db->delete('advert', array('ad_id' => $aId));
    }
}
