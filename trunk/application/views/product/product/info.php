<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$product['pname']?> -- 万象网</title>
<link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css" />
<link href="<?=config_item('static_url')?>css/goods.css" rel="stylesheet" type="text/css" />
<link href="<?=config_item('static_url')?>css/jquery.jqzoom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery.jqzoom-core.js"> </script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery.lazyload.min.js"> </script>
<!--[if lt IE 7]>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
<script type="text/javascript">
//EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
</script>
<![endif]-->
</head>
<body>
<!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<!-- #EndLibraryItem -->
<div class="box">
  <div class="path">
    <ul>
      <li><a href="#">首页</a></li>

        <?php foreach($nav as $v):?>
            <li><a href="<?=config_item('static_url')?>category/<?=$v['class_id']?>"><?=$v['cname']?></a></li>
        <?php endforeach;?>
      <li class="last"><?=$product['pname']?></li>

    </ul>
  </div>
</div>
<div class="box3 pad4">
  <div class="goods-pic">
    <div class="small-pic">
      <div class="picqh" id="button_prev"></div>
      <div class="smallpic-b">
        <div class="spic">
          <div class="picsn" id="img_list">
            <?php $def_photo='';foreach($photo as $item):?>
            <?php if($item['is_default'] == 1){$def_photo = $item['img_addr'];}?>
            <div class="pic-rn">
                <a  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?=config_item('img_url')?>product/<?=intToPath($product['pid']).str_replace('.','_M.', $item['img_addr'])?>',largeimage: '<?=config_item('img_url')?>product/<?=intToPath($product['pid']).$item['img_addr']?>'}">
                    <img src="<?=config_item('img_url')?>product/<?=intToPath($product['pid']).str_replace('.','_S.', $item['img_addr'])?>" width="60" height="60" alt="<?=$product['pname']?>" /></a></div>
            <?php endforeach;?>
          </div>
        </div>
      </div>
      <div class="picqh2" id="button_next"></div>
    </div>
    <div class="big-pic">
        <a href="<?=config_item('img_url')?>product/<?=intToPath($product['pid']).$def_photo?>" rel='gal1' class="jqzoom" title="" >
        <img src="<?=config_item('static_url')?>images/lazy.gif" width="350" height="420"
             data-original="<?=config_item('img_url')?>product/<?=intToPath($product['pid']).str_replace('.','_M.', $def_photo)?>" class="lazy"/>
        </a>
    </div>
  </div>
  <div class="goods-i">
    <div class="goods-name">

      <h1><?=$product['pname']?> <img src="<?=config_item('static_url')?>images/lazy.gif" width="31" height="13" data-original="<?=config_item('static_url')?>images/buy_bg_10.gif" class="lazy"/></h1>
      <!--<span class="font3"><?=date('Y');?>新品 </span>--></div>
    <p><!--商品编号：CY0569852310000<br/>-->
      特&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价：<span class="font12">￥<?=fPrice($product['sell_price'])?></span><br/>
      原&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价：<span class="font7">￥<?=fPrice($product['market_price'])?></span>
    </p>

    <div class="pf">
      <div class="pftxt">商品评分：</div>
      <div class="pfstar">
          <span class="emptystar"></span>
          <span class="emptystar"></span>
          <span class="emptystar"></span>
          <span class="emptystar"></span>
          <span class="emptystar"></span>
        <div class="pfen">
            <span>0</span>分&nbsp;&nbsp;&nbsp;<a href="#anchorComment">（<span>0</span>条评论）</a>
        </div>
      </div>
    </div>
    <p>品&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牌：<?=$product['brand']['name']?></p>

    <p id="promotion_area">

      <!--
    <div style="" class="goodsAddArea">
        <div class="danpinColorTitle">
            <p>优惠信息：</p>
        </div>
        <div class="goodsAdd">
            <p class="cityAdd" onmouseover="onmouses(this, 1)" onmouseout="onmouses(this, 0)">
                <span class="goodsAdd"><span id="shippingAddr">查看</span><span id="citystatus">优惠信息</span></span><strong>&nbsp;</strong></p>
            <span id="stockinfo" class="fahuoDuanq">结算时选择相应活动</span>
            <div class="warnning" style="display: none;">
                <span style="height: 16px; display: block; width: 16px; background-position: -1911px 0pt; margin: 2px;float: left; " class="sprites"></span>
                <p>请在上方选择尺码后再查看库存</p>
            </div>
        </div>
        <div class="addressWindows" style="display: none;" onmouseover="onmouses(this, 1)" onmouseout="onmouses(this, 0)">
            <span class="blank10"></span>
                <p><span>华北地区：</span><a name="hs-110000" href="#">北京</a>、
                    <a name="hs-120000" href="#">天津</a>、
                    <a name="hs-130000" href="#">河北</a>、
                    <a name="hs-140000" href="#">山西</a>、
                    <a name="hs-150000" href="#">内蒙古</a>
                </p>
        </div>
    </div>
    -->

    </p>
      <br/>
        <script type="text/javascript">

        </script>

    <div class="size">
      <div class="goods-type">
        <div class="ctxt">颜&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;色：</div>
          <div class="sizebox">
              <?php foreach($alike as $item):?>
                  <?php if(isset($item['color']) && $item['color']):?>
                  <a class="sub-s" href="<?=config_item('static_url')?>product/<?=$item['pid']?>" <?php if($item['pid'] === $product['pid']) echo 'style="border:2px solid #ac1116"'?>>
                    <span class="selected" style="display:<?=($item['pid'] === $product['pid']) ? 'block':'none';?>">
                    <img src="<?=config_item('static_url')?>images/lazy.gif" width="10" height="10" data-original="<?=config_item('static_url')?>images/a07.jpg" class="lazy"/></span>
                        <?php if(true)://根据产品默认图片显示图片?>
                        <span class="coview">
                            <img src="<?=config_item('static_url')?>images/lazy.gif" width="35" height="35" data-original="<?=config_item('img_url')?>product/<?=intToPath($item['pid']).'icon.jpg'?>" class="lazy"/>
                        </span>
                        <?php else://根据产品颜色显示图片?>
                        <span class="coview" style="background:<?if ($item['color']['image']):?>url(<?=config_item('static_url')?>upload/color/<?=$item['color']['image']?>)<?php else:?><?=$item['color']['code']?><?php endif;?>"></span>
                        <?php endif;?>
                    <span class="cotxt"><?=$item['color']['china_name']?></span>
                  </a>
                  <?php endif;?>
              <?php endforeach;?>
          </div>
      </div>
      <div class="goods-type">
        <div class="ctxt">尺&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</div>
        <div class="sizebox">
            <?php $psize = sizeSort($psize);foreach($psize as $size):?>
            <a class="sub-cm" href="javascript:;" onclick="select_size(<?=$size['size_id']?>,'<?=strtoupper(trim($size['abbreviation']));?>',this)">
                <span class="selected2"></span><?=strtoupper(trim($size['abbreviation']));?></a>
            <?php endforeach;?>
        </div>
      </div>
      <div class="goods-type">
        <div class="ctxt">购买件数：</div>
        <div class="sizebox">
          <div class="buy-num"> <a class="minus" href="javascript:;" onclick="product_num('-')"></a> <a class="plus" href="javascript:;" onclick="product_num('+')"></a>
            <input id="product_num" name="buy_num" type="text" value="1" style="text-align: center;"/>
          </div>
        </div>
      </div>
      <div class="goods-type2">
        <div class="ctxt">已选择：</div>
        <div class="sizebox">
          <ul>
            <li><?=$alike[$product['pid']]['color']['china_name']?></li>
            <li id="product_size"></li>
          </ul>
        </div>
      </div>
      <div class="addcart">
          <a class="addcart-btn" href="javascript:;" onclick="addToCart();" id="add_to_cart"></a>
          <!--<a class="addcart-btn" href="javascript:;" onclick="wx.addToCartLayer(<?=$product['pid'];?>, '<?=$product['pname'];?>', 'add_to_cart');" id="add_to_cart"></a>-->
          <a class="sc-btn" href="javascript:;" onclick="product.favoriteProduct(<?=$product['pid']?>, 'but_favorite')" id="but_favorite"></a>

          <div class="share" style="float: right;">
              <!-- Baidu Button BEGIN -->

                  <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
                      <a class="bds_qzone"></a>
                      <a class="bds_tsina"></a>
                      <a class="bds_tqq"></a>
                      <a class="bds_renren"></a>
                      <span class="bds_more">更多</span>
              		<a class="shareCount"></a>
                  </div>
              <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6460583" ></script>
              <script type="text/javascript" id="bdshell_js"></script>
              <script type="text/javascript">
              	document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
              </script>

              <!-- Baidu Button END -->
              <!--
            <ul>
              <li><a class="douban" href="#"></a></li>
              <li><a class="renren" href="#"></a></li>
              <li><a class="kaixin" href="#"></a></li>
              <li><a class="qzone" href="#"></a></li>
              <li><a class="tencent" href="#"></a></li>
              <li><a class="twb" href="#"></a></li>
              <li><a class="sina" href="#"></a></li>
              <li style="width:48px;">分享到：</li>
            </ul>
        -->
          </div>
      </div>
    </div>
  </div>

