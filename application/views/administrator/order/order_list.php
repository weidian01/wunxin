<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fi" lang="fi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>订单列表 -- 万象电子商务后台管理系统</title>
    <style type="text/css">/*<![CDATA[*/
    @import "/css/login.css";

        /*]]>*/</style>
</head>
<body>
<div class="operating">
    <div class="search f_r">
        <form name="serachuser" action="/iwebshop/index.php" method="get">
            <input type="hidden" name="controller" value="order">
            <input type="hidden" name="action" value="order_list">
            用户名：<input class="small" name="name" type="text" value="">
            订单号：<input class="small" name="order_no" type="text" value="">
            <button class="btn" type="submit"><span class="sch">搜 索</span></button>
        </form>
    </div>
    <a href="javascript:void(0)">
        <button class="operating_btn"
                onclick="location.href='/iwebshop/index.php?controller=order&amp;action=order_add'" type="button"><span
            class="addition">添加订单</span></button>
    </a>
    <a href="javascript:void(0)" onclick="selectAll('id[]')">
        <button class="operating_btn" type="button"><span class="sel_all">全选</span></button>
    </a>
    <a href="javascript:void(0)" onclick="delModel({form:'orderForm'})">
        <button class="operating_btn" type="button"><span class="delete">批量删除</span></button>
    </a>
    <a href="javascript:void(0)"
       onclick="$('#orderForm').attr('action','/iwebshop/index.php?controller=order&amp;action=expresswaybill_template');$('#orderForm').submit();">
        <button class="operating_btn"><span class="export">批量打印快递单</span></button>
    </a>
    <a href="javascript:void(0)">
        <button class="operating_btn"
                onclick="location.href='/iwebshop/index.php?controller=order&amp;action=print_template'"><span
            class="export">打印模板</span></button>
    </a>
    <a href="javascript:void(0)">
        <button class="operating_btn" type="button"
                onclick="location.href='/iwebshop/index.php?controller=order&amp;action=order_recycle_list'"><span
            class="recycle">回收站</span></button>
    </a>
</div>

<table border="1">
    <tr>
        <td>订单号</td>
        <td>收货人信息</td>
        <td>支付状态</td>
        <td>配货状态</td>
        <td>用户名称</td>
        <td>金额</td>
        <td>创建时间</td>
        <td>操作</td>
    </tr>
    <?php foreach ($data as $v) { ?>
    <tr>
        <td><?php echo $v['order_sn'];?></td>
        <td><?php echo $v['recent_name'];?></td>
        <td><?php echo $v['is_pay'];?></td>
        <td><?php echo $v['picking_status'];?></td>
        <td><?php echo $v['uname'];?></td>
        <td><?php echo $v['after_discount_price'];?></td>
        <td><?php echo $v['create_time'];?></td>
        <td>
            <a href="/administrator/order/orderDetail">查看</a>
            <a href="/administrator/order/orderEdit">编辑</a>
        </td>
    </tr>
    <?php }?>
</table>
</body>
</html>