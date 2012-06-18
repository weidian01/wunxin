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
    <h2>配货单</h2>

    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="/administrator/order/orderList"><span><br/> 订单列表 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/order_receiver/receivableList"><span><br/> 收款单列表 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/order_picking/pickingList"><span><br/> 配货单列表 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/order_express/addExpressCompany"><span><br/> 添加快递公司 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/order_express/expressList"><span><br/> 快递公司列表 </span></a></li>

    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear">
        <form action="<?=url('administrator/order_picking/search');?>" method="post">
            <p>
                <label><b>输入关键字</b></label>
                <input class="text-input small-input" type="text" id="small-input" name="keyword"
                       value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                <select name="s_type" class="small-input">
                    <?php if (!isset ($searchType)) {
                    $searchType = array();
                }
                    foreach ($searchType as $sk => $sv) {
                        ?>
                        <?php if (!isset($sType)) $sType = '';
                        if ($sType == $sk) {
                            ?>
                            <option value="<?php echo $sk?>" selected="selected"><?php echo $sv?></option>
                            <?php } else { ?>
                            <option value="<?php echo $sk?>"><?php echo $sv?></option>
                            <?php } ?>
                        <?php }?>
                </select>
                <input type="submit" value="搜索">
            </p>
        </form>
    </div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>配货单列表</h3>
            <!--
            <ul class="content-box-tabs">
                <li><a href="#tab1" class="default-tab">Table</a></li>
                <li><a href="#tab2">Forms</a></li>
            </ul>
            -->
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
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <td colspan="13">
                            <div class="pagination">
                                <?php echo isset ($page_html) ? $page_html : '';?>
                            </div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php if (!isset ($data)) $data = array();
                    foreach ($data as $v) {
                        if (empty ($v)) continue;?>
                    <tr>
                        <td><input type="checkbox"/></td>
                        <td><?php echo $v['picking_id'];?></td>
                        <td><a
                            href="/administrator/order_picking/orderPickingList/<?php echo $v['order_sn'];?>"><?php echo $v['order_sn'];?></a>
                        </td>
                        <td><?php echo $v['ed_id'];?></td>
                        <td><?php echo $v['address_id'];?></td>
                        <td><?php echo $v['logistics_orders_sn'];?></td>
                        <td><?php echo $v['uid'];?></td>
                        <td><?php echo $v['descr'];?></td>
                        <td><?php echo $v['freight'];?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td>
                            <a href="/administrator/order_picking/pickingDetail/<?php echo $v['picking_id'];?>" title="查看订单"><img src="/images/icons/view.png" alt="查看订单"/></a>
                        </td>
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