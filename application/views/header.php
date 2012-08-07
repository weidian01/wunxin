<div class="hd">
    <div class="hd-cont">
        <div class="hd-wel">您好&nbsp;&nbsp;<span id="user_name_id">欢迎光临万象网</span>！&nbsp;&nbsp;<span id="loginout_id"></span></div>
        <div class="cart" onmouseover="wx.cartView('cartbox', 1)" onmouseout="wx.cartView('cartbox', 0)">
            <div class="cart-num"> 购物车有
                <span class="font1" id="cart_product_num"> <img src="/images/small_loading.gif" alt=""/> </span> 件
                <div id="cartbox" class="cart-form" onmouseover="wx.cartView('cartbox', 1)" onmouseout="wx.cartView('cartbox', 0)" style=" display:none;">
                    <h4>购物车中还没有商品，赶紧去选购吧！</h4>
                </div>
            </div>
            <div class="cart-btn"><a href="/cart/" ><img src="/images/cart_31.jpg" width="60" height="24"/></a></div>
        </div>
        <div class="hd-login">
            <ul>
                <li><a href="javascript:void (0);" onclick="wx.addFavorite()">收藏本站</a></li>
                <li><a href="/other/help/index/">帮助中心</a></li>
                <li><a href="#">浏览记录</a></li>
                <!--<li><a href="/user/center">我的万象</a></li>-->
                <li><a href="/user/center/index">我的订单</a></li>
                <li id="user_info_id"><a style="color:#000;" href="/user/register/">注册</a></li>
                <li id="user_login_out_id"><a href="/user/login/">登录</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="box">
    <div class="banner" style="overflow:auto; zoom:1">
        <div class="logo-img"><img src="/images/logo.jpg" width="334" height="56" alt="万象网"/></div>
        <div class="search">
            <div class="s-input">
                <div class="sch">
                    <input name="" type="text"/>
                </div>
                <div class="sbtn"><a href="#"> <img src="/images/wx_09.jpg" width="36" height="28"/></div>
                </a>
            </div>
            <div class="hot-keyword">
                <ul>
                    <li class="kw">热门搜索：</li>
                    <li><a href="#">七分裤</a></li>
                    <li><a href="#">雪纺裙</a></li>
                    <li><a href="#">亲子装</a></li>
                    <li><a href="#">哈伦裤</a></li>
                    <li><a href="#">吊带长裙</a></li>
                </ul>
            </div>
        </div>
        <div class="cedt">
            <table width="92%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="29%"><img src="/images/wx_12.jpg" width="51" height="45" alt="正品保证"/></td>
                    <td width="35%"><img src="/images/wx_14.jpg" width="62" height="45" alt="全场免运费"/></td>
                    <td width="36%"><img src="/images/wx_17.jpg" width="74" height="44" alt="无理由退换货"/></td>
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
                <a href="/category/<?=$channel['class_id']?>"><?=$channel['cname']?></a>
                <?php endif;?>
            <?php endforeach;?>
            <!--a class="last" href="#">亲子装款</a-->
        </div>

        <div class="other">
            <div class="otherbox">
                <ul>
                    <li><a href="#">新品区</a></li>
                    <li><a href="#">新设计图</a></li>
                    <li><a href="#">新设计师</a></li>
                    <li class="end"><a href="#">热门晒单</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
