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
<h2>用户详情</h2>
<!--<p id="page-intro">What would you like to do?</p>-->
<ul class="shortcut-buttons-set">
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/user/userList"><span><br/> 用户列表 </span></a></li>
</ul>
<!-- End .shortcut-buttons-set -->
<div class="clear"></div>
<!-- End .clear -->
<div class="content-box">
    <!-- Start Content Box -->
    <div class="content-box-header">
        <h3>用户信息</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">基本信息</a></li>
            <li><a href="#tab2">收货地址</a></li>
            <li><a href="#tab3">用户发票</a></li>
            <li><a href="#tab4">升级日志</a></li>
            <li><a href="#tab5">消费日志</a></li>
            <li><a href="#tab6">找回密码日志</a></li>
            <li><a href="#tab7">积分日志</a></li>
            <li><a href="#tab8">申请返现日志</a></li>
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
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input type="checkbox"/>
                    </td>
                    <td><?=$user_info['uid'];?></td>
                    <td><?=$user_info['uname'];?></td>
                    <td><?=$user_info['nickname'];?></td>
                    <td><?=$user_info['lid'];?></td>
                    <td><?=$user_info['source'];?></td>
                    <td><?=$user_info['integral'];?></td>
                    <td><?=$user_info['amount'];?></td>
                    <td><?=$user_info['status'] ? '正常' : '已删除';?></td>
                    <td><?=$user_info['create_time'];?></td>
                    <td>
                        <a href="<?=config_item('static_url')?>administrator/user/userDetail/<?=$user_info['uid']?>" title="修改用户">
                            <img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="修改用户"></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- End #tab1 -->
        <div class="tab-content" id="tab2">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>ID</th>
                    <th>用户ID</th>
                    <th>用户名称</th>
                    <th>收货人</th>
                    <th>国家</th>
                    <th>省份</th>
                    <th>城市</th>
                    <th>区域</th>
                    <th>详细地址</th>
                    <th>邮政编码</th>
                    <th>手机号码</th>
                    <th>座机</th>
                    <th>默认地址</th>
                    <th>创建时间</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($recent_data)) {
                    $recent_data = array();
                } //echo '<pre>';print_r($receivable);exit;
                foreach ($recent_data as $rv) {
                    ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?=$rv['address_id'];?></td>
                    <td><?=$rv['uid'];?></td>
                    <td><?=$rv['uname'];?></td>
                    <td><?=$rv['recent_name'];?></td>
                    <td><?=$rv['country'];?></td>
                    <td><?=$rv['province'];?></td>
                    <td><?=$rv['city'];?></td>
                    <td><?=$rv['area'];?></td>
                    <td><?=$rv['detail_address'];?></td>
                    <td><?=$rv['zipcode'];?></td>
                    <td><?=$rv['phone_num'];?></td>
                    <td><?=$rv['call_num'];?></td>
                    <td><?=$rv['default_address'] ? '是' : '否';?></td>
                    <td><?=$rv['create_time'];?></td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>
        <!-- End #tab1 -->
        <div class="tab-content" id="tab3">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>ID</th>
                    <th>用户ID</th>
                    <th>发票抬头</th>
                    <th>发票内容</th>
                    <th>默认发票</th>
                    <th>创建时间</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($invoice_data)) {
                    $invoice_data = array();
                } //echo '<pre>';print_r($receivable);exit;
                foreach ($invoice_data as $iv) {
                    ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?=$iv['invoice_id'];?></td>
                    <td><?=$iv['uid'];?></td>
                    <td><?=$iv['invoice_payable'];?></td>
                    <td><?php switch ($iv['invoice_content']) {
                    	case '1': $s = '服装';break;
                    	case '2': $s = '其他';break;
                    	default: $s = $iv['invoice_content'];
                    } echo empty ($s) ? '' : $s;?></td>
                    <td><?=$iv['default'] ? '是' : '否';?></td>
                    <td><?=$iv['create_time'];?></td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>

        <!-- End #tab1 -->
        <div class="tab-content" id="tab4">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>ID</th>
                    <th>用户ID</th>
                    <th>升级事件</th>
                    <th>原等级</th>
                    <th>现等级</th>
                    <th>创建时间</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($level_up_data)) {
                    $level_up_data = array();
                } //echo '<pre>';print_r($receivable);exit;
                foreach ($level_up_data as $rv) {
                    ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?=$rv['id'];?></td>
                    <td><?=$rv['uid'];?></td>
                    <td><?=$rv['up_action'];?></td>
                    <td><?=$rv['former_level'];?></td>
                    <td><?=$rv['current_level'];?></td>
                    <td><?=$rv['create_time'];?></td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>

        <div class="tab-content" id="tab5">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>ID</th>
                    <th>用户ID</th>
                    <th>操作类型</th>
                    <th>操作前金额</th>
                    <th>操作后金额</th>
                    <th>描述</th>
                    <th>消费金额</th>
                    <th>创建时间</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($consume_data)) {
                    $consume_data = array();
                } //echo '<pre>';print_r($receivable);exit;
                foreach ($consume_data as $cdv) {
                    ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?=$cdv['consume_id'];?></td>
                    <td><?=$cdv['uid'];?></td>
                    <td><?=$cdv['operat_type'];?></td>
                    <td><?=$cdv['before_amount'];?></td>
                    <td><?=$cdv['after_amount'];?></td>
                    <td><?=$cdv['descr'];?></td>
                    <td><?=$cdv['consume_amount'];?></td>
                    <td><?=$cdv['create_time'];?></td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>

        <div class="tab-content" id="tab6">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>ID</th>
                    <th>用户ID</th>
                    <th>校验串</th>
                    <th>过期时间</th>
                    <th>创建时间</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($retrieve_data)) {
                    $retrieve_data = array();
                } //echo '<pre>';print_r($receivable);exit;
                foreach ($retrieve_data as $rdv) {
                    ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?=$rdv['id'];?></td>
                    <td><?=$rdv['uid'];?></td>
                    <td><?=$rdv['passwd_code'];?></td>
                    <td><?=$rdv['end_time'];?></td>
                    <td><?=$rdv['create_time'];?></td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>

        <div class="tab-content" id="tab7">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>ID</th>
                    <th>用户ID</th>
                    <th>操作类型</th>
                    <th>操作前积分</th>
                    <th>操作后积分</th>
                    <th>消费积分</th>
                    <th>描述</th>
                    <th>创建时间</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($integral_data)) {
                    $integral_data = array();
                } //echo '<pre>';print_r($receivable);exit;
                foreach ($integral_data as $idv) {
                    ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?=$idv['integral_id'];?></td>
                    <td><?=$idv['uid'];?></td>
                    <td><?=$idv['operat_type'];?></td>
                    <td><?=$idv['before_amount'];?></td>
                    <td><?=$idv['after_amount'];?></td>
                    <td><?=$idv['consume_amount'];?></td>
                    <td><?=$idv['descr'];?></td>
                    <td><?=$idv['create_time'];?></td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="clear"></div>
    </div>
    <div class="tab-content" id="tab8">
        <table>
            <thead>
            <tr>
                <th><input class="check-all" type="checkbox"/></th>
                <th>ID</th>
                <th>用户ID</th>
                <th>用户名称</th>
                <th>金额</th>
                <th>描述</th>
                <th>IP地址</th>
                <th>状态</th>
                <th>创建时间</th>
            </tr>
            </thead>

            <tbody>
            <?php if (empty($acb_data)) {
                $acb_data = array();
            } //echo '<pre>';print_r($receivable);exit;
            foreach ($acb_data as $adv) {
                ?>
            <tr>
                <td><input type="checkbox"/></td>
                <td><?=$adv['acb_id'];?></td>
                <td><?=$adv['uid'];?></td>
                <td><?=$adv['uname'];?></td>
                <td><?=$adv['amount'];?></td>
                <td><?=$adv['descr'];?></td>
                <td><?=$adv['ip'];?></td>
                <td><?php switch ($adv['status']) {
					case '0': $s = '提交申请';break;
					case '1': $s = '已打款';break;
					case '2': $s = '取消';break;
					default:$s = '提交申请';
				};
				echo $s;
				?></td>
                <td><?=$adv['create_time'];?></td>
            </tr>
                <?php }?>
            </tbody>
        </table>
        <div class="clear"></div>
</div>
    <!-- End .content-box-content -->
</div>
<!-- End .content-box -->
<div class="content-box column-left">
    <div class="content-box-header">
        <h3>用户详细信息</h3>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab">
            <table>
                <tr>
                    <td><b>头像：</b></td>
                    <td><img src="<?=config_item('static_url')?>upload/designer/<?=str_replace('\\', '/', intToPath($user_info['uid']))?>icon.jpg" align="<?=$user_info['real_name'];?>" width="50" height="50"/> </td>

                    <td><b>真实姓名：</b></td>
                    <td><?=$user_info['real_name'];?></td>

                    <td><b>性别：</b></td>
                    <td><?=$user_info['sex'];?></td>
                </tr>
                <tr>
                    <td><b>生日：</b></td>
                    <td><?=$user_info['birthday'];?></td>

                    <td><b>国家：</b></td>
                    <td><?=$user_info['country'];?></td>

                    <td><b>省份：</b></td>
                    <td><?=$user_info['province'];?></td>
                </tr>
                <tr>
                    <td><b>城市：</b></td>
                    <td><?=$user_info['city'];?></td>

                    <td><b>邮编：</b></td>
                    <td><?=$user_info['zipcode'];?></td>

                    <td><b>兴趣爱好：</b></td>
                    <td><?=$user_info['interest'];?></td>
                </tr>
                <tr>
                    <td><b>详细地址：</b></td>
                    <td colspan="5"><?=$user_info['detail_address'];?></td>
                </tr>
                <tr>
                    <td><b>手机：</b></td>
                    <td><?=$user_info['phone'];?></td>

                    <td><b>公司电话：</b></td>
                    <td><?=$user_info['company_call'];?></td>

                    <td><b>家庭电话：</b></td>
                    <td><?=$user_info['family_call'];?></td>
                </tr>
                <tr>

                    <td><b>身高：</b></td>
                    <td><?=$user_info['height'];?>CM</td>

                    <td><b>体重：</b></td>
                    <td><?=$user_info['weight'];?>KG</td>

                    <td><b>体型：</b></td>
                    <td><?php $bodyType = config_item('bodyType');echo $bodyType[$user_info['body_type']];?></td>
                </tr>

                <tr>
                    <td><b>婚姻状况：</b></td>
                    <td><?php $maritalStatus = config_item('maritalStatus');echo $maritalStatus[$user_info['marital_status']];?></td>

                    <td><b>教育程序：</b></td>
                    <td><?php $education_level = config_item('educationLevel');echo $education_level[$user_info['education_level']];?></td>

                    <td><b>从事职业：</b></td>
                    <td><?php $jobs = config_item('jobs');echo $jobs[$user_info['job']];?></td>
                </tr>
                <tr>
                    <td><b>行业：</b></td>
                    <td><?php $industry = config_item('industry');echo $jobs[$user_info['industry']];?></td>

                    <td><b>月薪：</b></td>
                    <td><?php $income = config_item('income');echo $income[$user_info['income']];?></td>

                    <td><b>个人网站：</b></td>
                    <td><?=$user_info['website'];?></td>
                </tr>
                <tr>
                    <td><b>身份证号码：</b></td>
                    <td><?=$user_info['id_card'];?></td>

                    <td><b>开户银行：</b></td>
                    <td><?=$user_info['bank_name'];?></td>

                    <td><b>银行账号：</b></td>
                    <td><?=$user_info['bank_account'];?></td>
                </tr>
                <tr>
                    <td><b>自我介绍：</b></td>
                    <td colspan="7"><?=$user_info['introduction'];?></td>
                </tr>
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
        <h3>登陆日志信息</h3>
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
                    <th>登陆来源</th>
                    <th>登陆IP</th>
                    <th>创建时间</th>
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
                <?php if (!isset ($login_log_data)) $login_log_data = array();
                foreach ($login_log_data as $v) {
                    if (empty ($v)) continue;?>

                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?=$v['id'];?></td>
                    <td><?=$v['uid'];?></td>
                    <td><?=$v['login_source'];?></td>
                    <td><?=$v['ip'];?></td>
                    <td><?=$v['create_time'];?></td>
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
