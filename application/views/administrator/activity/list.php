<?php include(APPPATH.'views/administrator/left.php');?>
<div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
        <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/"
                                                                                        title="Upgrade to a better browser">upgrade</a>
                your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852"
                                   title="Enable Javascript in your browser">enable</a> Javascript to navigate the
                interface properly.
                Download From <a href="http://www.exet.tk">exet.tk</a></div>
        </div>
    </noscript>
    <!-- Page Head -->
    <h2>活动列表</h2>

    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/activity/activityAdd"><span><br/> 添加活动 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/activity/activityList"><span><br/> 活动列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>活动列表</h3>
            <!--
            <ul class="content-box-tabs">
                <li><a href="#tab1" class="default-tab">Table</a></li>
                <li><a href="#tab2">Forms</a></li>
            </ul>
            -->
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <table>
                    <thead>
                    <tr>
                        <th><input class="check-all" type="checkbox"/></th>
                        <th>ID</th>
                        <th>主题</th>
                        <th>介绍</th>
                        <th>发起方</th>
                        <th>发起方名称</th>
                        <th>发起方介绍</th>
                        <th>规范</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <td colspan="13">
                            <div class="pagination">
                                <?=isset ($page_html) ? $page_html : '';?>
                            </div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php if (!isset ($data)) $data = array();
                    foreach ($data as $v) {
                        if (empty ($v)) continue;?>

                    <tr>
                        <td><input type="checkbox"/></td>
                        <td><?=$v['activity_id'];?></td>
                        <td><?=$v['subject'];?></td>
                        <td><?=$v['descr'];?></td>
                        <td><?=$event_initiator[$v['event_initiator']]['name'];?></td>
                        <td><?=$v['initiator_name'];?></td>
                        <td><?=$v['initiator_desc'];?></td>
                        <td><?=$v['specification'];?></td>
                        <td><?=$v['start_time'];?></td>
                        <td><?=$v['end_time'];?></td>
                        <td><?=$v['status'] ? '进行中' : '已结束';?></td>
                        <td><?=$v['create_time'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/activity/activityView/<?=$v['activity_id'].'/'.$current_page;?>" title="查看活动"><img src="<?=config_item('static_url')?>images/icons/view.gif" alt="查看活动"/></a>
                            <a href="<?=config_item('static_url')?>administrator/activity/activityEdit/<?=$v['activity_id'].'/'.$current_page;?>" title="修改活动"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="修改活动"/></a>
                            <a href="<?=config_item('static_url')?>administrator/activity/activityDelete/<?=$v['activity_id'].'/'.$current_page;?>" title="结束活动"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="结束活动"/></a>
                            <a href="<?=config_item('static_url')?>administrator/activity_prize/prizeAdd/<?=$v['activity_id'].'/'.$current_page;?>" title="设置奖品">设置奖品</a>
                        </td>
                    </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include(APPPATH.'views/administrator/footer.php');?>
</div>
</div>
</body>
</html>