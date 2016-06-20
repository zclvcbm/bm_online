<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>
<script type="text/javascript" src="../table.js"></script>
<?php
//设置工程相对路径
$root_path="../..";
require_once("$root_path/data/dconfig.php");
require_once("$root_path/lib/config.php");
require_once("$root_path/lib/fun_com.php");

require_once("../ifadmin.php");
//加载分页文件
require_once($root_path."/lib/db_page.php");
//表名
$table="tf_classname";


$db=new MySql();

$kskm = $_GET['kskm'];
$classid = $_GET['bh'];


//总计录数
$sql="select qrxslb from ".$table." where kskm='".$kskm."' and bh='".$classid."'";

$qrxslb = $db->getArray($sql);
$sfzhs = array();
foreach ($qrxslb as $student) {
        //print_r($student['qrxslb']);
        $sfs=  explode(',', $student['qrxslb']);
        //print_r($sfzhs);
        foreach ($sfs as $sfzh) {
            if(!empty($sfzh))
            {
                $sfzhs[] = $sfzh;
            }
        }
}
//print_r($sfzhs);
$i=0;

?>
<div class="main" >
<div class="content" >
<div class="title">已经确认学生信息列表</div>
</div>
<div class="list">
<table class="list" cellpadding="0" cellspacing="0">
<tbody>
<tr><td colspan="12" class="topTd" height="5"></td></tr>
<tr class="row">
<th>序号</th>    
<th>姓名</th>
<th>班号</th>
<th>学号</th>
<th>联系方式</th>
<th>qq</th>
<th>email</th>
</tr>
<?php
$i=1;
foreach ($sfzhs as $sfzh) {

$student = $db->getOne("select * from tf_users where username='".$sfzh."'");
        //print_r($student);
    ?>
<tr >
<td><?php echo $i;?></td>
<td><?php echo $student["name"]?></td>
<td><?php echo $student["classid"]?></td>
<td><?php echo $student["studentid"]?></td>
<td><?php echo $student["tel"]?></td>
<td><?php echo $student["qq"]?></td>
<td><?php echo $student["email"]?></td>
</tr>
<?php
    $i++;
}
?>
<tr><td colspan="13" class="bottomTd" height="5"></td></tr></tbody></table>

</div>
<div class="page"><?php echo $pageNav;?></div>
</div>
<script>
function excel()
{
    window.location.href="exam_excel_download.php";
}
</script>