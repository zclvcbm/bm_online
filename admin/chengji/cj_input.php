<?php
session_start();
//note 加载MooPHP框架
require_once'../MooPHP/MooPHP.php';
//note:加载配置文件
require_once'../MooPHP/MooConfig.php';
require_once("../ifadmin.php");

$table = "tf_cj";

$sql="select c.*,u.name,u.tel,u.sex from ".$table."  c left join tf_users u on c.sfzh=u.username where c.id=".escapeshellarg($_GET['id']);
//echo $sql;
$zkz=$db->getOne($sql);
//print_r($zkz);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0063)http://www.ddphp.cn/bm/dadmin/user_edit.php?id=1607&action=edit -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="main">
<div class="content">
<div class="title">考生成绩信息</div>
</div>
<div class="list">
<table cellpadding="0" cellspacing="0" width="100%" class="role_table" id="OwnershipStructure">
<tbody>
<tr>
	<td class="tRight" width="150" rowspan="1" id="StructureLeft1">姓名</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
           <label><?php echo $zkz['name']; ?></label>
        </td>
</tr>
<tr>
	<td class="tRight" width="150" rowspan="1" id="StructureLeft1">名称</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
           <label><?php echo $zkz['mc']; ?></label>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">等级</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <label><?php echo $zkz['level']; ?></label>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考生身份证号</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <label><?php echo $zkz['sfzh']; ?></label>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">准考证号</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <label><?php echo $zkz['zkzh']; ?></label>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">证书编号</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <label><?php echo $zkz['zsbh']; ?></label>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">性别</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <label><?php echo $zkz['sex']; ?></label>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">联系方式</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
           <label><?php echo $zkz['tel']; ?></label>
        </td>   
</tr>
<?php
    $cid = $zkz['cj_type_id'];
    $sql = "select cjtype from tf_cj_type where id=".$cid;
    $res=$db->getOne($sql);
    $types = explode("|", $res['cjtype']);
    //print_r($types);
    
    foreach ($types as $key =>$type) {
       $key=$key+1;
       echo '<tr>
           <td class="tRight" width="150">'.$type.'</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
           <label>'.$zkz['cj'.$key].'</label>
        </td>
        </tr>'; 
    }
?>
<tr>
	<td class="tRight" width="150">成绩状态</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
           <label><?php echo $zkz['cj_stats']==1?"合格":"不合格"; ?></label>
        </td>   
</tr>
<tr>
	<td>&nbsp;</td>
	<td class="center">
	 <input type="reset" class="button small" onclick="javascript:window.location.href='cj_list.php'" value="返 回"></td>
</tr>
</tbody>
</table>
</script> 
</form>
</div>
</div>
</body>
</html>