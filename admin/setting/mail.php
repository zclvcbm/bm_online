<?php
//设置工程相对路径
$root_path="../..";
require_once("$root_path/data/dconfig.php");
require_once("$root_path/lib/config.php");
if(file_exists("$root_path/data/dmailconfig.php")){	  
	require_once("$root_path/data/dmailconfig.php");
}
require_once("../ifadmin.php");
//修改密码
if(!empty($_POST['submit']))
{

	$config_file='../../data/dmailconfig.php';
        $file = fopen($config_file,"w"); 
        
	$info = $_POST;
	$con = "<?php\r\n\r\n";
        $con .= "\t\r\n\$mailok = '0';";
        $con .= "\t\r\n\$smtpusermail = '".$info['smtpusermail']."';";
        $con .= "\t\r\n\$smtpemailto = '".$info['smtpemailto']."';";
        $con .= "\t\r\n\$mailsubject = '".$info['mailsubject']."';";
        $con .= "\t\r\n\$smtpserver = '".$info['smtpserver']."';";
        $con .= "\t\r\n\$smtpserverport = '". $info['smtpserverport']."';";
        $con .= "\t\r\n\$smtpuser = '".$info['smtpuser']."';";
        $con .= "\t\r\n\$smtppass = '".$info['smtppass']."';";
        $con .= "\t\r\n\r\n ?>";
	fwrite($file,$con); 
        fclose($file);
        header("Location: mail.php");
        
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../style/style.css" rel="stylesheet" type="text/css" />
</head>
<body >

<div class="main" >
<div class="content" >
<div class="title">发邮件配置</div>

</div>
<div class="list">
<form id="form1" name="form1" method="post"action="mail.php">
<table cellpadding=0 cellspacing=0 width=100% class="role_table" >
<tr>
	<td class="tRight" width="160">发送人邮箱</td>
	<td  class="tLeft" > <input name="smtpusermail" type="text" size="50" value="<?php echo $smtpusermail?>"/> </td>
</tr>
<tr>
	<td class="tRight" width="160">邮件主题</td>
	<td  class="tLeft" > <input type="text" name="mailsubject"  size="50"  value="<?php echo $mailsubject?>"/> </td>
</tr>

<tr>
	<td class="tRight" width="160">SMTP配置</td>
	<td  class="tLeft" ><span class="tRight">SMTP配置</span> </td>
</tr>
<tr>
	<td class="tRight" width="160">SMTP服务器</td>
	<td  class="tLeft" > <input type="text" name="smtpserver"  size="50"  value="<?php echo $smtpserver?>"/> </td>
</tr>
<tr>
	<td class="tRight" width="160">SMTP服务器端口</td>
	<td  class="tLeft" > <input type="text" name="smtpserverport" size="50"  value="<?php echo $smtpserverport?>"/> </td>
</tr>
<tr>
	<td class="tRight" width="160">SMTP服务器的用户帐号</td>
	<td  class="tLeft" > <input type="text" name="smtpuser" size="50"  value="<?php echo $smtpuser?>"/> </td>
</tr>
<tr>
	<td class="tRight" width="160">SMTP服务器的用户密码</td>
	<td  class="tLeft" > <input type="text" name="smtppass" size="50"  value="<?php echo $smtppass?>"/> </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td class="center" colspan="3">
        <input name="mod" type="hidden" value="1" />
        <input type="submit" value="保 存"  name="submit" class="button small"></td>
</tr>
</table>

</form>
</div>
</div>
</body>

</html>