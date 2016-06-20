<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
//判断管理员是否登录
require_once'../ifadmin.php';
require_once '../fun.php';
//print_r($_REQUEST);
//die();
$fid = intval($_REQUEST['fid']);
$jfdh = $_REQUEST['jfdh'];
$table = "form_".$fid;
$ids = explode(',',$_REQUEST['id']);
//print_r($ids);
//die();

//print_r($ids);
$qrxslb = "";
$kskm = "";
$classid = "";
$counts = 0;
//print_r($ids);
//die();
foreach ($ids as $key => $id) {
    
    $bm_sql = "select f.*,u.classid from form_".$fid.' f left join tf_users u on f.sfzh=u.username where f.id='.$id;
    //echo $bm_sql;
    //die();
    $bminfo = $db->getOne($bm_sql);
    
    //print_r($bminfo);
    //die();
    //$kskm = $bminfo['kskm'];
    $classid = $bminfo['classid'];
    $counts++;
    if($bminfo['jfzt']== 0)
    {
        $db->query("BEGIN"); //或者mysql_query("START TRANSACTION");
        $fy = $bminfo['ksfy']+$bminfo['pxfy'];
        $jf_sql = "insert into tf_paylist(sfzh,applyid,transaction,serialnumber,money,paytime,paymethod) values ('"
                .$bminfo['sfzh']."','"
                .$bminfo['bmh']."','"
                .$bminfo['kskm']."','"
                .""."',"
                .$fy.",now(),'"
                ."现场缴费')";
        $jf_sql = str_replace("'","\"",$jf_sql); 
        $ip = ip();
        $data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','insert','$jf_sql',now())";
        $db->query($jf_sql);
        $db->query($data_sql);
        $sql = "update $table set jfzt=1 where id=".escapeshellarg($id);
        $sql = str_replace("'","\"",$sql); 
        $data_sql1 = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','update','$sql',now())";
        $db->query($sql);
        $db->query($data_sql1);
         $db->query("COMMIT");
    }
    $qrxslb .=$bminfo['sfzh'].",";
 
}
$max_sql = "select max(jfqrcs)+1 as m from tf_classname where bh='".$classid."'";
       
$max_qrcs = $db->getOne($max_sql);
//print_r($max_qrcs);
$m = empty($max_qrcs['m'])?1:$max_qrcs['m'];

$db->query("BEGIN"); //或者mysql_query("START TRANSACTION");
$cn_in_sql = "insert into tf_classname(kskm,bh,qrxslb,qrxsrs,jfdh,jfqrcs) values('".$fid."','".$classid."','".$qrxslb."',".$counts.",'".$jfdh."','".$m."')";
$cn_in_sql = str_replace("'","\"",$jf_sql); 
 $ip = ip();
$data_sql2 = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','insert','$cn_in_sql',now())";
//echo $cn_in_sql;
$re=$db->query($cn_in_sql);
$db->query($data_sql2);
if($re>0)
{
    $db->query("COMMIT");
    msg("处理成功！","subok","baoming_list.php?fid=$fid");
}
else{
     $db->query("ROLLBACK");
     msg("处理失败！");
}
?>