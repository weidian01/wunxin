<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午12:37
 * To change this template use File | Settings | File Templates.
 */
class DesignerComment extends MY_Controller
{
    /**
     * 添加设计师留言
     */
    public function addDesignerComment()
    {
        $designerId = intval($this->input->get_post('designer_id'));
        $content = trim($this->input->get_post('content'));
        $ip = $this->input->ip_address();

        $response = error(10010);

        do {
            if (empty ($designerId) || empty ($content)) {
                $response = error(10012);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $data = array(
                'designer_id' => $designerId,
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'content' => $content,
                'ip' => $ip
            );
            $this->load->model('user/Model_Designer_Comment', 'comment');
            $status = $this->comment->addDesignerComment($data);
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
    public function addDesignerCommentReply()
    {
        $messageId = intval($this->input->get_post('message_id'));
        $content = $this->input->get_post('content');
        $ip = $this->input->ip_address();

        $response = error(10013);

        do {
            if (empty ($messageId) || empty ($content)) {
                $response = error(10012);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('user/Model_Designer_Comment', 'comment');
            if (!$this->comment->designerCommentIsExist($messageId)) {
                $response = error(10016);
                break;
            }

            $data = array(
                'message_id' => $messageId,
                'uid' => $this->uInfo['uid'],
                'uname' => $this->uInfo['uname'],
                'ip' => $ip,
                'content' => $content
            );
            $status = $this->comment->addProductCommentReply($data);
            if (!$status) {
                $response = error(10014);
                break;
            }
        } while (false);

        $this->json_output($response);
    }
}
