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
                <h4>模型列表</h4>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>模型ID</th>
                    <th>模型名称</th>
                    <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php foreach ($models as $item): ?>
                <tr>
                    <td><?=$item['model_id']?></td>
                    <td><?=$item['model_name']?></td>
                    <td>
                        <a href="<?=url('admin')?>administrator/product_models/model_edit/<?=$item['model_id']?>" title="编辑"><i class="icon-pencil"></i></a>
                        <a href="<?=url('admin')?>administrator/product_models/model_del/<?=$item['model_id']?>" title="删除"><i class="icon-remove"></i></a>
                    </td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <?php if(isset($page)) echo $page;?>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
