    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>
<script type="text/javascript" src="../table.js"></script>
<?php
//设置工程相对路径
$root_path="../../";
require_once("$root_path/data/dconfig.php");
require_once("$root_path/lib/config.php");
require_once("$root_path/lib/fun_com.php");

require_once("../ifadmin.php");

//加载分页文件
require_once($root_path."lib/db_page.php");

require_once($root_path."lib/fun_html.php");

//表名
$table="tf_kkhb";

$db=new MySql();

//更改状态
if ($_GET['action']=="update" && empty($_GET['np']))
{
    $updateID=$_GET['id'];
    $printable=$_GET['printable'];
    $printable = $printable==1?0:1;
    
    $db->query("BEGIN"); //或者mysql_query("START TRANSACTION")
    $ip = ip();
    if(isset($updateID) && $updateID){
        $sql = 'update '.$table.' set printable='.$printable.' where id='.intval($updateID);
        $sql = str_replace("'","\"",$sql); 
        $data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','update','$sql',now())";
        $res = $db->query($sql);
        $db->query($data_sql);
    }
    $db->query("COMMIT");
}

//多个删除
if ($_GET['action'] == "del" && empty($_GET['np']))
{
	$delID=$_GET['id'];
	if(isset($delID) && $delID){
             $db->query("BEGIN"); //或者mysql_query("START TRANSACTION")
             $ip = ip();
	     $ARY = explode(',',$delID);
            for($i=0; $i<count($ARY); $i++){
                
                 $sql = 'delete from  '.$table.' where id='.intval($ARY[$i]);
                 $sql = str_replace("'","\"",$sql); 
                 $res = $db->query($sql);
                 $data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','delete','$sql',now())";
                 $db->query($data_sql);
            }
            $db->query("COMMIT");
	    echo "<script>alert('删除成功');</script>";
	}
}
//删除
if ($_GET['del'] == 1 && empty($_GET['np']))
{
     $db->query("BEGIN"); //或者mysql_query("START TRANSACTION")
     $ip = ip();
     /* 取得过滤条件 */
     $sql = 'delete from  '.$table.' where id='.escapeshellarg($_GET['id']);
     $sql = str_replace("'","\"",$sql); 
     $data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','delete','$sql',now())";
     $res = $db->query($sql);
     $db->query($data_sql);
     $db->query("COMMIT");
     echo "<script>alert('删除成功');</script>";
}

//处理
if ($_GET['st'] == 1  && empty($_GET['np']))
{
    /* 取得过滤条件 */
    $db->query("BEGIN"); //或者mysql_query("START TRANSACTION")
     $ip = ip();
     $sql = 'update '.$table.'  set stat=\''.$_REQUEST['stat'].'\'  where id='.escapeshellarg($_GET['id']);
     $sql = str_replace("'","\"",$sql); 
     $res = $db->query($sql);
     $data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','update','$sql',now())";
     $db->query($data_sql);
     $db->query("COMMIT");
     echo "<script>alert('处理成功');</script>";
}

//设置查询字段
$search=array("fname" =>'like',"yyyy" => 'like');

$tsearch=getSearch($search);
$wsql=$tsearch[0];
//总计录数
$sql = "SELECT count(*) FROM ".$table." k,tf_form f $wsql and k.fid=f.fid";
$infoCounts=$db->getValue($sql);
//分页类
$p = new ShowPage;
//设置查询变量
$p->setvar($tsearch[1]);
//设置每页显示条数
$pagenums=15;
$p->set($pagenums,$infoCounts);
//输出分页
$pageNav=$p->output(1);
//查询每几条到第几条
$limits=$p->limit();
//册除用的.返回页面地址.
$_SESSION['CURPAGE']=$p->CurrentUrl;

$sql="SELECT k.*,f.fname FROM ".$table." k,tf_form f $wsql and k.fid=f.fid order by id desc limit $limits";
$db->query($sql);
$i=0;

