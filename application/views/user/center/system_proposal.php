<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我提供的建议与意见 -- 个人中心</title>
    <link href="/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="/scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="/scripts/iepng.js"></script>
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
                        <td width="8%" align="center">问答时间</td>
                    </tr>
                </table>
            </div>
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">

                <?php if (empty ($data)) {?>
                <tr>
                    <td colspan="7"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">您暂时还没有提供建议与意见，
                        去“<a href="/user/center/systemProposal">提点建议</a>”吧。</td>
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
</script>
<!-- #EndLibraryItem -->
</body>
</html>
