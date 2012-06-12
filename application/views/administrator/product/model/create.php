<?php require(dirname(__FILE__).'/../common.php');?>
<body>
<form action="<?=url('administrator/product_model/save')?>" method="post">
    <div> 模型名称:<input name="model_name" type="text"/> <a href="javascript:;">添加属性</a></div>

    <table>
        <tr>
            <td>属性名:<input type="text" name="attr_name[]" value=""></td>
            <td>类型:<select name="type[]">
                <option value="1">单选</option>
                <option value="2">复选</option>
                <option value="3">下拉</option>
                <option value="4">文本</option>
            </select></td>
            <td>属性值:<input type="text" name="attr_value[]" value=""></td>
            <td>排序:<input type="text" name="sort[]" value=""></td>
        </tr>
        <tr>
            <td>属性名:<input type="text" name="attr_name[]" value=""></td>
            <td>类型:<select name="type[]">
                <option value="1">单选</option>
                <option value="2">复选</option>
                <option value="3">下拉</option>
                <option value="4">文本</option>
            </select></td>
            <td>属性值:<input type="text" name="attr_value[]" value=""></td>
            <td>排序:<input type="text" name="sort[]" value=""></td>
        </tr>
        <tr>
            <td>属性名:<input type="text" name="attr_name[]" value=""></td>
            <td>类型:<select name="type[]">
                <option value="1">单选</option>
                <option value="2">复选</option>
                <option value="3">下拉</option>
                <option value="4">文本</option>
            </select></td>
            <td>属性值:<input type="text" name="attr_value[]" value=""></td>
            <td>排序:<input type="text" name="sort[]" value=""></td>
        </tr>
    </table>

   <input type="submit" value="save">
</form>
</body>
</html>