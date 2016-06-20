<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
require_once("../ifadmin.php");

$fid = $_GET['fid'];
$sql = "SELECT * FROM tf_form_type where title='报考级别' and fid=".escapeshellarg($fid);
$res = $db->getOne($sql);
$sql1 = "SELECT * FROM tf_form_type where title='培训类别'  and  fid=".escapeshellarg($fid);
$res1 = $db->getOne($sql1);
$sql2 = "SELECT * FROM tf_form_type where title='其它费用'  and  fid=".escapeshellarg($fid);
$res2 = $db->getOne($sql2);
echo $res['options'].".".$res1['options'].".".$res2['options'];

?>
