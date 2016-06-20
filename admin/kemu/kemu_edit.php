<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
//判断管理员是否登录
require_once '../ifadmin.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0063)http://www.ddphp.cn/bm/dadmin/user_edit.php?id=1607&action=edit -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title></title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../../js/Validform_v5.3.2.js"></script>
<link href="../../css/validform.css" rel="stylesheet"></link>    
</head>
<?php
    if(isset($_POST['submit']))
    {
        $fid = $_POST['fid'];
        $fname = $_POST['fname'];
        $fmsg = $_POST['fmsg'];
        $sql = "update tf_form set fname='".$fname."',fmsg='".$fmsg."' where fid=".escapeshellarg($fid);
        $db->query($sql);
        msg("考试科目信息修改成功!","subok","kemu_edit.php?fid=".$fid);
    }
    else
    {
        $fid=$_GET['fid'];
        $kemu = $db->getOne("SELECT * FROM tf_form where fid = $fid");
    }
    
?>
<body>
<div class="main">
<div class="content">
<div class="title">考试科目修改</div>

</div>
<div class="list">
<form name="fom" id="form" class="form" method="post" action="kemu_edit.php">
<table cellpadding="0" cellspacing="0" width="100%" class="role_table" id="OwnershipStructure">
<tbody>
<tr>
	<td class="tRight" width="150" rowspan="1" id="StructureLeft1">考试科目名称</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" ><input name="fname" type="text" size="40" value="<?php echo $kemu['fname'] ?>" datatype="*" errormsg="考试科目不能为空!"></input></td>
        <td>
            <div class="Validform_checktip">
                  必填
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考试科目说明</td>
	<td class="tLeft">
            <textarea name="fmsg" rows="5" cols="40"><?php echo $kemu['fmsg'];?></textarea>
        </td>
        <td>
            <div class="Validform_checktip">
                  选填
            </div>
        </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td class="center" colspan="3">
	<input type="hidden" name="fid" value="<?php echo $kemu['fid'];?>">
	<input type="submit" value="修 改" name="submit" class="button small">
	 <input type="reset" class="button small" onclick="javascript:window.location.href='kemu_list.php'" value="返 回"></td>
</tr>
</tbody>
</table>
<script type="text/javascript">
        $(function() {
            $(".form").Validform({
                tiptype: 2
            });
        });
</script>
</form>
</div>
</div>
</body>
</html>
