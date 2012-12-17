<?php require(APPPATH . 'views/administrator/bootstrap/header.php');?>
<?php require(APPPATH . 'views/administrator/bootstrap/navbar.php');?>

<div class="container-fluid" >
    <div class="row-fluid">
        <div class="span2">
                <ul class="nav nav-tabs nav-stacked">
                    <?php $_view_nav_id = 8;?>
                    <li class="nav-header font-1em"><?=$_view_nav_conf[$_view_nav_id]['title'];?></li>
                    <!--li class="active"><a href="fluid.html#">汪书记最英明</a></li-->
                    <?php foreach($_view_nav_conf[$_view_nav_id]['links'] as $v):?>
                    <li><a href="<?=url('admin')?>administrator/<?=$v['url']?>"><?=$v['title']?></a></li>
                    <?php endforeach;?>
                </ul>
        </div>
        <div class="span10">
            <!--div class="subnav">
                <ul class="nav nav-pills">
                    <li><a href="components.html#labels">标签</a></li>
                    <li><a href="components.html#badges">标记</a></li>
                    <li><a href="components.html#typography">排版</a></li>
                    <li><a href="components.html#thumbnails">缩略图</a></li>
                    <li><a href="components.html#alerts">警告</a></li>
                    <li><a href="components.html#progress">进度条</a></li>
                    <li><a href="components.html#misc">杂项</a></li>
                </ul>
            </div-->
            <div class="page-header">
                <h4>系统建议与意见</h4>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>标题</th>
                    <th>内容</th>
                    <th>用户ID</th>
                    <th>用户名称</th>
                    <th>创建时间</th>
                    <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php if (!isset ($data)) $data = array();
                foreach ($data as $v):?>
                <tr>
                    <td><?=$v['id'];?></td>
                    <td><?=$v['title'];?></td>
                    <td><?=$v['content'];?></td>
                    <td><?=$v['uid'];?></td>
                    <td><?=$v['uname'];?></td>
                    <td><?=$v['create_time'];?></td>
                    <td>
                        <a href="<?=url('admin')?>administrator/other_system_proposal/systemProposalDelete/<?=$v['id'].'/'.$current_page;?>" title="删除"><i class="icon-remove"></i></a>
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