?>
<div class="main" >
<div class="content" >
<div class="title">考务管理列表</div>
<div class="imgButton">
<form action="" method="post" name="form1" > 
<input id="" name="add" value="新建" onClick="window.location.href='exam_add.php'" class="add" type="button">
<input id="" name="delete" value="删除" onclick="deleteAll('cadicateItems')" class="delete" type="button">
<input type="button" name="edit" value="&nbsp;&nbsp;导出execl" onClick="excel()"  class="button small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
搜索：考试科目：<input  type="text" name="fname" id="fid" size="30" value="<?php echo $_POST['fname'] ?>"/>&nbsp;或年份：<input  type="text" name="yyyy" id="yyyy"  size="10" value="<?php echo $_POST['yyyy'] ?>"/>
<input type="submit" name="seach" value="搜索" class="button">
</form>
</div>
</div>
<div class="list">
<table class="list" cellpadding="0" cellspacing="0">
<tbody>
<tr><td colspan="12" class="topTd" height="5"></td></tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItemsAll" id="checkedAll" onClick="checkAll(this, 'cadicateItems')" type="checkbox"></th>
<th >考试科目</th>
<th>年份</th>
<th>次数</th>
<th>最大报名人数</th>
<th >报名开始日期</th> 
<th >报名截止日期</th> 
<th >缴费开始日期</td>
<th>缴费截止日期</td>
<th>是否允许班级打印</th>
<th >操作</td>
</tr>
 <?php
	while($db->next_record()){
 ?>
<tr >
<td style="vertical-align:middle;"><input type="checkbox"  name="cadicateItems" onClick="checkItem(this, 'cadicateItemsAll')" value="<?php echo $db->f("id")?>"></td>
<td ><?php echo $db->f("fname")?></td>
<td><?php echo $db->f("yyyy")?></td>
<td ><?php echo $db->f("counts"); ?></td>
<td ><?php echo $db->f("maxnum"); ?></td>
<td ><?php echo $db->f("start_time");?></td>
<td ><?php echo $db->f("end_time");?></td>
<td ><?php echo $db->f("subs_time");?></td>
<td ><?php echo $db->f("sube_time");?></td>
<td><a href="examslist.php?id=<?php echo $db->f("id")?>&action=update&printable=<?php echo $db->f("printable");?>"><?php if($db->f("printable")==1) echo "是"; else echo "否";?></a></td>
<td><a  href="exam_edit.php?id=<?php echo $db->f("id")?>&fid=<?php echo $db->f("fid")?>"><b style='color:#09C'>编辑</b></a>&nbsp;<a  href="exam_del.php?id=<?php echo $db->f("id")?>" onclick="return confirm('确定要删除吗？');">删除</a>&nbsp;<a  href="exam_guidang.php?id=<?php echo $db->f("id")?>&fid=<?=$db->f("fid")?>" onclick="return confirm('确定要要归档吗？');">归档</a>&nbsp;</td>
</tr>
<?php
				  	$i++;
				}	
				  ?>
<tr><td colspan="12" class="bottomTd" height="5"></td></tr></tbody></table>

</div>
<div class="page"><?php echo $pageNav;?></div>
</div>
<script>
function checkAll(item, itemName)
{
  var items = document.getElementsByName(itemName);  
  for (var i=0; i<items.length; i++)
  items[i].checked = item.checked;
}

function checkItem(itemName, allName)
{
  var all = document.getElementsByName(allName)[0];
  if(!itemName.checked) all.checked = false;
  else
  {
    var items = document.getElementsByName(itemName.name);
    for (var i=0; i<items.length; i++)
     if(!items[i].checked) return;
    all.checked = true;
  }
}
 function excel()
{
    window.location.href="exam_excel_download.php";
 }
 function deleteAll(itemName)
 {
     if(confirm('确定要删除吗？'))
    {
        var items = document.getElementsByName(itemName);
        var id="";
        for (var i=0; i<items.length; i++)
        {
            if(items[i].checked)
            id +=items[i].value+",";
        }
        window.location.href="exam_del_all.php?id="+id;
    }
 }
</script>