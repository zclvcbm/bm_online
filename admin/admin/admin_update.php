<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
//判断管理员是否登录
require_once '../ifadmin.php';
require_once '../fun.php';

$table = "tf_admin";
$id = $_POST['id'];
$username = trim(str_replace(' ', '',$_POST['username']));
$quanxian = $_POST['quanxian'];
$passwd = md5($_POST['password']);



$db->query("BEGIN"); //或者mysql_query("START TRANSACTION");
$sql = 'update  '.$table.'  set username="'.$username.
        '",quanxian="'.$quanxian.
        '",passwd="'.$passwd.
        '",modtime=now()  where id='.escapeshellarg($id);
$sql = str_replace("'","\"",$sql); 
$ip = ip();
$data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','update','$sql',now())";
$res = $db->query($sql);
$db->query($data_sql);
if ($res>0) {
    $db->query("COMMIT");
    msg('管理员信息修改成功！');
}
else
{
    $db->query("ROLLBACK");
    msg('管理员信息修改失败！');
}

?>
