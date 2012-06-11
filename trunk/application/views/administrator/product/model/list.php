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
    <table>
        <tr><td>模型名称</td><td>编辑</td><td>删除</td></tr>
        <?php foreach($models as $item):?>
        <tr>
            <td><?=$item['model_name']?></td>
            <td><a href="<?php echo url("administrator/product/model_edit/{$item['model_id']}")?>">EDIT</a></td>
            <td><a href="<?php echo url("administrator/product/model_delete/{$item['model_id']}")?>">DEL</a></td>
        </tr>
        <?php endforeach;?>
    </table>


</body>
</html>