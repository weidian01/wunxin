<?php require(dirname(__FILE__) . '/../left.php'); ?>
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
    <h2>订单管理</h2>

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
        <form action="<?=url('administrator/order/search');?>" method="post">
        <p>
            <label><b>输入关键字</b></label>
            <input class="text-input small-input" type="text" id="small-input" name="keyword" value="<?php echo isset($keyword) ? $keyword : ''; ?>">
            <select name="s_type" class="small-input">
                <?php if (!isset ($searchType)) {$searchType = array();}
                foreach ($searchType as $sk=>$sv) {?>
                <?php if (!isset($sType)) $sType = '';
                if ($sType == $sk) {?>
                <option value="<?php echo $sk?>" selected="selected"><?php echo $sv?></option>
                <?php } else {?>
                    <option value="<?php echo $sk?>"><?php echo $sv?></option>
                <?php }?>
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
            <h3>订单列表</h3>
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
                        <th>订单号</th>
                        <th>收货人</th>
                        <th>支付状态</th>
                        <th>userid</th>
                        <th>username</th>
                        <th>金额</th>
                        <th>支付方式</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <th>流程</th>
                        <th>配货</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <td colspan="13">
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="option1">Choose an action...</option>
                                    <option value="option2">Edit</option>
                                    <option value="option3">Delete</option>
                                </select>
                                <a class="button" href="#">Apply to selected</a>
                            </div>
                            <div class="pagination">
                            <?php echo isset ($page_html) ? $page_html : '';?>
                            </div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php if (!isset ($data)) $data = array();
                        foreach ($data as $v) { ?>
                    <tr>
                        <td> <input type="checkbox" /> </td>

                        <td><?php echo $v['order_sn'];?></td>
                        <td><?php echo $v['recent_name'];?></td>
                        <td><?php
                            switch ($v['is_pay']) {
                                case 1:
                                    $payStatus = '付款成功';
                                    break;
                                case 2:
                                    $payStatus = '付款失败';
                                    break;
                                case 3:
                                    $payStatus = '等待付款';
                                    break;
                                default :
                                    $payStatus = '初始';
                            }
                            echo $payStatus;?></td>
                        <td><?php echo $v['uid'];?></td>
                        <td><?php echo $v['uname'];?></td>
                        <td><?php echo $v['after_discount_price'];?></td>
                        <td><?php echo $v['pay_type'].'--'.$v['defray_type'];?></td>
                        <td><?php echo $v['status'] ? '正常' : '取消';?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td>
                            <?php if ($v['status'] == 1): ?>
                            未确认
                            <?php elseif ($v['status'] == 0): ?>
                            已取消
                            <?php else: ?>
                            已确认
                            <?php endif;?>,
                            <?php if ($v['parent_id'] == 0): ?>
                            未拆单
                            <?php else: ?>
                            已拆单
                            <?php endif;?>
                        </td>
                        <td><?php echo $v['picking_status'] ? '已配货' : '未配货';?></td>
                        <td>
                            <a href="/administrator/order/orderDetail/<?php echo $v['order_sn'];?>" title="查看订单"><img src="/images/icons/view.png" alt="查看订单"/></a>
                            <!--<a href="/administrator/order/orderEdit/<?php echo $v['order_sn'];?>" title="编辑订单"> <img src="/images/icons/hammer_screwdriver.png" alt="编辑订单"/></a>-->
                            &nbsp;
                            <a href="/administrator/order/orderDelete/<?php echo $v['order_sn'];?>" title="删除订单"> <img src="/images/icons/cross.png" alt="删除订单"/></a>
                            <!--<a href="#" title="Edit Meta"><img src="/images/icons/hammer_screwdriver.png"alt="Edit Meta"/></a>-->
                        </td>
                    </tr>
                        <?php }?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require(dirname(__FILE__) . '/../footer.php'); ?>
</div>
</div>
</body>
</html>