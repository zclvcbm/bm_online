<?php
require_once("data/dconfig.php");
require_once("lib/config.php");
require_once("waf/waf.php");
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
</head>

<?php

$fid =$_REQUEST['fid'];
$classid = $_REQUEST['classid'];
$db = new MySql();

$fnames = $db->getOne("select fname from tf_form where fid=".$fid);
$fname = $fnames['fname'];
//print_r($_GET);
if($_GET['isDel']==1)
{
    $bmh = $_GET['bmh'];
    $sql = "insert into temp_bj_del (select * from temp_bj where bmh='".$bmh."')";
    //echo $sql;
    $db->query($sql);
    $sql = "delete from temp_bj where bmh='".$bmh."'";
    //echo $sql;
    $db->query($sql);
}
else if($_GET['isDel']==2)
{
    $bmh = $_GET['bmh'];
    $sql = "insert into temp_bj (select * from temp_bj_del where bmh='".$bmh."')";
    $db->query($sql);
    $sql = "delete from temp_bj_del where bmh='".$bmh."'";
    $db->query($sql);
}
else
{
    // $sql = "select f.id,f.bmh,f.sfzh,f.jfzt,f.kskm,f.pxkm,f.ksfy,f.pxfy,f.qtfy,f.val2,u.studentid,u.name,u.tel,u.pic,u.stat from form_".$fid." as f inner join tf_users u on f.sfzh=u.username where classid=".$classid." and jfzt=0 and stat=1";
    $sql = "select f.id,f.bmh,f.sfzh,f.jfzt,f.kskm,f.pxkm,f.ksfy,f.pxfy,f.qtfy,f.val2,u.classid,u.studentid,u.name,u.tel,u.pic,u.stat from form_".$fid." as f inner join tf_users u on f.sfzh=u.username where classid='".$classid."' and jfzt=0 and stat=1 order by convert(u.name using gbk) asc";//给.$classid.加引号防止有字母的班打不出来信息
		//echo $sql;

    $res = $db->getArray($sql);

    $num = count($res);
    if($num<1)
    {
        echo "此班级无对应报考信息！";
        die();
    }
    //先清空临时表
    $db->query("delete from temp_bj where classid='".$classid."'");
    $db->query("delete from temp_bj_del where classid='".$classid."'");
    $temp = "insert into temp_bj ".$sql;
    //echo $temp;
    $db->query($temp);
    
    
}


?>

