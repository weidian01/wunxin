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
<?php include('/../../header.php');?>

<!-- #EndLibraryItem -->
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=site_url()?>">首页</a></li>
      <?php foreach($nav as $v):?>
        <?php if($category ==$v['class_id']):?>
            <li class="last"><?=$v['cname']?></a></li>
        <?php else:?>
            <li><a href="/category/<?=$v['class_id']?>"><?=$v['cname']?></a></li>
        <?php endif;?>
      <?php endforeach;?>
      <!--li class="last">T恤/卫衣</li-->
    </ul>
  </div>
</div>
<div class="box3">
  <div class="side-left">
    <div class="sidebox">
      <div class="side-tit"><?=$this->channel[$ancestor]['cname']?></div>
      <div class="menu">
        <ul>
            <?php unset($clan[$ancestor]);foreach($clan as $item):?>
            <li><?=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $item['floor']-1);?><a href="/category/<?=$item['class_id']?>"><?=$item['cname']?></a></li>
            <?php endforeach;?>
        </ul>
      </div>
    </div>

    <div class="sidebox">
      <div class="side-tit2">T恤销售排行榜</div>
      <div class="side-qh">
        <div class="side-m current" id="sidem1" onmouseover="rankbox('sidem','rank','1')">同类别</div>
        <div class="side-m" id="sidem2" onmouseover="rankbox('sidem','rank','2')">全部类别</div>
      </div>
      <?php foreach($salesRank as $key => $rank):?>
      <div class="rankbox" id="rank<?=$key?>" <?php if($key !== 1):?>style="display:none;"<?php endif;?>>
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
    <div class="adpic"><img src="<?=config_item('static_url')?>images/goods_03.jpg" width="198" height="233" alt="ffff" /></div>
    <div class="adpic"><img src="<?=config_item('static_url')?>images/goods_03.jpg" width="198" height="233" alt="ffff" /></div>
  </div>
  <!--left end-->
  <div class="goods-list">
    <?php if(! isset($this->channel[$category]['is_parent'])):?>
    <div id="modelAttr" class="select">
      <table class="tab3" width="100%" border="0" cellspacing="0" cellpadding="0">
        <?php if(isset($param) && $param):?>
        <tr>
          <td width="10%" align="right">您已选择：</td>
          <td width="90%">
            <?php foreach($param as $key=>$item):?>
              <?php $tmp=$param;unset($tmp[$key]);$str='';?>
              <?php foreach($tmp as $k=>$v):?>
                  <?php $str .= "!{$k}-{$v}";?>
              <?php endforeach;?>
              <div class="slect-item"><span><?=urldecode($item)?></span><a href="/category/<?echo $category,'/1/',$str?>" class="close"></a></div>
            <?php endforeach;?>
          </td>
        </tr>
        <?php endif;?>
        <?php foreach($modelAttr as $item):?>
          <tr>
            <td width="10%" align="right"><?=$item['attr_name']?>：</td>
            <td width="90%"><ul class="sitem">
                <?php foreach($item['attr_value'] as $tiem):?>
                    <?php $tmp=$param;unset($tmp[$item['attr_id']]);$str='';?>
                    <?php foreach($tmp as $k=>$v):?>
                        <?php $str .= "!{$k}-{$v}";?>
                    <?php endforeach;?>
                    <li><a href="/category/<?echo $category,'/1/!',$item['attr_id'],'-',$tiem,$str?>"><?=$tiem?></a></li>
                <?php endforeach;?>
              </ul></td>
          </tr>
        <?php endforeach;?>
      </table>
    </div>
    <div class="extend">
      <div class="kz" id="kza" onclick="more()"></div>
    </div>
    <?php endif;?>
    <div class="goodsbox">
      <?php foreach($products as $product):?>
      <div class="goods-cb">
        <div class="goods-cbox">
            <a href="<?=productURL($product['pid'])?>"><img class="lazy" src="<?=config_item('static_url')?>images/lazy.gif" data-original="<?=config_item('static_url')?>upload/product/<?=intToPath($product['pid'])?>default.jpg" width="164" height="220" alt="<?=$product['pname']?>" /></a>
            <p><?=$product['pname']?><br/>
            <span class="font4">售价 ￥<?=sprintf("%.2f",$product['sell_price']/100)?></span></p>
        </div>
      </div>
    <?php endforeach;?>
    </div>
    <?php if($pageHTML):?>
    <div class="pages">
        <?=$pageHTML?>
        共<?=$pageNUM?>页&nbsp;&nbsp;&nbsp;&nbsp;
        到第<input class="input6" name="input" type="text" /> 页 <input type="button" class="input7" value="确定" />
    </div>
    <?php endif;?>
  </div>
  <!--right end-->
</div>
<div id="viewhistory" style="display:none" class="box3 pad4">
  <div class="viewhistory">
    <div class="tit">最近浏览过的商品</div>
    <div class="viewhis"><!--最近浏览--></div>
  </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<!-- #EndLibraryItem -->
</body>
</html>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/function.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/common.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/product/category.js"></script>
