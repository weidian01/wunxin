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
                <h4>分类列表</h4>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>分类ID</th>
                    <th>分类名称</th>
                    <th>分类级别</th>
                    <th>排序</th>
                    <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php foreach ($category as $item): ?>
                <tr>
                    <td><?=$item['class_id']?></td>
                    <td><?=str_repeat("&nbsp;", $item['floor'] * 8), $item['cname'];?></td>
                    <td><?=$item['floor']?></td>
                    <td><?=$item['sort']?></td>
                    <td>
                        <a href="<?=url('admin')?>administrator/product_category/edit/<?=$item['class_id']?>" title="编辑"><i class="icon-pencil"></i></a>
                        <a href="<?=url('admin')?>administrator/product_category/del/<?=$item['class_id']?>" title="删除"><i class="icon-remove"></i></a>
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
