<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午6:06
 * To change this template use File | Settings | File Templates.
 */
class user extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 修改用户信息
     */
    public function saveUserInfo()
    {
        $nickname = $this->input->get_post('nickname');
        $data['real_name'] = $this->input->get_post('realname');
        $data['sex'] = $this->input->get_post('sex');
        $data['birthday'] = $this->input->get_post('birthday');
        $data['marital_status'] = $this->input->get_post('marital_status');
        $data['education_level'] = $this->input->get_post('education_level');
        $data['job'] = $this->input->get_post('job');
        $data['industry'] = $this->input->get_post('industry');
        $data['income'] = $this->input->get_post('income');
        $data['height'] = $this->input->get_post('height');
        $data['weight'] = $this->input->get_post('weight');
        $data['body_type'] = $this->input->get_post('body_type');
        $data['website'] = $this->input->get_post('website');
        $data['introduction'] = $this->input->get_post('introduction');
        $data['interest'] = $this->input->get_post('interest');
        $data['province'] =$this->input->get_post('province');
        $data['city'] =$this->input->get_post('city');
        $data['family_call'] =$this->input->get_post('family_call');
        $data['company_call'] =$this->input->get_post('company_call');
        $data['phone'] =$this->input->get_post('phone');
        $data['qq'] =$this->input->get_post('qq');
        $data['detail_address'] =$this->input->get_post('detail_address');
        $data['zipcode'] =$this->input->get_post('zipcode');
        $data['id_card'] =$this->input->get_post('id_card');
        $data['bank_name'] =$this->input->get_post('bank_name');
        $data['bank_account'] =$this->input->get_post('bank_account');
//print_r($data);exit;
        $response = array('error' => '0', 'msg' => '保存用户信息成功', 'code' => 'save_user_info_success');

        do {
            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            $this->load->model('user/Model_User', 'user');
            $nStatus = $this->user->modifyUserNickName($this->uInfo['uid'], $nickname);
            if (!$nStatus) {
                $response = error(10039);
                break;
            }

            $uStatus = $this->user->modifyDetailUser($this->uInfo['uid'], $data);
            if (!$uStatus) {
                $response = error(10040);
                break;
            }

        } while (false);

        self::json_output($response);
    }

    /**
     * 设置用户头像
     */
    public function setUserHeader()
    {
        $avatarId = intval($this->input->get_post('avatar_id'));

        $response = array('error' => '0', 'msg' => '设计用户头像成功', 'code' => 'setting_user_header_success');

        do {
            if (empty ($avatarId)) {
                $response = error(10043);
                break;
            }

            if (!$this->isLogin()) {
                $response = error(10009);
                break;
            }

            if (!in_array($avatarId, array(1,2,3,4,5,6,7,8,9,10,11,12))) {
                $response = error(99999);
                break;
            }

            $source = WEBROOT.'images/avatar/avatar'.$avatarId.'.jpg';
            if (!file_exists($source)) {
                $response = error(10044);
                break;
            }

            $destOne = WEBROOT.'upload/designer/'.intToPath($this->uInfo['uid']).'default.jpg';
            $destTwo = WEBROOT.'upload/designer/'.intToPath($this->uInfo['uid']).'icon.jpg';
            if (!copy($source, $destOne) || !copy($source, $destTwo)) {
                $response = error(10044);
                break;
            }
        } while (false);

        self::json_output($response);
    }

    public function upload()
    {
        if (!$this->isLogin()) {
            echo '<script type="text/javascript">alert("用户未登陆!");</script>';
            return ;
        }

        @header("Expires: 0");
        @header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
        @header("Pragma: no-cache");

        $pic_id = time();//使用时间来模拟图片的ID.
        $pic_path = WEBROOT.'/upload/tmp/'.$pic_id.'.jpg';

        //上传后图片的绝对地址
        $pic_abs_path = config_item('base_url').'/upload/tmp/'.$pic_id.'.jpg';

        //保存上传图片.
        if(empty($_FILES['Filedata'])) {
        	echo '<script type="text/javascript">alert("对不起, 图片未上传成功, 请再试一下");</script>';
        	exit();
        }

        $file = @$_FILES['Filedata']['tmp_name'];
        file_exists($pic_path) && @unlink($pic_path);

        if(@copy($_FILES['Filedata']['tmp_name'], $pic_path) || @move_uploaded_file($_FILES['Filedata']['tmp_name'], $pic_path))
        {
        	@unlink($_FILES['Filedata']['tmp_name']);
        } else {
        	@unlink($_FILES['Filedata']['tmp_name']);
        	echo '<script type="text/javascript">alert("对不起, 上传失败");</script>';
        }

        //写新上传照片的ID.
        echo '<script type="text/javascript">window.parent.hideLoading();window.parent.buildAvatarEditor("'.$pic_id.'","'.$pic_abs_path.'","photo");</script>';
    }

    public function camera()
    {
        if (!$this->isLogin()) {
            echo '<script type="text/javascript">alert("用户未登陆!");</script>';
            return ;
        }

        //保存报像头上传的图片.
        @header("Expires: 0");
        @header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
        @header("Pragma: no-cache");

        $pic_id = time();

        //生成图片存放路径
        $new_avatar_path = 'upload/tmp/'.$pic_id.'.jpg';

        //将POST过来的二进制数据直接写入图片文件.
        $len = file_put_contents(WEBROOT.$new_avatar_path, file_get_contents("php://input"));

        //原始图片比较大，压缩一下. 效果还是很明显的, 使用80%的压缩率肉眼基本没有什么区别
        $avtar_img = imagecreatefromjpeg(WEBROOT.$new_avatar_path);
        imagejpeg($avtar_img, WEBROOT.$new_avatar_path, 80);
        //nix系统下有必要时可以使用 chmod($filename,$permissions);

        //输出新保存的图片位置, 测试时注意改一下域名路径, 后面的statusText是成功提示信息.
        //status 为1 是成功上传，否则为失败.
        $d = new pic_data();
        $d->data->photoId = $pic_id;
        //$d->data->urls[0] = 'http://sns.com/avatar_test/'.$new_avatar_path;
        $d->data->urls[0] = config_item('base_url').$new_avatar_path;
        $d->status = 1;
        $d->statusText = '上传成功!';

        $msg = json_encode($d);

        echo $msg;
    }

    public function saveAvatar()
    {
        if (!$this->isLogin()) {
            echo '<script type="text/javascript">alert("用户未登陆!");</script>';
            return ;
        }

        @header("Expires: 0");
        @header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
        @header("Pragma: no-cache");

        $type = $this->input->get_post('type');

        //这里传过来会有两种类型，一先一后, big和small, 保存成功后返回一个json字串，客户端会再次post下一个.
        $type = (isset($type) && $type == 'small') ? 'icon' : 'default';

        //生成图片存放路径
        $new_avatar_path = 'upload'.DS.'designer'.DS.intToPath($this->uInfo['uid']).DS.$type.'.jpg';

        //将POST过来的二进制数据直接写入图片文件.
        $len = file_put_contents(WEBROOT.$new_avatar_path, file_get_contents("php://input"));

        //原始图片比较大，压缩一下. 效果还是很明显的, 使用80%的压缩率肉眼基本没有什么区别
        //小图片 不压缩约6K, 压缩后 2K, 大图片约 50K, 压缩后 10K
        $avtar_img = imagecreatefromjpeg(WEBROOT.$new_avatar_path);
        imagejpeg($avtar_img, WEBROOT.$new_avatar_path, 80);
        //nix系统下有必要时可以使用 chmod($filename,$permissions);

        //输出新保存的图片位置, 测试时注意改一下域名路径, 后面的statusText是成功提示信息.
        //status 为1 是成功上传，否则为失败.
        $d = new pic_data();
        //$d->data->urls[0] = 'http://sns.com/avatar_test/'.$new_avatar_path;
        $d->data->urls[0] = $new_avatar_path;
        $d->status = 1;
        $d->statusText = '上传成功!';

        $msg = json_encode($d);

        echo $msg;
    }

    public function getUserHeader()
    {
        $uId = intval( $this->input->get_post('uid') );
        $type = intval( $this->input->get_post('type') );//1为default, 其他为icon

        $imgName = ($type == 1) ? 'default.jpg' : 'icon.jpg';

        if ( empty ($uId) ) {
            return '';
        }

        $this->load->model('user/Model_User', 'user');
        $userInfo = $this->user->getUserById($uId);

        if (empty ($userInfo)) {
            return '';
        }

        if ($userInfo['header'] <= 0) {
            $header = '/images/avatar/avatar1.jpg';
        } else {
            $header = '/upload'.DS.'designer'.DS.intToPath($uId).$imgName;
        }

        echo $header;
    }
}


class pic_data
{
     public $data;
     public $status;
     public $statusText;
    public function __construct()
    {
        $this->data->urls = array();
    }
}
