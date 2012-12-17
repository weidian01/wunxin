<?php require(APPPATH . 'views/administrator/bootstrap/header.php');?>
<?php require(APPPATH . 'views/administrator/bootstrap/navbar.php');?>
<div class="container-fluid" >
    <div class="row-fluid">
        <div class="span2">
            <ul class="nav nav-tabs nav-stacked">
                <?php $_view_nav_id = 2;?>
                <li class="nav-header font-1em"><?=$_view_nav_conf[$_view_nav_id]['title'];?></li>
                <!--li class="active"><a href="fluid.html#">汪书记最英明</a></li-->
                <?php foreach ($_view_nav_conf[$_view_nav_id]['links'] as $v): ?>
                <li><a href="<?=url('admin')?>administrator/<?=$v['url']?>"><?=$v['title']?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="span10">

            <div class="page-header">
                <h4>用户列表</h4>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>用户ID</th>
                    <th>用户名称</th>
                    <th>昵称</th>
                    <th>等级</th>
                    <th>用户来源</th>
                    <th>用户积分</th>
                    <th>用户金额</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php if (!isset ($data)) $data = array();
                foreach ($data as $v) :?>
                <tr>
                    <td><?=$v['uid'];?></td>
                    <td><?=$v['uname'];?></td>
                    <td><?=$v['nickname'];?></td>
                    <td><?=$v['lid'];?></td>
                    <td><?=$v['source'];?></td>
                    <td><?=$v['integral'];?></td>
                    <td><?=$v['amount'];?></td>
                    <td><?=$v['status'] ? '正常' : '已删除';?></td>
                    <td><?=$v['create_time'];?></td>
                    <td>
                        <a href="<?=url('admin')?>administrator/user/userDetail/<?=$v['uid']?>" title="查看用户信息"><i class="icon-eye-open"></i></a>
                        <a href="<?=url('admin')?>administrator/user/userEdit/<?=$v['uid']?>" title="编辑用户信息"><i class="icon-pencil"></i></a>
                        <a href="<?=url('admin')?>administrator/user_comment/userCommentList/<?=$v['uid']?>" title="查看用户留言"><i class="icon-comment"></i></a>
                        <a href="<?=url('admin')?>administrator/user_favorite/favoriteList/<?=$v['uid']?>" title="查看用户收藏"><i class="icon-folder-open"></i></a>
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
