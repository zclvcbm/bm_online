<?php
error_reporting(0);
session_start();
require 'connect.php';
include_once('class.phpmailer.php');

$email=$_POST['email'];
$name=$_POST['name'];
$sql = "select  zc.email,zc.password,jb.xm from ypzc as zc,ypzjbxx as jb where zc.id=jb.zcid and email='$email' and xm='$name'";

$result = mysql_query($sql);
$count = mysql_num_rows($result);
$data = mysql_fetch_array($result);
$password = $data['password'];
$mail = $data['email'];
$name = $data['xm'];

echo $count;
if($count>0)
{

$tomail="10359309@qq.com";

$mail = new PHPMailer(true);
        $mail->IsSMTP();
        //$mail->CharSet = 'UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码 
        $mail->SMTPAuth = true; //开启认证 
        $mail->Port = 25;
        $mail->Host = "smtp.163.com";
        $mail->Username = "ctgursc@163.com";
        $mail->Password = "rsc123456";
//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could not execute: /var/qmail/bin/sendmail ”的错误提示 
        $mail->AddReplyTo("ctgursc@163.com", "三峡大学人事处11"); //回复地址 
        $mail->From = "ctgursc@163.com";
        $mail->FromName = "zhangdp-4012";
//        $to = "707212993@qq.com";
        $mail->AddAddress($tomail);
        $mail->Subject = "密码找回通知";
        $mail->Body = "<h1>密码找回通知</h1>".
                $toname.",您好！感谢您使用三峡大学人才招聘网!<br/>
                 &nbsp;&nbsp;&nbsp;&nbsp;您的登录密码为：".$password."<br/>
                 祝您应聘顺利！";
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略 
        $mail->WordWrap = 80; // 设置每行字符串的长度 
//$mail->AddAttachment("f:/test.png"); //可以添加附件 
        $mail->IsHTML(true);
        $mail->Send();
        echo '邮件已发送';
		
}		
?>
