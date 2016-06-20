<?php

session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
//判断管理员是否登录
require_once '../ifadmin.php';
require_once '../fun.php';

$db->query("BEGIN"); //或者mysql_query("START TRANSACTION");
$mc = $_POST['mc'];
$cj_type = $_POST['cj_type'];
$level = $_POST['level']; 
$sfzh = $_POST['sfzh'];
$zkzh = $_POST['zkzh'];
$zsbh = $_POST['zsbh'];
$lxdh = $_POST['lxdh'];
$cj1 = $_POST['cj1'];
$cj2 = $_POST['cj2'];
$cj3 = $_POST['cj3'];
$cj4 = $_POST['cj4'];
$cj_stats = $_POST['cj_stats'];

$sql = "insert into tf_cj(cj_type_id,mc,level,sfzh,lxdh,zkzh,cj1,cj2,cj3,cj4,cj_stats,zsbh) "
        ."values($cj_type,'$mc','$level','$sfzh','$lxdh','$zkzh',$cj1,$cj2,$cj3,$cj4,$cj_stats,'$zsbh')";
$sql = str_replace("'","\"",$sql); 
$ip = ip();
$data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','delete','$sql',now())";
$db->query($data_sql);
$result = $db->query($sql);
if($result>0)
{
    $db->query("COMMIT");
    msg('考生成绩添加成功！','subok','cj_list.php');
}
 else {
     $db->query("ROLLBACK");
     msg("考生成绩添加失败");
}
?>
