<?php require(dirname(__FILE__) . '/../../left.php'); ?>
<div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
        <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div> Javascript is disabled or is not supported by your browser. Please
                <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or
                <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the
                interface properly. Download From <a href="http://www.exet.tk">exet.tk</a></div>
        </div>
    </noscript>
    <!-- Page Head -->
    <h2>积分换购产品列表</h2>
    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="/administrator/business_integral_redemption/redemptionAdd"><span><br/> 添加积分<br/>换购产品 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/business_integral_redemption/redemptionList"><span><br/> 积分换购<br/>产品列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>积分换购产品列表</h3>
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
                        <th>抢购ID</th>
                        <th>产品ID</th>
                        <th>换购积分</th>
                        <th>产品价格</th>
                        <th>换购价格</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="13">
                            <div class="pagination"> <?php echo isset ($page_html) ? $page_html : '';?> </div>
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
                        <td><?php echo $v['redemption_id'];?></td>
                        <td><?php echo $v['pid'];?></td>
                        <td><?php echo $v['redemption_integral'];?></td>
                        <td><?php echo $v['price'] / 100;?></td>
                        <td><?php echo $v['redemption_price'] / 100;?></td>
                        <td><?php echo $v['start_time'];?></td>
                        <td><?php echo $v['end_time'];?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td>
                            <a href="/administrator/business_integral_redemption/redemptionEdit/<?php echo $v['redemption_id'].'/'.$current_page;?>" title="修改换购产品"><img src="/images/icons/pencil.png" alt="修改换购产品"></a>
                            <a href="/administrator/business_integral_redemption/redemptionDelete/<?php echo $v['redemption_id'].'/'.$current_page;?>" title="删除换购产品"><img src="/images/icons/cross.png" alt="删除换购产品"></a>
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