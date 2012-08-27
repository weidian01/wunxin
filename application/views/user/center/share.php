<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的晒单 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <link href="<?=config_item('static_url')?>css/scrollshow.css" rel="stylesheet" type="text/css"/>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include('/../../header.php');?>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">我的晒单</div>
        </div>
        <div class="u-r-box">
            <style> .o-list{font-weight: bold;color: #8B7B8B;} table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;} </style>
            <div class="o-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8%" align="center"><b>晒单编号</b></td>
                        <td width="10%" align="center"><b>晒单产品</b></td>
                        <td width="20%" align="center"><b>晒单图片</b></td>
                        <td width="20%" align="center"><b>晒单标题</b></td>
                        <td width="25%" align="center"><b>晒单内容</b></td>
                        <td width="15%" align="center"><b>人气</b></td>
                        <td width="10%" align="center"><b>晒单时间</b></td>
                        <!--<td width="17%" align="center">操作</td>-->
                    </tr>
                </table>
            </div>
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php if (empty ($data)) {?>
                <td colspan="6" style="text-align: center;font-weight: bold;color: #A10000;" height="50">暂时没有晒单产品，赶快去购买并晒单与朋友分享吧。</td>
                <?php } else {?>
                <?php foreach ($data as $v) {?>
                <tr>
                    <td width="8%" align="center"><!--<a href="#">--><?php echo $v['share_id'];?><!--</a>--></td>
                    <td width="8%" align="center"><a href="<?=productURL($v['pid']);?>" target="_blank">
                        <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($v['pid']);?>icon.jpg" alt="" width="50" height="50"/>
                        </a></td>
                    <td width="20%">
                        <div class="goods-in">
                            <?php foreach ($v['share_images'] as $pv) {?>
                            <div class="g-i-img">
                                <a href="#" title="<?php echo $pv['descr'];?>, 有 <?php echo empty ($pv['is_like']) ? 0 : $pv['is_like'];?> 人喜欢.">
                                    <img src="<?=config_item('static_url')?><?php echo $pv['img_addr'];?>" width="45" height="45"/>
                                </a>
                            </div>
                            <?php }?>
                            <!--<div class="scolls"><a href="#"></a></div> -->
                        </div>
                    </td>
                    <td width="20%" align="center"><?php echo $v['title']; ?></td>
                    <td width="25%" align="center"><?php echo $v['content'];?></td>
                    <td width="18%" align="center">
                        <a href="#" title="查看 <?php echo $v['comment_num'];?> 条晒单评论" style="color: #990000;font-size: 10px;"> 查看评论 (<?php echo $v['comment_num'];?>)</a>
                    </td>
                    <td width="10%" align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                    <!--
                    <td width="17%" align="center">
                        <a href="">修改</a>
                        <a href="">删除</a>
                    </td>
                    -->
                </tr>
                <?php }?>
                <?php }?>
            </table>
        </div>
        <div class="pages" style="float: right;">
        <?php echo $page_html;?>
        </div>
        <div class="u-r-box">
            <div class="tui-tit">热闹产品推荐</div>
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
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.scrollshow.js"></SCRIPT>
<!-- #EndLibraryItem -->
</body>
</html>
<script type="text/javascript">
    $(function () {
        $("#pic_list_1").scrollShow("right",{step:5, time:5000, num:5, boxHeight:220});
    });
</script>

