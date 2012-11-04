<?php require(dirname(__FILE__) . '/../../left.php'); ?>
<div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
        <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/"
                                                                                        title="Upgrade to a better browser">upgrade</a>
                your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852"
                                   title="Enable Javascript in your browser">enable</a> Javascript to navigate the
                interface properly.
                Download From <a href="http://www.exet.tk">exet.tk</a></div>
        </div>
    </noscript>
    <!-- Page Head -->
    <h2>配货详细信息</h2>

    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order/orderList"><span> 订单列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order_receiver/receivableList"><span> 收款单列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order_picking/pickingList"><span> 配货单列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order_express/addExpressCompany"><span> 添加快递公司 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order_express/expressList"><span> 快递公司列表 </span></a></li>
        <!--
        <li><a class="shortcut-button" href="#"><span> <img src="<?=config_item('static_url')?>images/icons/paper_content_pencil_48.png" alt="icon"/><br/> Create a New Page </span></a></li>
        <li><a class="shortcut-button" href="#"><span> <img src="<?=config_item('static_url')?>images/icons/image_add_48.png" alt="icon"/><br/> Upload an Image </span></a></li>
        <li><a class="shortcut-button" href="#"><span> <img src="<?=config_item('static_url')?>images/icons/clock_48.png" alt="icon"/><br/> Add an Event </span></a></li>
        <li><a class="shortcut-button" href="#messages" rel="modal"><span> <img src="<?=config_item('static_url')?>images/icons/comment_48.png" alt="icon"/><br/> Open Modal </span></a></li>
        -->
    </ul>
    <div class="clear"> </div>
    操作
    <ol id="process">
        <li>
        <a class="button" onclick="complete(<?=$data['picking_id'];?>)" href="javascript:;" >完成配货</a>
        </li>
        <!--li>
        <a class="button" onclick="order_locking()" href="javascript:;" >发货</a>
        </li-->
    </ol><br><br>

    <!-- End .shortcut-buttons-set -->
    <div class="clear"> </div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>配货信息</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <table>
                    <thead>
                    <tr>
                        <th><input class="check-all" type="checkbox"/></th>
                        <th>配货单ID</th>
                        <th>订单ID</th>
                        <th>快递公司</th>
                        <th>地址</th>
                        <th>物流单号</th>
                        <th>管理员ID</th>
                        <th>管理员备注</th>
                        <th>运费</th>
                        <th>创建时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="checkbox"/></td>
                        <td><?php echo $data['picking_id'];?></td>
                        <td><a
                            href="<?=config_item('static_url')?>administrator/order_picking/orderPickingList/<?php echo $data['order_sn'];?>"><?php echo $data['order_sn'];?></a>
                        </td>
                        <td><?php echo $data['ed_id'];?></td>
                        <td><?php echo $data['address_id'];?></td>
                        <td><?php echo $data['logistics_orders_sn'];?></td>
                        <td><?php echo $data['uid'];?></td>
                        <td><?php echo $data['descr'];?></td>
                        <td><?php echo $data['freight'];?></td>
                        <td><?php echo $data['create_time'];?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>配货产品信息</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <table>
                    <thead>
                    <tr>
                        <th><input class="check-all" type="checkbox"/></th>
                        <th>产品ID</th>
                        <th>产品名称</th>
                        <th>数量</th>
                    </tr>
                    </thead>
                    <!--tfoot>
                    <tr>
                        <td colspan="13">
                            <div class="pagination">
                                <?php echo isset($page_html) ? $page_html : '';?>
                            </div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                    </tfoot-->
                    <tbody>
                    <?php if (empty ($product_data)) {
                        $product_data = array();
                    }foreach ($product_data as $v) { ?>
                    <tr>
                        <td><input type="checkbox"/></td>
                        <td><?php echo $v['pid'];?></td>
                        <td><?php echo $v['pname'];?></td>
                        <td><?php echo $v['product_num'];?></td>
                    </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require(dirname(__FILE__) . '/../../footer.php'); ?>
</div>
</div>
</body>
</html>
<script>
    function complete(picking_id)
    {
        $.ajax({
            type:"POST",
            url:"<?=site_url('administrator/order_picking/complete')?>",
            data:"picking_id=" + picking_id,
            async:false,
            dataType:'json',
            success:function (data) {
                if (data.error == 0) {
                    $("#process > li:eq(0) > a:eq(0)").replaceWith('配货完成');
                }
                else {
                    alert(data.msg);
                }
            }
        });
    }
</script>