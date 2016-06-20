<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
require_once("../ifadmin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0063)http://www.ddphp.cn/bm/dadmin/user_edit.php?id=1607&action=edit -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title></title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/DatePicker.js"></script>
<script type="text/javascript" src="../../js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../../js/Validform_v5.3.2.js"></script>
<link href="../../css/validform.css" rel="stylesheet"></link>
</head>
<?php

    $id = escapeshellarg($id);
    $f = $db->getOne("SELECT k.*,f.fname FROM tf_kkhb k, tf_form f where id = $id and k.fid=f.fid");
    $j = $db->getOne("SELECT options from tf_form_type where title='报考级别' and fid=".escapeshellarg($fid));
    $p = $db->getOne("SELECT options from tf_form_type where title='培训类别' and fid=".escapeshellarg($fid));
   // print_r($f);
?>
<body>
<div class="main">
<div class="content">
<div class="title">考务管理</div>

</div>
<div class="list">
<form name="form" id="form" class="form" method="post" action="exam_edit_sub.php">
<table cellpadding="0" cellspacing="0" width="100%" class="role_table" id="OwnershipStructure">
<tbody>
<tr>
	<td class="tRight" width="150" rowspan="1" id="StructureLeft1">考试名称</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" ><input name="fname" size="50" type="text" readonly value="<?php echo $f['fname'] ?>" ></input></td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">年份</td>
	<td class="tLeft">
            <select name="yyyy">
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2017">2019</option>
                <option value="2018">2020</option>
            </select>
        </td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">次数</td>
	<td class="tLeft"><input name="counts" type="text" size="5" value="<?php echo $f['counts'] ?>" datatype="n" errormsg="此项只能填写整数!"></td>
        <td>
            <div class="Validform_checktip">
                填写数字！
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">最大报名人数</td>
	<td class="tLeft"><input name="maxnum" value="<?php echo $f['maxnum'];?>" type="text" size="5" datatype="n" errormsg="此项只能填写整数!"></td>
        <td>
            <div class="Validform_checktip">
                填写数字！
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考试报名开始时间</td>
	<td class="tLeft"> <input type="text" name="start_time" onfocus="setday(this)" value="<?php echo $f['start_time']; ?>" datatype="*" errormsg="考试报名开始时间不能为空！"></td>
        <td>
            <div class="Validform_checktip">
                点击文本框选择日期！
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考试报名截止时间</td>
	<td class="tLeft"> <input type="text" name="end_time" onfocus="setday(this)" value="<?php echo $f['end_time']; ?>" datatype="*" errormsg="考试报名截止时间不能为空！"></td>
        <td>
            <div class="Validform_checktip">
                点击文本框选择日期！
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考试确认开始时间</td>
	<td class="tLeft"> <input type="text" name="subs_time" onfocus="setday(this)" value="<?php echo $f['subs_time']; ?>" datatype="*" errormsg="考试确认开始时间不能为空！"></td>
        <td>
            <div class="Validform_checktip">
                点击文本框选择日期！
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考试确认截止时间</td>
	<td class="tLeft"> <input type="text" name="sube_time" onfocus="setday(this)" value="<?php echo $f['sube_time']; ?>" datatype="*" errormsg="考试报名确认截止时间不能为空！"></td>
        <td>
            <div class="Validform_checktip">
                点击文本框选择日期！
            </div>
        </td>
</tr>  
<tr>
        <td class="tRight" width="150">报考级别</td>
        <td class="tLeft"><textarea name="jb"  rows="5" cols="70" ><?php echo $j['options']; ?></textarea></td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">培训类别</td>
	<td class="tLeft"><textarea name="px"  rows="5" cols="70" ><?php echo $p['options']; ?></textarea></td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>
<tr>
    <td class="tRight" width="150">备注</td>
    <td class="tLeft"><textarea name="bz" rows="5" cols="70" ><?php echo $f['bz']; ?></textarea></td>
    <td>
        <div class="Validform_checktip">
            必填
        </div>
    </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td class="center" colspan="2">
            <input type="hidden" name="id" value="<?php echo $f['id'];?>">
            <input type="hidden" name="fid" value="<?php echo $f['fid'];?>">
            <input type="submit" value="保 存" name="submit" class="button small">
            <input type="reset" value="重 置" name="reset" class="button small">
            <input type="reset" class="button small" onclick="javascript:window.location.href='examslist.php'" value="返 回">
        </td>
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


</body></html>