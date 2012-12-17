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
                <h4>产品属性复制</h4>
            </div>
            <div class="alert alert-<?=$info['type']?> fade in">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <strong><?=$info['type']?> :</strong> <?=$info['content']?>
            </div>
            <form class="form-inline" action="<?=url('admin')?>administrator/product/copy_attr" method="post">
                <input type="text" class="input-small" placeholder="来源产品ID" name="source" value="">
                <input type="text" class="input-small" placeholder="目标产品ID" name="target" value="">
                <button type="submit" class="btn btn-primary">复制</button>
            </form>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>