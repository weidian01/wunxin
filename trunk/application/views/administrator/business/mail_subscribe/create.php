<?php require(dirname(__FILE__) . '/../../left.php'); ?>
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
    <h2><?php echo $type == 'edit' ? '编辑邮件订阅' : '添加邮件订阅'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/business_mail_subscribe/mailSubscribeAdd"><span><br/> 添加邮件订阅 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/business_mail_subscribe/mailSubscribeList"><span><br/> 邮件订阅列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加邮件订阅</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?php echo $type == 'edit' ? '/administrator/business_mail_subscribe/mailSubscribeEditSave' : '/administrator/business_mail_subscribe/mailSubscribeSave';?>" method="post">
                    <input type="hidden" name="id" value="<?php echo isset($info['id']) ? $info['id'] : ''?>">
                    <fieldset>
                        <p>
                            <label>用户ID</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['uid']) ? $info['uid'] : ''?>" name="uid" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>
                        <p>
                            <label>邮件地址</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['email_addr']) ? $info['email_addr'] : ''?>" name="email_addr"/>
                            <br/>
                        </p>
                        <p>
                            <label>需要获取信息类型</label>
                            <select name="get_info_type">
                                <option value="1" <?php echo isset($info['get_info_type']) && $info['get_info_type'] == '1' ? 'selected="selected"' : '';?>>特价优惠</option>
                                <option value="2" <?php echo isset($info['get_info_type']) && $info['get_info_type'] == '2' ? 'selected="selected"' : '';?>>时尚搭配</option>
                                <option value="3" <?php echo isset($info['get_info_type']) && $info['get_info_type'] == '3' ? 'selected="selected"' : '';?>>新品咨询</option>
                            </select>
                            <br/>
                        </p>
                        <p>
                            <input class="button" type="submit" value="Submit"/>
                        </p>
                    </fieldset>
                    <div class="clear"></div>
                    <!-- End .clear -->
                </form>
            </div>
            <!-- End #tab2 -->
        </div>
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