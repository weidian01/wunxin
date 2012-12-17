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
                <h4>属性值列表</h4>
            </div>

            <form class="form-horizontal" method="post" action="<?=url('admin')?>administrator/product_models/model_attr_value_save">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label"><?=$model_data['model_name']?> » <?=$attr_data['attr_name']?></label>
                        <div class="controls">
                            <label class="checkbox">
                                <input id="all_checked" type="checkbox">
                                全选
                            </label>
                            <?php foreach ($attrs as $item): ?>
                            <label class="checkbox">
                                <input type="checkbox" <?php if(isset($values[$item['value_id']])):?>checked="checked"<?php endif?> value="<?=$item['value_id']?>" name="value_id[]">
                                <?=$item['value_name']?>
                            </label>
                            <?php endforeach;?>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="hidden" name="model_id" value="<?=$model_id?>">
                        <input type="hidden" name="attr_id" value="<?=$attr_id?>">
                        <button class="btn btn-primary" type="submit">提交更改</button>
                        <button class="btn" type="reset">取消</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
<script>
    $(function($) {
        $("#all_checked").click(function () {
            var flag = this.checked;
            var list = $(this).parents('.controls');
            $('input:checkbox', list).attr('checked', flag);
        });
    });
</script>