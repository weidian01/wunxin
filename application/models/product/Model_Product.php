<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class Model_Product extends MY_Model
{
    /**
     * @name 获取产品信息 -- 通过产品ID
     *
     * @param int $pid
     * @return bool
     */
    public function getProductById($pid)
    {
        $data = $this->db->select('*')->get_where('product', array('pid' => $pid,))->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取产品和产品默认图片
     * @param $pid
     * @return null | array
     */
    public function getProductAndPhotoByPid($pid)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_photo', 'product.pid = product_photo.pid', 'left');
        $this->db->where('product.pid', $pid);
        $this->db->where('product.status', 1);
        $this->db->where('product.check_status', 1);
        $this->db->where('product.shelves', 1);
        $this->db->where('product_photo.is_default', 1);
        $data = $this->db->get()->row_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取产品数量
     * @param null $where
     * @return int
     */
    public function getProductCout($where = null)
    {
        $this->db->from('product');
        $where && $this->db->where($where);
        return $this->db->count_all_results();
    }

    /**
     * 获取产品列表
     *
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getProductList($limit = 20, $offset = 0, $where = null)
    {
        $data = $this->db->get_where('product', $where, $limit, $offset)->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取产品所有图片
     *
     * @param $pid
     * @param int $limit
     * @param int $offset
     * @return null | array
     */
    public function getProductAllPhotoByPid($pid, $limit = 20, $offset = 0)
    {
        $data = $this->db->select('*')->get_where('product_photo', array('pid' => $pid), $limit, $offset);

        return empty ($data) ? null : $data;
    }

    /**
     * @name 检测产品是否存在
     *
     * @param int $pid
     * @return bool
     */
    public function productIsExist($pid)
    {
        $pInfo = $this->db->get_where('product', array('pid' => $pid))->row_array();

        return empty ($pInfo) ? false : true;
    }


    public function addProduct(array $pInfo)
    {
        $this->db->insert('product', $pInfo);
        return $this->db->insert_id();
    }

    public function addProductSize(array $size, $pid)
    {
        $data = array();
        foreach ($size as $k => $v) {
            $data[$k]['pid'] = $pid;
            $data[$k]['size_id'] = $v;
        }
        if ($data) {
            $this->db->insert_batch('product_size', $data);
        }
        return;
    }

    public function upProductSize($data, $pid)
    {
        $this->db->where('pid', $pid);
        $this->db->delete('product_size');
        $this->db->insert('product_size', $data);
    }

    public function editProduct($pId, array $pInfo)
    {

    }

    public function addProductPhoto(array $photo, $pid)
    {
        $data = array();
        $date = date('Y-m-d H:i:s', TIMESTAMP);
        foreach ($photo as $k => $v) {
            $data[$k]['is_default'] = $data ? 0:1;
            $data[$k]['pid'] = $pid;
            $data[$k]['img_addr'] = $v;
            $data[$k]['create_time'] = $date;
        }
        if ($data) {
            $this->db->insert_batch('product_photo', $data);
        }
        return ;
    }

    public function addProductAttr($attr)
    {
        if ($attr) {
            $this->db->insert_batch('product_attr', $attr);
        }
        return ;
    }

    public function deleteProduct($pId)
    {
        $this->db->where('pid', $pId);
        $this->db->where('status', 1);
        $this->db->update('product', array('status'=>0));
        return ;
    }
}