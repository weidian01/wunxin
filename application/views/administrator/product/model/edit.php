<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>万象电子商务后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css" media="all">
        @import url(/css/style.css);

        img {
            behavior: url('/js/iepngfix.htc') !important;
        }
    </style>
    <script src="/js/jquery.js" type="text/javascript"></script>
    <script src="/js/jquery_ui.js" type="text/javascript"></script>
    <script src="/js/wysiwyg.js" type="text/javascript"></script>
    <script src="/js/functions.js" type="text/javascript"></script>

</head>
<body>
<form action="<?=url('administrator/product/model_save')?>" method="post">
    <div> 模型名称:<input name="model_name" type="text" value="<?=$model_name?>"/>
        <input type="hidden" name="model_id" value="<?=$model_id?>"> <a href="javascript:;">添加属性</a></div>

    <table>
        <?php foreach ($attrs as $attr): ?>
        <tr>
            <td>属性名:<input type="text" name="attr_name[]" value="<?=$attr['attr_name']?>"></td>
            <td>类型:<select name="type[]" style="width:20px">
                <option value="1" <?php if($attr['type']==1) echo 'selected="selected"';?>>单选</option>
                <option value="2" <?php if($attr['type']==2) echo 'selected="selected"';?>>复选</option>
                <option value="3" <?php if($attr['type']==3) echo 'selected="selected"';?>>下拉</option>
                <option value="4" <?php if($attr['type']==4) echo 'selected="selected"';?>>文本</option>
            </select></td>
            <td>属性值:<input type="text" name="attr_value[]" value="<?=$attr['attr_value']?>">注释:多个参数使用半角逗号分割</td>
            <td>排序:<input type="text" name="sort[]" size="2" value="<?=$attr['sort']?>"></td>
        </tr>
        <?php endforeach;?>
    </table>

    <input type="submit" value="save">
</form>
</body>
</html>