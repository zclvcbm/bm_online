<?php
require_once("data/dconfig.php");
require_once("lib/config.php");
require_once("waf/waf.php");
?>

<head>
    <link href="css/bm.css" rel="stylesheet" type="text/css">
    <style>
        BODY{
            FONT-SIZE:9pt;
        }
    </style>
    <style type="text/css" media="print">   
        .pr{display:none}   
    </style>   
    <style type="text/css" media="screen">   
        .t{display:none}   
    </style>   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
    
<?php

$fid = $_REQUEST['fid'];
$sfzh = $_REQUEST['sfzh'];

$fid =$_REQUEST['fid'];
if(empty($fid))
{
    location("./bj_jf_input.php");
}

$db = new MySql();

$sql = "select f.id,f.bmh,f.sfzh,f.jfzt,f.kskm,f.pxkm,f.ksfy,f.pxfy,f.qtfy,u.classid,u.studentid,u.name,u.tel,u.pic,u.stat from form_" .intval($fid). " as f inner join tf_users u on f.sfzh=u.username where sfzh=" .escapeshellarg($sfzh). " and jfzt=0 and stat=1";
$res = $db->getArray($sql);
$num = count($res);
if($num<1)
{
    echo "此身份证号无对应报考信息！";
    die();
}
$hjksfy = 0;
$hjpxfy = 0;
$kskm = "";
for($i=0;$i<$num;$i++)
{
    $hjksfy += $res[$i]['ksfy']; 
    $hjpxfy += $res[$i]['pxfy'];
    $hjqtfy += $res[$i]['qtfy'];
    $kskm .= $res[$i]['kskm'].", ";
}
$kskm = substr($kskm, 0, strlen($kskm)-2);
?>


<body align=left>
    <table width="630" height="200" border="0" align="center" cellpadding="0"  cellspacing="0" bordercolor="#003366" bgcolor="#FFFFFF">
        <tr><td valign="top" align=left>
                <table width="630" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr> 
                        <td align="center" height="30"><b><?=$res['name']?>报名信息表</b></td>
                    </tr>
                    <tr>
                        <td align="left"><br>
                            注：1、请核对个人信息是否准确。<br>
                          &nbsp;&nbsp;2、务必打印完整的页面,即&quot;个人报名信息表&quot;+&quot;缴费通知单&quot;+&quot;缴费确认单&quot;,然后到农行三峡大学支行（SOGO广场对面）缴缴费。<br>
                            &nbsp;&nbsp;3、凭盖有银行公章公章的缴费通知单到继续教育学院培训部办公室（接待中心附楼一楼6100室）办理确认手续。<br>
                        </td>
                    </tr>
                </table>
        </tr> 
    </table>


<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
        <td align="center" height="30" style=" border-color:#333"><b>缴费通知单</b></td>
    </tr>
    <tr>
        <td align="left" style=" font-size:13px;border-color:#333">   
            <b><font color="red">特别提示</font></b>凭此表到到农行三峡大学支行（SOGO广场对面）缴费并盖章。再将盖章后的报名信息表（上页）和缴费通知单（下页）在规定时间内送交继续教育学院培训部办公室（接待中心附楼一楼6100室）进行确认，不确认的报名无效。<br />
        </td>
    </tr>
</table>
<table width="800" border="1" cellspacing="0" cellpadding="0" align="center" style=" font-size:15px;border-color:#333" >
    <tr style="border-color:#333;height: 25px;"><td  colspan=3 style=" font-size:15px;border-color:#333">考试项目：<?=$kskm?></td><td><img width="50" height="60" src="<?=$res[0]['pic']?>"/></td></tr>
    <tr style="border-color:#333;height: 25px;"><td style=" font-size:15px;border-color:#333">所在学院</td><td style=" border-color:#333">&nbsp;</td><td style=" border-color:#333">学号</td><td style=" border-color:#333">&nbsp;<?=$res[0]['studentid']?></td></tr>
    <tr style="border-color:#333;height: 25px;"><td style=" font-size:15px;border-color:#333">姓名</td><td style=" border-color:#333" width="300">&nbsp;<?=$res[0]['name']?></td><td style=" border-color:#333">班号</td><td style=" border-color:#333">&nbsp;<?=$res[0]['classid']?></td></tr>
    <tr style="border-color:#333;height: 25px;"><td style=" font-size:15px;border-color:#333">考试费</td><td colspan=3 style=" border-color:#333">&nbsp;<?=$hjksfy ?>元</td></tr>
    <tr style="border-color:#333;height: 25px;"><td style=" font-size:15px;border-color:#333">培训费</td><td colspan=3 style=" border-color:#333">&nbsp;<?=$hjpxfy ?>元</td></tr>
    <td style=" font-size:15px;border-color:#333">其它费用</td><td colspan=3 style=" border-color:#333">&nbsp;<?=$hjqtfy ?>元</td></tr>
    <tr style="border-color:#333;height: 25px;"><td colspan=4 style=" border-color:#333">合计:&nbsp;<?php echo $hjksfy+$hjpxfy+$hjqtfy?>元</td></tr>
</table>

<table width="800" align="center">
    <tr>
        <td>★银行签章处,请跨越两个表格,以便撕开后两联都有红章,感谢!!!★</td>
        <td><HR></td>
    </tr>
</table>
<br/>
<br/>
<!--
<table width="630" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
    </tr>
    <tr>
        <td align="left" style=" font-size:13px;border-color:#333">
            <p><b>缴费确认单 <font color="red">特别提示</font></b>：此联由考生留存，由考试部工作人员收取信息表和缴费通知单后签字有效，开考前务必保存好。</p>
        </td>
    </tr>
</table>
<table width="800" border="1" cellspacing="0" cellpadding="0" align="center" style=" border-color:#333" >
    <tr style="border-color:#333;height: 25px;"><td  colspan=4 style=" border-color:#333">考试项目：<?=$kskm?></td></tr>
    <tr style="border-color:#333;height: 25px;"><td style=" border-color:#333">所在学院</td><td style=" border-color:#333">&nbsp;</td><td style=" border-color:#333">学号</td><td style=" border-color:#333">&nbsp;<?=$res[0]['studentid']?></td></tr>
    <tr style="border-color:#333;height: 25px;"><td style=" border-color:#333">姓名</td><td style=" border-color:#333" width="300">&nbsp;<?=$res[0]['name']?></td><td style=" border-color:#333">班号</td><td style=" border-color:#333">&nbsp;<?=$res[0]['classid']?></td></tr>
    <tr style="border-color:#333;height: 25px;"><td style=" border-color:#333">考试费</td><td colspan=3 style=" border-color:#333">&nbsp;<?=$hjksfy?>元</td></tr>
    <tr style="border-color:#333;height: 25px;"><td style=" border-color:#333">培训费</td><td colspan=3 style=" border-color:#333">&nbsp;<?=$hjpxfy?>元</td></tr>
    <tr style="border-color:#333;height: 25px;"><td colspan=4 style=" border-color:#333">合计:&nbsp;<?php echo $hjksfy+$hjpxfy?>元</td></tr>
</table>
-->
</body>