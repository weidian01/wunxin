<?php require(APPPATH . 'views/administrator/bootstrap/header.php');?>
<?php require(APPPATH . 'views/administrator/bootstrap/navbar.php');?>
<div class="container-fluid" >
    <div class="row-fluid">
        <div class="span2">
            <?php require(__DIR__ . DS . 'leftnav.php');?>
        </div>
        <div class="span10">
            <?php require(__DIR__ . DS . 'subnav.php');?>

            <div class="page-header">
                <h4>活动设置</h4>
            </div>

            <form class="form-horizontal" method="post" action="<?php echo url('admin'),($type == 'edit') ? '/administrator/activity/activityEditSave' : '/administrator/activity/activitySave';?>">
                <fieldset>
                    <div class="control-group">
                        <label for="input01" class="control-label">活动主题</label>

                        <div class="controls">
                            <input type="text" id="input01" class="input-xlarge" value="<?=isset($info['subject']) ? $info['subject'] : ''?>" name="subject">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input02" class="control-label">活动开始时间</label>

                        <div class="controls">
                            <input type="text" id="input02" class="input-medium" value="<?=isset($info['start_time']) ? $info['start_time'] : ''?>" name="start_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input03" class="control-label">活动结束时间</label>

                        <div class="controls">
                            <input type="text" id="input03" class="input-medium" value="<?=isset($info['end_time']) ? $info['end_time'] : ''?>" name="end_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">活动发起方</label>
                        <div class="controls">
                            <select name="event_initiator">
                                <?php foreach ($event_initiator as $v):?>
                                <option value="<?=$v['id'];?>" <?=(isset ($info['event_initiator']) && $v['id'] == $info['event_initiator']) ? 'selected="selected"' : '' ?>><?=$v['name'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">活动状态</label>

                        <div class="controls">
                            <label class="radio inline">
                                <input type="radio" value="1" name="status" <?=isset($info['status']) && $info['status']=='1'  ? 'checked="checked"': '';?>/>进行中
                            </label>
                            <label class="radio inline">
                                <input type="radio" value="0" name="status" <?=isset($info['status']) && $info['status']=='0'  ? 'checked="checked"': '';?>/>终止
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input04" class="control-label">发起方名称</label>

                        <div class="controls">
                            <input type="text" id="input04" class="input-xlarge" value="<?=isset($info['initiator_name']) ? $info['initiator_name'] : ''?>" name="initiator_name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input05" class="control-label">发起方介绍</label>

                        <div class="controls">
                            <input type="text" id="input05" class="input-xxlarge" value="<?=isset($info['initiator_desc']) ? $info['initiator_desc'] : ''?>" name="initiator_desc">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">活动规范</label>

                        <div class="controls">
                            <textarea rows="15" class="span9" name="specification"><?=isset($info['specification']) ? $info['specification'] : ''?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">活动介绍</label>

                        <div class="controls">
                            <textarea rows="15" class="span9" name="descr"><?=isset($info['descr']) ? $info['descr'] : ''?></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="hidden" name="activity_id" value="<?=isset($info['activity_id']) ? $info['activity_id'] : ''?>">
                        <button class="btn btn-primary" type="submit">保存更改</button>
                        <button class="btn" type="reset">取消</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
<script language="javascript" type="text/javascript" src="<?=url('admin')?>scripts/My97DatePicker/WdatePicker.js"></script>
<script charset="utf-8" src="<?=url('admin')?>scripts/kindeditor-4.1.1/kindeditor-min.js"></script>
<script charset="utf-8" src="<?=url('admin')?>scripts/kindeditor-4.1.1/lang/zh_CN.js"></script>
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