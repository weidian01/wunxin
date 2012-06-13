<?php require(dirname(__FILE__).'/../common.php');?>
<body>
<form action="<?=url('administrator/product_model/save')?>" method="post">
    <div> 模型名称:<input name="model_name" type="text" value="<?=$model_name?>"/>
        <input type="hidden" name="model_id" value="<?=$model_id?>"> <a href="javascript:;">添加属性</a></div>

    <table>
        <?php foreach ($attrs as $attr): ?>
        <tr>
            <td>属性名:<input type="text" name="attr_name[]" value="<?=$attr['attr_name']?>"><input type="text" name="attr_id[]" value="<?=$attr['attr_id']?>"></td>
            <td>类型:<select name="type[]" style="width:20px">
                <option value="1" <?php if($attr['type']==1) echo 'selected="selected"';?>>单选</option>
                <option value="2" <?php if($attr['type']==2) echo 'selected="selected"';?>>复选</option>
                <option value="3" <?php if($attr['type']==3) echo 'selected="selected"';?>>下拉</option>
                <option value="4" <?php if($attr['type']==4) echo 'selected="selected"';?>>文本</option>
            </select></td>
            <td>属性值:<input type="text" name="attr_value[]" value="<?=$attr['attr_value']?>">注释:多个参数使用半角逗号分割</td>
            <td>排序:<input type="text" name="sort[]" size="2" value="<?=$attr['attr_sort']?>"></td>
        </tr>
        <?php endforeach;?>
    </table>

    <input type="submit" value="save">
</form>
</body>
</html>