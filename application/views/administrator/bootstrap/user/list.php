<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>用户列表</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?=url('static')?>bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }

        .page-content {
            padding: 10px;
            margin: 0px 10px 10px 10px;
            border: 1px solid #DDDDDD;
            border-radius: 6px 6px 6px 6px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075);
        }

        .container-fluid div {
            border-radius: 3px 3px 3px 3px;
        }

        .font-1em {
            font-size: 1em !important;
        }
    </style>
    <link href="<?=url('static')?>bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?=url('static')?>bootstrap/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?=url('static')?>bootstrap/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=url('static')?>bootstrap/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?=url('static')?>bootstrap/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
<?php require(APPPATH . 'views/administrator/bootstrap/navbar.php');?>
<div class="page-content container-fluid" >
    <div class="row-fluid">
        <div class="span2">
            <div class="well">
                <ul class="nav nav-pills nav-stacked">
                    <li class="nav-header font-1em"><?=$_view_nav_conf[2]['title'];?></li>
                    <!--li class="active"><a href="fluid.html#">汪书记最英明</a></li-->
                    <?php foreach($_view_nav_conf[2]['links'] as $v):?>
                    <li><a href="<?=url('admin')?>administrator/<?=$v['url']?>"><?=$v['title']?></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
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
                        <a href="<?=url('admin')?>administrator/user/userDetail/<?=$v['uid']?>" title="查看用户"><i class="icon-eye-open"></i></a>
                        <a href="<?=url('admin')?>administrator/user/userEdit/<?=$v['uid']?>" title="修改用户"><i class="icon-pencil"></i></a>
                        <a href="<?=url('admin')?>administrator/user_comment/userCommentList/<?=$v['uid']?>" title="查看留言"><i class="icon-comment"></i></a>
                        <a href="<?=url('admin')?>administrator/user_favorite/favoriteList/<?=$v['uid']?>" title="查看收藏"><i class="icon-folder-open"></i></a>
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
</body>
</html>
