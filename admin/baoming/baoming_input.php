<?php
session_start();
//note 加载MooPHP框架
require_once '../MooPHP/MooPHP.php';
//note:加载配置文件
require_once'../MooPHP/MooConfig.php';
require_once("../ifadmin.php");

$table = "form_".intval($_GET['fid']);

$sql = " SELECT *,a.id bid FROM ".$table." a left join tf_users b on a.sfzh=b.username WHERE a.id=".escapeshellarg($_GET['id']);
$zkz=$db->getOne($sql);

//print_r($zkz);
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
<body>
<div class="main">
<div class="content">
<div class="title">报考信息</div>
</div>
<div class="list">
<table cellpadding="0" cellspacing="0" width="100%" class="role_table" id="OwnershipStructure">
<tbody>
<tr>
	<td class="tRight" width="150" rowspan="1" id="StructureLeft1">报名号</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
           <label><?php echo $zkz['bmh']; ?></label>
        </td>
</tr>
<tr>
	<td class="tRight" width="150" rowspan="1" id="StructureLeft1">姓名</td>
        <td class="tLeft" rowspan="1" id="StructureLeft2" >
           <label><?php echo $zkz['name']; ?></label>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考试科目</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <label><?php echo $zkz['kskm']; ?></label>
        </td>
</tr>
<tr>
	<td class="tRight" width="150">考生身份证号</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
            <label><?php echo $zkz['sfzh']; ?></label>
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
<tr>
	<td class="tRight" width="150">缴费状态</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
           <label><?php if($zkz["jfzt"]==1) echo "已缴费";else echo "未缴费";?></label>
        </td> 
</tr>
<tr>
	<td class="tRight" width="150">审核状态</td>
	<td class="tLeft" rowspan="1" id="StructureLeft2" >
           <label><?php if($zkz["stat"]==1) echo "审核通过";elseif($zkz["stat"]==0) echo "未审核"; else echo "审核未通过"; ?></label>
        </td> 
</tr>
<?php
    $fj_sql = "select * from form_fj where fid=".$_GET['fid']." and username='".$zkz['sfzh']."'";
    //echo $fj_sql;   
    $fj_result = mysql_query($fj_sql);
    $count = mysql_numrows($fj_result);

    $i = 1;
    //while ($fj_data = mysql_fetch_array($fj_result)) {
    for($j=0;$j<$count;$j++){
    $fj_data = mysql_fetch_array($fj_result);
?>
        <tr>
            <td class="tRight" width="150">
                <div align="right">
                    已上传附件<?php echo $i++; ?>：
                </div></td>
            <td class="tLeft" rowspan="1" id="StructureLeft2">
                <div align="left" style="float:left">
                    <a width="200px" href="<?php echo "../../".$fj_data['nfilename']; ?>"><?PHP echo $fj_data['filename']; ?></a>
                </div>
            </td>
        </tr>     
<?php
    }
?>    
<tr>
        <td>&nbsp;</td>
        <td class="center">
            <input type="reset" class="button small" onclick="javascript:window.location.href='baoming_list.php?fid=<?= $_GET['fid'] ?>'" value="返 回"></td>
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