<body align=left>
    <table width="630" height="277" border="0" align="center" cellpadding="0"  cellspacing="0" bordercolor="#003366" bgcolor="#FFFFFF">
        <tr><td valign="top" align=left>
                <table width="630" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr> 
                        <td align="center" height="30"><b><?=$fname?><?=$_REQUEST['classid']?>班报名信息表</b></td>
                    </tr>
                    <tr>
                        <td align="left"><br>
                            注：1、以班为单位下载并打印信息表,按报名信息表收取报名费。<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;2、如果有考生没有缴费，请删除未缴费考生的信息后重新打印。<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;3、收取报名费时，必须要求考生核对个人信息是否准确。<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;4、务必打印完整的页面,即&quot;班级报名信息表&quot;+&quot;缴费通知单&quot;+&quot;缴费确认单&quot;,然后到农行三峡大学支行（SOGO广场对面）缴费。<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;5、凭盖有银行公章的缴费通知单到继续教育学院培训部办公室（接待中心附楼一楼6100室）办理确认手续。<br>

                        </td>
                    </tr>
                </table>

                <table width="700" border="1" cellspacing="0" cellpadding="0"  bordercolor="#B8DDED" align="center">

                    <tr align="center" valign=middle style="height:25px;"> 
                        <td ><font color="#000000">序号</font></td>
                        <td  ><font color="#000000">身份证号</td>
                        <td  ><font color="#000000">姓名</font></td>
                        <td width="100" ><font color="#000000">考试项目</font></td>
                        <td  ><font color="#000000">考试费用</font></td>
                        <td  ><font color="#000000">培训费用</font></td>
                        <td  ><font color="#000000">其它费用</font></td>
                        <td  ><font color="#000000">总费用</font></td>
                        <td  ><font color="#000000">联系电话</font></td>
                        <td  ><font color="#000000">照片</font></td>
                        <td class="pr"><font color="#000000">管&nbsp;理</font></td>
                    </tr>
                    <?php
                        $sql = "select * from temp_bj where classid='".$classid."'";
                        //echo $sql;
                        $result1 = $db->getArray($sql);
                        //print_r($result1);
                        $i=1;
                        $kshjfy = 0;
                        $pxhjfy = 0;
                        $qthjfy = 0;
                        $names = "";
                        foreach ($result1 as $key => $item) {
           
                        $kshjfy += $item['ksfy'] ;
                        $pxhjfy += $item['pxfy'] ;
                        $qthjfy += $item['qtfy'] ;
                        $names .=$item['name'].",";
                    ?>  
                    <tr height="20" align="center">
                        <td width="5%"><?=$i?></td>
                        <td width="15%"><?php echo substr($item['sfzh'], 0,10).'****'.substr($item['sfzh'], 14,6); ?></td> 
                        <td width="8%"><?=$item['name']?></td>
                        <td width="20%"><?=$item['kskm']?></td>
                        <td width="8%"><?=$item['ksfy']?></td>
                        <td width="8%"><?=$item['pxfy']?></td>
                        <td width="8%"><?=$item['val2'];?></td>
                        <td width="8%"><?php echo $item['ksfy']+$item['pxfy']+$item['qtfy'];?></td>
                        <td width="15%"><?php echo substr($item['tel'], 0,3).'****'.substr($item['tel'], 7,4); ?></td>
                        <td width="5%"><img width="20" height="20" src="<?=$item['pic']?>"/></td>
                        <td width="10%" class="pr">
                            <a href="bj_jf.php?bmh=<?=$item['bmh']?>&classid=<?=$_REQUEST['classid']?>&fid=<?=$_REQUEST['fid']?>&isDel=1">删除</a><br>
                            <a href="bj_jf1.php?sfzh=<?=$item['sfzh']?>&fid=<?=$_REQUEST['fid']?>"><?php if($classid=='90000000') echo '打印';?></a></td>
                    </tr>
                    <?php
                            $i++;
                        }
                        $hjzfy = $kshjfy+$pxhjfy+$qthjfy;
                    ?>
                    <tr align="center" bgcolor="#ffffff"> 
                        <td colspan="7">合计</td>
                        <td align="center"><?=$hjzfy?></td>
                        <td  colspan=3>&nbsp;</td>
                    </tr>
                </table>
        </tr> 
    </table>

<p align=center>已经删除学生信息列表</p>
<table width="700" border="1" cellspacing="0" cellpadding="0"  bordercolor="#B8DDED" align="center">
    <tr align="center" valign=middle style="height:25px;"> 
        <td><font color="#000000">序号</font></td>
        <td><font color="#000000">身份证号</td>
        <td><font color="#000000">姓名</font></td>
        <td width="100" ><font color="#000000">考试项目</font></td>
        <td><font color="#000000">考试费用</font></td>
        <td><font color="#000000">培训费用</font></td>
        <td><font color="#000000">其它费用</font></td>
        <td><font color="#000000">总费用</font></td>
        <td><font color="#000000">联系电话</font></td>
        <td><font color="#000000">照片</font></td>
        <td class="pr"><font color="#000000">管&nbsp;理</font></td>
    </tr>
    <?php
        $j=1;
        $sql = "select * from temp_bj_del where classid='".$classid."'";
        //echo $sql;
        $result2 = $db->getArray($sql);
        foreach ($result2 as $key => $item) {
    ?>
    <tr height="20" align="center">
        <td width="5%"><?= $j ?></td>
        <td width="15%"><?php echo substr($item['sfzh'], 0,10).'****'.substr($item['sfzh'], 14,6); ?></td> 
        <td width="8%"><?= $item['name'] ?></td>
        <td width="20%"><?= $item['kskm'] ?></td>
        <td width="8%"><?= $item['ksfy'] ?></td>
        <td width="8%"><?= $item['pxfy'] ?></td>
        <td width="8%"><?=$item['val2'];?></td>
        <td width="8%"><?php echo $item['ksfy'] + $item['pxfy']+$item['qtfy']; ?></td>
        <td width="15%"><?php echo substr($item['tel'], 0,3).'****'.substr($item['tel'], 7,4); ?></td>
        <td width="5%"><img width="20" height="20" src="<?=$item['pic']?>"/></td>
        <td width="10" class="pr"><a href="bj_jf.php?bmh=<?=$item['bmh']?>&classid=<?=$_REQUEST['classid']?>&fid=<?=$_REQUEST['fid']?>&isDel=2">恢复</a></td>
    </tr> 
    </tr>
    <?php
            $j++;
        }
    ?>
    
</table>
</tr> 
</table>

