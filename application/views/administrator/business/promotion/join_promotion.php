<?php include(APPPATH.'views/administrator/left.php');?>
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
    <h2><?=$type == 'edit' ? '编辑促销产品' : '添加促销产品'; ?></h2>
    <!-- Page Head -->
    <!--h2>分类列表</h2-->
    <!--p id="page-intro">产品分类管理</p-->
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
                            <input class="text-input small-input" type="text" value="<?=isset($product['pname']) ? $product['pname'] : ''?>" name="pname"/> <small>产品名称不能为空</small>
                        </p>
                        <p>
                            <label>分类</label>
                            <select name="cid" class="small-input">
                                <option value="0">默认</option>
                                <?php foreach ($category as $item): ?>
                                <option value="<?=$item['cid']?>" <?php if (isset($pProduct['cid']) && $pProduct['cid'] == $item['cid']) { echo 'selected="selected"'; }?>>
                                    <?=str_repeat("&nbsp;", $item['floor']), $item['name']?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </p>
                        <p>
                            <label>产品图片</label>
                            <input class="text-input small-input datepicker" type="file" name="product_image"/>
                            <?php if (isset ($pProduct['product_image']) && !empty ($pProduct['product_image'])){?>
                                <img src="<?=config_item('static_url')?><?=$pProduct['product_image']?>" alt="<?=$pProduct['pname']?>">
                            <?php } else { echo '没有产品图片!'; }?>
                        </p>
                        <!--p>
                            <label>促销价格</label>
                            <input class="text-input small-input datepicker" type="promotion_price" value="<?=isset($info['sort']) ? $info['sort'] : ''?>" name="sort" onkeyup="value=value.replace(/[^\d]/g, '')"/>分
                        </p-->
                        <p>
                            <label>开始时间</label>
                            <input class="text-input small-input datepicker" type="text" name="start_time" value="<?=isset ($pProduct['start_time']) ? $pProduct['start_time'] : '';?>"
                                   onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                        </p>
                        <p>
                            <label>结束时间</label>
                            <input class="text-input small-input datepicker" type="text" name="end_time" value="<?=isset ($pProduct['end_time']) ? $pProduct['end_time'] : '';?>"
                                   onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                        </p>
                        <p>
                            <label>库存量</label>
                            <input class="text-input small-input datepicker" type="text" name="inventory" onkeyup="value=value.replace(/[^\d]/g, '')"
                                   value="<?=isset ($pProduct['inventory']) ? $pProduct['inventory'] : '';?>"/>
                        </p>
                        <p>
                            <label>促销类型</label>
                            <select name="promotion_type" style="width: 400px;" id="promotion_type" onchange="promotion.init(this.value)">

                            </select>此处用来选择不同类型的活动
                            <br/>
                        </p>
                        <p>
                            <label>活动规则</label>
                            <input class="text-input small-input" type="text" value="<?=isset($pProduct['rule']) ? $pProduct['rule'] : ''?>" name="rule" id="rule_id"/>
                            <span id="rule_notice"></span>
                            <br/>
                        </p>
                        <p>
                            <label>排序</label>
                            <input class="text-input small-input datepicker" type="text" name="sort" onkeyup="value=value.replace(/[^\d]/g, '')"
                                   value="<?=isset ($pProduct['sort']) ? $pProduct['sort'] : '';?>"/>
                        </p>
                        <p>
                            <label>销售状态</label>
                            <select name="sales_status" style="width: 400px;">
                                <?php foreach ($sales_status as $ssk=>$ssv):?>
                                <option value="<?=$ssk?>" <?php if (isset($pProduct['sales_status']) && $pProduct['sales_status'] == $ssk) { echo 'selected="selected"'; }?>><?=$ssv?></option>
                                <?php endforeach;?>
                            </select><br/>
                        </p>
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

    <?php include(APPPATH.'views/administrator/footer.php');?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/promotion.js"></script>
<script type="text/javascript">
    promotion.init(2, '<?=isset ($info['promotion_type']) ? $info['promotion_type'] : '';?>', '<?=isset ($info['rule']) ? $info['rule'] : '';?>');
</script>