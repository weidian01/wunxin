<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>设计师留言 -- 个人中心</title>
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
            <div class="u-r-tit">设计师留言</div>
        </div>
        <div class="u-r-box">
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="o-list">
                    <td width="8%" height="26" align="center">留言编号</td>
                    <td width="8%" align="center">设计师头像</td>
                    <td width="15%" align="center">设计师昵称</td>
                    <td width="8%" align="center">设计师等级</td>
                    <td width="30%" align="center">留言内容</td>
                    <td width="10%" align="center">人气</td>
                    <td width="8%" align="center">留言时间</td>
                    <td width="8%" align="center">操作</td>
                </tr>
                <?php if (empty ($data)) $data = array();
                foreach ($data as $v) {?>
                <tr>
                    <td height="26" align="center"><?php echo $v['message_id'];?></td>
                    <td ><img src="<?=config_item('static_url')?>upload/designer/<?=intToPath($v['be_uid'])?>icon.jpg" alt="" width="60" height="60"/></td>
                    <td align="center"><?php echo $v['nickname'];?></td>
                    <td align="center"><?php echo $v['lid'];?></td>
                    <td align="center"><?php echo $v['content'];?></td>
                    <td align="center">
                        <a href="#" title="此留言被回复 <?php echo $v['reply_num'];?>  条" style="color: #990000;">回复 <?php echo $v['reply_num'];?> 条</a>
                    </td>
                    <td align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                    <td align="center">
                        <a href="javascript:void(0);" onclick="deleteMessageComment(<?php echo $v['message_id'];?>)">删除</a> <br />
                        <a href="javascript:void(0);" onclick="(<?php echo $v['message_id'];?>)">留言</a>
                    </td>
                </tr>
                <?php }?>
            </table>
        </div>
        <div class="pages" style="float: right;">
        <?php echo $page_html;?>
        </div>
        <div class="u-r-box">
            <div class="tui-tit">热度设计师推荐</div>
            <div class="tui">
                <div class="tuipre"><a href="#"></a></div>
                <div class="tuinext"><a href="#"></a></div>
                <ul>
                    <?php foreach ($favorite_recommend as $fv) {?>
                    <li>
                        <img src="<?=config_item('static_url')?>upload/designer/<?=intToPath($fv['uid'])?>icon.jpg" width="128" height="128"/>

                    <p><?php echo $fv['uname'];?></p>
                    <span class="font2">用户等级：<?php echo $fv['lid'];?></span><br/>
                    被收藏数量：<span class="font1"><?php echo $fv['favorite_num'];?></span></li>
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
    function deleteMessageComment(mId)
    {
        if (confirm('确定删除！')) {
            if (!wx.isEmpty(mId)) {
                return false;
            }

            var url = '/user/DesignerComment/deleteDesignerComment';
            var param = 'message_id='+mId;
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

