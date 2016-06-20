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

$fid = $_REQUEST['fid'];

$db=new MySql();

//删除
if ($_GET['del'] == 1 && empty($_GET['np']))
{
    /* 取得过滤条件 */
    $sql = 'delete from  form_'.intval($_GET['fid']).' where id='.escapeshellarg($_GET['id']);
    $res = $db->query($sql);
    if($db->affected_rows()>0)
        echo "<script>alert('删除成功');window.location.href='baoming_list.php?fid=".intval($_GET['fid'])."'</script>";
}

//处理
if ($_GET['st'] == 1 && empty($_GET['np'])) {
    /* 取得过滤条件 */
    $sql = 'update  form_' . $_GET['fid'] . '  set jfzt=\'' . intval($_REQUEST['jfzt']). '\'  where id='.escapeshellarg($_GET['id']);
    $bm_sql = "select * from form_".$_GET['fid'].' where id='.escapeshellarg($_GET['id']);
    //echo $_REQUEST['jfzt'];
    //die();
    if($_REQUEST['jfzt']==1)
    {
        $bm_db = new MySql();
        $bminfo = $bm_db->getOne($bm_sql);
        $fy = $bminfo['ksfy']+$bminfo['pxfy'];
        //$paytime = date('Y-m-d H:m:s',time());
        $jf_sql = "insert into tf_paylist(applyid,sfzh,transaction,serialnumber,money,paytime,paymethod) values ('"
                .$bminfo['bmh']."','"
                .$bminfo['sfzh']."','"
                .$bminfo['kskm']."','"
                .""."',"
                .$fy.",now(),'"
                ."现场缴费')";
        $bm_db->query($jf_sql);
        
        //select f.*,u.classid from form_4 f LEFT JOIN tf_users u on f.sfzh = u.username  where f.id=201
        $cn_sql = "select f.kskm,f.sfzh,u.classid from form_".intval($_GET['fid'])." f left join tf_users u on f.sfzh = u.username where f.id=".intval($_GET['id']);
        $cn_db = new MySql();
        $cnInfo = $cn_db->getOne($cn_sql);
        
        $max_sql = "select max(jfqrcs)+1 as m from tf_classname where bh='".$cnInfo['classid']."'";
       
        $max_qrcs = $db->getOne($max_sql);
        //print_r($max_qrcs);
        $m = empty($max_qrcs['m'])?1:$max_qrcs['m'];
       // die();
        $cn_in_sql = "insert into tf_classname(kskm,bh,qrxslb,qrxsrs,jfdh,jfqrcs) values('".$fid."','".$cnInfo['classid']."','".$cnInfo['sfzh']."',1,'".$_GET['jfdh']."','".$m."')";
        $cn_db->query($cn_in_sql);
       // echo $cn_in_sql;
       // print_r($cnInfo);
    }
    else if($_REQUEST['jfzt']==0)
    {
        $bm_db = new MySql();
        $bminfo = $bm_db->getOne($bm_sql);
        //print_r($bminfo);
        $sfzh = $bminfo['sfzh'];
        $bmh = $bminfo['bmh'];
        $jf_sql = "delete from tf_paylist where sfzh=".escapeshellarg($sfzh)." and applyid=".escapeshellarg($bmh);
        $bm_db->query($jf_sql);
        
        
    }
    $res = $db->query($sql);
    if($db->affected_rows()>0)
        echo "<script>alert('处理成功');window.location.href='baoming_list.php?fid=".$_GET['fid']."'</script>";
}
//设置查询字段
$search=array("classid" =>'like',"name" => 'like');

$tsearch=getSearch($search);

$wsql=$tsearch[0];

//总计录数
if(!empty($fid))
{
    $sql="select count(*) counts from form_".$fid." a left join tf_users  b on  a.sfzh=b.username $wsql";

    $infoCounts=$db->getValue($sql);

    //分页类
    $p = new ShowPage;
    //设置每页显示条数
    $pagenums=500;
    //设置查询变量
    $p->setvar($tsearch[1],$pagenums."&fid=".$fid);
   
    $p->set($pagenums,$infoCounts);
    //输出分页
    $pageNav=$p->output(1);
    //查询每几条到第几条
    $limits=$p->limit();
    //册除用的.返回页面地址.
    $_SESSION['CURPAGE']=$p->CurrentUrl;


    //这里需要先选择科目，然后读取相应科目
    $sql="select *,a.id bid from form_".intval($fid)." a left join tf_users  b on  a.sfzh=b.username  $wsql  order by convert(b.name using gbk) asc   limit $limits";
	//$sql="select a.id bid,a.bmh,a.val0,a.val1,b.classid,b.studentid,b.name,b.tel,a.bmsj,a.jfzt from form_".intval($fid)." a left join tf_users  b on  a.sfzh=b.username  $wsql  order by convert(b.name using gbk) asc   limit $limits";
    $db->query($sql);

    $i=0;
}
?>
<div class="main" >
<div class="content" >
<div class="title">报名管理列表</div>
<div class="imgButton">
<form action="" method="post" name="form1" >
<input type="button" value="&nbsp;导出execl&nbsp;" onClick="excel()"  class="button small">
搜索：考试名称
<SELECT id='fid' name='fid'>
<?php 
        $db1 = new MySql();
        $kaoshi_sql = "select fname,k.fid from tf_kkhb k left join tf_form f on k.fid=f.fid order by id desc";
        $fnames = $db1->getArray($kaoshi_sql);
        foreach ($fnames as $fname) {
            if($fid==$fname['fid'])
                echo "<option value='".$fname['fid']."' selected>".$fname['fname']."</option>";
            else
                echo "<option value='".$fname['fid']."'>".$fname['fname']."</option>";
        }
