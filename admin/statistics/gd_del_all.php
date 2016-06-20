<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
//判断管理员是否登录
require_once '../ifadmin.php';
$ids = explode(',',$_GET['id']);
foreach ($ids as $key => $id) {
    $sql = "delete from tf_guidang where id=".intval($id);
    $db->query($sql);
}  
msg("删除成功！","subok","gd_list.php");
?>