<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
        <td align="center" height="30" style=" font-size:13px;border-color:#333"><b>缴费通知单</b></td>
    </tr>
    <tr>
        <td align="left" style=" font-size:13px;border-color:#333">   
            <b><font color="red">特别提示</font></b>：每班将本班所有报名、培训费收齐后，凭此表到农行三峡大学支行（SOGO广场对面）缴费并盖章。再将盖章后的报名信息表（上页）和缴费通知单（下页）在规定时间内送交继续教育学院培训部办公室（接待中心附楼一楼6100室）进行确认，不确认的报名无效。<br />
        </td>
    </tr>
</table>
<table width="700" border="1" cellspacing="0" cellpadding="0" align="center" style="font-size:36px; border-color:#333" >
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td  colspan=4 style=" font-size:13px;border-color:#333">考试项目：<?=$result1[0]['kskm']?></td></tr>
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td style=" font-size:13px;border-color:#333">所在学院</td><td style=" font-size:13px;border-color:#333">&nbsp;</td><td style=" font-size:13px;border-color:#333">班级号</td><td style=" font-size:13px;border-color:#333">&nbsp;<?=$classid?></td></tr>
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td style=" font-size:13px;border-color:#333">姓名</td><td style=" font-size:13px;border-color:#333" width="300">&nbsp;<?=$names?></td><td style=" font-size:13px;border-color:#333">报考人数</td><td style=" font-size:13px;border-color:#333">&nbsp;<?=($i-1)?></td></tr>
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td style=" font-size:13px;border-color:#333">考试费</td><td colspan=3 style=" font-size:13px;border-color:#333">&nbsp;<?=$kshjfy?>元</td></tr>
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td style=" font-size:13px;border-color:#333">培训费</td><td colspan=3 style=" font-size:13px;border-color:#333">&nbsp;<?=$pxhjfy?>元</td></tr>
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td style=" font-size:13px;border-color:#333">其它费用</td><td colspan=3 style=" font-size:13px;border-color:#333">&nbsp;<?=$qthjfy?>元</td></tr>
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td colspan=4 style=" font-size:13px;border-color:#333">合计:&nbsp;<?=$hjzfy?>元</td></tr>
	<?php
                     $sql_tj="select DISTINCT kskm,count(*) as sl  from temp_bj where classid='".$classid."' group by kskm order by convert(kskm using gbk)";
                     $tj= $db->getArray($sql_tj);
                        //print_r($result1);
                        $k=1;
                        foreach ($tj as $key => $item) {
           
                    ?>  
                       <tr style="font-size:13px;border-color:#333;height: 20px;"><td  colspan=4 style=" font-size:13px;border-color:#333">报考：<?=$item['kskm']?>（<?=$item['sl']?>人）</td></tr>
                    <?php
                            $k++;
                        }
                       
                    ?>
	<tr><td colspan=4 height="50">班级代理人签名：</td></tr>
</table>

<table width="700" align="center">
<tr>
        <td>★银行签章处；,感谢!!!★</td>
        <td><HR></td>
    </tr>
</table>

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
<table width="700" border="1" cellspacing="0" cellpadding="0" align="center" style=" font-size:13px;border-color:#333" >
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td  colspan=4 style=" font-size:13px;border-color:#333">考试项目：<?=$result1[0]['kskm']?></td></tr>
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td style=" font-size:13px;border-color:#333">所在学院</td><td style=" font-size:13px;border-color:#333">&nbsp;</td><td style=" font-size:13px;border-color:#333">班级号</td><td style=" font-size:13px;border-color:#333">&nbsp;<?=$classid?></td></tr>
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td style=" font-size:13px;border-color:#333">姓名</td><td style=" font-size:13px;border-color:#333" width="300">&nbsp;<?=$names?></td><td style=" font-size:13px;border-color:#333">报考人数</td><td style=" font-size:13px;border-color:#333">&nbsp;<?=($i-1)?></td></tr>
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td style=" font-size:13px;border-color:#333">考试费</td><td colspan=3 style=" font-size:13px;border-color:#333">&nbsp;<?=$kshjfy?>元</td></tr>
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td style=" font-size:13px;border-color:#333">培训费</td><td colspan=3 style=" font-size:13px;border-color:#333">&nbsp;<?=$pxhjfy?>元</td></tr>
    <tr style="font-size:13px;border-color:#333;height: 20px;"><td colspan=4 style=" font-size:13px;border-color:#333">合计:&nbsp;<?=$hjzfy?>元</td></tr>
</table>
-->
</body>