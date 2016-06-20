<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
require_once("../ifadmin.php");
require_once '../fun.php';

$mc = $_GET['mc'];

$db->query("BEGIN"); //或者mysql_query("START TRANSACTION");
$sql = "delete from tf_cj where mc='".mysql_escape_string($mc)."'";
$sql = str_replace("'","\"",$sql); 
$ip = ip();
$data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','delete','$sql',now())";
$res=$db->query($sql);
$db->query($data_sql);
if($res>0)
{
    $db->query("COMMIT");
    msg("删除成功！","subok","cj_list.php");
}else{
    $db->query("ROLLBACK");
    msg("删除失败！");
}
?>