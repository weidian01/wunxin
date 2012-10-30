<?php foreach ($pData as $k=>$v){ ?>
<div class="poster_grid" >
    <div class="new_poster">
        <div class="np_pic hover_pic">
            <div class="no"></div>
            <a target="_blank" href="<?=productURL($v['pid']);?>" class="pic_load">
                <img width="164" height="197" src="<?=config_item('static_url')?>images/lazy.gif"
                     data-original="<?=config_item('static_url')?>upload/product/<?=intToPath($v['pid'])?>default.jpg" class="goods_pic" alt="产品"/>
            </a>
            <div class="like_merge" style="display: none;">
                <a href="javascript:void(0)" class="right_f poster_forward">
                    <em class="lm_shouji">&nbsp;</em>收进杂志&nbsp;<span class="poster_forward_num line_num">265</span>
                </a>
            </div>
        </div>
        <div class="comm_box twiiter_box"><p class="posterContent"><?=$v['pname']?></p>

            <p class="comm_num l20_f">
                <a href="javascript:void(0)" class="poster_comment pl">评论 <span class="poster_comment_num"><?=$v['comment_num'];?></span></a>
                <a href="javascript:void(0)" class="left_f poster_likes likes " isshowlike="1">
                    <b class="likes_status"> <i class="lm_love2">&nbsp;</i>喜欢 </b> <span class="red_f poster_like_num"><?=$v['comment_num'] * 8;?></span>
                </a>
                <a class="love_pro none_f">这是你自己分享的哦！</a></p>
            <div class="clear_f"></div>
        </div>

        <?php $i = 0;foreach ($v['comment'] as $comment_value) {?>
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

        <?php if ($v['comment_num'] > 2){ ?>
        <div class="comm_share c_f"><a target="_blank" href="<?=productURL($v['pid']);?>"> 查看全部<?=$v['comment_num'];?>条评论...</a></div>
        <?php }?>
    </div>
</div>
<?php }?>