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


//设置查询字段
$search=array("classid" =>'like',"name" => 'like');

$tsearch=getSearch($search);

$wsql=$tsearch[0];

//总计录数
if(!empty($fid))
{
    $sql="select count(*) counts from form_".$fid." a left join tf_users  b on  a.sfzh=b.username $wsql  and a.jfzt=1 ";

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
    $sql="select *,a.id bid from form_".intval($fid)." a left join tf_users  b on  a.sfzh=b.username  $wsql and a.jfzt=1  ";
	//$sql="select a.id bid,a.bmh,a.val0,a.val1,b.classid,b.studentid,b.name,b.tel,a.bmsj,a.jfzt from form_".intval($fid)." a left join tf_users  b on  a.sfzh=b.username  $wsql  order by convert(b.name using gbk) asc   limit $limits";
    $db->query($sql);

    $i=0;
	$ischeckedpath="upload/ischecked/"; 
	        while ($db->next_record()) {
			$pic=$db->f("pic");
			$pic_passed = str_replace("init", "passed", $pic);
			
		//	copy($pic_passed,$ischeckedpath);
            if(i==1){
				echo $pic_passed;
				echo "---";
				echo $ischeckedpath;
			}

             $i++;
            }
	
}
?>
<div class="main" >
<div class="content" >
<div class="title">提取已缴费考生照片</div>
<div class="imgButton">
<form action="" method="post" name="form1" >
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
班级：<input  type="text" name="classid" id="bj" size="10" value="<?php echo $_POST['class'] ?>"/>&nbsp;姓名：<input  type="text" name="name" id="name" size="10" value="<?php echo $_POST['name'] ?>"/>
<input type="submit" name="seach" value="提取照片" class="button">
</form>
</div>
</div>
<div class="list">
<table class="list" cellpadding="0" cellspacing="0">
<tbody>
<tr><td colspan="12" class="topTd" height="5"></td></tr>
<tr class="row">
<th style="vertical-align:middle;" ><input name="cadicateItemsAll" id="checkedAll" onClick="checkAll(this, 'cadicateItems')" type="checkbox"></th>
<th><?php echo $i ?></th>
<th>报考级别</th>
<th>培训类别</th>
<th>班级</th>
<th>学号</th>
<th>姓名</th>
<th align="center">手机</th>
<th>报名日期</th> 
<th>缴费状态</th> 
<th>现场缴费</th>
<th >操作</td>
</tr>

<tr><td colspan="12" class="bottomTd" height="5"></td></tr></tbody></table>

</div>
<div class="page"><?php echo $pageNav;?></div>
</div>

