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
$table="tf_zkzh";
//本文件名
$thisname="zkz_list";

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

//设置查询字段
$search=array("mc" =>'like',"sfzh" => 'like');

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
// select * from tf_zkzh z left join tf_users u on z.sfzh=u.username
$sql="select z.*,u.name,u.sex,u.email,u.tel from ".$table." z left join tf_users u on z.sfzh=u.username  $wsql order by z.id desc limit $limits";
$db->query($sql);
$i=0;

//导出页
$texec=$thisname."_execl.php";
      
?>
<div class="main" >
<div class="content" >
<div class="title">准考证列表</div>
<div class="imgButton">
<form action="" method="post" name="form1" > 
<input type="button" name="edit" value="下载样表" onClick="location.href='zkzh_example.xls'"  class="button small">
<input type="button" name="edit" value="&nbsp;&nbsp;导入excel" onClick="location.href='excel_upload.php?type=zkzh'"  class="button small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
身份证号:<input type='text'  name='sfzh'></input>
选择科目：<SELECT id='mc' name='mc'>
    <option value=''>所有</option>
<?php 
        $db1 = new MySql();
        $kaoshi_sql = "select fname from tf_kkhb k left join tf_form f on k.fid=f.fid order by id desc";
        $fnames = $db1->getArray($kaoshi_sql);
        foreach ($fnames as $fname) {
            if($_POST['mc']==$fname['fname'])
                echo "<option value='".$fname['fname']."' selected>".$fname['fname']."</option>";
            else
                echo "<option value='".$fname['fname']."'>".$fname['fname']."</option>";
        }
?>
</SELECT>
<input type="submit" name="seach" value="搜索" class="button">&nbsp;&nbsp;
<input type="button" name="edit" value="清空本科准考证" onClick="deleteAll()"  class="button1 small">
</form>
</div>
</div>
<div class="list">
<table class="list" cellpadding="0" cellspacing="0">
<tbody>
<tr><td colspan="12" class="topTd" height="5"></td></tr>
<tr class="row">
<th>姓名</th>
<th>性别</th>
<th>名称</th> 
<th>等级</th> 
<th>考试时间</th>
<th>考试地点</th>
<th>身份证号</th>
<th>联系电话</th>
<th>准考证号</th>
<th >操作</td>
</tr>
<?php
while ($db->next_record()) {
    ?>
    <tr >
        <td><?php echo $db->f("name") ?></td>
        <td><?php echo $db->f("sex") ?></td>
        <td><?php echo $db->f("mc") ?></td>
        <td><?php echo $db->f("level") ?></td>
        <td><?php echo $db->f("llkssj") ?></td>
        <td><?php echo $db->f("llksdd") ?></td>
        <td><?php echo $db->f("sfzh") ?></td>
        <td><?php echo $db->f("tel") ?></td>
        <td><?php echo $db->f("zkzh") ?></td>

        <td><a  href="zkz_input.php?id=<?php echo $db->f("id") ?>"><b style='color:#09C'>详情</b></a>&nbsp;<a href="zkz_list.php?id=<?php echo $db->f("id") ?>&del=1" onclick="return confirm('确定要删除吗？');">删除</a>&nbsp;</td>
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
function deleteAll()
{
	var mc=document.getElementById('mc').value;
	if(mc=="")
	{
		alert("请先选择具体科目！");
		return;
	}
	window.location.href='zkz_del_all.php?mc='+mc;
}
</script>