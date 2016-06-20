<html xmlns="http://www.w3.org/1999/xhtml">
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>
<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
require_once("../ifadmin.php");
require_once '../fun.php';

$db = new MySql();
$db->query("BEGIN"); //或者mysql_query("START TRANSACTION")
$mc = $_GET['mc'];
$sql = "delete from tf_zkzh where mc = '".mysql_escape_string($mc)."'";
$sql = str_replace("'","\"",$sql); 
$ip = ip();
$data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','insert','$sql',now())";
$db->query($sql);
$db->query($data_sql);
if($db->affected_rows()>0){
    $db->query("COMMIT");
    msg("删除成功！","subok","zkz_list.php");
}else{
    $db->query("ROLLBACK");
    msg("删除失败！");
}


?>
</html>