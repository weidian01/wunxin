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
                <h4>属性值设置</h4>
            </div>

            <form class="form-horizontal" method="post" action="<?=url('admin')?>administrator/product_models/value_save">
                <div class="control-group">
                    <label class="control-label" for="input01">属性值</label>

                    <div class="controls">
                        <input id="input01" type="text" class="input-medium" placeholder="属性名称" value="<?=isset($value['value_name']) ? $value['value_name'] : ''?>" name="value_name">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">属性</label>

                    <div class="controls">
                        <select name="attr_id" class="span1">
                            <?php foreach ($attrs as $item): ?>
                            <option value="<?=$item['attr_id']?>" <?php if (isset($value['attr_id']) && $item['attr_id'] == $value['attr_id']): ?>selected="selected"<?php endif;?>><?=$item['attr_name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <input type="hidden" name="value_id" value="<?=isset($value['value_id']) ? $value['value_id'] : ''?>">
                    <button type="submit" class="btn btn-primary">保存更改</button>
                    <button class="btn">取消</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>