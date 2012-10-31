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
    <h2>团购列表</h2>
    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/business_tuan/tuanAdd"><span><br/> 添加团购 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/business_tuan/tuanList"><span><br/> 团购列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>团购列表</h3>
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
                        <th>团购ID</th>
                        <th>产品ID</th>
                        <th>产品名称</th>
                        <th>图片</th>
                        <th>销售价格</th>
                        <th>团购价格</th>
                        <th>状态</th>
                        <th>库存量</th>
                        <th>团购数量</th>
                        <th>详细介绍</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>折扣率</th>
                        <th>节省</th>
                        <th>描述</th>
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
                        <td><?php echo $v['tuan_id'];?></td>
                        <td><?php echo $v['pid'];?></td>
                        <td><?php echo $v['pname'];?></td>
                        <td><img src="<?php echo base_url(). str_replace('\\', '/', $v['product_images']);?>" alt="<?php echo $v['pname'];?>" width="50" height="50"/> </td>
                        <td><?php echo $v['sell_price'] / 100;?></td>
                        <td><?php echo $v['tuan_price'] / 100;?></td>
                        <td><?php echo $v['status'] ? '正常团购' : '已结束团购';?></td>
                        <td><?php echo $v['inventory'];?></td>
                        <td><?php echo $v['tuan_num'];?></td>
                        <td><?php echo $v['detail'];?></td>
                        <td><?php echo $v['start_time'];?></td>
                        <td><?php echo $v['end_time'];?></td>
                        <td><?php echo $v['discount_rate'];?></td>
                        <td><?php echo $v['save'] / 100;?></td>
                        <td><?php echo $v['descr'];?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>/administrator/business_tuan/tuanView/<?php echo $v['tuan_id'];?>" title="查看订单"><img src="<?=config_item('static_url')?>/images/icons/view.png" alt="查看订单"></a>
                            <a href="<?=config_item('static_url')?>/administrator/business_tuan/tuanEdit/<?php echo $v['tuan_id'];?>" title="编辑团购"><img src="<?=config_item('static_url')?>/images/icons/pencil.png" alt="编辑团购"/></a>
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