</div>

<div class="box3">




    <!--
  <div class="designer">
    <div class="ginfo-title" style="border-bottom:0px;">
      <div class="dinfo-tle1" style="background-position:0px 0px;"><span onclick="showtab('dsnbox','1','4')" style="background-position:right -66px; color:#fff;">设计师介绍</span></div>
      <div class="dinfo-tle1"><span onclick="showtab('dsnbox','2','4');getDesignByUser(<?=$product['uid']?>)">设计师作品</span></div>
      <div class="dinfo-tle1"><span onclick="showtab('dsnbox','3','4');getProductByUser(<?=$product['uid']?>)">设计师产品</span></div>
    </div>
    <div class="d-box" id="dsnbox1">
      <div class="desbox">
        <div class="d-photo"><img src="<?=config_item('img_url')?>design/<?=intToPath($design['did'])?>/icon.jpg" width="149" height="179" alt="<?=$design['dname']?>"/></div>
        <div class="d-text">
          <div class="tit"><?=$design['dname']?></div>
          <p><?=$design['ddetail']?></p>
          <p><span class="font16">Show more&nbsp;</span>&nbsp;<img src="<?=config_item('static_url')?>images/smo_03.gif" width="10" height="7" /><br/>
            <span class="font17">&#8226;&nbsp;&nbsp;Copyright violation? Report design.</span><br />
            <span class="font17">&#8226;&nbsp;&nbsp;Copyright violation? Report design.</span><br />
          </p>
        </div>
      </div>
      <div class="desbox2">
        <div class="d-photo2"><img src="<?=config_item('img_url')?>designer/<?=intToPath($designer['uid'])?>/icon.jpg" width="90" height="90" alt="ddd" />
          <div class="d-p-name">Bud Spencer</div>
        </div>
        <div class="d-text2">
          <p><?=$designer['introduction']?></p>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="38%">Member since</td>
              <td width="62%"> Jul 19,2011</td>
            </tr>
            <tr>
              <td>Country</td>
              <td>Europe</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="d-box" id="dsnbox2" style="display:none;">
      <div class="viewhis"><!--设计师作品</div>
    </div>
    <div class="d-box" id="dsnbox3" style="display:none;">
      <div class="viewhis"><!--设计师产品</div>
    </div>
  </div>
    -->
    <br/>
  <div class="viewhistory pad11" style="display:none">
    <div class="tit"><span class="font18">同类产品推荐</span></div>
    <div class="viewhis" id="tlcptj"></div>
  </div>
