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
    <h2><?php echo $type == 'edit' ? '编辑积分换购产品' : '添加积分换购产品'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_integral_redemption/redemptionAdd"><span><br/> 添加积分<br/>换购产品 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_integral_redemption/redemptionList"><span><br/> 积分换购<br/>产品列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加新积分换购产品</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?php echo $type == 'edit' ? '/administrator/business_integral_redemption/redemptionEditSave' : '/administrator/business_integral_redemption/redemptionSave';?>" method="post">
                    <input type="hidden" name="redemption_id" value="<?php echo isset($info['redemption_id']) ? $info['redemption_id'] : ''?>">
                    <fieldset>
                        <p>
                            <label>产品ID</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['pid']) ? $info['pid'] : ''?>" name="pid" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>
                        <p>
                            <label>换购积分</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['redemption_integral']) ? $info['redemption_integral'] : ''?>" name="redemption_integral" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>
                        <p>
                            <label>换购价格</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['redemption_price']) ? $info['redemption_price'] / 100 : ''?>" name="redemption_price" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>
                        <p>
                            <label>开始时间</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['start_time']) ? $info['start_time'] : ''?>" name="start_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                            <br/>
                        </p>
                        <p>
                            <label>结束时间</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['end_time']) ? $info['end_time'] : ''?>" name="end_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                            <br/>
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

    <?php require(dirname(__FILE__) . '/../../footer.php'); ?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>