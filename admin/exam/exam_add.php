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
    $f = $db->getOne("SELECT k.*,f.fname FROM tf_kkhb k, tf_form f where id = ".escapeshellarg($id)." and k.fid=f.fid");
?>
<body>
<div class="main">
<div class="content">
<div class="title">考务管理</div>
<?php
            $fds = $db->getOne("SELECT fid FROM tf_form ORDER BY fid DESC");
            $fd = $fds['fid'];
            $sql = "SELECT options FROM tf_form_type where title='报考级别' and fid=".$fd;
            $res = $db->getOne($sql);
            $sql1 = "SELECT options FROM tf_form_type where title='培训类别'  and  fid=".$fd;
            $res1 = $db->getOne($sql1);
            $sql2 = "SELECT options FROM tf_form_type where title='其它费用'  and  fid=".$fd;
            $res2 = $db->getOne($sql2);
?>
</div>
<div class="list">
<form name="form" id="form" class="form" method="post" action="exam_save.php">
<table cellpadding="0" cellspacing="0" width="100%" class="role_table" id="OwnershipStructure">
<tbody>
<tr>
	<td class="tRight" width="150" rowspan="1" id="StructureLeft1">考试名称</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" ><select name="fid" onchange="showInfo(this.value)">
            <?php
            $formlist = $db->getAll("SELECT * FROM tf_form ORDER BY fid DESC");
            
            foreach($formlist AS $form) {
		        $fid = $form['fid'];
                $fname = $form['fname'];
                echo "<option value='".$fid."'>".$fname."</option>";
            }
             ?>
            </select>
        </td>
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
	<td class="tLeft"><input name="counts" value="1" type="text" size="5" datatype="n" errormsg="此项只能填写整数!"></td>
        <td>
            <div class="Validform_checktip">
                填写数字！
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">最大报名人数</td>
	<td class="tLeft"><input name="maxnum" value="9999" type="text" size="5" datatype="n" errormsg="此项只能填写整数!"></td>
        <td>
            <div class="Validform_checktip">
                填写数字！
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考试报名开始时间</td>
	<td class="tLeft"><input type="text" name="start_time" onfocus="setday(this)" value="<?php echo date('Y-m-d',time()); ?>" datatype="*" errormsg="考试报名开始时间不能为空！"></td>
        <td>
            <div class="Validform_checktip">
                点击文本框选择日期！
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考试报名截止时间</td>
	<td class="tLeft"> <input type="text" name="end_time" onfocus="setday(this)" value="<?php echo date('Y-m-d',time()); ?>" datatype="*" errormsg="考试报名截止时间不能为空！"></td>
        <td>
            <div class="Validform_checktip">
                点击文本框选择日期！
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考试确认开始时间</td>
	<td class="tLeft"> <input type="text" name="subs_time" onfocus="setday(this)" value="<?php echo date('Y-m-d',time()); ?>" datatype="*" errormsg="考试确认开始时间不能为空！"></td>
        <td>
            <div class="Validform_checktip">
                点击文本框选择日期！
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考试确认截止时间</td>
	<td class="tLeft"> <input type="text" name="sube_time" onfocus="setday(this)" value="<?php echo date('Y-m-d',time()); ?>" datatype="*" errormsg="考试确认截止时间不能为空！"></td>
        <td>
            <div class="Validform_checktip">
                点击文本框选择日期！
            </div>
        </td>
</tr>  
<tr>
        <td class="tRight" width="150">报考级别</td>
        <td class="tLeft"><textarea id="jb" datatype="*" name="jb" rows="5" cols="70" ><?php echo $res['options']; ?></textarea></td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">培训类别</td>
        <td class="tLeft"><textarea id="px" datatype="*" name="px" rows="5" cols="70" ><?php echo $res1['options']; ?></textarea></td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>
<tr>
        <td class="tRight" width="150">其它费用</td>
        <td class="tLeft"><textarea id="qt" datatype="*" name="qt" rows="5" cols="70" ><?php echo $res2['options']; ?></textarea></td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>
<tr>
    <td class="tRight" width="150">备注</td>
    <td class="tLeft"><textarea name="bz" rows="5" cols="70" placeholder="补充说明"></textarea></td>
    <td>
        <div class="Validform_checktip">
            选填
        </div>
    </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td class="center" colspan="3">
            <input type="submit" value="保 存" name="submit" class="button small">
            <input class="button small" type="reset" value="返 回" onclick="javascript:window.location.href='examslist.php'">
        </td>
        <td></td>
</tr>
</tbody>
</table>
<script language="javascript" type="text/javascript"> 
$(function() {
            $(".form").Validform({
                tiptype: 2
            });
        });
function showInfo(str)
{
    var xmlhttp;
    if(str=="")
        {
            document.getElmentById("jb").innerHTML="";
            document.getElmentById("px").innerHTML="";
            document.getElmentById("qt").innerHTML="";
            return ;
        }
        if(window.XMLHttpRequest)
            {
                xmlhttp = new XMLHttpRequest();
            }
       else{
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        str=xmlhttp.responseText; //这是一字符串 
                        var strs= new Array(); //定义一数组 
                        strs=str.split("."); //字符分割 
                        document.getElementById("jb").innerHTML=strs[0];
                        document.getElementById("px").innerHTML=strs[1];
                        document.getElementById("qt").innerHTML=strs[2];
                    }
            }
            xmlhttp.open("GET","getExamInfo.php?fid="+str);
            xmlhttp.send();
}
</script> 
</form>
</div>
</div>
</body>
</html>