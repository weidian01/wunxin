<?php include('/../left.php'); ?>
<div id="main-content">
<!-- Main Content Section with everything -->
<noscript>
    <!-- Show a notification if the user has disabled javascript -->
    <div class="notification error png_bg">
        <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/"
                                                                                    title="Upgrade to a better browser">upgrade</a>
            your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852"
                               title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface
            properly.
            Download From <a href="http://www.exet.tk">exet.tk</a></div>
    </div>
</noscript>
<!-- Page Head -->
<h2>订单管理</h2>
<!--<p id="page-intro">What would you like to do?</p>-->
<ul class="shortcut-buttons-set">
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/order/orderList"><span> 订单列表 </span></a></li>
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/order_receiver/receivableList"><span> 收款单列表 </span></a></li>
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/order_picking/pickingList"><span> 配货单列表 </span></a></li>
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/order_express/addExpressCompany"><span> 添加快递公司 </span></a></li>
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/order_express/expressList"><span> 快递公司列表 </span></a></li>
</ul>
<div class="clear"></div>
操作流程
<ol id="process">
    <li>
    <?php if($data['is_pay']==0):?>未支付
    <?php elseif($data['is_pay']==1):?>已支付
    <?php elseif($data['is_pay']==2):?>支付失败
    <?php endif;?>
    </li>
    <li><?php if($data['status']==1):?>
        <a class="button" onclick="order_locking(<?=$data['order_sn']?>)" href="javascript:;" >确认订单</a>
        <?php elseif($data['status']==0):?>已取消
        <?php elseif($data['status']==2):?>已确认
        <?php endif;?>
    </li>
    <li>
        <?php if($data['parent_id']==0):?>
        <a class="button" onclick="order_split(<?=$data['order_sn']?>)" href="javascript:;">拆分订单</a>
        <?php elseif($data['parent_id']==-1): ?>已拆分(父)
        <?php else: ?>已拆分(子)
        <?php endif;?> / <a href="<?=site_url('administrator/order/orderList')."?parent_id={$data['order_sn']}"?>">查看子订单</a>
    </li>
    <?php if($data['parent_id'] > 0):?>
    <li> <?php if($data['picking_status']==0):?>
        <a class="button" onclick="order_picking(<?=$data['order_sn']?>)">配货</a>
        <?php elseif($data['picking_status']==1):?>
        配货中<?php else:?>配货完成<?php endif;?>
        / <a href="<?=site_url('administrator/order_picking/search')?>?keyword=<?=$data['order_sn']?>&s_type=2">查看</a></li>
        <?php endif;?>
