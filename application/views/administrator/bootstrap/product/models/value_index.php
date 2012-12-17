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

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>属性值ID</th>
                    <th>属性值</th>
                    <th>属性</th>
                    <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php foreach ($values as $item): ?>
                <tr>
                    <td><?=$item['value_id']?></td>
                    <td><?=$item['value_name']?></td>
                    <td><a href="<?=url('admin')?>administrator/product_models/value_index/?attr_id=<?=$item['attr_id']?>"><?=$attrs[$item['attr_id']]['attr_name']?></a></td>
                    <td><a href="<?=url('admin')?>administrator/product_models/value_edit/<?=$item['value_id']?>"><i class="icon-pencil"></i></a>
                        <a href="<?=url('admin')?>administrator/product_models/value_del/<?=$item['value_id']?>"><i class="icon-remove"></i></a>
                    </td>
                </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
