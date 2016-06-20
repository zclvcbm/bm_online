<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>
<script type="text/javascript" src="../js/check.js"></script>
<script type="text/javascript" src="../table.js"></script>
<script type="text/javascript" src="../../js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../../js/Validform_v5.3.2.js"></script>
<link href="../../css/validform.css" rel="stylesheet"></link>
<link href="../style/style1.css" rel="stylesheet" type="text/css" />
<link href="../style/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';

if(!$action) $action="listoption";
if ($action == 'listoption') {
	$optionlist = $db->getAll("SELECT * FROM tf_form_type WHERE fid=".escapeshellarg($fid)." ORDER BY orderid,id ASC");
	echo '<div> <table class="list1" cellpadding="0" cellspacing="0"><tbody>
            <tr><td colspan="6" class="topTd" height="5"></td></tr>
            <tr><td width="10%">选项名称</td><td width="30%">选项说明</td><td width="20%">选项类型</td><td width="15%">默认值</td><td width="10%">是否必须</td><td width="15%" align="center">操作</td></tr>';
	foreach($optionlist AS $option) {
		$id = $option['id'];
		$fid = $option['fid'];
		$title = $option['title'];
                $msg = $option['msg'];
                $ismust = $option['ismust']==1?"是":"否";
                $defaultvalue = $option['defaultvalue'];
                $options = $option['options'];
                $type = $option['type'];
                if($type=='text')
                        $type="文本框";
                else if($type=='textarea')
                        $type="多行文本";
               else if($type=='select')
                        $type="下拉框";
                else if($type=='radio')
                        $type="单选框";
                else if($type=='checkbox')
                        $type='复选框';
                else if($type=='password')
                        $type="密码框";
                else
                    $type="隐藏域";
		echo '<tr><td width="10%">'.$title.'</td><td width="30%">'.$msg.'</td><td width="20%">'.$type.'</td><td width="15">'.$defaultvalue.'</td><td width="10">'.$ismust.'</td><td width="15%" align="center">';
		echo '<a href="?action=editoption&id='.$id.'&fid='.$fid.'">修改选项</a> ｜ <a href="?action=deloption&fid='.$fid.'&id='.$id.'">删除</a></td></tr>';

	}
	echo '<td colspan="6" class="bottomTd" height="5"></tbody></table></div>';
	?>
<div class="main">
<div class="content">
<div class="title">添加选项</div>
</div>
<div class="list">
<form name="form" id="form" class="form" method="post" action="?action=saveaddoption">
    <input type="hidden" name="fid" value="<?=$fid?>">
<table cellpadding="0" cellspacing="0" width="100%" class="role_table">
    <tbody>
        <tr>
            <td class="tRight" width="150" rowspan="1">选项名称</td>
            <td class="tLeft" ><input type="text" name="title" datatype="*" errormsg="选项名称不能为空！"></input>
            </td>
            <td width='150'>
                <div class="Validform_checktip">
                    <font color='red'>必填</font>
                </div>
            </td>
        </tr>
        <tr>
            <td class="tRight" width="150">选项说明</td>
            <td class="tLeft"><textarea cols="80" rows="5" name="msg"></textarea></td>
            <td>
                <div class="Validform_checktip">
                    选填
                </div>
            </td>
        </tr>
        <tr> 
            <td class="tRight"><strong>选项类型</strong></td>
            <td class="tLeft">
                <select name="type" onchange="javascript:formtypechange(this.value)">
                    <option value='text' selected>单行文本(text)</option>
                    <option value='textarea'>多行文本(textarea)</option>
                    <option value='select'>下拉框(select)</option>
                    <option value='radio'>单选框(radio)</option>
                    <option value='checkbox'>多选框(checkbox)</option>
                    <option value='password'>密码框(password)</option>
                    <option value='hidden'>隐藏域(hidden)</option>
                </select>
            </td>
            <td>
                <div class="Validform_checktip">
                    <font color='red'>必填</font>
                </div>
            </td>
        </tr>
        <tr>
            <td class="tRight" width="150">默认值</td>
            <td class="tLeft"><textarea name='defaultvalue' rows='1' cols='21' onkeypress="javascript:checktextarealength('defaultvalue',30);"></textarea></td>
            <td>
                <div class="Validform_checktip">
                    选填
                </div>
            </td>
        </tr>
        <tr id='trOptions' style='display:none'>
            <td  class='tRight'><strong>表单选项：</strong><br>每行一个</td>
            <td class='tLeft'><textarea name='options' cols='60' rows='5' id='options'></textarea></td>
            <td>
                <div class="Validform_checktip">
                    <font color='red'>必填</font>
                </div>
            </td>
        </tr>
        <tr> 
            <td class="tRight"><strong>是否必填</strong></td>
            <td class="tLeft">是<input type="radio" name="ismust" value="1"> 否<input type="radio" name="ismust" value="0" checked></td>
            <td>
                <div class="Validform_checktip">
                    <font color='red'>必填</font>
                </div>
            </td>            
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="center" colspan="3">
                <input type="submit" value="添加" name="submit" class="button small">
                <input type="reset" class="button small" onclick="" value="清除">
                <input type="button" onclick="history.go(-1)" class="button small" name="back" value=" 返回 " />
            </td>
        </tr>
    </tbody>
</table>    
</form>
</div>  
</div>
<div class="description" align="center">
    <p><pre style="font-size: 20px">
<font color="red"> 注意</font>：如果考试科目尚未创建“<font color="red">报考级别</font>”和“<font color="red">培训类别</font>”，请首先创建该两个选项。格式如下：      
      <table cellpadding="0" cellspacing="0" width="50%">
         <tr>
            <td align="center">选项名称</td><td align="center">选项说明</td><td align="center">选项类型</td><td align="center">表单选项</td>
         </tr>
          <tr>
            <td align="center">报考级别</td><td align="center">报考级别选项说明</td><td align="center">下拉框</td>
            <td align="left"> 一级：计算机基础及WPS Office应用|14|30<br />
                一级：计算机基础及MS Office应用|15|30<br />
                一级：计算机基础及Photoshop应用|16|30</td>
         </tr>
             <tr>
            <td align="center">培训类别</td><td align="center">培训类别选项说明</td><td align="center">下拉框</td>
            <td align="left">不参加培训班|10|0<br/>            
              培训一班|11|60<br />
              培训二班|22|80</td>
         </tr>
	<tr>
            <td align="center">其它费用</td><td align="center">其它费用选项说明</td><td align="center">下拉框</td>
            <td align="left">无|0<br/>            
              资料费（30元)|30<br />
              资料费（30元）+证件费（10元）|40</td>
         </tr>
      </table>
    </pre></p>
