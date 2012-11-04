<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?=config_item('static_url')?>style/base.css" rel="stylesheet" type="text/css" />
<link href="<?=config_item('static_url')?>style/goods.css" rel="stylesheet" type="text/css" />
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>js/comm.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>js/jquery.js"></SCRIPT>
<!--[if lt IE 7]>
<script type="text/javascript" src="<?=config_item('static_url')?>js/iepng.js"></script>
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
<?php include '/../header.php';?>
<div class="box">
  <div class="path">
    <ul>
      <li>首页</li>
      <li>女装</li>
      <li class="last">T恤/卫衣</li>
    </ul>
  </div>
</div>
<div class="box3">
  <div class="side-left">
    <div class="sidebox">
      <div class="side-tit">女装</div>
      <div class="menu">
        <ul>
          <li><a href="#">T恤/卫衣(150)</a></li>
          <li><a href="#">针织衫(50)</a></li>
          <li><a href="#">雪纺衫(50)</a></li>
          <li><a href="#">连衣裙(126)</a></li>
          <li><a href="#">连衣裙(126)</a></li>
          <li><a href="#">连衣裙(126)</a></li>
          <li><a href="#">针织衫(50)</a></li>
          <li><a href="#">雪纺衫(50)</a></li>
          <li><a href="#">连衣裙(126)</a></li>
          <li><a href="#">连衣裙(126)</a></li>
          <li><a href="#">连衣裙(126)</a></li>
          <li><a href="#">针织衫(50)</a></li>
          <li><a href="#">雪纺衫(50)</a></li>
          <li><a href="#">连衣裙(126)</a></li>
          <li><a href="#">连衣裙(126)</a></li>
        </ul>
      </div>
    </div>
    <div class="sidebox">
      <div class="side-tit2">T恤销售排行榜</div>
      <div class="side-qh">
        <div class="side-m current" id="sidem1" onmouseover="rankbox('sidem','rank','1')">同类别</div>
        <div class="side-m" id="sidem2" onmouseover="rankbox('sidem','rank','2')">同品牌</div>
        <div class="side-m" id="sidem3" onmouseover="rankbox('sidem','rank','3')">同价位</div>
      </div>
      <div class="rankbox" id="rank1">
        <div class="bdan">
          <div class="no1">1</div>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
          <div class="bdancont">亿品印花宽松T恤7500 灰色M<br/>
            <span class="font4">￥35.00</span></div>
        </div>
        <div class="bdan"><span class="font1">2&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
        <div class="bdan"><span class="font1">3&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
        <div class="bdan"><span class="font1">4&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
        <div class="bdan"><span class="font1">5&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
        <div class="bdan"><span class="font1">6&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
        <div class="bdan"><span class="font1">7&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
        <div class="bdan"><span class="font1">8&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
      </div>
      <div class="rankbox" id="rank2" style="display:none;">
        <div class="bdan">
          <div class="no1">1</div>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pic7.jpg" width="53" height="54" /></div>
          <div class="bdancont">亿品印花宽松T恤7500 灰色M<br/>
            <span class="font4">￥35.00</span></div>
        </div>
        <div class="bdan"><span class="font1">2&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
        <div class="bdan"><span class="font1">3&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
        <div class="bdan"><span class="font1">4&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
        <div class="bdan"><span class="font1">5&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
        <div class="bdan"><span class="font1">6&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
        <div class="bdan"><span class="font1">7&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
        <div class="bdan"><span class="font1">8&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
      </div>
      <div class="rankbox" id="rank3" style="display:none;">
        <div class="bdan">
          <div class="no1">1</div>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pick.jpg" width="53" height="54" /></div>
          <div class="bdancont">亿品印花宽松T恤7500 灰色M<br/>
            <span class="font4">￥35.00</span></div>
        </div>
        <div class="bdan"><span class="font1">2&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
        <div class="bdan"><span class="font1">3&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
        <div class="bdan"><span class="font1">4&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
        <div class="bdan"><span class="font1">5&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
        <div class="bdan"><span class="font1">6&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
        <div class="bdan"><span class="font1">7&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
        <div class="bdan"><span class="font1">8&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
      </div>
    </div>
    <div class="sidebox">
      <div class="side-tit2">T恤销售排行榜</div>
      <div class="side-qh">
        <div class="side-m current" id="sidet1" onmouseover="rankbox('sidet','rankt','1')">同类别</div>
        <div class="side-m" id="sidet2" onmouseover="rankbox('sidet','rankt','2')">同品牌</div>
        <div class="side-m" id="sidet3" onmouseover="rankbox('sidet','rankt','3')">同价位</div>
      </div>
      <div class="rankbox" id="rankt1">
        <div class="bdan">
          <div class="no1">1</div>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
          <div class="bdancont">亿品印花宽松T恤7500 灰色M<br/>
            <span class="font4">￥35.00</span></div>
        </div>
        <div class="bdan"><span class="font1">2&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
        <div class="bdan"><span class="font1">3&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
        <div class="bdan"><span class="font1">4&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
        <div class="bdan"><span class="font1">5&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
        <div class="bdan"><span class="font1">6&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
        <div class="bdan"><span class="font1">7&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
        <div class="bdan"><span class="font1">8&nbsp;&nbsp;</span>亿品印花宽松T恤7500 灰色M</div>
      </div>
      <div class="rankbox" id="rankt2" style="display:none;">
        <div class="bdan">
          <div class="no1">1</div>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pic7.jpg" width="53" height="54" /></div>
          <div class="bdancont">亿品印花宽松T恤7500 灰色M<br/>
            <span class="font4">￥35.00</span></div>
        </div>
        <div class="bdan"><span class="font1">2&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
        <div class="bdan"><span class="font1">3&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
        <div class="bdan"><span class="font1">4&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
        <div class="bdan"><span class="font1">5&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
        <div class="bdan"><span class="font1">6&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
        <div class="bdan"><span class="font1">7&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
        <div class="bdan"><span class="font1">8&nbsp;&nbsp;</span>思源粉色宽松T恤cty00 M</div>
      </div>
      <div class="rankbox" id="rankt3" style="display:none;">
        <div class="bdan">
          <div class="no1">1</div>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pick.jpg" width="53" height="54" /></div>
          <div class="bdancont">亿品印花宽松T恤7500 灰色M<br/>
            <span class="font4">￥35.00</span></div>
        </div>
        <div class="bdan"><span class="font1">2&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
        <div class="bdan"><span class="font1">3&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
        <div class="bdan"><span class="font1">4&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
        <div class="bdan"><span class="font1">5&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
        <div class="bdan"><span class="font1">6&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
        <div class="bdan"><span class="font1">7&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
        <div class="bdan"><span class="font1">8&nbsp;&nbsp;</span>粉色娃娃装连衣裙gtuy00M</div>
      </div>
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
      <div class="rankbox pad10">
        <div class="bdan2">
          <table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>热卖简略印花T恤</td>
              <td><span class="font4">￥152.30</span></td>
            </tr>
          </table>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pick.jpg" width="53" height="54" /></div>
          <div class="bdancont2"><span class="font2">***826542</span>(会员)<br/>
            衣衣对于我来说真的偏长，但是款式还不错</div>
        </div>
        <div class="bdan2">
          <table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>热卖简略印花T恤</td>
              <td><span class="font4">￥152.30</span></td>
            </tr>
          </table>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pick.jpg" width="53" height="54" /></div>
          <div class="bdancont2"><span class="font2">***826542</span>(会员)<br/>
            衣衣对于我来说真的偏长，但是款式还不错</div>
        </div>
        <div class="bdan2">
          <table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>热卖简略印花T恤</td>
              <td><span class="font4">￥152.30</span></td>
            </tr>
          </table>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pick.jpg" width="53" height="54" /></div>
          <div class="bdancont2"><span class="font2">***826542</span>(会员)<br/>
            衣衣对于我来说真的偏长，但是款式还不错</div>
        </div>
        <div class="bdan2">
          <table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>热卖简略印花T恤</td>
              <td><span class="font4">￥152.30</span></td>
            </tr>
          </table>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pick.jpg" width="53" height="54" /></div>
          <div class="bdancont2"><span class="font2">***826542</span>(会员)<br/>
            衣衣对于我来说真的偏长，但是款式还不错</div>
        </div>
        <div class="bdan2">
          <table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>热卖简略印花T恤</td>
              <td><span class="font4">￥152.30</span></td>
            </tr>
          </table>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pick.jpg" width="53" height="54" /></div>
          <div class="bdancont2"><span class="font2">***826542</span>(会员)<br/>
            衣衣对于我来说真的偏长，但是款式还不错</div>
        </div>
        <div class="bdan2">
          <table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>热卖简略印花T恤</td>
              <td><span class="font4">￥152.30</span></td>
            </tr>
          </table>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pick.jpg" width="53" height="54" /></div>
          <div class="bdancont2"><span class="font2">***826542</span>(会员)<br/>
            衣衣对于我来说真的偏长，但是款式还不错</div>
        </div>
        <div class="bdan2">
          <table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>热卖简略印花T恤</td>
              <td><span class="font4">￥152.30</span></td>
            </tr>
          </table>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pick.jpg" width="53" height="54" /></div>
          <div class="bdancont2"><span class="font2">***826542</span>(会员)<br/>
            衣衣对于我来说真的偏长，但是款式还不错</div>
        </div>
        <div class="bdan2">
          <table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>热卖简略印花T恤</td>
              <td><span class="font4">￥152.30</span></td>
            </tr>
          </table>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pick.jpg" width="53" height="54" /></div>
          <div class="bdancont2"><span class="font2">***826542</span>(会员)<br/>
            衣衣对于我来说真的偏长，但是款式还不错</div>
        </div>
        <div class="bdan2">
          <table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>热卖简略印花T恤</td>
              <td><span class="font4">￥152.30</span></td>
            </tr>
          </table>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pick.jpg" width="53" height="54" /></div>
          <div class="bdancont2"><span class="font2">***826542</span>(会员)<br/>
            衣衣对于我来说真的偏长，但是款式还不错</div>
        </div>
      </div>
    </div>
    <div class="adpic"><img src="<?=config_item('static_url')?>images/goods_03.jpg" width="198" height="233" alt="ffff" /></div>
    <div class="adpic"><img src="<?=config_item('static_url')?>images/goods_03.jpg" width="198" height="233" alt="ffff" /></div>
  </div>
  <!--left end-->
  <div class="goods-list">
    <div class="select">
      <table class="tab3" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="10%" align="right">您已选择：</td>
          <td width="90%"><div class="slect-item"><span>M</span><span class="close"><img src="<?=config_item('static_url')?>images/bgw_06.gif" width="12" height="13" /></span></div>
            <div class="slect-item"><span>宽松型</span><span class="close"><img src="<?=config_item('static_url')?>images/bgw_06.gif" width="12" height="13" /></span></div>
          <div class="slect-item"><span>印花</span><span class="close"><img src="<?=config_item('static_url')?>images/bgw_06.gif" width="12" height="13" /></span></div></td>
        </tr>
        <tr>
          <td align="right">尺码：</td>
          <td><ul class="sitem">
              <li>S</li>
              <li>M</li>
              <li>L</li>
              <li>XL</li>
            </ul></td>
        </tr>
        <tr>
          <td align="right">版型：</td>
          <td><ul class="sitem">
              <li>宽松型</li>
              <li>修身型</li>
              <li>收腰型</li>
              <li>直桶型</li>
            </ul></td>
        </tr>
        <tr>
          <td align="right">图案：</td>
          <td><ul class="sitem">
              <li>印花图案</li>
              <li>植物图案</li>
              <li>动物图案</li>
              <li>几何图案</li>
              <li>印花图案</li>
              <li>植物图案</li>
              <li>动物图案</li>
              <li>几何图案</li>
              <li>印花图案</li>
              <li>植物图案</li>
              <li>动物图案</li>
              <li>几何图案</li>
              <li>印花图案</li>
              <li>植物图案</li>
              <li>动物图案</li>
              <li>几何图案</li>
            </ul></td>
        </tr>
        <tr>
          <td align="right">面料：</td>
          <td><ul class="sitem">
              <li>雪纺</li>
              <li>亚麻</li>
              <li>纯棉</li>
              <li>化纤</li>
              <li>混纺</li>
            </ul></td>
        </tr>
      </table>
      <table class="tab3" width="100%" border="0" cellspacing="0" cellpadding="0" id="moreslect" style="display:none;">
        <tr>
          <td width="10%" align="right">版型：</td>
          <td width="90%"><ul class="sitem">
              <li>宽松型</li>
              <li>修身型</li>
              <li>收腰型</li>
              <li>直桶型</li>
            </ul></td>
        </tr>
        <tr>
          <td align="right">图案：</td>
          <td><ul class="sitem">
              <li>印花图案</li>
              <li>植物图案</li>
              <li>动物图案</li>
              <li>几何图案</li>
              <li>印花图案</li>
              <li>植物图案</li>
              <li>动物图案</li>
              <li>几何图案</li>
              <li>印花图案</li>
              <li>植物图案</li>
              <li>动物图案</li>
              <li>几何图案</li>
              <li>印花图案</li>
              <li>植物图案</li>
              <li>动物图案</li>
              <li>几何图案</li>
            </ul></td>
        </tr>
        <tr>
          <td align="right">面料：</td>
          <td><ul class="sitem">
              <li>雪纺</li>
              <li>亚麻</li>
              <li>纯棉</li>
              <li>化纤</li>
              <li>混纺</li>
            </ul></td>
        </tr>
      </table>
    </div>
    <div class="extend">
      <div class="kz" id="kza" onclick="extenditem('moreslect','kza')"></div>
    </div>
    <div class="goodsbox">
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/><span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
    </div>
    <div class="pages">
     <span class="disabled"> 上一页 </span><span class="current">1</span><a href="#?page=2">2</a><a href="#?page=3">3</a><a href="#?page=4">4</a><a href="#?page=5">5</a><a href="#?page=6">6</a><a href="#?page=7">7</a>...<a href="#?page=199">12</a><a href="#?page=200">13</a><a href="#?page=2"> 下一页 </a>
