<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我提供的建议与意见 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <link href="<?=config_item('static_url')?>css/scrollshow.css" rel="stylesheet" type="text/css"/>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">我的建议与意见</div>
        </div>
        <div class="u-r-box">
            <style> .o-list{font-weight: bold;color: #8B7B8B;} table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;} </style>
            <div class="o-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="6%" height="26" align="center">编号</td>
                        <td width="8%" align="center">标题</td>
                        <td width="20%" align="center">内容</td>
                        <td width="8%" align="center">姓名</td>
                        <td width="20%" align="center">电话</td>
                        <td width="15%" align="center">邮件地址</td>
                        <td width="8%" align="center">创建时间</td>
                    </tr>
                </table>
            </div>
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">

                <?php if (empty ($data)) {?>
                <tr>
                    <td colspan="7"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">您暂时还没有提供建议与意见，
                        去“<a href="<?=config_item('static_url')?>user/center/systemProposal">提点建议</a>”吧。</td>
                </tr>
                <?php } else {?>
                    <?php foreach ($data as $v) {?>
                    <tr>
                        <td width="6%" height="26" align="center"><?php echo $v['id'];?></td>
                        <td width="8%" align="center"><?php echo $v['title'];?></td>
                        <td width="20%" align="center"><?php echo $v['content'];?></td>
                        <td width="8%" align="center"><?php echo $v['realname'];?></td>
                        <td width="20%" align="left"><?php echo $v['telecall'];?></td>
                        <td width="15%" align="center"><?php echo $v['email'];?></td>
                        <td width="8%" align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>

                    </tr>
                    <?php }?>
                <?php }?>
            </table>
        </div>
        <div class="pages" style="float: right;">
        <?php echo $page_html;?>
        </div>
        <br/><br/><br/><br/>
        <div class="u-r-box">
            <div class="tui-tit">热闹产品推荐</div>
            <div id="pic_list_1" class="scroll_horizontal">
                <div class="box">
                    <ul class="list">
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
                <div class="plus"></div>
                <div class="minus"></div>
            </div>
        </div>

    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.scrollshow.js"></SCRIPT>
<script type="text/javascript">
    function deleteProductQa(qId)
    {
        if (confirm('确定删除！')) {
            if (!wx.isEmpty(qId)) {
                return false;
            }

            var url = '/product/product_qa/deleteProductQa';
            var param = 'qa_id='+qId;
            var data = wx.ajax(url, param);

            if (data.error == '0') {
                wx.pageReload(0);
                return true;
            }

            alert('删除失败!');
        }
    }
    $(function () {
            $("#pic_list_1").scrollShow("right",{step:5, time:5000, num:5, boxHeight:220});
    });
</script>
<!-- #EndLibraryItem -->
</body>
</html>

