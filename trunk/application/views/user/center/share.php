<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的晒单 -- 个人中心</title>
    <link href="/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="/scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="/scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
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
                <?php if (empty ($data)) $data = array();
                foreach ($data as $v) {?>
                <tr>
                    <td width="8%" align="center"><!--<a href="#">--><?php echo $v['share_id'];?><!--</a>--></td>
                    <td width="20%">
                        <div class="goods-in">
                            <?php foreach ($v['share_images'] as $pv) {?>
                            <div class="g-i-img">
                                <a href="#" title="<?php echo $pv['descr'];?>, 有 <?php echo $pv['is_like'];?> 人喜欢.">
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
            </table>
        </div>
        <div class="pages" style="float: right;">
        <?php echo $page_html;?>
        </div>
        <div class="u-r-box">
            <div class="tui-tit">热闹产品推荐</div>
            <div class="tui">
                <div class="tuipre"><a href="#"></a></div>
                <div class="tuinext"><a href="#"></a></div>
                <ul>
                    <?php foreach ($favorite_recommend as $fv) {?>
                    <li>
                        <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($fv['pid'])?>default.jpg" width="128" height="128"/>

                        <p><?php echo $fv['pname'];?></p>
                        <span class="font2">市场价：￥<span class="font7"><?php echo $fv['market_price'] / 100;?></span></span><br/>
                        售价：<span class="font1">￥<?php echo $fv['sell_price'] / 100;?></span></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="/scripts/common.js"></SCRIPT>
<!-- #EndLibraryItem -->
</body>
</html>
