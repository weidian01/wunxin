<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午6:15
 * To change this template use File | Settings | File Templates.
 */
class systemProposal extends MY_Controller
{
    public function addSystemProposal()
    {
        $title = $this->input->get_post('title');
        $content = $this->input->get_post('content');
        $uName = $this->input->get_post('uname');
        $phone = $this->input->get_post('phone');
        $mail = $this->input->get_post('mail');

        $response = array('error' => '0', 'msg' => '添加系统建议与意见成功', 'code' => 'add_system_proposal_success');

        do {
            if (empty ($content)) {
                $response = error(99003);
                break;
            }

            if (!$this->isLogin()) {
                //$response = error(10009);
                //break;
            }

            $data = array(
                'title' => $title,
                'content' => $content,
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'realname' => $uName,
                'telecall' => $phone,
                'email' => $mail,
            );

            $this->load->model('other/Model_System_Proposal', 'proposal');
            $status = $this->proposal->addSystemProposal($data);
            if (!$status) {
                $response = error(99002);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    public function getSystemProposal()
    {
        $this->load->model('other/Model_System_Proposal', 'proposal');
        $spInfo = $this->proposal->getSystemProposal();
    }
}
