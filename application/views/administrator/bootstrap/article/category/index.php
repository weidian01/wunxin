<?php require(APPPATH . 'views/administrator/bootstrap/header.php');?>
<?php require(APPPATH . 'views/administrator/bootstrap/navbar.php');?>
<div class="container-fluid" >
    <div class="row-fluid">
        <div class="span2">
            <?php require(__DIR__ . DS . '../leftnav.php');?>
        </div>
        <div class="span10">
            <?php require(__DIR__ . DS . '../subnav.php');?>

            <div class="page-header">
                <h4>文章分类列表</h4>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>分类ID</th>
                    <th>名称</th>
                    <th>父类ID</th>
                    <th>排序</th>
                    <th>路径</th>
                    <th>创建时间</th>
                    <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php if (!isset ($data)) $data = array();
                foreach ($data as $v):?>
                <tr>
                    <td><?=$v['cid'];?></td>
                    <td><?php echo str_repeat("&nbsp;", $v['floor'] * 4), $v['cname'];?></td>
                    <td><?=$v['parent_id'] ? $class_data[$v['parent_id']]['cname'] : '顶级分类';?></td>
                    <td><?=$v['sort'];?></td>
                    <td><?=$v['path'];?></td>
                    <td><?=$v['create_time'];?></td>
                    <td>
                        <a href="<?=url('admin')?>administrator/article_category/categoryEdit/<?=$v['cid'];?>" title="编辑文章分类"><i class="icon-pencil"></i></a>
                        <a href="<?=url('static_url')?>administrator/article_category/categoryDelete/<?=$v['cid'];?>" title="删除文章分类"><i class="icon-remove"></i></a>
                    </td>
                </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <?php if(isset($page_html)) echo $page_html;?>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
