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

$fid = intval($_REQUEST['fid']);

$db=new MySql();

//删除
if ($_GET['del'] == 1 && empty($_GET['np']))
{
    /* 取得过滤条件 */
    $sql = 'delete from  tf_guidang where id='.escapeshellarg($_GET['id']);
    $res = $db->query($sql);
    if($db->affected_rows()>0)
        echo "<script>alert('删除成功');window.location.href='gd_list.php</script>";
}

//设置查询字段
$search=array("kskm"=>'like',"year"=>'like',"classid" =>'like',"name" => 'like',"sfzh"=>'like',"cj_stats"=>'like');

$tsearch=getSearch($search);
$wsql=$tsearch[0];

//总计录数

    $sql="select count(*) counts from tf_guidang $wsql";
    //echo $sql;
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


    //这里需要先选择科目，然后读取相应科目
    $sql="select * from tf_guidang  $wsql limit $limits";
    echo $sql;
    $db->query($sql);

    $i=0;

?>
<div class="main" >
<div class="content" >
<div class="title">归档记录列表</div>
<div class="imgButton">
<form action="" method="post" name="form1" >
<input id="" name="delete" value="删除" onClick="deleteAll('cadicateItems')" class="delete" type="button">
<input type="button" value="&nbsp;导出execl&nbsp;" onClick="location.href='gd_excel_download.php'"  class="button small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
搜索：考试名称
<SELECT name='kskm'>
<?php 
        $db1 = new MySql();
        $kaoshi_sql = "select fname,k.fid from tf_kkhb k left join tf_form f on k.fid=f.fid order by id desc";
        $fnames = $db1->getArray($kaoshi_sql);
        
        echo "<option value=''></option>";
        foreach ($fnames as $fname) {
               echo "<option value='".$fname['fname']."'>".$fname['fname']."</option>";
        }
?>  
</SELECT>
年份：<input  type="text" name="year"  size="10" value="<?php echo $_POST['year'] ?>"/>&nbsp;
班级：<input  type="text" name="classid" size="10" value="<?php echo $_POST['class'] ?>"/>&nbsp;
姓名：<input  type="text" name="name" size="10" value="<?php echo $_POST['name'] ?>"/>&nbsp;
身份证号：<input  type="text" name="sfzh" size="10" value="<?php echo $_POST['sfzh'] ?>"/>&nbsp;
成绩状态：<select name="cj_stats">
    <option value=""></option>
    <option value="合格">合格</option>
    <option value="不合格">不合格</option>
</select>
<input type="submit" name="seach" value="搜索" class="button">
</form>
</div>
</div>
<div class="list">
<table class="list" cellpadding="0" cellspacing="0">
<tbody>
<tr><td colspan="18" class="topTd" height="5"></td></tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItemsAll" id="checkedAll" onClick="checkAll(this, 'cadicateItems')" type="checkbox"></th>
<th >考试科目</th>
<th>年份</th>
<th>次数</th>
<th>报考级别</th>
<th>姓名</th>
<th>身份证号</th>
<th>班号</th>
<th>学号</th>
<th>联系电话</th>
<th>准考证号</th> 
<th>证书编号</th> 
<th>成绩一</th>
<th>成绩二</th>
<th>成绩三</th>
<th>成绩四</th>
<th>成绩状态</th>
<th >操作</td>
</tr>
<?php
        while ($db->next_record()) {
            //$fy = $db->f("ksfy")+$db->f("pxfy");
?>
<tr >
<td style="vertical-align:middle;">
    <input type="checkbox"  name="cadicateItems" onClick="checkItem(this, 'cadicateItemsAll')" value="<?php echo $db->f("id");?>">
</td>
<td><?php echo $db->f("kskm")?></td>
<td><?php echo $db->f("year")?></td>
<td><?php echo $db->f("counts")?></td>
<td><?php echo $db->f("bkjb")?></td>
<td><?php echo $db->f("name")?></td>
<td><?php echo $db->f("sfzh")?></td>
<td><?php echo $db->f("classid")?></td>
<td><?php echo $db->f("studentid")?></td>
<td><?php echo $db->f("lxdh")?></td>
<td><?php echo $db->f("zkzh")?></td>
<td><?php echo $db->f("zsbh")?></td>
<td><?php echo $db->f("cj1")?></td>
<td><?php echo $db->f("cj2")?></td>
<td><?php echo $db->f("cj3")?></td>
<td><?php echo $db->f("cj4")?></td>
<td><?php echo $db->f("cj_stats")?></td>				
<td><a href="gd_list.php?id=<?php echo $db->f('id')?>&del=1" onclick="return confirm('确定要删除吗？');">删除</a>&nbsp;</td>
</tr>
<?php
    $i++;
}
?>
<tr><td colspan="18" class="bottomTd" height="5"></td></tr></tbody></table>

</div>
<div class="page"><?php echo $pageNav;?></div>
</div>
<script>
function selectChanged(id,fid,jfzt)
{
    window.location.href="baoming_list.php?st=1&id="+id+"&fid="+fid+"&jfzt="+jfzt;
}
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
        window.location.href="gd_del_all.php?id="+id;
    }
 }
 function dealAll(itemName,fid)
 {
    if(confirm('确定要批量处理吗？'))
    {
        var items = document.getElementsByName(itemName);
        var id="";
        var fy="";
        for (var i=0; i<items.length; i++)
        {
            if(items[i].checked)
            {
                var values = items[i].value.split("_");
                id +=values[0]+",";
                fy +=values[1]+",";
            }
        }
        window.location.href="baoming_deal_all.php?id="+id+"&fid="+fid+"&fy="+fy;
    }  
 }
</script>
