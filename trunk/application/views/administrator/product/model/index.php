<?php require(dirname(__FILE__).'/../common.php');?>
<body>
    <table>
        <tr><td>模型名称</td><td>编辑</td><td>删除</td></tr>
        <?php foreach($models as $item):?>
        <tr>
            <td><?=$item['model_name']?></td>
            <td><a href="<?php echo url("administrator/product_model/edit/{$item['model_id']}")?>">EDIT</a></td>
            <td><a href="<?php echo url("administrator/product_model/del/{$item['model_id']}")?>">DEL</a></td>
        </tr>
        <?php endforeach;?>
    </table>


</body>
</html>