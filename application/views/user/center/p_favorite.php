<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的收藏夹 -- 个人中心</title>
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
    <link href="<?=config_item('static_url')?>css/scj.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/scrollshow.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=config_item('static_url')?>">首页</a></li>
      <li><a href="<?=config_item('static_url')?>user/center/index">个人中心</a></li>
      <li class="last">我的收藏夹</li>
    </ul>
  </div>
</div>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">我的收藏夹</div>
        </div>
        <div class="u-r-box">
            <div class="scj">
                <div class="main">
                    <div class="tab">
                        <a href="<?=config_item('static_url')?>user/center/productFavorite" class="act">收藏的产品</a>
                        <a href="<?=config_item('static_url')?>user/center/designerFavorite">收藏的设计师</a>
                        <a href="<?=config_item('static_url')?>user/center/designFavorite">收藏的设计图</a>
                    </div>
                    <div id="itemList">
                        <div class="list-m">
                            <form id="f1" method="post">
                                <table width="100%" class="table2">
                                    <thead>
                                    <tr>
                                        <th colspan="2" align="left"><b style="color: #8B8378;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;产品信息</b></th>
                                        <td align="center" style="text-align:center;"><b style="color: #8B8378;">收藏时间</b></td>
                                        <th align="center" style="text-align:center;"><b style="color: #8B8378;">人气</b></th>
                                        <th align="center" style="text-align:center;"><b style="color: #8B8378;">操作</b></th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody">
                                    <?php if (empty ($data)) { ?>
                                    <tr>
                                        <td colspan="5"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">暂时没有收藏产品，赶快去收藏自己喜欢的产品吧。</td>
                                    </tr>
                                    <?php } else {?>
                                        <?php foreach ($data as $v) {?>
                                        <tr>
                                            <td style="width:60px;">
                                                <div class="imgbox">
                                                    <a href="<?=productURL($v['pid'])?>" class="a_e" title="<?=$v['pname'];?>" target="_blank">
                                                        <img src="<?=config_item('img_url')?>product/<?=intToPath($v['pid'])?>icon.jpg" alt=""/>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="<?=productURL($v['pid'])?>" class="a_e" title="<?=$v['pname'];?>" target="_blank"><?=$v['pname'];?> &nbsp;&nbsp;
                                                    <span style="color: #CC0033;font-weight: bold;">￥<?=fPrice($v['sell_price']);?><span></a></a><br>
                                            </td>
                                            <td style="width:90px;text-align:center;"><?=date('Y-m-d', strtotime($v['create_time']));?></td>
                                            <td style="width:90px;text-align:center;">
                                                <a href="#" title="产品共被收藏 <?=$v['favorite_num'];?> 次" style="color: #990000;font-size: 10px;">共收藏 <?=$v['favorite_num'];?> 次</td>
                                            <td style="width:90px;text-align:center;">
                                                <a href="<?=productURL($v['pid'])?>" class="a_e" target="_blank">
                                                    <img src="<?=config_item('static_url')?>images/buy.gif" title="购买此产品">
                                                </a>
                                                <a href="<?=productURL($v['pid'])?>" class="a_e" target="_blank">
                                                    <img src="<?=config_item('static_url')?>images/view.gif" title="查看此产品">
                                                </a>

                                                <a href="javascript:void(0);" class="a_e" onclick="product.deleteFavoriteProduct(<?=$v['id'];?>)">
                                                    <img src="<?=config_item('static_url')?>images/delete.gif" title="删除收藏的此产品">
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    <?php }?>
                                    </tbody>
                                    <tfoot>
                                    <tr id="listFooter">
                                        <th colspan="6" align="right">
                                            <button type="button" class="btn_s1_z7" onclick="product.emptyFavorite()"> 清空所有产品 </button>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                        <div class="list-b">

                            <div class="pages" style="float: right;">
                            <?=$page_html;?><span class="page"> 共<?=$total_num;?>条结果<!--，1/1页--></span>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="u-r-box">
            <div class="tui-tit">产品收藏热度榜</div>
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
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/product.js"></SCRIPT>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.jcarousel.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/user_center_broadcast.js"></script>