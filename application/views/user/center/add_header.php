<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>设置头像 -- 个人中心</title>
    <link href="/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="/css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="/scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="/scripts/iepng.js"></script>
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
        .sztx .main .photobox{width:618px;padding:30px 90px;float:left;}
        .sztx .main .photobox .photo{width:300px;height:300px;text-align:left;border:1px #000 solid;background:url(/images/photobox_bg.png);float:left;}
        .sztx .main .photobox ul{padding-left:10px;float:left;}
        .sztx .main .photobox ul li{padding-bottom:10px;}
        .sztx .main .submit{clear:both;padding-left:80px;}
        .sztx .main .submit p{padding:10px;}
        .btn_b3 {
            background: url("/images/btn_b3.png") no-repeat scroll 0 0 transparent;
            border: 0 none; color: #FFFFFF; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; height: 35px; line-height: 35px; text-align: center; width: 122px;
        }
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
                                <p>
                                    <object width="104" height="20" class="swfupload"
                                            data="http://static.yohobuy.com/admin/js/swfupload/swfupload.swf"
                                            type="application/x-shockwave-flash" id="SWFUpload_0">
                                        <param value="TRANSPARENT" name="wmode">
                                        <param value="http://static.yohobuy.com/admin/js/swfupload/swfupload.swf"
                                               name="movie">
                                        <param value="high" name="quality">
                                        <param value="false" name="menu">
                                        <param value="always" name="allowScriptAccess">
                                        <param
                                            value="movieName=SWFUpload_0&amp;uploadURL=http%3A%2F%2Fsso.upload.yohobuy.com&amp;useQueryString=false&amp;requeueOnError=false&amp;httpSuccess=&amp;assumeSuccessTimeout=0&amp;params=&amp;filePostName=Filedata&amp;fileTypes=*.jpg%3B*.gif%3B*.jpeg%3B*.png&amp;fileTypesDescription=All%20Files&amp;fileSizeLimit=2%20MB&amp;fileUploadLimit=6&amp;fileQueueLimit=0&amp;debugEnabled=false&amp;buttonImageURL=http%3A%2F%2Fstatic.yohobuy.com%2Fimages%2Fbtn_upload_xzzp.png&amp;buttonWidth=104&amp;buttonHeight=20&amp;buttonText=%3Cspan%20class%3D%22btn_upload_xzzp%22%3E%E9%80%89%E6%8B%A9%E6%9C%AC%E5%9C%B0%E7%85%A7%E7%89%87%3C%2Fspan%3E&amp;buttonTextTopPadding=0&amp;buttonTextLeftPadding=24&amp;buttonTextStyle=.btn_upload_xzzp%7Bcolor%3A%23ffffff%7D&amp;buttonAction=-110&amp;buttonDisabled=false&amp;buttonCursor=-2"
                                            name="flashvars">
                                    </object>
                                </p>
                                <div class="tips-text"> 支持JPEG和静态的GIF格式图片，不支持GIF动画图片，上传图片大小不能超过2M。</div>
                            </dd>
                        </dl>
                    </div>
                    <div class="photobox">
                        <div class="photo" id="cropzoom_container"><img
                            src="<?=config_item('static_url')?>images/photobox_bg.png" id="imgsrcs"></div>
                        <ul>
                            <li id="preview"><img src="<?=config_item('static_url')?>images/userdefault_100_100.png" id="generated_100_100"></li>
                            <!-- li><img id="generated_48_48" src="http://static.yohobuy.com/images/userdefault_100_100.png" /></li-->
                            <li><img src="<?=config_item('static_url')?>images/userdefault_48_48.png" id="generated_48_48">
                            </li>
                            <li><img src="<?=config_item('static_url')?>images/userdefault_16_16.png" id="generated_16_16">
                            </li>
                        </ul>
                    </div>
                    <div class="submit">
                        <div class="tips-text"> 右边是获取的切图的示意图，你可以拖动上面的像框来编辑图片。</div>
                        <form method="POST" target="userIframe" action="http://sso.upload.yohobuy.com/crop" id="cropForm">
                            <input type="hidden" id="_key" value="----E---" name="_key">
                            <input type="hidden" id="image_source" name="image_source">
                            <input type="hidden" id="image_h" name="image_h">
                            <input type="hidden" id="image_rotate" name="image_rotate">
                            <input type="hidden" id="image_w" name="image_w">
                            <input type="hidden" id="image_x" name="image_x">
                            <input type="hidden" id="image_y" name="image_y">
                            <input type="hidden" id="selector_h" name="selector_h">
                            <input type="hidden" id="selector_w" name="selector_w">
                            <input type="hidden" id="selector_x" name="selector_x">
                            <input type="hidden" id="selector_y" name="selector_y">
                            <input type="hidden" id="view_port_w" name="view_port_w">
                            <input type="hidden" id="view_port_h" name="view_port_h">
                        </form>
                        <form method="POST" action="/home/user/savehead">
                            <p>
                                <input type="hidden" id="headico" name="headico">
                                <input type="button" class="btn_b3" value="剪切照片" id="crop">
                                <input type="button" class="btn_b3" value="照片复位" id="restore">
                                <input type="submit" class="btn_b3" value="确认修改" id="cropUpdate">
                                <br><span style="display:none" class="loading">正在处理中…</span>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="/scripts/common.js"></SCRIPT>
<script type="text/javascript">
    function deleteDesignerFavorite(dId)
    {
        if (confirm('确定删除！')) {
            if (!wx.isEmpty(dId)) {
                return false;
            }

            var url = '/user/designerFavorite/deleteDesignerFavorite';
            var param = 'fid='+dId;
            var data = wx.ajax(url, param);

            if (data.error == '10020') {
                wx.pageReload(0);
                return true;
            }

            alert('删除失败!');
        }
    }
</script>
<!-- #EndLibraryItem -->
</body>
</html>

