<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
require_once("../ifadmin.php");
require_once '../fun.php';

$table = "tf_kkhb";

$db->query("BEGIN"); //或者mysql_query("START TRANSACTION");
$ids = explode(',',$_GET['id']);
$flag = true;
foreach ($ids as $key => $id) {
    if(!empty($id))
    {
        $sql = "delete from $table where id=".intval($id);
        $sql = str_replace("'","\"",$sql); 
        $ip = ip();
        $data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','delete','$sql',now())";
        $res=$db->query($sql);
        $db->query($data_sql);
        if($res<=0)
            $flag=false;
    }

}  
if($flag==false)
{
    $db->query("ROLLBACK");
    msg("删除失败！");
}
else{
    $db->query("COMMIT");
    msg("删除成功！");
}


?>