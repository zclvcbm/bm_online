<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
require_once("../ifadmin.php");
require_once '../fun.php';



$table = "tf_kkhb";
$yyyy = $_POST['yyyy'];
$counts = $_POST['counts'];
$maxnum = $_POST['maxnum'];
$st = $_POST['start_time'];
$et = $_POST['end_time'];
$sst = $_POST['subs_time'];
$set = $_POST['sube_time'];
$px = $_POST['px']==""?"":$_POST['px'];
$jb = $_POST['jb']==""?"":$_POST['jb'];
$bz = $_POST['bz']==""?"":$_POST['bz'];
$id = $_POST['id'];
$fid = $_POST['fid'];

$db->query("BEGIN"); //或者mysql_query("START TRANSACTION")
$sql = 'update  '.$table.'  set yyyy='.$yyyy.
        ',counts='.$counts.
        ',maxnum='.$maxnum.
        ',start_time="'.$st.'"'.
        ',end_time="'.$et.'"'.
        ',subs_time="'.$sst.'"'.
        ',sube_time="'.$set.'"'.
        ',bz="'.$bz.
        '"  where id='.$id;
$sql = str_replace("'","\"",$sql); 
$ip = ip();
$data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','update','$sql',now())";
$res=$db->query($sql);
$db->query($data_sql);
if ($res>0) {
    
    $sql = "update tf_form_type set options='".$px."' where title='培训类别' and fid=".$fid;
    $sql = str_replace("'","\"",$sql); 
    $data_sql1 = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','update','$sql',now())";
    $db->query($sql);
    $db->query($data_sql1);
    
    $sql = "update tf_form_type set options='".$jb."' where title='报考级别' and fid=".$fid;
    $sql = str_replace("'","\"",$sql);
    $data_sql2 = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','update','$sql',now())";
    $db->query($sql);
    $db->query($data_sql2);
    
    
    $db->query("COMMIT");
    msg('考务内容已更新！');
}
else
{
    $db->query("ROLLBACK");
    msg('考务内容更新失败！');
}

?>
