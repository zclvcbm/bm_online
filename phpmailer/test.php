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
        //$mail->CharSet = 'UTF-8'; //�����ʼ����ַ����룬�����Ҫ����Ȼ�������� 
        $mail->SMTPAuth = true; //������֤ 
        $mail->Port = 25;
        $mail->Host = "smtp.163.com";
        $mail->Username = "ctgursc@163.com";
        $mail->Password = "rsc123456";
//$mail->IsSendmail(); //���û��sendmail�����ע�͵���������֡�Could not execute: /var/qmail/bin/sendmail ���Ĵ�����ʾ 
        $mail->AddReplyTo("ctgursc@163.com", "��Ͽ��ѧ���´�11"); //�ظ���ַ 
        $mail->From = "ctgursc@163.com";
        $mail->FromName = "zhangdp-4012";
//        $to = "707212993@qq.com";
        $mail->AddAddress($tomail);
        $mail->Subject = "�����һ�֪ͨ";
        $mail->Body = "<h1>�����һ�֪ͨ</h1>".
                $toname.",���ã���л��ʹ����Ͽ��ѧ�˲���Ƹ��!<br/>
                 &nbsp;&nbsp;&nbsp;&nbsp;���ĵ�¼����Ϊ��".$password."<br/>
                 ף��ӦƸ˳����";
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //���ʼ���֧��htmlʱ������ʾ������ʡ�� 
        $mail->WordWrap = 80; // ����ÿ���ַ����ĳ��� 
//$mail->AddAttachment("f:/test.png"); //������Ӹ��� 
        $mail->IsHTML(true);
        $mail->Send();
        echo '�ʼ��ѷ���';
		
}		
?>
