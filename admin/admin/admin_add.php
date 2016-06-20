<?php
session_start();
//note 加载MooPHP框架
require '../MooPHP/MooPHP.php';
//note:加载配置文件
require  '../MooPHP/MooConfig.php';
//判断管理员是否登录
require '../ifadmin.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0063)http://www.ddphp.cn/bm/dadmin/user_edit.php?id=1607&action=edit -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title></title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../../js/Validform_v5.3.2.js"></script>
<link href="../../css/validform.css" rel="stylesheet"></link>
</head>
<body>
<div class="main">
<div class="content">
<div class="title">添加管理员</div>
</div>
<div class="list">
<form name="form" id="form" class="form" method="post" action="admin_save.php">
<table cellpadding="0" cellspacing="0" width="100%" class="role_table" id="OwnershipStructure">
<tbody>
<tr>
	<td class="tRight" width="150" rowspan="1" id="StructureLeft1">管理员名称</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="username" datatype="s6-18" errormsg="用户名必须为6~18字符！"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                  用户名必须使用为长度为6~18位字符
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">管理员类别</td>
	<td class="tLeft">
            <select name="quanxian" id="StructureLeft2">
                <option value="普通管理员">普通管理员</option>
                <option value="高级管理员">高级管理员</option>
            </select>
        </td>
        <td></td>
</tr>
<tr>
	<td class="tRight" width="150">登录密码</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="password" name="password" datatype="*6-16" nullmsg="请设置密码！" errormsg="密码范围在6~16位之间！"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                密码范围在6~16位之间
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">重复登录密码</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="password" name="password2" datatype="*" recheck="password" nullmsg="请再输入一次密码！" errormsg="您两次输入的账号密码不一致！"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                两次输入密码需一致
            </div>
        </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td class="center" colspan="3">
            <input type="submit" value="添 加" name="submit" class="button small">
            <input class="button small" type="reset" value="重 置">
            <input type="button" onclick="history.go(-1)" class="button small" name="reset" value="返 回" />
        </td>
</tr>
</tbody>
</table>
<script type="text/javascript">
        $(function() {
            $(".form").Validform({
                tiptype: 2
            });
        });
</script> 
</form>
</div>
</div>
</body>
</html>