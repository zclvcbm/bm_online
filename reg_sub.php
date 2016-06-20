<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
require_once("data/dconfig.php");
require_once("lib/config.php");
include_once 'crypt/crypt.php';
?>
<title>报名系统</title>
<meta name="keywords" content="报名系统">
<meta name="description" content="报名系统">
<link media="screen" type="text/css" href="./css/style.css" rel="stylesheet">
<link media="screen" type="text/css" href="./css/layout.css" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/validform.css" rel="stylesheet">
<script type="text/javascript" src="./js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="./js/Validform_v5.3.2.js"></script>
</head>

<?php

if (isset($_POST['btnSubmit'])) {
    session_start();
  
if ($_POST['token'] != $_SESSION['token']){     
//strip_tags     
       
    
    $username = str_replace(' ', '',$_POST['username']);
    $age = substr($username, 6, 4).'-'.substr($username, 10, 2).'-'.substr($username, 12, 2);
    $vlidate = substr($username, 14,3);
    if($vlidate%2==1)
        $sex = '男';
    else 
        $sex = '女';
    $name = str_replace(' ', '',trim($_POST['name']));
    $password = str_replace(' ','',$_POST['password']);
    $password = encrypt($password);
    $email = $_POST['email']; 
    
    $db = new MySql();
    
    $uid = date('Y')."".rand(1000, 9999);
    $uid_sql = "select uid from tf_users where uid=".$uid;
    $db->getOne($uid_sql);
    while($db->num_rows()==1)
    {
        $uid = date('Y')."".rand(1000, 9999);
        $uid_sql = "select uid from tf_users where uid=".$uid;
        $db->getOne($uid_sql);
        //echo $db->num_rows();
        //echo $uid;
    }

    //$regtime= time()+6*3600;




    
    
    $sql = "select * from tf_users where username='$username'";
    $db->query($sql);
    $count = $db->num_rows();

    if($count>=1)
    {
        showmessage_go("注册失败,该身份证已注册！");
    }
    else
    {
        $sql = "insert into tf_users(uid,username,name,age,sex,password,email,regtime) values($uid,'$username','$name','$age','$sex','$password','$email',now()) ";

        $res=$db->query($sql);
        $_SESSION['uid'] = $uid;
        $_SESSION['username'] = $username;

        $username = $username;
        $cdate = date('Y-m-d');
        $lastdate = date('Y-m-d H:i:s',time()+6*3600);
        $ips = $_SERVER["REMOTE_ADDR"];

        $sql = "insert into tf_user_log(username,ips,cdate,lastdate) values('$username','$ips','$cdate','$lastdate')";
        $db->query($sql);
        
        location("./center.php");
    }



//continue processing....     
}else{     
 //stop all processing! remote form posting attempt!     
 }     


$token = md5(uniqid(rand(), true));     
 $_SESSION['token']= $token;     
      
  function cleanHex($input){     
     $clean = preg_replace("![\][xX]([A-Fa-f0-9]{1,3})!", "",$input);     
     return $clean;     
 }     

}


?>
