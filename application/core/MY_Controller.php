<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-4
 * Time: 下午3:49
 * To change this template use File | Settings | File Templates.
 */
class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 减少重复载入相同库步骤;
     * @param $name
     * @param null $params
     */
    protected function lib($name, $params = NULL)
    {
        static $lib;
        if (!isset($lib[$name])) {
            $lib[$name] = true;
            $this->load->library($name, $params);
        }
    }

    protected function isPOST()
    {
        return $this->input->server('REQUEST_METHOD') === 'POST';
    }

    /**
     * 从cookie中获取用户登录信息
     * @return array | NULL
     */
    protected function getUserinfoForCookie()
    {
        $this->load->helper('cookie');
        $auth =  get_cookie('auth');
        if($auth)
            return explode("\t", authcode($auth, 'DECODE'));
    }

    /**
     * 用户是否登陆
     *
     * @access    public
     * @return    void
     */
    protected function isLogin()
    {
        $userInfo = $this->getUserinfoForCookie();
        if(! $userInfo)
            return false;

        $uid = $userInfo[0];
        $password = $userInfo[2];

        if (empty ($uid) || empty ($password)) {
            return false;
        }

        $this->load->model('user/Model_User', 'user');
        $uInfo = $this->user->getUserById($uid);

        if (! $uInfo || $uInfo['password'] != $password) {
            return false;
        }
        $this->uInfo = $uInfo;
        return true;
    }


    protected function AdminIsLogin()
    {
        //$prefix = config_item('cookie_prefix');
        //$cUserName = $this->input->cookie($prefix . 'username');
        $this->load->helper('cookie');
        $auth =  get_cookie('admin_auth');
        if($auth)
        {
            $am = explode("\t", authcode($auth, 'DECODE'));
            $this->load->model('administrator/Model_Admin_User', 'admin');
            $uinfo = $this->admin->getUserInfoByAmUid($am[0]);
            if (isset($uinfo) && $uinfo['password'] === $am[2]) {
                $this->amInfo = $uinfo;
                return true;
            }
        }
        return false;
    }

    static protected function json_output($data)
    {
        die(json_encode($data));
    }

    /**
     * 获取cookie中的购物车产品
     *
     * @return array
     */
    public function getCartToCookie()
    {
        $this->load->helper('cookie');
        $cData = $this->input->cookie(config_item('cookie_prefix').'cart_info');

        $cData = empty ($cData) ? '' : json_decode($cData, true);

        return $cData;
    }

    /**
     * 设置购物车产品到cookie
     *
     * @param array $pInfo
     * @return array | bool | void
     */
    public function setCartToCookie($pInfo)
    {
        $this->load->helper('cookie');
        $cInfo = array(
            'pid' => $pInfo['pid'],
            'pname' => $pInfo['pname'],
            'product_price' => $pInfo['product_price'],
            'product_num' => $pInfo['product_num'],
            'product_img' => $pInfo['product_img'],
            'product_size' => $pInfo['product_size'],
            'additional_info' => $pInfo['additional_info'],
        );

        if (empty ($cInfo['pid'])) {
            return false;
        }

        $cData = $this->getCartToCookie();

        $isExist = false;
        if (!empty ($cData)) {
            foreach ($cData as &$cv) {
                if ($cv['pid'] == $cInfo['pid']) {
                    $cv['product_num'] += 1;
                    $isExist = true;
                }
            }
        }
        if (!$isExist) {
            $cData[] = $cInfo;
        }

        $this->input->set_cookie('cart_info', json_encode($cData), 10000000);

        return $cData;
    }

    protected function cache_view($match='')
    {
        $key = "{$this->uri->rsegment(1)}@{$this->uri->rsegment(2)}";
        $life = isset($this->config->config['cache_view'][$key]) ? $this->config->config['cache_view'][$key] : 0;
        if($life > 0  && ! $match)
            return false;
        if (preg_match('#^' . $match . '$#', $this->uri->uri_string())) {
            $this->output->cache($life);
            return true;
        }
        return false;
    }
}
