<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-6-8
 * Time: 下午10:28
 * To change this template use File | Settings | File Templates.
 */
class activity extends MY_Controller
{
    /**
     * 限时抢购
     */
    public function qiang()
    {
        $promotionId = intval($this->uri->segment(4, 0));
        if (!$promotionId) {
            show_error('活动ID不存在！');
        }

        $date = date('Y-m-d H:i:s');
        $this->load->model('business/model_business_promotion', 'promotion');
        $promotion = $this->promotion->getPromotion($promotionId, 2, 0, '*', array('start_time <=' => $date, 'end_time >=' => $date));
        if (empty ($promotion)) {
            show_error('活动不存在！');
        }

        $this->load->model('business/model_business_promotion_product', 'product');
        $product = $this->product->getProductByPromotionId($promotionId);

        //getProductList($limit = 20, $offset = 0, $field = '*', $where = null, $order = null)
        $beforeWhere = array(
            'promotion_id' => $promotionId,
            'end_time <' => date('Y-m-d H:i:s', TIMESTAMP)
        );
        $beforeLimitBuy = $this->product->getProductList(5, 0, '*', $beforeWhere, 'sort desc');
        //echo '<pre>';print_r($beforeLimitBuy);exit;

        $defaultWhere = array(
            'promotion_id' => $promotionId,
            'start_time <=' => date('Y-m-d H:i:s', TIMESTAMP),
            'end_time >=' => date('Y-m-d H:i:s', TIMESTAMP),
            'cid' => '0',
        );
        $defaultLimitBuy = $this->product->getProductList(6, 0, '*', $defaultWhere, 'sort desc');

        $data = array(
            'promotion' => $promotion,
            'product' => $product,
            'before_lb' => $beforeLimitBuy,
            'default_lb' => $defaultLimitBuy,
            'sales_status' => config_item('sales_status'),
        );
        $this->load->view('activity/qiang_gou', $data);
    }

    /**
     * 问卷调查
     */
    public function survey()
    {
        $this->load->view('activity/survey');
    }

    /**
     * 回答问卷
     */
    public function reportAnswer()
    {
        $id = intval($this->input->get_post('id'));
        $reportId = intval($this->input->get_post('report_id'));
        $response = array('error' => '0', 'msg' => '回答成功', 'code' => 'answer_success');

        do {
            if (empty ($id) || empty ($reportId)) {
                $response = error(70013);
                break;
            }

            $this->load->database();
            $data = $this->db->get_where('survey', array('id' => $id))->row_array();
            //$data = $this->db->row_result();
            //echo '<pre>';print_r($data);exit;

            if (empty ($data)) {
                $response = error(70014);
                break;
            }

            $info = array(
               'answer_id' => $id,
               'report_id' => $reportId,
               'create_time' => date('Y-m-d H:i:s', TIMESTAMP),
            );


            $this->db->insert('survey_log', $info);
        } while (false);

        self::json_output($response);
    }

    /**
     * 系统建议与意见
     */
    public function proposal()
    {
        $this->load->view('activity/proposal');
    }

    /**
     * 特价热卖
     */
    public function discount()
    {
        $promotionId = intval($this->uri->segment(4, 0));
        if (!$promotionId) {
            show_error('活动ID不存在！');
        }

        $date = date('Y-m-d H:i:s');
        $this->load->model('business/model_business_promotion', 'promotion');
        $promotion = $this->promotion->getPromotion($promotionId, 2, 0, '*', array('start_time <=' => $date, 'end_time >=' => $date));
        if (empty ($promotion)) {
            show_error('活动不存在！');
        }

        $this->load->model('business/model_business_promotion_product', 'product');
        $product = $this->product->getProductByPromotionId($promotionId, 20);
        //$this->product->getProductList();//($limit = 20, $offset = 0, $field = '*', $where = null, $order = null)
//echo '<pre>';print_r($product);exit;
        $info = array(
            'promotion' => $promotion,
            'product' => $product,
        );
        $this->load->view('activity/discount', $info);
    }

    public function hot_comment()
    {
        $limit = 30;
        $offset = $this->input->get_post('offset');
        $offset = empty ($offset) ? 1 : $offset ;
        $offset = ($offset - 1) * $limit;

        $this->load->model('product/Model_Product', 'product');
        $this->load->model('product/Model_Product_comment', 'comment');
        $pid = $this->product->getProductList($limit, $offset, "pid,pname,comment_num", array('comment_num >=' => 2), 'comment_num desc');
        if (!empty ($pid)) {
            foreach ($pid as $k => $v) {
                $commentData = $this->comment->getProductCommentById($v['pid'], 2);
                $pid[$k]['comment'] = $commentData;
            }
        }

        if($this->input->is_ajax_request() !== true) {
            $info = array(
                'title' => '热门评论',
                'comment_data' => $pid,
            );
            $this->load->view('activity/hot_comment', $info);
        } else {
            $html = '';
            foreach ($pid as $cv) {
                //*
                $html .= '<div class="poster_grid" >
                    <div class="new_poster">
                        <div class="np_pic hover_pic">
                            <div class="no"></div>
                            <a target="_blank" href="" class="pic_load">
                                <img width="164" height="197" src="'.config_item('static_url').'images/lazy.gif"
                                     data-original="'.config_item('static_url').'upload/product/'.intToPath($cv['pid']).'default.jpg" class="goods_pic" alt="产品"/>
                            </a>
                            <div class="like_merge" style="display: none;">
                                <a href="javascript:void(0)" class="right_f poster_forward">
                                    <em class="lm_shouji">&nbsp;</em>收进杂志&nbsp;<span class="poster_forward_num line_num">265</span>
                                </a>
                            </div>
                        </div>
                        <div class="comm_box twiiter_box"><p class="posterContent">'.$cv['pname'].'</p>

                            <p class="comm_num l20_f">
                                <a href="javascript:void(0)" class="poster_comment pl">评论 <span class="poster_comment_num">'.$cv['comment_num'].'</span></a>
                                <a href="javascript:void(0)" class="left_f poster_likes likes " isshowlike="1">
                                    <b class="likes_status"> <i class="lm_love2">&nbsp;</i>喜欢 </b> <span class="red_f poster_like_num">'.($cv['comment_num'] * 8).'</span>
                                </a>
                                <a class="love_pro none_f">这是你自己分享的哦！</a></p>
                            <div class="clear_f"></div>
                        </div>';

                        $i = 0;foreach ($cv['comment'] as $comment_value) {
                        $html .= '<div class="comm_share commentHover">
                            <a target="_blank" href="javascript:void(0);" class="avatar32_f trans07 userInfoTips">
                                <img src="'.config_item('static_url').'images/lazy.gif"
                                     data-original="'.config_item('static_url').'upload/designer/'.intToPath($comment_value['uid']).'default.jpg">
                            </a>
                            <p class="ml40_f">
                                <a target="_blank" href="javascript:void(0);" class="fb_f">'.$comment_value['uname'].'</a> <span class="gray_f">'.$comment_value['title'].'</span>
                                <a href="javascript:void(0)" class="comment_reply v_hidden" style="visibility: hidden;">回复</a>
                            </p>
                            <div class="clear_f"></div>
                        </div>';
                        }
                        $html .= '<div class="comm_share c_f"><a target="_blank" href="'.productURL($cv['pid']).'"> 查看全部'.$cv['comment_num'].'条评论...</a></div>
                    </div>
                </div>';
                //*/
            }
            echo $html;
        }
    }
}
