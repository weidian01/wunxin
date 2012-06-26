<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-26
 * Time: 下午4:33
 * To change this template use File | Settings | File Templates.
 */
class activity_prize extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->AdminIsLogin()) {
            $this->load->helper('url');
            redirect('/administrator/admin_login/index');
        }
    }

    public function prizeAdd()
    {
        $activityId = intval($this->uri->segment(4, 0));
        if (!$activityId) {
            show_error('活动ID为空');
        }

        $this->load->model('activity/Model_Activity', 'activity');
        $data = $this->activity->getActivityList(1000);

        $this->load->view('/administrator/activity/prize_create', array('a_data' => $data, 'activity_id' => $activityId, 'type' => 'add'));
    }

    public function prizeSave()
    {
        $data['activity_id'] = $this->input->get_post('activity_id');
        $data['prize_name'] = $this->input->get_post('prize_name');
        $data['img_addr'] = $this->input->get_post('img_addr');
        $data['number'] = $this->input->get_post('number');
        $data['descr'] = $this->input->get_post('descr');

        if (empty ($data['prize_name']) || empty ($data['number']) || empty ($data['descr'])) {
            show_error('参数不全');
        }
        $this->load->model('activity/Model_Activity_Prize', 'prize');
        $lastId = $this->prize->prizeAdd($data);
        if (!$lastId) {
            show_error('添加活动奖品失败');
        }

        //echo '<pre>';print_r($_FILES);exit;
        if ($_FILES['img_addr']['error'] == '0') {echo 'f';
            $this->load->helper('directory');
            $directory = 'upload' . DS . 'activity' . DS . 'prize' . DS . date('Ymd') . DS;
            recursiveMkdirDirectory($directory);

            $config['upload_path'] = WEBROOT . $directory;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['file_name'] = $lastId;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('img_addr')) {
                $uData = $this->upload->data();

                $file = $directory . $uData['file_name'];
                $this->prize->updatePrize($file, $lastId);
            } else {
                show_error('文件上传失败!');
            }
        }

        //redirect('/administrator/activity/');
    }

    /**
     * 删除奖品
     */
    public function prizeDelete()
    {
        $prizeId = $this->uri->segment(4, 0);
        $activityId = $this->uri->segment(5, 0);

        if (!$prizeId) {
            show_error('奖品id为空');
        }
        if (!$activityId) {
            show_error('活动ID为空');
        }

        $this->load->model('activity/Model_Activity_Prize', 'prize');
        $this->prize->deletePrize($prizeId);

        redirect('/administrator/activity/activityView/'.$activityId);
    }
}
