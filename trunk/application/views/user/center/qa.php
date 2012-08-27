<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>产品问答 -- 个人中心</title>
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
            <div class="u-r-tit">产品问答</div>
        </div>
        <div class="u-r-box">
            <style> .o-list{font-weight: bold;color: #8B7B8B;} table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;} </style>
            <div class="o-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="6%" height="26" align="center">编号</td>
                        <td width="8%" align="center">产品图片</td>
                        <td width="20%" align="center">产品标题</td>
                        <td width="8%" align="center">产品价格</td>
                        <td width="20%" align="center">问答内容</td>
                        <td width="15%" align="center">人气</td>
                        <td width="8%" align="center">问答时间</td>
                        <td width="8%" align="center">操作</td>
                    </tr>
                </table>
            </div>
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">

                <?php if (empty ($data)) {?>
                <tr>
                    <td colspan="8"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">您暂时还没有产品问答。</td>
                </tr>
                <?php } else {?>
                    <?php foreach ($data as $v) {?>
                    <tr>
                        <td width="6%" height="26" align="center"><?php echo $v['qa_id'];?></td>
                        <td width="8%" align="center">
                            <a href="<?=productURL($v['pid'])?>" title="<?php echo $v['pname'];?>" target="_blank">
                                <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($v['pid'])?>icon.jpg" alt="" width="60" height="72"/>
                            </a>
                        </td>
                        <td width="20%" align="center"><a href="<?=productURL($v['pid'])?>" title="<?php echo $v['pname'];?>" target="_blank"><?php echo $v['pname'];?></a></td>
                        <td width="8%" align="center">￥<?php echo $v['sell_price'] / 100;?></td>
                        <td width="20%" align="left">
                            <b>问：</b><?php echo $v['content'];?> <br />
                            <b>答：</b><?php echo $v['reply_content'];?> <span style="font-size: 10px;"> <?php echo date('m-d H:i:s', strtotime($v['reply_time']));?></span>
                        </td>
                        <td width="15%" align="center">
                            <a href="#" title="共被回复 <?php echo $v['reply_num'];?> 条" style="color: #990000;font-size: 10px;">被回复 <?php echo $v['reply_num'];?> 条</a><br />

                            <a href="#" title="共有 <?php echo $v['is_valid'];?> 条有用" style="color: #990000;font-size: 10px;">有效 <?php echo $v['is_valid'];?> 条</a>&nbsp;|&nbsp;
                            <a href="#" title="共有 <?php echo $v['is_invalid'];?> 条有用" style="color: #990000;font-size: 10px;">无效 <?php echo $v['is_invalid'];?> 条</a>
                        </td>
                        <td width="8%" align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                        <td width="8%" align="center">
                            <a href="<?=productURL($v['qa_id']);?>" onclick="(<?=$v['qa_id'];?>)" target="_blank">
                                <img src="<?=config_item('static_url')?>images/buy.png" title="购买此产品">
                            </a><br />
                            <a href="javascript:void(0);" onclick="product.deleteProductQa(<?php echo $v['qa_id'];?>)">
                                <img src="<?=config_item('static_url')?>images/delete.png" title="删除此问答">
                            </a>
                        </td>
                    </tr>
                    <?php }?>
                <?php }?>
            </table>
        </div>
        <div class="pages" style="float: right;">
        <?php echo $page_html;?>
        </div>

        <div class="u-r-box">
            <div class="tui-tit">热门产品推荐</div>
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
<script type="text/javascript">
    $(function () {
        $("#pic_list_1").scrollShow("right",{step:5, time:5000, num:5, boxHeight:220});
    });
</script>
<!-- #EndLibraryItem -->
</body>
</html>

