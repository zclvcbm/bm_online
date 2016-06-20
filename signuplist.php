<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
require_once("data/dconfig.php");
require_once("lib/config.php");
require_once("lib/fun_html.php");
require_once './ifuser.php';
session_start();

$db = new MySql();
//删除
if ($_GET['del'] == 1 && !empty($_GET['fid']) && !empty($_GET['id']))
{
    /* 取得过滤条件 */
    $sql = 'delete from form_'.$_GET['fid'].' where id='.escapeshellarg($_GET['id']);
    $ip = ip();
    $data_sql = "insert into tf_database_log(username,ip,type,info,lastdate) values ('$_SESSION[username]','$ip','delete','$sql',now())";
    $res = $db->query($sql);
    $r = $db->query($data_sql);
    if($db->affected_rows()>0)
    {
        $db->query("COMMIT");
	 echo "<script>alert('删除成功');</script>";
    }
    else{
        $db->query("ROLLBACK");
    }
}

$fid_sql = "select  DISTINCT fid from tf_kkhb ";

$tablist = $db->getArray($fid_sql);

$sql_bksj = "";
foreach ($tablist as $key => $tb) {
    $sql_bksj.=" select id,sfzh,bmh,jfzt,shzt,kskm,ksfy,pxfy,qtfy,val2,'" . $tb['fid'] . "' as fid  from form_" . $tb['fid'] . "  where sfzh='" . $_SESSION['username'] . "'  union ";
}
$sql = substr_replace($sql_bksj, '', -6);
//echo $sql;
$result = $db->getArray($sql);
?>
<link href="tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="tablecloth/tablecloth.js"></script>
<style>
    .info-edit{margin:0 auto;padding:0 10px;}
    .info-edit-top ul{ padding:10px 0 10px; height:23px; border-bottom:1px solid #DADADA; }
    .info-edit-top ul li{ float:left; padding:0 50px 0 10px; height:18px; font:bold 18px "Microsoft Yahei"; color:#666; }
    .info-edit-top ul li em{ margin-right:5px; padding:2px 5px; background:#999; color:#FFF; font-size:12px; font-family:Verdana, Geneva, sans-serif; }
    .info-edit-top .step .step1,
    .info-edit-top .stepeduSubmit .step2,
    .info-edit-top .stepexamSubmit .step3,
    .info-edit-top .stepcheckerror .step2,
    .info-edit-top .stepverify .step2,
    .info-edit-top .stepsucceed .step2,
    .info-edit-top .stepsucceed .step3{color:#FF6C1E;}
    .info-edit-top .step .step1 em,
    .info-edit-top .stepeduSubmit .step2 em,
    .info-edit-top .stepexamSubmit .step3 em,
    .info-edit-top .stepcheckerror .step2 em,
    .info-edit-top .stepverify .step2 em,
    .info-edit-top .stepsucceed .step2 em,
    .info-edit-top .stepsucceed .step3 em{background:#FF6C1E; }
    .info-edit-top ul li span{ float:right; font-size:12px;font-weight:100;margin:5px 5px 0 0;}
    a{color:#3B8DD1;text-decoration:none;}a:hover{color:#8CAC52;}
    .main_tit{border-bottom:1px solid #EEE;color:#444;font-size:18px;margin:0 0 20px;padding:0 0 10px;}
</style>

   
<body style="overflow-x:hidden;overflow-y:auto">
<!--修改资料-->
<h1 class="main_tit">
<span></span>已报科目
</h1>
<div class="info-edit" >
   <table width="98%" cellpadding="0" cellspacing="0" >
            <tbody>
                <tr align="center">
                    <th align="center">序号</th>
                    <th align="center">报名号</th>
                    <th align="center" width="30%">报考科目</th>
                    <th align="center">考试费</th>
                    <th align="center">培训费</th> 
                    <th align="center">其它费用</th>
                    <th align="center">总费(元)</th> 
                    <th align="center">缴费状态</th>
					
                    <th align="center">操作</th>
					
                </tr>
                <?php
                $i = 1;
                foreach ($result as $key => $item) {
                    ?>
                    <tr >
                        <td align="center"><?php echo $i ?></td>
                        <td align="center"><?php echo $item['bmh'] ?></td>
                        <td align="center"><?php echo $item['kskm'] ?></td>
                        <td align="center"><?php echo $item['ksfy'] ?></td>
                        <td align="center"><?php echo $item['pxfy'] ?></td>
                        <td align="center"><?php echo $item['val2'] ?></td>
                        <td align="center"><?php echo $item['pxfy'] + $item['ksfy'] + $item['qtfy'];?></td>
                            <?php if ($item['jfzt'] == 1) {
                                echo '<td align="center">已缴费</td>
                                    ';
                            }
                            else
                            {
                                echo '<td align="center">未缴费</td>';                               
                            }
                            ?>
							
                        <td align="center">
                            <?php if($item['jfzt']==0) { ?>
                                <a href="signuplist.php?del=1&id=<?php echo $item['id'];?>&fid=<?php echo $item['fid'];?>" onclick="return confirm('确定要删除吗？');">删除</a>
                            <?php } ?>
                        </td>
						
                    </tr>
                    <?php
                    $i++;
                }
                ?>
                <tr><td colspan="7" class="bottomTd" height="5"></td></tr></tbody></table>
</div>
</body>