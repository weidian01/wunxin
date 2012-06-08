<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午8:04
 * To change this template use File | Settings | File Templates.
 */
class designComment extends MY_Controller
{
    /**
     * 添加设计图评论
     */
    public function addDesignComment()
    {
        $dId = $this->input->get_post('did');
        $title = $this->input->get_post('title');
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();

        $response = error(40002);

        do {
            if (empty ($dId) || empty ($title) || empty ($content)) {
                $response = error(40004);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('design/Model_Design', 'design');
            $dInfo = $this->design->getDesignByDid($dId);
            if (!$dInfo) {
                $response = error(40005);
                break;
            }

            $data = array(
                'did' => $dId,
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'title' => $title,
                'content' => $content,
                'ip' => $ip
            );
            $this->load->model('design/Model_Design_Comment', 'comment');
            $status = $this->comment->addDesignComment($data);
            if (!$status) {
                $response = error(40003);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 添加设计图讨论回复
     */
    public function addDesignCommentReply()
    {
        $cId = $this->input->get_post('comment_id');
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();

        $response = error(40007);

        do {
            if (empty ($cId) || empty ($content)) {
                $response = error(40009);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('design/Model_Design_Comment', 'comment');
            $cInfo = $this->comment->getDesignCommentByCid($cId);
            if (!$cInfo) {
                $response = error(40006);
                break;
            }

            $data = array(
                'comment_id' => $cId,
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'content' => $content,
                'ip' => $ip,
                'create_time' => date('Y-m-d H:i:s', TIMESTAMP)
            );
            $status = $this->comment->addDesignCommentReply($data);
            if (!$status) {
                $response = error(40008);
                break;
            }
        } while (false);

        $this->json_output($response);
    }
}
