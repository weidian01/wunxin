<?php require(dirname(__FILE__).'/../common.php');?>
<body>
<a href="<?=url('administrator/product_category/create')?>">添加分类</a>
    <table>
        <tr><td>模型名称</td><td>编辑</td><td>删除</td></tr>
        <?php foreach($category as $item):?>
        <tr>
            <td><?php echo str_repeat("&nbsp;", $item['floor']*2),$item['cname'];?></td>
            <td><a href="<?php echo url("administrator/product_category/edit/{$item['class_id']}")?>">EDIT</a></td>
            <td><a href="<?php echo url("administrator/product_category/del/{$item['class_id']}")?>">DEL</a></td>
        </tr>
        <?php endforeach;?>
    </table>


</body>
</html>