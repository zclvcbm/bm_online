<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
//判断管理员是否登录
require_once '../ifadmin.php';
require_once '../fun.php';

$table = "tf_admin";
$ids = explode(',',$_GET['id']);
$ip = ip();
$flag = true;
$db->query("BEGIN"); //或者mysql_query("START TRANSACTION");
foreach ($ids as $key => $id) {
    if(!empty($id))
    {
        $sql = "delete from $table where id=".escapeshellarg($id);
        $sql = str_replace("'","\"",$sql); 
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