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

        $response = error(99001);
        do {
            if (empty ($title) || empty ($content)) {
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
                'uname' => $this->uInfo['uname']
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