</div>
<div class="box3">
  <div class="side-left">
    <div class="sidebox">
      <div class="side-tit2">销售排行榜</div>
      <div class="side-qh">
        <div class="side-m current" id="sidet1" onmouseover="rankbox('sidet','rank','1')">同类别</div>
        <div class="side-m" id="sidet2" onmouseover="rankbox('sidet','rank','2')">全部类别</div>
        <div class="side-m" id="sidet3" onmouseover="rankbox('sidet','rank','3')">同品牌</div>
      </div>
        <?php foreach($salesRank as $key => $rank):?>
        <div class="rankbox" id="rank<?=$key?>" <?php if($key !== 1):?>style="display:none;"<?php endif;?>>
          <ul class="bdan">
            <?php foreach($rank as $k => $item):?>
            <li<?php if($k == 0):?> class="on"<?php endif;?>>
              <div class="no1"><?=($k+1)?></div>
              <div class="bdimg"><a href="<?=productURL($item['pid'])?>" target="_blank" title="<?=$item['pname']?>">
                  <img src="<?=config_item('img_url')?>product/<?=intToPath($item['pid'])?>icon.jpg" width="50" height="50" /></a></div>
              <div class="bdancont"><a href="<?=productURL($item['pid'])?>" target="_blank" title="<?=$item['pname']?>"><?=$item['pname']?></a>
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
    <div class="sidebox" id="browseHistory" style="display:none">
      <div class="side-tit2">
        <div class="viewrecord">最近浏览</div>
        <div class="clearrecord" onclick="wx.clearBrowseHistory()">清除</div>
      </div>
    </div>
  </div>
  <!--left end-->
  <div class="goods-list">
    <div class="ginfo-title">
      <div class="ginfo-tle1" style="background-position:0px 0px;"><span onclick="showtab2('g-relation','1','7')" style="background-position:right -66px; color:#fff;">商品详情</span></div>
      <div class="ginfo-tle1"><span onclick="showtab2('g-relation','2','7')">商品评论</span></div>
      <div class="ginfo-tle1"><span onclick="showtab2('g-relation','3','7')">热门晒单</span></div>
      <div class="ginfo-tle1"><span onclick="showtab2('g-relation','4','7')">互动问答</span></div>
      <div class="ginfo-tle1"><span onclick="showtab2('g-relation','5','7')">售后服务</span></div>
      <div class="ginfo-tle1"><span onclick="showtab2('g-relation','6','7')">如何购买</span></div>
    </div>
    <div class="gbox-relation" id="g-relation1">
      <div class="goods-tp">
          <ul class="model_attr">
            <?php foreach($modelAttr as $attr):?>
              <li class="title"><?=$attr['attr_name']?>：</li>
              <li class="content"><?=$attr['attr_value']?></li>
              <?endforeach;?>
          </ul>
      </div>
        <div class="clear"></div>
      <div class="goods-detail">
        <!--div class="detail-tit">
          <div class="titles"></div>
        </div-->
        <div class="detail-tit">
          <div class="titles2">细节展示</div>
        </div>
        <div id="product_detail"><?=preg_replace('/img\s+src=/', 'img class="lazy" src="'.config_item('static_url').'images/lazy.gif" data-original=', $product['pcontent'])?></div>
      </div>
    </div>
    <div class="gbox-relation" id="g-relation2">
      <div class="shaidan" id="comment">
        <div class="sd-tit">
            <div class="sdbt">
                <a name="anchorComment">商品评论&nbsp;<span class="font17" id="totalCount">0</span> <span class="font15">条评论</span></a>
            </div>
            <div class="sd-btn">
                <a href="javascript:void(0);" onclick="product.productComment(<?=$product['pid']?>, 'i_need_comment')" id="i_need_comment">我要评论</a>
            </div>
          <div class="sd-yh">购买过该商品的用户才能评论&nbsp;&nbsp;</div>
        </div>
        <div class="comm-dex">
          <div class="cdex-b" id="product_rank">
            <div class="cdtit"><span class="cd-pf">商品评分：</span></div>
            <table class="tab7" width="95%" border="0" cellspacing="0" cellpadding="0">
            </table>
          </div>
          <div class="cdex-b" id="product_comfort">
            <div class="cdtit"><span class="cd-pf">舒适度：</span></div>
            <table class="tab7" width="95%" border="0" cellspacing="0" cellpadding="0">
            </table>
          </div>
          <div class="cdex-b" id="product_exterior">
            <div class="cdtit"><span class="cd-pf">外观：</span></div>
            <table class="tab7" width="95%" border="0" cellspacing="0" cellpadding="0">
            </table>
          </div>
        </div>
        <div class="chima">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="7%" height="30" align="center" class="font9">尺码：</td>
              <td width="31%"><strong><span class="font10" id="chima_z">0%</span></strong>的用户认为该商品的实际尺码 <span class="font10">[合适]</span></td>
              <td width="32%"><strong><span class="font10" id="chima_d">0%</span></strong>的用户认为该商品的实际尺码 <span class="font10">[偏大]</span></td>
              <td width="30%"><strong><span class="font10" id="chima_x">0%</span></strong>的用户认为该商品的实际尺码 <span class="font10">[偏小]</span></td>
            </tr>
          </table>
        </div>
        <div id="comments" class="comment" style="display:none;"><!--商品评论列表--></div>
      </div>
      <div style="float:right;" class="pages" id="commentsPage" style="display:none;"><!--商品评论分页--></div>
    </div>
    <div class="gbox-relation" id="g-relation3">
      <div class="shaidan" id="shaidan">
        <div class="sd-tit">
          <div class="sdbt"><span class="font18">晒单</span>&nbsp;&nbsp;&nbsp;&nbsp;共 <span class="font1" id="share_total">0</span> 单</div>
          <div class="sd-btn"><a href="javascript:void(0);" onclick="product.productShare(<?=$product['pid']?>, 'i_need_shares')" id="i_need_shares">我要晒单</a></div>
          <div class="sd-yh">优先来晒单，有机会获得意外奖励与大图展示哦！</div>
        </div>
        <span id="share_main"></span>
        <div class="sd-other" style="display:none"><!--晒单列表--></div>
        <div class="sd-page">
        <!--a class="chk" href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a  class="nextp" href="#">下一页</a-->
          <p class="moresd"><span class="font10">查看更多晒单 >></span></p>
        </div>
      </div>
    </div>
    <div class="gbox-relation" id="g-relation4">
      <div class="shaidan" id="qanda">
        <div class="sd-tit" style="margin-bottom:0px;">
          <div class="sdbt">互动问答</div>
          <div class="sd-btn"><a href="javascript:void(0);" onclick="product.addProductQa(<?=$product['pid']?>, 'i_need_question')" id="i_need_question">我要提问</a></div>
        </div>
        <div class="question">
          <div class="q-text">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><div class="q-t-1">
                    <p>万象网的商品全部来自于自有品牌、品牌公司与品牌公司下的授权经销商，品牌授权产品与线下实体店铺销售的商品是完全一致。</p>
                  </div></td>
                <td width="50%"><div class="q-t-2">
                    <p>全国范围人快递送货上门, 将为你提供优质的服务。</p>
                  </div></td>
              </tr>
            </table>
            <div class="q-t-w">更多关于万象网购物问题及配送方式问题，详情请 <a href="<?=config_item('static_url')?>other/help/index/22" target="_blank">点击这里 >></a></div>
          </div>
          <div class="q-a-box" id='_hdwd'><!--互动问答内容--></div>
          <div id="more_qa" style="float:center;display:none" class="pages"><!--更多--></div>
        </div>
      </div>
    </div>
    <div class="gbox-relation pad9" id="g-relation5" style="display:none;">
      <div class="shsever"> <img src="<?=config_item('static_url')?>images/lazy.gif" width="293" height="18" align="换货流程" data-original="<?=config_item('static_url')?>images/shouhou_03.gif" class="lazy"/><br><br>
        <div class="pad12"><img src="<?=config_item('static_url')?>images/lazy.gif" width="651" height="140" align="换货流程" data-original="<?=config_item('static_url')?>images/shouhou_07.gif" class="lazy"/></div>
        <img src="<?=config_item('static_url')?>images/lazy.gif" width="235" height="22" align="退货流程" data-original="<?=config_item('static_url')?>images/shouhou_11.gif" class="lazy"/><br>
        <br>
        <div class="pad12"><img src="<?=config_item('static_url')?>images/lazy.gif" width="652" height="120" align="退货流程" data-original="<?=config_item('static_url')?>images/shouhou_15.gif" class="lazy"/></div>
        <div class="tuihuantxt">
          <div class="tuihuan-tit">退换货承诺：</div>
          <p>自您签收货后7日内可以退换货，15天内可以换货，在商品不影响二次销售的情况下，万象网将为您办理退换货服务，请在 <a href="<?=config_item('static_url')?>">万象网</a> -
              <a href="<?=config_item('static_url')?>user/center/index" target="_blank">我的订单</a> "申请退换货"
            申请。注意：商品在非质量问题，运费将由您来承担！
          </p>
          <div class="tuihuan-tit">退换货方式：</div>
          <p>万象网针对于国内部分城市提供 “上门退换货” 服务，需要提供上门退换货嗠请联系客服中心; 若您所在地区不在上门退换货范围内，请通过快递方式将商品、内包装、赠品及发货单等物一并寄回。质量问题的退换货，运费将由万象网来承担，
              如非质量问题退换货将由您来承担，在退回请您先垫付运费寄回， 货物寄到时，万象网将货款与运费支付于您。</p>
          <div class="tuihuan-tit">退换货邮寄地址：</div>
          <p>北京市朝阳区半壁店25号&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;收件人：侯先生 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;邮编：100022<br/>
            客服热线：010-62962388&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;客服邮箱： <a class="sermail" href="mailto:servers@wunxin.com">hjpking@gmail.com </a><br/>
            如有疑问请联系我们，我们将为您竭诚服务！</p>
        </div>
      </div>
    </div>
    <div class="gbox-relation pad9" id="g-relation6" style="display:none;">
      <div class="payment">
          <!--
        <div class="payment-tit">
          <div class="paytit">支付方式<span class="font1"> <span class="font20">—</span> 货到付款</span></div>
        </div>
        <div class="pay-zw">配送人员送货上门，客户接单验货后直接支付配送人员货物金额的一种支付方式。<a class="payfont" href="#">点击查看货到付款支持范围</a></div>-->
        <div class="payment-tit">
          <div class="paytit">支付方式<span class="font1"> <span class="font20">—</span> 在线支付</span></div>
        </div>
        <div class="pay-zw"> 易宝在线支付、工行在线支付、招行在线支付、中国银行在线支付、支付宝在线支付6种在线支付方式，几乎涵盖所有大中型银行发卡的银行卡，覆盖率达98%，选择在线支付即时到账，准确快捷！
          <ul class="paypic">
            <li><span><img src="<?=config_item('static_url')?>images/lazy.gif" width="114" height="42" data-original="<?=config_item('static_url')?>images/paybg_11.jpg" class="lazy"/></span>易宝在线支付</li>
            <li><span><img src="<?=config_item('static_url')?>images/lazy.gif" width="98" height="48" data-original="<?=config_item('static_url')?>images/paybg_06.jpg" class="lazy"/></span> 支付宝在线支付</li>
            <li><span><img src="<?=config_item('static_url')?>images/lazy.gif" width="112" height="46" data-original="<?=config_item('static_url')?>images/paybg_08.jpg" class="lazy"/></span>工商银行在线支付</li>
            <li><span><img src="<?=config_item('static_url')?>images/lazy.gif" width="120" height="50" data-original="<?=config_item('static_url')?>images/paybg_03.jpg" class="lazy"/></span>一网通在线支付</li>
          </ul>
          温馨提示：在线支付付款等待期限为24小时。请您在订购后24小时内付款，否则我们将不会保留您的订单，感谢您对我们的支持，此规则最终解释权贵万象网所有，如有疑问请致电010-62962388，我们将竭诚为您服务！ </div>
        <div class="payment-tit">
          <div class="paytit">支付方式 <span class="font20">—</span> <span class="font1">邮局汇款</span></div>
        </div>
        <div class="pay-zw">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" height="100"><img src="<?=config_item('static_url')?>images/lazy.gif" width="90" height="86" data-original="<?=config_item('static_url')?>images/paybg_18.jpg" class="lazy"/></td>
              <td width="75%" valign="top"><span class="font21"><strong>邮局汇款：</strong>选择此方式支付货款的客户，请您在下单后尽快到邮局进行汇款。汇款完毕后，请务必进入订单信息填写页面填写并确认汇款信息<br/>
                <strong>温馨提示：</strong>在线支付付款等待期限为72小时。请您在订购后72小时内付款，否则我们将不会保留您的订单，感谢您对我们的支持，此规则最终解释权贵万象网所有，如有疑问请致电010-62962388，我们将竭诚为您服务！</span></td>
            </tr>
          </table>
        </div>
        <div class="payment-tit">
          <div class="paytit">支付方式 <span class="font20">—</span> <span class="font1">万象礼品卡或虚拟账户</span></div>
        </div>
        <div class="pay-zw">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" align="center"><img src="<?=config_item('static_url')?>images/lazy.gif" width="82" height="138" data-original="<?=config_item('static_url')?>images/paybg_21.jpg" class="lazy"/></td>
              <td width="75%" valign="middle"><span class="font21"><strong>礼品卡支付：</strong>在进入结算中心 - 提交订单页面，输入您的礼品卡及密码
                  (注意：礼品卡是需要先<a href="<?=config_item('static_url')?>user/center/bingCard" target="_blank">绑定卡</a>),点击验证进行支付订单，如您的礼品卡余额不足够支付订单，请使用其他方式支付。<br/>
                <br/>
                <strong>虚拟账户支付：</strong>是您在万象网的专属账户; 您在万象网购物多支付的部分或报销运费等金额都会存入你的虚拟账户中，你可以在万象网购物时使用。</span></td>
            </tr>
          </table>
        </div>
        <!--
        <div class="payment-tit">
          <div class="paytit">支付方式 <span class="font20">—</span> <span class="font1">电话支付</span></div>
        </div>
        <div class="pay-zw">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" align="center"><img src="<?=config_item('static_url')?>images/paybg_25.jpg" width="80" height="58" /></td>
              <td width="75%" valign="middle"><span class="font21"><strong>电话支付：</strong>选择此方式支付货款的客户，请您在下单后尽快到邮局进行汇款。汇款完毕后，请务必进入订单信息填写页面填写并确认汇款信息</span></td>
            </tr>
          </table>
        </div>
        <div class="payment-tit">
          <div class="paytit">支付方式 <span class="font20">—</span> <span class="font1">温馨提示</span></div>
        </div>
        <div class="pay-zw">如您对我们的帮助中心有疑问或建议，请拨打客服热线：400-899-5688，或发送邮件至 server@wanxiang.com。 </div>
      </div>-->
    </div>
  </div>
  <!--right end-->

</div>
</div>
  <br /><br />
  <div class="clear"></div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include APPPATH.'views/footer.php';?>
<!-- #EndLibraryItem -->
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/artdialog.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/common.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/product.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/user.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/product/info.js"></script>
<script>
product.class_id = <?=$product['class_id']?>;
product.pid = <?=$product['pid']?>;
product.pname = '<?=$product['pname']?>';
product.sell_price = <?=$product['sell_price'];?>/100;
loadPromotion(<?=$product['pid']?>);
</script>

</body>
</html>
