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
    <h2><?php echo $type == 'edit' ? '编辑团购' : '添加团购'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_tuan/tuanAdd"><span><br/> 添加团购 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_tuan/tuanList"><span><br/> 团购列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加新团购</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?php echo $type == 'edit' ? '/administrator/business_tuan/tuanEditSave' : '/administrator/business_tuan/tuanSave';?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="tuan_id" value="<?php echo isset($info['tuan_id']) ? $info['tuan_id'] : ''?>">
                    <fieldset>
                        <p>
                            <label>产品ID</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['pid']) ? $info['pid'] : ''?>" name="pid" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>
                        <p>
                            <label>产品名称</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['pname']) ? $info['pname'] : ''?>" name="pname"/>
                            <br/>
                        </p>
                        <p>
                            <label>产品图片</label>
                            <input class="text-input small-input" type="file" value="<?php echo isset($info['img_addr']) ? $info['img_addr'] : ''?>" name="img_addr"/>
                            <?php echo isset ($info['img_addr']) ? '<img src="'.base_url(). str_replace('\\', '/', $info['img_addr']) .'" alt="'.$info['pname'].'" width="50" height="50"/>' : '';?>
                        </p>
                        <!--<p>
                            <label>团购价格</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['tuan_price']) ? $info['tuan_price'] : ''?>" name="tuan_price" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>-->
                        <p>
                            <label>库存量</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['inventory']) ? $info['inventory'] : ''?>" name="inventory" onkeyup="value=value.replace(/[^\d]/g, '')"/>
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
                            <label>折扣率</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['discount_rate']) ? $info['discount_rate'] : ''?>" name="discount_rate" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            例如：9.5折,写为：95
                            <br/>
                        </p>
                        <p>
                            <label>描述</label>
                            <textarea class="text-input textarea" name="descr" cols="50" rows="15" ><?php echo isset($info['descr']) ? $info['descr'] : ''?></textarea>
                            <br/>
                        </p>
                        <p>
                            <label>详细介绍</label>
                            <textarea class="text-input textarea" name="detail" cols="50" rows="15"><?php echo isset($info['detail']) ? $info['detail'] : ''?></textarea>
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