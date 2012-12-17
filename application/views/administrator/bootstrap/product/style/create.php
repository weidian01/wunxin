<?php require(APPPATH . 'views/administrator/bootstrap/header.php');?>
<?php require(APPPATH . 'views/administrator/bootstrap/navbar.php');?>
<div class="container-fluid" >
    <div class="row-fluid">
        <div class="span2">
            <?php require(__DIR__ . DS . '../leftnav.php');?>
        </div>
        <div class="span10">

            <div class="page-header">
                <h4>添加款式关联</h4>
            </div>

            <form class="form-horizontal" method="post" action="<?=url('admin')?>administrator/product_style/save">
                <div class="control-group">
                    <label for="input01" class="control-label">关联多个产品</label>
                    <div class="controls">
                        <input id="input01" name="pid" type="text" class="input-xxlarge" placeholder="多个产品id用半角逗号分割">
                    </div>
                </div>
                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">保存更改</button>
                    <button class="btn" type="reset">取消</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
