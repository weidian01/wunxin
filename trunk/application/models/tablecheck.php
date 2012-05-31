<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-5-30
 * Time: 下午3:36
 * To change this template use File | Settings | File Templates.
 */
class check
{
    function getTableField($tableName){}

    function checkTableField($tableName, $checkField)
    {
        $allTalbField = $this->getTableField($tableName);

        $flag = true;
        foreach($checkField as $k=>$v) {
            if (!in_array($k, $allTalbField)) {
                $flag = false;
            }
        }

        return $flag;
    }

}