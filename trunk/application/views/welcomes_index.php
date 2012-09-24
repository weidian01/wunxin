<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $title;?></title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></SCRIPT>
    <SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/index.js"></SCRIPT>
    <script type="text/javascript" charset=utf-8 src="<?=config_item('static_url')?>scripts/lrscroll.js"></script>
    <script type="text/javascript" charset=utf-8 src="<?=config_item('static_url')?>scripts/artDialog.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
</head>
<body>
<?php include 'header.php';?>
<div class="box2">
    <div class="container">
        <div id="idContainer2" class="focus">
            <table id="idSlider2" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <?php foreach ($broadcast_recommend as $brv) {?>
                    <td class="td_f">
                        <a href="<?php echo $brv['link'];?>" target="_blank">
                            <img src="<?php echo base_url().str_replace('\\', '/', $brv['img_addr']);?>" alt="<?php echo $brv['title'];?>">
                        </a>
                    </td>
                    <?php }?>
                </tr>
                </tbody>
            </table>
            <ul id="idNum" class="num"></ul>
        </div>
        <div class="tod-act">
            <div class="today">
                <div class=" hp-carousel-cata" id="j-carousel-cata">
                    <div class="today-h">
                        <div class="act">
                            <ul>
                                <li class="prev">prev</li>
                                <li class="next">next</li>
                            </ul>
                        </div>
                    </div>
                    <div class="bd">
                        <div class="j-sw-clip">
                            <ul class="j-sw-c" style="width: 678px; ">
                                <?php foreach ($day_recommend as $drv) {?>
                                <li style="display: block; float: left; ">
                                    <a target="_blank" title="" href="<?php echo $drv['link'];?>">
                                        <img alt="<?php echo $drv['title'];?>" src="<?php echo base_url().str_replace('\\', '/', $drv['img_addr']);?>" width="95" height="120">
                                    </a>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--今日推荐end-->
            <div class="bulletin">
                <div class="blt-h"><span id="bullt1" class="curr" onclick="showbox('blt1')">最新公告</span> <span id="bullt2" onclick="showbox('blt2')">最新动态</span></div>
                <div class="blt-cont" id="blt1">
                    <ul>
                        <?php foreach ($bulletin as $bv) {?>
                        <li><a href="/article/info/<?=$bv['id'];?>" target="_blank"><?=mb_substr($bv['title'], 0, 18, 'utf-8');?></a></li>
                        <?php }?>
                    </ul>
                </div>
                <div class="blt-cont" id="blt2" style="display:none;">
                    <ul>
                        <?php foreach ($news as $nv) {?>
                        <li><a href="/article/dynamic/<?=$nv['id'];?>" target="_blank"><?=mb_substr($nv['title'], 0, 18, 'utf-8');?></a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="box2">
    <div class="container tp">
        <div class="slide" id="tktktkt">
            <ul>
                <?php foreach ($design_recommend_data as $drdv) {?>
                <li class="norm">
                    <a href="#" class="designimg" title="<?=$drdv['dname']?>" target="_blank">
                        <img alt="<?=$drdv['dname']?>" src="<?=config_item('static_url')?>upload/design/<?=str_replace('\\', '/', intToPath($drdv['did']))?>default.jpg" width="180" height="216"/>
                    </a>
                </li>
                <?php }?>
            </ul>
            <div class="slide-pre"><a href="javascript:void(0);"></a></div>
            <div class="slide-next"><a href="javascript:void(0);"></a></div>
        </div>
    </div>
</div>
<div class="box2 pad3">
<div class="container tp">
<div class="slide-ad">
    <div class="ad-btn">
        <?php $i = 1;foreach ($AD_recommend as $arvs) {?>
        <span class="ad-btn<?=$i?>" onmouseover="showAdvert('index_recommend_ad<?=$i?>')"><a href="#"><?=$arvs['title']?></a></span>
        <?php $i++;}?>
    </div>
    <ul>
        <?php $i = 1;foreach ($AD_recommend as $arv) {?>
        <li id="index_recommend_ad<?php echo $i;?>" style="<?php echo $i == 1 ? '' : 'display:none;';?>" class="index_recommend_ad">
            <a href="<?php echo $arv['link'];?>" target="_blank">
                <img alt="<?php echo $arv['title'];?>" src="<?php echo base_url().str_replace('\\', '/', $arv['img_addr']);?>" width="978" height="200"/>
            </a>
        </li>
        <?php $i++;}?>
        <!--
        <li id="ad2" style="display:none;"><img alt="广告一" src="/images/ad2.jpg" width="978" height="200"/></li>
        <li id="ad3" style="display:none;"><img alt="广告一" src="/images/ad3.jpg" width="978" height="200"/></li>
        -->
    </ul>
</div>
<div class="prodbox">
<div class="prod-tit">
    <div class="prod-t-h"></div>
    <div class="prod-n-more">
        <ul>
            <li class="cm"><a href="#" target="_blank">查看更多</a></li>
            <li><a href="#" target="_blank">特卖</a></li>
            <li><a href="#" target="_blank">新品</a></li>
            <li><a href="#" target="_blank">热卖</a></li>
            <li><a href="#" target="_blank">T恤</a></li>
            <li><a href="#" target="_blank">连衣裙</a></li>
            <li><a href="#" target="_blank">半裙</a></li>
            <li><a href="#" target="_blank">衬衫</a></li>
            <li><a href="#" target="_blank">背心/吊带衫</a></li>
            <li><a href="#" target="_blank">小西装</a></li>
            <li><a href="#" target="_blank">裤子</a></li>
            <li><a href="#" target="_blank">薄针织</a></li>
            <li style="background:none;"><a href="#" target="_blank">牛仔裤</a></li>

        </ul>
    </div>
</div>
<!--男款-->
<div class="prod-bd">
    <div class="men-l">
        <?php foreach ($man_product_2_recommend_data as $mp2rdv) {?>
        <div class="men-p">
            <div class="pro-pic">
                <a href="<?=productURL($mp2rdv['pid'])?>" title="<?=$mp2rdv['pname']?>, <?=fPrice($mp2rdv['sell_price'])?>" target="_blank">
                    <img src="<?=config_item('static_url')?>upload/product/<?=str_replace('\\', '/', intToPath($mp2rdv['pid']))?>default.jpg" width="120" height="144" alt="<?=$mp2rdv['pname']?>"/>
                </a>
            </div>
            <div class="men-cont"><span class="font2"><?=$mp2rdv['style_no']?></span><br/>
                <a href="<?=productURL($mp2rdv['pid'])?>" title="<?=$mp2rdv['pname']?>, ￥<?=fPrice($mp2rdv['sell_price'])?>" target="_blank"><?=mb_substr($mp2rdv['pname'], 0, 20, 'utf-8')?></a><br/>
                    <span class="font3">￥<?=fPrice($mp2rdv['sell_price'])?></span></div>
        </div>
        <?php }?>
    </div>
    <div class="prod-ct">
        <?php foreach ($man_recommend_2_3 as $mr23) {?>
        <?php if ($mr23['emission'] == '2') { ?>
        <a href="<?=$mr23['pid']?>" title="<?=$mr23['title']?>" target="_blank">
            <img src="<?=base_url(). str_replace('\\', '/', $mr23['img_addr']);?>" alt="<?=$mr23['title'];?>" width="200" height="320"/>
        </a>
        <?php }?>
        <?php }?>
    </div>
    <div class="prod-ct">
        <?php foreach ($man_recommend_2_3 as $mr23) {?>
        <?php if ($mr23['emission'] == '3') { ?>
        <a href="<?=$mr23['link']?>" title="<?=$mr23['title']?>" target="_blank">
            <img src="<?=base_url(). str_replace('\\', '/', $mr23['img_addr']);?>" alt="<?=$mr23['title'];?>" width="200" height="320"/>
        </a>
        <?php }?>
        <?php }?>

    </div>

    <div class="clear"></div>
    <div class="men-bd">
        <?php foreach ($man_product_1_recommend_data as $mp1rdv) {?>
        <div class="men-bd-b">
            <a class="productimg" href="<?=productURL($mp1rdv['pid'])?>" title="<?=$mp1rdv['pname']?>, ￥<?=fPrice($mp1rdv['sell_price'])?>" target="_blank">
                <img src="<?=config_item('static_url')?>upload/product/<?=str_replace('\\', '/', intToPath($mp1rdv['pid']))?>default.jpg" width="160" height="192" alt="<?=$mp1rdv['pname']?>"/>
            </a>
            <div class="pro-n"> <p><a href="<?=productURL($mp1rdv['pid'])?>" title="<?=$mp1rdv['pname']?>, ￥<?=fPrice($mp1rdv['sell_price'])?>" target="_blank"><?=$mp1rdv['pname']?></a></p>
                <span class="font4">￥<?=fPrice($mp1rdv['sell_price'])?></span></div>
        </div>
        <?php }?>
    </div>
</div>
<!--男款end-->

<!--女款T恤-->
<div class="prod-tit titbg2">
    <div class="prod-t-h h-bg"></div>
    <div class="prod-n-more">
        <ul>
            <li class="cm"><a href="#" target="_blank">查看更多</a></li>
            <li><a href="#" target="_blank">特卖</a></li>
            <li><a href="#" target="_blank">新品</a></li>
            <li><a href="#" target="_blank">热卖</a></li>
            <li><a href="#" target="_blank">T恤</a></li>
            <li><a href="#" target="_blank">连衣裙</a></li>
            <li><a href="#" target="_blank">半裙</a></li>
            <li><a href="#" target="_blank">衬衫</a></li>
            <li><a href="#" target="_blank">背心/吊带衫</a></li>
            <li><a href="#" target="_blank">小西装</a></li>
            <li><a href="#" target="_blank">裤子</a></li>
            <li><a href="#" target="_blank">薄针织</a></li>
            <li style="background:none;"><a href="#" target="_blank">牛仔裤</a></li>

        </ul>
    </div>
</div>
<div class="prod-bd pad">
    <div class="toplady">
        <div class="floorMain" onmouseout="hideLayer('picmt', 7)">
            <?php foreach ($woman_recommend_1_2_3_4_5_6 as $wr123456) {?>
            <?php if ($wr123456['emission'] == '1') {?>
            <a href="<?php echo $wr123456['link'];?>" class="item1" title="<?=$wr123456['title'];?>" target="_blank">
                <img id="picmt1" onmouseover="showLayer('1','picmt', 7)" src="<?php echo base_url(). str_replace('\\', '/', $wr123456['img_addr']);?>" alt="<?php echo $wr123456['title'];?>" width="237" height="300">
            </a>
            <?php }?>

            <?php if ($wr123456['emission'] == '2') {?>
            <a href="<?php echo $wr123456['link'];?>" class="item2" title="<?=$wr123456['title'];?>" target="_blank">
                <img id="picmt2" onmouseover="showLayer('2','picmt', 7)" src="<?php echo base_url(). str_replace('\\', '/', $wr123456['img_addr']);?>" alt="<?php echo $wr123456['title'];?>" width="237" height="150">
            </a>
            <?php }?>

            <?php if ($wr123456['emission'] == '3') {?>
            <a href="<?php echo $wr123456['link'];?>" class="item3" title="<?=$wr123456['title'];?>" target="_blank">
                <img id="picmt3" onmouseover="showLayer('3','picmt', 7)" src="<?php echo base_url(). str_replace('\\', '/', $wr123456['img_addr']);?>" alt="<?php echo $wr123456['title'];?>" width="237" height="150">
            </a>
            <?php }?>

            <?php if ($wr123456['emission'] == '4') {?>
            <a href="<?php echo $wr123456['link'];?>" class="item4" title="<?=$wr123456['title'];?>" target="_blank">
                <img id="picmt4" onmouseover="showLayer('4','picmt', 7)" src="<?php echo base_url(). str_replace('\\', '/', $wr123456['img_addr']);?>" alt="<?php echo $wr123456['title'];?>" width="237" height="300">
            </a>
            <?php }?>

            <?php if ($wr123456['emission'] == '5') {?>
            <a href="<?php echo $wr123456['link'];?>" class="item5" title="<?=$wr123456['title'];?>" target="_blank">
                <img id="picmt5" onmouseover="showLayer('5','picmt', 7)" src="<?php echo base_url(). str_replace('\\', '/', $wr123456['img_addr']);?>" alt="<?php echo $wr123456['title'];?>" width="237" height="150">
            </a>
            <?php }?>

            <?php if ($wr123456['emission'] == '6') {?>
            <a href="<?=$wr123456['link'];?>" class="item6" title="<?=$wr123456['title'];?>" target="_blank">
                <img id="picmt6" onmouseover="showLayer('6','picmt', 7)" src="<?php echo base_url(). str_replace('\\', '/', $wr123456['img_addr']);?>" alt="<?php echo $wr123456['title'];?>" width="237" height="150">
            </a>
            <?php }?>
            <?php }?>
        </div>
    </div>
    <div class="men-bd pad7">
        <?php foreach ($woman_product_recommend_data as $wprdv) {?>
        <div class="men-bd-b">
            <a class="productimg" href="<?=productURL($wprdv['pid'])?>" title="<?=$wprdv['pname']?>, ￥<?=fPrice($wprdv['sell_price'])?>" target="_blank">
                <img src="<?=config_item('static_url')?>upload/product/<?=str_replace('\\', '/', intToPath($wprdv['pid']))?>default.jpg" width="160" height="192" alt="<?=$wprdv['pname']?>"/>
            </a>
            <div class="pro-n">
                <p><a href="<?=productURL($wprdv['pid'])?>" title="<?=$wprdv['pname']?>, ￥<?=fPrice($wprdv['sell_price'])?>" target="_blank"><?=$wprdv['pname']?></a></p>
                <span class="font4">￥<?=fPrice($wprdv['sell_price'])?></span>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<!--女款T恤end-->

<!-- 情侣推荐 开始 -->
<div class="prod-tit titbg3">
    <div class="prod-t-h h-bg2"></div>
    <div class="prod-n-more">
        <ul>
            <li class="cm"><a href="#" target="_blank">查看更多</a></li>
            <li><a href="#" target="_blank">特卖</a></li>
            <li><a href="#" target="_blank">新品</a></li>
            <li><a href="#" target="_blank">热卖</a></li>
            <li><a href="#" target="_blank">T恤</a></li>
            <li><a href="#" target="_blank">连衣裙</a></li>
            <li><a href="#" target="_blank">半裙</a></li>
            <li><a href="#" target="_blank">衬衫</a></li>
            <li><a href="#" target="_blank">背心/吊带衫</a></li>
            <li><a href="#" target="_blank">小西装</a></li>
            <li><a href="#" target="_blank">裤子</a></li>
            <li><a href="#" target="_blank">薄针织</a></li>
            <li style="background:none;"><a href="#" target="_blank">牛仔裤</a></li>
        </ul>
    </div>
</div>
<div class="prod-bd pad5">
    <div class="sweet">
        <a href="<?=$lover_recommend[0]['link']; ?>" title="<?=$lover_recommend[0]['title']; ?>" target="_blank">
            <img src="<?=str_replace('\\', '/', $lover_recommend[0]['img_addr']);?>" width="948" height="299" alt="<?=$lover_recommend[0]['title'];?>" title="<?=$lover_recommend[0]['title']; ?>"/>
        </a>
    </div>
    <div class="men-bd pad7">
        <?php foreach ($lover_product_recommend_data as $lprdv) {?>
        <div class="men-bd-b">
            <a class="productimg" href="<?=productURL($lprdv['pid'])?>" title="<?=$lprdv['pname']?>, ￥<?=fPrice($lprdv['sell_price'])?>" target="_blank">
            <img src="<?=config_item('static_url')?>upload/product/<?=str_replace('\\', '/', intToPath($lprdv['pid']))?>default.jpg" width="160" height="192" alt="<?=$lprdv['pname']?>"/>
        </a>
            <div class="pro-n">
                <p><a href="<?=productURL($lprdv['pid'])?>" title="<?=$lprdv['pname']?>, ￥<?=fPrice($lprdv['sell_price'])?>" target="_blank"><?=$lprdv['pname']?></a></p>
                <span class="font4">￥<?=fPrice($lprdv['sell_price'])?></span>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<!-- 情侣推荐 结束 -->

<!-- 亲子推荐 开始 -->
<div class="prod-tit titbg4">
    <div class="prod-t-h h-bg3"></div>
    <div class="prod-n-more">
        <ul>
            <li class="cm"><a href="#" target="_blank">查看更多</a></li>
            <li><a href="#" target="_blank">特卖</a></li>
            <li><a href="#" target="_blank">新品</a></li>
            <li><a href="#" target="_blank">热卖</a></li>
            <li><a href="#" target="_blank">T恤</a></li>
            <li><a href="#" target="_blank">连衣裙</a></li>
            <li><a href="#" target="_blank">半裙</a></li>
            <li><a href="#" target="_blank">衬衫</a></li>
            <li><a href="#" target="_blank">背心/吊带衫</a></li>
            <li><a href="#" target="_blank">小西装</a></li>
            <li><a href="#" target="_blank">裤子</a></li>
            <li><a href="#" target="_blank">薄针织</a></li>
            <li style="background:none;"><a href="#" target="_blank">牛仔裤</a></li>

        </ul>
    </div>
</div>
<div class="prod-bd pad6">
    <div class="toplady">
        <div class="floorMain" onmouseout="hideLayer('qz', 8)">
            <?php foreach ($family_recommend as $fr) {?>
            <?php if ($fr['emission'] == '1') {?>
            <a href="<?=$fr['link'];?>" class="qv1" title="<?=$fr['title'];?>" target="_blank">
                <img id="qz1" onmouseover="showLayer('1','qz', 8)" src="<?=base_url().str_replace('\\','/', $fr['img_addr']);?>" alt="<?=$fr['title'];?>" width="264" height="300">
            </a>
            <?php }?>

            <?php if ($fr['emission'] == '2') {?>
            <a href="<?=$fr['link'];?>" class="qv2" title="<?=$fr['title'];?>" target="_blank">
                <img id="qz2" onmouseover="showLayer('2','qz', 8)" src="<?=base_url().str_replace('\\','/', $fr['img_addr']);?>" alt="<?=$fr['title'];?>" width="447" height="220">
            </a>
            <?php }?>

            <?php if ($fr['emission'] == '3') {?>
            <a href="<?=$fr['link'];?>" class="qv3" title="<?=$fr['title'];?>" target="_blank">
                <img id="qz3" onmouseover="showLayer('3','qz', 8)" src="<?=base_url().str_replace('\\','/', $fr['img_addr']);?>" alt="<?=$fr['title'];?>" width="149" height="80">
            </a>
            <?php }?>

            <?php if ($fr['emission'] == '4') {?>
            <a href="<?=$fr['link'];?>" class="qv4" title="<?=$fr['title'];?>" target="_blank">
                <img id="qz4" onmouseover="showLayer('4','qz', 8)" src="<?=base_url().str_replace('\\','/', $fr['img_addr']);?>" alt="<?=$fr['title'];?>" width="149" height="80">
            </a>
            <?php }?>

            <?php if ($fr['emission'] == '5') {?>
            <a href="<?=$fr['link'];?>" class="qv5" title="<?=$fr['title'];?>" target="_blank">
                <img id="qz5" onmouseover="showLayer('5','qz', 8)" src="<?=base_url().str_replace('\\','/', $fr['img_addr']);?>" alt="<?=$fr['title'];?>" width="149" height="80">
            </a>
            <?php }?>

            <?php if ($fr['emission'] == '6') {?>
            <a href="<?=$fr['link'];?>" class="qv6" title="<?=$fr['title'];?>" target="_blank">
                <img id="qz6" onmouseover="showLayer('6','qz', 8)" src="<?=base_url().str_replace('\\','/', $fr['img_addr']);?>" alt="<?=$fr['title'];?>" width="237" height="220">
            </a>
            <?php }?>

            <?php if ($fr['emission'] == '7') {?>
            <a href="<?=$fr['link'];?>" class="qv7" title="<?=$fr['title'];?>" target="_blank">
                <img id="qz7" onmouseover="showLayer('7','qz', 8)" src="<?=base_url().str_replace('\\','/', $fr['img_addr']);?>" alt="<?=$fr['title'];?>" width="237" height="80">
            </a>
            <?php }?>

            <?php }?>
        </div>
    </div>
    <div class="men-bd pad7">
        <?php foreach ($family_product_recommend_data as $fprdv) {?>
        <div class="men-bd-b"><a class="productimg" href="<?=productURL($fprdv['pid']);?>" title="<?=$fprdv['pname'];?>, ￥<?=fPrice($fprdv['sell_price'])?>" target="_blank">
            <img src="<?=config_item('static_url')?>upload/product/<?=str_replace('\\', '/', intToPath($fprdv['pid']))?>default.jpg" width="160" height="192"/>
        </a>
            <div class="pro-n">
                <p><a href="<?=productURL($fprdv['pid']);?>" title="<?=$fprdv['pname'];?>, ￥<?=fPrice($fprdv['sell_price'])?>" target="_blank"><?=$fprdv['pname'];?></a></p>
                <span class="font4">￥<?=fPrice($fprdv['sell_price'])?></span>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<!-- 亲子推荐 结束 -->

<!-- 设计师推荐 开始 -->
<div class="brand">
    <div class="left-brand" onmouseout="hideLayer('bdimg', 13)">
        <ul>
            <?php $i = 1;foreach ($user_recommend as $urv) {?>
            <li>
                <img id="bdimg<?=$i?>" onmouseover="showLayer(<?=$i?>,'bdimg', 13)" src="<?=config_item('static_url')?>upload/designer/<?=str_replace('\\', '/', intToPath($urv['uid']))?>icon.jpg"
                     width="90" height="90" alt="brand1" title="<?=$urv['nickname'];?>" onclick="index.changeUser(<?=$urv['uid']?>)"/>
            </li>
            <?php $i++;}?>
        </ul>
    </div>
    <div class="rgt-p" id="user_product_id">

        <?php foreach ($user_product as $upv) {?>
        <div class="brand-pro">
            <div class="brand-proimg">
                <a href="<?=productURL($upv['pid'])?>" title="<?=$upv['pname'];?>, ￥<?=fPrice($upv['sell_price']);?>" target="_blank">
                <img src="<?=config_item('img_url')?>product/<?=intToPath($upv['pid'])?>default.jpg" width="160" height="186"/>
            </a>
            </div>
            <p><a href="<?=productURL($upv['pid'])?>" title="<?=$upv['pname'];?>, ￥<?=fPrice($upv['sell_price']);?>" target="_blank"><?=$upv['pname'];?></a></p>
            <span class="font4">￥<?=fPrice($upv['sell_price']);?></span></div>
        <?php }?>
        <!--
        <div class="brand-ad">
            <img src="http://wunxin.com/upload/designer/1/1/1/icon.jpg" />

            十字 T恤1十字 T恤2 变个魔术十字 T恤1十字 T恤2 变个十字 T恤1十字 T恤2 变个魔术十字 T恤1十字 T恤2 变个十字 T恤1十字 T恤2 变个魔术十字 T恤1十字 T恤2 变个十字 T恤1十字 T恤2 变个魔术十字 T恤1十

        </div>
         -->
    </div>
</div>
<!-- 设计师推荐 结束 -->
</div>
</div>
</div>
<?php include 'footer.php';?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/user.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/product.js"></SCRIPT>
<script type="text/javascript">
    //转播图 代码开始
    var st = new SlideTrans("idContainer2", "idSlider2", <?php echo count($broadcast_recommend);?>, { Vertical:false });
    var nums = [];
    //插入数字
    for (var i = 0, n = st._count - 1; i <= n;) {
        (nums[i] = get('idNum').appendChild(document.createElement("li"))).innerHTML = ++i;
    }

    forEach(nums, function (o, i) {
        o.onmouseover = function () {
            o.className = "on";
            st.Auto = false;
            st.Run(i);
        }
        o.onmouseout = function () {
            o.className = "";
            st.Auto = true;
            st.Run();
        }
    })

    //设置按钮样式
    st.onStart = function () {
        forEach(nums, function (o, i) {
            o.className = st.Index == i ? "on" : "";
        })
    }
    st.Run();
    //转播图 代码结束


    /*右下角提示框
    artDialog.notice = function (options) {
        var opt = options || {},
            api, aConfig, hide, wrap, top,
            duration = 800;

        var config = {
            id: 'Notice',
            left: '100%',
            top: '100%',
            fixed: true,
            drag: false,
            resize: false,
            follow: null,
            lock: false,
            init: function(here){
                api = this;
                aConfig = api.config;
                wrap = api.DOM.wrap;
                top = parseInt(wrap[0].style.top);
                hide = top + wrap[0].offsetHeight;

                wrap.css('top', hide + 'px')
                    .animate({top: top + 'px'}, duration, function () {
                        opt.init && opt.init.call(api, here);
                    });
            },
            close: function(here){
                wrap.animate({top: hide + 'px'}, duration, function () {
                    opt.close && opt.close.call(this, here);
                    aConfig.close = $.noop;
                    api.close();
                });

                return false;
            }
        };

        for (var i in opt) {
            if (config[i] === undefined) config[i] = opt[i];
        };

        return artDialog(config);
    };

    art.dialog.notice({
        title: false,//'万象网管',
        width: 220,// 必须指定一个像素宽度值或者百分比，否则浏览器窗口改变可能导致artDialog收缩
        content: '尊敬的顾客朋友，您IQ卡余额不足10元，请及时充值',
        icon: 'face-sad',
        time: 50
    });
    //*/
</script>
</body>
</html>