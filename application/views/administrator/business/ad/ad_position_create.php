<?php include(APPPATH.'views/administrator/left.php');?>
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
    <h2><?php echo $type == 'edit' ? '编辑广告位置' : '添加广告位置'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_ad_position/positionAdd"><span><br/> 添加广告位置 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_ad_position/positionList"><span><br/> 广告位置列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_ad/adAdd"><span><br/> 添加广告 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_ad/adList"><span><br/> 广告列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加广告位置</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?php echo $type == 'edit' ? '/administrator/business_ad_position/positionEditSave' : '/administrator/business_ad_position/positionSave';?>" method="post">
                    <input type="hidden" name="position_id" value="<?php echo isset($info['position_id']) ? $info['position_id'] : ''?>">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>位置名称</label>
                            <input class="text-input" type="text" value="<?php echo isset($info['name']) ? $info['name'] : ''?>" name="name"/>
                            <br/>
                        </p>
                        <p>
                            <label>宽度</label>
                            <input class="text-input" type="text" value="<?php echo isset($info['width']) ? $info['width'] : ''?>" name="width" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                        </p>
                        <p>
                            <label>高度</label>
                            <input class="text-input datepicker" type="text" value="<?php echo isset($info['height']) ? $info['height'] : ''?>" name="height" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                        </p>
                        <p>
                            <label>显示数量</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['view_num']) ? $info['view_num'] : ''?>" name="view_num" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>
                        <p>
                            <label>状态</label>
                            <input class="text-input " type="radio" value="1" name="status" <?php if (!isset ($info['status']))$info['status'] = '';echo $info['status'] ? 'checked="checked"' : '';?>/>显示
                            <input class="text-input " type="radio" value="0" name="status" <?php if (!isset ($info['status']))$info['status'] = '';echo $info['status'] ? '' : 'checked="checked"';?>/>不显示
                            <br/>
                        </p>
                        <p>
                            <label>描述</label>
                            <textarea class="text-input textarea" name="descr" cols="50" rows="15"><?php echo isset ($info['descr']) ? $info['descr'] : '';?></textarea>
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

    <!-- <div class="clear"></div> -->
    <?php include(APPPATH.'views/administrator/footer.php');?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
