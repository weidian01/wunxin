<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?=$promotion['name'];?> -- 万象网</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></SCRIPT>
    <SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/index.js"></SCRIPT>
    <SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/lrscroll.js"></SCRIPT>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery.lazyload.min.js"> </script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
        .wrapper {margin: 0 auto;width: 980px;}
        .clearfix:after {clear: both;content: ".";display: block;font-size: 0;height: 0;visibility: hidden;}
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
        .recommendmod .price em{ position:relative; top:2px; font-size:18px; font-weight:bold; font-family:"Microsoft YaHei","微软雅黑"; color:#cc0000;}
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
        .slider_list{ width:960px; margin:0px; /*height:341px;*/ overflow:hidden;}
        .bulklist{ height:341px;}
        .bulklist li{ width:166px; /*height:305px;*/ float:left; padding:16px 14px 16px;}
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
    <script type="text/javascript">
        function clock(hot_id, startTime, endTime, nowTime, goods_num){
       		var promoStatus = promoStatus;
       		var startTime = startTime;
       		var endTime = endTime;
       		var nowTime = nowTime;
       		if (goods_num <= 0){
       			//var lastTime = '<em>剩余时间：</em><b class="n00">0</b><b class="n00">0</b> <span>时</span> <b class="n00">0</b><b class="n00">0</b> <span>分</span> <b class="n00">0</b><b class="n00">0</b> <span>秒</span>';
       			$("#promo_status_"+hot_id).attr("class", "ended");
       			//$('#promo_time_'+hot_id).html(lastTime);
       			return false;
       		}
       		if (leave <= 0){
       			var lastTime = '<span>剩余时间：</span><b class="n00">0</b><b class="n00">0</b> <span>时</span> <b class="n00">0</b><b class="n00">0</b> <span>分</span> <b class="n00">0</b><b class="n00">0</b> <span>秒</span>';
       			$("#promo_status_"+hot_id).attr("class", "ended");
       		}else{
       			if (startTime > nowTime){
       				var leave = startTime - nowTime;
       				$("#promo_status_"+hot_id).attr("class", "qiangbtn_blue");
       				var lastTime = '<span>开抢倒计时：</span>';
       			}else{
       				var leave = endTime - nowTime;
       				$("#promo_status_"+hot_id).attr("class", "qiangbtn_red");
       				var lastTime = '<span>剩余时间：</span>';
       			}

       			var hour = Math.floor(leave / 3600);
       			hour = hour < 10 ? "0" + hour : hour;
       			hour = hour.toString();
       			var hourLen = hour.length;
       			for (var i = 0; i < hourLen; i++){
       				lastTime += '<b class="n'+ hour.substr(i, 1) +'">'+hour.substr(i, 1)+'</b>';
       			}

       			lastTime += '<span>时</span>';

       			var minute = Math.floor(leave / 60) - (hour * 60);
       			minute = minute < 10 ? "0" + minute : minute;
       			minute = minute.toString();
       			var minuteLen = minute.length;
       			for (var j = 0; j < minuteLen; j++){
       				lastTime += '<b class="n'+ minute.substr(j, 1) +'">'+minute.substr(j, 1)+'</b>';
       			}
       			lastTime += '<span>分</span>';

       			var second = leave - (hour * 3600) - (minute * 60);
       			second = second < 10 ? "0" + second : second;
       			second = second.toString();
       			var secondLen = second.length;
       			for (var k = 0; k < secondLen; k++){
       				lastTime += '<b class="n'+ second.substr(k, 1) +'">'+second.substr(k, 1)+'</b>';
       			}
       			lastTime += '<span>秒</span>';

       		}

       		$('#promo_time_'+hot_id).html(lastTime);
       		if (startTime > nowTime){
       			startTime -- ;
       		}else{
       			endTime -- ;
       		}

       		setTimeout("clock('"+hot_id+"', '"+startTime+"', '"+endTime+"', '"+nowTime+"', '"+goods_num+"')", 1000);
       	}
    </script>
</head>
<body>
<?php include APPPATH.'views/header.php';?>
<div class="contentbg">

    <div class="wrapper">
		<div class="ad_div" style="text-align: center;">
			<div>
                <a title="" target="_blank" href="">
                    <img class="lazy" width="980" height="90" alt="真情9月 数码平板1折起" src="<?=config_item('static_url')?>images/lazy.gif" data-original="/images/301.jpg">
                </a>
            </div>
		</div>
	</div>

    <ul class="recommendmod">
        <?php $dli = 1;foreach ($default_lb as $dlv):?>
        <li class="recommend_<?=$dli;?>">
            <a title="<?=$dlv['pname']?>" class="pic" href="<?=productURL($dlv['pid']);?>" target="_blank">
                <img class="lazy" width="125" height="150" title="<?=$dlv['pname']?>" alt="<?=$dlv['pname']?>" src="<?=config_item('static_url')?>images/lazy.gif" data-original="
                <?php echo empty ($dlv['product_image']) ?
                    config_item('img_url').'product/'.intToPath($dlv['pid']).'default.jpg' :
                    config_item('base_url').str_replace('\\', '/', $dlv['product_image']);?>">
            </a>
            <h3><a href="<?=productURL($dlv['pid']);?>" target="_blank" title="<?=$dlv['pname']?>"><?=$dlv['pname']?></a></h3>
            <p class="price">抢购价：<em><span>¥</span><?=fPrice($dlv['promotion_price']);?></em></p>
            <p>市场价：<del>¥ <?=fPrice($dlv['sell_price']);?></del></p>
            <p>立省：<b><?=fPrice($dlv['sell_price'] - $dlv['promotion_price']);?></b>元</p>
            <p>余量：<b><?=intval($dlv['inventory'] - $dlv['sales_num']);?></b>件</p>
            <a class="qiangbtn_small" href="<?=productURL($dlv['pid']);?>" target="_blank" title="<?=$dlv['pname']?>">立即抢购</a>
        </li>
        <?php $dli++;endforeach;?>
    </ul>

    <?php $i = 1;foreach ($product as $k => $v):?>
    <div class="wrapper category_<?=$i?>">
		<div class="mod_hd mt20">
			<h3><?=$v['name'];?><span>抢购</span></h3>
			<!--<a class="more" href="#" target="_blank">查看更多&gt;&gt;</a>-->
		</div>
    <ul class="snaplist clearfix">
        <?php $count = count($v['item']);foreach ($v['item'] as $ik => $iv):?>
        <li class="<?=($count == ($ik+1)) ? 'last' : '';?>">
            <div class="snapmod">
                <a class="pic" target="_blank" href="<?=productURL($iv['pid']);?>" title="<?=$iv['pname']?>">
                    <img class="lazy" width="164" height="197" title="<?=$iv['pname']?>" alt="<?=$iv['pname']?>" src="<?=config_item('static_url')?>images/lazy.gif" data-original="
                    <?php echo empty ($iv['product_image']) ?
                        config_item('img_url').'product/'.intToPath($iv['pid']).'default.jpg' :
                        config_item('base_url').str_replace('\\', '/', $iv['product_image']);?>">
                </a>
                <h4><a title="<?=$iv['pname']?>" target="_blank" href="<?=productURL($iv['pid']);?>"><?=$iv['pname']?></a></h4>
                <p class="price">抢购价：<em><span>¥</span><?=fPrice($iv['promotion_price']);?></em></p>
                <p>市场价： <del>¥ <?=fPrice($iv['sell_price']);?></del> </p>
                <p>立省：<b><?=fPrice($iv['sell_price']-$iv['promotion_price']);?></b>元</p>
                <p>余量：<b><?=intval($iv['inventory'] - $iv['sales_num']);?></b>件</p>
                <div class="snap_att clearfix">
                    <a id="promo_status_<?=$iv['id']?>" class="qiangbtn_red" target="_blank" href="<?=productURL($iv['pid']);?>" title="<?=$iv['pname']?>">立即抢购</a>
                    <!--<span>已有<em><?=empty($iv['attention_num']) ? '0' : $iv['attention_num'];?></em>人关注</span>-->
                </div>
            </div>
            <div id="promo_time_<?=$iv['id']?>" class="countdown">
                <script type="text/javascript">
                    <?php //echo '<pre>';print_r($iv);exit;?>
                clock(<?=$iv['id']?>, <?=strtotime($iv['start_time'])?>, <?=strtotime($iv['end_time'])?>, <?=time();?>, <?=$iv['id']?>);
                //clock(hot_id, startTime, endTime, nowTime, goods_num)
                </script>
                <!--
                <span>剩余时间：</span><b class="n1">1</b><b
                class="n8">8</b><span>时</span><b class="n5">5</b><b class="n3">3</b><span>分</span><b class="n2">2</b><b
                class="n0">0</b><span>秒</span>
                -->
                </div>
            <i class="<?php switch($iv['sales_status']){
                case SS_BERSERK : $class = 'ico_fengqiang';break;
                case SS_FREE : $class = 'ico_baoyou';break;
                case SS_HOT : $class = 'ico_remai';break;
                case SS_NEW : $class = 'ico_xinpin';break;
                default: $class = 'ico_fengqiang';;
            }
                echo $class;
                ?>"><?=$sales_status[$iv['sales_status']]?></i>
        </li>
        <?php endforeach;?>
    </ul>
	</div>
    <?php $i++; endforeach;?>

    <div class="wrapper category_6">
		<div class="mod_hd mt20">
			<h3><span class="red">往期</span><span>抢购</span></h3>
			<!--<a class="more" href="http://tuan.zol.com" target="_blank">查看更多&gt;&gt;</a>-->
		</div>
		<div class="bulkmod">
			<div class="slider_list clearfix" id="slideInner">
                <ul class="bulklist clearfix" style="width: 2240px;">
                <?php foreach ($before_lb as $blv):?>
                <li class="slides" style="text-align: center;">
					<a class="tit" href="<?=productURL($blv['pid']);?>" title="<?=$blv['pname'];?>" target="_blank"><?=$blv['pname'];?></a>
					<a class="pic" href="<?=productURL($blv['pid']);?>">
                        <img class="lazy" width="164" height="197" title="<?=$blv['pname'];?>" alt="<?=$blv['pname'];?>" src="<?=config_item('static_url')?>images/lazy.gif" data-original="
                        <?php echo empty ($iv['product_image']) ?
                                config_item('img_url').'product/'.intToPath($blv['pid']).'default.jpg' :
                                config_item('base_url').str_replace('\\', '/', $blv['product_image']);?>">
                    </a><br/>
					<div class="bulkatt clearfix">
						<span><em><?=empty ($blv['limit_buy_num']) ? '0' : $blv['limit_buy_num'];?></em>人已抢购</span>
						<a title="<?=$blv['pname'];?>" target="_blank" class="seebtn" href="<?=productURL($blv['pid']);?>">去看看</a>
					</div>
				</li>
                <?php endforeach;?>
            </ul>
        </div>
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
    $('.contentbg img.lazy').lazyload({effect:"fadeIn"});
</script>
</body>
</html>