<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>订单详情 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/artdialog.js"></SCRIPT>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style>
        .table3 {border-collapse:collapse;border:0px solid #e6e6e6; margin-bottom:10px;}
        .table3 thead {height:25px;line-height:25px;text-align:left;background:#000;padding:2px 5px; color:#fff;}
        .table3 th {padding:5px; font-weight:normal;}
        .table3 td {border-right:1px solid #e6e6e6;border-bottom:1px solid #e6e6e6;padding:5px; font-weight:normal;}
        .table3 tfoot {text-align:right;}
        .table3 .end{border-right:0px;}

        /*订单详情*/
        .ddxq{width:800px;height:auto;background:url(<?=config_item('static_url')?>images/k_r_m.gif) repeat-y;margin-bottom:10px;float:left;}
        .ddxq .main{width:798px;padding:0px 1px 1px 1px;background:url(<?=config_item('static_url')?>images/k_r_b.gif) no-repeat bottom;float:left;}
        .ddxq .title{width:780px;height:28px;padding:12px 10px 0px 10px;background:url(<?=config_item('static_url')?>images/k_r_tg2.gif) no-repeat top;float:left;}
        .ddxq .title h2{width:175px;height:15px;background:url(<?=config_item('static_url')?>images/z_ddxq.png) no-repeat; text-indent:-999em;float:left;}
        .ddxq .main h2{clear:both;height:21px;line-height:21px;padding-left:23px;background:url(<?=config_item('static_url')?>images/ico_arrow2.gif) no-repeat 5px 5px #efefef;border:1px #e6e6e6 solid;
            font-size:12px;color:#333;font-weight:normal;}
        .ddxq .main .box{padding:10px 20px 20px 20px;}
        .ddxq .main .stat{padding:10px;background:#F8F8F8;border-bottom:1px #e6e6e6 solid;}
        .ddxq .main .stat p{margin:5px 0px;}
        .ddxq .main .info{padding:10px ;}
        .ddxq .main .dd-jd{clear:both;width:552px;height:70px;padding-top:20px;margin:0 auto; position:relative;}
        .ddxq .main .dd-jd-box{width:552px;height:12px;overflow:hidden;background:url(<?=config_item('static_url')?>images/dd_jd.gif) no-repeat 0px 0px;overflow:hidden;}
        .ddxq .main .dd-jd-over{width:552px;height:12px;background:url(<?=config_item('static_url')?>images/dd_jd.gif) no-repeat 0px -12px;}
        .ddxq .main .dd-jd dl{width:150px;color:#999;line-height:15px;position:absolute;top:38px;}
        .ddxq .main .dd-jd dd{padding-left:12px;font-size:10px;}
        .ddxq .main .dd-jd .li-1{left:-20px;}
        .ddxq .main .dd-jd .li-2{left:145px;}
        .ddxq .main .dd-jd .li-3{left:330px;}
        .ddxq .main .dd-jd .li-4{left:515px;}
        .ddxq .main .dd-jd .old dt{color:#e9034e;}
        .ddxq .main .dd-jd .act dt{color:#e9034e;font-weight:bold;}
        .ddxq .main .submit{text-align:right;padding:0px 20px 20px 20px;}
        .stat_cancel { background: url("<?=config_item('static_url')?>images/ico_cancel.gif") no-repeat scroll 0 0 transparent; display: inline-block; height: 22px; line-height: 22px; margin: 5px 0; padding-left: 25px;}
        .btn_bb3 { background: url("<?=config_item('static_url')?>images/btn_pics_b.gif") no-repeat scroll 0 -60px transparent; border: 0 none; color: #666666; cursor: pointer; display: inline-block;
            font-size: 14px; height: 30px; line-height: 30px; text-align: center; width: 92px;}
        .btn_bb2 { background: url("<?=config_item('static_url')?>images/btn_pics_b.gif") no-repeat scroll 0 -30px transparent;border: 0 none; color: #FFFFFF; cursor: pointer; display: inline-block;
            font-size: 14px; height: 30px; line-height: 30px; text-align: center; width: 92px;}

    </style>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=config_item('static_url')?>">首页</a></li>
      <li><a href="<?=config_item('static_url')?>user/center/index">个人中心</a></li>
      <li class="last">订单详情</li>
    </ul>
  </div>
</div>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">订单详情</div>
        </div>
        <!--<div class="u-r-box">-->
        <div class="con-right">

            <!--订单详情开始-->
            <div class="ddxq">
                <div class="main">
                    <div class="stat">
                        <p> 订单编号：<strong><?=$order_data['order_sn']?></strong></p>

                        <p class="f_rz" style="color: #E8044F;">当前状态：
                            <?php
                            $statusNumber = 33.3;
                            switch ($order_data['status']) {
                            	case '0': $st = '订单已取消'; break;
                            	case '1': $st = '订单正常'; break;
                                case '2': $st = '订单已确认'; break;
                            	default :$st = '订单正常';
                            }//var_dump($order_data['is_pay']);
                            switch ($order_data['is_pay']) {
                                case '0': $pt = '等待付款'; break;
                                case '1': $pt = '付款成功'; $statusNumber += 33.3; break;
                                case '2': $pt = '付款失败'; break;
                                case '3': $pt = '等待付款(只支付一部分金额)'; break;
                                default :$pt = '等待付款';
                            }
                            switch ($order_data['picking_status']) {
                                case '0': $pst = '未配货'; break;
                                case '1': $pst = '配货中'; break;
                                case '2': $pst = '配货完成'; $statusNumber += 33.4; break;
                                default :$pst = '';
                            }


                            if ($order_data['status'] == '0') {
                                echo $st;
                                $statusNumber = 0;
                            } elseif ($order_data['is_pay'] != '1') {
                                echo $st.', '.$pt;
                                $statusNumber = 33.3;
                            } elseif ($order_data['picking_status'] != '2') {
                                echo $st.', '.$pt.', '.$pst;
                                $statusNumber = 66.6;
                            } else {
                                echo $st.', '.$pt.', '.$pst;
                            }

                            /**
                            if ($order_data['status'] == '1' && $order_data['is_pay'] == '1' && $order_data['picking_status'] == '2') {
                                $statusNumber = 100;
                            }
                            //*/
                            ?>
                            </p>

                        <p>
                        </p>
                    </div>
                    <div class="info">
                        <div class="dd-jd"> <div class="dd-jd-box">
                            <div style="width:<?=$statusNumber; ?>%;" class="dd-jd-over"></div>
                          </div>
                          <dl class="li-1 <?=($order_data['status'] == ORDER_INVALID) ? '' : 'act';?>">
                              <?php
                              $payStatus = ($order_data['is_pay'] == ORDER_PAY_SUCC) ? 'act' : '';
                              $pickingStatus = ($order_data['picking_status'] == PICKING_COMPLETED) ? 'act' : '';

                                if ($order_data['status'] == ORDER_INVALID) {
                                    $payStatus = '';
                                    $pickingStatus = '';
                                }
                              ?>
                            <dt>1. 提交订单</dt>
                            <dd><?=$order_data['create_time'];?></dd>
                          </dl>
                          <dl class="li-2 <?=$payStatus;?>">
                            <dt>2. 支付状态</dt>
                          </dl>
                          <dl class="li-3 <?=$pickingStatus;?>">
                            <dt>3. 配货状态</dt>
                          </dl>
                          <dl class="li-4 <?=$pickingStatus;?>">
                            <dt>4. 交易完成</dt>
                          </dl>

                        </div>
                        <h2>订单跟踪</h2>

                        <div class="box"> 下单时间：<?=$order_data['create_time'];?>
                        </div>
                        <h2>订单信息</h2>

                        <div class="box"> 收货人：<?=$order_data['recent_name']; ?><br>
                            收货地址：<?=$order_data['recent_address']. ', '.$order_data['zipcode']; ?><br>
                            联系电话：<?=$order_data['phone_num'].', '.$order_data['call_num']; ?>
                        </div>
                        <h2>备注</h2>
                        <div class="box">
                            <?=$order_data['annotated']; ?>
                        </div>
                        <h2>支付及配送方式</h2>

                        <div class="box">
                            支付类型：
                            <?php
                            switch ($order_data['pay_type']) {
                                case PAY_ONLINE: $ptt = '线上支付'; break;
                                case PAY_CASHDELIVERY: $ptt = '货到付款'; break;
                                case PAY_POST: $ptt = '邮局汇款'; break;
                                case PAY_SELF: $ptt = '来万象自提'; break;
                                case PAY_COMPANY: $ptt = '公司转账'; break;
                                default :$ptt = '线上支付';
                            }
                            echo $ptt;?>
                            <br><br>
                            送货上门时间：
                            <?php
                            switch ($order_data['delivert_time']) {
                                case DELIVERT_TIME_ANY: $dtt = '工作日、双休日和节假日均送货'; break;
                                case DELIVERT_TIME_HOLIDAY: $dtt = ' 只双休日、节假日送货（工作时间不送货）'; break;
                                case DELIVERT_TIME_WORK: $dtt = '只工作日送货（双休日、节假日不送）'; break;
                                case DELIVERT_TIME_SCHOOL: $dtt = '学校地址，白天没人'; break;
                                default :$dtt = '工作日、双休日和节假日均送货';
                            }
                            echo $dtt;?>
                        </div>
                        <h2>商品清单</h2>

                        <div class="boxs">
                            <table width="100%" class="table3">
                                <thead>
                                <tr>
                                    <th align="center">商品信息</th>
                                    <th width="90" align="center">单价（元）</th>
                                    <th width="100" align="center"> 赠送积分</th>
                                    <th width="90" align="center">数量</th>
                                    <th width="90" align="center">小计（元）</th>
                                    <th width="90" align="center">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $totalPrice = 0;
                                foreach ($order_product as $pv) {
                                    $totalPrice += ($pv['final_price'] * $pv['product_num']);
                                    ?>
                                <tr>
                                    <td>
                                        <table width="100%" class="tablein">
                                            <tbody>
                                            <tr>
                                                <td style="width:60px;">
                                                    <a href="<?=productURL($pv['pid'])?>" title="<?=$pv['pname']?>, 尺码: <?=$pv['product_size'];?>" target="_blank">
                                                        <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($pv['pid'])?>default.jpg" alt="" width="80" height="96"/>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a title="<?=$pv['pname']?>, 尺码: <?=$pv['product_size'];?>" class="a_e" href="<?=productURL($pv['pid'])?>" target="_blank">
                                                        <?=$pv['pname']?>
                                                    </a><br>
                                                    <span class="f_g">尺码：<?=$pv['product_size'];?></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="90" align="center"><strong>￥<?=fPrice($pv['final_price']);?></strong></td>
                                    <td width="100" align="center"><strong><?=intval(fPrice($pv['final_price']));?></strong></td>
                                    <td width="90" align="center"><strong><?=$pv['product_num'];?></strong></td>
                                    <td width="90" align="center"><strong>￥<?=fPrice(($pv['final_price'] * $pv['product_num']));?></strong></td>
                                    <td width="90" align="center" class="end">
                                        <?php if ($pv['comment_status'] == 0) {?>
                                        <a href="javascript:void(0);" onclick="product.productComment(<?=$pv['pid'];?>, '<?=$order_data['order_sn']?>')">
                                            <img src="<?=config_item('static_url')?>images/comment.gif" title="评价此产品">
                                        </a>
                                        <?php }?>

                                        <?php if ($pv['share_status'] == 0) {?>
                                        <a href="javascript:void(0);" onclick="product.productShare(<?=$pv['pid'];?>, '<?=$order_data['order_sn']?>')">
                                            <img src="<?=config_item('static_url')?>images/share.jpg" title="对此产品进行晒单">
                                        </a><br/>
                                        <?php }?>
                                        <!-- <a href="<?=config_item('static_url')?>user/center/addReturn?pid=<?=$pv['pid'];?>&order_sn=<?=$pv['order_sn'];?>"> -->
                                        <a href="javascript:void(0);" onclick="product.applyReturn(<?=$pv['pid'];?>, <?=$order_data['order_sn']?>)">
                                            <img src="<?=config_item('static_url')?>images/returns.jpg" title="申请此产品退换货">
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="end" colspan="6"> 商品总价： <strong> ¥ <?=fPrice($totalPrice);?>元</strong><br>
                                        运费：+ ¥ 0元<br>
                                        万象币使用：0个<br>
                                        实际应支付：<strong><span class="f_rz">¥ <?=fPrice($totalPrice);?>元</span></strong><br>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="submit">
                        <?php if ($order_data['status'] == ORDER_INVALID) {?>
                            <span class="stat_cancel" style="font-weight: bold;">订单已取消</span>
                        <?php } else {?>
                            <?php if ($order_data['status'] != ORDER_CONFIRM && $order_data['is_pay'] != ORDER_PAY_SUCC && $order_data['picking_status'] == PICKING_NOT) {?>
                            <a class="btn_bb3" onclick="order.cancelOrder(<?=$order_data['order_sn']?>)" href="javascript:void(0);" style="color: #ffffff;font-weight: bold;">取消订单</a>
                            <?php }?>

                            <?php if ($order_data['status'] != ORDER_INVALID && $order_data['is_pay'] != ORDER_PAY_SUCC) {?>
                            <a class="btn_bb2" href="<?=config_item('static_url')?>order/order/success/<?=$order_data['order_sn']?>" style="color: #ffffff;font-weight: bold;">立即付款</a>
                            <?php }?>
                        <?php }?>
                        <br>
                    </div>
                </div>
            </div>

            <div class="clear"></div>
            <!--订单详情结束-->
        </div>
        <!--</div>-->
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/product.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/order.js"></SCRIPT>
<!-- #EndLibraryItem -->
</body>
</html>

