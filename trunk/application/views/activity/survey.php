<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我提供的建议与意见 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery-1.4.2.min.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <link href="<?=config_item('static_url')?>css/scrollshow.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        body{font:12px/1.5 Tahoma, Helvetica, Arial, '宋体', sans-serif;}
        body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6,p,th, td ,b,a,textarea{margin:0px;padding:0px;}
        body{font-family:"宋体";}
        img,a{border:none;}
        img{vertical-align:top;}
        li{list-style:none;}
        a{text-decoration:none;}
        h1, h2, h3, h4, h5, h6 {font-size:100%;}
        h1,h2,h3,em,b{font-weight:normal;font-style:normal;}
        .clear{clear:both;display:block;height:0;overflow:hidden;font-size:0;}
        .clearfix:after {content: ".";display:block;height:0;clear:both;visibility:hidden;}
        a:hover{cursor:pointer;}

        .answer_sheet{overflow:hidden;width:932px;margin:10px auto 0;padding:6px 14px 30px;border:1px solid #e0e0e0;}
        .answer_sheet dl{overflow:hidden;width:932px;margin:14px 0;padding-bottom:13px;border-bottom:1px dashed #cdcdcd;color:#444;font-size:12px;}
        .answer_sheet dl dt{font-weight:700;height:24px;line-height:24px;}
        .answer_sheet dl dd{height:24px;padding-left:10px;float:left;}
        .answer_sheet dl.s_6{width:710px;padding-right:220px;overflow:hidden;}
        .answer_sheet dl.s_6 dd{width:106px;}
        .answer_sheet dl.s_6_w dd{width:150px;}
        .answer_sheet dl.s_4 dd{width:210px;*width:215px;}
        .answer_sheet label{float: left;display:block;}
        .answer_sheet dl dd label{margin-top:5px;}
        .answer_sheet input{float:left;margin-top:1px;*margin-top:-2px;margin-top:0 \0;}
        .answer_sheet dl dd input{margin-left:10px;}
        .answer_sheet dl dd.select_f{margin-top:5px;}
        .answer_sheet dl dd.select_f select {float:left;margin-right:5px;font-size:12px;color:#444;}
        .answer_sheet ul{margin-bottom:10px;padding-bottom:13px;border-bottom:1px dashed #cdcdcd;color:#444;}
        .answer_sheet ul li{overflow:hidden;width:932px;margin:6px auto;padding-left:10px;line-height:24px;}
        .answer_sheet ul li label{width:84px;text-align:right;line-height:24px;}
        .answer_sheet ul li label.error{ width:auto;}
        .answer_sheet ul li label.d_iv{width:48px;text-align:center;}
        .answer_sheet ul li em{color:#f00;}
        .answer_sheet ul li p{font-weight:700;}
        .answer_sheet ul input{width:160px;height:20px;margin-top:0px;color:#444;font:400 12px/24px "Arial";border:1px solid #b1b9bf;line-height:20px;}
        .answer_sheet ul li.tel_num_ipt input{margin-right:10px;}
        .answer_sheet ul li input.area_code{width:29px;*width:28px;width:28px \0;}
        .answer_sheet ul li input.phone_num{width:65px;*width:64px;width:64px \0;}
        .answer_sheet ul li input.extension_num{width:42px;*width:41px;width:41px \0;margin-right:0;}
        .answer_sheet .btn_ques{display:block;width:96px;height:31px;margin-left:94px;color:#fff;background:url("/images/bg-i_03.gif") no-repeat;line-height:31px;text-align:center; border:0;font-size: 18px;font-weight: bold;}

    </style>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<div class="answer_sheet">
<h2 style="font-weight:bold; font-size:14px;">首页改版问卷调研</h2>

<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<form action="/ques/Index/subAnswerForm.html" method="post" enctype="multipart/form-data" id="questionnaire"
      novalidate="novalidate">
<input type="hidden" name="qid" value="2">
<input type="hidden" name="_count" value="13">
<input type="hidden" name="current_url" value="/ques/Index/questionnaire/qid/2">
<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">1.您在访问万象网首页的过程中，总体满意度如何？（单选）<span style="font-weight: 100;" id="answer_31"></span>
        </th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_31" name="answer[31]" value="很不满意">
                很不满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_31" name="answer[31]" value="不太满意">
                不太满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_31" name="answer[31]" value="一般">
                一般
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_31" name="answer[31]" value="比较满意">
                比较满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_31" name="answer[31]" value="非常满意">
                非常满意
            </div>
        </td>
    </tr>
    </tbody>
</table>


<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">2.您对万象网首页的视觉风格是否满意？（单选）<span style="font-weight: 100;" id="answer_32"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_32" name="answer[32]" value="很不满意">
                很不满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_32" name="answer[32]" value="不太满意">
                不太满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_32" name="answer[32]" value="一般">
                一般
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_32" name="answer[32]" value="比较满意">
                比较满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_32" name="answer[32]" value="非常满意">
                非常满意
            </div>
        </td>
    </tr>
    </tbody>
</table>


<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">3.您对万象网首页的长度感觉怎样？（单选）<span style="font-weight: 100;" id="answer_33"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_33" name="answer[33]" value="太长">
                太长
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_33" name="answer[33]" value="刚好">
                刚好
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_33" name="answer[33]" value="稍短">
                稍短
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_33" name="answer[33]" value="不关心">
                不关心
            </div>
        </td>
    </tr>
    </tbody>
</table>


<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">4.您打开万象网首页的速度满意度如何？（单选）<span style="font-weight: 100;" id="answer_34"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_34" name="answer[34]" value="很不满意">
                很不满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_34" name="answer[34]" value="不太满意">
                不太满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_34" name="answer[34]" value="一般">
                一般
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_34" name="answer[34]" value="比较满意">
                比较满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_34" name="answer[34]" value="非常满意">
                非常满意
            </div>
        </td>
    </tr>
    </tbody>
</table>


<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="3" align="left">5.您在万象网一般购买哪些商品？（多选）<span style="font-weight: 100;" id="answer_35"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="机票、酒店、充值、缴费">
                机票、酒店、充值、缴费
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="手机、数码">
                手机、数码
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="电脑、办公">
                电脑、办公
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="生活电器">
                生活电器
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="家用电器">
                家用电器
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="厨卫电器">
                厨卫电器
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="家居生活">
                家居生活
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="酒水产品">
                酒水产品
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="美妆个护">
                美妆个护
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="服饰鞋帽">
                服饰鞋帽
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="运动户外">
                运动户外
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="汽车用品">
                汽车用品
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="皮具箱包">
                皮具箱包
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="钟表首饰">
                钟表首饰
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="母婴用品">
                母婴用品
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="玩具乐器">
                玩具乐器
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="图书">
                图书
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_35" name="answer[35][]" value="其他">
                其他<span><input style="float:none;display:none;margin-left:10px" type="text" id="cqita_35"
                               name="cqita_35" size="40"><span id="casf_35" style="display:none">还可以输入<input
                style="float:none;width:13px;border:0" type="text" id="ctxtCount_35" size="1" value="70">字</span></span>
            </div>
        </td>
    </tr>
    </tbody>
</table>

<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="2" align="left">6.您对万象网首页现有促销板块比较喜欢的有哪些？（多选）<span style="font-weight: 100;" id="answer_36"></span>
        </th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_36" name="answer[36][]" value="热销">
                热销
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_36" name="answer[36][]" value="新品">
                新品
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_36" name="answer[36][]" value="流行时尚">
                流行时尚
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_36" name="answer[36][]" value="超值日用">
                超值日用
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_36" name="answer[36][]" value="独家首发">
                独家首发
            </div>
        </td>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_36" name="answer[36][]" value="限时抢购">
                限时抢购
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_36" name="answer[36][]" value="热门团购">
                热门团购
            </div>
        </td>
    </tr>
    </tbody>
</table>

<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th align="left">7.您还希望万象网增加什么功能或内容？（必答问答）<span style="font-weight: 100;" id="answer_41"></span>
        </th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <textarea rows="5" id="in_41" cols="88" name="answer[41]"></textarea>
            </div>
        </td>
    </tr>
    </tbody>
</table>
<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">8.您访问万象网首页的频率是？（单选）<span style="font-weight: 100;" id="answer_37"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_37" name="answer[37]" value="每天一次以上"> 每天一次以上
            </div>
        </td>
    </tr>
    <tr>
        <td> <div style="margin:0 20px 5px 15px;"> <input type="radio" id="in_37" name="answer[37]" value="每周3~4次"> 每周3~4次 </div> </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_37" name="answer[37]" value="每周2次">
                每周2次
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_37" name="answer[37]" value="每周1次">
                每周1次
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_37" name="answer[37]" value="两周1次">
                两周1次
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_37" name="answer[37]" value="一月1次或者更少">
                一月1次或者更少
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_37" name="answer[37]" value="第一次进入苏宁易购首页">
                第一次进入万象网首页
            </div>
        </td>
    </tr>
    </tbody>
</table>


<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">9.您访问频率最多的购物网站是？（多选）<span style="font-weight: 100;" id="answer_38"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_38" name="answer[38][]" value="淘宝">
                淘宝
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_38" name="answer[38][]" value="京东">
                京东
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_38" name="answer[38][]" value="天猫">
                天猫
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_38" name="answer[38][]" value="苏宁易购">
                苏宁易购
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_38" name="answer[38][]" value="亚马逊">
                亚马逊
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_38" name="answer[38][]" value="当当">
                当当
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_38" name="answer[38][]" value="易讯">
                易讯
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_38" name="answer[38][]" value="1号店">
                1号店
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="checkbox" id="in_38" name="answer[38][]" value="其他">
                其他<span><input style="float:none;display:none;margin-left:10px" type="text" id="cqita_38"
                               name="cqita_38" size="40"><span id="casf_38" style="display:none">还可以输入<input
                style="float:none;width:13px;border:0" type="text" id="ctxtCount_38" size="1" value="70">字</span></span>
            </div>
        </td>
    </tr>
    </tbody>
</table>

<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">10.您性别？（单选）<span style="font-weight: 100;" id="answer_43"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_43" name="answer[43]" value="男">
                男
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_43" name="answer[43]" value="女">
                女
            </div>
        </td>
    </tr>
    </tbody>
</table>


<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">11.您的年龄段为？（单选）<span style="font-weight: 100;" id="answer_39"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_39" name="answer[39]" value="18岁以下">
                18岁以下
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_39" name="answer[39]" value="18-24岁">
                18-24岁
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_39" name="answer[39]" value="25-30岁">
                25-30岁
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_39" name="answer[39]" value="31-35岁">
                31-35岁
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_39" name="answer[39]" value="36-40岁">
                36-40岁
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_39" name="answer[39]" value="40岁以上">
                40岁以上
            </div>
        </td>
    </tr>
    </tbody>
</table>


<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">12.您的月收入范围为？（单选）<span style="font-weight: 100;" id="answer_40"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_40" name="answer[40]" value="2500以下">
                2500以下
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_40" name="answer[40]" value="2500~5000">
                2500~5000
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_40" name="answer[40]" value="5000~8000">
                5000~8000
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="in_40" name="answer[40]" value="8000以上">
                8000以上
            </div>
        </td>
    </tr>
    </tbody>
</table>


<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th align="left">13.您愿意留下您的联系方式吗，以便我们诚邀你参加用户体验相关活动？ （可选问答）</th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <textarea rows="5" id="in_42" cols="88" name="answer[42]"></textarea>
            </div>
        </td>
    </tr>
    </tbody>
</table>
<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<ul>
    <li>
        <p>为了方便与您联系，请填写好下列信息，标<em> * </em>为必填项，请您放心填写，我们一定会保护好您的个人隐私。</p>
    </li>
    <li>
        <label><em>* </em>姓&nbsp;&nbsp;&nbsp;名：</label>
        <input type="text" name="name" id="name">
        <span id="name_span"></span></li>
    <li>
        <label><em>* </em>手&nbsp;&nbsp;&nbsp;机：</label>
        <input type="text" name="mobile" id="mobile">
    </li>
    <li class="tel_num_ipt">
        <div style="width:84px;height:24px;float:left">
            <label>座&nbsp;&nbsp;&nbsp;机：</label>
        </div>
        <div class="tel_num_ipt_all" style="position:relative;float:left">
            <label for="area_code" style="width:24px;display:block;position:absolute;left:5px;cursor:text;">区号</label>
            <input class="area_code" name="area_code" id="area_code" type="text" maxlength="4">
        </div>
        <div class="tel_num_ipt_all" style="position:relative;float:left">
            <label for="phone_num" style="width:24px;display:block;position:absolute;left:5px;cursor:text;">号码</label>
            <input class="phone_num" name="phone_num" id="phone_num" type="text" maxlength="8">
        </div>
        <div class="tel_num_ipt_all" style="position:relative;float:left">
            <label for="extension_num"
                   style="width:40px;height:24px;display:block;position:absolute;left:0px;cursor:text;">分机号</label>
            <input class="extension_num" name="extension_num" id="extension_num" type="text" maxlength="6">
        </div>
        <span id="tel_span">（分机号可不填）</span></li>
    <li>
        <label>E-mail：</label>
        <input type="text" name="email" id="email">
        <span id="email_span"></span></li>
    <li>
        <label>QQ：</label>
        <input type="text" name="qq" id="qq">
        <span id="qq_span"></span></li>
    <li>
        <label>微博链接：</label>
        <input type="text" name="weibo" id="weibo">
        <span id="weibo_span"></span></li>
    <li>
        <label>MSN：</label>
        <input type="text" name="msn">
    </li>
    <li>
        <label>其他联系方式：</label>
        <input type="text" name="othertel">
    </li>
</ul>
<input type="submit" class="btn_ques" value="提交">
<input type="hidden" name="__hash__" value="63232f8677af3123b73180556fe59609_3f015e5c2874ca8c31c01a05845dc06e"></form>
</div>
<?php include(APPPATH."views/footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<script type="text/javascript">
</script>
<!-- #EndLibraryItem -->
</body>
</html>