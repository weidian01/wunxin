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
        .sztx .main .photobox{width:618px;padding:20px 60px;float:left;}
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
                                    支持JPEG和静态的GIF格式图片，不支持GIF动画图片，上传图片大小不能超过2M。

                                    <div>
                                        你可以选择： 选择头像<input type="radio" value="0" name="types" onclick="showLayer(0)" checked="checked">
                                        上传头像<input type="radio" value="1" name="types" onclick="showLayer(1)">
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
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar1.jpg" class=""></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar2.jpg" class=""></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar3.jpg" class=""></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar4.jpg" class=""></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar5.jpg" class=""></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar6.jpg" class=""></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar7.jpg" class=""></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar8.jpg" class=""></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar9.jpg" class=""></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar10.jpg" class=""></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar11.jpg" class=""></a></li>
                                    <li><a>
                                        <img width="60" height="60" src="<?=config_item('static_url')?>/images/avatar/avatar12.jpg" class=""></a></li>
                                </ul>
                            </div>

                            <script type="text/javascript">
                                function onErrors(t, uid, type)
                                {
                                    var url = '/user/user/getUserHeader?uid='+uid+'&type='+type;
                                    var data = $.ajax(url, '');
                                    alert(data.url);
                                    console.log(data.url);
                                    return;
                                    t.src = url.url;
                                    t.onerror=null;// 控制onerror事件只触发一次
                                }
                            </script>
                            <div class="finishnew" style=" margin:8px;">
                                <ul>
                                    <li style=" height:127px;">
                                        <img src="<?=config_item('static_url')?>user/user/getUserHeader?uid=<?=$uInfo['uid']?>&type=2" alt="<?php echo $uInfo['uname'];?>" width="60" height="60"
                                             />
                                        <span class="blank10w"></span>
                                        <a id="OK" onclick="SaveHead();" name="my_avatar_change_save">
                                            <img border="0" src="<?=config_item('static_url')?>/images/save_avatar.png" style="">
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="clear">
                            </div>

                            <form id="form1" action="/user/_SaveAvatarVT" enctype="multipart/form-data" method="post">
                                <input type="hidden" id="filename" name="filename" value="">
                                <input type="hidden" id="ID" name="ID" value="73238">
                            </form>
                        </div>
                    </div>

                    <div id="upload_header" style="display: none;">
sdasdsadsadasadsadas
                    </div>
                </div>
            </div>

        </div>
    </div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include("/../../footer.php");?>
<SCRIPT type=text/javascript src="/scripts/common.js"></SCRIPT>
<script type="text/javascript">
    function SaveHead(dId)
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
               $(this).attr("src", "/images/avatar1.jpg");
           });
           imgList.click(function () {
               $("[fid=tipsavevt]").text("").hide();
               $(".finishnew img:eq(0)").attr("src", $(this).attr("src")).parent().next("[fid=msgvtnoimage]").hide();
               $("#filename").val($(this).attr("src"));
               imgList.removeClass("selected");
               $(this).addClass("selected");
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
</script>
<!-- #EndLibraryItem -->
</body>
</html>

