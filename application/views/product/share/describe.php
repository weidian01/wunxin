<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>为晒单照片添加描述</title>
<link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css" />
<!--<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/comm.js"></SCRIPT>-->
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/artdialog.js"></SCRIPT>
    <SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/product.js"></SCRIPT>
<!--[if lt IE 7]>
<script type="text/javascript" src="<?=config_item('static_url')?>js/iepng.js"></script>
<script type="text/javascript">
EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
</script>
<![endif]-->
<script type="text/javascript">
$(document).ready(function(){
  $(".bankpic").click(function(){
    $(".bankpic").css("border","1px solid #eee");
	$(this).css("border","1px solid #a10000");
  });
});
</script>
    <style type="text/css">
        html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, dd, dl, dt, li, ol, ul, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {padding: 0;}
        .bor, .tbor, .bbor, .lbor, .rbor, .bor2, .tbor2, .bbor2, .lbor2, .rbor2, .bgr, .bgr2, .bgr3, .bor3, .lbor3, .rbor3, .bbor3, .tbor3, .bor4, .lbor4, .rbor4, .bbor4, .tbor4, .bor5, .lbor5, .rbor5, .bbor5, .tbor5 {border-width: 1px;}
        .bg_mode { margin-bottom: 6px; }
        .bg_mode, .mode_gb { word-wrap: break-word; }
        .bor, .tbor, .bbor, .lbor, .rbor, .bgr { border-color: #D6D6D6; }
        .bor, .bgr, .bgr2, .bgr3, .bor2, .bor3, .bor4, .bor5 { border-style: solid; }
        .bg_mode .mode_gb, .mode_menu_tag .menuon, .mode_menu_tag .menulefton, .mode_menu_tag2 .nowtag a, .mode_tab2_nonce { background-color: #FFFFFF; }
        .bg_mode .style_mode_gb_title { background-color: transparent; }
        .bg_mode .style_mode_gb_title .bg_mode_gb_title { background-color: #F0F0F0; }
        .mode_gb .mode_gb_title .bg_mode_gb_title { height: 34px; line-height: 34px; padding: 0; }
        .bor3, .bgr3, .tbor3, .bbor3, .lbor3, .rbor3 { border-color: #E6E6E6; }
        .bg_mode_gb_title .navs { float: left; padding-left: 10px; width: 450px; }
        .symbol { padding: 0 5px; position: relative; top: -1px; }
        .unline, .unline:link, .unline:visited { text-decoration: underline !important; }
        a { text-decoration: none; }
        a, .c_tx { color: #26709A; }
        .mode_gb .mode_gb_title .bg_mode_gb_title a { padding-left: 5px; }
        .mode_gb .mode_gb_cont { clear: both; padding: 5px; }
        .photo { padding: 0 3px; }
        .photo_editinfo .wrap { margin: 8px auto 0; width: 647px; }
        .photo_editinfo .mod_pe_post2blog { height: 70px; margin-bottom: 10px; padding-top: 20px; width: 647px; }
        .bg3, .bgr3, .bg3_hover:hover { background-color: #F6F6F6; }
        .photo_editinfo .mod_pe_post2blog p { font-size: 14px; margin-bottom: 10px; text-align: center; }
        .c_tx4 { color: #FE6600 !important; }
        .photo_editinfo .mod_pe_post2blog p { font-size: 14px; margin-bottom: 10px; text-align: center; }
        button, label { cursor: pointer; }
        body, input, textarea, button, select { font-family: 'Helvetica Neue','Helvetica Neue',Helvetica,'Hiragino Sans GB','Microsoft Yahei',Arial; }
        .gb_bt, .bt_tx1, .bt_tx2, .bt_tx4, .bt_tx5, .bt_tx6, .bt_tx7 { background-color: #96A3B0;background-image: -moz-linear-gradient(center top , #96A3B0 0px, #96A3B0 5%, #7C8C9C 5%, #7C8C9C 100%);background-position: 0 0 !important; border: 1px solid #667789; color: #FFFFFF; }
        .photo_editinfo .mod_pe_post2blog .gb_bt { font-size: 14px; font-weight: bold; height: 25px; width: 100px; }
        .bg3, .bgr3, .bg3_hover:hover { background-color: #F6F6F6; }
        .photo_editinfo .mod_pe_post2blog_v2 p { font-size: 14px; text-align: center; }
        .photo_editinfo .mod_pe_post2blog_v2_list { margin: 10px auto 0; overflow: hidden; width: 336px; }
        .photo_editinfo .mod_pe_post2blog_v2_list:after {clear: both;content: "";display: block;height: 0;}
        ul, ul li {list-style-type: none;}
        .photo_editinfo .mod_pe_post2blog_v2_list ul {width: 105%;}
        .bg, .bgr, .bg_hover:hover, .bg_deep_dom { background-color: #FFFFFF; }
        .photo_editinfo .mod_pe_post2blog_v2_list li {border-width: 1px;cursor: pointer;float: left;margin-right: 15px;width: 100px;}
        p, dl, multicol {display: block;}
        .photo_editinfo .mod_pe_post2blog_v2_img {height: 113px;line-height: 0;margin: 0 auto 5px;overflow: hidden;padding-top: 5px;position: relative;width: 90px;}
        fieldset, img { border: 0 none; }
        .photo_editinfo .mod_pe_post2blog_v2_preview { background: none repeat scroll 0 0 #000000; bottom: 0; font-size: 12px; height: 23px; left: 0; line-height: 23px; position: absolute; text-align: center; width: 90px; }
        .photo_editinfo .mod_pe_post2blog_v2_preview a { color: #FFFFFF; text-decoration: none; }
        .photo_editinfo .mod_pe_post2blog_v2_desc { margin: 0 auto 5px; width: 90px; }
        article, aside, div, dt, figcaption, footer, form, header, hgroup, html, map, nav, section { display: block; }
        .photo_editinfo .mod_pe_main { margin-top: 20px; }
        .photo_editinfo .mod_pe_main .hds { border-width: 0 0 1px; padding-bottom: 10px; }
        .photo_editinfo .mod_pe_main .hds:after { clear: both; content: ""; display: block; height: 0; }
        .photo_editinfo .mod_pe_main .hds h4 { float: left;font-size: 14px;}
        .photo_editinfo .mod_pe_main .hds .op {float: right;text-align: right;}
        .bt_tx2 {background-position: 0 -124px;width: 48px;}
        .photo_editinfo .mod_pe_main .hds .op button {margin-right: 3px;}
        #app_mod .bt_tx1, #app_mod .bt_tx2, #app_mod .bt_tx4, #app_mod .bt_tx5, #app_mod .bt_tx6, #app_mod .bt_tx7 {background-color: transparent;height: 19px;text-align: center;}
        .photo_editinfo .mod_panel {margin: 12px 0;}
        .photo_editinfo .mod_panel_editall { border-width: 0 0 1px; padding-bottom: 8px; }
        .photo_editinfo .mod_panel .hds {border: 0 none;margin-bottom: 8px;padding-bottom: 0;}
        .photo_editinfo .mod_panel .hds h5 {font-size: 12px;font-weight: bold;}
        .photo_editinfo .mod_panel .inner {padding-left: 48px;}
        .photo_editinfo .mod_panel .inner:after { clear: both;content: "";display: block;height: 0;}
        .photo_editinfo .mod_panel .inner .cont {display: table-cell;margin-bottom: 10px; }
        .photo_editinfo .mod_panel .inner .cont p {margin-bottom: 4px;padding: 0 0 0 36px; position: relative;z-index: 98;}
        .photo_editinfo .mod_panel .inner .cont p:after {clear: both;content: "";display: block;height: 0;}
        .photo_editinfo .mod_panel .inner .cont label {display: block;left: 0;position: absolute;top: 3px; width: 36px;}
        body, input, textarea, button, select { font-size: 12px; }
        .textinput, .textarea { background-color: #FFFFFF; }
        .c_tx3 { color: #A8A8A8; }
        .photo .text-input, .photo .textinput { border-style: solid; border-width: 1px; outline: medium none; }
        .photo_editinfo .mod_panel_editall .cont input, .photo_editinfo .mod_panel_editall .cont textarea {max-width: 489px;width: 489px;}
        .photo_editinfo .mod_panel .inner .textinput {margin: 1px;}
        .photo_editinfo .mod_panel .inner .cont input, .photo_editinfo .mod_panel .inner .cont textarea { padding: 0 5px; }
        .photo_editinfo .mod_panel .inner .cont input { height: 20px; line-height: 20px; overflow: hidden; }
        .photo_editinfo .mod_panel .inner .cont .num { position: absolute; right: -70px; text-align: left; top: 3px; width: 65px; }
        .photo_editinfo .mod_panel .inner .cont .num span { font-weight: bold; }
        .photo_editinfo .mod_panel .inner .cont textarea { height: 55px; }
        .photo_editinfo .mod_panel .inner .cont textarea { overflow: auto; padding: 5px; }
        .photo_editinfo .mod_panel .inner .cont p { margin-bottom: 4px; padding: 0 0 0 36px; position: relative; z-index: 98; }
        .photo_editinfo .mod_panel .inner .cont input { font-family: 'Helvetica Neue','Helvetica Neue',Helvetica,'Hiragino Sans GB','Microsoft Yahei',Arial; }
        .photo_editinfo .mod_panel { margin: 12px 0; }
        .photo_editinfo .mod_panel .hds { border: 0 none; margin-bottom: 8px; padding-bottom: 0; }
        .photo_editinfo .mod_panel_editsingle li { margin-bottom: 20px; }
        .photo_editinfo .mod_panel .inner .img { float: left; margin-right: 18px; padding-top: 2px; }
        .photo_editinfo .mod_panel .inner .img p.main {display: table-cell;font-size: 0; height: 100px;line-height: 0;margin: 0;overflow: hidden;text-align: center;vertical-align: middle;width: 100px;}
        .photo_editinfo .mod_panel .inner .img p.main img {vertical-align: middle;}
        .photo_editinfo_op {margin-top: 5px;}
        .photo_editinfo_op:after { clear: both; content: ""; display: block; height: 0;}
        .photo_editinfo_op .l {float: left; height: 24px;line-height: 24px;}
        .photo_editinfo .mod_panel .inner .img p { margin-top: 5px;text-align: center;}
        body, input, textarea, button, select { font-family: 'Helvetica Neue','Helvetica Neue',Helvetica,'Hiragino Sans GB','Microsoft Yahei',Arial; font-size: 12px; }
        button, label { border: 0 none;cursor: pointer;}
        .photo_editinfo_op .r { float: right;height: 24px;line-height: 24px;}
        .photo_editinfo .mod_panel_editsingle .cont input, .photo_editinfo .mod_panel_editsingle .cont textarea {max-width: 369px;width: 369px;}
        .photo_editinfo .mod_panel_editsingle_desc { margin: 6px 0;min-height: 15px;position: relative;}
        .photo_editinfo .mod_panel_editsingle_desc .mod_panel_editsingle_desc_int { margin-left: 36px;}
        .photo_editinfo .mod_panel_editsingle_desc .mod_panel_editsingle_desc_int .textinput { line-height: 100%;min-height: 14px; padding: 5px 5px 2px; width: 368px;}
        .photo_editinfo .mod_panel_editsingle_desc .mod_panel_editsingle_desc_int .textinput {display: inline-block;margin: 1px;}
        .photo_editinfo .mod_panel_editsingle_desc .mod_panel_editsingle_desc_int .mod_at_wrap {width: 382px;}
        .mod_at_wrap { height: auto; margin: 0; overflow: hidden;padding: 0;position: absolute;z-index: 1000;}
        .bor2, .bgr2, .tbor2, .bbor2, .lbor2, .rbor2 {border-color: #E1E1E1;}
        .mod_at {position: relative;}
        .mod_at .mod_at_tips {height: 25px;line-height: 25px;margin: 0;padding: 4px 6px;}
        .photo_editinfo .mod_panel_editsingle .page_nav {border-width: 1px 0 0;padding-top: 10px;}
        .photo .page_nav {margin: 0 0 2px;overflow: hidden;}
        .photo_editinfo .mod_panel_editsingle .option { border-width: 1px 0 0;padding-top: 15px;}
        .photo_editinfo .mod_panel .option {margin-bottom: 12px;text-align: right;}
        #app_mod .bt_tx1, #app_mod .bt_tx2, #app_mod .bt_tx4, #app_mod .bt_tx5, #app_mod .bt_tx6, #app_mod .bt_tx7 {padding-bottom: 2px;}
        #app_mod .bt_tx1, #app_mod .bt_tx2, #app_mod .bt_tx4, #app_mod .bt_tx5, #app_mod .bt_tx6, #app_mod .bt_tx7 {background-color: transparent;height: 19px;text-align: center;}
        .photo_editinfo .mod_panel .option button {margin-right: 3px;}
        .gb_bt, .bt_tx1, .bt_tx2, .bt_tx4, .bt_tx5, .bt_tx6, .bt_tx7 {background-image: -moz-linear-gradient(center top , #96A3B0 0px, #96A3B0 5%, #7C8C9C 5%, #7C8C9C 100%);background-position: 0 0 !important;border: 1px solid #667789;color: #FFFFFF;}
        .bt_tx2 {background-position: 0 -124px;width: 48px;}
        .photo_editinfo .mod_panel .option a {margin-left: 3px;}
        .photo_editinfo .mod_panel_editsingle .option {border-width: 1px 0 0;padding-top: 15px;}
        .photo_editinfo .mod_panel .option {margin-bottom: 12px;text-align: right;}
        #app_mod .bt_tx1, #app_mod .bt_tx2, #app_mod .bt_tx4, #app_mod .bt_tx5, #app_mod .bt_tx6, #app_mod .bt_tx7 { padding-bottom: 2px; }
        .bt_tx2 { background-position: 0 -124px; }
    </style>
</head>
<body>
<?php include APPPATH.'views/header.php';?>

<div class="box2">
    <div class="container">
<div class="bg_mode" style="width: 980px;">
	<div class="box_ml bor">
		<div style="zoom:1;" class="mode_gb">
			<div style="height:auto" class="mode_gb_title style_mode_gb_title">
				<div class="bg_mode_gb_title">
					<div class="mod_clear bor3 header"> <p class="navs"><h3>&nbsp;&nbsp;为晒单照片添加描述</h3> </p> </div>
				</div>
			</div>
			<div class="mode_gb_cont">
				<!-- 相册 开始 -->
				<div class="photo" id="app_mod">
					<div class="photo_editinfo">
						<div class="wrap">
							<div style="border:1px solid #eee;" id="" class="bg3 mod_pe_post2blog_v2 qzone-display">
								<p>您已成功上传<span id="photo_num2" class="c_tx4">&nbsp; <?=count($s_img);?> &nbsp;</span>张晒单照片，把它们的购物经历讲出来和好友一起分享吧。</p>
								<div class="mod_pe_post2blog_v2_list qzone-display">
									<ul>
                                        <?php foreach ($s_img as $v) {?>
										<li id="paper1" class="bg bor">
											<p class="mod_pe_post2blog_v2_img">
												<img alt="" style="" src="<?=config_item('static_url').'upload/product_share/'.str_replace('\\', '/', $v['img_addr']);?>">
											</p>
										</li>
                                        <?php }?>
									</ul>
								</div>
							</div>

							<div style="padding-bottom:60px;" class="mod_pe_main">
								<div class="bor3 hds"> <h4>您可以为照片添加信息</h4> </div>
								<div class="bds">
									<div class="mod_panel mod_panel_editsingle">
										<div class="hds"> <h5>为每张照片添加信息</h5> </div>
                                        <form action="/product/share/saveShareDescribe" method="post" name="share_image_form">
										<div class="bds">
											<ul id="edit_photo_list_ul">
                                                <input type="hidden" name="number" value="<?=count($s_img);?>" id="share_image_number">
                                                <?php $i = 1;foreach ($s_img as $v) {?>
                                                <input type="hidden" name="s_img_<?=$i;?>" value="<?=$v['id'];?>">
                                                <li>
                                                    <div class="inner">
                                                        <div class="img">
                                                            <p class="bor3 main">
                                                                <img alt="" src="<?=config_item('static_url').'upload/product_share/'.str_replace('\\', '/', $v['img_addr']);?>" style="width: 99px; height: 74px;">
                                                            </p>
                                                            <div class="photo_editinfo_op"> <p class="l">
                                                                <input type="radio" name="PhotoCover" <?=($v['is_cover'] == '1') ? 'checked="checked"' : '';?> value="<?=$v['id'];?>"/>
                                                                <label >封面</label> </p> </div>
                                                        </div>
                                                        <div class="cont">
                                                            <p>
                                                                <label >名称：</label>
                                                                <input type="text" maxlength="30" class="bor textinput c_tx3" name="photo_name_<?=$i;?>" id="photo_name_<?=$i;?>" value="<?=empty ($v['title']) ? '' : $v['title'];?>">
                                                                <span style="display:none" class="num"><strong>0</strong>/30</span>
                                                            </p>
                                                            <div class="mod_panel_editsingle_desc" style="z-index: 101;">
                                                                <label >描述：</label>
                                                                <div class="mod_panel_editsingle_desc_int c_tx3" name="photo_desc">
                                                                    <textarea class="bor textinput c_tx3" name="photo_desc_<?=$i;?>" id="photo_desc_<?=$i;?>"><?=empty ($v['descr']) ? '' : $v['descr'];?></textarea>
                                                                    <span style="display:none" class="num"><span class="c_tx">130</span>/200</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php $i++;}?>
                                            </ul>
											<div style="display:none;" id="page_turner" class="bor3 page_nav"> </div>
											<p class="bor3 option qzone-display"> <img src="<?=config_item('static_url')?>images/scBTN.jpg" alt="保存" title="保存" onclick="checkShareImage()"> </p>
										</div>
                                        </form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- 相册 结束 -->
			</div>
		</div>
	</div>
</div>
</div>
</div>

<?php include APPPATH.'views/footer.php';?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<script type="text/javascript">
    function checkShareImage()
    {
        var siNum = document.getElementById('share_image_number').value;
        var title = '';
        var content = '';
//alert(siNum);
        if ( !wx.isEmpty(siNum) ) {
            siNum = 1;
        }

        var PhotoCover = wx.getRadioCheckBoxValue('PhotoCover');
        if ( !PhotoCover ) {
            wx.showPop('请选择封面');
            return false;
        }

        for (var i = 1; i <= siNum; i++) {
            title = document.getElementById('photo_name_'+i).value;
            content = document.getElementById('photo_desc_'+i).value;

            if ( !wx.isEmpty(title) || !wx.isEmpty(content)) {
                wx.showPop('内容或标题为空');
                return false;
            }
        }

        document.share_image_form.submit();
    }
</script>
</body>
</html>