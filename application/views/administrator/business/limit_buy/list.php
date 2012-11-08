<?php include(APPPATH.'views/administrator/left.php');?>
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
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_limit_buy/create"><span><br/> 添加限时抢购 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_limit_buy/lists"><span><br/> 限时抢购列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_limit_buy/c_list"><span><br/> 限时抢购<br/>分类列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_limit_buy/c_create"><span><br/> 限时抢购<br/>分类添加 </span></a></li>
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
                        <th>销售状态</th>
                        <th>产品ID</th>
                        <th>产品名称</th>
                        <th>图片</th>
                        <th>销售价格</th>
                        <th>抢购价格</th>
                        <th>节省</th>
                        <th>关注人数</th>
                        <th>库存量</th>
                        <th>抢购数量</th>
                        <th>排序</th>
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
                                <?=isset ($page_html) ? $page_html : '';?>
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
                        <td><?=$v['id'];?></td>
                        <td><?php foreach ($category as $vs) {
                            if ($vs['id'] == $v['cid']) echo $vs['name'];
                        }?></td>
                        <td><?php
                            switch ($v['sales_status']) {
								case '1':$names = '疯抢';break;
								case '2':$names = '包邮';break;
								case '3':$names = '热卖';break;
								case '4':$names = '新品';break;
								default: $names = '默认';
						}
                            echo $names;?></td>
                        <td><?=$v['pid'];?></td>
                        <td><?=$v['pname'];?></td>
                        <td><img src="<?=base_url(). str_replace('\\', '/', $v['product_image']);?>" alt="<?=$v['pname'];?>" width="50" height="50"/> </td>
                        <td><?=fPrice($v['sell_price']);?></td>
                        <td><?=fPrice($v['limit_buy_price']);?></td>
                        <td><?=fPrice($v['sell_price'] - $v['limit_buy_price']);?></td>
                        <td><?=$v['attention_num'];?></td>
                        <td><?=$v['inventory'];?></td>
                        <td><?=$v['limit_buy_num'];?></td>
                        <td><?=$v['sort'];?></td>
                        <td><?=$v['start_time'];?></td>
                        <td><?=$v['end_time'];?></td>
                        <td><?=$v['create_time'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/business_limit_buy/edit/<?=$v['id'];?>" title="编辑"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑"></a>
                            <a href="<?=config_item('static_url')?>administrator/business_limit_buy/del/<?=$v['id'];?>" title="删除"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除"/></a>
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