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
            <div class="u-r-tit">收货地址管理</div>
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
                    <td width="8%" height="26" align="center">编号</td>
                    <td width="8%" align="center">收货人</td>
                    <td width="8%" align="center">邮件地址</td>
                    <td width="8%" align="center">邮政编码</td>
                    <td width="10%" align="center">手机号码</td>
                    <td width="10%" align="center">座机</td>
                    <td width="20%" align="center">详细地址</td>
                    <td width="8%" align="center">默认</td>
                    <td width="8%" align="center">添加时间</td>
                    <td width="10%" align="center">操作</td>
                </tr>
                <?php if (empty ($data)) $data = array();
                foreach ($data as $v) {?>
                <tr>
                    <td align="center"><?php echo $v['address_id'];?></td>
                    <td align="center"><?php echo $v['recent_name'];?></td>
                    <td align="center"><?php echo $v['email'];?></td>
                    <td align="center"><?php echo $v['zipcode'];?></td>
                    <td align="center"><?php echo $v['phone_num'];?></td>
                    <td align="center"><?php echo $v['call_num'];?></td>
                    <td align="center"><?php echo $v['province']. ' '. $v['city'] .' '. $v['area']. ' ' . $v['detail_address'];?></td>
                    <td align="center"><?php echo $v['default_address'] == '1' ? '是' : '否';?></td>
                    <td align="center"><?php echo date('Y-m-d', strtotime($v['create_time']));?></td>
                    <td align="center">
                        <a href="javascript:void(0);" onclick="(<?php echo $v['address_id'];?>)">修改</a>
                        <br/>
                        <a href="javascript:void(0);" onclick="(<?php echo $v['address_id'];?>)">删除</a>
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

