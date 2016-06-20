<?php
session_start();
//note 加载MooPHP框架
require_once'../MooPHP/MooPHP.php';
//note:加载配置文件
require_once'../MooPHP/MooConfig.php';
require_once("../ifadmin.php");


//设置工程相对路径
$root_path="../../";
require_once("$root_path/data/dconfig.php");
require_once("$root_path/lib/config.php");
require_once("$root_path/lib/fun_com.php");

$fid = $_GET['fid'];
$stat = $_GET['stat'];

if($stat=="")
 $wsql="";
else
 $wsql="where stat='".$stat."'";



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/DatePicker.js"></script>
<script type="text/javascript" src="../../js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../../js/Validform_v5.3.2.js"></script>
<link href="../../css/validform.css" rel="stylesheet"></link>
</head>
<body>
<div class="main">
<div class="content">
<div class="title">邮件发送</div>
</div>
<div class="list">
<form name="form" id="form" class="form" method="post" action="../../notice_deal.php">
<table cellpadding="0" cellspacing="0" width="100%" class="role_table" id="OwnershipStructure">
<tbody>
<tr>
	<td class="tRight" width="150" rowspan="1" id="StructureLeft1">邮件发送人员类别</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
              <?
                if($stat=="0")
                  echo "照片未审核通过人员";
                else if($stat=="1") 
                  echo "照片审核通过人员";
                else
                  echo "全部人员";
               ?>
        </td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150" rowspan="1" id="StructureLeft1">邮件主题</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
            <textarea name="title" datatype="*" errormsg="邮件主题不能为空！" cols="200" rows="8"></textarea>
        </td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">收件人列表</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" align="left">
            <textarea name="sjr" datatype="*" errormsg="收件人不能为空！ " cols="200" rows="16"><?
                $db = new MySql();
                $sql="select email from form_".intval($fid)." a left join tf_users  b on  a.sfzh=b.username  $wsql order by a.id desc";
                $emails = $db->getArray($sql);
                $i=0;             
                  
                foreach ($emails as $email) {
                  echo $email['email'].";&nbsp;";
                }
               ?>
            </textarea>
        </td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td class="center" colspan="3">
            <input type="hidden" id="tfid" name="tfid" value="<?php echo $fid;?>">
            <input type="hidden" id="tstat" name="tfid" value="<?php echo $stat;?>">
            
            <input type="submit" value="发 送" name="submit" class="button small">
            <input type="reset" value="重 置" name="reset" class="button small">
            <input class="button small" type="reset" value="返 回" onclick="javascript:window.location.href='sendmail_list.php'">
        </td>
</tr>
</tbody>
</table>
</script> 
</form>
</div>
</div>
</body>
</html>
<script type="text/javascript">
        $(function() {
            $(".form").Validform({
                tiptype: 2
            });
        });
</script>
