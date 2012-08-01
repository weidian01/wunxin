<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午8:04
 * To change this template use File | Settings | File Templates.
 */
class comment extends MY_Controller
{
    /**
     * 添加设计图评论
     */
    public function add()
    {
        $dId = $this->input->get_post('did');
        $title = $this->input->get_post('title');
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();

        $response = array('error' => '0', 'msg' => '评论设计图成功', 'code' => 'add_design_comment_success');

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
    public function Reply()
    {
        $cId = $this->input->get_post('comment_id');
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();

        $response = array('error' => '0', 'msg' => '设计图评论回复成功', 'code' => 'add_design_comment_reply_success');

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
            );
            $status = $this->comment->addDesignCommentReply($data);
            if (!$status) {
                $response = error(40008);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 删除设计图评论
     */
    public function delete()
    {
        $cId = $this->input->get_post('comment_id');

        $response = array('error' => '0', 'msg' => '删除设计图评论成功', 'code' => 'delete_design_comment_success');

        do {
            if (empty ($cId)) {
                $response = error(40027);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('design/Model_Design_Comment', 'comment');
            $status = $this->comment->deleteDesignCommentByCommentId($cId, $this->uInfo['uid']);
            if (!$status) {
                $response = error(40028);
                break;
            }
        } while (false);

        $this->json_output($response);
    }
}
