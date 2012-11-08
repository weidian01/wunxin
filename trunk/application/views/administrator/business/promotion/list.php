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
    <h2>促销活动列表</h2>
    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_promotion/create"><span><br/> 添加促销 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_promotion/lists"><span><br/> 促销列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_promotion_category/lists"><span><br/> 促销分类列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_promotion_product/lists"><span><br/> 促销产品列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>促销活动列表</h3>
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
                        <th>名称</th>
                        <th>促销范围</th>
                        <th>促销类型</th>
                        <th>是否并列</th>
                        <th>优先级</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>描述</th>
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
                        <td><?=$v['promotion_id'];?></td>
                        <td><?=$v['name']?></td>
                        <td><?=$promotion_range[$v['promotion_range']];?></td>
                        <td><?=$promotion_type[$v['promotion_type']];?></td>
                        <td><?=$promotion_juxtaposed[$v['is_juxtaposed']];?></td>
                        <td><?=$v['priority'];?></td>
                        <td><?=$v['start_time'];?></td>
                        <td><?=$v['end_time'];?></td>
                        <td><?=$v['descr'];?></td>
                        <td><?=$v['create_time'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/business_promotion_product/p_create/<?=$v['promotion_id'];?>" title="为此活动添加产品">加产品</a>
                            <a href="<?=config_item('static_url')?>administrator/business_promotion_category/create/<?=$v['promotion_id'];?>" title="为此活动添加产品">加分类</a><br/>
                            <a href="<?=config_item('static_url')?>administrator/business_promotion/edit/<?=$v['promotion_id'];?>" title="编辑">
                                <img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑"></a>
                            <a href="<?=config_item('static_url')?>administrator/business_promotion/delete/<?=$v['promotion_id'];?>" title="删除">
                                <img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除"/></a>
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