<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $data['title'];?> -- 最近动态</title>
<link href="<?=config_item('static_url')?>css/base.css" rel="stylesheet" type="text/css" />
<link href="<?=config_item('static_url')?>css/user.css" rel="stylesheet" type="text/css" />
<script type=text/javascript src="<?=config_item('static_url')?>scripts/jquery.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/comm.js"></script>
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
      <li><span class="font22">最近动态</span></li>
      <li class="last"><?php echo $data['title'];?></li>
    </ul>
  </div>
</div>
<?php //include('left.php');?>
<div></div>
<div style="width: 980px;margin: 10px auto;">
  <div class="u-rights" style="width: 980px;">
    <div class="help_box" style="padding: 15px 0px 15px 0px;width: 980px;">
      <div class="h-title" style="text-align: center;"><?php echo $data['title'];?></div>
      <div class="h-cont" style="padding: 20px;">
        <?php echo htmlspecialchars_decode($data['content']);?>
          <!--
     <div class="help-rst">
       这条帮助是否解决了您的问题？<br />
       <input name="helpuseful" type="radio" value="" />&nbsp;已解决&nbsp;&nbsp;<input name="helpuseful" type="radio" value="" />&nbsp;未解决<br />
       <a class="huse-tj" href="#">提交</a>
     </div>
     -->
    </div>
  </div>
</div>
</div>
<div class="clear"></div>
<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php include(APPPATH."views/footer.php");?>
<SCRIPT type=text/javascript src="<?=config_item('static_url')?>scripts/common.js"></SCRIPT>
<!-- #EndLibraryItem -->
</body>
</html>
