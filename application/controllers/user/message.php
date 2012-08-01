<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午12:37
 * To change this template use File | Settings | File Templates.
 */
class message extends MY_Controller
{
    /**
     * 添加设计师留言
     */
    public function add()
    {
        $beUid = intval($this->input->get_post('be_uid'));
        $title = trim($this->input->get_post('title'));
        $content = trim($this->input->get_post('content'));
        $ip = $this->input->ip_address();

        $response = array('error' => '0', 'msg' => '给设计师留言成功', 'code' => 'message_designer_success');

        do {
            if (empty ($beUid) || empty ($title) || empty ($content)) {
                $response = error(10012);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            //设计师是否存在
            $this->load->model('user/Model_User', 'user');
            $beUserData = $this->user->getUserById($beUid);
            if ( empty ($beUserData) ) {
                $response = error(10006);
                break;
            }

            $data = array(
                'be_uid' => $beUid,
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'title' => $title,
                'content' => $content,
                'ip' => $ip
            );

            $this->load->model('user/Model_Designer_Message', 'message');
            $status = $this->message->addDesignerMessage($data);
            if (!$status) {
                $response = error(10011);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 添加设计师评论回复
     */
    public function messageReply()
    {
        $messageId = intval($this->input->get_post('message_id'));
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();

        $response = array('error' => '0', 'msg' => '设计师留言回复成功', 'code' => 'reply_designer_message_success');

        do {
            if (empty ($messageId) || empty ($content)) {
                $response = error(10012);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('user/Model_Designer_Message', 'message');
            if (!$this->message->designerMessageIsExist($messageId)) {
                $response = error(10016);
                break;
            }

            $data = array(
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'message_id' => $messageId,
                'content' => $content,
                'ip' => $ip,
            );

            $status = $this->message->addProductMessageReply($data);
            if (!$status) {
                $response = error(10014);
                break;
            }
        } while (false);

        $this->json_output($response);
    }

    /**
     * 删除设计师留言
     */
    public function delete()
    {
        $messageId = intval($this->input->get_post('message_id'));

        $response = array('error' => '0', 'msg' => '删除设计师留言成功', 'code' => 'delete_designer_message_success');

        do {
            if (empty ($messageId)) {
                $response = error(10041);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('user/Model_Designer_Message', 'message');

            $status = $this->message->deleteDesignerMessageByCommentId($messageId);
            if (!$status) {
                $response = error(10042);
                break;
            }
        } while (false);

        $this->json_output($response);
    }
}
