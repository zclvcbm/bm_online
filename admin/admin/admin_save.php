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
$username = trim(str_replace(' ', '',$_POST['username']));
$quanxian = $_POST['quanxian'];
$password = md5($_POST['password']);
$sql = "select * from ".$table." where username='".$username."'";
$result=$db->numRows($sql);
if($result>0)
{
    msg("失败！已存在同名管理员！");
    return ;
}

$db->query("BEGIN"); //或者mysql_query("START TRANSACTION");
$sql = 'insert into  '.$table.'(username,passwd,quanxian,createtime,modtime) values("'.$username.'", "'.$password.'","'.$quanxian.'",now(),now())';
$sql = str_replace("'","\"",$sql); 
$ip = ip();
$data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','insert','$sql',now())";
$res = $db->query($sql);
$db->query($data_sql);
if ($res>0) {
    $db->query("COMMIT");
    msg('管理员信息添加成功！','subok','admin_list.php');
}
else
{
    $db->query("ROLLBACK");
    msg('管理员信息添加失败！');
}
?>
