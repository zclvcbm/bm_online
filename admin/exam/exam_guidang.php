<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
require_once("../ifadmin.php");

$table = "tf_kkhb";
$sql = 'select h.mc,k.yyyy,k.counts,h.level,u.`name`,h.sfzh,u.classid,u.studentid,u.folk,u.email,u.sex,u.age,u.tel,u.qq,u.address,u.zgxw,u.zgxl,h.lxdh,h.zkzh,h.zsbh,h.cj1,h.cj2,h.cj3,h.cj4,h.cj_stats from (select c.*,f.fid from tf_cj as c,tf_form as f where c.mc = f.fname and f.fid = '.escapeshellarg($_GET['fid']).' ) as h LEFT JOIN tf_users as u on u.username = h.sfzh LEFT JOIN tf_kkhb as k on h.fid = k.fid';

$res = $db->getAll($sql);

$insert_sql =  "insert into tf_guidang(kskm,year,counts,bkjb,`name`,sfzh,classid,studentid,folk,email,sex,age,tel,qq,address,zgxw,zgxl,lxdh,zkzh,zsbh,cj1,cj2,cj3,cj4,cj_stats) ".$sql; 

$res = $db->query($insert_sql);



if($res>0)
{
    $clear_sql = "Truncate table form_".intval($_GET['fid']);
    $db->query($clear_sql);
    $clear_sql = "delete from tf_cj where mc=(select fname from tf_form where fid=".escapeshellarg($_GET['fid'])." LIMIT 1)";
    $db->query($clear_sql);
    $clear_sql = "delete from tf_zkzh where mc=(select fname from tf_form where fid=".escapeshellarg($_GET['fid'])." LIMIT 1)";
    $db->query($clear_sql);
    msg("归档成功！");
}else
{
    msg("归档失败！");
}
?>