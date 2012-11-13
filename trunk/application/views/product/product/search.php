<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title?> -- 万象网</title>
<link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css" />
<link href="<?=config_item('static_url')?>css/goods.css" rel="stylesheet" type="text/css" />
<script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery.lazyload.min.js"> </script>
<!--[if lt IE 7]>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
<script type="text/javascript">
EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
</script>
<![endif]-->
<script type="text/javascript">
$(document).ready(function(){
  $(".bankpic").click(function(){
    $(".bankpic").css("border","1px solid #eee");
	$(this).css("border","1px solid #a10000");
  });
});
</script>
</head>
<body>
<!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>

<!-- #EndLibraryItem -->
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=site_url()?>">首页</a></li>
      <li>搜索</li>
      <li class="last"><?=$keyword?></a></li>
      <!--li class="last">T恤/卫衣</li-->
    </ul>
  </div>
</div>
<div class="box3">
  <div class="side-left">
    <div class="sidebox">
      <div class="side-tit">全部分类</div>
      <div class="menu">
        <ul>
            <?php foreach($clan as $item):?>
            <li><?=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $item['floor']);?><a href="<?=config_item('static_url')?>category/<?=$item['class_id']?>"><?=$item['cname']?></a></li>
            <?php endforeach;?>
        </ul>
      </div>
    </div>

    <div class="sidebox">
      <div class="side-tit2">T恤销售排行榜</div>
      <div class="side-qh">
        <div class="side-m current" id="sidem2" onmouseover="rankbox('sidem','rank','2')">全部类别</div>
      </div>
      <?php foreach($salesRank as $key => $rank):?>
      <div class="rankbox" id="rank<?=$key?>" <?php if($key !== 2):?>style="display:none;"<?php endif;?>>
        <ul class="bdan">
          <?php foreach($rank as $k => $item):?>
          <li<?php if($k == 0):?> class="on"<?php endif;?>>
            <div class="no1"><?=($k+1)?></div>
            <div class="bdimg"><img  class="lazy" src="<?=config_item('static_url')?>images/lazy.gif" data-original="<?=config_item('img_url')?>product/<?=intToPath($item['pid'])?>icon.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="<?=productURL($item['pid'])?>"><?=$item['pname']?></a>
              <div class="bdprice"> <span class="font4">￥<?=fprice($item['sell_price'])?></span></div>
            </div>
          </li>
          <?php endforeach;?>
        </ul>
      </div>
      <?php endforeach;?>
    </div>

    <div class="sidebox">
      <div class="side-tit">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="68%">热评商品</td>
            <td width="32%"><span class="font15"><a href="#">更多热评</a></span></td>
          </tr>
        </table>
      </div>
      <div class="rankbox pad10" id="hotComment" style="display:none"><!--热评商品--></div>
    </div>
      <script type="text/javascript" src="<?=config_item('static_url')?>scripts/common.js"></script>
      <script type="text/javascript">wx.advert(5);//$(document).ready(function(){ wx.advert(5); });</script>
    <!--
    <div class="adpic"><img src="<?=config_item('static_url')?>images/goods_03.jpg" width="198" height="233" alt="ffff" /></div>
    <div class="adpic"><img src="<?=config_item('static_url')?>images/goods_03.jpg" width="198" height="233" alt="ffff" /></div>
    -->

      <div class="sidebox" id="browseHistory" style="display:none">
        <div class="side-tit2">
          <div class="viewrecord">最近浏览</div>
          <div class="clearrecord" onclick="wx.clearBrowseHistory()">清除</div>
        </div>
      </div>

  </div>
    <style>
        .goods-list .listHeader { background: url("<?=config_item('static_url')?>images/listbg_1.png") repeat-x scroll 0 -514px transparent; height: 31px; padding-left: 33px; }
        .goods-list .tab a.cur { background-color: #A2A2A2; border-top-color: #EAEAEA; color: #FFFFFF; }
        .goods-list .tab a { border-bottom: 1px solid #999999; float: left; font-size: 12px; height: 28px; line-height: 28px; text-align: center; width: 67px; }
        .goods-list .tab a { border-bottom: 1px solid #999999; border-top: 2px solid #ECEDEC;color: #343434; float: left; font-size: 12px; height: 28px; line-height: 28px; text-align: center; width: 67px; }
        .goods-list .addons { color: #666666; display: inline; float: right; font-family: Verdana, Geneva, sans-serif; line-height: 32px; margin: 0 10px 0 0; }
        .goods-list .addons span { margin-right: 10px; }
        .goods-list .addons a.disabled { color: #999999; }
        .goods-list .addons a { margin-right: 10px; }
        .goods-list .addons a:link, .goods-list .addons a:visited { color: #990000; }
        .goods-list .addons a { margin-right: 10px; }

    </style>
  <!--left end-->
  <div class="goods-list">

      <div id="listHeader" class="listHeader">
          <div class="tab">
              <a val="" class="ordby_default <?php if(!$sort):?>cur<?php endif;?>" href="<?=config_item('static_url')?>search?keyword=<?=$keyword?>">默认</a>
              <a val="pr" class="ordby_pr <?php if($sort=='price'):?>cur<?php endif;?>" href="<?=config_item('static_url')?>search?keyword=<?=$keyword?>&sort=price&by=<?php if($sort=='price' && $by !=='ASC'):?>ASC<?php endif;?>">价格</a>
              <a val="sale" class="ordby_sale <?php if($sort=='sales'):?>cur<?php endif;?>" href="<?=config_item('static_url')?>search?keyword=<?=$keyword?>&sort=sales&by=<?php if($sort=='sales' && $by !=='ASC'):?>ASC<?php endif;?>">销量</a>
              <a val="new" class="ordby_new <?php if($sort=='new'):?>cur<?php endif;?>" href="<?=config_item('static_url')?>search?keyword=<?=$keyword?>&sort=new&by=<?php if($sort=='new' && $by !=='ASC'):?>ASC<?php endif;?>">最新</a>
          </div>
          <div class="addons"><span>共找到约 <span class="font18"><?=$productCount?></span>个商品</span>
              <!--a class="disabled" href="javascript:void(0)">上一页</a> <a href="javascript:jumppage(2)">下一页</a-->
          </div>
      </div>

    <div class="goodsbox" id="goodsbox">
      <?php foreach($products as $product):?>
      <div class="goods-cb">
        <div class="goods-cbox">
            <a href="<?=productURL($product['pid'])?>" target="_blank"><img class="lazy" src="<?=config_item('static_url')?>images/lazy.gif" data-original="<?=config_item('static_url')?>upload/product/<?=intToPath($product['pid'])?>default.jpg" width="164" height="220" alt="<?=$product['pname']?>" /></a>
            <p><?=$product['pname']?><br/>
            <span class="font4">售价 ￥<?=fPrice($product['sell_price'])?></span></p>
        </div>
      </div>
      <?php endforeach;?>
    </div>
      <div class="loading" id="loading" style="display:none;text-align:center;vertical-align:middle;font-size:30px"><img src="<?=config_item('static_url')?>images/pac-man.gif">......</div>
      <div class="loading font10" id="nomoreresults" style="display:none;text-align:center;">没有更多.</div>
  </div>
  <!--right end-->
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<!-- #EndLibraryItem -->
</body>
</html>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/scrollpagination.js"></script>
<script>var global = {}; global.next_page = '/search?keyword=<?=$keyword?>';</script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/product/search.js"></script>
