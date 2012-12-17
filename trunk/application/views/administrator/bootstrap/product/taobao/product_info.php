<table class="table table-striped table-condensed span5">
    <tr><th>属性</th><th>值</th><tr>
    <?php foreach($attr as $k=>$v):?>
    <tr><td><?=$k?></td><td><?=$v?></td><tr>
    <?php endforeach;?>
</table>
<table class="table table-striped table-condensed span5">
<tr><th>id</th><th>颜色</th><th>图片</th><th>价格</th><th>尺寸</th></tr>
<?php foreach($product as $p):?>
<tr>
<td><?=$p['id']?></td>
<td><?=$p['color']?></td>
<td><a href="<?=$p['img']?>" target="_blank"><img src="<?=$p['img']?>" height="40" width="40"></a></td>
<td><?=$p['price']?></td>
<td>
    <?php foreach($p['size'] as $i):?>
    <?=$i['name']?>,
    <?php endforeach;?>
</td>
</tr>
<?endforeach;?>
</table>