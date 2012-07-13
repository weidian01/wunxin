<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title?></title>
<link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css" />
<link href="<?=config_item('static_url')?>css/goods.css" rel="stylesheet" type="text/css" />
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></SCRIPT>
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

  $(".goods-cbox").mouseover(function(){
    $(".goods-cbox").css("border","1px solid #e8e8e8");
	$(this).css("border","1px solid #ac1116");
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
      <li><a href="#">首页</a></li>
      <li><a href="#">女装</a></li>
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
        <div class="side-m current" id="sidet1" onmouseover="rankbox('sidet','rankt','1')">同类别</div>
        <div class="side-m" id="sidet2" onmouseover="rankbox('sidet','rankt','2')">同品牌</div>
        <div class="side-m" id="sidet3" onmouseover="rankbox('sidet','rankt','3')">同价位</div>
      </div>
      <div class="rankbox" id="rankt1">
        <ul class="bdan">
          <li class="on">
            <div class="no1">1</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">2</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">3</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">4</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">5</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">6</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">7</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">8</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
        </ul>
      </div>
      <div class="rankbox" id="rankt2" style="display:none;">
        <ul class="bdan">
          <li class="on">
            <div class="no1">1</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">印花宽松连衣裙7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">2</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">sa1025花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">3</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">4</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">00亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">5</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">6</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">7</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">8</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
        </ul>
      </div>
      <div class="rankbox" id="rankt3" style="display:none;">
        <ul class="bdan">
          <li class="on">
            <div class="no1">1</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">2</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">3</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">4</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">5</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">6</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">7</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">8</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
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
        <ul class="bdan">
          <li class="on">
            <div class="no1">1</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">2</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">3</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">4</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">5</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">6</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">7</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">8</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
        </ul>
      </div>
      <div class="rankbox" id="rank2" style="display:none;">
        <ul class="bdan">
          <li class="on">
            <div class="no1">1</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">22亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">2</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">22亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">3</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">22亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">4</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">22亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">5</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">22亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">6</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">22亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">7</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">22亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">8</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">22亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
        </ul>
      </div>
      <div class="rankbox" id="rank3" style="display:none;">
        <ul class="bdan">
          <li class="on">
            <div class="no1">1</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">33亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">2</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">33亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">3</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">33亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">4</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">33亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">5</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">33亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">6</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">33亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">7</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">33亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
          <li>
            <div class="no1">8</div>
            <div class="bdimg"><img src="<?=config_item('static_url')?>images/hg_03.jpg" width="53" height="54" /></div>
            <div class="bdancont"><a href="#">33亿品印花宽松T恤7500 灰色M</a>
              <div class="bdprice"> <span class="font4">￥35.00</span></div>
            </div>
          </li>
        </ul>
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
              <td><a href="#">热卖简略印花T恤</a></td>
              <td><span class="font4">￥152.30</span></td>
            </tr>
          </table>
          <div class="bdimg"><img src="<?=config_item('static_url')?>images/pick.jpg" width="53" height="54" /></div>
          <div class="bdancont2" style="float:left;"><span class="font2">***826542</span>(会员)<br/>
            衣衣对于我来说真的偏长，但是款式还不错</div>
        </div>
        <div class="bdan2">
          <table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><a href="#">热卖简略印花T恤</a></td>
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
              <td><a href="#">热卖简略印花T恤</a></td>
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
              <td><a href="#">热卖简略印花T恤</a></td>
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
              <td><a href="#">热卖简略印花T恤</a></td>
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
              <td><a href="#">热卖简略印花T恤</a></td>
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
              <td><a href="#">热卖简略印花T恤</a></td>
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
              <td><a href="#">热卖简略印花T恤</a></td>
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
              <td><a href="#">热卖简略印花T恤</a></td>
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
    <div id="modelAttr" class="select">
      <table class="tab3" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="10%" align="right">您已选择：</td>
          <td width="90%"><div class="slect-item"><span>M</span><a href="#" class="close"></a></div>
            <div class="slect-item"><span>宽松型</span><a href="#" class="close"></a></div>
            <div class="slect-item"><span>印花</span><a href="#" class="close"></a></div></td>
        </tr>
        <?php foreach($modelAttr as $item):?>
          <tr>
            <td align="right"><?=$item['attr_name']?>：</td>
            <td><ul class="sitem">
                <?php foreach($item['attr_value'] as $v):?>
                    <li><a href="/category/<?=$category?>/!<?=$item['attr_id']?>-<?=$v?>"><?=$v?></a></li>
                <?php endforeach;?>
              </ul></td>
          </tr>
        <?php endforeach;?>
      </table>
    </div>
    <div class="extend">
      <div class="kz" id="kza" onclick="more()"></div>
    </div>
    <div class="goodsbox">
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_03.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"><img src="<?=config_item('static_url')?>images/g_05.jpg" width="164" height="220" alt="ddd" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_08.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
      <div class="goods-cb">
        <div class="goods-cbox"> <img src="<?=config_item('static_url')?>images/g_11.jpg" width="164" height="220" alt="eeee" />
          <p>[VT]短袖印花T恤 美丽印象（女款）浅紫色<br/>
            <span class="font4">售价 ￥39.00</span></p>
        </div>
      </div>
    </div>
    <div class="pages"> <span class="disabled"> 上一页 </span><span class="current">1</span><a href="#?page=2">2</a><a href="#?page=3">3</a><a href="#?page=4">4</a><a href="#?page=5">5</a><a href="#?page=6">6</a><a href="#?page=7">7</a>...<a href="#?page=199">12</a><a href="#?page=200">13</a><a href="#?page=2"> 下一页 </a> &nbsp;&nbsp;共13页&nbsp;&nbsp;&nbsp;&nbsp;到第&nbsp;
      <input class="input6" name="input" type="text" />
      &nbsp;页&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="" type="button" class="input7" value="确定" />
    </div>
  </div>
  <!--right end-->
</div>
<div class="box3 pad4">
  <div class="viewhistory">
    <div class="tit">最近浏览过的商品</div>
    <div class="viewhis">
      <div class="vhis"> <a class="hoverimg" href="#"><img src="<?=config_item('static_url')?>images/h1_03.jpg" width="140" height="140" /></a>
        <p>时尚百搭男款宽松休闲T恤 天蓝色</p>
        <span class="font4">￥49.00 </span></div>
      <div class="vhis"><a class="hoverimg" href="#"><img src="<?=config_item('static_url')?>images/h1_05.jpg" width="140" height="140" /></a>
        <p>时尚百搭男款宽松休闲T恤 天蓝色</p>
        <span class="font4">￥49.00 </span></div>
      <div class="vhis"><a class="hoverimg" href="#"><img src="<?=config_item('static_url')?>images/h1_08.jpg" width="140" height="140" /></a>
        <p>时尚百搭男款宽松休闲T恤 天蓝色</p>
        <span class="font4">￥49.00 </span></div>
      <div class="vhis"><a class="hoverimg" href="#"><img src="<?=config_item('static_url')?>images/h1_10.jpg" width="140" height="140" /></a>
        <p>时尚百搭男款宽松休闲T恤 天蓝色</p>
        <span class="font4">￥49.00 </span></div>
      <div class="vhis"><a class="hoverimg" href="#"><img src="<?=config_item('static_url')?>images/h1_03.jpg" width="140" height="140" /></a>
        <p>时尚百搭男款宽松休闲T恤 天蓝色</p>
        <span class="font4">￥49.00 </span></div>
      <div class="vhis"><a class="hoverimg" href="#"><img src="<?=config_item('static_url')?>images/h1_05.jpg" width="140" height="140" /></a>
        <p>时尚百搭男款宽松休闲T恤 天蓝色</p>
        <span class="font4">￥49.00 </span></div>
    </div>
  </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<!-- #EndLibraryItem -->
</body>
</html>
<script>
    $(function ($) {
        $("#kza").toggle(
            function () {
                $("#modelAttr").css({height:"199px"});
            },
            function () {
                $("#modelAttr").css({height:"auto"});
            }
        );
    });
</script>
