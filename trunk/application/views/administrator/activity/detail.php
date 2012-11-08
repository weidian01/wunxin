<?php include(APPPATH.'views/administrator/left.php');?>
<div id="main-content">
<!-- Main Content Section with everything -->
<noscript>
    <!-- Show a notification if the user has disabled javascript -->
    <div class="notification error png_bg">
        <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/"
                                                                                    title="Upgrade to a better browser">upgrade</a>
            your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852"
                               title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface
            properly.
            Download From <a href="http://www.exet.tk">exet.tk</a></div>
    </div>
</noscript>
<!-- Page Head -->
<h2>活动详情</h2>
<!--<p id="page-intro">What would you like to do?</p>-->
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
        <h3>活动信息</h3>
        <ul class="content-box-tabs">
            <!--
            <li><a href="#tab1" class="default-tab">发票信息</a></li>
            href must be unique and match the id of target div
            <li><a href="#tab2">收款单信息</a></li>
            <li><a href="#tab3">退换货信息</a></li>
            <li><a href="#tab4">订单留言</a></li>
            <li><a href="#tab5">发票信息</a></li> -->
        </ul>
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
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input type="checkbox"/>
                    </td>
                    <td><?=$a_data['activity_id'];?></td>
                    <td><?=$a_data['subject'];?></td>
                    <td><?=$a_data['descr'];?></td>
                    <td><?=$event_initiator[$a_data['event_initiator']]['name'];?></td>
                    <td><?=$a_data['initiator_name'];?></td>
                    <td><?=$a_data['initiator_desc'];?></td>
                    <td><?=$a_data['specification'];?></td>
                    <td><?=$a_data['start_time'];?></td>
                    <td><?=$a_data['end_time'];?></td>
                    <td><?=$a_data['status'] ? '进行中' : '已结束';?></td>
                    <td><?=$a_data['create_time'];?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- End #tab2 -->
    </div>
    <!-- End .content-box-content -->
</div>
<!-- End .content-box -->
<div class="content-box column-left">
    <div class="content-box-header">
        <h3>活动评论列表</h3>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>ID</th>
                    <th>用户ID</th>
                    <th>标题</th>
                    <th>内容</th>
                    <th>IP地址</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="13">
                        <div class="pagination">
                            <?=isset ($comment_page_html) ? $comment_page_html : '';?>
                        </div>
                        <div class="clear"></div>
                    </td>
                </tr>
                </tfoot>
                <tbody>
                <?php $comment_data = isset ($comment_data) ? $comment_data : array();
                foreach ($comment_data as $cdv) {?>
                <tr>
                    <td> <input type="checkbox"/> </td>
                    <td><?=$cdv['id'];?></td>
                    <td><?=$cdv['uid'];?></td>
                    <td><?=$cdv['title'];?></td>
                    <td><?=$cdv['content'];?></td>
                    <td><?=$cdv['ip'];?></td>
                    <td><?=$cdv['create_time'];?></td>
                    <td>
                        <a href="<?=config_item('static_url')?>administrator/activity/activityCommentDelete/<?=$cdv['id'].'/'.$a_data['activity_id'];?>" title="删除评论">
                            <img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除评论"></a>
                    </td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <!-- End #tab3 -->
    </div>
    <!-- End .content-box-content -->
</div>

<!-- End .content-box -->
<div class="content-box column-right">
    <div class="content-box-header">
        <!-- Add the class "closed" to the Content box header to have it closed by default -->
        <h3>活动奖品列表</h3>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>ID</th>
                    <th>奖品名称</th>
                    <th>奖品图片</th>
                    <th>数量</th>
                    <th>奖品说明</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php $prize_data = isset ($prize_data) ? $prize_data : array();
                foreach ($prize_data as $pdv) {?>
                <tr>
                    <td> <input type="checkbox"/> </td>
                    <td><?=$pdv['id'];?></td>
                    <td><?=$pdv['prize_name'];?></td>
                    <td><?=$pdv['img_addr'];?></td>
                    <td><?=$pdv['number'];?></td>
                    <td><?=$pdv['descr'];?></td>
                    <td><?=$pdv['create_time'];?></td>
                    <td>
                        <a href="<?=config_item('static_url')?>administrator/activity_prize/prizeAdd/<?=$a_data['activity_id'];?>" title="设置奖品">设置奖品</a>
                        <a href="<?=config_item('static_url')?>administrator/activity_prize/prizeDelete/<?=$pdv['id'].'/'.$a_data['activity_id'];?>" title="删除评论">
                            <img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除评论"></a>
                    </td>
                </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
        <!-- End #tab3 -->
    </div>
    <!-- End .content-box-content -->
</div>

<!-- End .content-box -->
<div class="clear"></div>

    <?php include(APPPATH.'views/administrator/footer.php');?>
<!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
