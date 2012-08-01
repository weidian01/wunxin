<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>设置头像 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
        /*设置头像*/
        .sztx{width:800px;height:auto;background:url(/images/k_r_m.png) repeat-y;margin-bottom:10px;float:left;}
        .sztx .title{width:780px;height:28px;padding:12px 10px 0px 10px;background:url(/images/k_r_tg2.png) no-repeat top;float:left;}
        .sztx .title h2{width:175px;height:15px;background:url(/images/z_sztx.png) no-repeat; text-indent:-999em;float:left;}
        .sztx .main{width:798px;min-height:400px;_height:400px;padding:0px 1px 61px 1px;background:url(/images/k_r_b.png) no-repeat bottom;float:left;}
        .sztx .main .uploadbox{width:778px;background:#efefef;padding:10px;float:left;}
        .sztx .main .uploadbox dt{width:70px;font-weight:bold;float:left;}
        .sztx .main .uploadbox dd{width:708px;float:left;}
        .sztx .main .uploadbox dd p{padding:0px 0px 15px 8px;line-height:20px;}
        .sztx .main .photobox{width:650px;padding:20px 60px;float:left;}
        .sztx .main .photobox .photo{width:300px;height:300px;text-align:left;border:1px #000 solid;background:url(/images/photobox_bg.png);float:left;}
        .sztx .main .submit{clear:both;padding-left:80px;}
        .sztx .main .submit p{padding:10px;}
        .btn_b3 { background: url("/images/btn_b3.png") no-repeat scroll 0 0 transparent;
            border: 0 none; color: #FFFFFF; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; height: 35px; line-height: 35px; text-align: center; width: 122px;
        }

        #cutpic { font-size: 12px; padding: 0px; }
        .pic_list { border-right: 0 solid #E4E4E4; float: left; width: 406px; }
        .pic_list ul { margin-left: 17px; margin-right: 80px; overflow: hidden; }
        .pic_list li { border: 2px solid gray; display: inline; float: left; height: 60px; margin-left: 7px; margin-top: 8px; width: 60px; }

        .content img { vertical-align: middle; }
        .finishnew ul { list-style-type: none; margin: 0; padding: 0 0 0; }
        .finishnew { float: left; }
        .finishnew ul { list-style-type: none; margin: 0; padding: 0 0 0; }
        ul, menu, dir { display: block; }
        .finishnew ul li { color: #666666; float: left; font-family: "宋体"; font-size: 12px; line-height: 18px; padding-right: 15px; }
        .content img { vertical-align: middle; }
        img { border: medium none; }
        .blank10w { clear: both; display: block; font-size: 0; height: 10px; width: 60px; }
        .save { background-image: url("/images/scBTN.jpg"); border: 0 none; height: 27px; }
        .pic_list li img.selected { border: 2px solid #980d2c; cursor: pointer;display: inline; }
        .pic_list li img.hover { border:2px solid #980d2c; cursor:pointer; }

    </style>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include('/../../header.php');?>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">设置头像</div>

        </div>
        <div class="u-r-box">
            <div class="sztx">
                <div class="main">
                    <div class="uploadbox">
                        <dl>
                            <dt>上传图片：</dt>
                            <dd>
                                <div class="tips-text">
                                    支持JPEG、PNG和静态的GIF格式图片，不支持GIF动画图片，上传图片大小不能超过2M。
                                    <br /><br /><br />
                                    <div>

                                        你可以选择： <b>选择头像</b> <input type="radio" value="0" name="types" onclick="showLayer(0)" checked="checked">&nbsp;&nbsp;&nbsp;
                                        <b>上传头像</b> <input type="radio" value="1" name="types" onclick="showLayer(1)">

                                    </div>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="photobox" id="select_header">
                        <div id="cutpic">
                            <div class="pic_list">
                                <ul>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar1.jpg" class="" title="1"></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar2.jpg" class="" title="2"></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar3.jpg" class="" title="3"></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar4.jpg" class="" title="4"></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar5.jpg" class="" title="5"></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar6.jpg" class="" title="6"></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar7.jpg" class="" title="7"></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar8.jpg" class="" title="8"></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar9.jpg" class="" title="9"></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar10.jpg" class="" title="10"></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar11.jpg" class="" title="11"></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar12.jpg" class="" title="12"></a></li>
                                </ul>
                            </div>

                            <div class="finishnew" style=" margin:8px;">
                                <ul>
                                    <li style=" height:127px;">
                                        <img src="<?=config_item('static_url')?>upload/designer/<?=str_replace('\\', '/', intToPath($uInfo['uid']))?>icon.jpg" alt="<?php echo $uInfo['uname'];?>" width="60" height="60"
                                            onerror="javascript:this.src='<?=config_item('static_url')?>images/avatar/avatar1.jpg'"/>
                                        <span class="blank10w"></span>
                                        <a id="OK" onclick="SaveHead();" name="my_avatar_change_save" style="width: 90px;float: left;">
                                            <img border="0" src="<?=config_item('static_url')?>images/save_avatar.png" style="">

                                        </a>
                                        <span style="display: none;color: #A1A1A1;font-weight: bold;font-size: 11px;float: left;" id="setting_header_wait">
                                            <img class="maskall" src="<?=config_item('static_url')?>images/loading.gif">
                                        </span>
                                    </li>
                                </ul>
                            </div>

                            <div class="clear">
                            </div>

                            <form id="form1" action="/user/_SaveAvatarVT" enctype="multipart/form-data" method="post">
                                <input type="hidden" id="avatar_id" name="ID" value="0">
                            </form>
                        </div>
                    </div>

                    <div id="upload_header" style="display: none;">
                        <div style="width:600px;margin:0 auto;padding-top:50px;">
                            <div>
                                <!--
                                <h3 style="font-size:16px;padding:5px;border-bottom:solid 1px #ccc;">Flash头像上传 powered
                                    by darkangle, blog: <a href="http://darkangle.cnblogs.com" target="_blank">darkangle.cnblogs.com</a>
                                </h3>
                                -->
                                <div style="padding:10px 0;color:#666;">
                                    <br/><br/><br/>
                                    <h3>
                                    请你上传头像， 也可以
                                    <a style="color:#cc3300;" href="javascript:void(0);" onclick="useCamera()">使用摄像头来拍摄！</a>
                                    </h3>
                                    <br/>
                                </div>
                                <form enctype="multipart/form-data" method="post" name="upform" target="upload_target" action="/user/user/upload">
                                    <input type="file" name="Filedata" id="Filedata"/>
                                    <input style="margin-right:20px;" type="submit" name="" value="上传头像" onclick="return checkFile();"/>
                                    <span style="visibility:hidden;" id="loading_gif">
                                        <img src="<?=config_item('static_url')?>images/loading.gif" align="absmiddle"/>上传中，请稍侯......
                                    </span>
                                </form>
                                <iframe src="about:blank" name="upload_target" style="display:none;"></iframe>
                                <div id="avatar_editor"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<script type="text/javascript">
    function SaveHead(dId)
    {
        //document.getElementById('setting_header_wait').style = '';
        $('#setting_header_wait').html('<img src="<?=config_item('static_url')?>images/loading.gif" style="  margin-top:30px;" class="maskall">');
        $('#setting_header_wait').fadeIn();

        var avatarId = document.getElementById('avatar_id').value;

        if (!wx.isEmpty(avatarId)) {
            return false;
        }

        var url = '/user/user/setUserHeader';
        var param = 'avatar_id='+avatarId;
        var data = wx.ajax(url, param);

        if (data.error == '0') {
            $('#setting_header_wait').hide();
            $('#setting_header_wait').html(data.msg);
            $('#setting_header_wait').fadeIn('slow');
            //wx.pageReload(0);
            window.setTimeout(hide,5000);
            return true;
        }

        var t = '';
        switch (data.error) {
            case '10043': t = '请选择头像';break;
            case '10044': t = '设置失败';break;
            default :t = '未知错误';
        }

        $('#setting_header_wait').html(t);
        //$('#setting_header_wait').hidden();

        //alert('删除失败!');
    }

    function hide(id)
    {
        $('#setting_header_wait').fadeOut('slow');
    }

    function showLayer(v)
    {
        if (v == '1') {
            document.getElementById('upload_header').style.display = '';
            document.getElementById('select_header').style.display = 'none';
        } else {
            document.getElementById('select_header').style.display = '';
            document.getElementById('upload_header').style.display = 'none';
        }
    }

    $(function () {
           var imgList = $(".pic_list img");
           $(".finishnew img:eq(0)").bind("error", function () {
               $(this).attr("src", "/images/avatar/avatar1.jpg");
           });
           imgList.click(function () {
               $("[fid=tipsavevt]").text("").hide();
               $(".finishnew img:eq(0)").attr("src", $(this).attr("src")).parent().next("[fid=msgvtnoimage]").hide();
               $("#filename").val($(this).attr("src"));
               imgList.removeClass("selected");
               $(this).addClass("selected");

               document.getElementById('avatar_id').value = this.title;
           });
           imgList.hover(function () {
               if ($(this).attr("src") == $("#filename").val()) {
                   return;
               }
               imgList.removeClass("hover");
               $(this).addClass("hover");
           }, function () {
               $(this).removeClass("hover");
           });
           var path = $(".finishnew img:eq(0)").attr("src");
           //    if (path.indexOf("vancl300.jpg") > -1) {
           //        $(".pic_list img:eq(0)").click();
           //    }
           //    else {
           //
           $(".pic_list img[src='" + path + "']").click();
           //    }
       });


    //允许上传的图片类型
    var extensions = 'jpg,jpeg,gif,png';
    //保存缩略图的地址.
    var saveUrl = '/user/user/saveAvatar';
    //保存摄象头白摄图片的地址.
    var cameraPostUrl = '/user/user/camera';
    //头像编辑器flash的地址.
    var editorFlaPath = '<?=config_item('static_url')?>images/AvatarEditor.swf';
    //Download by http://www.codefans.net
    function useCamera() {
        var content = '<embed height="464" width="514" ';
        content += 'flashvars="type=camera';
        content += '&postUrl=' + cameraPostUrl + '?&radom=1';
        content += '&saveUrl=' + saveUrl + '?radom=1" ';
        content += 'pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" ';
        content += 'allowscriptaccess="always" quality="high" ';
        content += 'src="' + editorFlaPath + '"/>';
        document.getElementById('avatar_editor').innerHTML = content;
    }

    function buildAvatarEditor(pic_id, pic_path, post_type) {
        var content = '<embed height="464" width="514"';
        content += 'flashvars="type=' + post_type;
        content += '&photoUrl=' + pic_path;
        content += '&photoId=' + pic_id;
        content += '&postUrl=' + cameraPostUrl + '?&radom=1';
        content += '&saveUrl=' + saveUrl + '?radom=1"';
        content += ' pluginspage="http://www.macromedia.com/go/getflashplayer"';
        content += ' type="application/x-shockwave-flash"';
        content += ' allowscriptaccess="always" quality="high" src="' + editorFlaPath + '"/>';
        document.getElementById('avatar_editor').innerHTML = content;
    }
    /**
     * 提供给FLASH的接口 ： 没有摄像头时的回调方法
     */
    function noCamera() {
        alert("俺是小狗, 俺没有camare ：）");
    }

    /**
     * 提供给FLASH的接口：编辑头像保存成功后的回调方法
     */
    function avatarSaved() {
        alert('保存成功，哈哈');
        //window.location.href = '/profile.do';
    }

    /**
     * 提供给FLASH的接口：编辑头像保存失败的回调方法, msg 是失败信息，可以不返回给用户, 仅作调试使用.
     */
    function avatarError(msg) {
        alert("上传失败了呀，哈哈");
    }

    function checkFile() {
        var path = document.getElementById('Filedata').value;
        var ext = getExt(path);
        var re = new RegExp("(^|\\s|,)" + ext + "($|\\s|,)", "ig");
        if (extensions != '' && (re.exec(extensions) == null || ext == '')) {
            alert('对不起，只能上传jpg, gif, png类型的图片');
            return false;
        }
        showLoading();
        return true;
    }

    function getExt(path) {
        return path.lastIndexOf('.') == -1 ? '' : path.substr(path.lastIndexOf('.') + 1, path.length).toLowerCase();
    }
    function showLoading() {
        document.getElementById('loading_gif').style.visibility = 'visible';
    }
    function hideLoading() {
        document.getElementById('loading_gif').style.visibility = 'hidden';
    }
</script>
<!-- #EndLibraryItem -->
</body>
</html>

