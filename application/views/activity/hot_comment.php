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
        .poster_grid .new_poster .pic_load{background:url("/images/g_loading1.gif") no-repeat scroll center center transparent; display:block}
        .like_merge{height:28px; left:6px; overflow:hidden; position:absolute; top:6px; width:200px}
        .like_merge .poster_del{background:url("/images/like_merge1.png") repeat-x scroll 0 0 transparent; border:1px solid #FCBCD2; border-radius:4px 4px 4px 4px; color:#F69; cursor:pointer; font-weight:bold; height:26px; line-height:26px; margin-right:7px; overflow:hidden; padding:0 5px; text-align:center}
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
        .poster_grid .new_poster .comm_box .likes .likes_status{background:url("/images/like_merge1.png") repeat scroll 0 -145px transparent;color:#FFF;float:left;height:21px;margin-right:6px;text-align:center;width:50px}
        b, strong{font-weight:bolder}
        .lm_love2{background-position:-53px -29px;padding:0 5px 0 6px}
        .lm_love, .lm_love2, .lm_comm, .lm_shouji{height:12px}
        .poster_grid .new_poster .comm_box .comm_num span{padding-right:6px}
        .red_f{color:#F69}
        .poster_grid .new_poster .love_pro{background:url("/images/love_pro.png") no-repeat scroll 0 0 transparent;  color:#F69;  float:left;  height:30px;  left:0;  line-height:25px;  position:absolute;  text-align:center;  top:-30px;  width:130px}
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
    <div class="box3" style="width: 980px;">
        <img alt="Kai Cui" src="/images/hot_comment_ads.jpg" width="980" height="100" style="margin-top: 5px;"/>
    </div>

<div style="width: 990px;" class="box" id="contents">
    <div id="comment_hots">
        <!---->
        <?php foreach ($comment_data as $k=>$v){ ?>
        <div class="poster_grid" >
            <div class="new_poster">
                <div class="np_pic hover_pic">
                    <div class="no"></div>
                    <a target="_blank" href="" class="pic_load">
                        <img width="164" height="197" src="<?=config_item('static_url')?>images/lazy.gif"
                             data-original="<?=config_item('static_url')?>upload/product/<?=intToPath($k)?>default.jpg" class="goods_pic" alt="产品"/>
                    </a>
                    <div class="like_merge" style="display: none;">
                        <a href="javascript:void(0)" class="right_f poster_forward">
                            <em class="lm_shouji">&nbsp;</em>收进杂志&nbsp;<span class="poster_forward_num line_num">265</span>
                        </a>
                    </div>
                </div>
                <div class="comm_box twiiter_box"><p class="posterContent">天空是蓝色的</p>

                    <p class="comm_num l20_f">
                        <a href="javascript:void(0)" class="poster_comment pl">评论 <span class="poster_comment_num"><?=count($v);?></span></a>
                        <a href="javascript:void(0)" class="left_f poster_likes likes " isshowlike="1">
                            <b class="likes_status"> <i class="lm_love2">&nbsp;</i>喜欢 </b> <span class="red_f poster_like_num"><?=count($v) * 8;?></span>
                        </a>
                        <a class="love_pro none_f">这是你自己分享的哦！</a></p>

                    <div class="clear_f"></div>
                </div>

                <?php $i = 0;foreach ($v as $comment_value) {?>
                <div class="comm_share commentHover">
                    <a target="_blank" href="javascript:void(0);" class="avatar32_f trans07 userInfoTips">
                        <img src="<?=config_item('static_url')?>images/lazy.gif"
                             data-original="<?=config_item('static_url')?>upload/designer/<?=intToPath($comment_value['uid'])?>default.jpg">
                    </a>
                    <p class="ml40_f">
                        <a target="_blank" href="javascript:void(0);" class="fb_f"><?=$comment_value['uname'];?></a> <span class="gray_f"><?=$comment_value['title'];?></span>
                        <a href="javascript:void(0)" class="comment_reply v_hidden" style="visibility: hidden;">回复</a>
                    </p>
                    <div class="clear_f"></div>
                </div>
                <?php $i++; if ($i == 2) { break; } }?>

                <?php if (count($v) > 2){ ?>
                <div class="comm_share c_f"><a target="_blank" href="<?=productURL($k);?>"> 查看全部<?=count($v);?>条评论...</a></div>
                <?php }?>
            </div>
        </div>
        <?php }?>
        <!---->
        <div id="loads"></div>
    </div>
</div>
</div>
<div class="clear"></div>
<div class="loading" id="loading" style="display:none;text-align:center;vertical-align:middle;font-size:30px;background-color:#F2F0F0;"><img src="/images/loading.gif">......</div>
<div class="loading font10" id="no_more_results" style="display:none;text-align:center;background-color:#F2F0F0;padding: 50px;">没有更多.</div>

<!--
<div class="page clear">
<div class="pages">
<a href="/comment/hot?offset=10">下一页</a>
   </div>
</div>
-->

<nav id="page-nav">
    <a href="/activity/activity/hot_comment?offset=2"></a>
</nav>
<?php include(APPPATH."views/footer.php");?>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/scrollpagination.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery.infinitescroll.js"></script>
<script type="text/javascript">
$(function(){

  var $container = $('#comment_hots');
  $container.imagesLoaded(function(){
    $container.masonry({
      itemSelector: '.poster_grid',
      columnWidth: 198
    });
  });

  $container.infinitescroll({
    navSelector  : '#page-nav',    // selector for the paged navigation
    nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
    itemSelector : '.poster_grid',     // selector for all items you'll retrieve
    loading: {
        finishedMsg: 'No more pages to load.',
        img: '/images/loading.gif'
      }
    },
    // trigger Masonry as a callback
    function( newElements ) {
      // hide new items while they are loading
      var $newElems = $( newElements ).css({ opacity: 0 });
      // ensure that images load before adding to masonry layout
      $newElems.imagesLoaded(function(){
        // show elems now they're ready
        $newElems.animate({ opacity: 1 });
        $container.masonry( 'appended', $newElems, true );
      });
    }
  );

});

    /*
    var $comment_hots = $('#comment_hots');
    $comment_hots.imagesLoaded(function () {
        $comment_hots.masonry({
            itemSelector:'.poster_grid',
            columnWidth:198,
            isAnimated:true, //使用jquery的布局变化  Boolean
            gutterWidth:0, //列的间隙 Integer
            isFitWidth:true, // 适应宽度   Boolean
            isResizableL:true, // 是否可调整大小 Boolean
            isRTL:false //使用从右到左的布局 Boolean
        });
    });

    $(function () {
        $('#comment_hots').infinitescroll({
                navSelector:'#page-nav',
                nextSelector:'#page-nav a', //下一页选择器
                itemSelector:".poster_grid", //下一页中需要被加载进当前页的块
                loading:{ //加载效果
                    finishedMsg:'No more pages to load',
                    img:'/images/loading.gif'
                }
            },
            function (newElements) { //回调函数，用Masonry布局
                var $newElems = $(newElements);
                $('#container').masonry('appended', $newElems);
            }
        );
    });
//*/







    /*无限下拉*/
    /*
    $(function () {
        $('#comment_hots').scrollPagination({
            'dataType':'json',
            'contentPage':'/comment/hot', // the url you are fetching the results
            'contentData':'', // these are the variables you can pass to the request, for example: children().size() to know which page you are
            'scrollTarget':$(window), // who gonna scroll? in this example, the full window
            'heightOffset':600, // it gonna request when scroll is 10 pixels before the page ends
            'bottomlimit':$('#comment_hots'),
            'beforeLoad':function () { // before load function, you can display a preloader div
                $('#loading').show();

                this.contentData = 'offset=' + this.offset + '&callback=?'
                this.offset += 10;
            },
            'afterLoad':function (elementsLoaded, data) { // after loading content, you can use this function to animate your new elements
                //console.log(elementsLoaded);
                $('#loading').hide();
                //$(elementsLoaded).fadeInWithDelay();
                var html = '';
                $.each(data, function (i, item) {
                    html += '<div class="poster_grid" >\
                                <div class="new_poster">\
                                    <div class="np_pic hover_pic">\
                                        <div class="no"></div>\
                                        <a target="_blank" href="'+wx.productURL(i)+'" class="pic_load">\
                                            <img width="164" height="197" src="/images/lazy.gif"\
                                                 data-original="/upload/product/'+idToPath(i)+'default.jpg" class="goods_pic" alt="产品"/>\
                                        </a>\
                                        <div class="like_merge" style="display: none;">\
                                            <a href="javascript:void(0)" class="right_f poster_forward">\
                                                <em class="lm_shouji">&nbsp;</em>收进杂志&nbsp;<span class="poster_forward_num line_num">265</span>\
                                            </a>\
                                        </div>\
                                    </div>\
                                    <div class="comm_box twiiter_box"><p class="posterContent">天空是蓝色的</p>\
                                        <p class="comm_num l20_f">\
                                            <a href="javascript:void(0)" class="poster_comment pl">评论 <span class="poster_comment_num">'+ item.length+'</span></a>\
                                            <a href="javascript:void(0)" class="left_f poster_likes likes " isshowlike="1">\
                                                <b class="likes_status"> <i class="lm_love2">&nbsp;</i>喜欢 </b> <span class="red_f poster_like_num">'+parseInt(i.length * 8)+'</span>\
                                            </a>\
                                            <a class="love_pro none_f">这是你自己分享的哦！</a></p>\
                                        <div class="clear_f"></div>\
                                    </div>';

                    var iNum = 1;
                    $.each(item, function (ii, items){
                        if (iNum > 2) {return;}
                        html += '<div class="comm_share commentHover">\
                                    <a href="javascript:void(0);" class="avatar32_f trans07 userInfoTips">\
                                        <img src="/images/lazy.gif"\
                                             data-original="/upload/designer/'+idToPath(items.uid)+'default.jpg">\
                                    </a>\
                                    <p class="ml40_f">\
                                        <a href="javascript:void(0);" class="fb_f">'+items.uname+'</a> <span class="gray_f">'+items.title+'</span>\
                                        <a href="javascript:void(0)" class="comment_reply v_hidden" style="visibility: hidden;">回复</a>\
                                    </p>\
                                    <div class="clear_f"></div></div>';
                        iNum++;
                    });

                    if (item.length > 1) { html += '<div class="comm_share c_f"><a target="_blank" href="'+wx.productURL(i)+'"> 查看全部'+item.length+'条评论...</a></div>'; }
                    html += '</div></div>';
                });

                if (!html || this.offset > this.heightOffset) {
                    $('#no_more_results').fadeIn();
                    $('#comment_hots').stopScrollPagination();
                } else {
                    console.log(this.offset);
                    if (this.offset == 10) {
                        $('#comment_hots').append(html);

                        var $comment_hots = $('#comment_hots');
                        $comment_hots.imagesLoaded(function () {
                            $comment_hots.masonry({
                                itemSelector:'.poster_grid',
                                columnWidth:198,
                                isAnimated:true, //使用jquery的布局变化  Boolean
                                gutterWidth:0, //列的间隙 Integer
                                isFitWidth:true, // 适应宽度   Boolean
                                isResizableL:true, // 是否可调整大小 Boolean
                                isRTL:false //使用从右到左的布局 Boolean
                            });
                        });
                    } else {
                        var $newElems = $(elementsLoaded).css({ opacity: 0 });
                        $newElems.imagesLoaded(function () {
                            // show elems now they're ready
                            $newElems.animate({ opacity: 1 });
                            $('#comment_hots').masonry('appended', $newElems, true);
                        });
                    }


                    var $newElems = $(html).css({ opacity: 0 });
                    $newElems.imagesLoaded(function () {
                        // show elems now they're ready
                        $newElems.animate({ opacity: 1 });
                        $('#_container').masonry('appended', html, true);
                    });



                    var $newElems = $(html).css({ opacity: 0 });
                    $newElems.imagesLoaded(function () {
                        // show elems now they're ready
                        $newElems.animate({ opacity: 1 });
                        $('#comment_hots').masonry('appended', $newElems, true);
                    });

                }
            }
        });


        // code for fade in element by element
        $.fn.fadeInWithDelay = function () {
            var delay = 0;
            return this.each(function () {
                $(this).delay(delay).animate({opacity:1}, 200);
                delay += 1000;
            });
        };

    });


    /*
    var $comment_hots = $('#comment_hots');
    $comment_hots.imagesLoaded(function () {
        $comment_hots.masonry({
            itemSelector:'.poster_grid',
            columnWidth:198,
            isAnimated:true, //使用jquery的布局变化  Boolean
            gutterWidth:0, //列的间隙 Integer
            isFitWidth:true, // 适应宽度   Boolean
            isResizableL:true, // 是否可调整大小 Boolean
            isRTL:false //使用从右到左的布局 Boolean
        });
    });

    $('.globals img').lazyload({effect:"fadeIn"});
//*/
</script>
<!-- #EndLibraryItem -->
</body>
</html>