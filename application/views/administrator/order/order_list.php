<?php include(APPPATH.'views/administrator/left.php');?>
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
    操作流程 : 1.确认已支付订单; 2.拆分订单; 3.配货; 4.完成配货; 5.发货;
    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order/orderList"><span> 订单列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order_receiver/receivableList"><span> 收款单列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order_picking/pickingList"><span> 配货单列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order_express/addExpressCompany"><span> 添加快递公司 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order_express/expressList"><span> 快递公司列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear">
        <form action="<?=site_url('administrator/order/search');?>" method="post">
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

        <form action="<?=site_url('administrator/order/orderList');?>" method="GET">
        <p>
            <select name="is_pay">
                <option value="">订单支付状态</option>
                <?php foreach(array(ORDER_PAY_INIT=>'未支付',ORDER_PAY_SUCC=>'支付成功',ORDER_PAY_FAIL=>'支付失败',ORDER_PAY_DEFECT=>'支付部分', ) as $k=>$v):?>
                <option value="<?=$k?>" <?php if(isset($where['is_pay']) && $where['is_pay'] == $k) echo 'selected="selected"';?>><?=$v?></option>
                <?php endforeach;?>
            </select>

            <select name="status">
                <option value="">订单确认状态</option>
                <?php foreach(array(ORDER_INVALID=>'已取消',ORDER_NORMAL=>'未确认',ORDER_CONFIRM=>'已确认', ) as $k=>$v):?>
                <option value="<?=$k?>" <?php if(isset($where['status']) && $where['status'] == $k) echo 'selected="selected"';?>><?=$v?></option>
                <?php endforeach;?>
            </select>

            <select name="parent_id">
                <option value="">订单拆分状态</option>
                <?php foreach(array(-1=>'已拆分(父)',0=>'未拆单','child'=>'已拆分(子)', ) as $k=>$v):?>
                <option value="<?=$k?>" <?php if(isset($where['parent_id']) && $where['parent_id'] == $k) echo 'selected="selected"';?>><?=$v?></option>
                <?php endforeach;?>

            </select>

            <select name="picking_status">
                <option value="">订单配货状态</option>
                <?php foreach(array(PICKING_NOT=>'未配货',PICKING_CONDUCT=>'配货中',PICKING_COMPLETED=>'配货完成', ) as $k=>$v):?>
                <option value="<?=$k?>" <?php if(isset($where['picking_status']) && $where['picking_status'] == $k) echo 'selected="selected"';?>><?=$v?></option>
                <?php endforeach;?>
            </select>
            <input type="submit" value="筛选">
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
                        <th>创建时间</th>
                        <th>流程</th>
                        <th>配货</th>
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
                        foreach ($data as $v) { ?>
                    <tr>
                        <td> <input type="checkbox" /> </td>

                        <td><?php echo $v['order_sn'];?></td>
                        <td><?php echo $v['recent_name'];?></td>
                        <td><?php
                            switch ($v['is_pay']) {
                                case ORDER_PAY_SUCC:
                                    $payStatus = '付款成功';
                                    break;
                                case ORDER_PAY_FAIL:
                                    $payStatus = '付款失败';
                                    break;
                                case ORDER_PAY_DEFECT:
                                    $payStatus = '等待付款';
                                    break;
                                default : /*ORDER_PAY_INIT*/
                                    $payStatus = '初始';
                            }
                            echo $payStatus;?></td>
                        <td><?php echo $v['uid'];?></td>
                        <td><?php echo $v['uname'];?></td>
                        <td><?php echo $v['after_discount_price'];?></td>
                        <td><?php echo $v['pay_type'].'--'.$v['defray_type'];?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td><small>
                            <?php if ($v['status'] == ORDER_NORMAL): ?>
                            未确认
                            <?php elseif ($v['status'] == ORDER_INVALID): ?>
                            已取消
                            <?php else: /*ORDER_CONFIRM*/?>
                            已确认
                            <?php endif;?>,
                            <?php if ($v['parent_id'] == 0): ?>
                            未拆单
                            <?php elseif($v['parent_id']>0):?>
                                已拆分(子)
                            <?php else:?>
                                已拆分(父)
                            <?php endif;?>
                        </small></td>
                        <td><?php if($v['picking_status']==0):?>未配货
                            <?php elseif($v['picking_status']==1):?>配货中
                            <?php elseif($v['picking_status']==2):?>配货完成
                            <?php endif;?>
                            </td>
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/order/orderDetail/<?php echo $v['order_sn'];?>" title="查看订单">
                                <img src="<?=config_item('static_url')?>images/icons/view.png" alt="查看订单"/></a>
                            <!--<a href="<?=config_item('static_url')?>administrator/order/orderEdit/<?php echo $v['order_sn'];?>" title="编辑订单"> <img src="<?=config_item('static_url')?>images/icons/hammer_screwdriver.png" alt="编辑订单"/></a>-->

                            <!--&nbsp;<a href="<?=config_item('static_url')?>administrator/order/orderDelete/<?php echo $v['order_sn'];?>" title="删除订单"> <img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除订单"/></a>-->
                            <!--<a href="#" title="Edit Meta"><img src="<?=config_item('static_url')?>images/icons/hammer_screwdriver.png"alt="Edit Meta"/></a>-->
                        </td>
                    </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include(APPPATH.'views/administrator/footer.php');?>
</div>
</div>
</body>
</html>