<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的发票 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=config_item('static_url')?>">首页</a></li>
      <li><a href="<?=config_item('static_url')?>user/center/index">个人中心</a></li>
      <li class="last">我的发票</li>
    </ul>
  </div>
</div>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">我的发票</div>
        </div>
        <div class="u-r-box">
            <style> .o-list{font-weight: bold;color: #888888;} table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;} </style>
            <div class="o-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8%" height="26" align="center">发票编号</td>
                        <td width="28%" align="center">发票抬头</td>
                        <td width="8%" align="center">发票内容</td>
                        <td width="10%" align="center">是否为默认</td>
                        <td width="10%" align="center">创建时间</td>
                        <td width="10%" align="center">操作</td>
                    </tr>
                </table>
            </div>
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php if (empty ($data)) {?>
                <td colspan="6" style="text-align: center;font-weight: bold;color: #A10000;" height="50">您暂时没有发票。</td>
                <?php } else {?>
                <?php foreach ($data as $v) {?>
                <tr id="invoice_<?=$v['invoice_id'];?>">
                    <td width="8%" height="26" align="center"><a href="#"><?=$v['invoice_id'];?></a></td>
                    <td width="28%"><?=$v['invoice_payable'];?> </td>
                    <td width="8%" align="center"><?php
                        switch($v['invoice_content']) {
                            case '1': $st = '服装'; break;
                            case '2': $st = '其他'; break;
                            case '3': $st = $v['invoice_content']; break;
                            default: $st = '服装'; break;
                        }
                            echo $st;
                        ?></td>
                    <td width="10%" align="center"><?=$v['default'] == '1' ? '是' : '否';?></td>
                    <td width="10%" align="center"><?=date('Y-m-d', strtotime($v['create_time']));?></td>
                    <td width="10%" align="center">
                        <a href="javascript:void(0);" onclick="deleteInvoice(<?=$v['invoice_id'];?>)">
                            <img src="<?=config_item('static_url')?>images/delete.gif" title="删除此发票">
                        </a>
                    </td>
                </tr>
                <?php }?>
                <?php }?>
                <!--
                <tr>
                    <td colspan="7" align="right">
                        <ul class="ddall">
                            <li>订单总数：<span class="font1">3</span></li>
                            <li>已取消订单数：<span class="font1">0</span></li>
                            <li>已完成订单数：<span class="font1">0</span></li>
                            <li>未付款订单数：<span class="font1">0</span></li>
                            <li>等待付款订单数：<span class="font1">0</span></li>
                        </ul>
                    </td>
                </tr>
                -->
            </table>
        </div>
        <div class="pages" style="float: right;">
        <?=$page_html;?>
        </div>
        <!--
        <div class="u-r-box">
            <div class="tui-tit">为您推荐</div>
            <div class="tui">
                <div class="tuipre"><a href="#"></a></div>
                <div class="tuinext"><a href="#"></a></div>
                <ul>
                    <li><img src="<?=config_item('static_url')?>images/mlf_07.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                    <li><img src="<?=config_item('static_url')?>images/mlf_09.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                    <li><img src="<?=config_item('static_url')?>images/mlf_12.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                    <li><img src="<?=config_item('static_url')?>images/mlf_15.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                    <li><img src="<?=config_item('static_url')?>images/mlf_07.jpg" width="128" height="128"/>

                        <p>[VT]短袖印花T恤 简约大方主义</p>
                        <span class="font2">市场价：￥<span class="font7">189.00</span></span><br/>
                        售价：<span class="font1">￥55.00</span></li>
                </ul>
            </div>
        </div>
        -->
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<script type="text/javascript">
    function deleteInvoice(vId)
    {
        if (confirm('确定删除！')) {
            if (!wx.isEmpty(vId)) {
                return false;
            }

            var url = '/order/orderInvoice/deleteInvoice';
            var param = 'invoice_id='+vId;
            var data = wx.ajax(url, param);

            if (data.error == '30006') {
                wx.pageReload(0);
                return true;
            }

            alert('删除失败!');
        }
        //$('#invoice_'+vId).remove();
    }
</script>
<!-- #EndLibraryItem -->
</body>
</html>

