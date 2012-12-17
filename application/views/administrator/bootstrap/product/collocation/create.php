<?php require(APPPATH . 'views/administrator/bootstrap/header.php');?>
<?php require(APPPATH . 'views/administrator/bootstrap/navbar.php');?>
<div class="container-fluid" >
    <div class="row-fluid">
        <div class="span2">
            <?php require(__DIR__ . DS . '../leftnav.php');?>
        </div>
        <div class="span10">
            <?php require(__DIR__ . DS . 'subnav.php');?>

            <div class="page-header">
                <h4>产品搭配设置</h4>
            </div>

            <form class="form-horizontal" method="post" action="<?php echo url('admin'),($type == 'edit') ? '/administrator/product_collocation/pcEditSave' : '/administrator/product_collocation/pcSave';?>">
                <fieldset>
                    <div class="control-group">
                        <label for="input01" class="control-label">产品ID</label>

                        <div class="controls">
                            <input type="text" id="input01" class="input-medium" value="<?=isset($info['pid']) ? $info['pid'] : ''?>" name="pid" onkeyup="value=value.replace(/[^\d]/g, '')">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input02" class="control-label">被搭配的产品ID</label>

                        <div class="controls">
                            <input type="text" id="input02" class="input-medium" value="<?=isset($info['spid']) ? $info['spid'] : ''?>" name="spid" onkeyup="value=value.replace(/[^\d]/g, '')">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input03" class="control-label">排序</label>

                        <div class="controls">
                            <input type="text" id="input03" class="input-medium" value="<?=isset($info['sort']) ? $info['sort'] : ''?>" name="sort" onkeyup="value=value.replace(/[^\d]/g, '')">
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
