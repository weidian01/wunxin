<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我提供的建议与意见 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
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
        .answer_sheet .btn_ques{display:block;width:96px;height:31px;margin-left:94px;color:#fff;background:url("<?=config_item('static_url')?>images/bg-i_03.gif") no-repeat;line-height:31px;text-align:center; border:0;font-size: 18px;font-weight: bold;}

    </style>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<div class="answer_sheet">
<h2 style="font-weight:bold; font-size:14px;">万象网问卷调研</h2>

<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>

<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">1.您在访问万象网首页的过程中，总体满意度如何？（单选）<span style="font-weight: 100;" id="answer_31"></span>
        </th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_1_1" name="answer1" onclick="reportAnswer(1, 1)"> 很不满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;"><input type="radio" id="binding_id_1_2" name="answer1" onclick="reportAnswer(1, 2)"> 不太满意</div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;"><input type="radio" id="binding_id_1_3" name="answer1" onclick="reportAnswer(1, 3)">一般</div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;"><input type="radio" id="binding_id_1_4" name="answer1" onclick="reportAnswer(1, 4)"> 比较满意</div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_1_5" name="answer1" onclick="reportAnswer(1, 5)">
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
                <input type="radio" id="binding_id_2_1" name="answer2" onclick="reportAnswer(2, 1)">
                很不满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_2_2" name="answer2" onclick="reportAnswer(2, 2)">
                不太满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_2_3" name="answer2" onclick="reportAnswer(2, 3)">
                一般
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_2_4" name="answer2" onclick="reportAnswer(2, 4)">
                比较满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_2_5" name="answer2" onclick="reportAnswer(2, 5)">
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
                <input type="radio" id="binding_id_3_1" name="answer3" onclick="reportAnswer(3, 1)">
                太长
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_3_2" name="answer3" onclick="reportAnswer(3, 2)">
                刚好
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_3_3" name="answer3" onclick="reportAnswer(3, 3)">
                稍短
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_3_4" name="answer3" onclick="reportAnswer(3, 4)">
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
                <input type="radio" id="binding_id_4_1" name="answer4" onclick="reportAnswer(4, 1)">
                很不满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_4_2" name="answer4" onclick="reportAnswer(4, 2)">
                不太满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_4_3" name="answer4" onclick="reportAnswer(4, 3)">
                一般
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_4_4" name="answer4" onclick="reportAnswer(4, 4)">
                比较满意
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_4_5" name="answer4" onclick="reportAnswer(4, 5)">
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
        <th colspan="1" align="left">5.您性别？（单选）<span style="font-weight: 100;" id="answer_43"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_5_1" name="answer5" onclick="reportAnswer(5, 1)">
                男
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_5_2" name="answer5" onclick="reportAnswer(5, 2)">
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
        <th colspan="1" align="left">6.您的年龄段为？（单选）<span style="font-weight: 100;" id="answer_39"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_6_1" name="answer6" onclick="reportAnswer(6, 1)">
                18岁以下
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_6_2" name="answer6" onclick="reportAnswer(6, 2)">
                18-24岁
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_6_3" name="answer6" onclick="reportAnswer(6, 3)">
                25-30岁
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_6_4" name="answer6" onclick="reportAnswer(6, 4)">
                31-35岁
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_6_5" name="answer6" onclick="reportAnswer(6, 5)">
                36-40岁
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_6_6" name="answer6" onclick="reportAnswer(6, 6)">
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
        <th colspan="1" align="left">7.您的月收入范围为？（单选）<span style="font-weight: 100;"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_7_1" name="answer7" onclick="reportAnswer(7, 1)">
                2500以下
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_7_2" name="answer7" onclick="reportAnswer(7, 2)">
                2500~5000
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_7_3" name="answer7" onclick="reportAnswer(7, 3)">
                5000~8000
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_7_4" name="answer7" onclick="reportAnswer(7, 4)">
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
        <th colspan="1" align="left">8.您对万象网购物可以接受的配送时限最长是多少？（单选）<span style="font-weight: 100;"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_8_1" name="answer8" onclick="reportAnswer(8, 1)">
                一天以内
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_8_2" name="answer8" onclick="reportAnswer(8, 2)">
                1~2天
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_8_3" name="answer8" onclick="reportAnswer(8, 3)">
                3~5天
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_8_4" name="answer8" onclick="reportAnswer(8, 4)">
                6~7天
            </div>
        </td>
    </tr>
    </tbody>
</table>

<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">9.万象网最初吸引您的地方是什么？（单选）<span style="font-weight: 100;"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_9_1" name="answer9" onclick="reportAnswer(9, 1)">
                商品价格实惠
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_9_2" name="answer9" onclick="reportAnswer(9, 2)">
                商品新颖，个性化强
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_9_3" name="answer9" onclick="reportAnswer(9, 3)">
                商品质量好
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_9_4" name="answer9" onclick="reportAnswer(9, 4)">
                免运费
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_9_5" name="answer9" onclick="reportAnswer(9, 5)">
                售后服务好
            </div>
        </td>
    </tr>
    </tbody>
</table>

<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">10.您认为万象网站的结算操作简便性如何？（单选）<span style="font-weight: 100;"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_10_1" name="answer10" onclick="reportAnswer(10, 1)">
                操作较繁琐
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_10_2" name="answer10" onclick="reportAnswer(10, 2)">
                还可以
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_10_3" name="answer10" onclick="reportAnswer(10, 3)">
                操作很方便
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_10_4" name="answer10" onclick="reportAnswer(10, 4)">
                没什么感觉
            </div>
        </td>
    </tr>
    </tbody>
</table>

<div style="border-bottom:1px dashed #CDCDCD; margin:14px 0;"></div>
<table border="0">
    <tbody>
    <tr>
        <th colspan="1" align="left">11.您对万象网的咨询互动性的看法？（单选）<span style="font-weight: 100;"></span></th>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_11_1" name="answer11" value="2500以下" onclick="reportAnswer(11, 1)">
                现在的状况就很好
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_11_2" name="answer11" value="2500~5000" onclick="reportAnswer(11, 2)">
                信息延迟，很费时间，最好能改进
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div style="margin:0 20px 5px 15px;">
                <input type="radio" id="binding_id_11_3" name="answer11" value="5000~8000" onclick="reportAnswer(11, 3)">
                没什么感觉
            </div>
        </td>
    </tr>
    </tbody>
</table>

<input type="button" class="btn_ques" value="提交" id="submit_id" onclick="submits()">
</div>
<br/>
<?php include(APPPATH."views/footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<script type="text/javascript" charset=utf-8 src="<?=config_item('static_url')?>scripts/artdialog.js"></script>
<script type="text/javascript">
    function submits()
    {
        wx.showPop('感谢您的参与！', 'submit_id');
    }
    function reportAnswer(id, answerId)
    {
        console.log(id,answerId);
        if (!wx.isEmpty(id) || !wx.isEmpty(answerId)) {
            //wx.showPop('参数为空');
            return ;
        }
        var url = 'activity/activity/reportAnswer';
        var param = 'id='+id+'&report_id='+answerId;
        var data = wx.ajax(url, param);

        var msg = '';
        switch (data.error) {
            case '0': msg = '感谢您的参与！'; break;
            case '70013': msg = '参数不全！'; break;
            case '70014': msg = '问题不存在！'; break;
        }

console.log('binding_id_'+id+'_'+answerId);
        //wx.showPop(msg, 'binding_id_'+id+'_'+answerId, 1);
    }
</script>
<!-- #EndLibraryItem -->
</body>
</html>