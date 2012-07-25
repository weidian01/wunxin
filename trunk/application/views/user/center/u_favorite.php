<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的收藏夹 -- 个人中心</title>
    <link href="/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="/scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="/scripts/iepng.js"></script>
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
        .scj .main .tab{width:778px;height:25px;background:url(/images/tab_lan2.png) repeat-x 0px -25px;margin:10px 10px 10px 10px;display:inline;float:left;}
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
<!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include('/../../header.php');?>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">我的收藏夹</div>
        </div>
        <div class="u-r-box">
            <!--
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="o-list">
                    <td width="16%" height="26" align="center">收藏编号</td>
                    <td width="15%">产品图片</td>
                    <td width="25%" align="center">产品名称</td>
                    <td width="10%" align="center">产品价格</td>
                    <td width="17%" align="center">收藏时间</td>
                    <td width="17%" align="center">操作</td>
                </tr>
                <?php if (empty ($data)) $data = array();
                foreach ($data as $v) {?>
                <tr>
                    <td height="26" align="center"><a href="#"><?php echo $v['id'];?></a></td>
                    <td><img src="<?=config_item('static_url')?>upload/product/<?=intToPath($v['pid'])?>icon.jpg" alt=""/></td>
                    <td align="center"><?php //echo $v['pname']; ?></td>
                    <td align="center"><?php //echo $v['market_price'];?></td>
                    <td align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                    <td align="center">
                        <a href="javascript:void(0);" onclick="deleteProductFavorite(<?php echo $v['id'];?>)">删除</a>
                    </td>
                </tr>
                    <?php }?>
            </table>
            -->
            <div class="scj">
                <div class="main">
                    <div class="tab">
                        <a href="/user/center/productFavorite">收藏的产品</a>
                        <a href="/user/center/designerFavorite" class="act">收藏的设计师</a>
                        <a href="/user/center/designFavorite">收藏的设计图</a>
                    </div>
                    <div id="itemList">
                        <div class="list-m">
                            <!--
                            <h2>
                                <a href="javascript:void(0);" onclick="changeStyle(0);" class="act">全部（2）</a>
                                |　<a href="javascript:void(0);" onclick="changeStyle(11);">T恤（1）</a> &nbsp;&nbsp; |　<a
                                href="javascript:void(0);" onclick="changeStyle(101);">文具（1）</a> &nbsp;&nbsp;
                            </h2>
                            -->
                            <form id="f1" method="post">
                                <table width="100%" class="table2">
                                    <thead>
                                    <tr>
                                        <!--<td align="center" style="text-align:center;"><b style="color: #8B8378;">收藏编号</b></td>-->
                                        <th colspan="2" align="left"><b style="color: #8B8378;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;设计师信息</b></th>
                                        <td align="center" style="text-align:center;"><b style="color: #8B8378;">设计师等级</b></td>
                                        <td align="center" style="text-align:center;"><b style="color: #8B8378;">收藏时间</b></td>
                                        <th align="center" style="text-align:center;"><b style="color: #8B8378;">被收藏次数</b></th>
                                        <th align="center" style="text-align:center;"><b style="color: #8B8378;">操作</b></th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody">
                                    <?php if (empty ($data)) $data = array();
                                    foreach ($data as $v) {?>
                                    <tr>
                                        <!--<td style="width:90px;text-align:center;"><?php echo $v['designer_favorite_id'];?></td>-->
                                        <td style="width:60px;">
                                            <div class="imgbox">
                                                <!--<img src="http://img02.static.yohobuy.com/thumb/2011/06/24/13/02bc8668e95b1115ecc6635b7c341dd1ae00600060.jpg">-->
                                                <img src="<?=config_item('static_url')?>upload/designer/<?=intToPath($v['uid'])?>icon.jpg" alt="<?php echo $v['uname'];?>" width="60" height="60"/>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="a_e"><?php echo $v['uname'];?></a><br>
                                        </td>
                                        <td style="width:90px;text-align:center;"><?php echo $v['lid'];?></td>
                                        <td style="width:90px;text-align:center;"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                                        <td style="width:90px;text-align:center;">共收藏 <?php echo $v['favorite_num'];?> 次</td>
                                        <td style="width:90px;text-align:center;">
                                            <a href="#" class="a_e">查看设计师</a>
                                            <br/><br/>
                                            <span class="det" onclick="deleteFavorite(<?php echo $v['designer_favorite_id'];?>)" style="cursor:pointer;color:#468fa2;">删除</span>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    </tbody>
                                    <tfoot>
                                    <tr id="listFooter">
                                        <!--
                                        <th><input onclick="checkproductAll(this)" id="checkpro" type="checkbox"></th>
                                        <th colspan="3" align="left">
                                            　
                                            <button type="submit" class="btn_s2_z5" id="removebut"
                                                    onclick="return info('deletemulti','您确定要移除您选中的产品')">移除收藏夹
                                            </button>
                                        </th>
                                        -->
                                        <th colspan="6" align="right">
                                            <button type="button" class="btn_s1_z7" onclick="emptyFavorite()"> 清空所有产品 </button>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </form>
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

        <!--
        <div class="u-r-box">
            <div class="tui-tit">为您推荐</div>
            <div class="tui">
                <div class="tuipre"><a href="#"></a></div>
                <div class="tuinext"><a href="#"></a></div>
                <ul>
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
                </ul>
            </div>
        </div>
        -->
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="/scripts/common.js"></SCRIPT>
<script type="text/javascript">
    function deleteFavorite(fId)
    {
        if (confirm('确定删除设计师！')) {
            if (!wx.isEmpty(fId)) {
                return false;
            }

            var url = '/user/designerFavorite/deleteDesignerFavorite';
            var param = 'fid='+fId;
            var data = wx.ajax(url, param);

            if (data.error == '10020') {
                wx.pageReload(0);
                return true;
            }

            alert('删除失败!');
        }
    }

    function emptyFavorite()
    {
        var url = '/user/designerFavorite/emptyDesignerFavorite';
        var param = '';
        var data = wx.ajax(url, param);

        if (data.error == '10023') {
            wx.pageReload(0);
            return true;
        }

        alert('删除失败!');
    }
</script>
<!-- #EndLibraryItem -->
</body>
</html>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的晒单 -- 个人中心</title>
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
            <div class="u-r-tit">我的晒单</div>
            <!--
            <div class="u-ac">
              <span class="ruo">账户安全：</span>
              <span class="zhong">账户安全：</span>
              <span class="qiang">账户安全：</span>
              <div class="yanzheng">
                <span class="phone">未验证手机</span>
                <span class="email">未验证邮箱</span>
                <span class="topay">未启用支付密码</span>
              </div>
              <div class="safetip">为保护账户安全，请尽快<a href="#"><strong>启用所有安全服务</strong></a></div>

            </div>
            -->
        </div>
        <div class="u-r-box">
            <!--
            <div class="orderlist-sek">

                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="44%"><label>
                            <select name="select" id="select">
                                <option>近一个月订单</option>
                            </select>&nbsp;&nbsp;
                            <select name="select2" id="select2">
                                <option>订单状态</option>
                            </select>
                        </label></td>
                        <td width="46%" align="right"><label>
                            <input name="textfield" type="text" class="input1" id="textfield" value="商品名称，商品编号，订单编号"
                                   onfocus="if (value =='商品名称，商品编号，订单编号'){value =''}"
                                   onblur="if (value ==''){value='商品名称，商品编号，订单编号'}"/>
                        </label></td>
                        <td width="10%">&nbsp;&nbsp;<label>
                            <input class="sinput" type="submit" name="button" id="button" value="查询"/>
                        </label></td>
                    </tr>
                </table>

            </div>
            -->
            <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="o-list">
                    <td width="16%" height="26" align="center">收藏编号</td>
                    <td width="15%" align="center">设计师头像</td>
                    <td width="25%" align="center">设计师名称</td>
                    <!--<td width="10%" align="center">设计师简介</td> -->
                    <td width="17%" align="center">收藏时间</td>
                    <td width="17%" align="center">操作</td>
                </tr>
                <?php if (empty ($data)) $data = array();
                foreach ($data as $v) {?>
                <tr>
                    <td width="16%" height="26" align="center"><?php echo $v['designer_favorite_id'];?></td>
                    <td width="28%"><img src="<?=config_item('static_url')?>upload/designer/<?=intToPath($v['uid'])?>icon.jpg" alt=""/></td>
                    <td width="8%" align="center"><?php echo $v['favorite_uname']; ?></td>
                    <!--<td width="10%" align="center"><?php echo $v['default'];?></td>-->
                    <td width="17%" align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                    <td width="17%" align="center">
                        <a href="javascript:void(0);" onclick="deleteDesignerFavorite(<?php echo $v['designer_favorite_id'];?>)">删除</a>
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
        <!--
        <div class="u-r-box">
            <div class="tui-tit">为您推荐</div>
            <div class="tui">
                <div class="tuipre"><a href="#"></a></div>
                <div class="tuinext"><a href="#"></a></div>
                <ul>
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
                </ul>
            </div>
        </div>
        -->
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="/scripts/common.js"></SCRIPT>
<script type="text/javascript">
    function deleteDesignerFavorite(dId)
    {
        if (confirm('确定删除！')) {
            if (!wx.isEmpty(dId)) {
                return false;
            }

            var url = '/user/designerFavorite/deleteDesignerFavorite';
            var param = 'fid='+dId;
            var data = wx.ajax(url, param);

            if (data.error == '10020') {
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

