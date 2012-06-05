<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package        CodeIgniter
 * @author        ExpressionEngine Dev Team
 * @copyright    Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license        http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since        Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Model Class
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @category    Libraries
 * @author        ExpressionEngine Dev Team
 * @link        http://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model
{
    /**
     * 对象实例计数器
     * @var int
     */
    static $obj_num = 0;

    /**
     * Constructor
     *
     * @access public
     */
    function __construct()
    {
        $this->load->database();
        ++self::$obj_num;
        log_message('debug', "Model Class Initialized");
    }

    /**
     * __get
     *
     * Allows models to access CI's loaded classes using the same
     * syntax as controllers.
     *
     * @param    string
     * @access private
     */
    function __get($key)
    {
        $CI =& get_instance();
        return $CI->$key;
    }


//    function __destruct()
//    {
//        //*
//        if (ENVIRONMENT === 'development' && get_called_class() !== 'CI_Model') {
//            echo '<pre>';
//            echo 'queries : ', $this->db->query_count;
//            echo '<br>';
//            print_r($this->db->queries);
//            echo '</pre>';
//        }
//        //*/
//    }


    function __destruct()
    {
        --self::$obj_num;
        //*
        if (ENVIRONMENT === 'development' && self::$obj_num === 0) {
            echo '<pre>';
            foreach ($this->db->queries as $k => $v) {
                echo '<b style="color:red;font-size:20px;">SQL:</b>' . str_replace("\n", '', $v) . ' ------ <b style="color:red;font-size:20px;">TIME:</b>' . $this->db->query_times[$k],"\n";
            }
            echo '</pre>';
        }
        //*/
    }

}
// END Model Class

/* End of file Model.php */
/* Location: ./system/core/Model.php */