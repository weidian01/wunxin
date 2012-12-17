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
                <h4>产品列表</h4>
            </div>

            <form class="form-inline" action="<?=url('admin')?>administrator/product/search" method="post">
                <input type="text" class="input-xlarge" placeholder="产品ID或产品名称" name="keyword" value="<?=isset($keyword) ? $keyword : ''; ?>">

                <select id="select01" name="s_type" class="span1">
                    <?php if (!isset ($searchType)) $searchType = array();?>
                    <?php foreach ($searchType as $sk => $sv):?>
                    <?php if (!isset($sType)) $sType = '';?>
                    <?php if ($sType == $sk): ?>
                        <option value="<?=$sk?>" selected="selected"><?=$sv?></option>
                        <?php else: ?>
                        <option value="<?=$sk?>"><?=$sv?></option>
                        <?php endif; ?>
                    <?php endforeach;?>
                </select>

                <button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> 搜索</button>
            </form>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>商品ID</th>
                    <th>商品图片</th>
                    <th>商品名称</th>
                    <th>售价</th>
                    <th>市场价</th>
                    <th>成本</th>
                    <th>上架</th>
                    <th>库存</th>
                    <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php if (empty ($list) || !is_array($list)) $list = array();foreach ($list as $item):if($item): ?>
                <tr>
                    <td><?=$item['pid']?></td>
                    <td><img src="<?=url('img')?>product/<?=intToPath($item['pid'])?>icon.jpg" width="50" height="50" /></td>
                    <td><a href="<?=productURL($item['pid'])?>" target="_blank"><?=$item['pname']?></a></td>
                    <td><?=fPrice($item['sell_price'])?></td>
                    <td><?=fPrice($item['market_price'])?></td>
                    <td><?=fPrice($item['cost_price'])?></td>
                    <td><?php if($item['status']):?>上架<?php else:?>下架<?php endif;?></td>
                    <td><?=empty ($item['stock']) ? '0' : $item['stock']?></td>
                    <td>
                        <a href="<?=url('admin')?>administrator/product/edit/<?php echo $item['pid'],'/',$current_page?>"><i class="icon-pencil"></i></a>
                        <a href="<?=url('admin')?>administrator/product/del/<?=$item['pid']?>"><i class="icon-remove"></i></a>
                    </td>
                </tr>
                    <?php endif;endforeach;?>
                </tbody>
            </table>
            <?php if(isset($page)) echo $page;?>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
