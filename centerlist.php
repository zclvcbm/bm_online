<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>报名系统</title>
        <meta name="keywords" content="报名系统">
        <meta name="description" content="报名系统！">
        <meta content="报名系统" name="keywords">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link media="screen" type="text/css" href="./css/style.css" rel="stylesheet">
        <script type="text/javascript" src="./js/jquery.min.js"></script>
        <style>
            .main_tit{border-bottom:1px solid #EEE;color:#444;font-size:18px;margin:0 0 20px;padding:0 0 10px;}
        </style>
    </head>


<?php
require_once("data/dconfig.php");
require_once("lib/config.php");
require_once('./ifuser.php');

//session_start();
//$uid = $_SESSION['uid'];
$db = new MySql();
$cur_date = date('y-m-d',time());
$sql = "select t.*,f.fname from tf_kkhb t,tf_form f where t.fid=f.fid and end_time>='".$cur_date."' order by id desc";
$result = $db->getArray($sql);
//print_r($result);
?>

<!--修改活动列表-->
<h1 class="main_tit">
<span></span>活动列表
</h1>
<table border="0" width="90%" cellpadding="0" cellspacing="0" align="center">
    <?php
    foreach ($result as $key => $exam) {
        ?>
        <tr height="50">
            <td><?php echo $exam['fname']; ?></td> 
            <td>起止时间：（<?php echo $exam['start_time'] . " 到 " . $exam['end_time']; ?>)</td>
            <td><a target="_self" onclick="checktime(<?php echo strtotime($exam['start_time']);?>,<?=$exam['fid']?>)">我要报名</a></td>
        </tr>
        <?php
    }
    ?>
</table>
<!--修改活动列表-->
<script>
    function checktime(time,fid)
    {
        var curtime = Date.parse(new Date());
        var curtime =curtime/1000;
        if(curtime<time)
        {
            alert("报名还未开始！");
            return false;
        }
        else
            {
                window.location.href="exam_detail.php?fid="+fid;
                return true;
            }
    }
</script>