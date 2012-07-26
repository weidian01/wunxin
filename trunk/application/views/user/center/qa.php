<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>产品问答 -- 个人中心</title>
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
            <div class="u-r-tit">产品问答</div>
        </div>
        <div class="u-r-box">
            <style>
                .o-list{font-weight: bold;}
            </style>
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="o-list">
                    <td width="6%" height="26" align="center">编号</td>
                    <td width="8%" align="center">产品图片</td>
                    <td width="20%" align="center">产品标题</td>
                    <td width="8%" align="center">产品价格</td>
                    <td width="20%" align="center">问答内容</td>
                    <td width="15%" align="center">人气</td>
                    <td width="8%" align="center">问答时间</td>
                    <td width="8%" align="center">操作</td>
                </tr>
                <?php if (empty ($data)) $data = array();
                foreach ($data as $v) {?>
                <tr>
                    <td height="26" align="center"><?php echo $v['qa_id'];?></td>
                    <td align="center"><img src="<?=config_item('static_url')?>upload/product/<?=intToPath($v['pid'])?>icon.jpg" alt="" width="60" height="60"/></td>
                    <td align="center"><?php echo $v['pname'];?></td>
                    <td align="center">￥<?php echo $v['sell_price'] / 100;?></td>
                    <td align="left">
                        <b>问：</b><?php echo $v['qa_content'];?> <br />
                        <b>答：</b><?php echo $v['reply_content'];?> <span style="font-size: 10px;"> <?php echo date('m-d H:i:s', strtotime($v['reply_time']));?></span>
                    </td>
                    <td align="center">
                        <a href="#" title="共被回复 <?php echo $v['reply_num'];?> 条" style="color: #990000;font-size: 10px;">被回复 <?php echo $v['reply_num'];?> 条</a><br />

                        <a href="#" title="共有 <?php echo $v['is_valid'];?> 条有用" style="color: #990000;font-size: 10px;">有效 <?php echo $v['is_valid'];?> 条</a>&nbsp;|&nbsp;
                        <a href="#" title="共有 <?php echo $v['is_invalid'];?> 条有用" style="color: #990000;font-size: 10px;">无效 <?php echo $v['is_invalid'];?> 条</a>
                    </td>
                    <td align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                    <td align="center">
                        <a href="javascript:void(0);" onclick="deleteProductQa(<?php echo $v['qa_id'];?>)">删除</a> <br />
                        <a href="javascript:void(0);" onclick="(<?php echo $v['qa_id'];?>)">购买</a>
                    </td>
                </tr>
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
        <?php echo $page_html;?>
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
                    <!--
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
                        -->
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