</ol><br><br>
<!-- End .shortcut-buttons-set -->
<div class="clear"></div>
<!-- End .clear -->
<div class="content-box">
    <!-- Start Content Box -->
    <div class="content-box-header">
        <h3>订单产品</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">发票信息</a></li>
            <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2">收款单信息</a></li>
            <li><a href="#tab3">退换货信息</a></li>
            <li><a href="#tab4">订单留言</a></li>
            <li><a href="#tab5">发票信息</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>订单ID</th>
                    <th>产品ID</th>
                    <th>产品图片</th>
                    <th>产品名称</th>
                    <th>市场价格</th>
                    <th>销售价格</th>
                    <th>数量</th>
                    <th>尺码</th>
                    <th>优惠</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($data['product'])) {
                    $data['product'] = array();
                } //echo '<pre>';print_r($data['product']);exit;
                foreach ($data['product'] as $pv) {
                    ?>
                <tr>
                    <td>
                        <input type="checkbox"/>
                    </td>
                    <td><?php echo $pv['order_sn'];?></td>
                    <td><?php echo $pv['pid'];?></td>
                    <td><?php echo '图片';?></td>
                    <td><?php echo $pv['pname'];?></td>
                    <td><?php echo $pv['market_price'];?></td>
                    <td><?php echo $pv['sall_price'];?></td>
                    <td><?php echo $pv['product_num'];?></td>
                    <td><?php echo $pv['product_size'];?></td>
                    <td><?php echo $pv['preferential'];?></td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <!-- End #tab1 -->
        <div class="tab-content" id="tab2">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>收款单ID</th>
                    <th>用户ID</th>
                    <th>用户名称</th>
                    <th>金额</th>
                    <th>汇款类型</th>
                    <th>状态</th>
                    <th>收款备注</th>
                    <th>收款账号</th>
                    <th>汇款时间</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($receivable)) {
                    $receivable = array();
                } //echo '<pre>';print_r($receivable);exit;
                foreach ($receivable as $rv) {
                    ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?php echo $rv['receiver_id'];?></td>
                    <td><?php echo $rv['uid'];?></td>
                    <td><?php echo $rv['uname'];?></td>
                    <td><?php echo $rv['amount'];?></td>
                    <td><?php echo $rv['pay_type'] == 1 ? '银行汇款' : '支付宝转账';?></td>
                    <td><?php echo $rv['pay_status'] ? '支付成功' : '支付失败';?></td>
                    <td><?php echo $rv['descr'];?></td>
                    <td><?php echo $rv['pay_account'];?></td>
                    <td><?php echo $rv['pay_time'];?></td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>

        <div class="tab-content" id="tab3">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>退换货ID</th>
                    <th>拍照图片</th>
                    <th>用户ID</th>
                    <th>订单ID</th>
                    <th>类型</th>
                    <th>原因</th>
                    <th>描述</th>
                    <th>物流单号</th>
                    <th>状态</th>
                    <th>创建时间</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($return)) {
                    $return = array();
                } //echo '<pre>';print_r($receivable);exit;
                foreach ($return as $rev) {
                    ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?php echo $rev['return_id'];?></td>
                    <td><?php echo $rev['img_one'];?></td>
                    <td><?php echo $rev['uid'];?></td>
                    <td><?php echo $rev['order_sn'];?></td>
                    <td><?php echo $rev['type'] == 1 ? '退货' : '换货';?></td>
                    <td><?php switch ($rev['reason']) {
                        case 1:
                            $r = '尺寸不对';
                            break;
                        case 1:
                            $r = '货品质量问题';
                            break;
                        default:
                            $r = '其他';
                    }
                        echo $r;
                        ?></td>
                    <td><?php echo $rev['descr'];?></td>
                    <td><?php echo $rev['logistic_num'];?></td>
                    <td><?php
                        switch ($rev['status']) {
                            case 1:
                                $s = '处理成功';
                                break;
                            case 1:
                                $s = '取消';
                                break;
                            default:
                                $s = '初始';
                        }
                        ?></td>
                    <td><?php echo $rev['create_time'];?></td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>

        <div class="tab-content" id="tab4">
            <form action="#" method="post">
                <fieldset>
                    <?php echo $data['annotated'];?>
                </fieldset>
                <div class="clear"></div>
                <!-- End .clear -->
            </form>
        </div>

        <div class="tab-content" id="tab5">
            <form action="#" method="post">
                <fieldset>
                    <?php
                    echo '发票抬头：'.$data['invoice_payable'].'<br>';
                    switch ($data['invoice_content']){
                        case 1: $ic = '服装'; break;
                        case 2: $ic = '其他'; break;
                        default:$ic = $ic = $data['invoice_payable'];
                    }
                    echo '发票内容:'.$ic;
                    ?>

                </fieldset>
                <div class="clear"></div>
                <!-- End .clear -->
            </form>
        </div>
        <!-- End #tab2 -->
    </div>
    <!-- End .content-box-content -->
</div>
<!-- End .content-box -->
<div class="content-box column-left">
    <div class="content-box-header">
        <h3>收货人信息</h3>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab">
            <table>
                <tr>
                    <td><b>收货人：</b></td>
                    <td><?php echo $data['recent_name'];?></td>

                    <td><b>手机号码：</b></td>
                    <td><?php echo $data['phone_num'];?></td>
                </tr>
                <tr>
                    <td><b>座机：</b></td>
                    <td><?php echo $data['call_num'];?></td>
                    <td><b>邮政编码：</b></td>
                    <td><?php echo $data['zipcode'];?></td>
                </tr>
                <tr>
                    <td><b>收货地址：</b></td>
                    <td><?php echo $data['recent_address'];?></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <!-- End #tab3 -->
    </div>
    <!-- End .content-box-content -->
</div>

<!-- End .content-box -->
<div class="content-box column-right">
    <div class="content-box-header">
        <!-- Add the class "closed" to the Content box header to have it closed by default -->
        <h3>订单用户信息</h3>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab">
            <table>
                <tr>
                    <td><b>用户ID：</b></td>
                    <td><?php echo $userInfo['uid'];?></td>
                    <td><b>用户账号：</b></td>
                    <td><?php echo $userInfo['uname'];?></td>
                </tr>
                <tr>
                    <td><b>用户昵称：</b></td>
                    <td><?php echo $userInfo['nickname'];?></td>
                    <td><b>用户等级：</b></td>
                    <td><?php echo $userInfo['lid'];?></td>
                </tr>
                <tr>
                    <td><b>用户积分：</b></td>
                    <td><?php echo $userInfo['integral'];?></td>
                    <td><b>用户金额：</b></td>
                    <td><?php echo $userInfo['amount'];?></td>
                </tr>
            </table>
        </div>
        <!-- End #tab3 -->
    </div>
    <!-- End .content-box-content -->
</div>

<div class="content-box column-left">
    <div class="content-box-header">
        <h3>配货信息</h3>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>快递公司</th>
                    <th>收货人</th>
                    <th>收货地址</th>
                    <th>物流单号</th>
                    <th>备注</th>
                    <th>运费</th>
                    <th>创建时间</th>
                </tr>
                </thead>
                <?php if (empty ($picking)) {
                $picking = array();
            }
                foreach ($picking as $pv) {
                    ?>
                    <tr>
                        <td><?php echo $pv['picking_id'];?></td>
                        <td><?php echo $pv['name'];?></td>
                        <td><?php echo $data['recent_name'];?></td>
                        <td><?php echo $data['recent_address'];?></td>
                        <td><?php echo $pv['logistics_orders_sn'];?></td>
                        <td><?php echo $pv['descr'];?></td>
                        <td><?php echo $pv['freight'];?></td>
                        <td><?php echo $pv['create_time'];?></td>
                    </tr>
                    <?php }?>
            </table>
        </div>
        <!-- End #tab3 -->
    </div>
    <!-- End .content-box-content -->
</div>

<!-- End .content-box -->
<div class="clear"></div>

<?php require(dirname(__FILE__) . '/../footer.php'); ?>
<!-- End #footer -->
</div>
<!-- End #main-content -->
</div>

<div id="messages" style="display:none">
    <h3>创建配货单</h3>
    <form action="#" method="post">
        <fieldset>
        <input class="text-input small-input" type="text" name="logistics_orders_sn"> <small>物流订单号</small>
        </fieldset><br />
        <fieldset>
            <select name="ed_id" class="small-input">
                <?php foreach($express as $item):?>
                <option value="<?=$item['ed_id']?>"><?=$item['name']?></option>
                <?php endforeach;?>
            </select> <small>物流公司</small>
        </fieldset><br />
        <fieldset>
            <textarea class="textarea" name="descr" cols="79" rows="5" onclick="if(this.innerHTML === '管理员备注') this.innerHTML = '';">管理员备注</textarea>
        </fieldset>
    </form>
</div>

</body>
<!-- Download From www.exet.tk-->
</html>
<link rel="stylesheet" href="<?=config_item('static_url')?>css/impromptu.css" type="text/css" media="screen"/>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/jquery-impromptu.4.0.min.js"></script>
<script>

    function order_locking(order_sn)
    {
        $.ajax({
            type:"POST",
            url:"<?=site_url('administrator/order/locking')?>",
            data:"order_sn="+order_sn,
            async:false,
            dataType:'json',
            success:function (data) {
                if(data.error==1)
                {
                    $("#process > li:eq(1)").html('已确认');
                }
                else
                {
                    alert('订单可能尚未付款,无法确认')
                }
            }
        });
    }

    function order_split(order_sn)
    {
        $.ajax({
            type:"POST",
            url:"<?=site_url('administrator/order/split')?>",
            data:"order_sn="+order_sn,
            async:false,
            dataType:'json',
            success:function (data) {
                if(data.error==0)
                {
                    $("#process > li:eq(2) > a:eq(0)").replaceWith('已拆分');
                }
                else
                {
                    alert(data.error)
                }
            }
        });
    }

    function order_picking(order_sn)
    {
        $.prompt($("#messages").html(), {
            submit:mycallbackform,
            buttons:{ "提交":true, "取消":false },
            prefix:'jqismooth'
        });

        function mycallbackform(e, v, m, f) {
            if (v == false)
                return;

            $.ajax({
                type:"POST",
                url:"<?=site_url('administrator/order_picking/create')?>",
                data:"order_sn=" + order_sn + "&" + $.param(f),
                async:false,
                dataType:'json',
                success:function (data) {
                    if (data.error == 0) {
                        alert('配货单已生成');
                        $("#process > li:eq(3) > a:eq(0)").replaceWith('配货中');
                    }
                    else {
                        alert(data.msg);
                    }
                }
            });
        }
        return;
    }
</script>
