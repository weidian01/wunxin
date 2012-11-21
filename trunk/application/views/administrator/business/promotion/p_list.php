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
    <h2>促销产品列表</h2>
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
            <h3>促销产品列表</h3>
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
                        <th>所属活动</th>
                        <th>产品ID</th>
                        <th>产品图片</th>
                        <th>产品名称</th>
                        <th>销售价格</th>
                        <th>促销价格</th>
                        <th>分类</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>库存量</th>
                        <th>销售状态</th>
                        <th>规则</th>
                        <th>排序</th>
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
                        <td style="width: 100px;">
                            <a href="<?=config_item('static_url')?>administrator/business_promotion_product/lists/<?=empty($current_page) ? '0' : $current_page.'/'.$v['promotion_id'];?>">
                                <?=$promotion[$v['promotion_id']]['name'];?>
                            </a>
                        </td>
                        <td><?=$v['pid'];?></td>
                        <td>
                            <a href="<?=productURL($v['pid'])?>" target="_blank" title="<?=$v['pname'];?>">
                                <img src="<?=empty ($v['product_image']) ? config_item('img_url').'product/'.intToPath($v['pid']).'icon.jpg' : config_item('static_url').str_replace('\\', '/', $v['product_image']);?>" width="60" height="60"/>
                            </a>
                        </td>
                        <td style="width: 150px;"><a href="<?=productURL($v['pid'])?>" target="_blank" title="<?=$v['pname'];?>"><?=$v['pname'];?></a></td>
                        <td>￥<?=fPrice($v['sell_price']);?></td>
                        <td>￥<?=fPrice($v['promotion_price']);?></td>
                        <td style="width: 60px;">
                            <a href="<?=config_item('static_url')?>administrator/business_promotion_product/lists/<?=empty($current_page) ? '0' : $current_page.'/'.( empty ($promotion_id) ? '0' : $promotion_id).'/'.$v['cid'];?>">
                                <?=$category[$v['cid']]['name'];?>
                            </a>
                        </td>
                        <td><?=$v['start_time'];?></td>
                        <td><?=$v['end_time'];?></td>
                        <td><?=$v['inventory'];?></td>
                        <td><?=$sales_status[$v['sales_status']];?></td>
                        <td><?=$v['rule'];?></td>
                        <td><?=$v['sort'];?></td>
                        <td><?=$v['create_time'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/business_promotion_product/edit/<?=$v['id'];?>" title="编辑">
                                <img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑"></a>
                            <a href="<?=config_item('static_url')?>administrator/business_promotion_product/delete/<?=$v['id'];?>" title="删除">
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