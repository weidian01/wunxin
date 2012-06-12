<?php require(dirname(__FILE__) . '/../../left.php');?>
<table border="1">
    <tr>
        <td>ID</td>
        <td>分类ID</td>
        <td>用户ID</td>
        <td>用户名称</td>
        <td>设计图图片</td>
        <td>设计图名称</td>
        <td>介绍</td>
        <td>投票人数</td>
        <td>总分数</td>
        <td>状态</td>
        <td>创建时间</td>
        <td>操作</td>
    </tr>
    <?php foreach ($data as $v) { ?>
    <tr>
        <td><?php echo $v['did'];?></td>
        <td><?php echo $v['class_id'];?></td>
        <td><?php echo $v['uid'];?></td>
        <td><?php echo $v['uname'];?></td>
        <td><img src="<?php echo $v['design_img'];?>" alt="<?php echo $v['dname'];?>" /></td>
        <td><?php echo $v['dname'];?></td>
        <td><?php echo $v['ddetail'];?></td>
        <td><?php echo $v['total_num'];?></td>
        <td><?php echo $v['total_fraction'];?></td>
        <td><?php echo $v['status'] ? '正常' : '删除';?></td>
        <td><?php echo $v['create_time'];?></td>
        <td>
            <a href="">编辑</a>
            <a href="">删除</a>
        </td>
    </tr>
    <?php }?>
</table>
</body>
</html>