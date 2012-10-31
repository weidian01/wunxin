<?php require(dirname(__FILE__) . '/../../left.php'); ?>
<div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
        <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div> Javascript is disabled or is not supported by your browser. Please
                <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a>
                your browser or
                <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a>
                Javascript to navigate the interface properly. Download From <a href="http://www.exet.tk">exet.tk</a>
            </div>
        </div>
    </noscript>
    <h2><?php echo $type == 'edit' ? '编辑促销产品' : '添加促销产品'; ?></h2>
    <!-- Page Head -->
    <!--h2>分类列表</h2-->
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
            <h3>活动：<?=$promotion['name']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                产品名称：<?=$product['pname'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                销售价格：<?=fPrice($product['sell_price']);?>元
            </h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?=url('administrator/business_promotion_product/save')?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="promotion_id" value="<?=isset ($promotion['promotion_id']) ? $promotion['promotion_id'] : '';?>"/>
                    <input type="hidden" name="pid" value="<?=isset ($product['pid']) ? $product['pid'] : '';?>"/>
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>产品名称</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($product['pname']) ? $product['pname'] : ''?>" name="pname"/> <small>产品名称不能为空</small>
                        </p>
                        <p>
                            <label>分类</label>
                            <select name="cid" class="small-input">
                                <option value="0">默认</option>
                                <?php foreach ($category as $item): ?>
                                <option
                                    value="<?=$item['cid']?>" <?php if (isset($info['parent_id']) && $info['parent_id'] == $item['cid']) {
                                    echo 'selected="selected"';
                                }?>><?php echo str_repeat("&nbsp;", $item['floor']), $item['name']?></option>
                                <?php endforeach;?>
                            </select>
                        </p>
                        <p>
                            <label>产品图片</label>
                            <input class="text-input small-input datepicker" type="file" name="product_image"/>
                        </p>
                        <!--p>
                            <label>促销价格</label>
                            <input class="text-input small-input datepicker" type="promotion_price" value="<?php echo isset($info['sort']) ? $info['sort'] : ''?>" name="sort" onkeyup="value=value.replace(/[^\d]/g, '')"/>分
                        </p-->
                        <p>
                            <label>开始时间</label>
                            <input class="text-input small-input datepicker" type="text" name="start_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                        </p>
                        <p>
                            <label>结束时间</label>
                            <input class="text-input small-input datepicker" type="text" name="end_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                        </p>
                        <p>
                            <label>库存量</label>
                            <input class="text-input small-input datepicker" type="text" name="inventory" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                        </p>
                        <p>
                            <label>排序</label>
                            <input class="text-input small-input datepicker" type="text" name="sort" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                        </p>
                        <p>
                            <label>销售状态</label>
                            <select name="sales_status" style="width: 400px;">
                                <?php foreach ($sales_status as $ssk=>$ssv):?>
                                <option value="<?=$ssk?>" ><?=$ssv?></option>
                                <?php endforeach;?>
                            </select><br/>
                        </p>
                        <!-- start 此处处理添加不同类型活动的表单 start -->
                        <?php if ($promotion['promotion_type'] == PT_DISCOUNT):?>
                            <p>
                                <label>折扣</label>
                                <input class="text-input small-input datepicker" value="<?=isset($info['rule']) ? $info['rule'] : ''?>"
                                       type="text" name="discount" onkeyup="value=value.replace(/[^\d]/g, '')"/>折， 例：7.5折，填写75。
                            </p>
                        <?php  elseif ($promotion['promotion_type'] == PT_LIMIT_BUY):?>
                            <p>
                                <label>折扣</label>
                                <input class="text-input small-input datepicker" value="<?=isset($info['rule']) ? $info['rule'] : ''?>"
                                       type="text" name="discount" onkeyup="value=value.replace(/[^\d]/g, '')"/>折， 例：7.5折，填写75。
                            </p>
                        <?php endif;?>
                        <!-- end 此处处理添加不同类型活动的表单 end -->
                        <p>
                            <input class="button" type="submit" value="Submit"/>
                        </p>
                    </fieldset>
                    <div class="clear"></div>
                    <!-- End .clear -->
                </form>
            </div>
            <!-- End #tab2 -->
        </div>
        <!-- End .content-box-content -->
    </div>
    <!-- End .content-box -->

    <div class="clear"></div>

    <?php require(dirname(__FILE__) . '/../../footer.php'); ?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
