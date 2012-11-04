<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的订单 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/jcarousel.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
        .path ul li.last { background: none repeat scroll 0 0 transparent; }
        .path, .path ul li { height: 30px; line-height: 30px; background: url(<?=config_item('static_url')?>images/g-bg.png) no-repeat; }
        .path, .path ul li { height: 30px; line-height: 30px; }
        .path { padding-left: 20px; background-position: 0px -179px; }
        .path ul li { float: left; padding-right: 12px; padding-left: 5px; display: block; background-position: right -91px; }
    </style>
    <link href="<?=config_item('static_url')?>css/scrollshow.css" rel="stylesheet" type="text/css"/>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<!-- #EndLibraryItem -->
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=config_item('static_url')?>">首页</a></li>
      <li><a href="<?=config_item('static_url')?>user/center/index">个人中心</a></li>
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
                <?php
                $notPayNum = 0;
                $completedNum = 0;
                $canceledNum = 0;

                if (empty ($data)) {?>
                <td colspan="7" style="text-align: center;font-weight: bold;color: #A10000;" height="50">您暂时没有订单，去选择喜欢的<a href="<?=config_item('static_url')?>">产品</a>吧。</td>
                <?php } else {?>
                <?php
                foreach ($data as $v) {
                    if ($v['is_pay'] != '1') { $notPayNum += 1; }
                    if ($v['picking_status'] == '2') { $completedNum += 1; }
                    if ($v['status'] == '0') { $canceledNum += 1; }
                ?>
                <tr>
                    <td width="15%" align="center"><a href="<?=config_item('static_url')?>user/center/orderDetail/<?php echo $v['order_sn'];?>"><?php echo $v['order_sn'];?></a></td>
                    <td width="35%">
                        <div class="goods-in" style="width: 250px;">
                            <?php
                            if (empty ($v['products'])) $v['products'] = array();
                            foreach ($v['products'] as $pv) {?>
                            <div class="g-i-img" title="<?php echo $pv['pname'].', ￥'.fPrice($pv['sall_price']);?>">
                                <a href="<?=productURL($pv['pid']);?>" target="_blank" title="<?=$pv['pname'].', ￥'.$pv['sall_price'];?>">
                                    <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($pv['pid'])?>icon.jpg" width="50" height="50" title="<?=$pv['pname'].', ￥'.fPrice($pv['sall_price']);?>"/>
                                </a>
                            </div>
                            <?php }?>
                            <!--<div class="scolls"><a href="#"></a></div> -->
                        </div>
                    </td>
                    <td width="8%" align="center"><?php echo $v['recent_name'];?></td>
                    <td width="10%" align="center">￥<?=fPrice($v['after_discount_price']);?><br/>
                        <?php
                        switch($v['pay_type']) {
                            case PAY_ONLINE: $pt = '线上支付'; break;
                            case PAY_CASHDELIVERY: $pt = '货到付款'; break;
                            case PAY_POST: $pt = '邮局汇款'; break;
                            case PAY_SELF: $pt = '来万象自提'; break;
                            case PAY_COMPANY: $pt = '公司转账'; break;
                            default: $pt = '线上支付'; break;
                        };
                        echo $pt;
                        ?>
                    </td>
                    <td width="12%" align="left"><?php
                    switch($v['status']) {
                        case ORDER_INVALID: $st = '订单已取消'; break;
                        case ORDER_NORMAL: $st = '订单正常'; break;
                        case ORDER_CONFIRM: $st = '订单已确认'; break;
                        default: $st = '订单正常'; break;
                    }

                    switch($v['is_pay']) {
                        case ORDER_PAY_INIT: $pt = '等待付款'; break;
                        case ORDER_PAY_SUCC: $pt = '付款成功'; break;
                        case ORDER_PAY_FAIL: $pt = '付款失败'; break;
                        case ORDER_PAY_DEFECT: $pt = '等待付款'; break;
                        default: $pt = '等待付款'; break;
                    }

                    switch($v['picking_status']) {
                        case PICKING_NOT: $pst = '未配货'; break;
                        case PICKING_CONDUCT: $pst = '配货中'; break;
                        case PICKING_COMPLETED: $pst = '配货完成'; break;
                        default: $pst = '未配货'; break;
                    }
                        echo '1. <a href="javascript:void(0);" title="订单状态:'.$st.'">'.$st.'</a><br>';
                        echo '2. <a href="javascript:void(0);" title="支付状态:'.$pt.'">'.$pt.'</a><br>';
                        echo '3. <a href="javascript:void(0);" title="配货状态:'.$pst.'">'.$pst.'</a>';
                    ?>
                    </td>
                    <td width="10%" align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                    <td width="15%" align="center">
                        <a href="<?=config_item('static_url')?>user/center/orderDetail/<?php echo $v['order_sn'];?>" class="views">
                            <img src="<?=config_item('static_url')?>images/view.png" title="查看订单详情">
                        </a>
                        <?php if ($v['is_pay'] != ORDER_PAY_SUCC && $v['status'] != ORDER_INVALID) {?>
                        <a href="<?=config_item('static_url')?>order/order/success/<?php echo $v['order_sn'];?>" class="views">
                            <img src="<?=config_item('static_url')?>images/payment.png" title="订单支付">
                        </a>
                        <?php }?>

                        <?php if ($v['picking_status'] == '2') {?>
                        &nbsp;&nbsp;<a href="<?=config_item('static_url')?>user/center/orderDetail/<?php echo $v['order_sn'];?>">
                            <img src="<?=config_item('static_url')?>images/comment.png" title="评价订单中的产品">
                        </a><br/>
                        <a href="<?=config_item('static_url')?>user/center/orderDetail/<?php echo $v['order_sn'];?>">
                            <img src="<?=config_item('static_url')?>images/share.jpg" title="晒出订单中的产品">
                        </a>&nbsp;&nbsp;
                        <a href="<?=config_item('static_url')?>user/center/orderDetail/<?php echo $v['order_sn'];?>">
                            <img src="<?=config_item('static_url')?>images/returns.jpg" title="申请退换货">
                        </a>
                        <?php }?>
                        <!--<div class="gobuy"><a href="#"></a></div>-->
                    </td>
                </tr>
                <?php }?>
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

                <div id="pic_list_1" class="scroll_horizontal">
                    <div class="box">
                        <ul class="list jcarousel-skin-ucenter" id="user_center_list">
                            <?php foreach ($favorite_recommend as $fv):?>
                            <li>
                                <a href="<?=productURL($fv['pid']);?>" title="<?=$fv['pname'].', ￥'.fPrice($fv['sell_price'])?>" target="_blank">
                                    <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($fv['pid'])?>default.jpg" width="130" height="156"/>
                                </a>

                                <p><a href="<?=productURL($fv['pid']);?>" title="<?=$fv['pname'].', '.fPrice($fv['sell_price'])?>" target="_blank"><?=mb_substr($fv['pname'], 0, 18, 'utf-8');?></a></p>
                                <span class="font2">市场价：￥<span class="font7"><?=fPrice($fv['market_price']);?></span></span><br/>
                                售价：<span class="font1">￥<?=fPrice($fv['sell_price']);?></span></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <!--
                    <div class="plus"></div>
                    <div class="minus"></div>
                    -->
                </div>

        </div>
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<!-- #EndLibraryItem -->
</body>
</html>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.jcarousel.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/user_center_broadcast.js"></script>