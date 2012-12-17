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
                <h4>文章列表</h4>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>分类</th>
                    <th>标题</th>
                    <th>是否显示</th>
                    <th>是否置顶</th>
                    <th>排序</th>
                    <th>有效</th>
                    <th>无效</th>
                    <th>创建时间</th>
                    <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php if (!isset ($data)) $data = array();
                foreach ($data as $v): if (empty ($v)) continue;?>
                <tr>
                    <td><?=$v['id'];?></td>
                    <td><a href="<?=url('admin')?>administrator/article/articleCLass/<?=$v['cid'];?>"><?=isset($class_data[$v['cid']]['cname']) ? $class_data[$v['cid']]['cname']:'NULL';?></a></td>
                    <td>
                        <a href="<?=url('admin')?>other/help/index/<?=$v['id'];?>"><?=$v['title'];?></a>
                    </td>
                    <td><?=$v['visiblity'] ? '显示' : '不显示';?></td>
                    <td><?=$v['top'] ? '置顶' : '不置顶';?></td>
                    <td><?=$v['sort'];?></td>
                    <td><?=$v['is_valid'];?></td>
                    <td><?=$v['is_invalid'];?></td>
                    <td><?=$v['create_time'];?></td>
                    <td>
                        <a href="<?=url('admin')?>administrator/article/articleEdit/<?=$v['id'];?>" title="编辑文章"><i class="icon-pencil"></i></a>
                        <a href="<?=url('admin')?>administrator/article/articleDelete/<?=$v['id'].'/'.(isset ($current_page) ? $current_page : '1');?>" title="删除文章"><i class="icon-remove"></i></a>
                    </td>
                </tr>
                    <?php endforeach?>
                </tbody>
            </table>
            <?php if(isset($page_html)) echo $page_html;?>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>