<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>设计师留言 -- 我的评论</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
        /*收藏夹*/
        .scj{width:800px;height:auto;background:url(/images/k_r_m.png) repeat-y;margin-bottom:10px;float:left;}
        .scj .main{width:798px;padding:0px 1px 1px 1px;background:url(/images/k_r_b.png) no-repeat bottom;float:left;}
        .scj .title{width:780px;height:28px;padding:12px 10px 0px 10px;background:url(/images/k_r_tg2.png) no-repeat top;float:left;}
        .scj .title h2{width:175px;height:15px;background:url(/images/z_scj.png) no-repeat; text-indent:-999em;float:left;}
        .scj .main .tab{width:778px;height:25px;background:url(/images/tab_lan2.png) repeat-x 0px -25px;margin:10px 10px 0px 10px;display:inline;float:left;}
        .scj .main .tab a{width:98px;height:25px;line-height:25px;text-align:center;background:url(/images/tab_lan3.png) no-repeat -101px 0px;margin-right:3px;display:inline;color:#333;float:left;}
        .scj .main .tab a.act{width:98px;height:25px;line-height:25px;text-align:center;background:url(/images/tab_lan3.png) no-repeat 0px 0px;
            margin-right:3px;display:inline;color:#333;font-weight:bold;float:left;}
        .scj .main .list-m{width:778px;padding:0px 10px 0px 10px;float:left;}
        .scj .main .list-b{width:798px;padding:0px;background:#f3f3f3;border-top:1px #e3e3e3 solid ;float:left;}
        .scj .main h2{clear:both;min-height:21px;_height:21px;line-height:21px;padding-left:23px;background:url(/images/ico_arrow2.png) no-repeat 5px 5px #efefef;
            border:1px #e6e6e6 solid;font-size:12px;color:#ccc;font-weight:normal;margin-bottom:10px;}
        .scj .main h2 a{color:#468fa2;display:inline-block;}
        .scj .main h2 a.act{color:#e8044f;font-weight:bold;}
        .scj .main .list-m table .act{background:#d0dce4;}
        .scj .main .list-m .tablein .act{ background:none;}
        .scj .main .list-box {width:788px;padding:0px 0px 0px 10px;float:left;}
        .scj .main .list-box li{width:122px;height:148px;border:1px #e6e6e6 solid;margin:0px 7px 7px 0px;display:inline;float:left;overflow:hidden; position:relative;}
        .scj .main .list-box .act{background:#d0dce4;}
        .scj .main .list-box li img{width:80px;height:50px;display:block;margin:15px auto;}
        .scj .main .list-box li h3{width:114px;height:18px;background:#f4f4f4;color:#333;font-size:12px;text-align:center;margin: 0 auto; white-space:nowrap;overflow:hidden;}
        .scj .main .list-box li p{width:114px;height:18px;padding-top:10px;line-height:18px;color:#999;font-size:12px;text-align:center;margin: 0 auto; white-space:nowrap;overflow:hidden;}
        .scj .main .list-box li b{height:20px;display:block;position:absolute;right:5px;bottom:0px;bottom:5px\9;line-height:20px;}
        .scj .main .list-foot{width:776px;height:38px;background:#f8f8f8;border:1px #ccc solid;margin:10px;display:inline;float:left;}
        .scj .main .list-foot .li-1{width:37px;padding-top:12px;*padding-top:8px;text-align:center;float:left;}
        .scj .main .list-foot .li-2{width:500px;padding:10px 0px 1px 0px;float:left; }
        .scj .main .list-foot .li-3{width:200px;padding:10px 10px 1px 0px;text-align:right;float:right; }
        .scj .main .list-none{clear:both;padding:200px 0px;text-align:center;}
        .imgbox{zoom:1; position:relative;}
        .imgbox p{height:14px;line-height:14px;font-size:12px;padding:2px 0px 0px 0px\9;background:#e8044f;text-align:center;color:#fff;
            position:absolute;bottom:0px;left:0px;overflow:hidden;display:block;}

        .page { color: #666666; font-size: 12px; padding: 10px; text-align: right; }
        .table2 { border: 1px solid #E6E6E6; border-collapse: collapse; margin-bottom: 10px; }
        .table2 thead { background: none repeat scroll 0 0 #EFEFEF; color: #333333; height: 18px; line-height: 18px; padding: 2px 5px; text-align: left; }
        .table2 td, .table2 th { border-bottom: 1px solid #E6E6E6; font-weight: normal; padding: 5px; }
        .table2 td { color: #666666; text-align: left; }
        .table2 tfoot { background: none repeat scroll 0 0 #F8F8F8; font-weight: bold; text-align: center; }
        .btn_s1_z7 { background: url("/images/btn_s1_z7.png") repeat-x scroll 0 0 transparent; border: 0 none; color: #FFFFFF; cursor: pointer; display: inline-block; font-size: 12px;
            height: 20px; line-height: 20px; margin: 0; padding: 0; text-align: center; width: 102px; }
    </style>

</head>
<body>
<script type=text/javascript src="<?=config_item('static_url')?>scripts/artDialog.js"></script>
<!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include('/../../header.php');?>
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
                        <a href="/user/center/productComment">产品评论</a>
                        <a href="/user/center/designComment">设计图评论</a>
                        <a href="/user/center/designerComment" class="act">设计师留言</a>
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
                                                        <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($v['uid'])?>icon.jpg" alt="" width="60" height="60" title="<?php echo $v['nickname'];?>"/>
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
            <div class="tui">
                <div class="tuipre"><a href="#"></a></div>
                <div class="tuinext"><a href="#"></a></div>
                <ul>
                    <?php foreach ($favorite_recommend as $fv) {?>
                    <li style="width: 110px;text-align: center;padding: 0 5px;">
                        <a href="#" title="<?=$fv['uname']?>">
                            <img src="<?=config_item('static_url')?>upload/designer/<?=intToPath($fv['uid'])?>icon.jpg" width="90" height="90"/>
                        </a>

                    <p><?php echo $fv['uname'];?></p>
                    <span class="font2">用户等级：<?php echo $fv['lid'];?></span><br/>
                    被收藏数量：<span class="font1"><?php echo $fv['favorite_num'];?></span></li>
                    <?php }?>
                </ul>
            </div>
        </div>

    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/user.js"></SCRIPT>
<!-- #EndLibraryItem -->
</body>
</html>