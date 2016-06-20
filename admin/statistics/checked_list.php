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

$forms_sql = "select fid,fname from tf_form";
$forms=$db->getArray($forms_sql);
//print_r($forms);
$fs = array();
foreach ($forms as $key => $form) {
    $fs[$form['fid']] = $form; 
}
//print_r($fs);

$kskm = $_POST['kskm'];
$bh = $_POST['bh'];

$stats = $_REQUEST['stats']==""?0:$_REQUEST['stats'];
//echo $stats;

//删除
if ($_GET['del'] == 1)
{
    /* 取得过滤条件 */
    $sql = 'delete from  '.$table.' where id='.escapeshellarg($_GET['id']);
    $res = $db->query($sql);
    if($db->affected_rows()>0)
	echo "<script>alert('删除成功!');window.location.href='user_list.php?stats=".$stats."'</script>";
}

$search=array("bh" =>'like','kskm'=>'like');

$tsearch=getSearch($search);
$wsql=$tsearch[0];
//总计录数
$sql="select count(*) counts from ".$table." $wsql"." group by kskm,bh ";
//echo $sql;
$infoCounts=$db->getValue($sql);

if($_REQUEST['numperpage']=="")
{
    $pagenums=1000; 
}
else
{
    $pagenums=$_REQUEST['numperpage'];
}

//分页类
$p = new ShowPage;
//设置查询变量
$p->setvar($tsearch[1],$pagenums);
//设置每页显示条数

$p->set($pagenums,$infoCounts);
//输出分页
$pageNav=$p->output(1);
//查询每几条到第几条
$limits=$p->limit();
//册除用的.返回页面地址.
$_SESSION['CURPAGE']=$p->CurrentUrl;

$i=0;

?>
<div class="main" >
<div class="content" >
<div class="title">已经确认班级</div>
<div class="imgButton">
<form action="checked_list.php" method="post" name="form1" > 
搜索：
科目：
<SELECT id='kskm' name='kskm'>
    <option value=''></option>
    <?php 
        $km_sql = "select distinct(kskm)  from tf_classname ";
        
        $kms = $db->getArray($km_sql);
        foreach ($kms as $km) {
            if($kskm==$km['kskm'])
                echo "<option value='".$fs[$km['kskm']]['fid']."' selected>".$fs[$km['kskm']]['fname']."</option>";
            else
                echo "<option value='".$fs[$km['kskm']]['fid']."'>".$fs[$km['kskm']]['fname']."</option>";
        }
?>  
</SELECT>&nbsp;
班级:
<input type="text" id='bh' name='bh'>
每页显示条数：<input type='text' name='numperpage' size='4'>
<input type="submit" name="seach" value="搜索" class="button">
</form>
</div>
</div>
<div class="list">
<table class="list" cellpadding="0" cellspacing="0">
<tbody>
<tr><td colspan="12" class="topTd" height="5"></td></tr>
<tr class="row">
</tr>
<?php

//select kskm,bh,count(*) rs,sum(qrxsrs) counts from tf_classname group by kskm,bh
$sql="select kskm,bh,max(jfqrcs) cs,sum(qrxsrs) rs from ".$table."  $wsql group by kskm,bh  order by id desc  limit $limits";
//echo $sql;
$classnames = $db->getArray($sql);
$counts = count($classnames);
//echo $counts;
$i=0;
$k=0;
for($j=1;$j<=$counts;$j++)
{
    
?>
<tr>
    <?php
        while($k<$counts&&$i++<5){
            $sql1 =  "select jfdh from ".$table." where bh='".$classnames[$k]['bh']."' and kskm='".$classnames[$k]['kskm']."' order by jfdh asc";
            //echo $sql1;
            $results = $db->getArray($sql1);
            $res = array();
            foreach ($results as $result) {
                $res[] = $result['jfdh'];
            }
            //print_r($res);
            //die();
            $dhlb = implode('+', $res);
            //echo $dhlb;
           
    ?>
    <td><a target="_blank" href="student_list.php?bh=<?=$classnames[$k]['bh']?>&kskm=<?=$classnames[$k]['kskm']?>"><?php echo $classnames[$k]['bh']." ( ".$classnames[$k]['cs']." 次, ".$classnames[$k]['rs']." 人, ".$dhlb." (缴费单号) )";?></a></td>
    <?php
            $k++;
            if($i==5)
            {
                $i=0;
                break;
            }
        }
    ?>
</tr>
<?php
}
?>
<tr><td colspan="13" class="bottomTd" height="5"></td></tr></tbody></table>

</div>
<div class="page"></div>
</div>
<script>
function excel()
{
    window.location.href="exam_excel_download.php";
}
</script>