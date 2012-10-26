<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?=$promotion['name'];?> -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery.lazyload.min.js"> </script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
        body, h1, h2, h3, h4, h5, form, fieldset, ul, li, ol, dl, dd, dt, table, thead, tbody, tr, td, p, input, button, textarea {
            margin: 0;
            padding: 0;
        }
        .link-btn, .clear-tit, .clear-icon, .clear-tab a.tab-in{background:url('/images/clear-bg.png') no-repeat -9999em 0}
        a { color: #666666; text-decoration: none; }
        img { vertical-align: top; }
        fieldset, img { border: 0 none; }
        .content { margin: auto; width: 980px; }
        .clear-top { position: relative; width: 960px; z-index: 1; }
        .mb10 { margin-bottom: 10px; }
        .olist ul { overflow: hidden; }
        ul, li, ol, ol li { list-style-type: none; }
        .olist li.first-li { margin-left: 0; }
        .olist li { display: inline; float: left; height: 280px; position: relative; width: 188px; z-index: 1; }

        .olist li a { display: block; line-height: 0; outline: medium none; }
        .pic-goods { position: relative; z-index: 1; }
        .pic-goods { border: 1px solid #CDCECE; height: 215px; overflow: hidden; width: 186px; }
        .pic-goods, .pic-old-goods, .o-big-pic, .obox-slide ol li { background: url("/images/loading.gif") no-repeat scroll center center transparent; }
        .pic-goods img { margin: -1px 0 0 -1px; }
        .clear-icon { background-position: -200px 0; bottom: 2px; color: #FFFFFF; display: block; font-family: "宋体"; font-weight: bold; height: 27px; line-height: 14px; padding-top: 23px; position: absolute; right: 2px; text-align: center; width: 38px;}
        .olist li p.olist-name { height: 24px; overflow: hidden; width: 186px; }
        .olist li p { font-family: "宋体"; margin-top: 8px; padding-left: 2px;}
        .olist li p a { display: inline; line-height: 24px; }
        .olist li a { outline: medium none; }
        .olist li p { margin-top: 8px; padding-left: 2px; }
        p, dl, multicol { display: block; }
        .olist li del { color: #888888; }
        .price { color: #A10000; font-weight: 700; }
        .olist li { margin: 5px 0 5px 10px; }
        .olist li { display: inline; float: left; height: 280px; position: relative; width: 188px; z-index: 1; }
    </style>
    <script type="text/javascript">

    </script>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<div class="page">
    <div class="content">
        <div class="clear-top mb10">
            <img class="lazy" src="<?=config_item('static_url')?>images/lazy.gif" data-original="<?=config_item('static_url')?>images/banner_special.jpg" alt="广告" width="980px;" height="400px;">
        </div>
        <div id="f0">
            <!--
            <div>
                <img src="http://img.olomo.com/pmimg/1204/17/s_title_men.jpg">
            </div>
            -->
            <br/>

            <?php foreach ($product as $k=>$v){ ?>
            <?php switch ($k){
				case '0': $fileName = 'hightarea';break;
				case '1': $fileName = 'salearea';break;
				case '2': $fileName = 'suitarea';break;
				case '3': $fileName = 'hightarea';break;
				case '4': $fileName = 'salearea';break;
				default:$fileName = 'hightarea';
			}?>
            <div style="width: 980px"><img width="980" height="38" border="0" src="/images/<?=$fileName;?>.jpg" alt=""></div>
            <div id="m" class="olist">
                <ul>
                    <?php $i = 1;foreach ($v['item'] as $ik=>$iv){ ?>
                    <li <?=$i == 0 ? ' class="first-li"' : ''?>>
                        <a href="<?=productURL($iv['pid']);?>" title="<?=$iv['pname']?>" class="pic-goods" target="_blank" style="text-align: center;">
                            <img width="164" height="197" class="lazy" src="<?=config_item('static_url')?>images/lazy.gif" data-original="<?php echo empty ($iv['product_image']) ?
                                config_item('img_url').'product/'.intToPath($iv['pid']).'default.jpg' :
                                config_item('base_url').str_replace('\\', '/', $iv['product_image']);?>" style="display: inline-block;">
                            <span class="clear-icon"><?=round(fPrice($iv['sell_price'] - $iv['promotion_price']), 0);?></span>
                        </a>
                        <p class="olist-name"><a href="<?=productURL($iv['pid']);?>" title="<?=$iv['pname']?>" target="_blank"><?=$iv['pname']?></a></p>
                        <p>
                            <del> 售价:￥<?=fPrice($iv['sell_price'])?></del>
                            <span class="price">特价:￥<?=fPrice($iv['promotion_price'])?></span>
                        </p>
                    </li>
                    <?php $i++;if ($i == 5) $i = 1;};?>
                </ul>
            </div>
            <br/>
            <?php };?>
        </div>
    </div>
</div>
<br/><br/>
<?php include(APPPATH."views/footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/user.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/artdialog.js"></SCRIPT>

<script type="text/javascript">
    $('.page img.lazy').lazyload({effect:"fadeIn"});
</script>
<!-- #EndLibraryItem -->
</body>
</html>

