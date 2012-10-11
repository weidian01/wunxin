<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $data['title'];?> -- 帮助中心</title>
<link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css" />
<link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css" />
<script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery-1.4.2.min.js"></script>

<!--[if lt IE 7]>
<script type="text/javascript">
EvPNG.fix('div, ul, img, li, input, a, table, td, th, ol, dl, dt, dd, h1, h2, h3, h4, h5, h6, span');
</script>
<![endif]-->
</head>
<body>
<!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include(APPPATH.'views/header.php');?>
<!-- #EndLibraryItem -->
<div class="box3">
  <div class="path2">
    <ul>
      <li><span class="font22">帮助中心</span></li>
      <li class="last">购物流程</li>
    </ul>
  </div>
</div>
<?php include('left.php');?>
  <div class="u-right">
    <div class="help_box">
      <div class="h-title"><?=$data['title'];?></div>
      <div class="h-cont">
        <?=htmlspecialchars_decode($data['content']);?>
     <div class="help-rst">
         这条帮助是否解决了您的问题？<br />
         <input name="helpuseful" type="radio" value="1" checked="checked"/>&nbsp;已解决&nbsp;&nbsp;
         <input name="helpuseful" type="radio" value="0" />&nbsp;未解决<br />
       <a class="huse-tj" href="javascript:void(0);" onclick="submitIsValid(<?=$data['id'];?>)" id="is_valid_id">提交</a>
     </div>
    </div>
  </div>
</div>
<div class="clear"></div>
</div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<script type="text/javascript" src="http://wunxin.com/scripts/artDialog.js"></script>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<script type="text/javascript">
    function submitIsValid(id)
    {
        var type = wx.getRadioCheckBoxValue('helpuseful');
        if (!wx.isEmpty(id)) {
            //alert('参数不全！');
            wx.showPop('参数不全！', 'is_valid_id');
            return;
        }

        var url = '/other/help/is_valid';
        var param = 'id='+id+'&type='+type;
        var data = wx.ajax(url, param);
        wx.showPop('感谢您的参与！', 'is_valid_id');
    }
</script>
<!-- #EndLibraryItem -->
</body>
</html>
