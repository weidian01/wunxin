<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的礼物卡 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include('/../../header.php');?>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">我的礼物卡<span style="float: right;font-size: 12px;"><a href="/user/center/bingCard">绑定卡</a>&nbsp;&nbsp;&nbsp;</span></div>
        </div>

        <span style="font-size: 12px;"> “我的礼物卡” 中只显示您通过各种渠道或促销活动所获得的万象礼品卡；此礼品卡您需登陆
            <a href="http://www.wunxin.com/" style="color: #A10000;font-weight: bold;">万象网</a> 购物使用，使用成功后即可充抵相应货款。 </span>
        <hr />
        <br />
        <div class="u-r-box">
            <style> .o-list{font-weight: bold;color: #8B7B8B;}table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;}</style>
            <div class="o-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                         <td width="15%" height="26" align="center">卡号</td>
                         <td width="8%" align="center">卡面额</td>
                         <td width="15%" align="center">卡名称</td>
                         <td width="8%" align="center">卡类型</td>
                         <td width="8%" align="center">截止时间</td>
                         <td width="8%" align="center">兑换积分</td>
                         <td width="8%" align="center">使用次数</td>
                         <td width="8%" align="center">生成时间</td>
                         <td width="10%" align="center">操作</td>
                     </tr>
                </table>
            </div>

            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">

                <?php if (empty ($data)) {?>
                <tr>
                    <td colspan="9" style="text-align: center;font-weight: bold;color: #A10000;" height="50">您目前没有礼品卡</td>
                </tr>
                <?php } else {?>
                    <?php foreach ($data as $v) {?>
                    <tr>
                        <td width="15%" height="26" align="center"><?php echo $v['card_no'];?></td>
                        <td width="8%" align="center">￥<?php echo $v['card_amount'] / 100;?></td>
                        <td width="15%" align="center"><?php echo $v['card_name'];?></td>
                        <td width="8%" align="center"><?php echo $v['card_type'];?></td>
                        <td width="8%" align="center"><?php echo date('Y-m-d', strtotime($v['end_time']));?></td>
                        <td width="8%" align="center"><?php echo $v['integral'];?></td>
                        <td width="8%" align="center"><?php echo $v['use_num'];?></td>
                        <td width="8%" align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                        <td width="10%" align="center">
                            <!--<a href="javascript:void(0);" onclick="(<?php echo $v['did'];?>)">修改</a>
                            <br/>-->
                            <a href="javascript:void(0);" onclick="deleteCard('<?php echo $v['card_no'];?>')">
                                <img src="<?=config_item('static_url')?>images/delete.png" title="删除此礼物卡">
                            </a>
                        </td>
                    </tr>
                    <?php }?>
                <?php }?>
            </table>
        </div>
        <div class="pages" style="float: right;">
        <?php echo $page_html;?>
        </div>
        <br /><br />
        <div class="tips">
            <h4 style="color: #707070;"> 我的万象礼品卡 温馨提示： </h4>
            <br />
            <ul>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;1. 单张订单只能使用一张礼品卡；不同的万象礼品卡使用规则不同，请您使用前详细阅读相应礼品卡的使用说明。</li><br />
                <li>&nbsp;&nbsp;&nbsp;&nbsp;2. 请保证您的礼品卡在有效期内使用，过期即作废。</li><br />
                <li>&nbsp;&nbsp;&nbsp;&nbsp;3. 礼品卡不得合并，不设找零，不可兑换现金。</li><br />
                <li>&nbsp;&nbsp;&nbsp;&nbsp;4. 如遇礼品卡使用问题，可直接与万象客户服务中心联系，我们会竭诚为您服务。</li>
            </ul>
        </div>
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<script type="text/javascript">
    function deleteCard(cId)
    {
        if (confirm('确定删除！')) {
            if (!wx.isEmpty(cId)) {
                return false;
            }

            var url = '/business/giftCard/cardDelete';
            var param = 'card_no='+cId;
            var data = wx.ajax(url, param);

            if (data.error == '0') {
                wx.pageReload(0);
                return true;
            }

            alert('删除失败!');
        }
    }
</script>
<!-- #EndLibraryItem -->
</body>
</html>