<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once '../MooPHP/MooConfig.php';
require_once "../ifadmin.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

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
<div class="title">添加考生信息</div>
</div>
<div class="list">
<form name="form" id="form" class="form" method="post" action="user_save.php" enctype="multipart/form-data">
<table cellpadding="0" cellspacing="0" width="100%" class="role_table" id="OwnershipStructure">
<tbody>
<tr>
	<td class="tRight" width="150" rowspan="1" id="StructureLeft1">姓名</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="name" datatype="*" errormsg="姓名不能为空！"></input>
        </td>
        <td>
        <div class="Validform_checktip">
            请填写真实姓名！
        </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">用户名（身份证号）</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="username" datatype="idcard" errormsg="用户名必须为正确身份证号！"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                用户名必须使用<font color="red">身份证号</font>进行注册
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">学号</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="studentid"></input>
        </td>
        <td></td>
</tr>
<tr>
	<td class="tRight" width="150">班号</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="classid"></input>
        </td>
        <td></td>
</tr>
<tr>
        <td class="tRight" width="150">性别</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
            <select name="sex" class="form2">
                <option value="男">男</option>
                <option value="女">女</option>
			</select>
	    </td>
		<td></td>
</tr>
<tr>
        <td class="tRight" width="150">民族</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
            <select name="folk" class="form2">
                <option value="汉族">汉族</option>
                <option value="满族">满族</option>
                <option value="藏族">藏族</option>
                <option value="怒族">怒族</option>
                <option value="仡佬族">仡佬族</option>
                <option value="朝鲜族">朝鲜族</option>
                <option value="撒拉族">撒拉族</option>
                <option value="东乡族">东乡族</option>
                <option value="白族">白族</option>
                <option value="羌族">羌族</option>
                <option value="壮族">壮族</option>
                <option value="阿昌族">阿昌族</option>
                <option value="珞巴族">珞巴族</option>
                <option value="塔吉克">塔吉克</option>
                <option value="景颇族">景颇族</option>
                <option value="侗族">侗族</option>
                <option value="畲族">畲族</option>
                <option value="回族">回族</option>
                <option value="保安族">保安族</option>
                <option value="毛南族">毛南族</option>
                <option value="塔塔尔">塔塔尔</option>
                <option value="德昂族">德昂族</option>
                <option value="京族">京族</option>
                <option value="水族">水族</option>
                <option value="独龙族">独龙族</option>
                <option value="布朗族">布朗族</option>
                <option value="仫佬族">仫佬族</option>
                <option value="土家族">土家族</option>
                <option value="赫哲族">赫哲族</option>
                <option value="黎族">黎族</option>
                <option value="土族">土族</option>
                <option value="鄂伦春">鄂伦春</option>
                <option value="基诺族">基诺族</option>
                <option value="门巴族">门巴族</option>
                <option value="锡伯族">锡伯族</option>
                <option value="维吾尔族">维吾尔族</option>
                <option value="佤族">佤族</option>
                <option value="俄罗斯">俄罗斯</option>
                <option value="拉祜族">拉祜族</option>
                <option value="蒙古族">蒙古族</option>
                <option value="裕固族">裕固族</option>
                <option value="乌孜别克">乌孜别克</option>
                <option value="傣族">傣族</option>
                <option value="瑶族">瑶族</option>
                <option value="鄂温克">鄂温克</option>
                <option value="布依族">布依族</option>
                <option value="纳西族">纳西族</option>
                <option value="哈尼族">哈尼族</option>
                <option value="柯尔克孜">柯尔克孜</option>
                <option value="苗族">苗族</option>
                <option value="彝族">彝族</option>
                <option value="高山族">高山族</option>
                <option value="傈僳族">傈僳族</option>
                <option value="普米族">普米族</option>
                <option value="哈萨克">哈萨克</option>
                <option value="达斡尔">达斡尔</option>
            </select>
        </td>
        <td></td>
</tr>
<tr>
	<td class="tRight" width="150">登录密码</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="password" name="password" datatype="*6-16" nullmsg="请设置密码！" errormsg="密码范围在6~16位之间！"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                密码范围在6~16位之间
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">重复登录密码</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="password" name="password2" datatype="*" recheck="password" nullmsg="请再输入一次密码！" errormsg="您两次输入的账号密码不一致！"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                两次输入密码需一致
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">联系方式</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="tel" datatype="m" errormsg="请正确填写11位手机号码！"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                请填写手机号码！
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">QQ</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="qq"></input>
        </td>
        <td></td>
</tr>
<tr>
	<td class="tRight" width="150">Email</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="email" datatype="e" errormsg="您填写的邮箱格式不正确！"></input>
        </td>
        <td>
            <div class="Validform_checktip">
               邮箱:235454@xx.com
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">最高学历</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
            <select name="zgxl" class="form2" id="zgxl">
                <option value="博士研究生以上">博士研究生以上</option>
                <option value="博士研究生">博士研究生</option>
                <option value="硕士研究生">硕士研究生</option>
                <option value="本科">本科</option>
                <option value="专科">专科</option>
                <option value="高中">高中/中专</option>
                <option value="其它">其它</option>
            </select>
        </td>
        <td></td>
</tr>
<tr>
	<td class="tRight" width="150">最高学位</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
            <select name="zgxw">
                <option value="博士">博士</option>
                <option value="硕士">硕士</option>
                <option value="学士">学士</option>
                <option value="其它">其它</option>
                <option value="无">无</option>
            </select>
        </td>
        <td></td>
</tr>
<tr>
	<td class="tRight" width="150">详细地址</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="address" size='40'></input>
        </td>
        <td></td>
</tr>
<tr>
	<td class="tRight" width="150">照片</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="file" name="pic" id="pic">
        </td>
        <td></td>
</tr>
<tr>
	<td class="tRight" width="150">审核状态</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <select name="stat">
                <option value="0">未审核</option>
                <option value="1">审核通过</option>
                <option value="2">审核未通过</option>
            </select>
        </td>
        <td></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td class="center" colspan="3">
            <input type="submit" value="添 加" name="submit" class="button small">
            <input class="button small" type="reset" value="返 回" onclick="javascript:window.location.href='user_list.php?stats=<?=$_GET["stats"]?>'">
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
                tiptype: 2,
                datatype:{//传入自定义datatype类型【方式二】;
			"idcard":function(gets,obj,curform,datatype){
				//该方法由佚名网友提供;
			
				var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
				var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X;
			
				if (gets.length == 18){   
					var a_idCard = gets.split("");// 得到身份证数组   
					if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {   
						return true;   
					}   
					return false;
				}
				return false;
				
				function isTrueValidateCodeBy18IdCard(a_idCard) {   
					var sum = 0; // 声明加权求和变量   
					if (a_idCard[17].toLowerCase() == 'x') {   
						a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作   
					}   
					for ( var i = 0; i < 17; i++) {   
						sum += Wi[i] * a_idCard[i];// 加权求和   
					}   
					valCodePosition = sum % 11;// 得到验证码所位置   
					if (a_idCard[17] == ValideCode[valCodePosition]) {   
						return true;   
					}
					return false;   
				}
				
				function isValidityBrithBy18IdCard(idCard18){   
					var year = idCard18.substring(6,10);   
					var month = idCard18.substring(10,12);   
					var day = idCard18.substring(12,14);   
					var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
					// 这里用getFullYear()获取年份，避免千年虫问题   
					if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
						return false;   
					}
					return true;   
				}
			}
                }
            });
        });
</script>