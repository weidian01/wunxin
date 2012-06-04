<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fi" lang="fi">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>登陆 -- 万象电子商务后台管理系统</title>
		<style type="text/css">/*<![CDATA[*/
			@import "/css/login.css";
		/*]]>*/</style>
	</head>
<body>
	<div id="container">
		<h1>万象电子商务后台管理系统</h1>
		<div id="box">
			<form action="/administrator/admin_login/login" method="post">
			<p class="main">
				<label>用户名: </label>
				<input type="text" name="username" />
				<label>密码: </label>
				<input type="password" name="password" />
			</p>
			<p class="space">
				<span><!--<input type="checkbox" />Remember me--></span>
				<input type="submit" value="Login" class="login" />
			</p>
			</form>
		</div>
	</div>
</body>
</html>