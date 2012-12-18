<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title?> -- 万象网</title>
<link href="<?=url('static')?>css/base.css" rel="stylesheet" type="text/css" />
<link href="<?=url('static')?>css/goods.css" rel="stylesheet" type="text/css" />
<script type=text/javascript src="<?=url('static')?>scripts/jquery.js"></script>
<script type="text/javascript" src="<?=url('static')?>scripts/jquery.lazyload.min.js"> </script>
<!--[if lt IE 7]>
<script type="text/javascript" src="<?=url('static')?>scripts/iepng.js"></script>
<script type="text/javascript">
//EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
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
      <li><a href="<?=url()?>">首页</a></li>
      <?php foreach($nav as $v):?>
        <?php if($category ==$v['class_id']):?>
            <li class="last"><?=$v['cname']?></a></li>
        <?php else:?>
            <li><a href="<?=empty($v['url'])?productFilterURL(array('category'=>$v['class_id'])):$v['url']?>"><?=$v['cname']?></a></li>
        <?php endif;?>
      <?php endforeach;?><?php if(empty($nav)) echo '<li class="last">全部分类</a></li>';?>
      <!--li class="last">T恤/卫衣</li-->
    </ul>
  </div>
</div>
<div class="box3">
  <div class="side-left">
    <div class="sidebox">
      <div class="side-tit"><?=isset($this->channel[$ancestor]['cname']) ? $this->channel[$ancestor]['cname']:'全部分类';?></div>
      <div class="menu">
        <ul>
            <?php unset($clan[$ancestor]);foreach($clan as $item):?>
            <li style="<?php if($item['floor'] == 0):?>clear: both;font-weight: bold;<?php else:?>float: left;<?php endif;?>"><?=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $item['floor']+1-1);?><a href="<?=empty($item['url'])?productFilterURL(array('category'=>$item['class_id'])):$item['url'];?>"><?=$item['cname']?></a></li>
            <?php endforeach;?>
            <li style="clear:both"></li>
        </ul>
      </div>
    </div>

    <div class="sidebox">
      <div class="side-tit2">销售排行榜</div>
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
            <div class="bdimg">
                <a href="<?=productURL($item['pid'])?>" target="_blank" title="<?=$item['pname']?>">
                <img src="<?=url('img')?>product/<?=intToPath($item['pid'])?>icon.jpg" width="50" height="50" title="<?=$item['pname']?>"/>
                </a>
            </div>
            <div class="bdancont"><a href="<?=productURL($item['pid'])?>" target="_blank" title="<?=$item['pname']?>"><?=mb_substr($item['pname'], 0, 16, 'utf-8')?></a>
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
      <script type="text/javascript" src="<?=url('static')?>scripts/common.js"></script>
      <script type="text/javascript">wx.advert(1);//$(document).ready(function(){ wx.advert(1); });</script>
      <!--
    <div class="adpic"><img src="<?=url('static')?>images/goods_03.jpg" width="198" height="233" alt="ffff" /></div>
    <div class="adpic"><img src="<?=url('static')?>images/goods_03.jpg" width="198" height="233" alt="ffff" /></div>
    -->
  </div>
  <!--left end-->

  <div class="goods-list">
    <?php if(isset($model_detail) && $model_detail && ! isset($this->channel[$category]['is_parent']) &&  $category > 0):?>
    <div id="modelAttr" class="select">
      <table class="tab3" width="100%" border="0" cellspacing="0" cellpadding="0">
        <?php foreach($model_detail as $item):?>
          <?php if($item['attrs'] && $item['search'] == 1):?>
          <tr <?php if($item['display']==0):?>class="attr_hidden"<?php endif;?>>
            <td width="10%" align="right"><?=$item['attr_name']?>：</td>
            <td width="90%"><ul class="sitem">
            <?php foreach($item['attrs'] as $value):?>
                <?php $key = array_search($value['value_id'], $param);if($key === false):$_view_tmp = $param;$_view_tmp[]=$value['value_id']?>
                <li><a href="<?=productFilterURL(array('category'=>$category,'page'=>1,'order'=>$order_param,'param'=>$_view_tmp));?>"><?=$value['value_name']?></a></li>
                <?php else:$_view_tmp = $param;unset($_view_tmp[$key]);?>
                    <li style="padding:0 0 0 0;"><div class="slect-item"><span><?=$value['value_name']?></span><a href="<?=productFilterURL(array('category'=>$category,'page'=>1,'order'=>$order_param, 'param'=>$_view_tmp));?>" class="close"></a></div></li>
                <?php endif;?>
                <?php endforeach;?>
            </ul></td>
          </tr>
          <?php endif;?>
        <?php endforeach;?>
      </table>
    </div>
    <div class="extend">
      <div class="kz" id="kza"><img src="<?=url('static')?>images/arrow_down.gif"><span>更多</span></div>
    </div>
    <div class="clear" style="height: 10px"></div>
    <?php endif;?>

      <div id="listHeader" class="listHeader">
          <div class="tab">
              <a <?php if($order_param['order']=='0'):?>class="ordby_default cur"<?php endif;?> name="orderby" href="<?=productFilterURL(array('category'=>$category,'page'=>1,'order'=>array('order'=>0, 'by'=>0), 'param'=>$param));?>">默认</a>
              <a <?php if($order_param['order']=='1'):?>class="ordby_default cur"<?php endif;?> name="orderby" class="ordby_pr" href="<?php $_view_order = array('order'=>1,'by'=>0);$_view_order['by'] = ($order_param['order']==1 && $order_param['by']==1)?0:1;echo productFilterURL(array('category'=>$category,'page'=>1,'order'=>$_view_order,'param'=>$param));?>">价格</a>
              <a <?php if($order_param['order']=='2'):?>class="ordby_default cur"<?php endif;?> name="orderby" class="ordby_sale " href="<?php $_view_order = array('order'=>2,'by'=>0); $_view_order['by'] = ($order_param['order']==2 && $order_param['by']==1)?0:1;echo productFilterURL(array('category'=>$category,'page'=>1,'order'=>$_view_order,'param'=>$param));?>">销量</a>
              <a <?php if($order_param['order']=='3'):?>class="ordby_default cur"<?php endif;?> name="orderby" class="ordby_new" href="<?php $_view_order = array('order'=>3,'by'=>0);$_view_order['by'] = ($order_param['order']==3 && $order_param['by']==1)?0:1;echo productFilterURL(array('category'=>$category,'page'=>1,'order'=>$_view_order,'param'=>$param));?>">最新</a>
          </div>
          <div class="addons"><span>共找到约 <span class="font19"><?=$productCount?></span>个商品</span>
              <?php if($pageno > 1):?><a class="disabled" href="<?=productFilterURL(array('category'=>$category,'page'=>$pageno-1,'order'=>$order_param, 'param'=>$param));?>">上一页</a><?php endif;?><?php if($pageno < $pageNUM):?> <a href="<?=productFilterURL(array('category'=>$category,'page'=>$pageno+1,'order'=>$order_param, 'param'=>$param));?>">下一页</a><?php endif;?>
          </div>
      </div>
    <div class="goodsbox">
      <?php foreach($products as $product):?>
      <div class="goods-cb">
        <div class="goods-cbox">
            <a href="<?=productURL($product['pid'])?>" target="_blank" title="<?=$product['pname']?>">
                <img class="lazy" src="<?=url('static')?>images/lazy.gif" data-original="<?=url('img')?>product/<?=intToPath($product['pid'])?>default.jpg" width="164" height="197" alt="<?=$product['pname']?>" />
            </a>
            <span class="font19">￥<?=fPrice($product['sell_price'])?></span>
            <p><a href="<?=productURL($product['pid'])?>" target="_blank" title="<?=$product['pname']?>"><?=$product['pname']?></a></p>
        </div>
      </div>
    <?php endforeach;?>
    </div>
    <?php if($pageHTML):?>
    <div class="pages">
        <?=$pageHTML?>
        共 <span class="font19"><?=$pageNUM?></span> 页&nbsp;&nbsp;&nbsp;&nbsp;
        <!--到第<input class="input6" name="input" type="text" /> 页 <input type="button" class="input7" value="确定" /> -->
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
<?php include(APPPATH."views/footer.php");?>
<!-- #EndLibraryItem -->
</body>
</html>
<script type="text/javascript" src="<?=url('static')?>scripts/product/category.js"></script>