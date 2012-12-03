<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-25
 * Time: 下午6:24
 * To change this template use File | Settings | File Templates.
 */
class main extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        if(! $this->input->is_ajax_request()){
            $this->load->model('product/Model_Product_Category', 'cate');
            $this->channel = $this->cate->getCategroyList();
        }
    }

    public function index()
    {
        //log_message('PAYLOG', '111111111111111111111');
        //header('HTTP/1.1 304 Not Modified');die;
        //header('Last-Modified: '.gmdate('D, d M Y 01:01:01',strtotime('2013-08-08 00:00:00')).' GMT');
        //header('Expires: Mon, 29 Jan 2014 08:56:01 GMT');

        //header("Cache-Control: maxage=".time()+36000);
        //header('Expires: Mon, 29 Jan 2014 08:56:01 GMT');
        //header('Last-Modified: '.gmdate('D, d M Y 01:01:01',strtotime('2013-08-08 00:00:00')).' GMT');

        //$interval = 86400;
        //header ("Last-Modified: " . gmdate ('r', time()));
        //header ("Expires: " . gmdate ("r", (time() + $interval)));
        //header ("Cache-Control: max-age=$interval");


        $this->load->model('product/Model_Product', 'product');
        $this->load->model('recommend/Model_Home_Recommend', 'recommend');

        //转播图
        $broadcast_recommend = $this->recommend->getRecommendCategoryList(9, 10);

        //今日推荐
        $day_recommend = $this->recommend->getRecommendCategoryList(1, 6);

        //产品推荐
        $product_recommend = $this->recommend->query('select * from wx_recommend where cid=2 order by sort desc limit 1');
        $tmpProductId = explode(',', $product_recommend[0]['pid']);
        $this->load->model('design/Model_Design', 'design');
        //$design_recommend_data = $this->design->getDesignByDid($tmpDesignId, 'did, dname');
        $product_recommend_data = $this->product->getProductById($tmpProductId, 'pid,pname,market_price,sell_price');
        //echo '<pre>';print_r($product_recommend_data);exit;

        //广告推荐
        $AD_recommend = $this->recommend->getRecommendCategoryList(3, 3);

        //男款推荐
        $man_recommend_2_3 = $this->recommend->query('select * from wx_recommend where cid=4 and emission in(2,3) order by sort desc limit 2');

        $man_product_1_recommend = $this->recommend->query('select * from wx_recommend where cid=4 and emission=4');
        $tmpProductId = explode(',', $man_product_1_recommend[0]['pid']);
        $man_product_1_recommend_data = $this->product->getProductById($tmpProductId, 'pid,pname,market_price,sell_price');

        $man_product_2_recommend = $this->recommend->query('select * from wx_recommend where cid=4 and emission=1');
        $tmpProductId = explode(',', $man_product_2_recommend[0]['pid']);
        $man_product_2_recommend_data = $this->product->getProductById($tmpProductId, 'pid,pname,market_price,sell_price, style_no');


        //女款推荐
        $woman_recommend_1_2_3_4_5_6 = $this->recommend->query('select * from wx_recommend where cid=5 and emission in(1,2, 3,4,5,6) order by sort desc limit 6');

        $woman_product_recommend = $this->recommend->query('select * from wx_recommend where cid=5 and emission=7');
        $tmpProductId = explode(',', $woman_product_recommend[0]['pid']);
        $woman_product_recommend_data = $this->product->getProductById($tmpProductId, 'pid,pname,market_price,sell_price');


        //情侣推荐   //情侣产品推荐
        $lover_recommend = $this->recommend->getRecommendCategoryList(6, 1);

        $lover_product_recommend = $this->recommend->query('select * from wx_recommend where cid=6 and emission=2');
        $tmpProductId = explode(',', $lover_product_recommend[0]['pid']);
        $lover_product_recommend_data = $this->product->getProductById($tmpProductId, 'pid,pname,market_price,sell_price');//($pid, $field = '*', $where = null, $order = null)


        //亲子推荐    //亲子产品推荐
        $family_recommend = $this->recommend->query('select * from wx_recommend where cid=7 and emission in(1,2,3,4,5,6,7) order by sort desc limit 7;');

        $family_product_recommend = $this->recommend->query('select * from wx_recommend where cid=7 and emission=8');
        $tmpProductId = explode(',', $family_product_recommend[0]['pid']);
        $family_product_recommend_data = $this->product->getProductById($tmpProductId, 'pid,pname,market_price,sell_price');//($pid, $field = '*', $where = null, $order = null)


        //设计师推荐 设计师产品推荐
        $user_recommend = $this->recommend->getRecommendCategoryList(8, 1);
        $tmpUserData = explode(',', $user_recommend[0]['pid']);

        $this->load->model('user/Model_User', 'user');
        $user_recommend_data = $this->user->getUserById($tmpUserData, 'uid, uname, nickname, integral, amount, favorite_num, create_time', array('status' => 1));
        $userProduct = $this->product->getUserProduct($user_recommend_data[0]['uid'], 3, 0, 'pid,pname,market_price,sell_price', null, 'sales desc');
        //($uId, $limit = 20, $offset = 0, $field = '*', $where = null, $orderBy = null)

        $this->load->model('article/Model_Article', 'article');
        $bulletin = $this->article->getNewsCategoryList(1, 6);
        $news = $this->article->getNewsCategoryList(2, 6);



        $data = array(
            'title' => '万象网 - 象你象我 却不是你我; 形似 神似 却也不似 我是万象',
            'broadcast_recommend' => $broadcast_recommend,
            'day_recommend' => $day_recommend,
            'product_recommend_data' => $product_recommend_data,
            'AD_recommend' => $AD_recommend,
            'man_recommend_2_3' => $man_recommend_2_3,
            'man_product_1_recommend_data' => $man_product_1_recommend_data,
            'man_product_2_recommend_data' => $man_product_2_recommend_data,
            'woman_recommend_1_2_3_4_5_6' => $woman_recommend_1_2_3_4_5_6,
            'woman_product_recommend_data' => $woman_product_recommend_data,
            'lover_recommend' => $lover_recommend,
            'lover_product_recommend_data' => $lover_product_recommend_data,
            'family_recommend' => $family_recommend,
            'bulletin' => $bulletin,
            'news' => $news,
            'user_recommend' => $user_recommend_data,
            'user_product' => $userProduct,
            'family_product_recommend_data' => $family_product_recommend_data,
        );
        $this->load->view('welcomes_index', $data);
    }

    /**
     * 获取用户产品
     *
     * @return bool
     */
    public function getUserProduct()
    {
        $uId = intval($this->input->get_post('uid'));

        if ( empty ($uId) ) {
            return false;
        }

        $this->load->model('product/Model_Product', 'product');
        $userProduct = $this->product->getUserProduct($uId, 3, 0, 'pid,pname,market_price,sell_price', null, 'sales desc');
//echo '<pre>';print_r($userProduct);exit;
        self::json_output( $userProduct );
    }
}