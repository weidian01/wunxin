<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>产品问答 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/jcarousel.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <link href="<?=config_item('static_url')?>css/scrollshow.css" rel="stylesheet" type="text/css"/>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=config_item('static_url')?>">首页</a></li>
      <li><a href="<?=config_item('static_url')?>user/center/index">个人中心</a></li>
      <li class="last">产品问答</li>
    </ul>
  </div>
</div>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">产品问答</div>
        </div>
        <div class="u-r-box">
            <style> .o-list{font-weight: bold;color: #888888;} table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;} </style>
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
                        <td width="6%" height="26" align="center"><?=$v['qa_id'];?></td>
                        <td width="8%" align="center">
                            <a href="<?=productURL($v['pid'])?>" title="<?=$v['pname'];?>" target="_blank">
                                <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($v['pid'])?>icon.jpg" alt="" width="60" height="72"/>
                            </a>
                        </td>
                        <td width="20%" align="center"><a href="<?=productURL($v['pid'])?>" title="<?=$v['pname'];?>" target="_blank"><?=$v['pname'];?></a></td>
                        <td width="8%" align="center">￥<?=$v['sell_price'] / 100;?></td>
                        <td width="20%" align="left">
                            <b>问：</b><?=empty($v['content']) ? '' : $v['content'];?> <br />
							<?php if (!empty($v['reply_content'])) {?>
                            <b>答：</b><?=$v['reply_content'];?> <span style="font-size: 10px;"> <?=date('m-d H:i:s', strtotime($v['reply_time']));?></span>
							<?php } else {?>
							<b>答：</b>等待回答
							<?php }?>
                        </td>
                        <td width="15%" align="center">
                            <a href="#" title="共被回复 <?=$v['reply_num'];?> 条" style="color: #990000;font-size: 10px;">被回复 <?=$v['reply_num'];?> 条</a><br />

                            <a href="#" title="共有 <?=$v['is_valid'];?> 条有用" style="color: #990000;font-size: 10px;">有效 <?=$v['is_valid'];?> 条</a>&nbsp;|&nbsp;
                            <a href="#" title="共有 <?=$v['is_invalid'];?> 条有用" style="color: #990000;font-size: 10px;">无效 <?=$v['is_invalid'];?> 条</a>
                        </td>
                        <td width="8%" align="center"><?=date('Y-m-d', strtotime($v['create_time']));?></td>
                        <td width="10%" align="center">
                            <a href="<?=productURL($v['qa_id']);?>" onclick="(<?=$v['qa_id'];?>)" target="_blank">
                                <img src="<?=config_item('static_url')?>images/buy.gif" title="购买此产品">
                            </a>
                            <a href="javascript:void(0);" onclick="product.deleteProductQa(<?=$v['qa_id'];?>)">
                                <img src="<?=config_item('static_url')?>images/delete.gif" title="删除此问答">
                            </a>
                        </td>
                    </tr>
                    <?php }?>
                <?php }?>
            </table>
        </div>
        <div class="pages" style="float: right;">
        <?=$page_html;?>
        </div>

        <div class="u-r-box">
            <div class="tui-tit">热门产品推荐</div>
            <div id="pic_list_1" class="scroll_horizontal">
                <div class="box">
                    <ul class="list jcarousel-skin-ucenter" id="user_center_list">
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
                <!--
                <div class="plus"></div>
                <div class="minus"></div>
                -->
            </div>
        </div>
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<!-- #EndLibraryItem -->
</body>
</html>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/product.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.jcarousel.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/user_center_broadcast.js"></script>