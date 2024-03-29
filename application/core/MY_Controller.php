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

        if(! $this->input->is_ajax_request()){
            $this->load->model('recommend/Model_Home_Recommend', 'recommend');
            $this->search_keyword = $this->recommend->getRecommendCategoryList(10, 5);

            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }
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

    /**
     * 是否为POST请求
     *
     * @return bool
     */
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

    /**
     * 检测后台用户是否登陆
     *
     * @return bool
     */
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

    /**
     * 输出JSON数据
     *
     * @static
     * @param $data
     * @param bool $JSONP
     * @return mixed
     */
    static protected function json_output($data,$JSONP = false)
    {
        if($JSONP && isset($_GET['callback']))
        {
            $callback = $_GET['callback'];
            echo "{$callback}(",json_encode($data),")";
            return ;
        }
        echo json_encode($data);
        return;
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

        $cData = empty ($cData) ? array() : json_decode($cData, true);

        return $cData;
    }

    /**
     * 设置购物车产品到cookie
     *
     * @param $pInfo
     * @param int $timeOut
     * @return array|bool
     */
    public function setCartToCookie($pInfo, $timeOut = 10000000)
    {
        $this->load->helper('cookie');
        $cInfo = array(
            'pid' => $pInfo['pid'],
            'pname' => $pInfo['pname'],
            'product_price' => $pInfo['product_price'],
            'product_num' => $pInfo['product_num'],
            'size_id' => $pInfo['size_id'],
            'product_size' => $pInfo['product_size'],
            'additional_info' => $pInfo['additional_info'],
        );
        //p($cInfo);
        if (empty ($cInfo['pid'])) {
            return false;
        }

        $cData = $this->getCartToCookie();

        //产品是否已经存在于购物车中标识
        $isExist = false;
        if (!empty ($cData)) {
            foreach ($cData as &$cv) {
                if ($cv['pid'] == $cInfo['pid'] && $cv['product_size'] == $cInfo['product_size']) {
                    $cv['product_num'] += $cInfo['product_num'];
                    $isExist = true;
                }
            }
        }
        if (!$isExist) {
            $cData[] = $cInfo;
        }

        $this->input->set_cookie('cart_info', json_encode($cData), $timeOut);

        return $cData;
    }

    /**
     * 获取已经使用的促销活动ID
     */
    public function getUsedPromotion()
    {
        $this->load->helper('cookie');
        $promotionData = $this->input->cookie(config_item('cookie_prefix').'promotion');

        $promotionData = empty ($promotionData) ? array() : json_decode($promotionData, true);

        return $promotionData;
    }

    /**
     * 设置活动
     *
     * @param array $promotion
     * @param bool $flag true 添加 false 删除
     * @param int $timeOut
     * @return array|mixed
     */
    public function setPromotion(array $promotion, $flag = true, $timeOut = 10000000)
    {
        $this->load->helper('cookie');

        $pData = array(
            'promotion_id' => $promotion['promotion_id'],
        );

        $promotionData = $this->getUsedPromotion();
        //echo '<pre>';print_r($promotionData);exit;

        //标识为真 则添加活动，如为假则删除活动
        if ($flag) {
            if (!empty ($promotionData)) {
                foreach ($promotionData as &$pv) {
                    if ($pv['promotion_id'] != $pData['promotion_id']) {
                        $promotionData[] = $pData;
                    }
                }
            } else {
                $promotionData[] = $pData;
            }

        } else {
            foreach ($promotionData as $k=>$v) {
                if ($v['promotion_id'] == $pData['promotion_id']) {
                    unset ($promotionData[$k]);
                }
            }
        }

        $this->input->set_cookie('promotion', json_encode($promotionData), $timeOut);

        return $promotionData;
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

    /**
     * 检查请求是否过期
     * @return mixed
     */
    protected function HTTPLastModified()
    {
        $IF_MODIFIED_SINCE = $this->input->server('HTTP_IF_MODIFIED_SINCE');
        if($IF_MODIFIED_SINCE !== false
            && (TIMESTAMP - (strtotime($IF_MODIFIED_SINCE) ) < config_item('http_expires'))) //(当前时间减去最后修改时间) < 不满过期周期
        {
            $this->output->set_status_header(304);
            die;
        }
        else
        {
            $Last_Modified = gmdate('D, d M Y H:i:s', TIMESTAMP) . ' GMT'; //修改时间
            $Expires = gmdate('D, d M Y H:i:s', TIMESTAMP + config_item('http_expires')) . ' GMT'; //过期时间
            $this->output->set_header('Last-Modified: ' . $Last_Modified);
            $this->output->set_header('Expires: ' . $Expires);
        }
        return ;
    }

    /**
     * 计算折扣
     *
     * @param array $cartData 购物车中所有数据
     * @param array $returnOpt 返回数据选项,默认返回产品数据，unused_promotion 未使用的活动，used_promotion 已使用的活动
     * @return array
     */
    public function calculateDiscount(array $cartData, $returnOpt = null)
    {
        $data = array();
        $promotion = $this->getUsedPromotion();
        $this->load->model('promotion/model_promotion', 'promotion');

        $productInfo = array();
        foreach($cartData as $cv)
        {
            $productInfo[] = array(
                'pid' => $cv['pid'],
                'pname' => $cv['pname'],
                'sell_price' => $cv['product_price'],
                'num' => $cv['product_num'],
                'size_id' => $cv['size_id'],
                'product_size' => $cv['product_size'],
                'additional_info' => $cv['additional_info'],
            );
        }

        $this->promotion->add_product($productInfo);

        $promotionIdTmpArr = array();
        foreach ($promotion as $pv) {
            $promotionIdTmpArr[] = $pv['promotion_id'];
        }

        $this->promotion->use_promotion($promotionIdTmpArr); //使用活动 1
        $this->promotion->compute();

        $data = $this->promotion->result();

        if ($returnOpt && in_array('unused_promotion', $returnOpt)) {
            $data['unused_promotion'] = $this->promotion->get_unused_promotion();
        }

        if ($returnOpt && in_array('used_promotion', $returnOpt)) {
            $data['used_promotion'] = $this->promotion->get_used_promotion();
        }
        //p($data);exit;
        return $data;
    }

    /**
     * 获取用户已使用的卡
     *
     * @return array|mixed
     */
    public function getUseCard()
    {
        $cardList = $this->input->cookie(config_item('cookie_prefix').'gift_card');
        $cardList = empty ($cardList) ? array() : json_decode(authcode($cardList, 'DECODE'), true);
        return $cardList;
    }

    /**
     * 设置用户已使用的卡
     *
     * @param $cardList
     * @param int $timeOut
     */
    public function setUseCard($cardList, $timeOut = 3600)
    {
        $this->input->set_cookie('gift_card', authcode(json_encode($cardList), 'ENCODE'), $timeOut);
    }
}
