<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-18
 * Time: 下午9:37
 * To change this template use File | Settings | File Templates.
 */
class Model_Article extends MY_Model
{
    /**
     * 添加文章
     *
     * @param array $data
     * @return boolean
     */
    public function addNews(array $data)
    {
        $data = array(
            'cid' => $data['cid'],
            'title' => $data['title'],
            'content' => $data['content'],
            'keywords' => $data['keywords'],
            'descr' => $data['descr'],
            'visiblity' => $data['visiblity'],
            'top' => $data['top'],
            'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
        );

        $this->db->insert('article', $data);
        return $this->db->insert_id();
    }

    /**
     * 修改文章
     *
     * @param array $data
     * @param $newsId
     * @return boolean
     */
    public function editNews(array $data, $newsId)
    {
        $data = array(
            'cid' => $data['cid'],
            'title' => '"'.$data['title'].'"',
            'content' => '"'.$data['content'].'"',
            'keywords' => '"'.$data['keywords'].'"',
            'descr' => '"'.$data['descr'].'"',
            'visiblity' => $data['visiblity'],
            'top' => $data['top'],
        );

        $this->db->where('id', $newsId);
        return $this->db->set($data, '', false)->update('article');
    }

    /**
     * 获取文章 -- 通过文章ID
     * @param $newsId
     * @return null | array
     */
    public function getNewsById($newsId)
    {
        $data = $this->db->select('*')->from('article')->where('id', $newsId)->get()->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取文章列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getNewsList($limit = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取文章数量
     *
     * @return int
     */
    public function getNewsCount()
    {
        $this->db->select('*')->from('article');

        return $this->db->count_all_results();
    }

    /**
     * 获取文章分类列表
     *
     * @param $cId
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getNewsCategoryList($cId, $limit = 20, $offset = 0)
    {
        $data = $this->db->get_where('article', array('cid' => $cId), $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取文章列表数量
     *
     * @param $cId
     * @return mixed
     */
    public function getNewsCategoryCount($cId)
    {
        $this->db->from('article');
        $this->db->where('cid', $cId);
        return $this->db->count_all_results();
    }

    /**
     * 删除文章
     *
     * @param $newsId
     * @return boolean
     */
    public function deleteNewsByNewsId($newsId)
    {
        return $this->db->delete('article', array('id' => $newsId));
    }
}
