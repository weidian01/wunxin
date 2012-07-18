<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的订单</title>
    <link href="/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="/scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="/scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include('/../header.php');?>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">订单中心</div>
            <!--
            <div class="u-ac">
              <span class="ruo">账户安全：</span>
              <span class="zhong">账户安全：</span>
              <span class="qiang">账户安全：</span>
              <div class="yanzheng">
                <span class="phone">未验证手机</span>
                <span class="email">未验证邮箱</span>
                <span class="topay">未启用支付密码</span>
              </div>
              <div class="safetip">为保护账户安全，请尽快<a href="#"><strong>启用所有安全服务</strong></a></div>

            </div>
            -->
        </div>
        <div class="u-r-box">
            <div class="orderlist-sek">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="44%"><label>
                            <select name="select" id="select">
                                <option>近一个月订单</option>
                            </select>&nbsp;&nbsp;
                            <select name="select2" id="select2">
                                <option>订单状态</option>
                            </select>
                        </label></td>
                        <td width="46%" align="right"><label>
                            <input name="textfield" type="text" class="input1" id="textfield" value="商品名称，商品编号，订单编号"
                                   onfocus="if (value =='商品名称，商品编号，订单编号'){value =''}"
                                   onblur="if (value ==''){value='商品名称，商品编号，订单编号'}"/>
                        </label></td>
                        <td width="10%">&nbsp;&nbsp;<label>
                            <input class="sinput" type="submit" name="button" id="button" value="查询"/>
                        </label></td>
                    </tr>
                </table>

            </div>
            <div class="o-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="16%" height="26" align="center">订单编号</td>
                        <td width="28%">订单商品

                        </td>
                        <td width="8%" align="center">收货人</td>
                        <td width="10%" align="center">订单金额</td>
                        <td width="17%" align="center">下单时间</td>
                        <td width="8%" align="center">订单状态</td>
                        <td width="13%" align="center">操作</td>
                    </tr>
                </table>
            </div>
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php if (empty ($data)) $data = array();
                foreach ($data as $v) {?>
                <tr>
                    <td width="14%" align="center"><a href="#"><?php echo $v['order_sn'];?></a></td>
                    <td width="31%">
                        <div class="goods-in">
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg" width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="scolls"><a href="#"></a></div>
                        </div>
                    </td>
                    <td width="8%" align="center">陈妮</td>
                    <td width="9%" align="center">￥88.00<br/>货到付款</td>
                    <td width="14%" align="center">2012-05-20-16:30</td>
                    <td width="7%" align="center">已完成</td>
                    <td width="17%" align="center"><a href="#">查看</a> | <a href="#">评价</a> | <a href="#">晒单</a><br/>
                        <a href="#">申请返修/退换货</a>

                        <div class="gobuy"><a href="#"></a></div>
                    </td>
                </tr>
                    <?php }?>
                <!--
                <tr>
                    <td width="14%" align="center"><a href="#">cy255566525522</a></td>
                    <td width="31%">
                        <div class="goods-in">
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="scolls"><a href="#"></a></div>
                        </div>
                    </td>
                    <td width="8%" align="center">陈妮</td>
                    <td width="9%" align="center">￥88.00<br/>货到付款</td>
                    <td width="14%" align="center">2012-05-20-16:30</td>
                    <td width="7%" align="center">已完成</td>
                    <td width="17%" align="center"><a href="#">查看</a> | <a href="#">评价</a> | <a href="#">晒单</a><br/>
                        <a href="#">申请返修/退换货</a>

                        <div class="gobuy"><a href="#"></a></div>
                    </td>
                </tr>
                <tr>
                    <td width="14%" align="center"><a href="#">cy255566525522</a></td>
                    <td width="31%">
                        <div class="goods-in">
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="g-i-img"><a href="#"><img src="<?=config_item('static_url')?>images/bui_07.jpg"
                                                                  width="45" height="45"/></a></div>
                            <div class="scolls"><a href="#"></a></div>
                        </div>
                    </td>
                    <td width="8%" align="center">陈妮</td>
                    <td width="9%" align="center">￥88.00<br/>货到付款</td>
                    <td width="14%" align="center">2012-05-20-16:30</td>
                    <td width="7%" align="center">已完成</td>
                    <td width="17%" align="center"><a href="#">查看</a> | <a href="#">评价</a> | <a href="#">晒单</a><br/>
                        <a href="#">申请返修/退换货</a>

                        <div class="gobuy"><a href="#"></a></div>
                    </td>
                </tr>
                -->
                <tr>
                    <td colspan="7" align="right">
                        <ul class="ddall">
                            <li>订单总数：<span class="font1">3</span></li>
                            <li>已取消订单数：<span class="font1">0</span></li>
                            <li>已完成订单数：<span class="font1">0</span></li>
                            <li>未付款订单数：<span class="font1">0</span></li>
                            <li>等待付款订单数：<span class="font1">0</span></li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
        <div class="u-r-box">
            <div class="tui-tit">为您推荐</div>
            <div class="tui">
                <div class="tuipre"><a href="#"></a></div>
                <div class="tuinext"><a href="#"></a></div>
                <ul>
                    <li><img src="<?=config_item('static_url')?>images/mlf_07.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                    <li><img src="<?=config_item('static_url')?>images/mlf_09.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                    <li><img src="<?=config_item('static_url')?>images/mlf_12.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                    <li><img src="<?=config_item('static_url')?>images/mlf_15.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                    <li><img src="<?=config_item('static_url')?>images/mlf_07.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../footer.php");?>
<SCRIPT type=text/javascript src="/scripts/common.js"></SCRIPT>
<!-- #EndLibraryItem -->
</body>
</html>

