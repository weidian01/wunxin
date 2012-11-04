<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>设计师留言 -- 我的评论</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/jcarousel.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <link href="<?=config_item('static_url')?>css/scj.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/scrollshow.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/artdialog.js"></script>
<!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">设计师留言</div>
        </div>
        <div class="u-r-box">
            <div class="scj">
                <div class="main">
                    <div class="tab">
                        <a href="<?=config_item('static_url')?>user/center/productComment">产品评论</a>
                        <a href="<?=config_item('static_url')?>user/center/designComment">设计图评论</a>
                        <a href="<?=config_item('static_url')?>user/center/designerComment" class="act">设计师留言</a>
                    </div>
                    <div id="itemList">
                        <div class="list-m">
                                <table width="100%" class="table2">
                                    <thead>
                                    <tr>
                                        <!--<td align="center" style="text-align:center;"><b style="color: #8B8378;">收藏编号</b></td>-->
                                        <th colspan="2" align="left"><b style="color: #8B8378;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;设计师信息</b></th>
                                        <td align="center" style="text-align:center;"><b style="color: #8B8378;">积分</b></td>
                                        <td align="center" style="text-align:center;"><b style="color: #8B8378;">留言标题</b></td>
                                        <td align="center" style="text-align:center;"><b style="color: #8B8378;">留言内容</b></td>
                                        <th align="center" style="text-align:center;"><b style="color: #8B8378;">人气</b></th>
                                        <td align="center" style="text-align:center;"><b style="color: #8B8378;">评论时间</b></td>
                                        <th align="center" style="text-align:center;"><b style="color: #8B8378;">操作</b></th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody">
                                    <?php if (empty ($data)) { ?>
                                    <tr>
                                        <td colspan="7"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">您还没有给设计师留言，去跟您喜欢的设计师交流想法吧。</td>
                                    </tr>
                                    <?php } else {?>
                                        <?php foreach ($data as $v) {?>
                                        <tr>
                                            <!--<td style="width:90px;text-align:center;"><?php echo $v['id'];?></td>-->
                                            <td style="width:60px;">
                                                <div class="imgbox">
                                                    <a href="#" class="a_e" title="<?php echo $v['nickname'];?>">
                                                        <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($v['uid'])?>default.jpg" alt="" width="90" height="90" title="<?php echo $v['nickname'];?>"/>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="a_e" title="<?php echo $v['nickname'];?>"><?php echo $v['uname'];?></a>&nbsp;&nbsp;<br>
                                                <span title="设计师等级：<?php echo $v['lid'];?>">等级：<?php echo $v['lid'];?></span>
                                            </td>
                                            <td style="width:80px;text-align:center;"><?php echo $v['integral'];?></td>
                                            <td style="width:80px;text-align:center;"><?php echo $v['title'];?></td>
                                            <td style="width:160px;text-align:center;"><?php echo $v['content'];?></td>
                                            <td style="width:90px;text-align:left;">
                                                &nbsp;&nbsp;<a href="#" title="此留言被回复 <?php echo $v['reply_num'];?>  条" style="color: #990000;font-size: 10px;">回复 <?php echo $v['reply_num'];?> 条</a><br /><br />
                                                &nbsp;&nbsp;<a href="#" title="此设计师被收藏 <?php echo $v['favorite_num'];?>  条" style="color: #990000;font-size: 10px;">收藏 <?php echo $v['favorite_num'];?> 条</a>
                                            </td>
                                            <td style="width:60px;text-align:center;"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                                            <td style="width:70px;text-align:center;">
                                                <a href="javascript:void(0);" onclick="(<?php echo $v['message_id'];?>)" style="cursor:pointer;color:#468fa2;" title="查看此设计师">
                                                    <img src="<?=config_item('static_url')?>images/view.png" title="查看此设计师">
                                                </a>  <br />
                                                <a href="javascript:void(0);" onclick="(<?php echo $v['message_id'];?>)" style="cursor:pointer;color:#468fa2;" title="给此设计师留言">
                                                    <img src="<?=config_item('static_url')?>images/message.png" title="给此设计师留言">
                                                </a>  <br />
                                                <a href="javascript:void(0);" onclick="user.deleteDesignerMessage(<?php echo $v['message_id'];?>)" style="cursor:pointer;color:#468fa2;" title="删除此条留言">
                                                    <img src="<?=config_item('static_url')?>images/delete.png" title="删除此条留言">
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    <?php }?>
                                    </tbody>
                                    <tfoot>
                                    <tr id="listFooter">
                                        <!--
                                        <th colspan="8" align="right">
                                            <button type="button" class="btn_s1_z7" onclick="emptyFavorite('cleanup','您确定要清空收藏夹里的所有产品')"> 清空所有产品 </button>
                                        </th>-->
                                    </tr>
                                    </tfoot>
                                </table>
                        </div>
                        <div class="list-b">

                            <div class="pages" style="float: right;">
                            <?php echo $page_html;?><span class="page"> 共<?php echo $total_num;?>条结果<!--，1/1页--></span>
                            </div>

                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="u-r-box">
            <div class="tui-tit">设计师推荐</div>
            <div id="pic_list_1" class="scroll_horizontal">
                <div class="box">
                    <ul class="list jcarousel-skin-user" id="u_center_list">
                        <?php foreach ($favorite_recommend as $fv):?>
                        <li>
                            <a href="#" title="<?=$fv['uname']?>">
                                <img src="<?=config_item('static_url')?>upload/designer/<?=intToPath($fv['uid'])?>default.jpg" width="90" height="90"/>
                            </a>

                        <p><?php echo $fv['uname'];?></p>
                        <span class="font2">用户等级：<?php echo $fv['lid'];?></span><br/>
                        被收藏数量：<span class="font1"><?php echo $fv['favorite_num'];?></span></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <!--
                <div class="plus"></div>
                <div class="minus"></div>
                -->
            </div>
        </div>
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<!-- #EndLibraryItem -->
</body>
</html>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/user.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.jcarousel.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/user_center_broadcast.js"></script>