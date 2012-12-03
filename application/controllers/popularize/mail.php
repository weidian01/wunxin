<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-8-2
 * Time: 上午11:18
 * To change this template use File | Settings | File Templates.
 */

function shutdown($pid_file)
{
    unlink($pid_file);
}

register_shutdown_function('shutdown', $argv[4]);

class mail extends MY_Controller
{
    private $conf = array(
        'qq' => array(
            'host' => 'smtp.163vip.net',
            'port' => 25,
            'charset' => 'UTF-8',
        ),
        '126' => array(
            'host' => 'smtp.163vip.net',
            'port' => 25,
            'charset' => 'UTF-8',
        ),
        '163' => array(
            'host' => 'smtp.163vip.net',
            'port' => 25,
            'charset' => 'UTF-8',
        ),
    );

    /**
     * 进程序列
     */
    private $sequence = 1;

    /**
     * 要发送的邮件id
     * @var int
     */
    private $mail_id = 0;

    /**
     * 一个账户发送邮件数量限制
     * @var int
     */
    private $change_limit = 1000;

    /**
     * 一个进程发送邮件数量限制
     * @var int
     */
    private $send_limit = 1000;

    /**
     * 构造函数
     */
    function __construct()
    {
        $this->init();
        parent::__construct();
        _require(APPPATH . 'libraries' . DS . 'PHPMailer' . DS . 'class.phpmailer.php');
    }

    /**
     * 初始化
     */
    private function init()
    {
        //p($argc);
        //p($argv);die;
        $this->sequence = isset($argv[5]) ? $argv[5] : 0;
        $this->mail_id = isset($argv[6]) ? $argv[6] : 0;
        $this->change_limit = isset($argv[7]) ? $argv[7] : 1000;
        $this->send_limit = isset($argv[8]) ? $argv[8] : 1000;
    }

    /**
     * 运行
     */
    function run()
    {
        if (! $this->sequence)
        {
            die('sequence is false');
        }

        $mail_info = $this->get_mail_info($this->mail_id);
        if(! $mail_info)
        {
            die("mail is empty");
        }

        $user_list = $this->get_user_list();
        if(! $user_list)
        {
            die("user_list is empty");
        }

        $change = 0;

        foreach($user_list as $user)
        {
            if (($change % $this->change_limit) == 0)
            {
                $from = $this->get_from();
            }
            if($from)
            {
                $this->send($from, $user['mail'], $mail_info);
                $this->up_user($user['id'], $user['ver']);
            }
        }
    }

    /**
     * @param $mail
     * @param $mail_info
     */
    private function send($from, $to, $mail_info)
    {
        //p($from);p($to);p($mail_info);die;
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";
        $mail->Host = $from['host'];
        $mail->Port = $from['port'];
        $mail->CharSet = $from['charset'];
        $mail->Username = $from['user'];
        $mail->Password = $from['pass'];
        $mail->IsHTML(true);
        $mail->AddAddress($to);
        $mail->From = $from['user'];
        $mail->FromName = "万象网";
        //$mail->WordWrap = 100; // set word wrap
        $mail->Subject = $mail_info['title'];
        $mail->Body = $mail_info['content'];
        return $mail->Send();
    }

    /**
     * @return array
     */
    private function get_mail_info($id)
    {
        $query = $this->db->get_where('z_mail', array('id' => $id));
        return $query->row_array();
    }

    /**
     * @return array
     */
    private function get_user_list()
    {
        $query = $this->db->get_where('z_mail_to', array('up_time <' => TIMESTAMP - 86400, "id >=" => (($this->sequence-1) * $this->send_limit), "id <"=>($this->sequence * $this->send_limit)));
        return $query->result_array();
    }

    /**
     * @param $id
     * @param $ver
     * @return bool
     */
    private function up_user($id, $ver)
    {
        $this->db
            ->where('id', $id)
            ->where('ver', $ver)
            ->set(array('ver' => 'ver+1'), '', false)
            ->update('z_mail_to', array('up_time' => TIMESTAMP));
        return $this->db->affected_rows();
    }

    /**
     * @return bool
     */
    private function get_from()
    {
        $this->db->select_max('id');
        $r = $this->db->get('z_mail_from')->row_array();
        $rand_id = mt_rand(1, $r['id']);
        $query = $this->db->get_where('z_mail_from', array('id ' => $rand_id));
        $from = $query->row_array();
        if(isset($this->conf[$from['type']]))
        {
            $from_conf = $this->conf[$from['type']];
            $from += $from_conf;
            //p($from);
            return $from;
        }
        return FALSE;
    }
}