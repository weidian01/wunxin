<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>收货地址管理 -- 个人中心</title>
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
      <li class="last">收货地址管理</li>
    </ul>
  </div>
</div>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit"><span style="float:right;text-align: right;"><a href="<?=config_item('static_url')?>user/center/addRecentAddress" style="color: #8B8878;font-size: 12px;">添加收货地址&nbsp;&nbsp;</a> </span>收货地址管理</div>
        </div>
            <style> .o-list{font-weight: bold;color: #888888;} table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;} </style>
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
                    <td colspan="8"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">没有设置收货地址，点击 “ <a href="<?=config_item('static_url')?>user/center/addRecentAddress"> 创建 </a> ”一个吧。</td>
                </tr>
                <?php } else {?>
                    <?php foreach ($data as $v) {?>
                    <tr id="address_<?=$v['address_id'];?>">
                        <td width="6%" align="center"><?=$v['address_id'];?></td>
                        <td width="6%" align="center"><?=$v['recent_name'];?></td>
                        <td width="18%" align="center"><?=$v['email'];?></td>
                        <td width="7%" align="center"><?=$v['zipcode'];?></td>
                        <td width="10%" align="center"><?=$v['phone_num'];?></td>
                        <td width="10%" align="center"><?=$v['call_num'];?></td>
                        <td width="20%" align="center"><?=$v['province']. ' '. $v['city'] .' '. $v['area']. ' ' . $v['detail_address'];?></td>
                        <td width="5%" align="center"><?=$v['default_address'] == '1' ? '是' : '否';?></td>
                        <td width="6%" align="center">
                            <!--<a href="javascript:void(0);" onclick="(<?=$v['address_id'];?>)">修改</a>
                            <br/>-->
                            <a href="javascript:void(0);" onclick="deleteRecentAddress(<?=$v['address_id'];?>)">
                                <img src="<?=config_item('static_url')?>images/delete.gif" title="删除此地址">
                            </a>
                        </td>
                    </tr>
                    <?php }?>
                <?php }?>
            </table>
        </div>
        <div class="pages" style="float: right;">
        <?=$page_html;?>
        </div>
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
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

