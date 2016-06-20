<?php
session_start();
require_once("data/dconfig.php");
require_once("lib/config.php");
require_once './ifuser.php';

$db = new MySql();

$uid = $_SESSION['uid'];
$cj_sql = $sql="select c.*,u.name,u.sex from tf_cj  c left join tf_users u on c.sfzh=u.username where u.uid=".$uid." order by id desc limit 0,15";
//echo $cj_sql;
$result = $db->getArray($sql);
//print_r($result);
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
<span></span>成绩列表
</h1>
<div class="info-edit">
  <table width="98%" cellpadding="0" cellspacing="0">
            <tbody>
                <tr align="center">
                    <th align="center">序号</th>
                    <th align="center" width="25%">考试名称</th>
                    <th align="center" width="25%">考试等级</th>
                    <th align="center">成绩1</th> 
                    <th align="center">成绩2</th>
                    <th align="center">成绩3</td>
                    <th align="center">成绩4</td>
					<th align="center">是否合格</td>
                </tr>
                <?php
                $i = 1;
                foreach ($result as $key => $item) {
                    ?>
                    <tr >
                        <td align="center"><?php echo $i ?></td>
                        <td align="center"><?php echo $item['mc'] ?></td>
                        <td align="center"><?php echo $item['level'] ?></td>
                        <td align="center"><?php echo $item['cj1']."" ?></td>
                        <td align="center"><?php echo $item['cj2']."" ?></td>
                        <td align="center"><?php echo $item['cj3']."" ?></td>
                        <td align="center"><?php echo $item['cj4']."" ?></td>
						<?php if ($item['cj_stats'] == 1) {
                                echo '<td align="center">是</td>
                                    ';
                            }
                            else
                            {
                                echo '<td align="center">否</td>';                               
                            }
                        ?>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
                <tr><td colspan="7" class="bottomTd" height="5"></td></tr></tbody></table>
</div>
</body>