<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的购物车</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/shopping.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/jcarousel.css" rel="stylesheet" type="text/css"/>
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
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=config_item('static_url')?>">首页</a></li>
      <li class="last">我的购物车</li>
    </ul>
  </div>
</div>

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
          <img src="<?=config_item('static_url')?>images/loading.gif" alt="加载购物中......"><span>加载购物中......</span>
      </div>
  </div>
    <div class="shopping-cart" id="shopping_cart"><br>
        <h1 style="text-align: center;">您的购物车中没有商品，请您去
            <a href="javascript:void(0);" onclick="wx.goToBack()" style="color: #b5161c;">选购商品</a> 或
            <a style="color: #b5161c;"
                                                                                                href="javascript:void(0);"
                                                                                                onclick="cart.removeCart()">取出寄存的产品</a>&nbsp;&nbsp;»
        </h1><br><br><br><br></div>

  <div class="other-shopping">
    <div class="tit">购买以上商品的顾客还购买过</div>
        <div id="pic_list_1" class="scroll_horizontal">
            <div class="box">
                <ul class="list jcarousel-skin-cart" id="has_bought_list">
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
                        <img src="<?=config_item('static_url')?>images/add-cart.gif" width="81" height="21" alt="放入购物车" />
                    </a>
                    </li>
                  <?php endforeach;?>
                </ul>
            </div>
            <!--
            <div class="plus"></div>
            <div class="minus"></div>
            -->
        </div>
  </div>
  <div class="other-shopping">
    <div class="tit">看过以上商品的顾客还购买过</div>
      <div id="pic_list_2" class="scroll_horizontal">
          <div class="box">
              <ul class="list jcarousel-skin-cart" id="have_see_list">
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
                      <a href="<?=productURL($fv['pid']);?>" title="<?=$fv['pname']?>" target="_blank"> <img src="<?=config_item('static_url')?>images/add-cart.gif" width="81" height="21" alt="放入购物车" /> </a>
                  </li>
                  <?php endforeach;?>
              </ul>
          </div>
          <!--
          <div class="plus"></div>
          <div class="minus"></div>
          -->
      </div>
  </div>
  <div class="tips">您在购物过程中有任何疑问，请查阅 <a href="<?=config_item('static_url')?>other/help/index/16" target="_blank"><span class="font8">帮助中心</span></a> 或
      <a href="<?=config_item('static_url')?>other/help/index/27" target="_blank"><span class="font8">联系客服</span></a></div>
</div>
<!--<a href="javascript:cart.addToCart(4, 'S');">add to cart</a>-->
<?php include APPPATH.'views/footer.php';?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/user.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/cart.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/product.js"></script>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.jcarousel.js"></SCRIPT>

<script type="text/javascript">
    $(function () {
        cart.init();
        //$("#pic_list_1").scrollShow("right",{step:1, time:5500, num:6});
        //$("#pic_list_2").scrollShow("right",{step:1, time:5000, num:6});
        //$("#cart_top_free_prom_box").scrollShow("right",{step:1, time:50000, num:4, itemWidth:222, boxHeight:120, leftButtonClass:'#proprev', rightButtonClass:'#pronext', container:'.promotion-list', containerList:'.pro-con', listElement:'dl', containerIsSet: false});

        jQuery('#has_bought_list').jcarousel({auto:5, scroll:1});
        jQuery('#have_see_list').jcarousel({auto:4, scroll:1});
        //jQuery('#list_ul').jcarousel();

    });
</script>
</body>
</html>