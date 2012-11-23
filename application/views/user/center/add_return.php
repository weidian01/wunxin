<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>申请退换货 -- 个人中心</title>
    <link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css"/>
    <script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="<?=config_item('static_url')?>scripts/iepng.js"></script>
    <script type="text/javascript">
        EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
    </script>
    <![endif]-->
    <style type="text/css">
        .txi { background: url("<?=config_item('static_url')?>images/onShow.png") no-repeat scroll 5px 5px transparent; color: #999999; display: inline-block; font-size: 12px; height: 22px;
            line-height: 22px; padding-left: 25px; }
        .input_1 { background: url("<?=config_item('static_url')?>images/input_1.png") repeat-x scroll 0 0 #FFFFFF; border: 1px solid #C9C9C9; color: #333333; height: 20px; line-height: 20px; vertical-align: top;width: 200px; }
        .mistake { background: url("<?=config_item('static_url')?>images/onError.png") no-repeat scroll 5px 5px #FFF2E9; color: #E8044F; display: inline-block; font-size: 12px; height: 22px;
            line-height: 22px; padding-left: 25px; }
        tr{ padding: 10px;}
        td{font-size: 12px;font-weight: bold;color: #525252;}
        textarea{margin: 0px; width: 509px; height: 169px;border: 1px solid #C9C9C9;background: url('<?=config_item('static_url')?>images/input_1.png') repeat-x scroll 0 0 #FFFFFF; }
        h3{padding-left: 10px;}
        .s_notice li {padding-left: 30px;font-size: 13px;margin: 10px;}
        .err{font-size: 12px;font-weight:normal;color: #949494;padding-left: 10px;}
        .notice{color: red;}
    </style>
</head>
<body><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<div class="box">
  <div class="path">
    <ul>
      <li><a href="<?=config_item('static_url')?>">首页</a></li>
      <li><a href="<?=config_item('static_url')?>user/center/index">个人中心</a></li>
      <li class="last">申请退换货</li>
    </ul>
  </div>
</div>
<!-- #EndLibraryItem -->
<div class="box3 pad9">
    <?php include ('center_left.php');?>
    <div class="u-right">
        <div class="u-r-box">
            <div class="u-r-tit">申请退换货
                <span style="float:right;text-align: right;">
                    <a style="color: #8B8878;font-size: 12px;" href="<?=config_item('static_url')?>user/center/returns">我的退换货记录&nbsp;&nbsp;</a>
                </span>
            </div>
        </div>
        <div class="u-r-box">
            <br/>
            <a href="<?=productURL($pid)?>" target="_blank" title="">
                <img src="<?=config_item('static_url')?>upload/product/<?=intToPath($pid);?>default.jpg" alt="" width="130" height="156" style="padding-left: 30px;"/>
            </a>
            <br/><br/>
            <span style="padding-left: 5%;"><span style="font-weight: bold;color: #8B8878;">温馨提示:</span> 带红星为必填项，请认真填写。</span>
            <br/><br/>
            <form action="/user/center/saveReturn" method="post" enctype="multipart/form-data" name="return_from" onsubmit="return submitReturn()">
                <input type="hidden" name="order_sn" value="<?=$order_sn?>">
                <input type="hidden" name="pid" value="<?=$pid?>">
            <table width="100%" border="0">
                <tbody>
                <tr>
                    <td align="right"> <label class="notice">*</label>申请类型： </td>
                    <td> <label>
                        <select name="type" id="type_id" style="width: 120px;">
                            <option value="2" selected="selected">换货</option>
                            <option value="1">退货</option>
                        </select>
                    </label> </td>
                </tr>
                <tr><td colspan="2"></td> </tr>
                <tr>
                    <td align="right"> <label class="notice">*</label>原因： </td>
                    <td>
                        <select name="reason" id="reason_id" style="width: 120px;">
                            <option value="1" selected="selected">尺寸不对</option>
                            <option value="2">货品有质量问题</option>
                            <option value="3">其他问题</option>
                        </select>

                    </td>
                </tr>
                <tr><td colspan="2"></td> </tr>
                <tr>
                    <td align="right"> <label class="notice">*</label>描述： </td>
                    <td>
                        <textarea rows="5" cols="45" id="content" name="content"></textarea>
                        <br/><span class="err" style="padding-left: 0px;">描述内容可以填写256字，请认真填写。</span>
                    </td>
                </tr>
                <tr><td colspan="2"></td>
                <tr>
                    <td align="right"><label class="notice">*</label>补充图片1</td>
                    <td>
                        <input type="file" name="problem_one" id="problem_one_id">
                        <span class="err">请上传一张货物整体图。</span>
                    </td>
                </tr>
                <tr>
                    <td align="right"><label class="notice">*</label>补充图片2</td>
                    <td>
                        <input type="file" name="problem_two" id="problem_two_id">
                        <span class="err">请上传一张货物问题的图。</span>
                    </td>
                <tr>
                    <td align="right">
                        &nbsp;
                    </td>
                    <td>
                        <input id="submit" style="width: auto; height: auto; border: 0pt none;" type="image" src="<?=config_item('static_url')?>images/submit.jpg">
                        <h6 id="complain" style="display: none; margin: -23px 0px 0px 255px; ">（您的意见将直接提交到客服经理的邮箱）</h6>
                    </td>
                </tr>
                </tbody>
            </table>
            </form>
            <br/><br/>
            <h3>退换货办理注意事项：</h3>
            <ul class="s_notice">
                <li>1. 订单在配送在途、送达成功状态可办理退换货。特殊商品非质量问题不可退换。</li>
                <li>2. 自商品签收之日起30日内，<a href="http://www.wunxin.com/">万象</a>为您提供退换货服务。</li>
                <li>3. 一张订单可办理一次退换货，为确保您的权益，请考虑周全后办理。</li>
                <li>4. 办理退货或订单金额发生变更的换货时，请将发票随商品一同返还。</li>
                <li>5. 退换货后订单金额小于免运费金额时，需支付订单运费，运费金额将在实际退款中扣除。</li>
            </ul>
            <br/><br/><br/><br/><br/>
            </div>
        </div>
        <div class="pages" style="float: right;">
        <?php //echo $page_html;?>
        </div>
    </div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/user.js"></SCRIPT>
<script type="text/javascript">
    function submitReturn()
    {
        var type = $('#type_id').val();
        var reason = $('#reason_id').val();
        var content = document.getElementById('content').value;
        var problemOne = document.getElementById('problem_one_id').value;
        var problemTwo = document.getElementById('problem_two_id').value;


        if (!wx.isEmpty (type)) {
            alert('请选择申请类型');
            return false;
        }
        if (!wx.isEmpty (reason)) {
            alert('请选择申请原因');
            return false;
        }
        if (!wx.isEmpty (content)) {
            alert('请输入申请描述内容');
            return false;
        }

        if (!wx.isEmpty (problemOne)) {
            alert('请上传补充图片1');
            return false;
        }

        if (!wx.isEmpty (problemTwo)) {
            alert('请上传补充图片2');
            return false;
        }

        document.return_from.submit();
    }
</script>
<!-- #EndLibraryItem -->
</body>
</html>

