<?php

session_start();
//note 加载MooPHP框架
require  '../MooPHP/MooPHP.php';
//note:加载配置文件
require '../MooPHP/MooConfig.php';
require_once("../ifadmin.php");
require_once '../fun.php';

include_once '../../crypt/crypt.php';

$table = "tf_users";

$id = $_POST['id'];
$name = trim($_POST['name']);
$username = $_POST['username'];
$password = encrypt(trim($_POST['password']));
$age = substr($username, 6, 4).'-'.substr($username, 10, 2).'-'.substr($username, 12, 2);
$vlidate = substr($username, 14, 3);
if ($vlidate % 2 == 1)
    $sex = "男";
else
    $sex = "女";
$tel = trim($_POST['tel']);
$qq = $_POST['qq'];
$address = $_POST['address'];
$stat = $_POST['stats'];
$modtime = time();
$studentid = trim($_POST['studentid']);
$classid = trim($_POST['classid']);
$email = $_POST['email'];
$zgxl = $_POST['zgxl'];
$zgxw = $_POST['zgxw'];
$folk = $_POST['folk'];

$db->query("BEGIN"); //或者mysql_query("START TRANSACTION")
$sql = 'update '.$table.' set name="'.$name.
        '",username="'.$username
        .'",studentid="'.$studentid.
        '",classid="'.$classid.
        '",password="'.$password.
        '",sex="'.$sex.
        '",age="'.$age.
        '",folk="'.$folk.
        '",tel="'.$tel.
        '",qq="'.$qq.
        '",email="'.$email.
        '",zgxl="'.$zgxl.
        '",zgxw="'.$zgxw.
        '",address="'.$address.
        '",stat='.$stat.
        ',modtime=now() where id='.escapeshellarg($id);
$sql = str_replace("'","\"",$sql); 
$ip = ip();
$data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','update','$sql',now())";
$db->query($data_sql);
$res = $db->query($sql);
if ($res>0) {
    $db->query("COMMIT");
    echo "<script type='text/javascript'> alert('考生信息修改成功！');</script>";
    echo "<script>location.href='user_list.php?stats=".$stat."';</script>";
}
else
{
    $db->query("ROLLBACK");
    echo "<script type='text/javascript'> alert('考生信息修改失败!');history.go(-1);</script>";
}

?>