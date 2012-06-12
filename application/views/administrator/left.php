<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>万象电子商务管理系统</title>
    <!--                       CSS                       -->
    <!-- Reset Stylesheet -->
    <link rel="stylesheet" href="/css/reset.css" type="text/css" media="screen"/>
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="/css/style.css" type="text/css" media="screen"/>
    <!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
    <link rel="stylesheet" href="/css/invalid.css" type="text/css" media="screen"/>
    <!--                       Javascripts                       -->
    <!-- jQuery -->
    <script type="text/javascript" src="/scripts/jquery-1.3.2.min.js"></script>
    <!-- jQuery Configuration -->
    <script type="text/javascript" src="/scripts/simpla.jquery.configuration.js"></script>
    <!-- Facebox jQuery Plugin -->
    <script type="text/javascript" src="/scripts/facebox.js"></script>
    <!-- jQuery WYSIWYG Plugin -->
    <script type="text/javascript" src="/scripts/jquery.wysiwyg.js"></script>
    <!-- jQuery Datepicker Plugin -->
    <script type="text/javascript" src="/scripts/jquery.datePicker.js"></script>
    <script type="text/javascript" src="/scripts/jquery.date.js"></script>
</head>
<body>
<div id="body-wrapper">
    <!-- Wrapper for the radial gradient background -->
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
                <a href="/administrator/admin_login/loginOut" title="Sign Out">退出</a></div>
            <ul id="main-nav">
                <!-- Accordion Menu -->
                <li>
                    <a href="#" class="nav-top-item current">
                        <!-- Add the class "no-submenu" to menu items with no sub menu --> 产品管理 </a>
                    <ul>
                        <li><a href="/administrator/main/index">产品管理</a></li>
                        <li><a href="/administrator/product_category/index">产品分类管理</a></li>
                        <li><a href="/administrator/product_model/index">产品模型管理</a></li>
                        <li><a href="/administrator/product_model/create">产品模型添加</a></li>
                        <li><a href="/administrator/product_model/create">产品尺码管理</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-top-item no-submenu"> <!-- Add the class "current" to current menu item -->
                    订单列表 </a>
                    <ul>
                        <li><a href="/administrator/order/orderList">订单列表</a></li>
                        <li><a href="#">收款单列表</a></li>
                        <li><a href="#">配货单列表</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-top-item"> 设计图管理 </a>
                    <ul>
                        <li><a href="/administrator/design/designList">设计图管理</a></li>
                        <!--<li><a href="/administrator/design/designList">设计图列表</a></li>-->
                        <li><a href="/administrator/design/comment">设计图评论列表</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-top-item"> 新闻管理 </a>
                    <ul>
                        <li><a href="#" title="">分类管理</a></li>
                        <li><a href="#" title="">文章管理</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-top-item"> 业务管理 </a>
                    <ul>
                        <li><a href="#" title="">广告管理</a></li>
                        <li><a href="#" title="">广告位管理</a></li>
                        <li><a href="#" title="">礼物卡管理</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-top-item"> 活动管理 </a>
                    <ul>
                        <li><a href="/administrator/am_activity/addActivity">活动添加</a></li>
                        <li><a href="#">活动管理</a></li>
                        <li><a href="#">文章管理</a></li>
                    </ul>
                </li>
                <li><a href="#" class="nav-top-item"> 其他管理 </a>
                    <ul>
                        <li><a href="#" title="">建议与意见</a></li>
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