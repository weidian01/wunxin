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
                <h4>尺码列表</h4>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>号码名称</th>
                    <th>简介</th>
                    <th>描述</th>
                    <th>类型</th>
                    <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php $_view_size_type = config_item('size_type');?>
                <?php foreach ($list as $item): ?>
                <tr>
                    <td><?=$item['size_id']?></td>
                    <td><?=$item['name']?></td>
                    <td><?=$item['abbreviation']?></td>
                    <td><?=$item['descr']?></td>
                    <td><?php echo $_view_size_type[$item['type']];?></td>
                    <td><a href="<?=site_url("administrator/product_size/edit/{$item['size_id']}")?>" title="编辑"><i class="icon-pencil"></i></a>
                        <a href="<?=site_url("administrator/product_size/del/{$item['size_id']}")?>" title="删除"><i class="icon-remove"></i></a>
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
