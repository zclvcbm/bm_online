<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>
<script type="text/javascript" src="../table.js"></script>
<?php
//设置工程相对路径
require_once("../../data/dconfig.php");
require_once("../../lib/config.php");
require_once("../../lib/fun_com.php");

require_once("../ifadmin.php");
//加载分页文件
require_once("../../lib/db_page.php");
//表名
$table="tf_cj";
//本文件名
$thisname="cj_list";

$db=new MySql();

//删除
if ($_GET['del'] == 1 && empty($_GET['np']))
{
    /* 取得过滤条件 */
    $sql = 'delete from  '.$table.' where id='.escapeshellarg($_GET['id']);
    $res = $db->query($sql);
    if($db->affected_rows()>0)
	 echo "<script>alert('删除成功');</script>";
}

//处理
if ($_GET['st'] == 1 && empty($_GET['np'])) {
    /* 取得过滤条件 */

    $sql = 'update  ' . $table . '  set stat=\'' . intval($_REQUEST['stat']). '\'  where id='.escapeshellarg($_GET['id']);
    $res = $db->query($sql);
    if($db->affected_rows()>0)
        echo "<script>alert('处理成功');</script>";
}
//设置查询字段
$search=array("mc" =>'like','sfzh' =>'like');

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

//$sql="select z.id as zid,z.mc,z.level,z.sfzh,z.zkzh,u.* from ".$table." z left join tf_users u on z.sfzh=u.username  $wsql order by z.id desc limit $limits";
$sql="select c.*,u.name,u.sex from ".$table."  c left join tf_users u on c.sfzh=u.username $wsql order by id desc limit $limits";
//echo $sql;
$db->query($sql);

$i=0;

//导入页
$texec=$thisname."_execl_dr.php";
?>
<div class="main" >
<div class="content" >
<div class="title">成绩列表</div>
<div class="imgButton">
<form action="" method="post" name="form1" > 
<input type="button" name="edit" value="下载样表" onClick="location.href='cj.rar'"  class="button small">
<input type="button" name="edit" value="导入excel" onClick="location.href='excel_upload.php?type=cj'"  class="button small">
<input type="button" name="edit" value="手动录入" onClick="location.href='cj_add.php'"  class="button small">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
身份证号:<input type='text'  name='sfzh'></input>
选择科目：<SELECT id='mc' name='mc'>
    <option value=''>所有</option>
  <?php 
        $db1 = new MySql();
        $kaoshi_sql = "select fname from tf_kkhb k left join tf_form f on k.fid=f.fid order by id desc";
        $fnames = $db1->getArray($kaoshi_sql);
        print_r($fnames);
        foreach ($fnames as $fname) {
            if($_POST['mc']==$fname['fname'])
                echo "<option value='".$fname['fname']."' selected>".$fname['fname']."</option>";
            else
                echo "<option value='".$fname['fname']."'>".$fname['fname']."</option>";
        }
?>
</SELECT>
<input type="submit" name="seach" value="搜索" class="button">&nbsp;&nbsp;
<input type="button" name="edit" value="清空本科目成绩" onClick="deleteAll()"  class="button1 small">
</form>
</div>
</div>
<div class="list">
<table class="list" cellpadding="0" cellspacing="0">
<tbody>
<tr><td colspan="14" class="topTd" height="5"></td></tr>
<tr class="row">
<th>姓名</th>
<th>性别</th>
<th>名称</th> 
<th>等级</th> 
<th>身份证号</td>
<th>证书编号</th>
<th>联系电话</td>
<th>准考证号</td>
<th>理论成绩</td>
<th>技能成绩</td>
<th>评审成绩</td>
<th>综合成绩</td>
<th>成绩状态</th>
<th >操作</th>
</tr>
<?php
    while ($db->next_record()) {
?>
<tr >
<td><?php echo $db->f("name")?></td>
<td><?php echo $db->f("sex")?></td>
<td><?php echo $db->f("mc")?></td>
<td><?php echo $db->f("level")?></td>
<td><?php echo $db->f("sfzh")?></td>
<td><?php echo $db->f("zsbh")?></td>
<td><?php echo $db->f("lxdh")?></td>
<td><?php echo $db->f("zkzh")?></td>
<td><?php echo $db->f("cj1")?></td>
<td><?php echo $db->f("cj2")?></td>
<td><?php echo $db->f("cj3")?></td>
<td><?php echo $db->f("cj4")?></td>
<td><?php if($db->f("cj_stats")==1) echo "合格"; else echo "不合格";?></td>
<td><a href="cj_input.php?id=<?php echo $db->f("id")?>"><b style='color:#09C'>详情</b></a>&nbsp;<a href="cj_list.php?id=<?php echo $db->f("id")?>&del=1" onclick="return confirm('确定要删除吗？');">删除</a>&nbsp;</td>
</tr>
<?php
        $i++;
    }
?>
<tr><td colspan="14" class="bottomTd" height="5"></td></tr></tbody></table>

</div>
<div class="page"><?php echo $pageNav;?></div>
</div>
<script>

function deleteAll()
{
	var mc=document.getElementById('mc').value;
	if(mc=="")
	{
		alert("请先选择具体科目！");
		return;
	}
	window.location.href='cj_del_all.php?mc='+mc;
}
</script>