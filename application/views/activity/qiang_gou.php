<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $title;?> -- 万象网</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></SCRIPT>
    <SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/index.js"></SCRIPT>
    <script type="text/javascript" charset=utf-8 src="<?=config_item('static_url')?>scripts/lrscroll.js"></script>
    <script type="text/javascript" charset=utf-8 src="<?=config_item('static_url')?>scripts/artdialog.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
        .wrapper {
            margin: 0 auto;
            width: 980px;
        }
        .clearfix:after {
            clear: both;
            content: ".";
            display: block;
            font-size: 0;
            height: 0;
            visibility: hidden;
        }
        a{ color:#333; text-decoration:none;}
        a:hover,.cate_item h3 a:hover,.cate_item p a:hover,.subcate li a:hover,.mod_hd .more:hover{ color:#cc0000; text-decoration:underline;}
        .recommendmod h3 a:hover,.snapmod h4 a:hover{ text-decoration:none;}

        .contentbg{ padding-bottom:61px; background: url(/images/contentbg.png) 0 bottom repeat-x; background-color:#fafafa;}
        .qiangbtn_small,.mod_hd h3,.qiangbtn_red,.ended,.qiangbtn_blue,.ico_baoyou,.ico_remai,.ico_xinpin,.ico_fengqiang,.seebtn,.left_turn,.right_turn,.left_turn_hov,.right_turn_hov,.left_turn_no,.right_turn_no,.sort_default,.sortlist .s_1,.sortlist .s_2,.sortlist .s_3{ background:url(/images/pic.png) no-repeat;}

        .side{ width:230px; float:left;}
        .main{ width:980px; float:right;}
        .mt{ margin-top:10px;}
        .mt20{ margin-top:20px;}

        /*ad_div 广告位*/
        .ad_div{ font:0/0 arial;}
        .ad_div div{ margin-top:10px;}

        /*qiangnav_mod 二导航*/
        .qiangnav_mod{ border-top:2px solid #ee8700; border-bottom:1px solid #f0f0f0; background-color:#fff5e5;}
        .qiangnav_mod ul{ width:1200px; margin:0 auto; padding:6px 0 7px;}
        .qiangnav_mod li{ float:left; height:26px; margin-right:23px; line-height:26px;}
        .qiangnav_mod li a,.qiangnav_mod li span{ display:block; font-size:14px; color:#333; margin:0 10px;}
        .qiangnav_mod li a:hover{ padding:0 10px; margin:0; border-radius:2px; background:#ffe2b2; text-decoration:none;}
        .qiangnav_mod .now{ background:#f90; font-weight:bold; border-radius:2px;}
        .qiangnav_mod .now span{ padding:0 9px; margin:0; color:#fff;}

        /*recommendmod 限时限量抢*/
        .recommendmod{ width:980px; height:474px; margin:15px auto 0; position:relative; background: url(/images/bgs.png) no-repeat;}
        .recommendmod li{ width:300px; padding:0px; position:absolute; overflow:hidden; zoom:1;}
        .recommendmod .pic{ float:left; width:150px; margin:4px 15px 0 0;}
        .recommendmod .pic img{ display:block;}
        .recommendmod h3{ height:48px; padding-bottom:5px; overflow:hidden;}
        .recommendmod h3 a{ font:14px/24px "Microsoft YaHei","微软雅黑";}
        .recommendmod p{ height:20px; color:#999; line-height:20px;}
        .recommendmod .price{ padding:2px 0 7px;}
        .recommendmod .price em{ position:relative; top:2px; font-size:22px; font-weight:bold; font-family:"Microsoft YaHei","微软雅黑"; color:#cc0000;}
        .recommendmod .price span{ padding-right:5px; font-size:18px;}
        .recommendmod b{ padding-right:5px; color:#cc0000; font-weight:normal; }
        .recommendmod .recommend_1{ top:66px; left:0;}
        .recommendmod .recommend_2{ top:250px; left:0;}
        .recommendmod .recommend_3{ top:66px; left:330px;}
        .recommendmod .recommend_4{ top:250px; left:330px;}
        .recommendmod .recommend_5{ top:66px; left:700px; width:280px;}
        .recommendmod .recommend_5 .pic{ float:none; width:300px; margin-right:0;}
        .recommendmod .recommend_5 h3{ margin-top:8px;}
        .recommend_5 .qiangbtn_small{ margin:10px 0 0;}
        .qiangbtn_small{ width:79px; height:24px; display:block; margin:10px 0 0 160px; background-position:0 -307px; text-indent:-9999em;}
        .qiangbtn_small:hover{ background-position:0 -332px;}

        /*mod_hd*/
        .mod_hd{ height:41px; position:relative; padding-left:10px; background:#f8f8f8; border:1px solid #f1f1f1; border-top:3px solid #1376d9; line-height:41px; z-index:2;}
        .mod_hd h3{ padding:8px 0 9px 32px; _padding:8px 0 6px 32px; display:inline-block; background-position:-106px -396px; font:bold 20px/24px "Microsoft YaHei","微软雅黑"; color:#333;}
        .mod_hd h3 span{ padding:0 2px 2px; padding:2px 2px 0\9; margin-left:5px; display:inline-block; color:#fff; background:#999; }
        .mod_hd .more{ position:absolute; top:0; right:10px; font-family:"simsun","宋体"; color:#0056b3;}

        .category_1 .mod_hd{ border-top:3px solid #2db1bd;}
        .category_2 .mod_hd{ border-top:3px solid #8145d0;}
        .category_3 .mod_hd{ border-top:3px solid #707070;}
        .category_4 .mod_hd{ border-top:3px solid #f55955;}
        .category_5 .mod_hd{ border-top:3px solid #ff9933;}
        .category_6 .mod_hd{ padding-left:10px; border-top:3px solid #ccc;}
        .category_6 .mod_hd h3{ padding-left:0; background:none;}
        .category_6 .red{ margin:0 -4px 0 0; background:#f30;}

        /*snaplist*/
        .snaplist{ border-left:1px solid #f1f1f1; border-right:1px solid #f1f1f1; background:#fff;  overflow:hidden; position:relative; zoom:1;}
        .snaplist li{zoom:1;float:left; width:246px; margin:-1px 0 0 -1px; position:relative; }
        .snaplist .last{ width:245px; border-right:0 none; margin-right:-1px;}
        .snapmod{ padding:20px 20px 0; text-align:center;border-right:1px dotted #d9d9d9;}
        .snaplist .pic img{ vertical-align:middle;}
        .snaplist h4{ height:48px; padding:7px 20px 0 0; font:14px/24px "Microsoft YaHei","微软雅黑"; overflow:hidden; text-align:left;}
        .snaplist p{ height:20px; color:#999; line-height:20px; text-align:left;}
        .snaplist .price{ padding:3px 0 7px 0;}
        .snaplist .price em{ position:relative; top:2px; font-size:22px; font-weight:bold; font-family:"Microsoft YaHei","微软雅黑"; color:#cc0000;}
        .snaplist .price span{ padding-right:5px; font-size:18px;}
        .snaplist b{ padding-right:5px; color:#cc0000; font-weight:normal; }
        .snap_att{ padding:10px 0 15px 0;}
        .snap_att span{ float:left; height:34px; padding-left:10px; line-height:34px; color:#666;font-size: 10px;}
        .snaplist em{ color:#cc0000;}
        .qiangbtn_red,.ended,.qiangbtn_blue{ width:110px; height:34px; float:left; display:block; text-indent:-9999em;}
        .qiangbtn_red{ background-position:0 -202px;}
        .qiangbtn_red:hover{ background-position:0 -237px;}
        .ended{ background-position:0 -272px;}
        .qiangbtn_blue{ background-position:0 -132px;}
        .qiangbtn_blue:hover{ background-position:0 -167px;}

        .ico_baoyou,.ico_remai,.ico_xinpin,.ico_fengqiang{ width:65px; height:65px; display:block; position:absolute; top:3px; right:3px; text-indent:-9999em;}
        .ico_baoyou{ background-position:-66px 0;}
        .ico_remai{ background-position:-66px -66px;}
        .ico_xinpin{ background-position:0 0;}
        .ico_fengqiang{ background-position:0 -66px;}

        .snaphover .snapmod{ padding:18px 19px 0 18px; border:2px solid #e6e6e6; border-bottom:0 none}
        .snaphover .countdown{ height:28px;  padding:9px 1px 1px 0; border:0 none; background:#e6e6e6;}

        /*countdown 倒计时*/
        .countdown{height:28px; padding:8px 0 0; text-align:center; border:1px dotted #ccc; border-left:0 none; border-bottom:1px solid #f1f1f1;}
        .countdown span{ color:#999; padding:0 2px 0 4px;}
        .countdown b{ width:12px; height:16px; display:inline-block; padding:0 1px; position:relative; top:1px; +top:0; _top:2px; top:2px\0; background: url(/images/time.png) no-repeat; text-indent:-9999em;}
        .countdown .n1{ background-position:0 0;}
        .countdown .n2{ background-position:0 -21px;}
        .countdown .n3{ background-position:0 -42px;}
        .countdown .n4{ background-position:0 -63px;}
        .countdown .n5{ background-position:0 -82px;}
        .countdown .n6{ background-position:0 -102px;}
        .countdown .n7{ background-position:0 -123px;}
        .countdown .n8{ background-position:0 -142px;}
        .countdown .n9{ background-position:0 -162px;}
        .countdown .n0{ background-position:0 -182px;}
        .countdown .n00{ background-position:0 -203px;}

        /*bulkmod 精品团购*/
        .bulkmod{ height:341px; position:relative; border:1px solid #f1f1f1; border-top:0 none; background:#fff;width: 980px; overflow: hidden;}
        .slider_list{ width:960px; margin:0px; height:341px; overflow:hidden;}
        .bulklist{ height:341px;}
        .bulklist li{ width:200px; height:305px; float:left; padding:16px 23px 20px;}
        .bulklist .tit{ height:60px; line-height:20px; overflow:hidden;}
        .bulklist .pic{ display:block; margin:10px 0; border:1px solid #e6e6e6;}
        .bulklist .pic img{ display:block;}
        .bulkatt{ height:30px; line-height:30px;}
        .bulkatt span{ float:left;  font-size:14px;}
        .bulkatt span em{ padding-right:5px; position:relative; top:3px; color:#cc0000; font-size:24px; font-weight:bold;}
        .seebtn{ float:right; width:80px; height:30px; background-position:0 -357px; text-indent:-9999em;}

        .left_turn,.right_turn,.left_turn_hov,.right_turn_hov,.left_turn_no,.right_turn_no{ width:15px; height:29px; position:absolute; top:148px; text-indent:-9999em; cursor:pointer;}
        .left_turn{ background-position:-116px -134px; left:30px;}
        .right_turn{ background-position:-116px -166px; right:30px;}

        .left_turn_hov{ background-position:-116px -260px; left:30px;}
        .right_turn_hov{ background-position:-116px -291px; right:30px;}
        .left_turn_no{ background-position:-116px -198px; left:30px;cursor: default;}
        .right_turn_no{ background-position:-116px -230px; right:30px;cursor: default;}

        /*pages*/
        .pages{  padding-top:20px; margin-right:-2px; text-align:center; font-family:Tahoma; color:#999; text-align:right;}
        .pages a,.pages span{ display:inline-block; padding:0 5px; margin:0 2px; min-width:21px; _width:21px; white-space:nowrap; height:31px; line-height:31px; text-align:center; vertical-align:middle; font-size:14px; color:#134ba0;;}
        .pages a{ border:1px solid #e3e3e3; background:#fff;}
        .pages a:hover{ background:#f2f2f2; color:#134ba0; text-decoration:none;}
        .pages .act{border:1px solid #ee8600; background:#fe9900; color:#fff; font-weight:bold;}
        .pages .prev,.pages .next { font-family:"simsun","宋体"; }

        /*sort 排序*/
        .sort{ position:absolute; top:0; right:10px;}
        .sort .tit{ float:left; padding-right:9px;}
        .sortlist{ float:left; padding-top:9px; position:relative;}
        .sort_default{ width:112px; height:20px; padding-left:8px; border:1px solid #ccc; background-position:100% -438px; background-color:#fff; line-height:22px; cursor:pointer;}
        .sortlist ul{ position:absolute; top:30px; left:0; border:1px solid #ccc; overflow:hidden; zoom:1;}
        .sortlist ul li{ width:81px; height:20px; padding:0 6px 0 33px; margin-top:-1px; border-top:1px solid #ccc; line-height:20px; background-color:#fff;}
        .sortlist .s_1{ background-position:-103px -331px; background-color:#fff;}
        .sortlist .s_2{ background-position:-103px -355px; background-color:#fff;}
        .sortlist .s_3{ background-position:-103px -378px; background-color:#fff;}
        .sortlist .cur{ background-color:#f1f1f1; cursor:pointer;}

        /*2012-3-22 18:43:49*/
        .mycart_empty{ width:358px; height:40px; position:absolute; top:0px; right:0; border:1px solid #0056b3; background:#fff; line-height:40px; text-align:center;}
    </style>
</head>
<body>
<?php include APPPATH.'views/header.php';?>
<div class="contentbg">
<!--
    <div class="qiangnav_mod">
        <ul class="clearfix">
            <li class="now"><span>全部</span></li>
            <li><a target="_self" href="http://qiang.zol.com/mobile/">手机通讯</a></li>
            <li><a target="_self" href="http://qiang.zol.com/notebook/">笔记本电脑</a></li>
            <li><a target="_self" href="http://qiang.zol.com/digital/">数码影像</a></li>
            <li><a target="_self" href="http://qiang.zol.com/peripherals/">电脑外设</a></li>
            <li><a target="_self" href="http://qiang.zol.com/diy/">DIY装机</a></li>
            <li><a target="_self" href="http://qiang.zol.com/item/">家电其它</a></li>
        </ul>
    </div>
    -->
    	<div class="wrapper">
		<div class="ad_div" style="text-align: center;">
			<div>
                <a title="真情9月 数码平板1折起" target="_blank" href="http://go.zol.com/topic/3239389.html">
                    <img width="980" height="90" alt="真情9月 数码平板1折起" src="/images/301.jpg">
                </a>
            </div>
		</div>
	</div>

    <ul class="recommendmod">
        <li class="recommend_1">
            <a title="" class="pic" href="" target="_blank"><img width="125" height="150" title="" alt="" src="http://img8.zol-img.com/module/27_module_images/326.gif">
            </a>
            <h3><a href="http://www.zol.com/detail/mid/taidian/7057744.html" target="_blank">1G主频超薄9.9金刚玻璃平板333元疯抢</a></h3>
            <p class="price">抢购价：<em><span>¥</span>333</em></p>
            <p>市场价： <del>¥ 490</del> </p>
            <p>立省：<b>157</b>元</p>
            <a class="qiangbtn_small" href="http://www.zol.com/detail/mid/taidian/7057744.html" target="_blank">立即抢购</a>
        </li>
        <li class="recommend_2">
            <a title="" class="pic" href="" target="_blank"><img width="125" height="150" title="" alt="" src="http://img7.zol-img.com/module/27_module_images/325.gif"></a>
            <h3><a href="http://www.zol.com/detail/notebook/shenzhou/5916679.html" target="_blank">酷睿I5笔记本震撼价 2799元包邮</a></h3>
            <p class="price">抢购价：<em><span>¥</span>2799</em></p>
            <p>市场价： <del>¥ 3111</del> </p>
            <p>立省：<b>312</b>元</p>
            <a class="qiangbtn_small" href="http://www.zol.com/detail/notebook/shenzhou/5916679.html" target="_blank">立即抢购</a>
        </li>
        <li class="recommend_3">
            <a title="#" class="pic" href="#" target="_blank"> <img width="125" height="150" title="" alt="" src="http://img9.zol-img.com/module/27_module_images/323.gif"></a>
            <h3><a href="http://www.zol.com/detail/mice/MOTOSPEED/7241251.html" target="_blank">远东猎豹游戏鼠标原价199疯抢79元包邮促销</a>
            </h3>
            <p class="price">抢购价：<em><span>¥</span>79</em></p>
            <p>市场价： <del>¥ 199</del> </p>
            <p>立省：<b>120</b>元</p>
            <a class="qiangbtn_small" href="http://www.zol.com/detail/mice/MOTOSPEED/7241251.html" target="_blank">立即抢购</a>
        </li>
        <li class="recommend_4">
            <a title="" class="pic" href="#" target="_blank"><img width="125" height="150" title="" alt="" src="http://img8.zol-img.com/module/27_module_images/322.gif"></a>
            <h3><a href="http://www.zol.com/detail/usb_flash_drive/Kingston/5576757.html" target="_blank">金士顿 DT101G2（8GB）u盘旋转式优盘</a></h3>
            <p class="price">抢购价：<em><span>¥</span>42</em></p>
            <p>市场价： <del>¥ 66</del> </p>
            <p>立省：<b>24</b>元</p>
            <a class="qiangbtn_small" href="http://www.zol.com/detail/usb_flash_drive/Kingston/5576757.html" target="_blank">立即抢购</a>
        </li>
        <li class="recommend_5">
            <a title="" class="pic" href="#" target="_blank">
                <img width="148" height="178" title="发烧友首选 芝奇DDR3 1600内存套装 4GB*2 带散热片 超频潜力高" alt="发烧友首选 芝奇DDR3 1600内存套装 4GB*2 带散热片 超频潜力高" src="http://img6.zol-img.com/module/27_module_images/324.gif">
            </a>
            <h3><a href="http://www.zol.com/detail/memory/G.SKILL/4333581.html" target="_blank">发烧友首选 芝奇DDR3 1600内存套装 4GB*2带散热片 超频潜力高</a></h3>
            <p class="price">抢购价：<em><span>¥</span>259</em></p>
            <p>市场价： <del>¥ 499</del> </p>
            <p>立省：<b>240</b>元</p>
            <a class="qiangbtn_small" href="http://www.zol.com/detail/memory/G.SKILL/4333581.html" target="_blank">立即抢购</a>
        </li>
    </ul>

    <div class="wrapper category_1">
		<div class="mod_hd mt20">
			<h3>笔记本电脑<span>抢购</span></h3>
			<a class="more" href="http://qiang.zol.com/notebook/" target="_blank">查看更多&gt;&gt;</a>
		</div>
    <ul class="snaplist clearfix">
        <li class="">
            <div class="snapmod">
                <a class="pic" target="_blank" href="#"><img width="125" height="150" title="" alt="" src="http://2e.zol-img.com.cn/product/95_200x150/968/ceOxjenVu9Vo.jpg"></a>
                <h4><a title="" target="_blank" href="http://www.zol.com/detail/notebook/lenovo/6904387.html">《限时抢购》联想新品Y480N-IFI（A）4G/1T/2G/DOS可代装WIN7系统包邮</a></h4>
                <p class="price">抢购价：<em><span>¥</span>5304-5448</em></p>
                <p>市场价： <del>¥ 6630-6810</del> </p>
                <p>立省：<b>1326</b>元</p>
                <div class="snap_att clearfix">
                    <a id="promo_status_20654" class="qiangbtn_red" target="_blank" href="#">立即抢购</a>
                    <span>已有<em>9846</em>人关注</span>
                </div>
            </div>
            <div id="promo_time_20654" class="countdown"><span>剩余时间：</span><b class="n1">1</b><b
                class="n8">8</b><span>时</span><b class="n5">5</b><b class="n3">3</b><span>分</span><b class="n2">2</b><b
                class="n0">0</b><span>秒</span></div>
            <i class="ico_baoyou">包邮</i>
        </li>
        <li class="">
            <div class="snapmod">
                <a class="pic" target="_blank" href="#"><img width="125" height="150" title="" alt="" src="http://2d.zol-img.com.cn/product/90_200x150/51/ceBeNOxixyGrM.jpg"></a>
                <h4><a title="" target="_blank" href="#">《限时抢购》联想G480A-IFI（H）3210/4G/500G/1G金属灰 包邮</a></h4>
                <p class="price">抢购价：<em><span>¥</span>3949-4104</em></p>

                <p>市场价：
                    <del>¥ 4937-5130</del>
                </p>
                <p>立省：<b>988</b>元</p>

                <div class="snap_att clearfix">
                    <a id="promo_status_20742" class="qiangbtn_red" target="_blank" href="http://www.zol.com/detail/notebook/lenovo/6482324.html">立即抢购</a>
                    <span>已有<em>916</em>人关注</span>
                </div>
            </div>
            <div id="promo_time_20742" class="countdown">
                <br/><span>剩余时间：</span><b class="n1">1</b><b class="n8">8</b><span>时</span><b class="n5">5</b><b class="n3">3</b><span>分</span><b class="n2">2</b><b
                class="n0">0</b><span>秒</span></div>
            <i class="ico_baoyou">包邮</i>
        </li>
        <li>
            <div class="snapmod">
                <a class="pic" target="_blank" href="#"><img width="125" height="150" title="" alt="" src="http://2a.zol-img.com.cn/product/81_200x150/650/ce4ixojbOBTXg.jpg"></a>
                <h4><a title="" target="_blank" href="#">【限时抢购】惠普g4-1302TX二代i3 1G独显 SRS环绕音响</a></h4>
                <p class="price">抢购价：<em><span>¥</span>2849</em></p>
                <p>市场价：<del>¥ 3202</del></p>
                <p>立省：<b>353</b>元</p>
                <div class="snap_att clearfix">
                    <a id="promo_status_20651" class="qiangbtn_red" target="_blank"
                       href="http://www.zol.com/detail/notebook/HP/6446429.html">立即抢购</a>
                    <span>已有<em>1041</em>人关注</span>
                </div>
            </div>
            <div id="promo_time_20651" class="countdown"><span>剩余时间：</span><b class="n2">2</b><b
                class="n9">9</b><span>时</span><b class="n4">4</b><b class="n0">0</b><span>分</span><b class="n3">3</b><b
                class="n4">4</b><span>秒</span></div>
            <i class="ico_remai">热卖</i>
        </li>
        <li class="last">
            <div class="snapmod">
                <a class="pic" target="_blank" href="#"><img width="125" height="150" title="" alt="" src="http://2c.zol-img.com.cn/product/96_200x150/268/ceL6hYzwW2bKw.jpg"></a>
                <h4><a title="限时抢购微星GX60  ATI  7970M, 2GB GDDR5 内存8G 杀手网卡硬盘750G 7200转可以三屏包鼠送 包顺丰" target="_blank"
                       href="http://www.zol.com/detail/notebook/msiweixing/6989569.html">限时抢购微星GX60 ATI 7970M, 2GB GDDR5
                    内存8G 杀手网卡硬盘750G 7200转可以三屏包鼠送 包顺丰</a></h4>

                <p class="price">抢购价：<em><span>¥</span>8999</em></p>

                <p>市场价：
                    <del>¥ 9999</del>
                </p>
                <p>立省：<b>1000</b>元</p>

                <div class="snap_att clearfix">
                    <a id="promo_status_20672" class="qiangbtn_red" target="_blank"
                       href="http://www.zol.com/detail/notebook/msiweixing/6989569.html">立即抢购</a>
                    <span>已有<em>1090</em>人关注</span>
                </div>
            </div>
            <div id="promo_time_20672" class="countdown"><span>剩余时间：</span><b class="n5">5</b><b
                class="n7">7</b><span>时</span><b class="n4">4</b><b class="n0">0</b><span>分</span><b class="n3">3</b><b
                class="n6">6</b><span>秒</span></div>
            <i class="ico_fengqiang">疯抢</i>
        </li>

    </ul>
	</div>
            	<div class="wrapper category_2">
		<div class="mod_hd mt20">
			<h3>数码影像<span>抢购</span></h3>
			<a class="more" href="http://qiang.zol.com/digital/" target="_blank">查看更多&gt;&gt;</a>
		</div>
		<ul class="snaplist clearfix">
            			<li>
				<div class="snapmod">
					<a class="pic" target="_blank" href=""><img width="125" height="150" title="" alt="" src="http://2d.zol-img.com.cn/product/70_200x150/945/cev9RjMLAr4w.jpg"></a>
					<h4><a title="【限时抢购】再树里程形象 创造微单奇迹 索尼 NEX-5N套机（E 18-55mm）六月狂抢中" target="_blank" href="http://www.zol.com/detail/digital_camera/SONY/4235929.html">【限时抢购】再树里程形象 创造微单奇迹 索尼 NEX-5N套机（E 18-55mm）六月狂抢中</a></h4>
					<p class="price">抢购价：<em><span>¥</span>3824-4072</em></p>
					<p>市场价：<del>¥ 4780-5090</del></p>
					<p>立省：<b>956</b>元</p>
					<div class="snap_att clearfix">
						<a id="promo_status_20698" class="qiangbtn_red" target="_blank" href="http://www.zol.com/detail/digital_camera/SONY/4235929.html">立即抢购</a>
						<span>已有<em>39585</em>人关注</span>
					</div>
				</div>
				<div id="promo_time_20698" class="countdown"><span>剩余时间：</span><b class="n1">1</b><b class="n3">3</b><b class="n8">8</b><span>时</span><b class="n3">3</b><b class="n9">9</b><span>分</span><b class="n5">5</b><b class="n4">4</b><span>秒</span></div>
                                <i class="ico_remai">热卖</i>
                			</li>
            			<li>
				<div class="snapmod">
					<a class="pic" target="_blank" href=""><img width="125" height="150" title="" alt="" src="http://2b.zol-img.com.cn/product/88_200x150/497/ceKeyfeqxEa3Y.jpg"></a>
					<h4><a title="" target="_blank" href="">【好平板促销】原道 N90双擎2(16G)3G9.7寸IPS蓝牙双核平板电脑包邮现货</a></h4>
					<p class="price">抢购价：<em><span>¥</span>998-1260</em></p>
					<p>市场价：<del>¥ 1299-1639</del></p>
					<p>立省：<b>301</b>元</p>
					<div class="snap_att clearfix">
						<a id="promo_status_20692" class="qiangbtn_red" target="_blank" href="">立即抢购</a>
						<span>已有<em>5103</em>人关注</span>
					</div>
				</div>
				<div id="promo_time_20692" class="countdown"><span>剩余时间：</span><b class="n7">7</b><b class="n1">1</b><span>时</span><b class="n4">4</b><b class="n7">7</b><span>分</span><b class="n0">0</b><b class="n6">6</b><span>秒</span></div>
                                <i class="ico_remai">热卖</i>
                			</li>
            			<li>
				<div class="snapmod">
					<a class="pic" target="_blank" href=""><img width="125" height="150" title="" alt="" src="http://2d.zol-img.com.cn/product/95_200x150/567/ceO7TEoQ2OZ4.jpg"></a>
					<h4><a title="" target="_blank" href="">【限时抢购】台电P76e/8G  1G主频超薄9.9金刚玻璃G+G面板保真双喇叭学生首选平板特价包邮中</a></h4>
					<p class="price">抢购价：<em><span>¥</span>339-429</em></p>
					<p>市场价：<del>¥ 499-631</del></p>
					<p>立省：<b>160</b>元</p>
					<div class="snap_att clearfix">
						<a id="promo_status_20803" class="qiangbtn_red" target="_blank" href="http://www.zol.com/detail/mid/taidian/7057744.html">立即抢购</a>
						<span>已有<em>7327</em>人关注</span>
					</div>
				</div>
				<div id="promo_time_20803" class="countdown"><span>剩余时间：</span><b class="n2">2</b><b class="n2">2</b><span>时</span><b class="n0">0</b><b class="n5">5</b><span>分</span><b class="n5">5</b><b class="n8">8</b><span>秒</span></div>
                                <i class="ico_fengqiang">疯抢</i>
                			</li>
            			<li class="last">
				<div class="snapmod">
					<a class="pic" target="_blank" href="#"><img width="125" height="150" title="" alt="" src="http://2c.zol-img.com.cn/product/94_200x150/390/ce0lALvvj3Fmw.jpg"></a>
					<h4><a title="" target="_blank" href="">【限时抢购】8寸超低价格平板电脑台电 P86（8GB），安卓4.0系统，前置摄像头</a></h4>
					<p class="price">抢购价：<em><span>¥</span>399-445</em></p>
					<p>市场价：<del>¥ 499-557</del></p>
					<p>立省：<b>100</b>元</p>
					<div class="snap_att clearfix">
						<a id="promo_status_20582" class="qiangbtn_red" target="_blank" href="http://www.zol.com/detail/mid/taidian/6864205.html">立即抢购</a>
						<span>已有<em>8097</em>人关注</span>
					</div>
				</div>
				<div id="promo_time_20582" class="countdown"><span>剩余时间：</span><b class="n8">8</b><b class="n1">1</b><span>时</span><b class="n3">3</b><b class="n9">9</b><span>分</span><b class="n4">4</b><b class="n6">6</b><span>秒</span></div>
                                <i class="ico_remai">热卖</i>
                			</li>

		</ul>
	</div>
            	<div class="wrapper category_3">
		<div class="mod_hd mt20">
			<h3>电脑外设<span>抢购</span></h3>
			<a class="more" href="http://qiang.zol.com/peripherals/" target="_blank">查看更多&gt;&gt;</a>
		</div>
		<ul class="snaplist clearfix">
            			<li>
				<div class="snapmod">
					<a class="pic" target="_blank" href="http://www.zol.com/detail/hd-player/kaiboer/6467072.html"><img width="125" height="150" title="开博尔 K810 3D硬盘播放器 高清播放机 发烧级蓝光画质" alt="开博尔 K810 3D硬盘播放器 高清播放机 发烧级蓝光画质" src="http://2d.zol-img.com.cn/product/92_200x150/919/cecppsz9ENR9Q.jpg"></a>
					<h4><a title="开博尔 K810 3D硬盘播放器 高清播放机 发烧级蓝光画质" target="_blank" href="http://www.zol.com/detail/hd-player/kaiboer/6467072.html">开博尔 K810 3D硬盘播放器 高清播放机 发烧级蓝光画质</a></h4>
					<p class="price">抢购价：<em><span>¥</span>1520</em></p>
					<p>市场价：<del>¥ 1901</del></p>
					<p>立省：<b>381</b>元</p>
					<div class="snap_att clearfix">
						<a id="promo_status_20569" class="qiangbtn_red" target="_blank" href="http://www.zol.com/detail/hd-player/kaiboer/6467072.html">立即抢购</a>
						<span>已有<em>1683</em>人关注</span>
					</div>
				</div>
				<div id="promo_time_20569" class="countdown"><span>剩余时间：</span><b class="n2">2</b><b class="n0">0</b><span>时</span><b class="n4">4</b><b class="n8">8</b><span>分</span><b class="n3">3</b><b class="n1">1</b><span>秒</span></div>
                                <i class="ico_remai">热卖</i>
                			</li>
            			<li>
				<div class="snapmod">
					<a class="pic" target="_blank" href="http://www.zol.com/detail/move_disk/Seagate/6821059.html"><img width="125" height="150" title="【特惠包邮】希捷 Backup Plus 新品 2.5英寸（500GB）（STBU50010）" alt="【特惠包邮】希捷 Backup Plus 新品 2.5英寸（500GB）（STBU50010）" src="http://2d.zol-img.com.cn/product/91_200x150/961/cekd28xu0UzYE.jpg"></a>
					<h4><a title="【特惠包邮】希捷 Backup Plus 新品 2.5英寸（500GB）（STBU50010）" target="_blank" href="http://www.zol.com/detail/move_disk/Seagate/6821059.html">【特惠包邮】希捷 Backup Plus 新品 2.5英寸（500GB）（STBU50010）</a></h4>
					<p class="price">抢购价：<em><span>¥</span>418</em></p>
					<p>市场价：<del>¥ 510</del></p>
					<p>立省：<b>92</b>元</p>
					<div class="snap_att clearfix">
						<a id="promo_status_20792" class="qiangbtn_red" target="_blank" href="http://www.zol.com/detail/move_disk/Seagate/6821059.html">立即抢购</a>
						<span>已有<em>3025</em>人关注</span>
					</div>
				</div>
				<div id="promo_time_20792" class="countdown"><span>剩余时间：</span><b class="n6">6</b><b class="n5">5</b><span>时</span><b class="n0">0</b><b class="n1">1</b><span>分</span><b class="n5">5</b><b class="n2">2</b><span>秒</span></div>
                                <i class="ico_baoyou">包邮</i>
                			</li>
            			<li>
				<div class="snapmod">
					<a class="pic" target="_blank" href="http://www.zol.com/detail/usb_flash_drive/SanDisk/5724951.html"><img width="125" height="150" title="【 感恩回馈】限时包邮抢购全国联保SanDisk闪迪 酷捷彩色优盘U盘 USB闪存盘CZ51 16G    疯抢" alt="【 感恩回馈】限时包邮抢购全国联保SanDisk闪迪 酷捷彩色优盘U盘 USB闪存盘CZ51 16G    疯抢" src="http://2e.zol-img.com.cn/product/59_200x150/514/ceFXoPbu10ivw.jpg"></a>
					<h4><a title="【 感恩回馈】限时包邮抢购全国联保SanDisk闪迪 酷捷彩色优盘U盘 USB闪存盘CZ51 16G    疯抢" target="_blank" href="http://www.zol.com/detail/usb_flash_drive/SanDisk/5724951.html">【 感恩回馈】限时包邮抢购全国联保SanDisk闪迪 酷捷彩色优盘U盘 USB闪存盘CZ51 16G    疯抢</a></h4>
					<p class="price">抢购价：<em><span>¥</span>65-65</em></p>
					<p>市场价：<del>¥ 99-99</del></p>
					<p>立省：<b>34</b>元</p>
					<div class="snap_att clearfix">
						<a id="promo_status_20469" class="qiangbtn_red" target="_blank" href="http://www.zol.com/detail/usb_flash_drive/SanDisk/5724951.html">立即抢购</a>
						<span>已有<em>13967</em>人关注</span>
					</div>
				</div>
				<div id="promo_time_20469" class="countdown"><span>剩余时间：</span><b class="n1">1</b><b class="n9">9</b><span>时</span><b class="n4">4</b><b class="n0">0</b><span>分</span><b class="n3">3</b><b class="n4">4</b><span>秒</span></div>
                                <i class="ico_baoyou">包邮</i>
                			</li>
            			<li class="last">
				<div class="snapmod">
					<a class="pic" target="_blank" href="http://www.zol.com/detail/hd-player/qinghuatongfang/6902212.html"><img width="125" height="150" title="同方灵悦只能电视宝，你送礼的好选择！关注@灵悦智能电视宝 就送100元！参与微博活动还有199元手表送！你还在等什么！？" alt="同方灵悦只能电视宝，你送礼的好选择！关注@灵悦智能电视宝 就送100元！参与微博活动还有199元手表送！你还在等什么！？" src="http://2a.zol-img.com.cn/product/97_200x150/966/ceNdpXoXCrwak.jpg"></a>
					<h4><a title="同方灵悦只能电视宝，你送礼的好选择！关注@灵悦智能电视宝 就送100元！参与微博活动还有199元手表送！你还在等什么！？" target="_blank" href="http://www.zol.com/detail/hd-player/qinghuatongfang/6902212.html">同方灵悦只能电视宝，你送礼的好选择！关注@灵悦智能电视宝 就送100元！参与微博活动还有199元手表送！你还在等什么！？</a></h4>
					<p class="price">抢购价：<em><span>¥</span>699</em></p>
					<p>市场价：<del>¥ 999</del></p>
					<p>立省：<b>300</b>元</p>
					<div class="snap_att clearfix">
						<a id="promo_status_20641" class="qiangbtn_red" target="_blank" href="http://www.zol.com/detail/hd-player/qinghuatongfang/6902212.html">立即抢购</a>
						<span>已有<em>110355</em>人关注</span>
					</div>
				</div>
				<div id="promo_time_20641" class="countdown"><span>剩余时间：</span><b class="n2">2</b><b class="n1">1</b><b class="n2">2</b><span>时</span><b class="n3">3</b><b class="n5">5</b><span>分</span><b class="n2">2</b><b class="n4">4</b><span>秒</span></div>
                                <i class="ico_xinpin">新品</i>
                			</li>

		</ul>
	</div>
            	<div class="wrapper category_4">
		<div class="mod_hd mt20">
			<h3>DIY装机<span>抢购</span></h3>
			<a class="more" href="http://qiang.zol.com/diy/" target="_blank">查看更多&gt;&gt;</a>
		</div>
		<ul class="snaplist clearfix">
            			<li>
				<div class="snapmod">
					<a class="pic" target="_blank" href="http://www.zol.com/detail/case/Tt/4642842.html"><img width="125" height="150" title="【喜迎国庆 全店底价】Tt 星际指挥官usb3.0机箱 下置电源+全黑化+背线 工薪价格高端享受 三色可选 包邮送风扇" alt="【喜迎国庆 全店底价】Tt 星际指挥官usb3.0机箱 下置电源+全黑化+背线 工薪价格高端享受 三色可选 包邮送风扇" src="http://2c.zol-img.com.cn/product/76_200x150/300/ce23o2IScbQrs.jpg"></a>
					<h4><a title="【喜迎国庆 全店底价】Tt 星际指挥官usb3.0机箱 下置电源+全黑化+背线 工薪价格高端享受 三色可选 包邮送风扇" target="_blank" href="http://www.zol.com/detail/case/Tt/4642842.html">【喜迎国庆 全店底价】Tt 星际指挥官usb3.0机箱 下置电源+全黑化+背线 工薪价格高端享受 三色可选 包邮送风扇</a></h4>
					<p class="price">抢购价：<em><span>¥</span>291-317</em></p>
					<p>市场价：<del>¥ 362-395</del></p>
					<p>立省：<b>71</b>元</p>
					<div class="snap_att clearfix">
						<a id="promo_status_20499" class="qiangbtn_red" target="_blank" href="http://www.zol.com/detail/case/Tt/4642842.html">立即抢购</a>
						<span>已有<em>9137</em>人关注</span>
					</div>
				</div>
				<div id="promo_time_20499" class="countdown"><span>剩余时间：</span><b class="n2">2</b><b class="n1">1</b><span>时</span><b class="n4">4</b><b class="n9">9</b><span>分</span><b class="n2">2</b><b class="n1">1</b><span>秒</span></div>
                                <i class="ico_remai">热卖</i>
                			</li>
            			<li>
				<div class="snapmod">
					<a class="pic" target="_blank" href="http://www.zol.com/detail/vga/GALAXY/7374818.html"><img width="125" height="150" title="开普勒降临！超高性价比影驰 GTX650黑将799元冰点促销！全新清道夫散热系统，高效方便清理 超频简单 全国包顺丰" alt="开普勒降临！超高性价比影驰 GTX650黑将799元冰点促销！全新清道夫散热系统，高效方便清理 超频简单 全国包顺丰" src="http://2d.zol-img.com.cn/product/96_200x150/711/ceCPCY1PiNLk.jpg"></a>
					<h4><a title="开普勒降临！超高性价比影驰 GTX650黑将799元冰点促销！全新清道夫散热系统，高效方便清理 超频简单 全国包顺丰" target="_blank" href="http://www.zol.com/detail/vga/GALAXY/7374818.html">开普勒降临！超高性价比影驰 GTX650黑将799元冰点促销！全新清道夫散热系统，高效方便清理 超频简单 全国包顺丰</a></h4>
					<p class="price">抢购价：<em><span>¥</span>799</em></p>
					<p>市场价：<del>¥ 999</del></p>
					<p>立省：<b>200</b>元</p>
					<div class="snap_att clearfix">
						<a id="promo_status_20604" class="qiangbtn_red" target="_blank" href="http://www.zol.com/detail/vga/GALAXY/7374818.html">立即抢购</a>
						<span>已有<em>8336</em>人关注</span>
					</div>
				</div>
				<div id="promo_time_20604" class="countdown"><span>剩余时间：</span><b class="n4">4</b><b class="n8">8</b><span>时</span><b class="n1">1</b><b class="n5">5</b><span>分</span><b class="n4">4</b><b class="n0">0</b><span>秒</span></div>
                                <i class="ico_xinpin">新品</i>
                			</li>
            			<li>
				<div class="snapmod">
					<a class="pic" target="_blank" href="http://www.zol.com/detail/memory/Corsair/4483888.html"><img width="125" height="150" title="【限时抢购】海盗船 8GB DDR3 1600套装（CMZ8GX3M2A1600C9）" alt="【限时抢购】海盗船 8GB DDR3 1600套装（CMZ8GX3M2A1600C9）" src="http://2f.zol-img.com.cn/product/56_200x150/657/ceUxfhzfc3ZU.jpg"></a>
					<h4><a title="【限时抢购】海盗船 8GB DDR3 1600套装（CMZ8GX3M2A1600C9）" target="_blank" href="http://www.zol.com/detail/memory/Corsair/4483888.html">【限时抢购】海盗船 8GB DDR3 1600套装（CMZ8GX3M2A1600C9）</a></h4>
					<p class="price">抢购价：<em><span>¥</span>288</em></p>
					<p>市场价：<del>¥ 918</del></p>
					<p>立省：<b>630</b>元</p>
					<div class="snap_att clearfix">
						<a id="promo_status_20777" class="qiangbtn_red" target="_blank" href="http://www.zol.com/detail/memory/Corsair/4483888.html">立即抢购</a>
						<span>已有<em>32551</em>人关注</span>
					</div>
				</div>
				<div id="promo_time_20777" class="countdown"><span>剩余时间：</span><b class="n9">9</b><b class="n3">3</b><span>时</span><b class="n5">5</b><b class="n7">7</b><span>分</span><b class="n4">4</b><b class="n3">3</b><span>秒</span></div>
                                <i class="ico_remai">热卖</i>
                			</li>
            			<li class="last">
				<div class="snapmod">
					<a class="pic" target="_blank" href="http://www.zol.com/detail/power/SilverStone/7280239.html"><img width="125" height="150" title="银欣(SilverStone) SST-ST50F-ES 500W 80plus白牌" alt="银欣(SilverStone) SST-ST50F-ES 500W 80plus白牌" src="http://2a.zol-img.com.cn/product/76_200x150/958/ce3a6n3Hmw7ss.jpg"></a>
					<h4><a title="银欣(SilverStone) SST-ST50F-ES 500W 80plus白牌" target="_blank" href="http://www.zol.com/detail/power/SilverStone/7280239.html">银欣(SilverStone) SST-ST50F-ES 500W 80plus白牌</a></h4>
					<p class="price">抢购价：<em><span>¥</span>285</em></p>
					<p>市场价：<del>¥ 336</del></p>
					<p>立省：<b>51</b>元</p>
					<div class="snap_att clearfix">
						<a id="promo_status_20811" class="qiangbtn_red" target="_blank" href="http://www.zol.com/detail/power/SilverStone/7280239.html">立即抢购</a>
						<span>已有<em>454</em>人关注</span>
					</div>
				</div>
				<div id="promo_time_20811" class="countdown"><span>剩余时间：</span><b class="n9">9</b><b class="n6">6</b><span>时</span><b class="n1">1</b><b class="n0">0</b><span>分</span><b class="n3">3</b><b class="n3">3</b><span>秒</span></div>
                                <i class="ico_remai">热卖</i>
                			</li>

		</ul>
	</div>
                       	<div class="wrapper category_6">
		<div class="mod_hd mt20">
			<h3><span class="red">往期</span><span>抢购</span></h3>
			<a class="more" href="http://tuan.zol.com" target="_blank">查看更多&gt;&gt;</a>
		</div>
		<div class="bulkmod">
			<div class="slider_list clearfix" id="slideInner"><ul class="bulklist clearfix" style="width: 2240px;">
            	                				<li class="slides">
					<a class="tit" href="http://tuan.zol.com/5581.html" title="仅1829元！酷派 9120双网双待1.2GHz双核极4.3寸大屏包邮！" target="_blank">仅1829元！疯抢原价2299元酷派 9120双网双待1.2GHz双核极速处理器享万种应用 7.7mm超级纤薄 4.3英寸超清多点触控屏 </a>
					<a class="pic" href="http://tuan.zol.com/5581.html"><img width="125" height="150" title="仅1829元！酷派 9120双网双待1.2GHz双核极4.3寸大屏包邮！" alt="仅1829元！酷派 9120双网双待1.2GHz双核极4.3寸大屏包邮！" src="http://img.zol-img.com/zol_tuan/tuan_pic/other/10_200x150/tuan_9603.jpg"></a>
					<div class="bulkatt clearfix">
						<span><em>82</em>人已团购</span>
						<a title="仅1829元！酷派 9120双网双待1.2GHz双核极4.3寸大屏包邮！" target="_blank" class="seebtn" href="http://tuan.zol.com/5581.html">去看看</a>
					</div>
				</li>
                				<li class="slides">
					<a class="tit" href="http://tuan.zol.com/5553.html" title="与苹果媲美！3699元包邮清华同方U45F铝制金属本 i3低耗便携本" target="_blank">与苹果媲美！仅3699元包邮清华同方U45F铝制金属本~仅1.8KG超轻薄，20.5mm杂志一样的厚度 酷睿i3处理器 非常适合移动</a>
					<a class="pic" href="http://tuan.zol.com/5553.html"><img width="125" height="150" title="与苹果媲美！3699元包邮清华同方U45F铝制金属本 i3低耗便携本" alt="与苹果媲美！3699元包邮清华同方U45F铝制金属本 i3低耗便携本" src="http://img.zol-img.com/zol_tuan/tuan_pic/other/10_200x150/tuan_9547.jpg"></a>
					<div class="bulkatt clearfix">
						<span><em>69</em>人已团购</span>
						<a title="与苹果媲美！3699元包邮清华同方U45F铝制金属本 i3低耗便携本" target="_blank" class="seebtn" href="http://tuan.zol.com/5553.html">去看看</a>
					</div>
				</li>
                				<li class="slides">
					<a class="tit" href="http://tuan.zol.com/5602.html" title="厂家直销！3960元神舟K580P-i7D4震撼开团！四核i7 2G独显" target="_blank">厂家直销！3960元的神舟K580P-i7D4震撼开团！顶级I7四核处理器 超大8G内存 GT555M独显 2GB超大显存 发烧玩家必备首选</a>
					<a class="pic" href="http://tuan.zol.com/5602.html"><img width="125" height="150" title="厂家直销！3960元神舟K580P-i7D4震撼开团！四核i7 2G独显" alt="厂家直销！3960元神舟K580P-i7D4震撼开团！四核i7 2G独显" src="http://img.zol-img.com/zol_tuan/tuan_pic/other/10_200x150/tuan_9595.jpg"></a>
					<div class="bulkatt clearfix">
						<span><em>6</em>人已团购</span>
						<a title="厂家直销！3960元神舟K580P-i7D4震撼开团！四核i7 2G独显" target="_blank" class="seebtn" href="http://tuan.zol.com/5602.html">去看看</a>
					</div>
				</li>
                				<li class="slides">
					<a class="tit" href="http://tuan.zol.com/5565.html" title="直降288元！苹果iPad 2国行 双核A5处理器 9.7英寸IPS高清" target="_blank">仅2777！包邮顺丰！国行苹果iPad 2 火爆团购！挑战最低价！9.7英寸IPS高清屏 A5双核1G处理器 多点触控 快速流畅的无</a>
					<a class="pic" href="http://tuan.zol.com/5565.html"><img width="125" height="150" title="直降288元！苹果iPad 2国行 双核A5处理器 9.7英寸IPS高清" alt="直降288元！苹果iPad 2国行 双核A5处理器 9.7英寸IPS高清" src="http://img.zol-img.com/zol_tuan/tuan_pic/other/10_200x150/tuan_9551.jpg"></a>
					<div class="bulkatt clearfix">
						<span><em>25</em>人已团购</span>
						<a title="直降288元！苹果iPad 2国行 双核A5处理器 9.7英寸IPS高清" target="_blank" class="seebtn" href="http://tuan.zol.com/5565.html">去看看</a>
					</div>
				</li>
                				<li class="slides">
					<a class="tit" href="http://tuan.zol.com/5567.html" title="仅449元！亿格瑞i5智能客厅安卓机！购买送空中鼠标 HDMI高清线！" target="_blank">仅售449元！原价699元正品亿格瑞（EGREAT）i5 客厅电脑智能安卓机！有效支持网络播放！购买送价值199元AK62 空中鼠标</a>
					<a class="pic" href="http://tuan.zol.com/5567.html"><img width="125" height="150" title="仅449元！亿格瑞i5智能客厅安卓机！购买送空中鼠标 HDMI高清线！" alt="仅449元！亿格瑞i5智能客厅安卓机！购买送空中鼠标 HDMI高清线！" src="http://img.zol-img.com/zol_tuan/tuan_pic/other/10_200x150/tuan_9520.jpg"></a>
					<div class="bulkatt clearfix">
						<span><em>56</em>人已团购</span>
						<a title="仅449元！亿格瑞i5智能客厅安卓机！购买送空中鼠标 HDMI高清线！" target="_blank" class="seebtn" href="http://tuan.zol.com/5567.html">去看看</a>
					</div>
				</li>
                				<li class="slides">
					<a class="tit" href="http://tuan.zol.com/5613.html" title="25元（2条包邮）即可购买原价85元超细纤维美肤大浴巾一条。加厚加大！" target="_blank">【金秋特惠，再次开团！】仅25元（2条包邮）即可购买原价85元超细纤维美肤大浴巾一条！加厚加大超吸水，纳米科技、柔</a>
					<a class="pic" href="http://tuan.zol.com/5613.html"><img width="125" height="150" title="25元（2条包邮）即可购买原价85元超细纤维美肤大浴巾一条。加厚加大！" alt="25元（2条包邮）即可购买原价85元超细纤维美肤大浴巾一条。加厚加大！" src="http://img.zol-img.com/zol_tuan/tuan_pic/other/10_200x150/tuan_9613.jpg"></a>
					<div class="bulkatt clearfix">
						<span><em>57</em>人已团购</span>
						<a title="25元（2条包邮）即可购买原价85元超细纤维美肤大浴巾一条。加厚加大！" target="_blank" class="seebtn" href="http://tuan.zol.com/5613.html">去看看</a>
					</div>
				</li>
                				<li class="slides">
					<a class="tit" href="http://tuan.zol.com/5545.html" title="258元抢购芝奇DDR3 1600 8G单条内存" target="_blank">仅258元！原价352元的芝奇 RipjawsX 8GB DDR3 1600（F3-12800CL10S-8GBXL），超值“白菜价，火红霸气的外形，扎实的</a>
					<a class="pic" href="http://tuan.zol.com/5545.html"><img width="125" height="150" title="258元抢购芝奇DDR3 1600 8G单条内存" alt="258元抢购芝奇DDR3 1600 8G单条内存" src="http://img.zol-img.com/zol_tuan/tuan_pic/other/10_200x150/tuan_9559.jpg"></a>
					<div class="bulkatt clearfix">
						<span><em>67</em>人已团购</span>
						<a title="258元抢购芝奇DDR3 1600 8G单条内存" target="_blank" class="seebtn" href="http://tuan.zol.com/5545.html">去看看</a>
					</div>
				</li>
                				<li class="slides">
					<a class="tit" href="http://tuan.zol.com/5593.html" title="仅1349元！华为U8950D 荣耀加强版 双核1.2G主频 4.5寸屏" target="_blank">仅1349元！原价1899元 华为U8950D 荣耀+ 强劲双核1.2G主频 双卡安卓4.0 4.5寸IPS大屏 惊人分辨率带来完美视觉体验 8</a>
					<a class="pic" href="http://tuan.zol.com/5593.html"><img width="125" height="150" title="仅1349元！华为U8950D 荣耀加强版 双核1.2G主频 4.5寸屏" alt="仅1349元！华为U8950D 荣耀加强版 双核1.2G主频 4.5寸屏" src="http://img.zol-img.com/zol_tuan/tuan_pic/other/10_200x150/tuan_9587.jpg"></a>
					<div class="bulkatt clearfix">
						<span><em>412</em>人已团购</span>
						<a title="仅1349元！华为U8950D 荣耀加强版 双核1.2G主频 4.5寸屏" target="_blank" class="seebtn" href="http://tuan.zol.com/5593.html">去看看</a>
					</div>
				</li>
                                			</ul></div>
			<!--
			<div class="left_turn left_turn_no">左翻</div>
			<div class="right_turn">右翻</div>
			-->
		</div>
	</div>
</div>
<?php include APPPATH.'views/footer.php';?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/user.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/product.js"></SCRIPT>
<script type="text/javascript">
</script>
</body>
</html>