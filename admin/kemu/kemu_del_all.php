<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
//$admin = $db->getOne("SELECT * FROM {$tablePre}admin WHERE id='1'");
//$pass = "21232f297a57a5a743894a0e4a801fc3";//$admin['pass'];
//if($_SESSION['admin'] != $pass) {
//	msg("请登陆","subok","login.php");
//	exit;
//}
$table = "tf_form";
$ids = explode(',',$_GET['id']);

foreach ($ids as $key => $id) {
    $sql = "delete from $table where fid=".intval($id);
    $db->query($sql);
    $sql = "delete from tf_form_type where fid=".intval($id);
    $db->query($sql);
}  

msg("删除成功！");

?>