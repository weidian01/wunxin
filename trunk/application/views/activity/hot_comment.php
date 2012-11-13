<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?=$title;?> -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery.lazyload.min.js"> </script>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery.masonry.min.js"> </script>

    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
        .poster_grid poster_wall pins{width:200px; margin:5px; /*float:left;*/}
        .poster_grid{display:inline; /*float:left;*/ margin-left:5px; margin-right:5px; width:188px; word-wrap:break-word}
        .poster_grid .new_poster{background-color:#FFF; border-radius:4px 4px 4px 4px; box-shadow:0 1px 3px rgba(34,25,25,0.2); margin-top:14px; width:185px}
        .poster_grid .new_poster .np_pic{padding:6px 6px; position:relative; text-align:center; width:175px}
        .poster_grid .new_poster .pic_load{background:url("<?=config_item('static_url')?>images/g_loading1.gif") no-repeat scroll center center transparent; display:block}
        .like_merge{height:28px; left:6px; overflow:hidden; position:absolute; top:6px; width:200px}
        .like_merge .poster_del{background:url("<?=config_item('static_url')?>images/like_merge1.png") repeat-x scroll 0 0 transparent; border:1px solid #FCBCD2; border-radius:4px 4px 4px 4px; color:#F69; cursor:pointer; font-weight:bold; height:26px; line-height:26px; margin-right:7px; overflow:hidden; padding:0 5px; text-align:center}
        .right_f{float:right}
        .lm_shouji{background-position:-32px -31px;padding:0 6px}
        .lm_love, .lm_love2, .lm_comm, .lm_shouji{height:12px}
        em{font-style:normal}
        .like_merge .line_num{border-left:1px solid #FCBCD2;display:inline-block;padding-left:5px}
        .poster_grid .new_poster .comm_box{padding:0 13px 8px}
        .poster_grid .new_poster .comm_box .posterContent{line-height:18px;margin-top:8px}
        .poster_grid .new_poster .comm_box .comm_num{margin-top:8px;position:relative;width:175px}
        .l20_f{line-height:20px}
        .poster_grid .new_poster .comm_box .comm_num .pl{color:#F69;float:right;margin-right: 7px;}
        .poster_grid .new_poster .comm_box .comm_num span{padding-right:6px}
        .poster_grid .new_poster .comm_box .likes{border:1px solid #FF77A5;border-radius:4px 4px 4px 4px;cursor:pointer;height:21px;line-height:21px}
        .left_f{float:left}
        .poster_grid .new_poster .comm_box .likes .likes_status{background:url("<?=config_item('static_url')?>images/like_merge1.png") repeat scroll 0 -145px transparent;color:#FFF;float:left;height:21px;margin-right:6px;text-align:center;width:50px}
        b, strong{font-weight:bolder}
        .lm_love2{background-position:-53px -29px;padding:0 5px 0 6px}
        .lm_love, .lm_love2, .lm_comm, .lm_shouji{height:12px}
        .poster_grid .new_poster .comm_box .comm_num span{padding-right:6px}
        .red_f{color:#F69}
        .poster_grid .new_poster .love_pro{background:url("<?=config_item('static_url')?>images/love_pro.png") no-repeat scroll 0 0 transparent;  color:#F69;  float:left;  height:30px;  left:0;  line-height:25px;  position:absolute;  text-align:center;  top:-30px;  width:130px}
        .none_f{ display:none}
        .clear_f{ clear:both;  height:0;  overflow:hidden}
        .poster_grid .new_poster .np_share, .poster_grid .new_poster .comm_share, .poster_grid .new_poster .discuss_one{ background:none repeat scroll 0 0 #F9F9F9;  border-bottom:1px solid #DDD;  color:#999;  line-height:18px;  overflow:hidden;  padding:10px 13px}
        .poster_grid .new_poster .np_share span, .poster_grid .new_poster .np_share a, .poster_grid .new_poster .comm_share a, .poster_grid .new_poster .comm_share span, .poster_grid .new_poster .issue_box a, .poster_grid .new_poster .issue_box span, .poster_grid .new_poster .comm_issue p a, .poster_grid .new_poster .comm_issue p span{ margin-right:4px}
        .trans07{ opacity:0.7}
        .avatar32_f{ float:left;  height:32px;  width:32px}
        .avatar32_f img{ float:left;  height:32px;  width:32px}
        fieldset, img{ border:0 none}
        .ml40_f{ margin-left:40px}
        .poster_grid .new_poster .np_share span, .poster_grid .new_poster .np_share a, .poster_grid .new_poster .comm_share a, .poster_grid .new_poster .comm_share span, .poster_grid .new_poster .issue_box a, .poster_grid .new_poster .issue_box span, .poster_grid .new_poster .comm_issue p a, .poster_grid .new_poster .comm_issue p span{ margin-right:4px}
        .fb_f{ font-weight:bold}
         .poster_grid .new_poster .comment_reply{ color:#F69;  line-height:16px;  white-space:nowrap}
         .v_hidden{ visibility:hidden}
        .poster_grid .new_poster .comm_share, .poster_grid .new_poster .discuss_onee, .poster_grid .new_poster .comm_issue, .poster_grid .new_poster .discuss_two, .poster_grid .new_poster .more_comm{ border-top:1px solid #FFF}
         .poster_grid .new_poster .np_share, .poster_grid .new_poster .comm_share, .poster_grid .new_poster .discuss_one{ background:none repeat scroll 0 0 #F9F9F9;  border-bottom:1px solid #DDD;  color:#999;  line-height:18px;  overflow:hidden;  padding:10px 13px}
         .trans07{ opacity:0.7}
         .avatar32_f{ float:left;  height:32px;  width:32px}
        .avatar32_f img{ float:left;  height:32px;  width:32px}
         fieldset, img{ border:0 none}
        .ml40_f{ margin-left:40px}
         .gray_f{ color:#999;  text-decoration:none}
         .c_f{ text-align:center}
    </style>
    <script type="text/javascript">

    </script>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>





<div class="globals" style="background-color:#F2F0F0;">
    <!--
    <div class="box3" style="width: 980px;">
        <img alt="Kai Cui" src="<?=config_item('static_url')?>images/hot_comment_ads.jpg" width="980" height="100" style="margin-top: 5px;"/>
    </div>
    -->
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></script>
    <script type="text/javascript">wx.advert(3);//$(document).ready(function(){ wx.advert(3); });</script>

<div style="width: 990px;" class="box" id="contents">
    <div id="comment_hots">
        <?php include(__DIR__.'/hot_comment_template.php');?>
        <div id="loads"></div>
    </div>
</div>
</div>
<div class="clear"></div>
<div class="loading" id="loading" style="width:100%;text-align:center;vertical-align:middle;font-size:30px;background-color:#F2F0F0;padding: 20px;"></div>
<div class="loading font10" id="no_more_results" style="display:none;text-align:center;background-color:#F2F0F0;padding: 50px;">没有更多.</div>

<!--

<div class="pages">
<a href="<?=config_item('static_url')?>comment/hot?offset=10">下一页</a>
   </div>
</div>
-->
<div class="clear">
</div>
<div id="infscr-loadings"></div>

<nav id="page-nav">
    <a href="<?=config_item('static_url')?>activity/activity/hot_comment?offset=2&callback=?"></a>
    <!--<a href="2.html"></a>-->
</nav>
<?php include(APPPATH."views/footer.php");?>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/scrollpagination.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery.infinitescroll.js"></script>
<script type="text/javascript">
    //*
    $(function () {
        var $container = $('#comment_hots');
        $container.imagesLoaded(function () {
            $container.masonry({
                itemSelector:'.poster_grid',
                columnWidth:198
            });
        });

        $container.infinitescroll({
                navSelector:'#page-nav', // selector for the paged navigation
                nextSelector:'#page-nav a', // selector for the NEXT link (to page 2)
                itemSelector:'.poster_grid', // selector for all items you'll retrieve
                //animate:true,
                //appendCallback:false,
                //dataType:'json',
                loading:{
                    finishedMsg:'没有更多数据.',
                    finishedTime:86400,
                    img:'/images/ajax-loader.gif',
                    selector:'#loading',
                    msgText:''
                    //speed: 'slow'
                }
            },

            // trigger Masonry as a callback
            function (newElements) {
                //alert(newElements);
                // hide new items while they are loading
                var $newElems = $(newElements).css({ opacity:0 });
                // ensure that images load before adding to masonry layout
                $newElems.imagesLoaded(function () {
                    // show elems now they're ready
                    $newElems.animate({ opacity:1 });
                    $container.masonry('appended', $newElems, true);
                });
                $('#comment_hots img').lazyload({effect:"fadeIn"});
            }
        );
    });

    $('#comment_hots img').lazyload({effect:"fadeIn"});
    //*/
</script>
<!-- #EndLibraryItem -->
</body>
</html>