<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fi" lang="fi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>添加活动 -- 万象电子商务后台管理系统</title>
    <style type="text/css">/*<![CDATA[*/
    @import "/css/login.css";

        /*]]>*/</style>
</head>
<body>
<form action="/administrator/am_activity/" method="post">
    <table>
        <tr>
            <td>活动主题：</td>
            <td><input type="text" name="subject"/></td>
        </tr>

        <tr>
            <td>开始时间：</td>
            <td><input type="text" name="start_time"/></td>
        </tr>

        <tr>
            <td>结束时间：</td>
            <td><input type="text" name="end_time"/></td>
        </tr>

        <tr>
            <td>活动介绍：</td>
            <td><textarea name="description"/></textarea></td>
        </tr>
        <tr>
            <td>活动规范：</td>
            <td><textarea name="specification"></textarea></td>
        </tr>

        <tr>
            <td colspan="2"><input type="submit" value="提交"></td>
        </tr>
    </table>
</form>
</body>
</html>