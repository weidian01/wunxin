<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-26
 * Time: 下午12:04
 * To change this template use File | Settings | File Templates.
 */
class attached extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    public function upload()
    {
        if ($_FILES['imgFile']['size'] > 0) {
            $this->load->helper('directory');
            $date = date('Y/m/d', TIMESTAMP);
            $config['upload_path'] = UPLOAD . 'attached' . DS . $date;
            recursiveMkdirDirectory($config['upload_path']);
            $config['allowed_types'] = 'gif|jpg|png|jepg';
            $config['max_size'] = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $config['encrypt_name'] = true;
            $config['overwrite'] = true;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('imgFile')) {
                self::json_output(array('error' => 1, 'message' => $this->upload->display_errors()));
            } else {
                $tmp = $this->upload->data();
                self::json_output(array('error' => 0, 'url' => '/upload/attached/' .$date . '/' . $tmp['file_name']));
            }
        }
        else
        {
            self::json_output(array('error' => 1, 'message' => 'file size is zero'));
        }
    }

    public function manager()
    {
        $path = $this->input->get('path');
        $dir_path = UPLOAD . 'attached' . DS . $path;
        $this->load->helper('directory');
        $files = directory_map($dir_path, 1);
        //echo '<pre>';print_r($files); die;
        $file_list = array();
        $i = 0;
        foreach($files as $file)
        {
            $file_path = $dir_path . $file;
            if (is_dir($file_path)) {
                $file_list[$i]['is_dir'] = true; //是否文件夹
                $file_list[$i]['has_file'] = true;//(count(scandir($file_path)) > 2); //文件夹是否包含文件
                $file_list[$i]['filesize'] = 0; //文件大小
                $file_list[$i]['is_photo'] = false; //是否图片
                $file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
            } else {
                $file_list[$i]['is_dir'] = false;
                $file_list[$i]['has_file'] = false;
                $file_list[$i]['filesize'] = filesize($file_path);
                $file_list[$i]['dir_path'] = '';
                $file_ext = strtolower(array_pop(explode('.', trim($file))));
                $file_list[$i]['is_photo'] = in_array($file_ext, array('gif', 'jpg', 'jpeg', 'png'));
                $file_list[$i]['filetype'] = $file_ext;
            }
            $file_list[$i]['filename'] = $file; //文件名，包含扩展名
            $file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file_path)); //文件最后修改时间
            $i++;
        }

        $result = array();
        //相对于根目录的上一级目录
        $result['moveup_dir_path'] = $path ? preg_replace('/(.*?)[^\/]+\/$/', '$1', $path) : '';
        //相对于根目录的当前目录
        $result['current_dir_path'] = $path;
        //当前目录的URL
        $result['current_url'] = config_item('static_url').'/upload/attached/'.$path;
        //文件数
        $result['total_count'] = count($files);
        //文件列表数组
        $result['file_list'] = $file_list;

        self::json_output($result);
    }
}
