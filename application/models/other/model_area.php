<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-7-9
 * Time: 上午10:54
 * To change this template use File | Settings | File Templates.
 */
class Model_Area extends MY_Model
{
    /**
     * 获取省份列表
     */
    public function getProvinceList()
    {
        $this->db->select('*');
        $this->db->from('area_province');
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取省份列表
     *
     * @param $provinceId
     * @return null | array
     */
    public function getCityList($provinceId)
    {
        $this->db->select('*');
        $this->db->from('area_city');
        $this->db->where('pid', $provinceId);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }

    /**
     * 获取区域列表
     *
     * @param $cityId
     * @return null | array
     */
    public function getAreaList($cityId)
    {
        $this->db->select('*');
        $this->db->from('area_district');
        $this->db->where('pid', $cityId);
        $data = $this->db->get()->result_array();

        return empty ($data) ? null : $data;
    }
}