?>  
</SELECT>
</form>
</div>
</div>
<div class="list">
<table class="list" cellpadding="0" cellspacing="0">
<tbody>
<tr>
 <td colspan="12" class="topTd" height="2"></td>
</tr
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItemsAll" id="checked" onClick="checkAll(this, 'cadicateItems')" type="checkbox"></th>
<td>全选</td>
</tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItems" id="bmh" onClick="checkItem(this, 'cadicateItemsAll')" type="checkbox"></th>
<td>报名号</td>
</tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItems" id="val0" onClick="checkItem(this, 'cadicateItemsAll')" type="checkbox"></th>
<td>报考级别</td>
</tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItems" id="val1" onClick="checkItem(this, 'cadicateItemsAll')" type="checkbox"></th>
<td>培训类别</td>
</tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItems" id="classid" onClick="checkItem(this, 'cadicateItemsAll')" type="checkbox"></th>
<td>班级</td>
</tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItems" id="studentid" onClick="checkItem(this, 'cadicateItemsAll')" type="checkbox"></th>
<td>学号</td>
</tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItems" id="tel" onClick="checkItem(this, 'cadicateItemsAll')" type="checkbox"></th>
<td>手机号</td>
</tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItems" id="bmsj" onClick="checkItem(this, 'cadicateItemsAll')" type="checkbox"></th>
<td>报名日期</td>
</tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItems" id="jfzt" onClick="checkItem(this, 'cadicateItemsAll')" type="checkbox"></th>
<td>缴费状态</td>
</tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItems" id="shzt" onClick="checkItem(this, 'cadicateItemsAll')" type="checkbox"></th>
<td>审核状态</td>
</tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItems" id="name" onClick="checkItem(this, 'cadicateItemsAll')" type="checkbox"></th>
<td>姓名</td>
</tr>
<tr><td colspan="2" class="bottomTd" height="5"></td></tr></tbody></table>

</div>
<div class="page"><?php echo $pageNav;?></div>
</div>
<script>
function selectChanged(id,fid,jfzt)
{
    var jfdh;
    if(jfzt==1)
    {
        jfdh = prompt("请输入缴费单号：","");
        if(jfdh != null)
        {
            window.location.href="baoming_list.php?st=1&id="+id+"&fid="+fid+"&jfzt="+jfzt+"&jfdh="+jfdh;
        }
        else{
            alert("您按了【取消】按钮");
            return false;
        }
    }
    else
    {
            window.location.href="baoming_list.php?st=1&id="+id+"&fid="+fid+"&jfzt="+jfzt;
    } 
    
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
    var items = document.getElementsByName('cadicateItems');
    var elements="";
    var i=0;
    for (; i<items.length; i++)
    {
        if(items[i].checked)
        {
            elements += items[i].id+",";
        }
    }
    elements = elements.substr(0,new String(elements).length-1);
    var fid = document.getElementById('fid').value;
    window.location.href="baoming_excel_download_1.php?elements="+elements+"&fid="+fid;
 }
 function deleteAll(itemName,fid)
 {
     if(confirm('确定要删除吗？'))
    {
        var items = document.getElementsByName(itemName);
        var id="";
        for (var i=0; i<items.length; i++)
        {
            if(items[i].checked)
            {
                var values = items[i].value.split("_");
                id +=values[0]+",";
            }
        }
        window.location.href="baoming_del_all.php?id="+id+"&fid="+fid;
    }
 }
 function dealAll(itemName,fid)
 {
    //if(confirm('确定要批量处理吗？'))
    //{
        var items = document.getElementsByName(itemName);
        var id="";
        var fy="";
	var js=0;
        for (var i=0; i<items.length; i++)
        {
            if(items[i].checked)
            {   js=js+1;
                var values = items[i].value.split("_");
                id +=values[0]+",";
                fy +=values[1]+",";
            }
        }
		if(js==0){
			alert("请选择要审批通过的报名信息！");
		}else{
        window.location.href="select_list.php?id="+id+"&fid="+fid+"&fy="+fy;
		}
        /*
        var jfdh = prompt("请输入缴费单号：","");
        if(jfdh != null)
        {
            window.location.href="baoming_deal_all.php?id="+id+"&fid="+fid+"&fy="+fy+"&jfdh="+jfdh;
        }
        else{
            alert("您按了【取消】按钮");
            return false;
        }
        */
    //}
    
 }
</script>
