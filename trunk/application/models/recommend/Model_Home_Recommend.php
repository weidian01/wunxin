<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-21
 * Time: 下午2:30
 * To change this template use File | Settings | File Templates.
 */
class Model_Home_Recommend extends MY_Model
{
    /**
     * 获取推荐列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getRecommendList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('recommend');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取推荐列表数量
     *
     * @return int
     */
    public function getRecommendListCount()
    {
        $this->db->select('*')->from('recommend');

        return $this->db->count_all_results();
    }

    /**
     * 获取推荐分类列表
     *
     * @param $cId
     * @param int $limit
     * @param int $offset
     * @return null || array
     */
    public function getRecommendCategoryList($cId, $limit = 20, $offset = 0)
    {
        $data = $this->db->get_where('recommend', array('cid' => $cId), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取推荐分类列表数量
     *
     * @param $cId
     * @return int
     */
    public function getRecommendCategoryCount($cId)
    {
        $this->db->from('recommend');
        $this->db->where('cid', $cId);
        return $this->db->count_all_results();
    }

    /**
     * 获取推荐 -- 通过推荐ID
     * @param $rId
     * @return null || array
     */
    public function getRecommendById($rId)
    {
        $data = $this->db->select('*')->from('recommend')->where('id', $rId)->get()->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 推荐添加
     *
     * @param array $data
     * @return boolean
     */
    public function recommendAdd(array $data)
    {
        $info = array(
            'cid' => $data['cid'],
            'title' => $data['title'],
            'link' => $data['link'],
            'img_addr' => $data['img_addr'],
            'pid' => $data['pid'],
            'sort' => $data['sort'],
            'emission' => $data['emission'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('recommend', $data);
        return $this->db->insert_id();
    }

    /**
     * 删除推荐
     *
     * @param $rId
     * @return boolean
     */
    public function deleteRecommend($rId)
    {
        return $this->db->delete('recommend', array('id' => $rId));
    }
}
