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
    <h2><?php echo $type == 'edit' ? '编辑促销活动' : '添加促销活动'; ?></h2>
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
            <h3><?php echo $type == 'edit' ? '编辑促销活动' : '添加促销活动'; ?></h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="/administrator/business_promotion/save" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="promotion_id" value="<?=isset($info['promotion_id']) ? $info['promotion_id'] : ''?>">
                    <fieldset>
                        <p>
                            <label>活动名称</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['name']) ? $info['name'] : ''?>" name="name"/>
                            <br/>
                        </p>
                        <p>
                            <label>促销范围</label>
                            <select name="promotion_range" style="width: 400px;">
                                <?php foreach ($promotion_range as $prk=>$prv): ?>
                                <option value="<?=$prk;?>" <?php if (isset($info['promotion_range']) && $info['promotion_range'] == $prk) { echo 'selected="selected"'; }?>>
                                    <?=$prv;?>
                                </option>
                                <?php endforeach;?>
                            </select><br/>
                        </p>
                        <p>
                            <label>促销类型</label>
                            <select name="promotion_type" style="width: 400px;">
                                <?php foreach ($promotion_type as $ptk=>$ptv): ?>
                                <option value="<?=$ptk;?>" <?php if (isset($info['promotion_type']) && $info['promotion_type'] == $ptk) { echo 'selected="selected"'; }?>>
                                    <?=$ptv;?>
                                </option>
                                <?php endforeach;?>
                            </select><br/>
                        </p>
                        <p>
                            <label>是否并列</label>
                            <select name="is_juxtaposed" style="width: 400px;">
                                <?php foreach ($promotion_juxtaposed as $pjk=>$pjv): ?>
                                <option value="<?=$pjk;?>" <?php if (isset($info['is_juxtaposed']) && $info['promotion_type'] == $pjk) { echo 'selected="selected"'; }?>>
                                    <?=$pjv;?>
                                </option>
                                <?php endforeach;?>
                            </select><br/>
                        </p>
                        <p>
                            <label>优先级</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['priority']) ? $info['priority'] : ''?>" name="priority"/>
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
                            <label>描述</label>
                            <textarea class="text-input textarea" name="descr" cols="79" rows="15"><?=isset($info['descr']) ? $info['descr'] : ''?></textarea>
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

    <?php include(APPPATH.'views/administrator/footer.php');?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
<script charset="utf-8" src="<?=config_item('static_url')?>scripts/kindeditor-4.1.1/kindeditor-min.js"></script>
<script charset="utf-8" src="<?=config_item('static_url')?>scripts/kindeditor-4.1.1/lang/zh_CN.js"></script>
<script>
$(function () {
    var editor = KindEditor.create('textarea[name="detail"]', {
        //uploadJson:'/plug/kindeditor-4.1.1/php/upload_json.php',
        uploadJson:'/administrator/attached/upload',
        //fileManagerJson:'/plug/kindeditor-4.1.1/php/file_manager_json.php',
        fileManagerJson:'/administrator/attached/manager',
        resizeType:1,
        allowPreviewEmoticons:false,
        allowFileManager:true,
        allowImageUpload:true,
        items:[
            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
            'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'unlink']
    });
});

</script>