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
    <h2>促销分类列表</h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/business_promotion/create"><span><br/> 添加促销 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/business_promotion/lists"><span><br/> 促销列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/business_promotion_category/lists"><span><br/> 促销分类列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/business_promotion_product/lists"><span><br/> 促销产品列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>促销分类列表</h3>
            <!--ul class="content-box-tabs">
<li><a href="#tab1" class="default-tab">Table</a></li>
<!-- href must be unique and match the id of target div -->
            <!--li><a href="#tab2">Forms</a></li>
        </ul-->
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <!-- This is the target div. id must match the href of this div's tab -->
                <table>
                    <thead>
                    <tr>
                        <th>
                            <input class="check-all" type="checkbox"/>
                        </th>
                        <th>分类ID</th>
                        <th>分类名称</th>
                        <th>所属活动</th>
                        <th>分类级别</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($category as $item): ?>
                    <tr>
                        <td>
                            <input type="checkbox"/>
                        </td>
                        <td><?=$item['cid'];?></td>
                        <td><?php echo str_repeat("&nbsp;", $item['floor'] * 4), $item['name'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>/administrator/business_promotion_category/lists/<?=empty($current_page) ? '0' : $current_page.'/'.$item['promotion_id'];?>">
                                <?=$promotion[$item['promotion_id']]['name']?>
                            </a>
                        </td>
                        <td><?=$item['floor']?></td>
                        <td><?=$item['sort']?></td>
                        <td>
                            <a href="<?php echo url("administrator/business_promotion_category/edit/{$item['cid']}")?>">
                                <img src="<?=config_item('static_url')?>/images/icons/pencil.png" alt="Edit"/></a>
                            <a href="<?php echo url("administrator/business_promotion_category/delete/{$item['cid']}")?>">
                                <img src="<?=config_item('static_url')?>/images/icons/cross.png" alt="Delete"/></a>
                        </td>
                    </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!-- End #tab1 -->
        </div>
        <!-- End .content-box-content -->
    </div>

    <div class="clear"></div>
    <?php require(dirname(__FILE__) . '/../../footer.php'); ?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>