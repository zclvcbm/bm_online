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
$stat = $_REQUEST['stat'];

$db=new MySql();



//设置查询字段
$search=array("stat" =>'stat');

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
    $pagenums=100;
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
    $sql="select *,a.id bid from form_".intval($fid)." a left join tf_users  b on  a.sfzh=b.username  $wsql order by a.id desc limit $limits";
	
	
    $db->query($sql);

    $i=0;
}


?>
<div class="main" >
<div class="content" >
<div class="title">发送邮件</div>
<div class="imgButton">
<form action="" method="post" name="form1" >
<input type="button" value="&nbsp;发送邮件&nbsp;" onClick="location.href='send_add.php?stat=<?php echo $stat;?>&fid=<?php echo $fid;?>'"  class="button small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

搜索：考试名称
<SELECT id='stats' name='fid'>
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

<SELECT id='stat' name='stat'>
 <OPTION value="" <?php if($stat=='') echo 'selected';?>>全部</OPTION> 
 <OPTION value="1" <?php if($stat==1) echo 'selected';?>>审核通过</OPTION>
 <OPTION value="0" <?php if($stat==0) echo 'selected';?>>审核未通过</OPTION>
</SELECT>

<input type="submit" name="seach" value="搜索" class="button">
</form>
</div>
</div>
<div class="list">
<table class="list" cellpadding="0" cellspacing="0">
<tbody>
<tr><td colspan="12" class="topTd" height="5"></td></tr>
<tr class="row">
<th>报名号</th>
<th>报考级别</th>
<th>培训类别</th>
<th>班级</th>
<th>学号</th>
<th>姓名</th>
<th align="center">手机</th>
<th>报名日期</th> 
<th>照片审核状态</th> 
<th >操作</td>
</tr>
<?php
    if(!empty($fid))
    {
        while ($db->next_record()) {
            $fy = $db->f("ksfy")+$db->f("pxfy");
            $bkjb = explode('|', $db->f(val0));
            $pxlb = explode('|', $db->f(val1));
?>
<tr >
<td><?php echo $db->f("bmh")?></td>
<td><?php echo $bkjb[0];?></td>
<td><?php echo $pxlb[0];?></td>
<td><?php echo $db->f("classid")?></td>
<td><?php echo $db->f("studentid")?></td>
<td><?php echo $db->f("name")?></td>
<td ><?php echo $db->f("tel")?></td>
<td ><?php echo $db->f("bmsj")?></td>
<td ><?php if($db->f("shzt")==1) echo "已审核";else echo "未审核";?></td>   
<td><a  href="baoming_input.php?id=<?php echo $db->f('bid')?>&fid=<?php echo $fid;?>"><b style='color:#09C'>详情</b></a>&nbsp;</td>
</tr>
<?php
        $i++;
    }
}
?>
<tr><td colspan="12" class="bottomTd" height="5"></td></tr></tbody></table>

</div>
<div class="page"><?php echo $pageNav;?></div>
</div>
