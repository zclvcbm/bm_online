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
require_once("../../lib/db_page.php");
//表名
$table="tf_admin";
//本文件名
$thisname="admin_list";

$db=new MySql();

//设置查询字段
$search=array("username" =>'like');

$tsearch=getSearch($search);
$wsql=$tsearch[0];
//总计录数
$sql="select count(*) counts from ".$table." $wsql";
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

$sql="select * from ".$table."  $wsql order by id desc limit $limits";
$db->query($sql);
$i=0;

//编辑页
$tedit=$thisname."_edit.php";
//导出页
$texec=$thisname."_execl.php";
//删除
$tlist=$thisname."_list.php";
?>
<div class="main" >
<div class="content" >
<div class="title">管理员列表</div>
<div class="imgButton">
<form action="" method="post" name="form1" > 
<input id="" name="edit" value="新增" onClick="location.href='admin_add.php';" class="edit" type="button">&nbsp;&nbsp;&nbsp;
<input id="" name="delete" value="删除" onclick="deleteAll('cadicateItems')" class="delete" type="button">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
搜索：用户名：<input  type="text" name="username" id="username" size="10" value="<?php echo $_POST['username'] ?>"/>
<input type="submit" name="seach" value="搜索" class="button">	 
</form>
</div>
</div>
<div class="list">
<table class="list" cellpadding="0" cellspacing="0">
<tbody>
<tr><td colspan="13" class="topTd" height="5"></td></tr>
<tr class="row">
<th style="vertical-align:middle;" >
    <input name="cadicateItemsAll" id="checkedAll" onClick="checkAll(this, 'cadicateItems')" type="checkbox">
</th>
<th>序号</th>
<th >用户名</th>
<th >管理员类别</th>
<th>添加时间</th>
<th>最后修改时间</th>
<th >操作</td>
</tr>
<?php
    $i=1;
    while ($db->next_record()) {
?>
<tr >
<td style="vertical-align:middle;">
    <input type="checkbox"  name="cadicateItems" onClick="checkItem(this, 'cadicateItemsAll')" value="<?php echo $db->f("id")?>">
</td>
<td><?php echo $i++;?></td>
<td><?php echo $db->f("username")?></td>
<td><?php echo $db->f("quanxian")?></td>
<td><?php echo $db->f("createtime") ?></td>
<td><?php echo $db->f("modtime") ?></td>
<td><a href="admin_edit.php?id=<?php echo $db->f("id"); ?>">编辑</a>&nbsp;<a href="admin_del.php?id=<?php echo $db->f("id")?>" onclick="return confirm('确定要删除吗？');">删除</a>&nbsp;</td>
</tr>
<?php
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
        window.location.href="admin_del_all.php?id="+id;
    }
 }
</script>