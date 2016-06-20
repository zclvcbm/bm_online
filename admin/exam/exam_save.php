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
$counts = $_POST['counts']==""?1:$counts;
$maxnum = $_POST['maxnum']==""?9999:$maxnum;
$st = $_POST['start_time'];
$et = $_POST['end_time'];
$sst = $_POST['subs_time'];
$set = $_POST['sube_time'];
$bz = $_POST['bz']==""?"":$_POST['bz'];
$fid = $_POST['fid'];
$px = $_POST['px'];
$jb = $_POST['jb'];


$db->query("BEGIN"); //或者mysql_query("START TRANSACTION");
$sql = 'insert into '.$table.'(fid,yyyy,counts,maxnum,start_time,end_time,subs_time,sube_time,bz)  values('.$fid.
        ','.$yyyy.
        ','.$counts.
        ','.$maxnum.
        ',"'.$st.'"'.
        ',"'.$et.'"'.
        ',"'.$sst.'"'.
        ',"'.$set.'"'.
        ',"'.$bz.
        '")';

$sql = str_replace("'","\"",$sql); 
$ip = ip();
$data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','insert','$sql',now())";
$res=$db->query($sql);
$db->query($data_sql);
if ($res>0) {
    $ip = ip();
    $sql = "update tf_form_type set options='".$px."' where title='培训类别' and fid=".escapeshellarg($fid);
    $sql = str_replace("'","\"",$sql); 
    $db->query($sql);
    $data_sql1 = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','update','$sql',now())";
    $sql = "update tf_form_type set options='".$jb."' where title='报考级别' and fid=".escapeshellarg($fid);
    $sql = str_replace("'","\"",$sql);
    $db->query($sql);
    $data_sql2 = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','update','$sql',now())";  
    $db->query($data_sql1);
    $db->query($data_sql2);
    $db->query("COMMIT");
    msg('考务内容新建成功！','subok','examslist.php');
}
else
{
    $db->query("ROLLBACK");
    msg('考务内容新建失败！');
}

?>
