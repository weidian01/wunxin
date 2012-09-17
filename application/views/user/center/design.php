<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的设计图 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery-1.4.2.min.js"></script>
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
            <div class="u-r-tit">我的设计图</div>
        </div>

        <div class="u-r-box">
            <style> .o-list{font-weight: bold;color: #8B7B8B;} table{table-layout: fixed;} td{word-break: break-all; word-wrap:break-word;}</style>
            <div class="o-list">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8%" height="26" align="center">编号</td>
                        <td width="8%" align="center">图片</td>
                        <td width="15%" align="center">设计图名称</td>
                        <td width="25%" align="center">设计图介绍</td>
                        <td width="15%" align="center">人气</td>
                        <td width="8%" align="center">状态</td>
                        <td width="8%" align="center">添加时间</td>
                        <td width="10%" align="center">操作</td>
                    </tr>
                </table>
            </div>
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php if (empty ($data)) {?>
                    <tr>
                        <td colspan="8"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">暂时没有设计图，赶快创建属于自己的设计图吧。</td>
                    </tr>
                <?php } else {?>
                    <?php foreach ($data as $v) {?>
                    <tr>
                        <td width="8%" height="26" align="center"><?php echo $v['did'];?></td>
                        <td width="8%" align="center">
                            <a href="#" title="<?php echo $v['dname'];?>">
                                <img src="<?=config_item('static_url')?>upload/design/<?=intToPath($v['did'])?>icon.jpg" title="<?php echo $v['dname'];?>" width="60" height="72"/></td>
                            </a>
                        <td width="15%" align="center"><a href="#" title="<?=$v['dname']?>"><?=mb_substr($v['dname'], 0, 60, 'utf-8');?></a></td>
                        <td width="25%" align="center"><?php echo $v['ddetail'];?></td>
                        <td width="15%" align="center">
                            <a href="#" title="此设计图被收藏 <?php echo $v['total_fraction'];?> 次" style="color: #990000;font-size: 10px;">被收藏 <?php echo $v['favorite_num'];?> 次</a> <br />
                            <a href="#" title="共有 <?php echo $v['total_num'];?> 用户投票" style="color: #990000;font-size: 10px;">共 <?php echo $v['total_num'];?> 票</a> &nbsp;|&nbsp;
                            <a href="#" title="此设计图总分数为 <?php echo $v['total_fraction'];?> 分" style="color: #990000;font-size: 10px;">共 <?php echo $v['total_num'];?> 分</a>
                        </td>
                        <td width="8%" align="center"><?php echo $v['status'] == 1 ? '正常' : '未激活';?></td>
                        <td width="8%" align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                        <td width="10%" align="center">
                            <!--<a href="javascript:void(0);" onclick="(<?php echo $v['did'];?>)">修改</a>
                            <br/>-->
                            <a href="javascript:void(0);" onclick="deleteDesign(<?php echo $v['did'];?>)">
                                <img src="<?=config_item('static_url')?>images/delete.png" title="删除此设计图">
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
            <div class="tui-tit">推荐设计图</div>

            <div id="pic_list_1" class="scroll_horizontal">
                <div class="box">
                    <ul class="list">
                        <?php foreach ($favorite_recommend as $fv):?>
                        <li>
                            <a href="#" title="<?=$fv['dname']?>">
                                <img src="<?=config_item('static_url')?>upload/design/<?=intToPath($fv['did'])?>default.jpg" width="130" height="156"/>
                            </a>
                            <p><a href="#" title="<?=$fv['dname']?>"><?=mb_substr($fv['dname'], 0, 18, 'utf-8');?></a></p>
                            <span class="font2">设计师：<?php echo substr($fv['uname'], 0, 10);?></span><br/>
                            被收藏数量：<span class="font1"><?php echo $fv['favorite_num'];?></span>
                        </li>
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
    function deleteDesign(dId)
    {
        if (confirm('确定删除！')) {
            if (!wx.isEmpty(dId)) {
                return false;
            }

            var url = '/design/design/deleteDesign';
            var param = 'did='+dId;
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