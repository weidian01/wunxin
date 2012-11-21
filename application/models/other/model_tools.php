<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-21
 * Time: 下午9:18
 * To change this template use File | Settings | File Templates.
 */
class model_tools extends MY_Model
{
    /**
     * 添加用户浏览日志
     *
     * @param array $data
     */
    public function addBrowseLog(array $data)
    {
        $info = array(
            'uniqid' => $data['uniqid'],
            'browse_url' => $data['browse_url'],
            'referer_url' => $data['referer_url'],
            'ip' => $data['ip'],
            'os' => $data['os'],
            'browser' => $data['browser'],
            'create_time' => TIMESTAMP,
        );

        $this->db->insert('user_browse_log', $info);
    }
}
