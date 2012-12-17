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
                <h4>文章分类设置</h4>
            </div>

            <form class="form-horizontal" action="<?php echo url('admin'),($type == 'edit') ? 'administrator/article_category/categoryEditSave' : 'administrator/article_category/categorySave';?>" method="post">
                <fieldset>
                    <div class="control-group">
                        <label for="input00" class="control-label">分类名称</label>

                        <div class="controls">
                            <input type="text" id="input00" class="input-medium" value="<?=isset($info['cname']) ? $info['cname'] : ''?>" name="cname">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="select01" class="control-label">上级分类</label>

                        <div class="controls">
                            <select name="parent_id">
                                <option value="0">顶级分类</option>
                                <?php foreach ($data as $item): ?>
                                <option value="<?=$item['cid']?>" <?php if(isset($info['parent_id']) && $info['parent_id']==$item['cid'] ){echo 'selected="selected"';}?>><?=str_repeat("&nbsp;", $item['floor']), $item['cname']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input01" class="control-label">排序</label>

                        <div class="controls">
                            <input type="text" id="input01" class="input-medium" value="<?=isset($info['sort']) ? $info['sort'] : ''?>" name="sort">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input02" class="control-label">存储路径</label>

                        <div class="controls">
                            <input type="text" id="input02" class="input-xlarge" value="<?=isset($info['path']) ? $info['path'] : ''?>" name="path">
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="hidden" name="cid" value="<?=isset($info['cid']) ? $info['cid'] : ''?>">
                        <button class="btn btn-primary" type="submit">保存更改</button>
                        <button class="btn" type="reset">取消</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
