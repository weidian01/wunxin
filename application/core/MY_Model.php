<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class MY_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @name 获取数据库所有表名
     *
     * @return array
     */
    public function getDatabaseTables()
    {
        $sql = "show tables";
        return $this->db->query($sql)->result_array();
    }

    /**
     * 获取表字段
     *
     * @param $tableName string
     * @return mixed array
     */
    public function getTableField($tableName)
    {
        $sql = "desc " . trim($tableName);
        return $this->db->query($sql)->result_array();
    }

    /**
     * @name 检查表字段
     *
     * @param $tableName string
     * @param $field string
     * @return bool
     */
    function checkTableField($tableName, $field)
    {
        $this->load->driver('cache');
        $field = trim($field);
        $tableName = trim($tableName);

        $tf = $this->cache->file->get($tableName);

        if (empty ($tf)) {
            $tableAllField = $this->getTableField($tableName);

            foreach ($tableAllField as $v) {
                $tf[] = $v['Field'];
            }

            $this->cache->file->save($tableName, $tf, 86400);
        }

        return in_array($field, $tf) ? true : false;
    }

    /**
     * @name 批量检查表字段
     *
     * @param $tableName string
     * @param array $field array
     * @param bool $isKey boolean
     * @return bool
     */
    public function batchCheckTableField($tableName, array $field, $isKey = false)
    {
        $this->load->driver('cache');
        $tableName = trim($tableName);

        $tf = $this->cache->file->get($tableName);
        if (empty ($tableAllField)) {
            $tableAllField = $this->getTableField($tableName);

            foreach ($tableAllField as $v) {
                $tf[] = $v['Field'];
            }

            $this->cache->file->save($tableName, $tf, 86400);
        }

        foreach ($field as $k => $v) {
            if ($isKey) $v = $k;

            if (!in_array($v, $tf)) {
                return false;
            }
        }
        return true;
    }
}
