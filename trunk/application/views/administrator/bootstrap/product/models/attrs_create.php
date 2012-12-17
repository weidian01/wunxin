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
                <h4>属性设置</h4>
            </div>

            <form class="form-horizontal" method="post" action="<?=url('admin')?>administrator/product_models/attrs_save">
                <div class="control-group">
                    <label class="control-label" for="input01">属性名称</label>

                    <div class="controls">
                        <input id="input01" type="text" class="input-medium" placeholder="属性名称"
                               value="<?=isset($attr_name) ? $attr_name : ''?>" name="attr_name">
                    </div>
                </div>

                <div class="form-actions">
                    <input type="hidden" name="attr_id" value="<?=isset($attr_id) ? $attr_id : ''?>">
                    <button type="submit" class="btn btn-primary">保存更改</button>
                    <button class="btn">取消</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>