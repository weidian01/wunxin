<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?=$data['card_name'];?> 优惠卷 -- 万象网</title>
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
      <li class="last">优惠卷领取</li>
    </ul>
  </div>
</div>
<br/>
<div class="wrap">
    <div class="main">
        <div class="boxs"><h3><?=$data['card_name'];?></h3>

            <div log="pos=detail" class="detail">
                <span class="coupon">
                    <b class="left"><i></i>
                        <b class="site">
                            <a log="outsite=1" class="icon" href="http://www.nala.com.cn">
                                <?php
                                $images = 'card_gold.jpg';
                                switch($data['card_type']){
                                    case CARD_GOLD:$images = 'card_gold.jpg';break;
                                    case CARD_SILVER:$images = 'card_silver.jpg';break;
                                    case CARD_MILLION:$images = 'card_million.jpg';break;
                                    case CARD_THOUSAND:$images = 'card_thousand.jpg';break;
                                }
                                ?>
                                <img src="<?=config_item('static_url')?>images/<?=$images?>"/>
                            </a>
                            <a log="outsite=1" class="name" href="javascript:void(0);">
                                <?php
                                switch($data['card_type']){
                                    case CARD_GOLD:$s = '金象卡';break;
                                    case CARD_SILVER:$s = '银象卡';break;
                                    case CARD_MILLION:$s = '万象卡';break;
                                    case CARD_THOUSAND:$s = '千象卡';break;
                                    default:$s = '金象卡';
                                } echo $s;?>
                            </a></b></b><b
                class="right"><b class="nums"><b><?=$data['card_name'];?></b></b></b><b class="shadow-right"></b><b
                class="shadow-bottom"></b><b class="corner"></b></span>

                <div class="info"><p><label>卡&emsp;&emsp;名：</label><?=$data['card_name'];?></p>

                    <p><label>截止日期：</label><?=date('Y-m-d', strtotime($data['end_time']))?></p>

                    <p><label>已&ensp;领&ensp;取：</label><?=$needReceive?>张/共<?=$data['card_num'];?>张</p>

                    <!--<p><label>使用范围：</label>全场通用，除专享价</p>-->

                    <p>
                        <label></label>
                        <?php if ($needReceive >= $data['card_num'] || !empty ($is_receive)){?>
                        <a class="btn-got" href="javascript:void(0);" id="receive_card"></a>
                        <?php } else {?>
                        <a onclick="receiveCard(<?=$data['model_id'];?>, 'receive_card')" class="btn-get" href="javascript:void(0);" id="receive_card"></a>
                        <?php }?>
                        <span id="vcode-warn" class="warn"></span></p></div>
                <div class="clear"></div>
                <hr>
                <div class="remark">
                    <h4>使用方法</h4>
                    <p><?=$data['descr'];?></p>
                    <!--
                    <h4>使用规则</h4>
                    <p>在商品详情页中点击立即购买后，进入结算页面，在该页面中，点击输入优惠券号码按钮。</p>
                    -->
                    </div>
            </div>
        </div>

    </div>
    <div class="sidebar">
        <div log="pos=hot" class="boxs hot"><h3><!--<a class="more" href="/coupon/">更多&gt;&gt;</a>-->热门优惠券</h3>
            <ul>
                <?php $i = 1;foreach ($recommend as $rv){?>
                <li class="<?=($i <= 3) ? 'top3' : '';?>">

                    <a log="rank=<?=$i?>" href="<?=config_item('static_url')?>coupon/show/<?=$rv['model_id'];?>" target="_blank">
                        <b><?=($i <= 3) ? $i : $i.'. ';?></b>
                        <span><?=$rv['card_name'];?></span>
                    </a>
                </li>
                <?php $i++;}?>
                <!--
                <li class="top3"><a log="rank=1" href="/coupon/show/591"><b>1</b><span>珂兰钻石：满500元减100元</span></a></li>
                <li class="top3"><a log="rank=2" href="/coupon/show/652"><b>2</b><span>校妆网：满200元减40元</span></a></li>
                <li class="top3"><a log="rank=3" href="/coupon/show/623"><b>3</b><span>米奇网：满100元减10元</span></a></li>
                <li><a log="rank=4" href="/coupon/show/645"><b>&nbsp;4.</b><span>亚马逊中国：满300元减30元</span></a></li>
                <li><a log="rank=5" href="/coupon/show/644"><b>&nbsp;5.</b><span>亚马逊中国：满300元减40元</span></a></li>
                <li><a log="rank=6" href="/coupon/show/592"><b>&nbsp;6.</b><span>珂兰钻石：满1000元减200元</span></a></li>
                -->
            </ul>
        </div>
    </div>
    <div style="display: none; width: 1903px; height: 871px;" class="popup-mask" id="popup-mask"></div>
    <div style="display: none; top: 100px;" class="popup" id="popup">
        <div class="inner">
            <div class="popup-header"><h3><a onclick="refreshVcode();hidePopup();return false" class="close"
                                             href="#"></a><span id="popup-title">提示</span></h3></div>
            <div class="popup-content" id="popup-content"></div>
        </div>
    </div>
</div>


<?php include APPPATH.'views/footer.php';?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>

<script type="text/javascript">
    function receiveCard(id, bangingId)
    {
        if (!wx.isEmpty(id)) {
            wx.showPop('参数不全！');
            return;
        }

        if (!wx.checkLoginStatus()) {
            return;
        }

        var url = 'coupon/receive';
        var data = wx.ajax(url, 'id='+id);

        var prompt = '系统繁忙，请稍后再试！';
        switch (data.error) {
            case '0':
                prompt = '<h1>领取成功!</h1><br/> <span style="color:#000000;">去</span> "<a href="'+wx.base_url+'user/center/index" target="_blank" style="color:#A10000;">个人中心</a>" - ' +
                    ' "<a href="'+wx.base_url+'user/center/giftCard" target="_blank" style="color:#A10000;">礼品卡管理</a>" <span style="color:#000000;">中查看！</span>';
                wx.showPop(prompt, bangingId, 20);
                $('#receive_card').removeClass().addClass('btn-got');
                $('#receive_card').attr('onclick', '');
                break;
            case '70029':
                prompt = '参数不全!';
                wx.showPop(prompt, bangingId);
                break;
            case '70030':
                prompt = '已领完!';
                wx.showPop(prompt, bangingId);
                break;
            case '10009':
                alert('您未登陆!');
                wx.goToUrl(wx.base_url+'user/login/');
                break;
            case '70002':
                prompt = '绑定卡失败!';
                wx.showPop(prompt, bangingId);
                break;
            case '70032':
                prompt = '已领取过此卡';
                wx.showPop(prompt, bangingId);
                break;
        }
    }
</script>
</body>
</html>