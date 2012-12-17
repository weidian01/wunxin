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
                <h4>属性列表</h4>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>属性ID</th>
                     <th>属性名称</th>
                     <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php foreach ($attrs as $item): ?>
                <tr>
                    <td><?=$item['attr_id']?></td>
                    <td><a href="<?=url('admin')?>administrator/product_models/value_index/?attr_id=<?=$item['attr_id']?>"><?=$item['attr_name']?></a></td>
                    <td><a href="<?=url('admin')?>administrator/product_models/attrs_edit/<?=$item['attr_id']?>"><i class="icon-pencil"></i></a>
                        <a href="<?=url('admin')?>administrator/product_models/attrs_del/<?=$item['attr_id']?>"><i class="icon-remove"></i></a>
                    </td>
                </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
