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
        <div class="logo-img"><a href="<?=config_item('static_url')?>"><img src="<?=config_item('static_url')?>images/logo.jpg" width="334" height="56" alt="万象网"/></a></div>
        <div class="search">
            <div class="s-input">
                <div class="sch">
                    <form name="search" method="get" action="<?=config_item('base_url')?>search">
                        <input id="keyword" name="keyword" type="text" value="<?=isset($keyword) ? $keyword:'';?>"/>
                    </form>
                </div>
                <div class="sbtn"><a href="javascript:;" onclick="document.forms['search'].submit()">
                    <!--<img src="<?=config_item('static_url')?>images/wx_09.jpg" width="37" height="28"/>-->
                </a></div>
            </div>
            <div class="hot-keyword">
                <ul>
                    <li class="kw">热门搜索：</li>
                    <?php if (empty($this->search_keyword) || !is_array($this->search_keyword)) $this->search_keyword = array();
                    foreach ($this->search_keyword as $sk):?>
                    <li><a href="<?=config_item('static_url')?>search?keyword=<?=$sk['title'];?>" target="_blank"><?=$sk['title'];?></a></li>
                    <?php endforeach;?>
                    <!--
                    <li><a href="#" target="_blank">雪纺裙</a></li>
                    <li><a href="#" target="_blank">亲子装</a></li>
                    <li><a href="#" target="_blank">哈伦裤</a></li>
                    <li><a href="#" target="_blank">吊带长裙</a></li>
                    -->
                </ul>
            </div>
        </div>
        <div class="cedt">
            <table width="92%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="29%">
                        <!--<img src="<?=config_item('static_url')?>images/wx_12.jpg" width="51" height="45" alt="正品保证"/>-->
                        <b class="genuine"></b>
                    </td>
                    <td width="35%">
                        <b class="audience_free_shipping"></b>
                        <!--<img src="<?=config_item('static_url')?>images/wx_14.jpg" width="62" height="45" alt="全场免运费"/>-->
                    </td>
                    <td width="36%">
                        <b class="no_reason_to_return"></b>
                        <!--<img src="<?=config_item('static_url')?>images/wx_17.jpg" width="74" height="44" alt="无理由退换货"/>-->
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="nav">
    <div class="navbox">
        <div class="mainnav">
            <a class="curr" href="<?=site_url()?>">首页</a>
            <?php foreach($this->channel as $channel):?>
                <?php if($channel["parent_id"]==0):?>
                <a href="<?=config_item('static_url')?>category/<?=$channel['class_id']?>"><?=$channel['cname']?></a>
                <?php endif;?>
            <?php endforeach;?>
            <!--a class="last" href="#">亲子装款</a-->
            <a href="<?=config_item('static_url')?>search?keyword=%E5%8D%AB%E8%A1%A3">卫衣</a>
            <a href="<?=config_item('static_url')?>search?keyword=T%E6%81%A4">T恤</a>
            <a href="<?=config_item('static_url')?>search?keyword=%E9%95%BF%E8%A2%96T%E6%81%A4">长袖T恤</a>
        </div>

        <div class="other">
            <div class="otherbox">
                <ul>
                    <li><a href="<?=config_item('static_url')?>category/0/1/new/1" target="_blank">最新到货</a></li>
                    <li><a href="<?=config_item('static_url')?>activity/activity/discount/2" target="_blank">特价热卖</a></li>
                    <li><a href="<?=config_item('static_url')?>comment/hot" target="_blank">热门评论</a></li>
                    <li class="end"><a href="<?=config_item('static_url')?>activity/activity/qiang/4" target="_blank">限时抢购</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