&nbsp;&nbsp;共13页&nbsp;&nbsp;&nbsp;&nbsp;到第&nbsp;
      <input class="input6" name="input" type="text" />      &nbsp;页&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="button" class="input7" value="确定" />
    </div>
  </div>
  <!--right end-->
</div>
<div class="box3 pad4">
  <div class="viewhistory">
    <div class="tit">最近浏览过的商品</div>
    <div class="viewhis">
      <div class="vhis">
      <img src="<?=config_item('static_url')?>images/h1_03.jpg" width="140" height="140" /><p>时尚百搭男款宽松休闲T恤 天蓝色</p>
      <span class="font4">￥49.00 </span></div>
      <div class="vhis"><img src="<?=config_item('static_url')?>images/h1_05.jpg" width="140" height="140" />
        <p>时尚百搭男款宽松休闲T恤 天蓝色</p>
      <span class="font4">￥49.00 </span></div>
      <div class="vhis">
      <img src="<?=config_item('static_url')?>images/h1_08.jpg" width="140" height="140" /><p>时尚百搭男款宽松休闲T恤 天蓝色</p>
      <span class="font4">￥49.00 </span></div>
      <div class="vhis">
      <img src="<?=config_item('static_url')?>images/h1_10.jpg" width="140" height="140" /><p>时尚百搭男款宽松休闲T恤 天蓝色</p>
      <span class="font4">￥49.00 </span></div>
      <div class="vhis">
      <img src="<?=config_item('static_url')?>images/h1_03.jpg" width="140" height="140" /><p>时尚百搭男款宽松休闲T恤 天蓝色</p>
      <span class="font4">￥49.00 </span></div>
      <div class="vhis">
      <img src="<?=config_item('static_url')?>images/h1_05.jpg" width="140" height="140" /><p>时尚百搭男款宽松休闲T恤 天蓝色</p>
      <span class="font4">￥49.00 </span></div>
    </div>
  </div>
</div>
<?php include '/../footer.php';?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
</body>
</html>