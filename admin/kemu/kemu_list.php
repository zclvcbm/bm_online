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

//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';

$fid = intval($fid);
if($action == 'delform') {
	$datalist = $db->getAll("SELECT id FROM tf_form_data WHERE fid=".escapeshellarg($fid)." ORDER BY id DESC");
	$typelist = $db->getAll("SELECT id FROM tf_form_type WHERE fid=".escapeshellarg($fid)." ORDER BY id DESC");
	if(count($datalist)) {
		foreach($datalist AS $v) {
			$dataid[] = $v['id'];
		}
		$dataid = implode(",", $dataid);
		$dataid = preg_replace("/([\d]+)/", "'\\1'", $dataid);
		$db->query("DELETE FROM tf_form_data WHERE id IN ($dataid)");
	}
	if(count($typelist)) {
		foreach($typelist AS $t) {
			$typeid[] = $t['id'];
		}
		$typeid = implode(",", $typeid);
		$typeid = preg_replace("/([\d]+)/", "'\\1'", $typeid);
		$db->query("DELETE FROM tf_form_type WHERE id IN ($typeid)");
	}
	
	$db->query("DELETE FROM tf_form WHERE fid='$fid'");
	msg('表单已删除', 'subok', '?action=formlist');
}elseif ($action == 'list') {
	$pageSize = 20;
	$currepage = ($_GET['page'] == '') ? 1 : intval($_GET['page']);
	$start = ($currepage - 1) * $pageSize;
	$num = $db->numRows("SELECT * FROM tf_form_data WHERE fid='$fid'");
	$list = $db->getAll("SELECT * FROM tf_form_data WHERE fid='$fid' ORDER BY id DESC LIMIT $start,$pageSize");
	echo showForm('formhead','?action=delmsg&fid='.$fid);
	echo '<table class="listtable" width="100%"><tr><td width="5%" align="center">删除</td><td width="85%" align="center">内容</td></tr>';
	
        foreach($list AS $key=>$v) {
		$addtime = date("Y-m-d", $list[$key]['addtime']);
		//$c ='O:1:"a":1:{s:5:"value";s:3:"100";}';//= unserialize($v['content']);
                //echo $c;
                //echo unserialize($c);
		echo '<tr><td width="5%" align="center"><input name="del[]" type="checkbox" value="'.$list[$key]['id'].' style="width:19px;height: 25px;"></td><td width="90%"><table width="100%">';
                if(count($c['title'])) {
			foreach($c['title'] AS $k => $title) {
				$content = $c['content'][$k];
				if(is_array($content)) {
					$content = implode(',', $content);
				}
				$content = str_replace("\r\n","<br>",$content);
				echo '<tr><td width="10%">'.$title.'</td><td width="90%">'.$content.'</td></tr>';
				
			}
		}
		echo '<tr><td width="10%"><b>提交日期</b></td><td width="90%">'.$addtime.'</td></tr></table>';

	}
	echo '</td></tr><tr><td width="10%" align="center"><input type="button" id="checkall1" value="全选"> <input type="button" id="checktog1" value="反选"></td><td width="90%"> <input type="submit" name="delmsg" value="删除所选">';
	echo '</td></tr></table>';
	echo '<div align="center">'.multi($num, $pageSize, $currepage,'admin.php?action=list&fid='.$fid).'</div><br />';
}

//表名
$table="tf_form";

$db=new MySql();

//删除
if ($_GET['del'] == 1 && empty($_GET['np']))
{
    /* 取得过滤条件 */
    $sql = 'delete from  '.$table.' where id='.escapeshellarg($_GET['id']);
    $res = $db->query($sql);
	 echo "<script>alert('删除成功');</script>";
}

//多个删除
if ($_GET['action'] == "del" && empty($_GET['np']))
{
	$delID=$_GET['id'];
	if(isset($delID) && $delID){
	     $ARY = explode(',',$delID);
        for($i=0; $i<count($ARY); $i++){
             $sql = 'delete from  '.$table.' where id='.intval($ARY[$i]);
			 $res = $db->query($sql);
        }
	    echo "<script>alert('删除成功');</script>";
	}
}

//处理
if ($_GET['st'] == 1  && empty($_GET['np']))
{
    /* 取得过滤条件 */

     $sql = 'update  '.$table.'  set stat=\''.$_REQUEST['stat'].'\'  where id='.escapeshellarg($_GET['id']);
    	$res = $db->query($sql);
     echo "<script>alert('处理成功');</script>";
}//设置查询字段
$search=array("fname" =>'like');

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

$sql="select * from ".$table."  $wsql order by fid desc limit $limits";
$db->query($sql);
$arrInfo=array();
$i=0;

?>
<div class="main" >
<div class="content" >
<div class="title">报名管理列表</div>
<div class="imgButton">
<form action="" method="post" name="form1" > 
<input id="" name="edit" value="新建" onClick="window.location.href='addform.php'" class="edit" type="button">
<input id="" name="delete" value="删除" onclick="deleteAll('cadicateItems')" class="delete" type="button">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
搜索：考试名称：<input  type="text" name="fname" id="realname" size="30" value="<?php echo $_POST['fname'] ?>"/>
<input type="submit" name="seach" value="搜索" class="button">	  
</div>
</div>
<div class="list">
<table class="list" cellpadding="0" cellspacing="0">
<tbody>
<tr><td colspan="12" class="topTd" height="5"></td></tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItemsAll" id="checkedAll" onClick="checkAll(this, 'cadicateItems')" type="checkbox"></th>
<th >序号</th>
<th>考试科目名称</th>
<th>添加时间</th>
<th >操作</td>
</tr>
 <?php
    $i=1;
    while($db->next_record()){
        //查询form_i是否已经创建
        $db2 = new MySql();
        $table_sql = "select count(TABLE_NAME) from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA='sqb' and TABLE_NAME='form_".$db->f("fid")."'";
        $num = $db2->getValue($table_sql);
 ?>
<tr >
<td style="vertical-align:middle;">
    <input type="checkbox"  name="cadicateItems" onClick="checkItem(this, 'cadicateItemsAll')" value="<?php echo $db->f("fid")?>">
</td>
<td><?php echo $i++; ?></td>
<td ><?php echo $db->f("fname");?></td>
<td><?php echo date('Y-m-d H:m:s',$db->f("addtime"))?></td>
<td><a href="kemu_edit.php?fid=<?php echo $db->f("fid")?>">编辑&nbsp</a>|
    <a href="listoption.php?fid=<?php echo $db->f("fid")?>">选项列表&nbsp</a>|
    <a href="kemu_list.php?action=delform&fid=<?php echo $db->f("fid")?>" onclick="return confirm('确定要删除吗？');">删除&nbsp</a>|
    <?php 
        $message = "'对应的数据表已经存在，如果创建原表及其数据将会被覆盖，确定创建？'";
        if($num>0)
            echo '<a href="createform.php?fid='.$db->f("fid").'" onclick="return confirm('.$message.')"/>创建表</a>';
        else
            echo '<a href="createform.php?fid='.$db->f("fid").'"/>创建表</a>';
   ?>
</td>
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
        window.location.href="kemu_del_all.php?id="+id;
    }
 }
</script>
