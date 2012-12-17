<?php require(APPPATH . 'views/administrator/bootstrap/header.php');?>
<?php require(APPPATH . 'views/administrator/bootstrap/navbar.php');?>
<div class="container-fluid" >
    <div class="row-fluid">
        <div class="span2">
            <?php require(__DIR__ . DS . '../leftnav.php');?>
        </div>
        <div class="span10">
            <?php require(__DIR__ . DS . '../subnav.php');?>

            <div class="page-header">
                <h4>文章设置</h4>
            </div>

            <form class="form-horizontal" method="post" action="<?php echo url('admin'),($type == 'edit') ? 'administrator/article/articleEditSave' : 'administrator/article/articleSave';?>" accept-charset="utf-8" enctype="multipart/form-data">
                <fieldset>
                    <div class="control-group">
                        <label for="input01" class="control-label">文章题目</label>

                        <div class="controls">
                            <input type="text" id="input01" class="input-xlarge" value="<?=isset($info['title']) ? $info['title'] : ''?>" name="title">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">文章分类</label>
                        <div class="controls">
                            <select name="cid">
                                <option value="0">文章分类</option>
                                <?php foreach ($class_data as $item): ?>
                                <option value="<?=$item['cid']?>" <?php if(isset($info['cid']) && $info['cid']==$item['cid'] ){echo 'selected="selected"';}?>><?=str_repeat("&nbsp;", $item['floor']), $item['cname']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>


                    <div class="control-group">
                        <label for="input02" class="control-label">SEO关键字</label>

                        <div class="controls">
                            <input type="text" id="input02" class="input-xlarge" value="<?=isset($info['keywords']) ? $info['keywords'] : ''?>" name="keyword">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input03" class="control-label">SEO描述</label>

                        <div class="controls">
                            <input type="text" id="input03" class="input-xxlarge" value="<?=isset($info['descr']) ? $info['descr'] : ''?>" name="descr">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">是否显示</label>

                        <div class="controls">
                            <label class="radio inline">
                                <input type="radio" value="1" <?=isset($info['visiblity']) && $info['visiblity'] == '1' ? 'checked="checked"' : '';?> name="visiblity"/> 显示
                            </label>
                            <label class="radio inline">
                                <input type="radio" value="0" <?=isset($info['visiblity']) && $info['visiblity'] == '0' ? 'checked="checked"' : '';?> name="visiblity"/> 不显示
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">是否置顶</label>

                        <div class="controls">
                            <label class="radio inline">
                                <input type="radio" value="1" <?=isset($info['top']) && $info['top'] == '1' ? 'checked="checked"' : '';?> name="top"/> 置顶
                            </label>
                            <label class="radio inline">
                                <input type="radio" value="0" <?=isset($info['top']) && $info['top'] == '0' ? 'checked="checked"' : '';?> name="top"/> 不置顶
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">文章内容</label>

                        <div class="controls">
                            <textarea rows="15" class="span9" name="content"><?=isset($info['content']) ? $info['content']: '';?></textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="hidden" name="id" value="<?=isset($info['id']) ? $info['id'] : ''?>">
                        <button class="btn btn-primary" type="submit">保存更改</button>
                        <button class="btn" type="reset">取消</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
<script charset="utf-8" src="<?=url('admin')?>scripts/kindeditor-4.1.1/kindeditor-min.js"></script>
<script charset="utf-8" src="<?=url('admin')?>scripts/kindeditor-4.1.1/lang/zh_CN.js"></script>
<script>
    $(function () {
        var editor = KindEditor.create('textarea[name="content"]', {
            uploadJson:'/administrator/attached/upload',
            fileManagerJson:'/administrator/attached/manager',
            resizeType:1,
            allowPreviewEmoticons:false,
            allowFileManager:true,
            allowImageUpload:true,
            items:[
                'source', 'preview', 'fullscreen','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'unlink']
        });
    });
</script>