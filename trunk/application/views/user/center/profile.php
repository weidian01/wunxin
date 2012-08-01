<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>个人资料 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery-1.4.2.min.js"></script>
    <script type=text/javascript src="http://static.yohobuy.com/js/home/user.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
/*个人资料*/
.grzl{width:800px;height:auto;background:url(/images/k_r_m.png) repeat-y;margin-bottom:10px;float:left;}
.grzl .title{width:780px;height:28px;padding:12px 10px 0px 10px;background:url(/images/k_r_tg2.png) no-repeat top;float:left;}
.grzl .title h2{width:175px;height:15px;background:url(/images/z_grzl.png) no-repeat; text-indent:-999em;float:left;}
.grzl .main{width:778px;min-height:400px;_height:400px;padding:1px 11px 11px 11px;background:url(/images/k_r_b.png) no-repeat bottom;float:left;}
.grzl .main h2{clear:both;height:21px;line-height:21px;padding-left:23px;background:url(/images/ico_arrow2.png) no-repeat 5px 5px #efefef;
    border:1px #e6e6e6 solid;font-size:12px;color:#333;font-weight:normal;cursor:pointer;margin-bottom:2px;}
.grzl .main h2 span{color:#999;}
.grzl .main h2 .more{padding:2px 10px 0px 0px;float:right;}
.grzl .main .box{width:778px;clear:both;padding-top:10px;margin-bottom:10px;float:left;}
.grzl .main .box:after { content:""; display:block; clear:both; height:0; }
.grzl .main .submit{padding:0px 0px 20px 80px;}
.grzl-hyxx .box-info{width:552px;padding-right:38px;float:left;}
.grzl-hyxx .box-info dl{height:30px;border:1px #fff solid;margin-bottom:2px;line-height:22px;font-family:宋体;}
.grzl-hyxx .box-info dl dt{width:80px;text-align:right;color:#848484;float:left;}
.grzl-hyxx .box-info dl dd{width:470px;padding-bottom:1px;color:#666;float:left;}
.grzl-hyxx .box-pic{width:148px;padding:20px;background:url(/images/line_dot_s.png) repeat-y left;text-align:center;float:right;}


.grzl-grxg dl{clear:both;width:770px;padding-bottom:5px;float:left;}
.grzl-grxg dl:after { content:""; display:block; clear:both; height:0; }
.grzl-grxg dl dt{width:80px;text-align:right;line-height:25px;float:left;}
.grzl-grxg dl dd{width:690px;float:left;}

.grzl-lxxx dl{clear:both;width:770px;padding-bottom:5px;float:left;}
.grzl-lxxx dl:after { content:""; display:block; clear:both; height:0; }
.grzl-lxxx dl dt{width:80px;text-align:right;line-height:22px;float:left;}
.grzl-lxxx dl dd{width:690px;line-height:22px;float:left;}
.grzl-lxxx a{color:#468fa2; text-decoration:underline;}

.grzl-xapp dl{clear:both;width:730px;padding:0px 20px 5px 20px;float:left;}
.grzl-xapp dl span{color:#999;line-height:25px;display:inline-block;}
.grzl-xapp ul{clear:both;width:750px;padding:0px 20px 20px 0px;float:left;}
.grzl-xapp ul li{height:22px;padding-left:20px;float:left;}
.grzl-xapp .submit{width:690px;padding:0px 0px 0px 80px;}
.grzl-xapp .addbox{width:725px;margin:0px 0px 10px 20px;display:inline;padding:5px 10px 5px 0px;border:1px #ccc solid;background:#f8f8f8;color:#000;}
.grzl-xapp .addbox li{height:22px;line-height:22px;padding:0px 0px 0px 10px;float:left;display:inline-block; white-space:nowrap;}
.grzl-xapp .addbox .btn_del{ vertical-align:middle;}
dt{font-weight: bold;color: #848484;}
/*.btn_edit { background: url("/images/btn_edit.png") no-repeat scroll 0 0 transparent; border: 0 none; display: inline-block; height: 17px; overflow: hidden; width: 37px;}*/
    </style>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include('/../../header.php');?>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">个人资料</div>
        </div>

        <div class="grzl">
            <div class="main">
                <div class="grzl-hyxx">
                    <h2 onclick="user.showBox(1);"> <div class="more"><a title="修改" class="btn_edit" style="font-weight: bold;">修改</a></div> <b>会员信息：</b> </h2>
                    <div id="box_1">
                        <div class="box">
                            <div class="box-info">
                                <dl>
                                    <dt>登录邮箱：</dt>
                                    <dd><?php echo $uinfo['uname'];?></dd>
                                </dl>
                                <dl class="tips-box-text">
                                    <dt>昵称：</dt>
                                    <dd>
                                        <input type="text" value="<?php echo $uinfo['nickname'];?>" style="width:150px;" id="nickname_id" class="input_1" name="nickname">
                                        <span id="nicknameTip" class="tips-p">昵称必须大于2而小于20个字符</span>
                                    </dd>
                                </dl>
                                <dl class="tips-box-text">
                                    <dt>真实姓名：</dt>
                                    <dd>
                                        <input type="text" style="width:150px;" class="input_1" value="<?php echo $uinfo['real_name'];?>" id="realname_id" name="user_name">
                                        <span id="user_nameTip" class="tips-p">真实姓名至少2个中文,最多5个中文</span>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>性别：</dt>
                                    <dd>
                                        <input type="radio" value="1" name="sex_id" <?php echo ($uinfo['sex'] == '1') ? 'checked="checked"' : '';?>>男
                                        <input type="radio" value="2" name="sex_id" <?php echo ($uinfo['sex'] == '2') ? 'checked="checked"' : '';?>>女
                                        <input type="radio" value="0" name="sex_id" <?php echo ($uinfo['sex'] == '0') ? 'checked="checked"' : '';?>>保密
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>生日：</dt>
                                    <dd>
                                        <select onchange="user.changeYear();" id="year_id" name="year">
                                            <?php for($i = 1940; $i <= date('Y'); $i++) {?>
                                            <option value="<?php echo $i;?>" <?php echo ( $i == date('Y', strtotime($uinfo['birthday'])) ) ? 'selected="selected"' : '';?>><?php echo $i;?>年</option>
                                            <?php }?>
                                        </select>

                                        <select onchange="user.changeMonth(this);" id="month_id" name="month">
                                            <?php for($i = 1; $i <= 12; $i++) {?>
                                            <option value="<?php echo $i;?>" <?php echo ( $i == date('m', strtotime($uinfo['birthday'])) ) ? 'selected="selected"' : '';?>><?php echo $i;?>月</option>
                                            <?php }?>
                                        </select>
                                        <select id="day_id" name="day">
                                            <option value="<?php echo date('d', strtotime($uinfo['birthday'])); ?>" ><?php echo date('d', strtotime($uinfo['birthday'])); ?>日</option>
                                        </select>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>婚姻状况：</dt>
                                    <dd>
                                        <select data-vocation="" name="Vocation" id="marital_status_id" onchange="ChangeVocation()">
                                            <?php foreach ($marital_status as $msk => $msv){?>
                                            <option value="<?php echo $msk;?>" <?php echo ($msk == $uinfo['marital_status']) ? 'selected="selected"' : '';?>><?php echo $msv;?></option>
                                            <?php }?>
                                        </select>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>教程程度：</dt>
                                    <dd>
                                        <select data-vocation="" name="Vocation" id="education_level_id" onchange="ChangeVocation()">
                                            <option value="0">请选择&nbsp; </option>
                                            <?php foreach ($education_level as $elk => $elv){?>
                                            <option value="<?php echo $elk;?>" <?php echo ($elk == $uinfo['education_level']) ? 'selected="selected"' : '';?>><?php echo $elv;?></option>
                                            <?php }?>
                                        </select>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>职业：</dt>
                                    <dd>
                                        <select data-vocation="" name="Vocation" id="jobs_id" onchange="ChangeVocation()">
                                            <option value="0">请选择&nbsp; </option>
                                            <?php foreach ($jobs as $jk => $jv){?>
                                            <option value="<?php echo $jk;?>" <?php echo ($jk == $uinfo['job']) ? 'selected="selected"' : '';?>><?php echo $jv;?></option>
                                            <?php }?>
                                        </select>
                                    </dd>
                                </dl>
                                <dl>
                                      <dt>所属行业：</dt>
                                      <dd>
                                          <select data-vocation="" name="Vocation" id="industry_id">
                                              <option value="0">请选择&nbsp; </option>
                                              <?php foreach ($industry as $ik => $iv){?>
                                              <option value="<?php echo $ik;?>" <?php echo ($ik == $uinfo['industry']) ? 'selected="selected"' : '';?>><?php echo $iv;?></option>
                                              <?php }?>
                                          </select>
                                      </dd>
                                  </dl>
                                <dl>
                                    <dt>收入状况：</dt>
                                    <dd>
                                        <select id="income_id" name="income">
                                            <option value="0">请选择&nbsp; </option>
                                            <?php foreach ($income as $ik => $iv) {?>
                                            <option value="<?php echo $ik;?>" <?php echo ($ik == $uinfo['income']) ? 'selected="selected"' : '';?>><?php echo $iv;?></option>
                                            <?php }?>
                                        </select>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>身材/偏好：</dt>
                                    <dd>
                                        身高(CM):&nbsp;<input type="text" name="height" id="height_id" value="<?php echo $uinfo['height'];?>" size="5"/>
                                        &nbsp;&nbsp;
                                        体重(KG):&nbsp;<input type="text" name="weight" id="weight_id" value="<?php echo $uinfo['weight'];?>" size="5"/>
                                        &nbsp;&nbsp;
                                        体型:&nbsp;
                                        <select name="body_type" id="body_type_id">
                                            <option value="0">请选择体型</option>
                                            <?php foreach($body_type as $bk => $bv) {?>
                                            <option value="<?php echo $bk;?>"  <?php echo ($bk == $uinfo['body_type']) ? 'selected="selected"' : '';?>><?php echo $bv;?></option>
                                            <?php }?>
                                        </select>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>个人网站：</dt>
                                    <dd>
                                        <input type="text" name="website" id="website_id" value="<?php echo $uinfo['website'];?>" size="36"/>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>自我介绍：</dt>
                                    <dd>
                                        <textarea rows="3" cols="30" name="introduction" id="introduction_id"><?php echo $uinfo['introduction'];?></textarea>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>兴趣爱好：</dt>
                                    <dd>
                                        <textarea rows="3" cols="30" name="interest" id="interest_id"><?php echo $uinfo['interest'];?></textarea>
                                    </dd>
                                </dl>
                            </div>
                            <div class="box-pic">
                                <img src="<?=config_item('static_url')?>upload/designer/<?=intToPath($uinfo['uid'])?>icon.jpg" alt="<?php echo $uinfo['uname'];?>" width="60" height="60"/>
                                <!--<img src="http://static.yoho.cn/images/default_userhead_boy_100_100.png">-->
                                <br>
                                <a class="btn_ggtx" href="/user/center/addUserHeader">
                                    <img src="<?=config_item('static_url')?>images/modify_header.png" alt="" title="更改头像">
                                </a>
                            </div>

                        </div>
                        <div class="submit">
                            <!--<input type="button" class="btn_b1" value="保存" id="baseInfo" onclick="user.saveUserBaseInfo()">-->
                            <img src="<?=config_item('static_url')?>images/save_modify.jpg" title="保存修改的用户信息" onclick="user.saveUserBaseInfo()" style="cursor: pointer;">
                        </div>
                    </div>
                </div>

                <div class="grzl-lxxx">
                    <h2 onclick="user.showBox(2);"> <div class="more"><a title="修改" class="btn_edit" style="color: #000000;font-weight: bold;text-decoration: none;">修改</a></div> <b>联系信息：</b> </h2>
                    <div id="box_2" style="display: none;">
                        <div class="box">
                            <dl>
                                <dt>来自：</dt>
                                <dd>
                                    <select name="province" id="province_id" onchange="order.changeProvince(this.value)">
                                        <option value="0">请选择省份</option>
                                        <?php foreach ($province_data as $pv) {?>
                                        <option value="<?php echo $pv['id'];?>" <?php echo ($pv['name'] == trim($uinfo['province'])) ? 'selected="selected"' : '';?>><?php echo $pv['name'];?></option>
                                        <?php }?>
                                    </select>
                                    <select name="city" id="city_id">
                                        <option value="0">请选择市</option>
                                        <?php foreach ($city_data as $cv) {?>
                                        <option value="<?php echo $cv['id'];?>" <?php echo ($cv['name'] == trim($uinfo['city'])) ? 'selected="selected"' : '';?>><?php echo $cv['name'];?></option>
                                        <?php }?>
                                    </select>
                                    <!--
                                    <select id="area_id" name="area_code">
                                        <option value="0">请选择区或县</option>
                                        <?php foreach ($area_data as $av) {?>
                                        <option value="<?php echo $av['id'];?>" <?php echo ($av['name'] == trim($uinfo['province'])) ? 'selected="selected"' : '';?>><?php echo $av['name'];?></option>
                                        <?php }?>
                                    </select>
                                    -->
                                </dd>
                            </dl>
                            <dl>
                                <dt>联系地址：</dt>
                                <dd><input type="text" style="width:300px;" class="input_1" value="<?php echo $uinfo['detail_address'];?>" id="detail_address_id" name="full_address">
                                    <span id="full_addressTip" class="tips-p">请填写详细地址</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>公司电话：</dt>
                                <dd>
                                    <input type="text" style="width:150px;" class="input_1" value="<?php echo $uinfo['company_call'];?>" id="company_call_id" name="company_call">
                                    <span id="phoneTip" class="tips-p">如: 010-82831245</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>家庭电话：</dt>
                                <dd>
                                    <input type="text" style="width:150px;" class="input_1" value="<?php echo $uinfo['family_call'];?>" id="family_call_id" name="phone">
                                    <span id="phoneTip" class="tips-p">如: 010-82831245</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>手机号码：</dt>
                                <dd>
                                    <input type="text" style="width:150px;" class="input_1" value="<?php echo $uinfo['phone'];?>" id="phone_id" name="phone">
                                    <span id="mobileTip" class="tips-p">填写手机号便于接收发货和收货通知</span></dd>
                            </dl>
                            <dl>
                                <dt>QQ：</dt>
                                <dd>
                                    <input type="text" style="width:150px;" class="input_1" value="<?php echo $uinfo['qq'];?>" id="qq_id" name="qq">
                                    <span class="tips-p">填写QQ方便您的好友联系你</span></dd>
                            </dl>
                            <dl>
                                <dt>邮编：</dt>
                                <dd><input type="text" class="input_1" value="<?php echo $uinfo['zipcode'];?>" id="zipcode_id" name="zip_code">
                                    <span id="zip_codeTip" class="tips-p">请输入收货人所在地邮编号</span></dd>
                            </dl>
                        </div>
                        <div class="submit">
                            <!--<input type="button" class="btn_b1" value="保存" id="contactInfo" onclick="user.saveUserBaseInfo()">-->
                            <img src="<?=config_item('static_url')?>images/save_modify.jpg" title="保存修改的用户信息" onclick="user.saveUserBaseInfo()" style="cursor: pointer;">
                        </div>
                    </div>
                </div>

                <div class="grzl-grxg">
                    <h2 onclick="user.showBox(3);"> <div class="more"><a title="修改" class="btn_edit" style="font-weight: bold;">修改</a></div> <b>私密信息：</b> </h2>
                    <div id="box_3" style="display: none;">
                        <div class="box">
                            <dl>
                                <dt>身份证号码：</dt>
                                <dd>
                                    <input type="text" name="id_card" id="id_card_id" value="<?php echo $uinfo['id_card'];?>" size="36">
                                </dd>
                            </dl>
                            <dl>
                                <dt>开户银行：</dt>
                                <dd>
                                    <input type="text" name="bank_name" id="bank_name_id" value="<?php echo $uinfo['bank_name'];?>" size="36">
                                </dd>
                            </dl>
                            <dl>
                                <dt>银行卡号：</dt>
                                <dd>
                                    <input type="text" name="bank_account" id="bank_account_id" value="<?php echo $uinfo['bank_account'];?>" size="36">
                                </dd>
                            </dl>
                        </div>
                        <div class="submit">
                            <!--<input type="button" class="btn_b1" value="保存" id="shoppingInfo" onclick="user.saveUserBaseInfo()">-->
                            <img src="<?=config_item('static_url')?>images/save_modify.jpg" title="保存修改的用户信息" onclick="user.saveUserBaseInfo()" style="cursor: pointer;">
                        </div>
                    </div>
                </div>

              </div>
            </div>

        <div class="pages" style="float: right;">
        <?php //echo $page_html;?>
        </div>
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/user.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/order.js"></SCRIPT>
<script type="text/javascript">
user.saveUserBaseInfo = function ()
{
    var nickname = document.getElementById('realname_id').value;
    var realname = document.getElementById('realname_id').value;
    var sex = $("input[name='sex_id'][checked]").val(); //wx.getRadioCheckBoxValue('sex_id');
    var birthday = $('#year_id').val()+'-'+$('#month_id').val()+'-'+$('#day_id').val();
    var marital_status =$('#marital_status_id').val();
    var education_level = $('#education_level_id').val();
    var jobs = $('#jobs_id').val();
    var industry = $('#industry_id').val();
    var income = $('#income_id').val();
    var height = document.getElementById('height_id').value;
    var weight = document.getElementById('weight_id').value;
    var body_type = $('#body_type_id').val();
    var website = document.getElementById('website_id').value;
    var introduction = document.getElementById('introduction_id').value;
    var interest = document.getElementById('interest_id').value;

    var province = $("#province_id").find("option:selected").text();//$('#province_id').val();
    var city = $("#city_id").find("option:selected").text();//$('#city_id').val();
    var family_call = document.getElementById('family_call_id').value;
    var company_call = document.getElementById('company_call_id').value;
    var phone = document.getElementById('phone_id').value;
    var qq = document.getElementById('qq_id').value;
    var detail_address = document.getElementById('detail_address_id').value;
    var zipcode = document.getElementById('zipcode_id').value;
    var id_card = document.getElementById('id_card_id').value;
    var bank_name = document.getElementById('bank_name_id').value;
    var bank_account = document.getElementById('bank_account_id').value;

    var url = '/user/user/saveUserInfo';
    var param = 'nickname='+nickname+'&realname='+realname+'&sex='+sex+'&birthday='+birthday+'&marital_status='+marital_status+'&education_level='+education_level+'&job='+jobs;
    param += '&industry='+industry+'&income='+income+'&height='+height+'&weight='+weight+'&body_type='+body_type+'&website='+website+'&introduction='+introduction+'&interest='+interest;
    param += '&province='+province+'&city='+city+'&family_call='+family_call+'&company_call='+company_call+'&phone='+phone+'&qq='+qq+'&detail_address='+detail_address+'&zipcode='+zipcode;
    param += '&id_card='+id_card+'&bank_name='+bank_name+'&bank_account='+bank_account;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        alert('修改成功!')
        wx.pageReload(0);
        return true;
    }

    alert('删除失败!');
}
user.userInfoInit = function(year, monthon, day)
{
    this.crateDay(year, monthon, day);
    $("#box_2").hide();
    $("#box_3").hide();
    $("#box_4").hide();
}
user.changeMonth = function() {
    var year = $("#year_id").val();
    var month = $("#month_id").val();
    var day = $("#day_id").val();
    this.crateDay(year, month, day);
}
user.changeYear = function() {
    var year = $("#year_id").val();
    var month = $("#month_id").val();
    var day = $("#day_id").val();
    this.crateDay(year, month, day);
}
user.crateDay = function(year, month, day) {
    if(parseInt(year) == 0)
    {
        year = 0;

    }
    if(parseInt(month) == 0)
    {
        month = 0;
    }
    $("#year_id").val(year);
    $("#month_id").val(month);

    var html = '<select name="day" id="day_id">';
    html += '<option value="0">请选择日</option>';
    if(year > 0 && month > 0){
        var monthArray = new Array(4, 6, 9, 11);
        var dayNum = 31;
        if (jQuery.inArray(month, monthArray) != -1) {
            dayNum = 30;
        } else if (month == 2 ) {
            dayNum = 28;
            if(0 == year % 4 && (year % 100 != 0 || year % 400 == 0))
            {
                dayNum = 29;
            }
        }

        for ( var i = 1; i <= dayNum; i++) {
            var select = '';
            if (parseInt(day) == i) {
                select = 'selected';
            }
            html += '<option value="' + i + '" ' + select + '>' + i	+ '日</option>';
        }
    }
    html += '</select>';
    $("#day_id").replaceWith(html);
}

user.showBox = function(id)
{
    if(parseInt(id) == 0 || parseInt(this.oldBoxId) == 0)
    {
        return false;
    }
    $("#box_" + id).slideDown('slow');
    $("#box_" + this.oldBoxId).hide();
    this.oldBoxId = id;
    if(id == 2)
    {
        this.checkContactForm();
    }else if(id == 1)
    {
        this.checkBaseForm();
    }
}

user.save = function (postUrl,formId, box_id){
    if(typeof(postUrl) == 'undefined' || postUrl == '' || typeof(formId) == 'undefined' || formId == '')
    {
        alert('参数错误');
        return false;
    }
    $.post(postUrl,$('#'+formId).serialize(),
        function(data){
            if(data.code == 200){
                alert(data.message);
                if(parseInt(box_id) != 0)
                {
                    user.showBox(box_id);
                }
                return true;
            }
            alert(data.message);
            return false;
        }, 'json');
}

user.delBrand = function(brand_id, flag)
{
    if(parseInt(brand_id) == 0)
    {
        return false;
    }
    var brand = $("#likebrand").val();
    $("#likebrand").val(brand.replace(','+brand_id+',', ','));
    $("#pp_" + brand_id).attr('checked', false);
    $("#brand_" + brand_id).remove();
}

user.addBrand = function(obj, brand_id, brand_name)
{
    if(parseInt(brand_id) == 0)
    {
        return false;
    }
    var brandInfo = $('#brand_' + brand_id).html();
    if(typeof obj != 'undefined' && obj != '' && obj.checked == false)
    {
        this.delBrand(brand_id);
        return false;
    }
    if(brandInfo != null)
    {
        alert('您已经选择了该品牌.');
        return false;
    }
    var html = '<li id="brand_'+brand_id+'">'+ brand_name +' <a href="javascript:void(0);" onclick="user.delBrand('+brand_id+', this);" class="btn_del"></a></li>';
    $("#brandBox").append(html);
    var brandStr = $("#likebrand").val();
    brandStr += brand_id + ',';
    $("#likebrand").val(brandStr);
}

user.checkBrand = function()
{
    $.post('/home/user/checkbrand',{keywords:$('#keywords').val()},
        function(data){
            if(data.code == 200){
                user.addBrand('',data.data.id, data.data.brand_name);
                $('#keywords').val('');
                return true;
            }
            alert(data.message);
            return false;
        }, 'json');
}

user.checkBaseForm = function()
{
    return false;
    jQuery.formValidator.initConfig({
        formid : "userBaseInfo"
    });
    jQuery("#nickname").formValidator({
        onshow : "请填写昵称",
        onfocus : "昵称必须大于2而小于20个字符",
        oncorrect : "昵称输入正确"
    }).inputValidator({
        min : 2,
        max : 20,
        onerror : "您输入的昵称不正确"
    });
    jQuery("#user_name").formValidator({
        onshow : "请填写申请人的真实姓名",
        onfocus : "真实姓名只能为中文",
        oncorrect : "输入正确"
    }).regexValidator({
        regexp : "^[\u4e00-\u9fa5]{2,5}$",
        onerror : "真实姓名至少2个中文,最多5个中文"
    });
}

user.checkContactForm = function()
{
    return false;
    jQuery.formValidator.initConfig({
        formid : "userContactInfo"
    });
    $('#mobile').formValidator({
        onshow : "填写手机号便于接收发货和收货通知",
        onfocus : "填写手机号便于接收发货和收货通知",
        oncorrect : "输入正确"
    }).regexValidator({
        regexp : regexEnum.mobile,
        onerror : "您输入的手机号码格式不正确"
    });
    $('#full_address').formValidator({
        onshow : "请填写详细地址",
        onfocus : "请填写详细地址",
        oncorrect : "输入正确",
        onempty: "请填写详细地址",
        empty: false
    }).inputValidator({
        min : 10,
        onerror : "请填写详细地址"
    });
    //邮编
    $('#zip_code').formValidator({
        onshow : "请输入收货人所在地邮编号",
        onfocus : "请输入收货人所在地邮编号",
        oncorrect : "输入正确",
        onempty: "请输入收货人所在地邮编号",
        empty: false
    }).regexValidator({
        regexp : regexEnum.zipcode,
        onerror : "您输入的邮编式不正确"
    });
}

user.checkShoppingForm = function()
{
    if($('#brandStr').val() == '')
    {
        alert('请添加您喜欢的品牌');
        return false;
    }
    return true;
}

user.userInfoInit(<?php echo date('Y', strtotime($uinfo['birthday'])); ?>, <?php echo date('m', strtotime($uinfo['birthday'])); ?>, <?php echo date('d', strtotime($uinfo['birthday'])); ?>);
</script>
<!-- #EndLibraryItem -->
</body>
</html>

