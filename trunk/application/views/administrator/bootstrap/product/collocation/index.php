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
                <h4>产品搭配列表</h4>
            </div>

            <form class="form-inline" action="<?=url('admin')?>administrator/product_collocation/search" method="post">
                <input type="text" class="input-xlarge" placeholder="搭配ID或产品ID" name="keyword" value="<?=isset ($keyword) ? $keyword : '';?>">

                <select name="s_type" class="span1">
                    <option value="1" <?=(isset ($s_type) && $s_type == 1) ? 'selected="selected"' : ''; ?>>搭配ID</option>
                    <option value="2" <?=(isset ($s_type) && $s_type == 2) ? 'selected="selected"' : ''; ?>>产品ID</option>
                </select>

                <button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> 搜索</button>
            </form>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>搭配ID</th>
                    <th>产品ID</th>
                    <th>被搭配的产品ID</th>
                    <th>排序</th>
                    <th>创建时间</th>
                    <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php if (!isset ($data)) $data = array();
                foreach ($data as $v):if($v):?>
                <tr>
                    <td><?=$v['id'];?></td>
                    <td><a href="<?=config_item('static_url')?>administrator/product_collocation/pcList/<?=isset ($current_page) ? $current_page : ''.'/'.$v['pid'];?>"><?=$v['pid'];?></a></td>
                    <td><?=$v['spid'];?></td>
                    <td><?=$v['sort'];?></td>
                    <td><?=$v['create_time'];?></td>
                    <td>
                        <a href="<?=url('admin')?>administrator/product_collocation/pcEdit/<?=$v['id'];?>" title="编辑产品搭配"><i class="icon-pencil"></i></a>
                        <a href="<?=url('admin')?>administrator/product_collocation/pcDelete/<?=$v['id'].'/'.(isset ($current_page) ? $current_page : '');?>" title="删除产品搭配"><i class="icon-remove"></i></a>
                    </td>
                </tr>
                    <?php endif;endforeach;?>
                </tbody>
            </table>
            <?php if(isset($page_html)) echo $page_html;?>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
