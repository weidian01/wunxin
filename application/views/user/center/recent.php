<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>收货地址管理 -- 个人中心</title>
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
            <div class="u-r-tit">收货地址管理<span style="float:right;text-align: right;"><a href="/user/center/addRecentAddress" style="color: #8B8878;font-size: 12px;">添加收货地址&nbsp;&nbsp;</a> </span></div>
        </div>
            <style> .o-list{font-weight: bold;color: #8B7B8B;} table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;} </style>
            <div class="o-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="6%" height="26" align="center">编号</td>
                        <td width="6%" align="center">收货人</td>
                        <td width="18%" align="center">邮件地址</td>
                        <td width="7%" align="center">邮政编码</td>
                        <td width="10%" align="center">手机号码</td>
                        <td width="10%" align="center">座机</td>
                        <td width="20%" align="center">详细地址</td>
                        <td width="5%" align="center">默认</td>
                        <td width="6%" align="center">操作</td>
                    </tr>
                </table>
            </div>
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php if (empty ($data)) { ?>
                <tr>
                    <td colspan="8"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">没有设置收货地址，点击 “ <a href="/user/center/addRecentAddress"> 创建 </a> ”一个吧。</td>
                </tr>
                <?php } else {?>
                    <?php foreach ($data as $v) {?>
                    <tr id="address_<?php echo $v['address_id'];?>">
                        <td width="6%" align="center"><?php echo $v['address_id'];?></td>
                        <td width="6%" align="center"><?php echo $v['recent_name'];?></td>
                        <td width="18%" align="center"><?php echo $v['email'];?></td>
                        <td width="7%" align="center"><?php echo $v['zipcode'];?></td>
                        <td width="10%" align="center"><?php echo $v['phone_num'];?></td>
                        <td width="10%" align="center"><?php echo $v['call_num'];?></td>
                        <td width="20%" align="center"><?php echo $v['province']. ' '. $v['city'] .' '. $v['area']. ' ' . $v['detail_address'];?></td>
                        <td width="5%" align="center"><?php echo $v['default_address'] == '1' ? '是' : '否';?></td>
                        <td width="6%" align="center">
                            <!--<a href="javascript:void(0);" onclick="(<?php echo $v['address_id'];?>)">修改</a>
                            <br/>-->
                            <a href="javascript:void(0);" onclick="deleteRecentAddress(<?php echo $v['address_id'];?>)">
                                <img src="<?=config_item('static_url')?>images/delete.png" title="删除此地址">
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
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="/scripts/common.js"></SCRIPT>
<script type="text/javascript">
    function deleteRecentAddress(aId)
    {
        if (confirm('确定删除！')) {
            if (!wx.isEmpty(aId)) {
                return false;
            }

            var url = '/user/userRecent/deleteRecentAddress';
            var param = 'address_id='+aId;
            var data = wx.ajax(url, param);

            if (data.error == '10032') {
                //$('#address_'+aId).remove();
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

