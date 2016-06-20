<?php
//设置工程相对路径
$tmpmd5='asdf';
$root_path="..";
require_once("$root_path/data/dconfig.php");
require_once("$root_path/lib/config.php");
require_once("./ifadmin.php");
//修改密码
if(isset($_POST['mod'])){
	session_start();
	$username=$_SESSION['admin'];
	if($_POST['Password']!= $_POST['rePassword'])
	{
		showmessage_go("重复输入密码出错！");
	}	
	$Old_Password=MD5($_POST['Old_Password']);
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
		showmessage("修改密码成功！");	
		location("adminpassmod.php");
	}
	else
	{
		showmessage("修改密码失败！");
		//location("adminpassmod.php");
	}
	$db->free();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body >

<div class="main" >
<div class="content" >
<div class="title">欢迎使用报名管理系统</div>

</div>
<div class="list">
<form id="form1" name="form1" method="post"action="adminpassmod.php">
<table cellpadding=0 cellspacing=0 width=100% class="role_table" >
    <tr>
        <td class="tLeft">  版本：V1.0<br><br>
                    <br><br>
        </td>
    </tr>
</table>
</form>
</div>
</div>
</body>
</html>