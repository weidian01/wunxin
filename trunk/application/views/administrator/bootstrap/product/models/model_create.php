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
                <h4>模型设置</h4>
            </div>
            <form class="form-horizontal" action="<?=url('admin')?>administrator/product_models/model_save" method="post">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="input01">模型名称</label>

                        <div class="controls">
                            <input type="text" class="input-xlarge" id="input01" value="<?=isset($model['model_name']) ? $model['model_name'] : ''?>" name="model_name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">扩展属性 <a href="javascript:add_attr();"><i class="icon-plus-sign"></i>添加</a></label>
                        <div class="controls">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>属性名称</th>
                                    <th>类型</th>
                                    <th>排序</th>
                                    <th>是否可搜索</th>
                                    <th>默认显示</th>
                                    <th>删除</th>
                                    <th>添加属性值</th>
                                <tr>
                                </thead>
                                <tbody id="attrs">
                                <?php foreach($attr_conf as $item):?>
                                <tr>
                                    <td><input type="hidden" name="id[]" value="<?=isset($item['id']) ? $item['id']: 0;?>">
                                        <select class="span2" name="attr_id[]"><option value="0">属性选择</option>
                                            <?php foreach($attrs as $attr):?>
                                                <option value="<?=$attr['attr_id']?>" <?php if($item['attr_id'] == $attr['attr_id']):?>selected="selected"<?php endif;?>><?=$attr['attr_name']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </td>
                                    <td><select class="span2" name="type[]"><option value="1" <?php if($item['type'] == 1):?>selected="selected"<?php endif;?>>单选</option><option value="2" <?php if($item['type'] == 2):?>selected="selected"<?php endif;?>>复选</option></select></td>
                                    <td><input class="input-mini" name="sort[]" value="<?=isset($item['sort']) ? $item['sort']: 0;?>" type="text"></td>
                                    <td><select class="span2" name="search[]"><option value="1" <?php if($item['search'] == 1):?>selected="selected"<?php endif;?>>是</option><option value="0" <?php if($item['search'] == 0):?>selected="selected"<?php endif;?>>否</option></select></td>
                                    <td><select class="span2" name="display[]"><option value="1" <?php if($item['display'] == 1):?>selected="selected"<?php endif;?>>显示</option><option value="0" <?php if($item['display'] == 0):?>selected="selected"<?php endif;?>>隐藏</option></select></td>
                                    <td><button onclick="del_attr(this)" class="btn btn-mini btn-danger" href="#"><i class="icon-trash icon-white"></i> 删除</button></td>
                                    <td><a class="btn btn-mini btn-success" href="<?=url('admin')?>administrator/product_models/model_attr_value_edit/<?=$item['model_id']?>/<?=$item['attr_id']?>" target="_blank"><i class="icon-plus icon-white"></i>添加</a></td>
                                </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="hidden" name="model_id" value="<?=isset($model['model_id']) ? $model['model_id'] : ''?>">
                        <button type="submit" class="btn btn-primary">保存更改</button>
                        <button class="btn">取消</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
<script>
    function add_attr() {
        var attrs = '<select class="span2" name="attr_id[]"><option value="0">属性选择</option><?php foreach ($attrs as $attr): ?><option value="<?= $attr['attr_id'] ?>"><?= $attr['attr_name'] ?></option><?php endforeach;?></select>';
        $("#attrs").append('<tr><td>' + attrs + '</td><td><select class="span2" name="type[]"><option value="1">单选</option><option value="2">复选</option></select></td><td><input class="input-mini" type="text" name="sort[]" value="0"></td><td><select class="span2" name="search[]"><option value="1">是</option><option value="0">否</option></select></td><td><select class="span2" name="display[]"><option value="1">显示</option><option value="0">隐藏</option></select></td><td><button onclick="del_attr(this)" class="btn btn-small btn-danger" href="#"><i class="icon-trash icon-white"></i> 删除</button></td><td><a class="btn btn-small btn-success disabled" href="javascript:;"><i class="icon-plus icon-white"></i>添加</a></td></tr>');
    }

    function del_attr(obj) {
        $(obj).parents('tr').remove();
    }
</script>