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
$table="tf_paylist";

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
$search=array('sfzh' =>'like');

$tsearch=getSearch($search);
$wsql=$tsearch[0];

$fid = $_REQUEST['fid'];

//总计录数
if(empty($fid))
    $sql = "select count(*) counts from tf_paylist " . $wsql;
else
    $sql = "select count(*) counts from tf_paylist " .$wsql." and sfzh IN (select sfzh from form_".$fid.")";
    

$infoCounts=$db->getValue($sql);
//echo $infoCounts;
//分页类
$p = new ShowPage;
//设置查询变量
//设置每页显示条数
$pagenums=15;
$tsearch[1]['fid'] = $fid; 

$p->setvar($tsearch[1],$pagenums);
$p->set($pagenums,$infoCounts);
//输出分页
$pageNav=$p->output(1);
//查询每几条到第几条
$limits=$p->limit();
//册除用的.返回页面地址.
$_SESSION['CURPAGE']=$p->CurrentUrl;

//$sql="select z.id as zid,z.mc,z.level,z.sfzh,z.zkzh,u.* from ".$table." z left join tf_users u on z.sfzh=u.username  $wsql order by z.id desc limit $limits";
//$sql="select p.*,u.studentid,u.classid,u.name,u.email,u.sex,u.age,u.tel,u.qq,u.address from tf_paylist p  left join tf_users u on p.sfzh=u.username where sfzh like '%".$_REQUEST['sfzh']."%'";


if(empty($fid))
    $sql = "select p.*,u.studentid,u.classid,u.name,u.email,u.sex,u.age,u.tel,u.qq,u.address from tf_paylist p  left join tf_users u on p.sfzh=u.username " . $wsql . " order by id desc limit $limits";
else
        $sql = "select p.*,u.studentid,u.classid,u.name,u.email,u.sex,u.age,u.tel,u.qq,u.address from tf_paylist p  left join tf_users u on p.sfzh=u.username " . $wsql 
        ." and p.sfzh IN (select sfzh from form_".$fid.")"
        ." order by id desc limit $limits";

//echo $sql;
$db->query($sql);

$i=0;

?>
<div class="main" >
<div class="content" >
<div class="title">付款记录列表</div>
<div class="imgButton">
<form action="" method="post" name="form1" >
<input type="button" name="edit" value="导出excel" onClick="location.href='pay_excel_download.php?sfzh=<?=$_REQUEST['sfzh']?>&fid=<?=$fid?>'"  class="button small"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
身份证号:<input type='text'  name='sfzh' value="<?=$_REQUEST['sfzh']?>"></input>
选择科目：<SELECT id='fid' name='fid'>
    <option value=''>所有</option>
  <?php 
        $db1 = new MySql();
        $kaoshi_sql = "select fname,f.fid as fid from tf_kkhb k left join tf_form f on k.fid=f.fid order by id desc";
        $fnames = $db1->getArray($kaoshi_sql);
        print_r($fnames);
        foreach ($fnames as $fname) {
            if($_REQUEST['fid']==$fname['fid'])
                echo "<option value='".$fname['fid']."' selected>".$fname['fname']."</option>";
            else
                echo "<option value='".$fname['fid']."'>".$fname['fname']."</option>";
        }
?>
</SELECT>
<input type="submit" name="seach" value="搜索" class="button"/>&nbsp;&nbsp;
</form>
</div>
</div>
<div class="list">
<table class="list" cellpadding="0" cellspacing="0">
<tbody>
    <tr class="row">
        <th  align="center">序号</th>
        <th  align="center">报名号</th>
        <th  align="center">姓名</th>
        <th  align="center">身份证号</th>
        <th  align="center">交易事项</th>
        <th  align="center">交易流水号</th>
        <th  align="center">总金额</th>
        <th  align="center">付款日期</th> 
        <th  align="center">付款方式</th> 
        <th  align="center">操作</td>
    </tr>
        <?php
            $i=1;
            while ($db->next_record()) { 
        ?>
        <tr >
            <td  align="center"><?php echo $i ?></td>
            <td  align="center"><?php echo $db->f("applyid") ?></td>
            <td  align="center"><?php echo $db->f("name") ?></td>
            <td  align="center"><?php echo $db->f("sfzh") ?></td>
            <td  align="center"><?php echo $db->f("transaction") ?></td>
            <td  align="center"><?php echo $db->f("serialnumber") ?></td>
            <td  align="center"><?php echo $db->f("money") ?></td>
            <td  align="center"><?php echo $db->f("paytime") ?></td>
            <td  align="center"><?php echo $db->f("paymethod") ?></td>
            <td  align="center"><a href="paylist.php?act=list&id=<?php echo $db->f("id") ?>&del=1" onclick="return confirm('确定要删除吗？');">删除</a>&nbsp;</td>
        </tr>
        <?php
                $i++;
            }
        ?>
<tr>
    <td colspan="14" class="bottomTd" height="5"></td>
</tr>
</tbody>
</table>
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