<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的订单 -- 个人中心</title>
    <link href="/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="/scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="/scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
        .path ul li.last { background: none repeat scroll 0 0 transparent; }
        .path, .path ul li { height: 30px; line-height: 30px; background: url(/images/g-bg.png) no-repeat; }
        .path, .path ul li { height: 30px; line-height: 30px; }
        .path { padding-left: 20px; background-position: 0px -179px; }
        .path ul li { float: left; padding-right: 12px; padding-left: 5px; display: block; background-position: right -91px; }
    </style>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<a href="javascript:void(0);" onclick="wx.qaReply(4, 'test content')">aaaaa</a>
<?php include('/../../header.php');?>
<!-- #EndLibraryItem -->
<div class="box">
  <div class="path">
    <ul>
      <li><a href="#">首页</a></li>
      <li><a href="/user/center/index">个人中心</a></li>
      <li class="last">订单列表</li>
    </ul>
  </div>
</div>
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">订单中心</div>
        </div>
        <div class="u-r-box">
            <style> .o-list{font-weight: bold;color: #8B7B8B;} table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;} </style>
            <div class="o-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr class="o-list">
                        <td width="15%" height="26" align="center">订单号</td>
                        <td width="35%" align="center">订单商品 </td>
                        <td width="8%" align="center">收货人</td>
                        <td width="10%" align="center">订单金额</td>
                        <td width="12%" align="center">订单状态</td>
                        <td width="10%" align="center">下单时间</td>
                        <td width="15%" align="center">操作</td>
                    </tr>
                </table>
            </div>
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php if (empty ($data)) $data = array();
                $notPayNum = 0;
                $completedNum = 0;
                $canceledNum = 0;
                foreach ($data as $v) {
                    if ($v['is_pay'] != '1') { $notPayNum += 1; }
                    if ($v['picking_status'] == '2') { $completedNum += 1; }
                    if ($v['status'] == '0') { $canceledNum += 1; }
                ?>
                <tr>
                    <td width="15%" align="center"><a href="/user/center/orderDetail/<?php echo $v['order_sn'];?>"><?php echo $v['order_sn'];?></a></td>
                    <td width="35%">
                        <div class="goods-in" style="width: 250px;">
                            <?php
                            if (empty ($v['products'])) $v['products'] = array();
                            foreach ($v['products'] as $pv) {?>
                            <div class="g-i-img" title="<?php echo $pv['pname'];?>">
                                <a href="#">
                                    <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($pv['pid'])?>icon.jpg" width="45" height="45" title="<?php echo $pv['pname'];?>"/>
                                </a>
                            </div>
                            <?php }?>
                            <!--<div class="scolls"><a href="#"></a></div> -->
                        </div>
                    </td>
                    <td width="8%" align="center"><?php echo $v['recent_name'];?></td>
                    <td width="10%" align="center">￥<?php echo $v['after_discount_price'] / 100;?><br/>
                        <?php
                        switch($v['pay_type']) {
                            case '1': $pt = '线上支付'; break;
                            case '2': $pt = '货到付款'; break;
                            case '3': $pt = '邮局汇款'; break;
                            case '4': $pt = '来万象自提'; break;
                            case '5': $pt = '公司转账'; break;
                            default: $pt = '线上支付'; break;
                        };
                        echo $pt;
                        ?>
                    </td>
                    <td width="12%" align="left"><?php
                    switch($v['status']) {
                        case '0': $st = '订单已取消'; break;
                        case '1': $st = '订单正常'; break;
                        case '2': $st = '订单已确认'; break;
                        default: $st = '订单正常'; break;
                    }

                    switch($v['is_pay']) {
                        case '0': $pt = '等待付款'; break;
                        case '1': $pt = '付款成功'; break;
                        case '2': $pt = '付款失败'; break;
                        case '3': $pt = '等待付款'; break;
                        default: $pt = '等待付款'; break;
                    }


                    switch($v['picking_status']) {
                        case '0': $pst = '未配货'; break;
                        case '1': $pst = '配货中'; break;
                        case '2': $pst = '配货完成'; break;
                        default: $pst = '未配货'; break;
                    }
                        echo '1. <a href="#" title="订单状态:'.$st.'">'.$st.'</a><br>';
                        echo '2. <a href="#" title="支付状态:'.$pt.'">'.$pt.'</a><br>';
                        echo '3. <a href="#" title="配货状态:'.$pst.'">'.$pst.'</a>';
                    ?>
                    </td>
                    <td width="10%" align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                    <td width="15%" align="center">
                        <a href="/user/center/orderDetail/<?php echo $v['order_sn'];?>">
                            <img src="<?=config_item('static_url')?>images/view.png" title="查看订单详情">
                        </a>
                        <?php if ($v['picking_status'] == '2') {?>
                        &nbsp;&nbsp;<a href="/user/center/orderDetail/<?php echo $v['order_sn'];?>"><img src="<?=config_item('static_url')?>images/comment.png" title="评价订单中的产品"></a><br/>
                        <a href="/user/center/orderDetail/<?php echo $v['order_sn'];?>"><img src="<?=config_item('static_url')?>images/share.jpg" title="晒出订单中的产品"></a>
                        &nbsp;&nbsp;<a href="/user/center/orderDetail/<?php echo $v['order_sn'];?>"><img src="<?=config_item('static_url')?>images/returns.jpg" title="申请退换货"></a>
                        <?php }?>
                        <!--<div class="gobuy"><a href="#"></a></div>-->
                    </td>
                </tr>
                    <?php }?>
                <tr>
                    <td colspan="7" align="right">
                        <ul class="ddall">
                            <li>订单总数：<span class="font1"><?php echo $total_num; ?></span></li>
                            <li>已取消订单数：<span class="font1"><?php echo $canceledNum;?></span></li>
                            <li>已完成订单数：<span class="font1"><?php echo $completedNum;?></span></li>
                            <li>未付款订单数：<span class="font1"><?php echo $notPayNum;?></span></li>
                            <!--<li>等待付款订单数：<span class="font1">0</span></li>-->
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
        <div class="pages" style="float: right;">
                <?php echo $page_html; ?>
            </div>
        <div class="u-r-box">
            <div class="tui-tit">为您推荐</div>
            <div class="tui">
                <div class="tuipre"><a href="#"></a></div>
                <div class="tuinext"><a href="#"></a></div>
                <ul>
                    <?php foreach ($favorite_recommend as $fv) {?>
                    <li>
                        <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($fv['pid'])?>default.jpg" width="128" height="128"/>

                        <p><?php echo $fv['pname'];?></p>
                        <span class="font2">市场价：￥<span class="font7"><?php echo $fv['market_price'] / 100;?></span></span><br/>
                        售价：<span class="font1">￥<?php echo $fv['sell_price'] / 100;?></span></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="/scripts/common.js"></SCRIPT>
<!-- #EndLibraryItem -->
</body>
</html>

