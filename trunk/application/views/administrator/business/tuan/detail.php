<?php include('/../../left.php'); ?>
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
<h2>团购详情</h2>
<!--<p id="page-intro">What would you like to do?</p>-->
<ul class="shortcut-buttons-set">
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_tuan/tuanAdd"><span><br/> 添加团购 </span></a></li>
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_tuan/tuanList"><span><br/> 团购列表 </span></a></li>
</ul>
<!-- End .shortcut-buttons-set -->
<div class="clear"></div>
<!-- End .clear -->
<div class="content-box">
    <!-- Start Content Box -->
    <div class="content-box-header">
        <h3>团购信息</h3>
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
                    <th>团购ID</th>
                    <th>产品ID</th>
                    <th>产品名称</th>
                    <th>图片</th>
                    <th>销售价格</th>
                    <th>团购价格</th>
                    <th>状态</th>
                    <th>库存量</th>
                    <th>团购数量</th>
                    <th>详细介绍</th>
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th>折扣率</th>
                    <th>节省</th>
                    <th>描述</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input type="checkbox"/>
                    </td>
                    <td><?php echo $tuan_data['tuan_id'];?></td>
                    <td><?php echo $tuan_data['pid'];?></td>
                    <td><?php echo $tuan_data['pname'];?></td>
                    <td><img src="<?php echo base_url(). str_replace('\\', '/', $tuan_data['product_images']);?>" alt="<?php echo $tuan_data['pname'];?>"/></td>
                    <td><?php echo $tuan_data['sell_price'];?></td>
                    <td><?php echo $tuan_data['tuan_price'];?></td>
                    <td><?php echo $tuan_data['status'] ? '正常团购' : '已结束团购';?></td>
                    <td><?php echo $tuan_data['inventory'];?></td>
                    <td><?php echo $tuan_data['tuan_num'];?></td>
                    <td><?php echo $tuan_data['detail'];?></td>
                    <td><?php echo $tuan_data['start_time'];?></td>
                    <td><?php echo $tuan_data['end_time'];?></td>
                    <td><?php echo $tuan_data['discount_rate'];?></td>
                    <td><?php echo $tuan_data['save'];?></td>
                    <td><?php echo $tuan_data['descr'];?></td>
                    <td><?php echo $tuan_data['create_time'];?></td>
                    <td>
                        <a href="<?=config_item('static_url')?>administrator/business_tuan/tuanEdit/<?php echo $tuan_data['tuan_id'];?>" title="编辑团购">
                            <img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑团购"/></a>
                    </td>
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
        <h3>团购评论列表</h3>
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
                    <th>用户名称</th>
                    <th>标题</th>
                    <th>内容</th>
                    <th>IP地址</th>
                    <th>有效</th>
                    <th>无效</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="13">
                        <div class="pagination">
                            <?php echo isset ($comment_page_html) ? $comment_page_html : '';?>
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
                    <td><?php echo $cdv['id'];?></td>
                    <td><?php echo $cdv['uid'];?></td>
                    <td><?php echo $cdv['uname'];?></td>
                    <td><?php echo $cdv['title'];?></td>
                    <td><?php echo $cdv['content'];?></td>
                    <td><?php echo $cdv['ip'];?></td>
                    <td><?php echo $cdv['is_valid'];?></td>
                    <td><?php echo $cdv['is_invalid'];?></td>
                    <td><?php echo $cdv['status'] ? '正常' : '删除';?></td>
                    <td><?php echo $cdv['create_time'];?></td>
                    <td>
                        <a href="<?=config_item('static_url')?>administrator/business_tuan/deleteTuanComment/<?php echo $cdv['id'].'/'.$tuan_data['tuan_id'];?>" title="删除评论">
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
<!--
<div class="content-box column-right">
    <div class="content-box-header">
        <h3>团购销售列表</h3>
    </div>
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
                    <td><?php echo $pdv['id'];?></td>
                    <td><?php echo $pdv['prize_name'];?></td>
                    <td><?php echo $pdv['img_addr'];?></td>
                    <td><?php echo $pdv['number'];?></td>
                    <td><?php echo $pdv['descr'];?></td>
                    <td><?php echo $pdv['create_time'];?></td>
                    <td>
                        <a href="<?=config_item('static_url')?>administrator/activity_prize/prizeAdd/<?php echo $a_data['activity_id'];?>" title="设置奖品">设置奖品</a>
                        <a href="<?=config_item('static_url')?>administrator/activity_prize/prizeDelete/<?php echo $pdv['id'].'/'.$a_data['activity_id'];?>" title="删除评论"> <img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除评论"></a>
                    </td>
                </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>-->
    <!-- End .content-box-content -->
</div>

<!-- End .content-box -->
<div class="clear"></div>

<?php require(dirname(__FILE__) . '/../../footer.php'); ?>
<!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
