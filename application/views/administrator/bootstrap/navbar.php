<?php
$_view_nav_conf = array(
    array('title' => '产品', 'links' => array(
        array('title' => '产品管理', 'url' => 'product/index'),
        array('title' => '产品分类', 'url' => 'product_category/index'),
        array('title' => '产品模型', 'url' => 'product_models/model_index'),
        array('title' => '产品尺码', 'url' => 'product_size/index'),
        array('title' => '产品颜色', 'url' => 'product_color/index'),
        array('title' => '产品搭配', 'url' => 'product_collocation/pcList/'),
        array('title' => '产品款式', 'url' => 'product_style/create/'),
    )),
    array('title' => '订单', 'links' => array(
        array('title' => '订单管理', 'url' => 'order/orderList'),
        array('title' => '收款单', 'url' => 'order_receiver/receivableList'),
        array('title' => '配货单', 'url' => 'order_picking/pickingList'),
        array('title' => '快递公司', 'url' => 'order_express/expressList'),
    )),
    array('title' => '用户', 'links' => array(
        array('title' => '用户管理', 'url' => 'user/userList'),
    )),
    array('title' => '设计图', 'links' => array(
        array('title' => '设计图管理', 'url' => 'design/designList'),
        array('title' => '设计图分类', 'url' => 'design_category/index'),
        array('title' => '设计图评论', 'url' => 'design_comment/commentList'),
    )),
    array('title' => '新闻', 'links' => array(
        array('title' => '文章管理', 'url' => 'article/articleList'),
        array('title' => '分类管理', 'url' => 'article_category/categoryList'),
    )),
    array('title' => '业务', 'links' => array(
        array('title' => '广告管理', 'url' => 'business_ad_position/positionList'),
        array('title' => '礼物卡管理', 'url' => 'business_card_model/cardModelList'),
        array('title' => '团购管理', 'url' => 'business_tuan/tuanList'),
        array('title' => '促销活动', 'url' => 'business_promotion/lists'),
        array('title' => '积分换购产品', 'url' => 'business_integral_redemption/redemptionList'),
        array('title' => '邮件订阅', 'url' => 'business_mail_subscribe/mailSubscribeList'),
    )),
    array('title' => '活动', 'links' => array(
        array('title' => '活动管理', 'url' => 'activity/activityList/'),
    )),
    array('title' => '推荐', 'links' => array(
        array('title' => '推荐位管理', 'url' => 'recommend_home/recommendList'),
    )),
    array('title' => '其他', 'links' => array(
        array('title' => '建议与意见', 'url' => 'other_system_proposal/systemProposalList'),
        array('title' => '淘宝产品链接列表', 'url' => 'tool/crawlProductList'),
    )),
);
?>
<!--头部靠航开始-->
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?=url('admin')?>">万象电商管理系统 </a>
            <div class="nav-collapse">
                <p class="navbar-text pull-right"><i class="icon-white icon-user"></i><?=$this->amInfo['am_uname'];?> <a href="<?=url('admin')?>administrator/admin_login/logout">退出</a></p>
                <ul class="nav">
                    <li class="active"><a href="<?=url('admin')?>administrator">首页</a></li>
                    <?php foreach($_view_nav_conf as $item):?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?=$item['title']?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php foreach($item['links'] as $v):?>
                            <li><a href="<?php echo url('admin'),'administrator/',$v['url']?>"><?=$v['title']?></a></li>
                            <?php endforeach;?>
                            <!--分割线 li class="divider"></li-->
                            <!--li class="nav-header">导航头</li-->
                        </ul>
                    </li>
                    <?php endforeach;?>
                </ul>

            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!--头部靠航结束-->