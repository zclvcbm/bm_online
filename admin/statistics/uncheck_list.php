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

$fid = $_POST['fid'];
$stats = $_REQUEST['stats']==""?0:$_REQUEST['stats'];
//echo $stats;

$search=array('classid'=>'like');

$tsearch=getSearch($search);
$wsql=$tsearch[0];

//select DISTINCT(u.classid),count(f.sfzh) from form_4 f LEFT JOIN tf_users u 
//on  f.sfzh = u.username where jfzt=0 GROUP BY(u.classid)

?>
<div class="main" >
<div class="content" >
<div class="title">未确认班级</div>
<div class="imgButton">
<form action="uncheck_list.php" method="post" name="form1" > 
搜索：
科目：
<SELECT id='fid' name='fid'>
    <option></option>
    <?php 
        $kaoshi_sql = "select fname,k.fid from tf_kkhb k left join tf_form f on k.fid=f.fid order by id desc";
        $fnames = $db->getArray($kaoshi_sql);
        foreach ($fnames as $fname) {
            if($fid==$fname['fid'])
                echo "<option value='".$fname['fid']."' selected>".$fname['fname']."</option>";
            else
                echo "<option value='".$fname['fid']."'>".$fname['fname']."</option>";
        }
?>  
</SELECT>&nbsp;
班级:
<input type='text'  id='classid' name='classid'>
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
//echo $wsql;
if(!empty($fid))
{
//select kskm,bh,count(*) rs,sum(qrxsrs) counts from tf_classname where 1=1 and bh like '%%' group by kskm,bh limit 0,15
$sql="select DISTINCT(u.classid) as cid,count(f.sfzh) as rs from form_".$fid." f LEFT JOIN tf_users u 
on  f.sfzh = u.username $wsql and jfzt=0 GROUP BY(u.classid)";
//echo $sql;
$classes = $db->getArray($sql);
//print_r($classes);
$counts = count($classes);
//echo $counts;
$i=0;
$k=0;
for($j=1;$j<=$counts;$j++)
{
    
?>
<tr>
    <?php
        while($k<$counts&&$i++<5){
            $sql1 =  "select jfdh from ".$table." where bh='".$classes[$k]['bh']."' and kskm='".$classes[$k]['kskm']."' order by jfdh asc";
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
    <td><a target="_blank" href="ustudent_list.php?classid=<?=$classes[$k]['cid']?>&fid=<?=$fid?>"><?php echo $classes[$k]['cid']." ( ".$classes[$k]['rs']." 人 )";?></a></td>
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


$i=1;
while ($db->next_record()) {
        
    ?>
<tr >
<td><?php echo $i;?></td>
<td><?php echo $db->f("kskm")?></td>
<td><?php echo $db->f("cid")?></td>
<td><?php echo $db->f("rs")?></td>
<td>
    <a href="user_input.php?id=<?php echo $db->f("id")?>&stats=<?=$stats;?>"><b style='color:#09C'>详情</b></a>&nbsp;
    <a href="user_edit.php?id=<?php echo $db->f("id")?>">编辑</a>&nbsp;
    <a href="user_list.php?id=<?php echo $db->f("id")?>&del=1&stats=<?=$stats;?>" onclick="return confirm('确定要删除吗？');">删除</a>&nbsp;
</td>
</tr>
<?php
    $i++;
}
}
else
{
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