</div>
        <?php
}elseif($action == 'editoption') {
        $optionlist = $db->getAll("SELECT * FROM tf_form_type WHERE fid='$fid' ORDER BY orderid,id ASC");
	echo '<div> <table class="list1" cellpadding="0" cellspacing="0"><tbody>
            <tr><td colspan="6" class="topTd" height="5"></td></tr>
            <tr><td width="10%">选项名称</td><td width="30%">选项说明</td><td width="20%">选项类型</td><td width="15%">默认值</td><td width="10%">是否必须</td><td width="15%" align="center">操作</td></tr>';
	foreach($optionlist AS $option) {
		$id = $option['id'];
		$fid = $option['fid'];
		$title = $option['title'];
                $msg = $option['msg'];
                $ismust = $option['ismust']==1?"是":"否";
                $defaultvalue = $option['defaultvalue'];
                $options = $option['options'];
                $type = $option['type'];
                if($type=='text')
                        $type="文本框";
                else if($type=='textarea')
                        $type="多行文本";
               else if($type=='select')
                        $type="下拉框";
                else if($type=='radio')
                        $type="单选框";
                else if($type=='checkbox')
                        $type='复选框';
                else if($type=='password')
                        $type="密码框";
                else
                    $type="隐藏域";
		echo '<tr><td width="10%">'.$title.'</td><td width="30%">'.$msg.'</td><td width="20%">'.$type.'</td><td width="15">'.$defaultvalue.'</td><td width="10">'.$ismust.'</td><td width="15%" align="center">';
		echo '<a href="?action=editoption&id='.$id.'&fid='.$fid.'">修改选项</a> ｜ <a href="?action=deloption&fid='.$fid.'&id='.$id.'">删除</a></td></tr>';

	}
	echo '<td colspan="6" class="bottomTd" height="5"></tbody></table></div>';
        
        $id = $_GET['id'];
	$optionmsg = $db->getOne("SELECT * FROM tf_form_type WHERE id='$id'");
        
	$type = $optionmsg['type'];
	if($type == 'text') {
		$stext = '单行文本(text)';
		$diplay = 'display:none';
		}
	if($type == 'textarea') { 
		$stext = '多行文本(textarea)';
		$diplay = "display:none";
		}
	if($type == 'select') {
		$stext = '下拉框(select)';
		$diplay = "";
		}
	if($type == 'radio') {
		$stext = '单选框(radio)';
		$diplay = "";
		}
	if($type == 'checkbox') {
		$stext = '多选框(checkbox)';
		$diplay = "";
		}
	if($type == 'pass') {
		$stext = '密码框(password)';
		$diplay = 'display:none';
		}

	if($type == 'hidden') {
		$stext = '隐藏域(hidden)';
		$diplay = 'display:none';
		}
	?>
<div class="main">
<div id="add">
<div class="content">
<div class="title">修改选项</div>
</div>
<div class="list">
<form id="form1" class="form" action="?action=saveeditoption" method="post" name="myform">
    <input type="hidden" name="id" value="<?=$optionmsg['id']?>"></input>
    <input type="hidden" name="fid" value="<?=$fid;?>"></input>
    <table cellpadding="0" cellspacing="0" width="100%" class="role_table">
            <tr>
                <td class='tRight'><strong>选项名称</strong></td>
                <td class='tLeft'>
                    <input type="text" name="title" value="<?= $optionmsg['title'] ?>" datatype="*" errormsg="选项名称不能为空！">
                </td>
                <td>
                    <div class="Validform_checktip">
                        <font color='red'>必填，选项名称不能为空</font>
                    </div>
                </td>
            </tr>
            <tr>
                <td class='tRight'><strong>选项说明</strong></td>
                <td class='tLeft'>
                    <textarea name="msg" cols="80" rows="5"><?= $optionmsg['msg']; ?></textarea>
                </td>
                <td>
                    <div class="Validform_checktip">
                        选填
                    </div>
                </td>
            </tr>
            <tr> 
                <td class="tRight"><strong>选项类型</strong></td>
                <td class="tLeft">
                    <select name="type" onchange="javascript:formtypechange(this.value)">
                        <option value='<?= $type ?>' selected><?= $stext ?></option>
                        <option value='text'>单行文本(text)</option>
                        <option value='textarea'>多行文本(textarea)</option>
                        <option value='select'>下拉框(select)</option>
                        <option value='radio'>单选框(radio)</option>
                        <option value='checkbox'>多选框(checkbox)</option>
                        <option value='pass'>密码框(password)</option>
                        <option value='hidden'>隐藏域(hidden)</option>
                    </select>
                </td>
                <td>
                    <div class="Validform_checktip">
                        <font color='red'>必填</font>
                    </div>
                </td>
            </tr>
            <tr id='trOptions' style='<?= $diplay ?>'>
                <td  class='tRight'><strong>表单选项：</strong><br>每行一个</td>
                <td class='tLeft'><textarea name='options' cols='60' rows='5' id='options' datatype='*' errormsg='表单选项不能为空！'><?= $optionmsg['options'] ?></textarea></td>
                <td>
                    <div class="Validform_checktip">
                        <font color='red'>必填</font>
                    </div>
                </td>
            </tr>
            <tr>
                <td class='tRight'><strong>默认值</strong></td>
                <td class='tLeft'>
                    <textarea name='defaultvalue' rows='1' cols='22' onkeypress="javascript:checktextarealength('defaultvalue',30);"><?= $optionmsg['defaultvalue'] ?></textarea>
                </td>
                <td>
                    <div class="Validform_checktip">
                        选填
                    </div>
                </td>
            </tr>
            <tr> 
                <td class="tRight"><strong>是否必填</strong></td>
                <td class="tLeft">
                    是<input type="radio" name="ismust" value="1" <?php if ($optionmsg['ismust'] == 1) echo "checked"; ?>> 否<input type="radio" name="ismust" value="0" <?php if ($optionmsg['ismust'] == 0) echo "checked"; ?>>
                </td>
                <td>
                    <div class="Validform_checktip">
                        选填
                    </div>
                </td>
            </tr>
            <tr> 
                <td class="tRight">
                </td>
                <td class="tLeft"> <input type="submit" class="button small" name="submit" value="保存" />&nbsp; 
                             <input type="reset" class="button small" name="reset" value=" 清除 " /> &nbsp; 
                             <input type="button" onclick="window.location.href='listoption.php?fid=<?php echo $fid; ?>'" class="button small" name="reset" value=" 返回 " />
                </td>
            </tr>
         </table>
  </form>
</div>
</div>
</div>
<?php

} elseif ($action == 'saveaddoption') {
	//print_r($_POST);
        $formList = $db->getAll("SELECT * FROM tf_form_type WHERE fid='$fid' ORDER BY orderid,id ASC");
        $flag = 0;

        
	foreach($formList AS $k=>$form) {
            if($form['title']=="报考级别")
            {
                $flag=1;
            }
            if($form['title']=="培训类别")
            {
                $flag=2;
            }
            if($form['title']=="其它费用")
            {
                $flag=3;
            }
	}

        if($flag==3 && ($title=='报考级别'|| $title=='培训等级' || $title=='其它费用'))
        {
            msg("已创建'".$title."'选项！");
            exit();
        }
        if($flag==0 && $title!='报考级别')
        {
            msg("请先创建‘报考级别’选项！");
            exit();
        }
        else if($flag!=1 && $title=='培训类别')
        {
            msg("请先创建‘培训类别’选项！");
            exit();
        }
        else if($flag==1 && $title!='培训类别')
        {
            msg("请先创建‘培训类别’选项！");
            exit();
        }
        else if($flag==2 && $title!='其它费用')
        {
            msg("请先创建‘其它费用’选项！");
            exit();
        }
	if($fid && $type && $title) {
		$db->query("INSERT INTO tf_form_type (fid,type,title,msg,options,defaultvalue,ismust) VALUES ('$fid', '$type', '$title', '$msg', '$options', '$defaultvalue', '$ismust')");
                $optionlist = $db->getAll("SELECT * FROM tf_form_type WHERE fid='$fid' ORDER BY orderid,id ASC");
                $sql = "";
                foreach ($optionlist AS $option)
                {
                    $title = $option['title'];
                    $type = $option['type'];
                    $defaultvalue = $option['defaultvalue'];
                    $ismust = $option['ismust']==1?' NOT NULL ':' NULL ';
                    $sql .= ' $title $type $ismust ';
                }
                
                msg('添加完成','subok','?action=listoption&fid='.$fid);
	}
} elseif ($action == 'saveeditoption') {
        $fid = $_POST['fid'];
	if($type && $title) {
		$db->query("UPDATE tf_form_type SET type='$type',title='$title',msg='$msg',options='$options',defaultvalue='$defaultvalue',ismust='$ismust' WHERE id='$id'");
		msg('修改成功','subok','?action=editoption&id='.$id."&fid=".$fid);
	}
} elseif($action == 'deloption') {
	if($id && $fid) {
	$db->query("DELETE FROM tf_form_type WHERE fid='$fid' AND id='$id'");
	}
	msg('表单选项已删除', 'subok', '?action=listoption&fid='.$fid);
}
?>
</body>
    <script type="text/javascript">
        $(function() {
            $(".form").Validform({
                tiptype: 2
            });
        });
        function selectForm()
        {
            document.getElementById("add").style.display = "none";
        }
    </script>
</html>

