<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的购物车</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/shopping.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/artdialog.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <link href="<?=config_item('static_url')?>css/scrollshow.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php include APPPATH.'views/header.php';?>
<div class="box pad4">
  <div class="process">
    <ul>
      <li class="curr">我的购物车</li>
      <li>填写订单核对信息</li>
      <li class="last">成功提交订单</li>
    </ul>
  </div>
  <h1 class="shoppingitem">购物车</h1>
  <div class="shopping-cart" id="shopping_cart">
      <div style="text-align: center;">
          <img src="/images/loading.gif" alt="加载购物中......"><span>加载购物中......</span>
      </div>
      <!--
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="shopping_cart_item" style="display: none;">
      <tr>
        <td colspan="2" align="center" class="tit">商品/商品号</td>
        <td width="9%" align="center" class="tit">单价</td>
        <td width="13%" align="center" class="tit">数量</td>
        <td width="10%" align="center" class="tit">花费积分</td>
        <td width="12%" align="center" class="tit">小计</td>
      </tr>
      <tr>
        <td width="7%"><img src="/images/pic_07.jpg" width="52" height="66" /></td>
        <td width="49%"><a class="gn" href="#">Bessie OL气质荷叶边条纹短裙 <img src="/images/buy_bg_10.gif" width="31" height="13" /></a><br/>
          <span class="font2">GZ26052909-S</span><br/>
          <a href="#">收藏</a>&nbsp;&nbsp;&nbsp;<a href="#">删除</a></td>
        <td align="center">39.00</td>
        <td align="center"><input name="textfield" type="text" class="gnum" id="textfield" value="1" />
          &nbsp;<a href="#"><img src="/images/plus.gif" width="11" height="11" /></a></td>
        <td align="center"><span class="font2">—</span></td>
        <td align="center"><span class="font6">39.00</span></td>
      </tr>
      <tr>
        <td><img src="/images/pic_10.jpg" width="52" height="67" /></td>
        <td><a class="gn" href="#">Bessie OL气质荷叶边条纹短裙 <img src="/images/buy_bg_10.gif" width="31" height="13" /></a><br/>
          <span class="font2">GZ26052909-S</span><br/>
          <a href="#">收藏</a>&nbsp;&nbsp;&nbsp;<a href="#">删除</a></td>
        <td align="center">129.00</td>
        <td align="center"><input name="textfield2" type="text" class="gnum" id="textfield2" value="1" />
          &nbsp;<a href="#"><img src="/images/plus.gif" alt="" width="11" height="11" /></a></td>
        <td align="center"><span class="font2">—</span></td>
        <td align="center"><span class="font6">129.00</span></td>
      </tr>
      <tr>
        <td><img src="/images/pic_13.jpg" alt="" width="53" height="69" /></td>
        <td><a class="gn" href="#">Bessie OL气质荷叶边条纹短裙 <img src="/images/buy_bg_10.gif" width="31" height="13" /></a><br/>
          <span class="font2">GZ26052909-S</span><br/>
          <a href="#">收藏</a>&nbsp;&nbsp;&nbsp;<a href="#">删除</a></td>
        <td align="center">256.00</td>
        <td align="center"><input name="textfield3" type="text" class="gnum" id="textfield3" value="1" />
          &nbsp;<a href="#"><img src="/images/plus.gif" alt="" width="11" height="11" /></a></td>
        <td align="center"><span class="font2">—</span></td>
        <td align="center"><span class="font6">256.00</span></td>
      </tr>
      <tr>
        <td style="border-bottom:1px solid #a5afc3;">&nbsp;</td>
        <td colspan="5" style="border-bottom:1px solid #a5afc3;"><div class="gsum">产品数量总计：<span class="font1">3</span>&nbsp;&nbsp;&nbsp;&nbsp;赠送积分总计：<span class="font1">147</span>&nbsp;&nbsp;&nbsp;&nbsp;花费积分总计：<span class="font1">0</span>&nbsp;&nbsp;&nbsp;&nbsp;商品金额总计：<span class="font1">422.00</span></div></td>
      </tr>
      <tr>
        <td colspan="7"><div class="empty"><a href="#">清空购物车</a></div>
          <div class="post-btn"><a href="#"><img src="/images/buy_bg_14.gif" alt="继续购物" width="115" height="32" /></a>&nbsp;&nbsp;<a href="#"><img src="/images/buy_bg_16.gif" width="126" height="32" alt="去结算" /></a></div></td>
      </tr>
    </table>
    -->
  </div>
  <div class="other-shopping">
    <div class="tit">购买以上商品的顾客还购买过</div>
        <div id="pic_list_1" class="scroll_horizontal">
            <div class="box">
                <ul class="list">
                    <?php foreach ($sales as $sv):?>
                  <li class="rq">
                    <div class="rqimg">
                        <a href="<?=productURL($sv['pid']);?>" title="<?=$sv['pname']?>" target="_blank">
                            <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($sv['pid'])?>default.jpg" width="130" height="156" />
                        </a>
                    </div>
                    <p><a href="<?=productURL($sv['pid']);?>" title="<?=$sv['pname']?>" target="_blank"><?=mb_substr($sv['pname'], 0, 18, 'utf-8')?></a><br/>
                      原价：￥<span class="font7"><?=fPrice($sv['market_price'])?></span><br/>
                      <span class="font6">特惠价：￥<?=fPrice($sv['sell_price'])?></span></p>
                    <a href="<?=productURL($sv['pid']);?>" title="<?=$sv['pname']?>" target="_blank">
                        <img src="/images/add-cart.gif" width="81" height="21" alt="放入购物车" />
                    </a>
                    </li>
                  <?php endforeach;?>
                </ul>
            </div>
            <div class="plus"></div>
            <div class="minus"></div>
        </div>
  </div>
  <div class="other-shopping">
    <div class="tit">看过以上商品的顾客还购买过</div>
      <div id="pic_list_2" class="scroll_horizontal">
          <div class="box">
              <ul class="list">
                  <?php foreach ($favorite as $fv):?>
                  <li class="rq">
                    <div class="rqimg">
                        <a href="<?=productURL($fv['pid']);?>" title="<?=$fv['pname']?>" target="_blank">
                            <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($fv['pid'])?>default.jpg" width="130" height="156" />
                        </a>
                    </div>
                    <p><a href="<?=productURL($fv['pid']);?>" title="<?=$fv['pname']?>" target="_blank"><?=mb_substr($fv['pname'], 0, 18, 'utf-8')?></a><br/>
                      原价：￥<span class="font7"><?=fPrice($fv['market_price'])?></span><br/>
                      <span class="font6">特惠价：￥<?=fPrice($fv['sell_price'])?></span></p>
                      <a href="<?=productURL($fv['pid']);?>" title="<?=$fv['pname']?>" target="_blank"> <img src="/images/add-cart.gif" width="81" height="21" alt="放入购物车" /> </a>
                  </li>
                  <?php endforeach;?>
              </ul>
          </div>
          <div class="plus"></div>
          <div class="minus"></div>
      </div>
  </div>
  <div class="tips">您在购物过程中有任何疑问，请查阅 <a href="/other/help/index/16" target="_blank"><span class="font8">帮助中心</span></a> 或
      <a href="/other/help/index/27" target="_blank"><span class="font8">联系客服</span></a></div>
</div>
<!--<a href="javascript:cart.addToCart(4, 'S');">add to cart</a>-->
<?php include APPPATH.'views/footer.php';?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/user.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/cart.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/product.js"></script>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.scrollshow.js"></SCRIPT>
<script type="text/javascript">
    $(function () {
        cart.init();
        $("#pic_list_1").scrollShow("right",{step:6, time:5000, num:6});
        $("#pic_list_2").scrollShow("right",{step:6, time:5000, num:6});
    });
</script>
</body>
</html>