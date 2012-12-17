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
                <h4>颜色列表</h4>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>名称</th>
                    <th>英文名</th>
                    <th>CODE</th>
                    <th>图片</th>
                    <th>描述</th>
                    <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php foreach ($list as $item): ?>
                 <tr>
                     <td>
                         <?php if($item['parent_id']==0):?>
                         <a href="<?=url('admin')?>administrator/product_color/index/<?=$item['color_id']?>"><?=$item['china_name']?></a>
                         <?php else:?>
                         <?=$item['china_name']?>
                         <?php endif;?>
                     </td>
                     <td><?=$item['english_name']?></td>
                     <td>
                         <div style="float:left;margin-right:5px;display:block;width:20px;height:20px;background-color:#<?=$item['code']?>;">&nbsp;</div> <?=$item['code']?>
                     </td>
                     <td>
                         <?php if($item['image']):?><img width="20" height="20" src="<?=url('img').'color/'.$item['image']?>"><?php endif;?>
                     </td>
                     <td><?=$item['descr']?></td>
                     <td><a href="<?=url('admin')?>administrator/product_color/edit/<?=$item['color_id']?>" title="编辑颜色"><i class="icon-pencil"></i></a>
                         <a href="<?=url('admin')?>administrator/product_color/del/<?=$item['color_id']?>" title="删除颜色"><i class="icon-remove"></i></a>
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
