<div class="hd">
    <div class="hd-cont">
        <div class="hd-wel">您好&nbsp;&nbsp;<span id="user_name_id">欢迎光临万象网</span>！&nbsp;&nbsp;<span id="loginout_id"></span></div>
        <div class="cart" onmouseover="wx.cartView('cartbox', 1)" onmouseout="wx.cartView('cartbox', 0)">
            <div class="cart-num"> 购物车有
                <span class="font1" id="cart_product_num"> <img src="<?=config_item('static_url')?>images/small_loading.gif" alt=""/> </span> 件
                <div id="cartbox" class="cart-form" onmouseover="wx.cartView('cartbox', 1)" onmouseout="wx.cartView('cartbox', 0)" style=" display:none;">
                    <h4>购物车中还没有商品，赶紧去选购吧！</h4>
                </div>
            </div>
            <div class="cart-btn"><a href="<?=config_item('static_url')?>cart/" >
                <!--<img src="<?=config_item('static_url')?>images/cart_31.jpg" width="60" height="24"/>-->
            </a></div>
        </div>
        <div class="hd-login">
            <ul>
                <li><a href="javascript:void (0);" onclick="wx.addFavorite()">收藏本站</a></li>
                <li><a href="<?=config_item('static_url')?>other/help/index/16" target="_blank">帮助中心</a></li>
                <!--<li><a href="#">浏览记录</a></li>-->
                <!--<li><a href="<?=config_item('static_url')?>user/center">我的万象</a></li>-->
                <li><a href="<?=config_item('static_url')?>user/center/index" target="_blank">我的订单</a></li>
                <li id="user_info_id"><a style="color:#000;" href="<?=config_item('static_url')?>user/register/" target="_blank">注册</a></li>
                <li id="user_login_out_id"><a href="<?=config_item('static_url')?>user/login/" target="_blank">登录</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="box">
    <div class="banner" style="overflow:auto; zoom:1">
        <!--
        <div class="logo-img"><a href="<?=config_item('static_url')?>"><img src="<?=config_item('static_url')?>images/logo.jpg" width="334" height="56" alt="万象网"/></a></div>
        <div class="search">
            <div class="s-input">
                <div class="sch">
                    <form name="search" method="get" action="<?=config_item('base_url')?>search">
                        <input id="keyword" name="keyword" type="text" value="<?=isset($keyword) ? $keyword:'';?>"/>
                    </form>
                </div>
                <div class="sbtn"><a href="javascript:;" onclick="document.forms['search'].submit()">
                </a></div>
            </div>
            <div class="hot-keyword">
                <ul>
                    <li class="kw">热门搜索：</li>
                    <?php if (empty($this->search_keyword) || !is_array($this->search_keyword)) $this->search_keyword = array();
                    foreach ($this->search_keyword as $sk):?>
                    <li><a href="<?=config_item('static_url')?>search?keyword=<?=$sk['title'];?>" target="_blank"><?=$sk['title'];?></a></li>
                    <?php endforeach;?>

                    <li><a href="#" target="_blank">雪纺裙</a></li>
                    <li><a href="#" target="_blank">亲子装</a></li>
                    <li><a href="#" target="_blank">哈伦裤</a></li>
                    <li><a href="#" target="_blank">吊带长裙</a></li>

                </ul>
            </div>
        </div>
        -->

        <div class="logo-img"><a href="<?=config_item('base_url')?>" title="万象网"><img src="/images/logo_03.jpg" width="267" height="66" /></a></div>
        <div class="search">
          <div class="s-input">
            <div class="sch">
                <form name="search" method="get" action="<?=config_item('base_url')?>search">
              <input id="keyword" name="keyword" type="text" value="<?=isset($keyword) ? $keyword:'';?>"/>
                </form>
            </div>
            <div class="sch-bg"></div>
            <div class="sbtn"><a href="javascript:void(0);" onclick="document.forms['search'].submit()">搜&nbsp;&nbsp;索</a></div>
          </div>
          <div class="hot-keyword">
            <ul>
                <?php if (empty($this->search_keyword) || !is_array($this->search_keyword)) $this->search_keyword = array();
                foreach ($this->search_keyword as $sk):?>
                <li><a href="<?=config_item('static_url')?>search?keyword=<?=$sk['title'];?>" target="_blank"><?=$sk['title'];?></a></li>
                <?php endforeach;?>
              <!--<li class="morehot"><a href="#">更多</a></li>-->
            </ul>
          </div>
        </div>
        <script type="text/javascript">
            //$(document).ready(function () {
                var keyWord = $("#keyword").val();
                if (keyWord != '') {
                    $("#keyword").css("background", "none");
                }
                $("#keyword").focus(function () {
                    $(this).css("background", "none");
                });
                $("#keyword").blur(function () {
                    if (this.value == "") {
                        $(this).css("background", "url(/images/fdj_11.gif) no-repeat 4px 3px");
                    }
                    else {
                        $(this).css("background", "none");
                    }
                });
            //})
        </script>
        <div class="cedt">
          <table width="92%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="29%"><img src="<?=config_item('static_url')?>images/wx_12.jpg" width="51" height="45" alt="正品保证" /></td>
              <td width="35%"><img src="<?=config_item('static_url')?>images/wx_14.jpg" width="62" height="45" alt="全场免运费" /></td>
              <td width="36%"><img src="<?=config_item('static_url')?>images/wx_17.jpg" width="74" height="44" alt="无理由退换货" /></td>
            </tr>
          </table>
        </div>
    </div>
</div>
<div class="nav">
    <div class="navbox">
        <div class="mainnav">
            <a <?php if(!isset($category)):?>class="curr"<?php endif;?> href="<?=site_url()?>">首页</a>
            <?php foreach($this->channel as $channel):?>
                <?php if($channel["parent_id"]==0):?>
                <?php if(isset($category) && $category == $channel['class_id']):?>
                <?php $_view_curr = 'class="curr"';?>
                <?php else:?>
                <?php $_view_curr = '';?>
                <?php endif;?>
                <a <?=$_view_curr?> href="<?=config_item('static_url')?>filter/<?=$channel['class_id']?>"><?=$channel['cname']?></a>
                <?php endif;?>
            <?php endforeach;?>
            <!--a class="last" href="#">亲子装款</a-->
            <a href="<?=config_item('static_url')?>search?keyword=%E5%8D%AB%E8%A1%A3">卫衣</a>
            <a href="<?=config_item('static_url')?>search?keyword=T%E6%81%A4">T恤</a>
            <a href="<?=config_item('static_url')?>search?keyword=%E9%95%BF%E8%A2%96T%E6%81%A4">长袖T恤</a>
            <a href="<?=config_item('static_url')?>search?keyword=<?=urlencode('裤')?>" class="last">裤装</a>
        </div>

        <div class="other">
            <div class="otherbox">
                <ul>
                    <li><a href="<?=config_item('static_url')?>filter/0/1/new/1" target="_blank">最新到货</a></li>
                    <li><a href="<?=config_item('static_url')?>activity/activity/discount/19" target="_blank">特价热卖</a></li>
                    <li><a href="<?=config_item('static_url')?>comment/hot" target="_blank">热门评论</a></li>
                    <li class="end"><a href="<?=config_item('static_url')?>activity/activity/qiang/18" target="_blank">限时抢购</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
