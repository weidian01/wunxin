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
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="o-list">
                    <td width="8%" align="center"><b>晒单编号</b></td>
                    <td width="20%" align="center"><b>晒单图片</b></td>
                    <td width="20%" align="center"><b>晒单标题</b></td>
                    <td width="25%" align="center"><b>晒单内容</b></td>
                    <td width="15%" align="center"><b>人气</b></td>
                    <td width="10%" align="center"><b>晒单时间</b></td>
                    <!--<td width="17%" align="center">操作</td>-->
                </tr>
                <?php if (empty ($data)) $data = array();
                foreach ($data as $v) {?>
                <tr>
                    <td align="center"><!--<a href="#">--><?php echo $v['share_id'];?><!--</a>--></td>
                    <td>
                        <div class="goods-in">
                            <?php foreach ($v['share_images'] as $pv) {?>
                            <div class="g-i-img">
                                <a href="#" title="<?php echo $pv['descr'];?>">
                                    <img src="<?=config_item('static_url')?><?php echo $pv['img_addr'];?>" width="45" height="45"/>
                                </a>
                            </div>
                            <?php }?>
                            <!--<div class="scolls"><a href="#"></a></div> -->
                        </div>
                    </td>
                    <td align="center"><?php echo $v['title']; ?></td>
                    <td align="center"><?php echo $v['content'];?></td>
                    <td align="center"><a href="#" title="查看 <?php echo $v['comment_num'];?> 条晒单评论"> 查看评论 (<?php echo $v['comment_num'];?>)</a></td>
                    <td align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
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
        <!--
        <div class="u-r-box">
            <div class="tui-tit">为您推荐</div>
            <div class="tui">
                <div class="tuipre"><a href="#"></a></div>
                <div class="tuinext"><a href="#"></a></div>
                <ul>
                    <li><img src="<?=config_item('static_url')?>images/mlf_07.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                    <li><img src="<?=config_item('static_url')?>images/mlf_09.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                    <li><img src="<?=config_item('static_url')?>images/mlf_12.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                    <li><img src="<?=config_item('static_url')?>images/mlf_15.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                    <li><img src="<?=config_item('static_url')?>images/mlf_07.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                </ul>
            </div>
        </div>
        -->
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="/scripts/common.js"></SCRIPT>
<!-- #EndLibraryItem -->
</body>
</html>

