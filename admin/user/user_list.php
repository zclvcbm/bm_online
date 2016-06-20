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
require_once("$root_path/lib/fun_html.php");

require_once("../ifadmin.php");
//加载分页文件
require_once($root_path."/lib/db_page.php");
//表名
$table="tf_users";

session_start();

$db=new MySql();

$stats = $_REQUEST['stats']==""?0:$_REQUEST['stats'];
//echo $stats;

//删除
if ($_GET['del'] == 1)
{
    $db->query("BEGIN"); //或者mysql_query("START TRANSACTION")
    /* 取得过滤条件 */
    $sql = 'delete from  '.$table.' where id='.escapeshellarg($_GET['id']);
    $sql = str_replace("'","\"",$sql); 
    $ip = ip();
    $data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[admin]','$ip','delete','$sql',now())";
    $db->query($sql);
    $db->query($data_sql);
    if($db->affected_rows()>0)
    {
        $db->query("COMMIT");
	echo "<script>alert('删除成功!');window.location.href='user_list.php?stats=".$stats."'</script>";
    }else{
        $db->query("ROLLBACK");
        echo "<script>alert('删除失败!');window.location.href='user_list.php?stats=".$stats."'</script>";
    }
}

$search=array("name" =>'like',"tel" => 'like',"stats"=>"=");

$tsearch=getSearch($search);
$wsql=$tsearch[0];
//总计录数
$sql="select count(*) counts from ".$table." $wsql";
//echo $sql;
$infoCounts=$db->getValue($sql);

if($_REQUEST['numperpage']=="")
{
    $pagenums=15; 
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

//$sql="select * from ".$table."  $wsql order by convert( name USING gbk ) COLLATE gbk_chinese_ci limit $limits";
$sql="select * from ".$table."  $wsql order by modtime limit $limits";

$db->query($sql);

$i=0;

?>
<div class="main" >
<div class="content" >
<div class="title">用户列表</div>
<div class="imgButton">
<form action="user_list.php" method="post" name="form1" > 
<input id="" name="add" value="新增" onClick="location.href='user_add.php?stats=<?=$stats?>'" class="add" type="button"/>
<input id="" name="delete" value="删除" onClick="deleteAll('cadicateItems',<?php echo $stats;?>);" class="delete" type="button"/>
<!--<input type="button" name="edit" value="&nbsp;&nbsp;导入execl" onClick=""  class="button small" />-->
<input type="button" name="edit" value="更新照片状态" onClick="location.href='user_upload_pic.php'" class="button1"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
搜索：姓名：<input  type="text" name="name" id="realname" size="10" value="<?php echo $_POST['name'] ?>"/>&nbsp;
或联系方式：<input  type="text" name="tel" id="tel"  size="10" value="<?php echo $_POST['tel'] ?>"/>&nbsp;
审核状态:
<SELECT id='status' name='stats'>
 <OPTION value="0" <?php if($stats==0&&$stats!='') echo 'selected';?>>未审核</OPTION> 
 <OPTION value="1" <?php if($stats==1) echo 'selected';?>>审核通过</OPTION>
 <OPTION value="2" <?php if($stats==2) echo 'selected';?>>审核未通过</OPTION>
</SELECT>
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
<th style="vertical-align:middle;" >
    <input name="cadicateItemsAll" id="checkedAll" onClick="checkAll(this, 'cadicateItems')" type="checkbox">
</th>
<th>姓名</th>
<th >身份证号</th>
<th >班号</th>
<th >学号</th>
<th >邮箱</th>
<th >性别</th>
<th >电话</th>
<th >QQ</th>
<th >地址</th>
<th >照片审核状态</th>
<th >操作</th>
</tr>
<?php
while ($db->next_record()) {
    ?>
<tr >
<td style="vertical-align:middle;">
    <input type="checkbox"  name="cadicateItems" onClick="checkItem(this, 'cadicateItemsAll')" value="<?php echo $db->f("id")?>">
</td>
<td><?php echo $db->f("name")?></td>
<td><?php echo $db->f("username")?></td>
<td><?php echo $db->f("classid")?></td>
<td><?php echo $db->f("studentid")?></td>
<td><?php echo $db->f("email")?></td>
<td ><?php echo $db->f("sex")?></td>
<td ><?php echo $db->f("tel")?></td>
<td ><?php echo $db->f("qq")?></td>
<td ><?php echo $db->f("address")?></td>
<td ><?php $s=$db->f("stat"); if($s==0) echo "未审核"; else if($s==1) echo "审核通过"; else if($s==2) echo "审核未通过";?></td>
<td>
    <a href="user_input.php?id=<?php echo $db->f("id")?>&stats=<?=$stats;?>"><b style='color:#09C'>详情</b></a>&nbsp;
    <a href="user_edit.php?id=<?php echo $db->f("id")?>">编辑</a>&nbsp;
    <a href="user_list.php?id=<?php echo $db->f("id")?>&del=1&stats=<?=$stats;?>" onclick="return confirm('确定要删除吗？');">删除</a>&nbsp;
</td>
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
 function deleteAll(itemName,stats)
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
        window.location.href="user_del_all.php?id="+id+"&stats="+stats;
    }
 }
</script>