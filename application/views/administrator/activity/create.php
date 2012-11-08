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
    <h2><?php echo $type == 'edit' ? '编辑活动' : '添加活动'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/activity/activityAdd"><span><br/> 添加活动 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/activity/activityList"><span><br/> 活动列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加新活动</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?php echo $type == 'edit' ? '/administrator/activity/activityEditSave' : '/administrator/activity/activitySave';?>" method="post">
                    <input type="hidden" name="activity_id" value="<?php echo isset($info['activity_id']) ? $info['activity_id'] : ''?>">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>活动主题</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['subject']) ? $info['subject'] : ''?>" name="subject"/>
                            <br/>
                        </p>
                        <p>
                            <label>活动开始时间</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['start_time']) ? $info['start_time'] : ''?>" name="start_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                            <br/>
                        </p>
                        <p>
                            <label>活动结束时间</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['end_time']) ? $info['end_time'] : ''?>" name="end_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                            <br/>
                        </p>
                        <p>
                            <label>活动发起方</label>
                            <select name="event_initiator">
                                <?php foreach ($event_initiator as $v) {?>
                                <option value="<?php echo $v['id'];?>" <?php echo (isset ($info['event_initiator']) && $v['id'] == $info['event_initiator']) ? 'selected="selected"' : '' ?>><?php echo $v['name'];?></option>
                                <?php } ?>
                            </select>
                        </p>
                        <p>
                            <label>活动状态</label>
                            <input class="text-input " type="radio" value="1" name="status" <?php echo isset($info['status']) && $info['status']=='1'  ? 'checked="checked"': '';?>/>进行中
                            <input class="text-input " type="radio" value="0" name="status" <?php echo isset($info['status']) && $info['status']=='0'  ? 'checked="checked"': '';?>/>终止
                            <br/>
                        </p>
                        <p>
                            <label>发起方名称</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['initiator_name']) ? $info['initiator_name'] : ''?>" name="initiator_name"/>
                            <br/>
                        </p>
                        <p>
                            <label>发起方介绍</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['initiator_desc']) ? $info['initiator_desc'] : ''?>" name="initiator_desc"/>
                            <br/>
                        </p>

                        <p>
                            <label>活动规范</label>
                            <textarea class="text-input textarea" name="specification" cols="79" rows="15" ><?php echo isset($info['specification']) ? $info['specification'] : ''?></textarea>
                            <br/>
                        </p>
                        <p>
                            <label>活动介绍</label>
                            <textarea class="text-input textarea" name="descr" cols="79" rows="15" ><?php echo isset($info['descr']) ? $info['descr'] : ''?></textarea>
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
<script charset="utf-8" src="<?=config_item('static_url')?>scripts/kindeditor-4.1.1/kindeditor-min.js"></script>
<script charset="utf-8" src="<?=config_item('static_url')?>scripts/kindeditor-4.1.1/lang/zh_CN.js"></script>
<script>
    $(function () {
        var editor0 = KindEditor.create('textarea[name="specification"]', {
            uploadJson:'/administrator/attached/upload',
            fileManagerJson:'/administrator/attached/manager',
            resizeType:1,
            allowPreviewEmoticons:false,
            allowFileManager:true,
            allowImageUpload:true,
            items:[
                'source','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'unlink']
        });

        var editor1 = KindEditor.create('textarea[name="descr"]', {
            uploadJson:'/administrator/attached/upload',
            fileManagerJson:'/administrator/attached/manager',
            resizeType:1,
            allowPreviewEmoticons:false,
            allowFileManager:true,
            allowImageUpload:true,
            items:[
                'source','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'unlink']
        });
    });
</script>