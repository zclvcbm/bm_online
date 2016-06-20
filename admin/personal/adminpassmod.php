<?php
//设置工程相对路径
$root_path="../..";
require_once("$root_path/data/dconfig.php");
require_once("$root_path/lib/config.php");
require_once("../ifadmin.php");
//修改密码
if(isset($_POST['mod'])){
	session_start();
	$username=$_SESSION['admin'];
	if($_POST['Password']!= $_POST['rePassword'])
	{
		showmessage_go("重复输入密码出错！");
	}	
	$Old_Password=md5($_POST['Old_Password']);
	$db=new MySql();
	$sqle="select id from tf_admin where username='".$username."' and passwd='".$Old_Password."'";
	$db->query($sqle);
	if(!($db->next_record()))
	{
		showmessage_go("旧密码错误!");		
	}
	$Password=MD5($_POST['Password']);
	//更新数据
	$sql="update  tf_admin set passwd='$Password'
		where username='".$username."'";
	$db->query($sql);
	if($db->affected_rows())
	{
		showmessage("密码修改成功！");	
		location("adminpassmod.php");
	}
	else
	{
		showmessage("密码修改失败！");
		//location("adminpassmod.php");
	}
	$db->free();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../../js/Validform_v5.3.2.js"></script>
<link href="../../css/validform.css" rel="stylesheet"></link>

</head>
<body >

<div class="main" >
<div class="content" >
<div class="title">管理员密码修改</div>

</div>
<div class="list">
<form id="form" class="form" name="form" method="post"action="adminpassmod.php">
<table cellpadding=0 cellspacing=0 width=100% class="role_table" >

<tr>
	<td class="tRight">密码</td>
	<td class="tLeft" > <input type="password" name="Old_Password" size="20" datatype="*6-16" errormsg="密码长度为6~16位！"> </td>
        <td>
            <div class="Validform_checktip">
                填写6到16位任意字符！
            </div>
        </td>
</tr>
<tr>
	<td class="tRight">新密码</td>
	<td class="tLeft" > <input type="password" name="Password" size="20" datatype="*6-16" nullmsg="请设置密码！" errormsg="密码范围在6~16位之间！"></td>
        <td>
            <div class="Validform_checktip">
                密码范围在6~16位之间
            </div>
        </td>
</tr>
<tr>
	<td class="tRight">确认新密码</td>
	<td class="tLeft">  <input type="password" name="rePassword" size="20" datatype="*6-16" recheck="Password" nullmsg="请再输入一次密码！" errormsg="您两次输入的账号密码不一致！">  </td>
        <td>
            <div class="Validform_checktip">
                两次密码需一致
            </div>
        </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td class="center" colspan="3">
    <input name="mod" type="hidden" value="1" />
	<input type="submit" value="提 交"  name="submit" class="button small"> </td>
</tr>
</table>

</form>
</div>
</div>
</body>
</html>
<script type="text/javascript">
        $(function() {
            $(".form").Validform({
                tiptype: 2
            });
        });
</script>