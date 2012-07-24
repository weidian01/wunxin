<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-7-23
 * Time: 下午6:26
 * To change this template use File | Settings | File Templates.
 */
class change_password extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->isLogin()) {
            //redirect();
        }

        if(! $this->input->is_ajax_request()){
            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }
    }

    public function submit()
    {
        $oldPassword = $this->input->get_post('old_password');
        $newPassword = $this->input->get_post('new_password');

        $response = error(10036);

        do {
            if (empty ($oldPassword) || empty ($newPassword)) {
                $response = error(10038);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('user/Model_User', 'user');
            $uInfo = $this->user->modifyUserPasswordByUserId($this->uInfo['uid'], $oldPassword, $newPassword);

            //不存在
            if ($uInfo === 2) {
                $response = error(10006);
                break;
            }

            //密码错误
            if ($uInfo === 3) {
                $response = error(10007);
                break;
            }

        }while (false);

        self::json_output($response);
    }
}
    //10007