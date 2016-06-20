<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>
<?php
require_once("data/dconfig.php");
require_once("lib/config.php");
include_once 'crypt/crypt.php';
include_once 'waf/waf.php';

if (isset($_POST['btnSubmit'])) {
     //注册判断
    session_start();
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $db = new MySql();
    $sql = "select * from tf_users where username=".escapeshellarg($username);
    
    $db->query($sql);
    $count = $db->num_rows();
    $user = $db->getOne($sql);
    if($count >=1)
    {
        $pwd = $user['password'];
        $a = decrypt($pwd);
        if($a==$password)
        {
            $_SESSION['uid'] = $user['uid'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['id'] = $user['id'];
            $username = $user['username'];
            $cdate = date('Y-m-d');
            //$lastdate = date('Y-m-d H:i:s',time()+3600*6);
            $ips = $_SERVER["REMOTE_ADDR"];

            $db = new MySql;
            $sql = "insert into tf_user_log(username,ips,cdate,lastdate) values('$username','$ips','$cdate',now())";
            $db->query($sql);
            
   

location("./center.php");
        }
        else
        {
            location("./login.php");
        }
    }
    else
    {
        showmessage("用户名不正确！");
        location("./login.php");
    }
     
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
