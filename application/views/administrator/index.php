<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>万象电子商务后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css" media="all">
        @import url(/css/style.css);

        img {
            behavior: url('/js/iepngfix.htc') !important;
        }
    </style>
    <script src="/js/jquery.js" type="text/javascript"></script>
    <script src="/js/jquery_ui.js" type="text/javascript"></script>
    <script src="/js/wysiwyg.js" type="text/javascript"></script>
    <script src="/js/functions.js" type="text/javascript"></script>

</head>
<body>
<div id="container"> <!-- Container -->
    <div id="header"> <!-- Header -->
        <div id="title">
            万象电子商务管理系统
            <span>专业的服装电子商务企业</span>
        </div>
        <div class="logged">
            <p>你好, <a href="#" title=""><?php echo $username; ?></a>!</p>
            <p><a href="#">我的账号</a> | <a href="/administrator/admin_login/loginOut">退出</a></p>
            <!-- <p> <a href="#">12 unred messages</a>!</p> -->
        </div>
    </div>
    <div id="sidebar"> <!-- Sidebar -->
        <div class="sidebox">
            <span class="stitle">导航栏</span>

            <div id="navigation"> <!-- Navigation begins here -->
                <div class="sidenav"><!-- Sidenav -->
                    <div class="navhead_blank"><span><a href="#" title="">主菜单</a></span></div>
                    <div class="navhead"><span>产品管理</span></div>
                    <div class="subnav">
                        <ul class="submenu">
                            <li><a href="/administrator/main/index" target="content_iframe">产品管理</a></li>
                            <li><a href="/administrator/product_category/index" target="content_iframe">产品分类管理</a></li>
                            <li><a href="/administrator/product_model/index" target="content_iframe">产品模型管理</a> </li>
                            <li><a href="/administrator/product_model/create" target="content_iframe">产品模型添加</a></li>

                            <li><a href="/administrator/product_model/create" target="content_iframe">产品尺码管理</a></li>
                        </ul>
                    </div>
                    <div class="navhead"><span>订单管理</span></div>
                    <div class="subnav">
                        <ul class="submenu">
                            <li><a href="#" title="">订单列表</a></li>
                            <li><a href="#" title="">收款单列表</a></li>

                            <li><a href="#" title="">配货单列表</a></li>
                        </ul>
                    </div>
                    <div class="navhead"><span>用户管理</span></div>
                    <div class="subnav">
                        <ul class="submenu">
                            <li><a href="#" title="">用户列表</a></li>
                            <li><a href="#" title="">用户等级管理</a></li>

                            <li><a href="#" title="">用户评论管理</a></li>
                            <li><a href="#" title="">后台用户理员</a></li>


                        </ul>
                    </div>
                    <div class="navhead"><span>设计图管理</span></div>
                    <div class="subnav">
                        <ul class="submenu">
                            <li><a href="#" title="">设计图管理</a></li>
                            <li><a href="#" title="">设计图评论</a></li>
                        </ul>
                    </div>

                    <div class="navhead"><span>新闻管理</span></div>
                    <div class="subnav">
                        <ul class="submenu">
                            <li><a href="#" title="">分类管理</a></li>
                            <li><a href="#" title="">文章管理</a></li>
                        </ul>
                    </div>

                    <div class="navhead"><span>业务管理</span></div>
                    <div class="subnav">
                        <ul class="submenu">
                            <li><a href="#" title="">广告管理</a></li>
                            <li><a href="#" title="">广告位管理</a></li>
                            <li><a href="#" title="">礼物卡管理</a></li>
                        </ul>
                    </div>

                    <div class="navhead"><span>活动管理</span></div>
                    <div class="subnav">
                        <ul class="submenu">
                            <li><a href="/administrator/activity/am_activity/addActivity">活动添加</a></li>
                            <li><a href="#" title="">活动管理</a></li>
                            <li><a href="#" title="">文章管理</a></li>
                        </ul>
                    </div>

                    <div class="navhead"><span>其他管理</span></div>
                    <div class="subnav">
                        <ul class="submenu">
                            <li><a href="#" title="">建议与意见</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END Navigation -->
        </div>
        <div class="sidebox">
            <span class="stitle">Additional Panel</span>

            <div id="datepicker"></div>

        </div>
        <div class="sidebox">
            <span class="stitle">Photo gallery</span>

            <div class="gallery">
                <img src="/images/1.jpg" alt="" width="100" height="75"/>
                <img src="/images/2.jpg" alt="" width="100" height="75"/>
                <img src="/images/3.jpg" alt="" width="100" height="75"/>
                <img src="/images/4.jpg" alt="" width="100" height="75"/>
                <img src="/images/5.jpg" alt="" width="100" height="75"/>
                <img src="/images/6.jpg" alt="" width="100" height="75"/>
            </div>
        </div>
        <div class="sidebox">
            <span class="stitle">Sales information</span>

            <p><b>103 products</b> sold today.</p>

            <p><b>213 products</b> sold yesterday.</p>

            <p><b>More information:</b></p>

            <p>Cras scelerisque dolor in quam. Cras eu nunc. Integer bibendum nisl quis sem. Aenean sed tortor non eros
                vehicula vehicula. Maecenas vitae enim. Donec neque. Cras lacus. Cras in ligula sed justo fringilla
                porttitor.</p>
        </div>
    </div>
    <!-- END Sidebar -->
    <div id="main"> <!-- Main, right side content -->
        <div id="content">
            <iframe src="" width="100%" height="500%" id="content_iframe" scrolling="auto" frameborder="0"
                    name="content_iframe" onload="Javascript:SetWinHeight(this)"></iframe>
        </div>
    </div>

</div>
<!-- END Container -->
<div id="footer" style="text-align:center;">
    <p>Copyright 万象乾鑫科技有限公司 2012 - <?php echo date('Y')?>. All rights reserved.</p>
</div>
</body>
</html>
<script>
    function SetWinHeight(obj) {
        var win = obj;
        if (document.getElementById) {
            if (win && !window.opera) {
                if (win.contentDocument && win.contentDocument.body.offsetHeight)
                    win.height = win.contentDocument.body.offsetHeight + 100;
                else if (win.Document && win.Document.body.scrollHeight)
                    win.height = win.Document.body.scrollHeight + 100;
            }
        }
    }
</script>