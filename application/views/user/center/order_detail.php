<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>订单详情 -- 个人中心</title>
    <link href="/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="/scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="/scripts/iepng.js"></script>
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
        .ddxq{width:800px;height:auto;background:url(/images/k_r_m.png) repeat-y;margin-bottom:10px;float:left;}
        .ddxq .main{width:798px;padding:0px 1px 1px 1px;background:url(/images/k_r_b.png) no-repeat bottom;float:left;}
        .ddxq .title{width:780px;height:28px;padding:12px 10px 0px 10px;background:url(/images/k_r_tg2.png) no-repeat top;float:left;}
        .ddxq .title h2{width:175px;height:15px;background:url(/images/z_ddxq.png) no-repeat; text-indent:-999em;float:left;}
        .ddxq .main h2{clear:both;height:21px;line-height:21px;padding-left:23px;background:url(/images/ico_arrow2.png) no-repeat 5px 5px #efefef;border:1px #e6e6e6 solid;
            font-size:12px;color:#333;font-weight:normal;}
        .ddxq .main .box{padding:10px 20px 20px 20px;}
        .ddxq .main .stat{padding:10px;background:#F8F8F8;border-bottom:1px #e6e6e6 solid;}
        .ddxq .main .stat p{margin:5px 0px;}
        .ddxq .main .info{padding:10px ;}
        .ddxq .main .dd-jd{clear:both;width:552px;height:70px;padding-top:20px;margin:0 auto; position:relative;}
        .ddxq .main .dd-jd-box{width:552px;height:12px;overflow:hidden;background:url(/images/dd_jd.png) no-repeat 0px 0px;overflow:hidden;}
        .ddxq .main .dd-jd-over{width:552px;height:12px;background:url(/images/dd_jd.png) no-repeat 0px -12px;}
        .ddxq .main .dd-jd dl{width:150px;color:#999;line-height:15px;position:absolute;top:38px;}
        .ddxq .main .dd-jd dd{padding-left:12px;font-size:10px;}
        .ddxq .main .dd-jd .li-1{left:-20px;}
        .ddxq .main .dd-jd .li-2{left:145px;}
        .ddxq .main .dd-jd .li-3{left:330px;}
        .ddxq .main .dd-jd .li-4{left:515px;}
        .ddxq .main .dd-jd .old dt{color:#e9034e;}
        .ddxq .main .dd-jd .act dt{color:#e9034e;font-weight:bold;}
        .ddxq .main .submit{text-align:right;padding:0px 20px 20px 20px;}
        .stat_cancel { background: url("/images/ico_cancel.png") no-repeat scroll 0 0 transparent; display: inline-block; height: 22px; line-height: 22px; margin: 5px 0; padding-left: 25px;}
        .btn_bb3 { background: url("/images/btn_pics_b.png") no-repeat scroll 0 -60px transparent; border: 0 none; color: #666666; cursor: pointer; display: inline-block;
            font-size: 14px; height: 30px; line-height: 30px; text-align: center; width: 92px;}
        .btn_bb2 { background: url("/images/btn_pics_b.png") no-repeat scroll 0 -30px transparent;border: 0 none; color: #FFFFFF; cursor: pointer; display: inline-block;
            font-size: 14px; height: 30px; line-height: 30px; text-align: center; width: 92px;}

    </style>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include('/../../header.php');?>
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
                        <p> 订单编号：<strong><?php echo $order_data['order_sn']?></strong></p>

                        <p class="f_rz" style="color: #E8044F;">当前状态：
                            <?php
                            $statusNumber = 33.3;
                            switch ($order_data['status']) {
                            	case '0': $st = '订单已取消'; break;
                            	case '1': $st = '订单正常'; break;
                                case '2': $st = '订单已确认'; break;
                            	default :$st = '订单正常';
                            }
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
                            echo $st.', '.$pt.', '.$pst;
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
                            <div style="width:<?php echo $statusNumber; ?>%;" class="dd-jd-over"></div>
                          </div>
                          <dl class="li-1 act">
                            <dt>1. 提交订单</dt>
                            <dd><?php echo $order_data['create_time'];?></dd>
                          </dl>
                          <dl class="li-2 <?php echo ($order_data['status'] == '1') ? 'act' : '';?>">
                            <dt>2. 支付状态</dt>
                          </dl>
                          <dl class="li-3 <?php echo ($order_data['status'] == '1') ? 'act' : '';?>">
                            <dt>3. 配货状态</dt>
                          </dl>
                          <dl class="li-4 <?php echo ($statusNumber == 100) ? 'act' : '';?>">
                            <dt>4. 交易完成</dt>
                          </dl>

                        </div>
                        <h2>订单跟踪</h2>

                        <div class="box"> 下单时间：2012.06.23 19:32:05
                        </div>
                        <h2>订单信息</h2>

                        <div class="box"> 收货人：侯侯侯<br>
                            收货地址：河北省,石家庄市,桥西区，苛械械工要要工工共 人人工，431253<br>
                            联系电话：15115111511,
                        </div>
                        <h2>备注</h2>

                        <div class="box"></div>
                        <h2>支付及配送方式</h2>

                        <div class="box">
                            支付类型：在线支付<br>
                            送货上门时间：只工作日送货（双休日、节假日不用送）
                        </div>
                        <h2>商品清单</h2>

                        <div class="boxs">
                            <table width="100%" class="table3">
                                <thead>
                                <tr>
                                    <th align="center">商品信息</th>
                                    <th width="90" align="center">单价（元）</th>
                                    <th width="100" align="center">返YOHO币 <a title="什么是YOHO币" target="_blank"
                                                                             href="#"><img
                                        src="http://static.yohobuy.com/images/ico_help_3.png"></a></th>
                                    <th width="90" align="center">数量</th>
                                    <th width="90" align="center">小计（元）</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <table width="100%" class="tablein">
                                            <tbody>
                                            <tr>
                                                <td style="width:60px;"><img
                                                    src="http://img01.static.yohobuy.com/thumb/2012/06/15/11/01482239214ed92ba048df96b605660f3200600060.jpg">
                                                </td>
                                                <td><a title="VISIBLE  简约款亨利领短袖TEE白 " class="a_e"
                                                       href="/product/pro_19910_28559/VISIBLEVSB2012015TXu.html">VISIBLE
                                                    简约款亨利领短袖TEE白 </a><br>
                                                    <span class="f_g">颜色：白    尺码：M</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="90" align="center"><strong>168.00</strong></td>
                                    <td width="100" align="center"><strong>0</strong></td>
                                    <td width="90" align="center"><strong>1</strong></td>
                                    <td width="90" align="center" class="end"><strong>168</strong></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" class="tablein">
                                            <tbody>
                                            <tr>
                                                <td style="width:60px;"><img
                                                    src="http://img01.static.yohobuy.com/thumb/2012/06/12/09/01e21150dcdc24dc6005059857719b3de700600060.jpg">
                                                </td>
                                                <td><a title="corade 僵尸粽子袋红 " class="a_e"
                                                       href="/product/pro_19768_28336/CORADEJiangShiZongZiDai.html">corade
                                                    僵尸粽子袋红 </a><br>
                                                    <span class="f_g">颜色：红    尺码：F</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="90" align="center"><strong>0.00</strong></td>
                                    <td width="100" align="center"><strong>0</strong></td>
                                    <td width="90" align="center"><strong>1</strong></td>
                                    <td width="90" align="center" class="end"><strong>0</strong></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="end" colspan="5"> 商品总价： <strong> ¥ 168元</strong><br>
                                        运费：+ ¥ 10.00元<br>
                                        YOHO币使用：0个<br>
                                        实际应支付：<strong><span class="f_rz">¥ 178.00元</span></strong><br>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="submit">
                        <a class="btn_bb3" onclick=" if( confirm( '您确定要取消订单吗?' ) ) { return true ; } else { return false ; } " href="/home/orders/cancel?order_code=2071112972">取消订单</a>
                        <a class="btn_bb2" href="/shopping/pay?ordercode=2071112972">立即付款</a>

                        <br>

                        <span class="stat_cancel">订单已取消</span>
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
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="/scripts/common.js"></SCRIPT>
<!-- #EndLibraryItem -->
</body>
</html>

