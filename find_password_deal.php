<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>
<?php
error_reporting(0);
session_start();
require_once("data/dconfig.php");
require_once("lib/config.php");
include_once('phpmailer/class.phpmailer.php');
include_once('data/dmailconfig.php');
include_once('crypt/crypt.php');
include_once('waf/waf.php');
header("content-type:text/html; charset=utf-8");

$email=$_POST['email'];
$name=$_POST['name'];


$sql = "select * from tf_users where email=".escapeshellarg($email)." and name='".mysql_escape_string($name)."'";


$db = new MySql();
$result = $db->getArray($sql);
$count = count($result);

if($count>0)
{
    $data = $result[0];
    $email = $data['email'];
    $name = $data['name'];
    $password = decrypt($data['password']);
    //print_r($data);
    $mail = new PHPMailer(true);

    $mail->IsSMTP();
    $mail->CharSet = 'utf-8'; //设置邮件的字符编码，这很重要，不然中文乱码 
    $mail->SMTPAuth = true; //开启认证 
    $mail->Port = $smtpserverport;//25;
    $mail->Host = $smtpserver;//"smtp.163.com";
    $mail->Username = $smtpuser;//"15071740865";
    $mail->Password = $smtppass;//"zc707212993";
//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could not execute: /var/qmail/bin/sendmail ”的错误提示 
    $mail->AddReplyTo($smtpusermail, $smtpuser); //回复地址 
    $mail->From = $smtpusermail;
    $mail->FromName = "三峡大学继续教育学院";
    $to = $email;
    $mail->AddAddress($to,$name);
    $mail->Subject = "密码找回通知";
    $mail->Body = "<b>密码找回通知</b><br>" .
            $name . "您好！感谢您使用三峡大学继续教育学院考试报名系统!<br/>
                 &nbsp;&nbsp;&nbsp;&nbsp;您的登录密码为：" . $password . "<br/>
                 祝您考试顺利！";
    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略 
    $mail->WordWrap = 80; // 设置每行字符串的长度 
//$mail->AddAttachment("f:/test.png"); //可以添加附件 
    $mail->IsHTML(true);
    $mail->Send();
    echo '邮件已发送!<a href="login.php">返回登录页面</a>';
}else
{
    echo "<center>邮箱或姓名不正确!</center>";
    die('<meta http-equiv="refresh" content="1; URL=find_password.php">');
}	

?>
