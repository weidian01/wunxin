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
    <h2>限时抢购列表</h2>
    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="/administrator/business_limit_buy/create"><span><br/> 添加限时抢购 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/business_limit_buy/lists"><span><br/> 限时抢购列表 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/business_limit_buy/c_list"><span><br/> 限时抢购<br/>分类列表 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/business_limit_buy/c_create"><span><br/> 限时抢购<br/>分类添加 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>限时抢购列表</h3>
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
                        <th>ID</th>
                        <th>分类</th>
                        <th>产品ID</th>
                        <th>产品名称</th>
                        <th>图片</th>
                        <th>销售价格</th>
                        <th>抢购价格</th>
                        <th>节省</th>
                        <th>关注人数</th>
                        <th>库存量</th>
                        <th>抢购数量</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
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
                        <td><?php echo $v['id'];?></td>
                        <td><?php echo $v['cid'];?></td>
                        <td><?php echo $v['pid'];?></td>
                        <td><?php echo $v['pname'];?></td>
                        <td><img src="<?php echo base_url(). str_replace('\\', '/', $v['product_image']);?>" alt="<?php echo $v['pname'];?>" width="50" height="50"/> </td>
                        <td><?php echo fPrice($v['sell_price']);?></td>
                        <td><?php echo fPrice($v['limit_buy_price']);?></td>
                        <td><?php echo fPrice($v['sell_price'] - $v['limit_buy_price']);?></td>
                        <td><?php echo $v['attention_num'];?></td>
                        <td><?php echo $v['inventory'];?></td>
                        <td><?php echo $v['limit_buy_num'];?></td>
                        <td><?php echo $v['start_time'];?></td>
                        <td><?php echo $v['end_time'];?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td>
                            <a href="/administrator/business_tuan/tuanView/<?php echo $v['id'];?>" title="查看订单"><img src="/images/icons/view.png" alt="查看订单"></a>
                            <a href="/administrator/business_tuan/tuanEdit/<?php echo $v['id'];?>" title="编辑团购"><img src="/images/icons/pencil.png" alt="编辑团购"/></a>
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