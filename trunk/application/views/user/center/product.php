<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的产品 -- 个人中心</title>
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
      <li class="last">我的产品</li>
    </ul>
  </div>
</div>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">我的产品</div>
        </div>

        <div class="u-r-box">
            <style> .o-list{font-weight: bold;color: #888888;} table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;} </style>
            <div class="o-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8%" height="26" align="center">编号</td>
                        <td width="8%" align="center">图片</td>
                        <td width="25%" align="center">产品名称</td>
                        <td width="8%" align="center">价格</td>
                        <td width="8%" align="center">销量</td>
                        <td width="8%" align="center">状态</td>
                        <td width="10%" align="center">人气</td>
                        <td width="8%" align="center">添加时间</td>
                        <td width="10%" align="center">操作</td>
                    </tr>
                </table>
            </div>

            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php if (empty ($data)) {?>
                    <tr>
                        <td colspan="9"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">暂时没有产品，赶快创建属于自己的产品吧。</td>
                    </tr>
                <?php } else {?>
                    <?php foreach ($data as $v) {?>
                    <tr>
                        <td width="8%" height="26" align="center"><?=$v['pid'];?></td>
                        <td width="8%" align="center">
                            <a href="<?=productURL($v['pid'])?>" title="<?=$v['pname']?>" target="_blank">
                                <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($v['pid'])?>default.jpg" alt="" width="60" height="72"/>
                            </a>
                        </td>
                        <td width="25%" align="center"><a href="<?=productURL($v['pid'])?>" title="<?=$v['pname'];?>" target="_blank"><?=$v['pname'];?></a></td>
                        <td width="8%" align="center">￥<?=fPrice($v['sell_price']);?></td>
                        <td width="8%" align="center"><?=$v['sales'];?></td>
                        <td width="8%" align="center">
                            <a href="#" title="产品<?=$v['shelves'] == '1' ? '上架' : '已下架';?>"><?=$v['shelves'] == '1' ? '上架' : '已下架';?></a><br/>
                            <a href="#" title="产品审核<?=$v['check_status'] == '1' ? '通过' : '未通过';?>"><?=$v['check_status'] == '1' ? '通过' : '未通过';?></a>
                        </td>
                        <td width="10%" align="center">
                            <a href="#" title="共被评论 <?=$v['comment_num'];?> 次" style="color: #990000;font-size: 10px;">评论 <?=$v['comment_num'];?> 条</a><br/>
                            <a href="#" title="共被收藏 <?=$v['favorite_num'];?> 次" style="color: #990000;font-size: 10px;">收藏 <?=$v['favorite_num'];?> 次</a>
                        </td>
                        <td width="8%" align="center"><?=date('Y-m-d', strtotime($v['create_time']));?></td>
                        <td width="10%" align="center">
                            <!--<a href="javascript:void(0);" onclick="(<?=$v['pid'];?>)">修改</a>
                            <br/>-->
                            <a href="javascript:void(0);" onclick="deleteProduct(<?=$v['pid'];?>)">
                                <img src="<?=config_item('static_url')?>images/delete.png" title="删除此产品">
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
            <div class="tui-tit">产品推荐</div>
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
<script type="text/javascript">
    function deleteProduct(pId)
    {
        if (confirm('确定删除！')) {
            if (!wx.isEmpty(pId)) {
                return false;
            }

            var url = '/product/product/deleteProduct';
            var param = 'pid='+pId;
            var data = wx.ajax(url, param);

            if (data.error == '0') {
                wx.pageReload(0);
                return true;
            }

            alert('删除失败!');
        }
    }
</script>
<!-- #EndLibraryItem -->
</body>
</html>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.jcarousel.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/user_center_broadcast.js"></script>