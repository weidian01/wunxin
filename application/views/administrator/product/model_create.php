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
    <div> 模型名称:<input name="model_name" type="text"/></div>
    <table>
        <tr>
            <td>模型属性名:<input type="text" name="attr_name[]" value=""></td>
            <td>类型:<select name="type[]">
                <option value="1">单选</option>
                <option value="2">复选</option>
                <option value="3">下拉</option>
                <option value="4">文本</option>
            </select></td>
            <td>模型属性值:<input type="text" name="attr_value[]" value=""></td>
            <td>排序:<input type="text" name="sort[]" value=""></td>
        </tr>
        <tr>
            <td>模型属性名:<input type="text" name="attr_name[]" value=""></td>
            <td>类型:<select name="type[]">
                <option value="1">单选</option>
                <option value="2">复选</option>
                <option value="3">下拉</option>
                <option value="4">文本</option>
            </select></td>
            <td>模型属性值:<input type="text" name="attr_value[]" value=""></td>
            <td>排序:<input type="text" name="sort[]" value=""></td>
        </tr>
        <tr>
            <td>模型属性名:<input type="text" name="attr_name[]" value=""></td>
            <td>类型:<select name="type[]">
                <option value="1">单选</option>
                <option value="2">复选</option>
                <option value="3">下拉</option>
                <option value="4">文本</option>
            </select></td>
            <td>模型属性值:<input type="text" name="attr_value[]" value=""></td>
            <td>排序:<input type="text" name="sort[]" value=""></td>
        </tr>
    </table>

   <input type="submit">
</form>
</body>
</html>