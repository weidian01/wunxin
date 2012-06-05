<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-6-1
 * Time: 上午8:51
 * wunxin E-commerce management system
 */
class tools extends CI_Controller
{
    public function generaTableField()
    {
        $this->load->model('Model_Tools', 'tools');
        $result = $this->tools->getDatabaseTables();
        $data = "<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n\n";

        foreach ($result as $v) {
            $tableName = trim($v['Tables_in_test']);
            $field = $this->tools->getTableField($tableName);


            $tmp = " array(\n";
            foreach ($field as $fv) {
                $tmp .= "\t'{$fv['Field']}',\n";
            }
            $data .= '$tf'."['".$tableName."'] = $tmp);\n";
            $data .= "\n\n";
            //$data[$v['Tables_in_test']] = $tmp;
            //$tmp = array();
        }


echo $data;
//echo '<pre>';print_r($data);
    }
}
