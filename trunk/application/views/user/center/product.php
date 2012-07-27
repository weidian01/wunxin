<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的产品 -- 个人中心</title>
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
            <div class="u-r-tit">我的产品</div>
        </div>

        <div class="u-r-box">
            <style> .o-list{font-weight: bold;color: #8B7B8B;} table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;} </style>
            <div class="o-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8%" height="26" align="center">编号</td>
                        <td width="8%" align="center">图片</td>
                        <td width="25%" align="center">产品名称</td>
                        <td width="8%" align="center">价格</td>
                        <td width="8%" align="center">销量</td>
                        <td width="8%" align="center">状态</td>
                        <td width="10%" align="center">人气</td>
                        <td width="8%" align="center">添加时间</td>
                        <td width="10%" align="center">操作</td>
                    </tr>
                </table>
            </div>

            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php if (empty ($data)) {?>
                    <tr>
                        <td colspan="9"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">暂时没有产品，赶快创建属于自己的产品吧。</td>
                    </tr>
                <?php } else {?>
                    <?php foreach ($data as $v) {?>
                    <tr>
                        <td width="8%" height="26" align="center"><?php echo $v['pid'];?></td>
                        <td width="8%" align="center">
                            <a href="#">
                                <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($v['pid'])?>icon.jpg" alt="" width="60" height="60"/>
                            </a>
                        </td>
                        <td width="25%" align="center"><a href="#" title="<?php echo $v['pname'];?>"><?php echo $v['pname'];?></a></td>
                        <td width="8%" align="center">￥<?php echo $v['market_price'] / 100;?></td>
                        <td width="8%" align="center"><?php echo $v['sales'];?></td>
                        <td width="8%" align="center">
                            <a href="#" title="产品<?php echo $v['shelves'] == '1' ? '上架' : '已下架';?>"><?php echo $v['shelves'] == '1' ? '上架' : '已下架';?></a><br/>
                            <a href="#" title="产品审核<?php echo $v['check_status'] == '1' ? '通过' : '未通过';?>"><?php echo $v['check_status'] == '1' ? '通过' : '未通过';?></a>
                        </td>
                        <td width="10%" align="center">
                            <a href="#" title="共被评论 <?php echo $v['comment_num'];?> 次">评论 <?php echo $v['comment_num'];?> 条</a><br/>
                            <a href="#" title="共被收藏 <?php echo $v['favorite_num'];?> 次">收藏 <?php echo $v['favorite_num'];?> 次</a>
                        </td>
                        <td width="8%" align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                        <td width="10%" align="center">
                            <!--<a href="javascript:void(0);" onclick="(<?php echo $v['pid'];?>)">修改</a>
                            <br/>-->
                            <a href="javascript:void(0);" onclick="deleteProduct(<?php echo $v['pid'];?>)">
                                <img src="<?=config_item('static_url')?>images/delete.png" title="删除此产品">
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

        <div class="u-r-box">
            <div class="tui-tit">产品推荐</div>
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
    function deleteProduct(pId)
    {
        if (confirm('确定删除！')) {
            if (!wx.isEmpty(pId)) {
                return false;
            }

            var url = '/product/product/deleteProduct';
            var param = 'pid='+pId;
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

