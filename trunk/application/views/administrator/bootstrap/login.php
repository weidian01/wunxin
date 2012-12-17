<?php require(APPPATH . 'views/administrator/bootstrap/header.php');?>
<div class="container">
    <div class="page-header">
        <h3>万象电子商务系统</h3>
      </div>
    <form class="form-inline" action="<?=url('admin')?>administrator/admin_login/login" method="post">
    <i class="icon-user"></i> <input name="username" type="text" class="input-small" placeholder="用户名">
    <input name="password" type="password" class="input-small" placeholder="密码">
    <input name="verify_code" type="text" class="input-small" placeholder="验证码">
    <img style="cursor:pointer;" src="<?=url('admin')?>administrator/admin_login/verifyCode?<?=mt_rand()?>" width="80" height="30">
    <button type="submit" class="btn btn-primary">登录</button>
    </form>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
<script>
$(function($){
    $('img').click(function(){
        var src = '<?=url('admin')?>administrator/admin_login/verifyCode?' + Math.random();
        $(this).attr('src', src);
    })
})
</script>
