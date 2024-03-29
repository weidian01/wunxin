<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的评论 -- 个人中心</title>
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
<!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=config_item('static_url')?>">首页</a></li>
      <li><a href="<?=config_item('static_url')?>user/center/index">个人中心</a></li>
      <li class="last">我的评论</li>
    </ul>
  </div>
</div>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">我的评论</div>
        </div>
        <div class="u-r-box">
            <div class="scj">
                <div class="main">
                    <div class="tab">
                        <a href="<?=config_item('static_url')?>user/center/productComment">产品评论</a>
                        <a href="<?=config_item('static_url')?>user/center/designComment" class="act">设计图评论</a>
                        <a href="<?=config_item('static_url')?>user/center/designerComment">设计师留言</a>
                    </div>
                    <div id="itemList">
                        <div class="list-m">
                            <form id="f1" method="post">
                                <table width="100%" class="table2">
                                    <thead>
                                    <tr>
                                        <!--<td align="center" style="text-align:center;"><b style="color: #8B8378;">收藏编号</b></td>-->
                                        <th colspan="2" align="left"><b style="color: #8B8378;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;设计图信息</b></th>
                                        <td align="center" style="text-align:center;"><b style="color: #8B8378;">设计图介绍</b></td>
                                        <th align="center" style="text-align:center;"><b style="color: #8B8378;">人气</b></th>
                                        <td align="center" style="text-align:center;"><b style="color: #8B8378;">评论时间</b></td>
                                        <th align="center" style="text-align:center;"><b style="color: #8B8378;">操作</b></th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody">
                                    <?php if (empty ($data)) { ?>
                                    <tr>
                                        <td colspan="6"  style="text-align: center;font-weight: bold;color: #A10000;" height="50">您还没有设计图评论，赶快去发表您对设计图的看法吧。</td>
                                    </tr>
                                    <?php } else {?>
                                        <?php foreach ($data as $v) {?>
                                        <tr>
                                            <!--<td style="width:90px;text-align:center;"><?=$v['id'];?></td>-->
                                            <td style="width:60px;">
                                                <div class="imgbox">
                                                    <a href="#" class="a_e" title="<?=$v['dname'];?>">
                                                        <img src="<?=config_item('static_url')?>upload/design/<?=intToPath($v['did'])?>default.jpg" alt="" width="60" height="72"/>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="a_e" title="<?=$v['dname'];?>"><?=$v['dname'];?></a> &nbsp;&nbsp;<br>
                                                <span>设计师：<a href="#" title="<?=$v['uname'];?>"><?=$v['uname'];?></a></span>
                                            </td>
                                            <td style="width:170px;text-align:center;"><?=$v['ddetail'];?></td>
                                            <td style="width:110px;text-align:center;">
                                                <a href="#" title="此设计图评论被回复 <?=$v['reply_num'];?> 条" style="color: #990000;font-size: 10px;">被回复 <?=$v['reply_num'];?> 条</a> <br /><br />
                                                <a href="#" title="共有 <?=$v['total_num'];?> 用户投票" style="color: #990000;font-size: 10px;">共 <?=$v['total_num'];?> 票</a> &nbsp;|&nbsp;
                                                <a href="#" title="此设计图总分数为 <?=$v['total_fraction'];?> 分" style="color: #990000;font-size: 10px;">共 <?=$v['total_fraction'];?> 分</a>
                                            </td>
                                            <td style="width:60px;text-align:center;"><?=date('Y-m-d', strtotime($v['create_time']));?></td>
                                            <td style="width:60px;text-align:center;">
                                                <!--
                                                <a href="#">
                                                    <img src="<?=config_item('static_url')?>images/view.gif" title="查看此设计图">
                                                </a>
                                                <br/>
                                                <a href="#">
                                                    <img src="<?=config_item('static_url')?>images/comment.gif" title="评论此设计图">
                                                </a>
                                                <br/>
                                                -->
                                                <a href="javascript:void(0);" onclick="design.deleteComment(<?=$v['comment_id'];?>)">
                                                    <img src="<?=config_item('static_url')?>images/delete.gif" title="删除此设计图评论">
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    <?php }?>
                                    </tbody>
                                    <tfoot>
                                    <tr id="listFooter">
                                    </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                        <div class="list-b">
                            <div class="pages" style="float: right;">
                            <?=$page_html;?><span class="page"> 共<?=$total_num;?>条结果<!--，1/1页--></span>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="u-r-box">
            <div class="tui-tit">设计图推荐</div>
            <div id="pic_list_1" class="scroll_horizontal">
                <div class="box">
                    <ul class="list jcarousel-skin-ucenter" id="user_center_list">
                        <?php foreach ($favorite_recommend as $fv):?>
                        <li>
                            <a href="#" title="<?=$fv['dname']?>">
                                <img src="<?=config_item('static_url')?>upload/design/<?=intToPath($fv['did'])?>default.jpg" width="130" height="156"/>
                            </a>
                            <p><a href="#" title="<?=$fv['dname']?>"><?=mb_substr($fv['dname'], 0, 18, 'utf-8');?></a></p>
                            <span class="font2">设计师：<?=substr($fv['uname'], 0, 10);?></span><br/>
                            被收藏数量：<span class="font1"><?=$fv['favorite_num'];?></span>
                        </li>
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
<script type=text/javascript src="<?=config_item('static_url')?>scripts/design.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.jcarousel.js"></script>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/user_center_broadcast.js"></script>