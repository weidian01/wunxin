<?php require(dirname(__FILE__) . '/../common.php'); ?>
<?php require(dirname(__FILE__) . '/../../left.php');?>
<a href="<?=url('administrator/product_category/create')?>">添加分类</a>

<form method="post" action="<?=url('administrator/product_category/create')?>" novalidate="true">
    <table cellspacing="0" cellpadding="0" class="form_table">
        <colgroup>
            <col width="150px">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th>分类名称：</th>
            <td><input type="text" alt="分类名称不能为空" pattern="required" value="<?php echo isset($info['cname']) ? $info['cname']:''?>" name="cname" class="normal"><label>*分类名称不能为空</label>
                <input type="hidden" value="<?php echo isset($class_id) ? $class_id:0?>" name="class_id">
            </td>
        </tr>
        <tr>
            <th>上级分类：</th>
            <td>
                <select name="parent_id" class="normal">
                    <option value="0">顶级分类</option>
                    <?php foreach($category as $item):?>
                    <option value="<?=$item['class_id']?>"><?php echo str_repeat("&nbsp;", $item['floor']),$item['cname']?></option>
                    <?php endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <th>商品模型：</th>
            <td>
                <select alt="必需选择商品模型" pattern="required" name="model_id" class="normal">
                    <option value="0">选择商品模型</option>
                    <?php foreach($model as $item):?>
                    <option value="<?=$item['model_id']?>"><?=$item['model_name']?></option>
                    <?php endforeach;?>
                </select><label>*必选项</label></td>
        </tr>
        <tr>
            <th>排序：</th>
            <td><input type="text" value="<?php echo isset($info['sort']) ? $info['sort']:''?>" alt="排序必须是一个数字" pattern="int" name="sort" class="normal"></td>
        </tr>
        <tr>
            <th>SEO标题：</th>
            <td><input type="text" value="<?php echo isset($info['title']) ? $info['title']:''?>" name="title" class="normal"></td>
        </tr>
        <tr>
            <th>SEO关键词：</th>
            <td><input type="text" value="<?php echo isset($info['keywords']) ? $info['keywords']:''?>" name="keywords" class="normal"></td>
        </tr>
        <tr>
            <th>SEO描述：</th>
            <td><textarea rows="" cols="" name="descr"><?php echo isset($info['descr']) ? $info['descr']:''?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="submit"><span>确 定</span></button>
            </td>
        </tr>
        </tbody>
    </table>
</form>


</body>
</html>