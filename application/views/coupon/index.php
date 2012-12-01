<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>优惠卷领取 免费领取-- 万象网</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/coupon.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/artdialog.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->

    <style type="text/css">

    </style>
</head>
<body>
<?php include APPPATH.'views/header.php';?>
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=config_item('static_url')?>">首页</a></li>
      <li class="last">优惠卷首页</li>
    </ul>
  </div>
</div>
<div class="wrap">
    <div log="pos=filter" class="filter"><p>
        <span class="label">类别：</span>
        <a <?php if (empty ($model_id)) {echo 'class="on"';}?> target="_self" href="/coupon/">全部</a>
        <span class="filter-content">
            <?php foreach ($card_type as $ctk=>$ctv){ ?>
            <a target="_self" href="<?=config_item('static_url')?>coupon/index/<?=$ctk;?>" <?php if ($model_id == $ctk) {echo 'class="on"';}?>><?=$ctv;?></a>
            <?php }?>
            <!--
            <a target="_self" href="<?=config_item('static_url')?>coupon/index/2" <?php if ($model_id == CARD_SILVER) {echo 'class="on"';}?>>银象券</a>
            <a target="_self" href="<?=config_item('static_url')?>coupon/index/3" <?php if ($model_id == CARD_MILLION) {echo 'class="on"';}?>>万象券</a>
            <a target="_self" href="<?=config_item('static_url')?>coupon/index/3" <?php if ($model_id == CARD_THOUSAND) {echo 'class="on"';}?>>千象券</a>
            -->
        </span></p></div>

    <div class="list-main">
        <div log="pos=list" class="list">
            <?php $num = 0;$i = 0; $count = count($data);foreach ($data as $k=>$v) {?>
            <div class="item">
                <a target="_blank" class="coupon" href="<?=config_item('static_url')?>coupon/show/<?=$v['model_id']?>">
                    <b class="click-fix"></b>
                    <b class="left"><i></i><b class="site"><b class="icon">
                        <?php
                        $images = 'card_gold.jpg';
                        switch($v['card_type']){
                            case CARD_GOLD:$images = 'card_gold.jpg';break;
                            case CARD_SILVER:$images = 'card_silver.jpg';break;
                            case CARD_MILLION:$images = 'card_million.jpg';break;
                            case CARD_THOUSAND:$images = 'card_thousand.jpg';break;
                        }
                        ?>
                        <img src="<?=config_item('static_url')?>images/<?=$images?>"/></b>
                        <b class="name"><?php switch($v['card_type']){
                            case CARD_GOLD:$s = '金象卡';break;
                            case CARD_SILVER:$s = '银象卡';break;
                            case CARD_MILLION:$s = '万象卡';break;
                            case CARD_THOUSAND:$s = '千象卡';break;
                            default:$s = '金象卡';
                            } echo $s;?></b></b></b><b class="right"><b class="nums"><b><?=$v['card_name']?></b></b>
                    <b class="btn"></b><span style="color: red;font-size: 10px;"><?=( ($v['card_num'] - $needReceive) <= 10 ) ? '余量有限，立即抢购！' : '';?></span></b>
                    <b class="shadow-right"></b><b class="shadow-bottom"></b><b class="corner"></b></a>

                <p class="info">有效期至：<?=date('Y-m-d', strtotime($v['end_time']))?><i>|</i><span class="use_area">使用范围：<?=$v['descr']?></span></p></div>
                <?php $i++; $num++; if ($i == 2 || $count == $num) {$i=0; echo '<b class="hr"></b>';}?>
            <?php }?>

            <!--
            <div class="item"><a log="rank=16" class="coupon" href="/coupon/show/637"><b class="click-fix"></b><b
                class="left"><i></i><b class="site"><b class="icon"><img
                src="http://img3.hao123.com/data/fe33bb6877a08a3d1830a68776ac3c58"></b><b class="name">杂良集</b></b></b><b
                class="right"><b class="nums"><b>10</b>元 现金券</b><b class="btn"></b></b><b class="shadow-right"></b><b
                class="shadow-bottom"></b><b class="corner"></b></a>

                <p class="info">有效期至：2012-12-13<i>|</i>使用范围：全场通用</p></div>
            <b class="hr"></b>
            -->
        </div>

        <!--
        <div log="pos=pager" class="pager"><span class="pre">上一页</span><span class="on">1</span><a
            log="number=2&amp;rel=number" target="_self" href="/coupon/all_2">2</a><a log="number=3&amp;rel=number"
                                                                                      target="_self"
                                                                                      href="/coupon/all_3">3</a><a
            log="number=2&amp;rel=next" target="_self" href="/coupon/all_2" class="next">下一页</a></div>
        -->
        <br/>

    </div>
    <div class="sidebar">
        <div class="boxs step"><h3>优惠券领取流程</h3>
            <ul>
                <li class="step1"><b></b>第一步：<span>在此页面领取优惠券</span></li>
                <li class="step2"><b></b>第二步：<span>去挑选商品</span></li>
                <li class="step3"><b></b>第三步：<span>付款时使用优惠券</span></li>
            </ul>
        </div>
        <div log="pos=hot" class="boxs hot"><h3><!--<a class="more" href="/coupon/">更多&gt;&gt;</a>-->热门优惠券</h3>
            <ul>
                <?php $i = 1;foreach ($recommend as $rv){?>
                <li class="<?=($i <= 4) ? 'top3' : '';?>">
                    <a log="rank=<?=$i?>" href="<?=config_item('static_url')?>coupon/show/<?=$rv['model_id'];?>" target="_blank" title="<?=$rv['card_name'];?>">
                        <b><?=($i <= 4) ? $i : $i.'. ';?></b>
                        <span><?=$rv['card_name'];?></span>
                    </a>
                </li>
                <?php $i++;}?>
                <!--
                <li class="top3"><a log="rank=2" href="/coupon/show/619"><b>2</b><span>俏物悄语：满300元减40元</span></a></li>
                <li class="top3"><a log="rank=3" href="/coupon/show/552"><b>3</b><span>校妆网：满150元减20元</span></a></li>
                <li><a log="rank=4" href="/coupon/show/644"><b>&nbsp;4.</b><span>亚马逊中国：满300元减40元</span></a></li>
                <li><a log="rank=5" href="/coupon/show/591"><b>&nbsp;5.</b><span>珂兰钻石：满500元减100元</span></a></li>
                <li><a log="rank=6" href="/coupon/show/623"><b>&nbsp;6.</b><span>米奇网：满100元减10元</span></a></li>
                -->
            </ul>
        </div>
    </div>
</div>



<?php include APPPATH.'views/footer.php';?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>

<script type="text/javascript">
    function receiveCard(id)
    {
        if (!wx.isEmpty(id)) {
            wx.showPop('参数不全！');
            return;
        }

        var url = 'coupon/receive';
        var data = wx.ajax(url, 'id='+id);

        var prompt = '系统繁忙，请稍后再试！';
        switch (data.error) {
            case '0':
                prompt = '领取成功!<br/> 卡号：'+data['card']['card_no']+'<br/>密码：'+data['card']['card_pass'];
                wx.showPop(prompt, 'receive_item_'+id, 86400);
                break;
            case '70029':
                prompt = '参数不全!';
                wx.showPop(prompt, 'receive_item_'+id);
                break;
            case '70030':
                prompt = '已领完!';
                wx.showPop(prompt, 'receive_item_'+id);
                break;
        }


    }
</script>
</body>
</html>