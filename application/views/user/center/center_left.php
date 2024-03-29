<?php
$currUrl = $_SERVER['PHP_SELF'];
$currUrl = str_replace('/index.php', '', $currUrl);
?>
<div class="u-left">
    <div class="u-tit">订单中心</div>
    <div class="u-menu">
        <ul>
            <li><a href="<?=config_item('static_url')?>user/center/index" class="<?=(strpos($currUrl, 'index', true) !== false || strpos($currUrl, 'orderDetail', true) !== false) ? ' curr' : ''; ?>">我的订单</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/returns" class="<?=(strpos($currUrl, 'returns') !== false || strpos($currUrl, 'addReturn') !== false) ? 'curr' : '';?>">退换货办理</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/invoice" class="<?=(strpos($currUrl, 'invoice') !== false || strpos($currUrl, 'addInvoice') !== false) ? 'curr' : '';?>">发票管理</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/share" class="<?=(strpos($currUrl, 'share') !== false) ? 'curr' : '';?>">我的晒单</a></li>
        </ul>
    </div>
    <div class="u-tit">用户信息</div>
    <div class="u-menu">
        <ul>
            <li><a href="<?=config_item('static_url')?>user/center/productFavorite" class="<?php
            echo (strpos($currUrl, 'productFavorite') !== false || strpos($currUrl, 'designerFavorite') !== false || strpos($currUrl, 'designFavorite') !== false) ? 'curr' : '';
            ?>">我的收藏夹</a></li>
            <!--
            <li><a href="<?=config_item('static_url')?>user/center/productFavorite" class="<?=(strpos($currUrl, 'productFavorite') !== false) ? 'curr' : '';?>">产品收藏</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/designerFavorite" class="<?=(strpos($currUrl, 'designerFavorite') !== false) ? 'curr' : '';?>">设计师收藏</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/designFavorite" class="<?=(strpos($currUrl, 'designFavorite') !== false) ? 'curr' : '';?>">设计图收藏</a></li>
            -->
            <li><a href="<?=config_item('static_url')?>user/center/profile" class="<?=(strpos($currUrl, 'profile') !== false || strpos($currUrl, 'addUserHeader') !== false) ? 'curr' : '';?>">个人资料</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/modifyPassword" class="<?=(strpos($currUrl, 'modifyPassword') !== false) ? 'curr' : '';?>">修改密码</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/productComment" class="<?php
            echo (strpos($currUrl, 'productComment') !== false || strpos($currUrl, 'designComment') !== false || strpos($currUrl, 'designerComment') !== false) ? 'curr' : '';
            ?>">我的评论</a></li>
            <!--
            <li><a href="<?=config_item('static_url')?>user/center/designComment" class="<?=(strpos($currUrl, 'designComment') !== false) ? 'curr' : '';?>">设计图评论</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/designerComment" class="<?=(strpos($currUrl, 'designerComment') !== false) ? 'curr' : '';?>">设计师留言</a></li>
            -->
            <li><a href="<?=config_item('static_url')?>user/center/qa" class="<?=(strpos($currUrl, 'qa') !== false) ? 'curr' : '';?>">产品问答</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/recentAddress" class="<?=(strpos($currUrl, 'recentAddress') !== false || strpos($currUrl, 'addRecentAddress') !== false) ? 'curr' : '';?>">收货地址管理</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/myDesign" class="<?=(strpos($currUrl, 'myDesign') !== false) ? 'curr' : '';?>">我的设计图</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/myProduct" class="<?=(strpos($currUrl, 'myProduct') !== false) ? 'curr' : '';?>">我的产品</a></li>
        </ul>
    </div>
    <div class="u-tit">自助服务</div>
    <div class="u-menu">
        <ul>
            <li><a href="<?=config_item('static_url')?>user/center/salesInfo" class="<?=(strpos($currUrl, 'salesInfo') !== false) ? 'curr' : '';?>">促销信息退订</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/giftCard" class="<?=(strpos($currUrl, 'giftCard') !== false || strpos($currUrl, 'bingCard') !== false) ? 'curr' : '';?>">礼品卡管理</a></li>
            <li><a href="<?=config_item('static_url')?>user/center/systemProposal" class="<?=(strpos($currUrl, 'systemProposal') !== false || strpos($currUrl, 'mySystemProposal') !== false) ? 'curr' : '';?>">系统建议与意见</a></li>
        </ul>
    </div>
</div>