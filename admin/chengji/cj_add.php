<?php
session_start();
//note 加载MooPHP框架
require_once'../MooPHP/MooPHP.php';
//note:加载配置文件
require_once'../MooPHP/MooConfig.php';
require_once("../ifadmin.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0063)http://www.ddphp.cn/bm/dadmin/user_edit.php?id=1607&action=edit -->
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
<div class="title">考生成绩录入</div>
</div>
<div class="list">
<form name="form" id="form" class="form" method="post" action="cj_save.php" enctype="multipart/form-data">
<table cellpadding="0" cellspacing="0" width="100%" class="role_table" id="OwnershipStructure">
<tbody>
<tr>
	<td class="tRight" width="150" rowspan="1" id="StructureLeft1">考试名称</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="mc" datatype="*" errormsg="姓名不能为空！"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">成绩类别</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <select name="cj_type">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考试等级</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="level"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                必填
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">身份证号</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="sfzh" datatype="s15-18" errormsg="用户名必须为正确身份证号！"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                填写正确的身份证号
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">准考证号</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="zkzh"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">证书编号</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="zsbh"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">联系电话</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="lxdh" datatype="m" errormsg="请正确填写11位手机号码！"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                填写手机号码
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">成绩一</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="cj1"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">成绩二</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="cj2"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">成绩三</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="cj3"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">成绩四</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <input type="text" name="cj4"></input>
        </td>
        <td>
            <div class="Validform_checktip">
                
            </div>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">是否合格</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <select name="cj_stats">
                <option value="1">合格</option>
                <option value="0">不合格</option>
            </select>
        </td>
        <td>
            <div class="Validform_checktip">
                
            </div>
        </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td class="center" colspan="3">
            <input type="submit" value="添 加" name="submit" class="button small">
            <input type="reset" value="重 置" name="reset" class="button small">
            <input class="button small" type="reset" value="返 回" onclick="javascript:window.location.href='cj_list.php'">
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
<script>
    function IdentityCodeValid(code) { 
            var city={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江 ",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北 ",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏 ",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外 "};
            var tip = "";
            var pass= true;
            
            if(!code || !/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i.test(code)){
                tip = "身份证号格式错误";
                pass = false;
            }
            
           else if(!city[code.substr(0,2)]){
                tip = "地址编码错误";
                pass = false;
            }
            else{
                //18位身份证需要验证最后一位校验位
                if(code.length == 18){
                    code = code.split('');
                    //∑(ai×Wi)(mod 11)
                    //加权因子
                    var factor = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2 ];
                    //校验位
                    var parity = [ 1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2 ];
                    var sum = 0;
                    var ai = 0;
                    var wi = 0;
                    for (var i = 0; i < 17; i++)
                    {
                        ai = code[i];
                        wi = factor[i];
                        sum += ai * wi;
                    }
                    var last = parity[sum % 11];
                    if(parity[sum % 11] != code[17]){
                        tip = "校验位错误";
                        pass =false;
                    }
                }
            }
            if(!pass) alert(tip);
            return pass;
        }
        
</script>