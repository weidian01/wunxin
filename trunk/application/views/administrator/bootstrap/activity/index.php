<?php require(APPPATH . 'views/administrator/bootstrap/header.php');?>
<?php require(APPPATH . 'views/administrator/bootstrap/navbar.php');?>
<div class="container-fluid" >
    <div class="row-fluid">
        <div class="span2">
            <?php require(__DIR__ . DS . 'leftnav.php');?>
        </div>
        <div class="span10">
            <?php require(__DIR__ . DS . 'subnav.php');?>

            <div class="page-header">
                <h4>活动列表</h4>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>主题</th>
                    <th>介绍</th>
                    <th>发起方</th>
                    <th>发起方名称</th>
                    <th>发起方介绍</th>
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
                <tr>
                </thead>
                <tbody>
                <?php if (!isset ($data)) $data = array();
                foreach ($data as $v):if ($v):?>
                <tr>
                    <td><?=$v['activity_id'];?></td>
                    <td><?=$v['subject'];?></td>
                    <td><?=$v['descr'];?></td>
                    <td><?=$event_initiator[$v['event_initiator']]['name'];?></td>
                    <td><?=$v['initiator_name'];?></td>
                    <td><?=$v['initiator_desc'];?></td>
                    <td><?=$v['start_time'];?></td>
                    <td><?=$v['end_time'];?></td>
                    <td><?=$v['status'] ? '进行中' : '已结束';?></td>
                    <td><?=$v['create_time'];?></td>
                    <td>
                        <a href="<?=url('admin')?>administrator/activity/activityView/<?php echo $v['activity_id'],'/',$current_page;?>" title="查看活动"><i class="icon-eye-open"></i></a>
                        <a href="<?=url('admin')?>administrator/activity/activityEdit/<?php echo $v['activity_id'],'/',$current_page;?>" title="修改活动"><i class="icon-pencil"></i></a>
                        <a href="<?=url('admin')?>administrator/activity/activityDelete/<?php echo $v['activity_id'],'/',$current_page;?>" title="结束活动"><i class="icon-off"></i></a>
                        <a href="<?=url('admin')?>administrator/activity_prize/prizeAdd/<?php echo $v['activity_id'],'/',$current_page;?>" title="设置奖品"><i class="icon-gift"></i></a>
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
