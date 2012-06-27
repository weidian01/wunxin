<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-27
 * Time: 上午9:08
 * To change this template use File | Settings | File Templates.
 */
class designVote extends MY_Controller
{
    /**
     * 添加设计图投票
     */
    public function voteAdd()
    {
        $data['did'] = intval($this->input->get_post('did'));
        $data['score'] = intval($this->input->get_post('score'));
        $data['ip'] = $this->input->ip_address();

        $response = error(40018);

        do {
            if (empty ($data['did']) || empty ($data['score']) || empty ($data['ip'])) {
                $response = error(40020);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $data['uid'] = $this->uInfo['uid'];
            $data['uname'] = $this->uInfo['uname'];
            $this->load->model('design/Model_Design_Vote', 'vote');
            $lastId = $this->vote->addVote($data);
            if (!$lastId) {
                $response = error(40019);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 删除设计图投票
     */
    public function voteDelete()
    {
        $vId = $this->input->get_post('vote_id');

        $response = error(40021);

        do {
            if (!$vId) {
                $response = error(40023);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('design/Model_Design_Vote', 'vote');
            $voteData = $this->vote->getVoteByVid($vId);
            if (empty ($voteData) || $voteData['uid'] != $this->uInfo['uid']) {
                $response = error(40024);
                break;
            }

            $status = $this->vite->deleteVoteByvId($vId);
            if (!$status) {
                $response = error(40022);
                break;
            }
        } while (false);

        $this->json_output($response);
    }
}
