<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的评论 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <link href="<?=config_item('static_url')?>css/scj.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/scrollshow.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<!-- #BeginLibraryItem "/Library/header.lbi" (pId, title, content, rank, comfort, exterior, size_deviation)-->
<?php include('/../../header.php');?>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">我的评论</div>
        </div>
        <div class="u-r-box">
            <div class="scj">
                <div class="main">
                    <div class="tab">
                        <a href="/user/center/productComment" class="act">产品评论</a>
                        <a href="/user/center/designComment">设计图评论</a>
                        <a href="/user/center/designerComment">设计师留言</a>
                    </div>
                    <div id="itemList">
                        <div class="list-m">
                                <table width="100%" class="table2">
                                    <thead>
                                    <tr>
                                        <!--<td align="center" style="text-align:center;"><b style="color: #8B8378;">收藏编号</b></td>-->
                                        <th colspan="2" align="left"><b style="color: #8B8378;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;产品信息</b></th>
                                        <td align="center" style="text-align:center;"><b style="color: #8B8378;">评论内容</b></td>
                                        <th align="center" style="text-align:center;"><b style="color: #8B8378;">人气</b></th>
                                        <td align="center" style="text-align:center;"><b style="color: #8B8378;">评论时间</b></td>
                                        <th align="center" style="text-align:center;"><b style="color: #8B8378;">操作</b></th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody">
                                    <?php if (empty ($data)) { ?>
                                        <tr>
                                            <td colspan="6"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">您还没有产品评论，购买产品后赶紧评论吧。</td>
                                        </tr>
                                    <?php } else {?>
                                        <?php foreach ($data as $v) {?>
                                        <tr>
                                            <!--<td style="width:90px;text-align:center;"><?php echo $v['id'];?></td>-->
                                            <td style="width:20px;">
                                                <div class="imgbox">
                                                    <a href="<?=productURL($v['pid'])?>" title="<?=$v['pname'];?>" target="_blank">
                                                        <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($v['pid'])?>icon.jpg" alt="" width="60" height="60"/>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="<?=productURL($v['pid'])?>" class="a_e" title="<?=$v['pname'];?>" target="_blank"><?=$v['pname'];?></a>&nbsp;&nbsp;
                                                <span style="color: #CC0033;font-weight: bold;">￥<?=fPrice($v['sell_price']);?></span><br>
                                            </td>
                                            <td style="width:170px;text-align:center;"><?=$v['content'];?></td>
                                            <td style="width:70px;text-align:left;">
                                                &nbsp;&nbsp;<a href="#" title="此评论被评论 <?=$v['comment_num'];?> 条" style="color: #990000;font-size: 10px;">被评论 <?=$v['comment_num'];?> 条</a> <br />
                                                &nbsp;&nbsp;<a href="#" title="此评论被回复 <?=$v['comment_num'];?> 条" style="color: #990000;font-size: 10px;">回复 <?=$v['reply_num'];?> 条</a>
                                            </td>
                                            <td style="width:60px;text-align:center;"><?=date('Y-m-d', strtotime($v['create_time']));?></td>
                                            <td style="width:70px;text-align:center;">
                                                <a href="<?=productURL($v['pid'])?>" target="_blank">
                                                    <img src="<?=config_item('static_url')?>images/buy.png" title="购买此产品">
                                                </a><br/>
                                                <!--
                                                <a href="javascript:void(0);" onclick="(<?=$v['comment_id'];?>)">
                                                    <img src="<?=config_item('static_url')?>images/comment.png" title="评论此产品">
                                                </a>
                                                -->
                                                <a href="javascript:void(0);" onclick="product.deleteProductComment(<?=$v['comment_id'];?>)">
                                                    <img src="<?=config_item('static_url')?>images/delete.png" title="删除此产品评论">
                                                </a> <br />
                                            </td>
                                        </tr>
                                        <?php }?>
                                    <?php }?>
                                    </tbody>
                                    <tfoot>
                                    <tr id="listFooter">
                                    </tr>
                                    </tfoot>
                                </table>
                        </div>
                        <div class="list-b">

                            <div class="pages" style="float: right;">
                            <?php echo $page_html;?><span class="page"> 共<?php echo $total_num;?>条结果<!--，1/1页--></span>
                            </div>

                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="u-r-box">
            <div class="tui-tit">设计图推荐</div>
            <div id="pic_list_1" class="scroll_horizontal">
                <div class="box">
                    <ul class="list">
                        <?php foreach ($favorite_recommend as $fv):?>
                        <li>
                            <a href="<?=productURL($fv['pid']);?>" title="<?=$fv['pname'].', ￥'.fPrice($fv['sell_price'])?>" target="_blank">
                                <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($fv['pid'])?>default.jpg" width="130" height="156"/>
                            </a>

                            <p><a href="<?=productURL($fv['pid']);?>" title="<?=$fv['pname'].', '.fPrice($fv['sell_price'])?>" target="_blank"><?=mb_substr($fv['pname'], 0, 18, 'utf-8');?></a></p>
                            <span class="font2">市场价：￥<span class="font7"><?=fPrice($fv['market_price']);?></span></span><br/>
                            售价：<span class="font1">￥<?=fPrice($fv['sell_price']);?></span></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="plus"></div>
                <div class="minus"></div>
            </div>
        </div>

    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/product.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.scrollshow.js"></SCRIPT>
<!-- #EndLibraryItem -->
</body>
</html>
<script type="text/javascript">
    $(function () {
        $("#pic_list_1").scrollShow("right",{step:5, time:5000, num:5, boxHeight:220});
    });
</script>