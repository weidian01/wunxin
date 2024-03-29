<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>退换货办理 -- 个人中心</title>
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
        .ucenter_recommend a:hover{border: 1px solid #a10000;}
    </style>
    <link href="<?=config_item('static_url')?>css/scrollshow.css" rel="stylesheet" type="text/css"/>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=config_item('static_url')?>">首页</a></li>
      <li><a href="<?=config_item('static_url')?>user/center/index">个人中心</a></li>
      <li class="last">退换货办理</li>
    </ul>
  </div>
</div>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">退换货记录</div>
        </div>
        <div class="u-r-box">
            <style> .o-list{font-weight: bold;color: #888888;} table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;} </style>
            <div class="o-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="6%" height="26" align="center">编号</td>
                        <td width="8%" align="center">订单号</td>
                        <td width="8%" align="center">退回商品</td>
                        <td width="20%" align="center">产品标题</td>
                        <td width="15%" align="center">办理状态</td>
                        <td width="8%" align="center">办理类型</td>
                        <td width="8%" align="center">办理时间</td>
                        <td width="8%" align="center">操作</td>
                    </tr>
                </table>
            </div>
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">

                <?php if (empty ($data)) {?>
                <tr>
                    <td colspan="8"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">没有退换货记录。</td>
                </tr>
                <?php } else {?>
                    <?php foreach ($data as $v) {?>
                    <tr>
                        <td width="6%" height="26" align="center"><?=$v['return_id'];?></td>
                        <td width="8%" align="center"><?=$v['order_sn'];?></td>
                        <td width="8%" align="center">
                            <a href="<?=productURL($v['pid']);?>" title="<?=$v['pname'].', ￥'.fPrice($v['sell_price']);?>" target="_blank">
                                <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($v['pid'])?>icon.jpg" alt="" width="50" height="50"/>
                            </a>
                            <br />
                            <a href="<?=productURL($v['pid']);?>" title="<?=$v['pname'];?>" target="_blank">￥<?=fPrice($v['sell_price']);?></a>
                        </td>
                        <td width="20%" align="center"><a href="<?=productURL($v['pid']);?>" title="<?=$v['pname'].', ￥'.fPrice($v['sell_price']);?>" target="_blank"><?=$v['pname'];?></a></td>
                        <td width="15%" align="<?=($v['status'] == '2') ? 'center' : 'left';?>">
                            <?php
                                //客服操作 0初始，1协商成功，2协商失败
                            switch ($v['cs_operations']){
                                case '0':$cot = '等待客服确认';break;
                                case '1':$cot = '协商成功';break;
                                case '2':$cot = '协商失败';break;
                                default:$cot = '等待客服确认';
                            }
                            //仓库操作 0初始，1退货的货物 物流配送中，2货物确认成功，3货物确认失败，
                            switch ($v['store_operations']){
                                case '0':$sot = '等待仓库确认';break;
                                case '1':$sot = '物流配送中';break;
                                case '2':$sot = '货物确认成功';break;
                                case '3':$sot = '货物确认失败';break;
                                default:$sot = '等待财务确认';
                            }
                            //财务操作 0初始，1金额已退换
                            switch ($v['financial_operations']){
                                case '0':$fot = '等待财务确认';break;
                                case '1':$fot = '金额已退回';break;
                                default:$fot = '等待财务确认';
                            }
                            //退换货状态 0初始，1处理成功，2取消
                            switch ($v['status']){
                                case '0':$st = '初始状态';break;
                                case '1':$st = '处理成功';break;
                                case '2':$st = '已取消';break;
                                default:$st = '初始状态';
                            }
                                $logisticNum = '';
                                if ($v['store_operations'] == '1') {
                                    $logisticNum = '<span style="font-size:9px;color:#707070;">(物流单号:'.$v['logistic_num'].')</span>';
                                }
                                if ($v['status'] == '2') {
                                    echo $st;
                                } else {
                                    if ($v['type'] == '1') {
                                        echo '1. '.$cot.'<br />2. '.$sot.$logisticNum.'<br />3. '.$fot.'<br />4. '.$st;
                                    } else {
                                        echo '1. '.$cot.'<br />2. '.$sot.$logisticNum.'<br />3. '.$st;
                                    }
                                }
                            ?>
                        </td>
                        <td width="8%" align="center"><?=($v['type'] == '1') ? '退货' : '换货';?></td>
                        <td width="8%" align="center"><?=date('Y-m-d', strtotime($v['create_time']));?></td>
                        <td width="8%" align="center">
                            <?php if ($v['status'] == '2') {?>

                            <?php } else { ?>
                                <a href="javascript:void(0);" onclick="cancelReturn(<?=$v['return_id'];?>)">
                                    <img src="<?=config_item('static_url')?>images/cancel.jpg" title="取消此申请">
                                </a>
                            <?php }?>
                        </td>
                    </tr>
                    <?php }?>
                <?php }?>
            </table>
        </div>
        <div class="pages" style="float: right;">
        <?=$page_html;?>
        </div>

        <div class="u-r-box">
            <div class="tui-tit">热门产品推荐</div>
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
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.jcarousel.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/user_center_broadcast.js"></script>
<script type="text/javascript">
    function cancelReturn(rId)
    {
        if (confirm('确定取消！')) {
            if (!wx.isEmpty(rId)) {
                return false;
            }

            var url = '/order/returns/cancel';
            var param = 'return_id='+rId;
            var data = wx.ajax(url, param);

            if (data.error == '0') {
                wx.pageReload(0);
                return true;
            }

            alert('取消失败!');
        }
    }
</script>

