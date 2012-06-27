<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>万象电子商务管理系统</title>
    <link rel="stylesheet" href="/css/reset.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="/css/style.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="/css/invalid.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="/scripts/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="/scripts/simpla.jquery.configuration.js"></script>
    <script type="text/javascript" src="/scripts/facebox.js"></script>
    <script type="text/javascript" src="/scripts/jquery.wysiwyg.js"></script>
    <script language="javascript" type="text/javascript" src="/scripts/My97DatePicker/WdatePicker.js"></script>
</head>
<body>
<div id="body-wrapper">
    <div id="sidebar">
        <div id="sidebar-wrapper">
            <!-- Sidebar with logo and menu -->
            <h1 id="sidebar-title"><a href="#">万象电商管理系统</a></h1>
            <!-- Logo (221px wide) -->
            <a href="#">万象电商管理系统<!--<img id="logo" src="/images/logo.png" alt="Simpla Admin logo"/>--></a>
            <br/><br/><br/><br/>
            <!-- Sidebar Profile links -->
            <div id="profile-links"> Hello, <a href="#" title="Edit your profile"><?php echo $this->amInfo['am_uname'];?></a>
                <!--, you have <a href="#messages" rel="modal" title="3 Messages">3 Messages</a><br/>-->
                <br/><br/>
                <a href="http://wunxin.com" title="View the Site">查看网站首页</a> |
                <a href="<?=site_url('administrator/admin_login/logout')?>" title="Sign Out">退出</a></div>
            <ul id="main-nav">
                <!-- Accordion Menu -->
                <li>
                    <a href="#" class="nav-top-item <?php if(strpos($this->uri->segment(2) ,'product') === 0):?>current<?php endif;?>">产品管理</a>
                    <ul>
                        <li><a href="<?=site_url('administrator/product/index')?>">产品管理</a></li>
                        <li><a href="<?=site_url('administrator/product_category/index')?>">产品分类</a></li>
                        <li><a href="<?=site_url('administrator/product_model/index')?>">产品模型</a></li>
                        <li><a href="<?=site_url('administrator/product_size/index')?>">产品尺码</a></li>
                        <li><a href="<?=site_url('administrator/product_color/index')?>">产品颜色</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-top-item <?php if(strpos($this->uri->segment(2) ,'order') === 0):?>current<?php endif;?>">订单列表</a>
                    <ul>
                        <li><a href="/administrator/order/orderList">订单列表</a></li>
                        <li><a href="/administrator/order_receiver/receivableList">收款单列表</a></li>
                        <li><a href="/administrator/order_picking/pickingList">配货单列表</a></li>
                        <li><a href="/administrator/order_express/expressList">快递公司列表</a></li>

                    </ul>
                </li>
                <li><a href="#" class="nav-top-item <?php if(strpos($this->uri->segment(2) ,'user') === 0):?>current<?php endif;?>">用户管理</a>
                    <ul>
                        <li><a href="/administrator/user/userList">用户列表</a></li>

                    </ul>
                </li>
                <li><a href="#" class="nav-top-item <?php if(strpos($this->uri->segment(2) ,'design') === 0):?>current<?php endif;?>">设计图管理</a>
                    <ul>
                        <li><a href="/administrator/design/designList">设计图管理</a></li>
                        <li><a href="/administrator/design_category/index">设计图分类管理</a></li>
                        <li><a href="/administrator/design_comment/commentList">设计图评论列表</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-top-item <?php if(strpos($this->uri->segment(2) ,'article') === 0):?>current<?php endif;?>">新闻管理</a>
                    <ul>
                        <li><a href="/administrator/article_category/categoryList" title="分类管理">分类管理</a></li>
                        <li><a href="/administrator/article/articleList" title="文章管理">文章管理</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-top-item <?php if(strpos($this->uri->segment(2) ,'business') === 0):?>current<?php endif;?>">业务管理</a>
                    <ul>
                        <li><a href="/administrator/business_ad_position/positionList" title="">广告管理</a></li>
                        <li><a href="/administrator/business_ad/adList" title="">广告管理</a></li>
                        <li><a href="/administrator/business_card_model/cardModelList" title="">礼物卡管理</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-top-item <?php if(strpos($this->uri->segment(2) ,'activity') === 0):?>current<?php endif;?>">活动管理</a>
                    <ul>
                        <li><a href="/administrator/activity/activityList/">活动管理</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-top-item <?php if(strpos($this->uri->segment(2) ,'recommend') === 0):?>current<?php endif;?>">推荐管理</a>
                    <ul>
                        <li><a href="/administrator/recommend_home/recommendList" title="">推荐列表</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-top-item <?php if(strpos($this->uri->segment(2) ,'other') === 0):?>current<?php endif;?>">其他管理</a>
                    <ul>
                        <li><a href="/administrator/other_system_proposal/systemProposalList" title="">建议与意见</a></li>
                    </ul>
                </li>
            </ul>
            <!-- End #main-nav -->
            <div id="messages" style="display: none">
                <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
                <h3>3 Messages</h3>

                <p><strong>17th May 2009</strong> by Admin<br/>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet
                    congue.
                    <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
                </p>
                <p><strong>2nd May 2009</strong> by Jane Doe<br/>
                    Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis,
                    tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.
                    <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
                </p>
                <p><strong>25th April 2009</strong> by Admin<br/>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet
                    congue.
                    <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
                </p>
                <form action="#" method="post">
                    <h4>New Message</h4>
                    <fieldset>
                        <textarea class="textarea" name="textfield" cols="79" rows="5"></textarea>
                    </fieldset>
                    <fieldset>
                        <select name="dropdown" class="small-input">
                            <option value="option1">Send to...</option>
                            <option value="option2">Everyone</option>
                            <option value="option3">Admin</option>
                            <option value="option4">Jane Doe</option>
                        </select>
                        <input class="button" type="submit" value="Send"/>
                    </fieldset>
                </form>
            </div>
            <!-- End #messages -->
        </div>
    </div>
    <!-- End #sidebar -->