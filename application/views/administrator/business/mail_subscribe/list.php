<?php include(APPPATH.'views/administrator/left.php');?>
<div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
        <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div> Javascript is disabled or is not supported by your browser. Please
                <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or
                <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the
                interface properly. Download From <a href="http://www.exet.tk">exet.tk</a></div>
        </div>
    </noscript>
    <!-- Page Head -->
    <h2>邮件订阅列表</h2>
    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_mail_subscribe/mailSubscribeAdd"><span><br/> 添加邮件订阅 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_mail_subscribe/mailSubscribeList"><span><br/> 邮件订阅列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>邮件订阅列表</h3>
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
                        <th>用户ID</th>
                        <th>邮件地址</th>
                        <th>信息类型</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="13">
                            <div class="pagination"> <?php echo isset ($page_html) ? $page_html : '';?> </div>
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
                        <td><?php echo $v['id'];?></td>
                        <td><?php echo $v['uid'];?></td>
                        <td><?php echo $v['email_addr'];?></td>
                        <td><?php switch ($v['get_info_type']){
							case '1':$s = '特价优惠';break;
							case '2':$s = '时尚搭配';break;
							case '3':$s = '新品咨询';break;
						};echo $s;?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/business_mail_subscribe/mailSubscribeEdit/<?php echo $v['id'].'/'.$current_page;?>" title="修改邮件订阅">
                                <img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="修改邮件订阅"></a>
                            <a href="<?=config_item('static_url')?>administrator/business_mail_subscribe/mailSubscribeDelete/<?php echo $v['id'].'/'.$current_page;?>" title="删除邮件订阅">
                                <img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除邮件订阅"></a>
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