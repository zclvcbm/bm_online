﻿<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>
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

$title=$_POST['title'];
$fid=$_POST['tfid'];
$stat=$_POST['tstat'];



if(3>1)
{
    $data = $result[0];
  
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
    $mail->FromName = "三峡大学成教学院";
	
    $email = "10359309@qq.com";
    $name = "高张";



/*正式使用时取消
     $db = new MySql();
     $sql="select email,name from form_".intval($fid)." a left join tf_users  b on  a.sfzh=b.username  $wsql order by a.id desc";
     $emails = $db->getArray($sql);
     $i=0;             
     foreach ($emails as $email) {
       $email=$email['email'];
       $name=$email['name'];
     }
     
    $ts=$title;
*/

    

    if($stat=="0")
      $ts="您的照片未通过审核！";
    else if($stat=="1") 
      $ts="您的照片通过审核！";
    else
      $ts="你的信息正在审核中";

	
     if(3>1)
	{
		$to = $email;
		$mail->AddAddress($to,$name);
		$mail->Subject = "邮件通知";
		$mail->Body = "<b>邮件通知</b><br>" .
				$name . "您好！感谢您使用三峡大学成教学院考试报名系统!<br/>
					 &nbsp;&nbsp;&nbsp;&nbsp;".$ts;
		$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略 
		$mail->WordWrap = 80; // 设置每行字符串的长度 
	        $mail->IsHTML(true);
		$mail->Send();
    }
    echo '邮件已发送!<a href="admin/baoming/sendmail_list.php">返回</a>';
}else
{
    echo "<center>设置不正确，未发送！</center>";
    die('<meta http-equiv="refresh" content="1; URL=admin/baoming/send_add.php">');
}	

?>
