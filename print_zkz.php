<?php
require_once("data/dconfig.php");
require_once("lib/config.php");
require_once('./ifuser.php');
session_start();

$mc = $_POST['mc'];
$sfzh = $_SESSION['username'];

$db = new MySql();
$sql = "select z.*,u.* from tf_zkzh z left join tf_users u on z.sfzh = u.username where mc='".$mc."' and sfzh='".$sfzh."'";

$results = $db->getArray($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0028)http://210.42.38.102/zkz.php -->
<html xmlns="http://www.w3.org/1999/xhtml"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>准考证打印</title>
<style type="text/css">
.bt {
	font-size: 24px;
}
.lr {
	font-size: 18px;
}
.table-d table{border:1px solid #000;border-collapse: collapse}
.table-d table td{border:1px solid #000;height:22px;}
</style>
</head>
<body>
<style media="print">.printer {display:none;}</style>
<p align="center"><button type="button" onclick="window.print()" class="printer">打印本页</button></p>

<?php
    foreach($results as $result) {

?>
<p align="center" class="bt">准考证打印</p>

<div align="center" class="table-d">
  <table width="560" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
      <td colspan="4"><div align="center"><b>准考证</b></div></td>
    </tr>
    <tr>
      <td  width="100"><div align="right">考生姓名</div></td>
      <td colspan="2"><?=$result['name']?></td>
      <td rowspan="5"><img src="<?=$result['pic']?>" width="144" height="192" align="middle"></td>
    </tr>
    <tr>
      <td><div align="right">性别</div></td>
      <td colspan="2"><?=$result['sex']?></td>
    </tr>
   <tr>
      <td><div align="right">证件号</div></td>
      <td colspan="2"><?=$result['username']?></td>
    </tr>
   <tr>
      <td><div align="right">准考证号</div></td>
      <td colspan="2"><?=$result['zkzh']?></td>
    </tr>
	<?php
    if($sskssj=='') {

    ?>
    <tr>
      <td><div align="right">科&nbsp;&nbsp;目</div></td>
      <td colspan="2"><?=$result['level']?></td>
    </tr>
    <tr>
      <td><div align="right">考&nbsp;&nbsp;点</div></td>
      <td colspan="3">三峡大学</td>
    </tr>
	<tr>
      <td><div align="right" >考&nbsp;&nbsp;场</div></td>
      <td colspan="3"><div align="left" ><?=$result['llksdd']?></div></td>
    </tr>
	<tr>
      <td><div align="right" >考试时间</div></td>
      <td colspan="3"><div align="left" ><?=$result['llkssj']?></div></td>
    </tr>
	<tr>
      <td><div align="right" >报名号</div></td>
      <td colspan="3"><div align="left" ><?=$result['bmh']?></div></td>
    </tr>
<?php
}else{
?>
    <tr>
      <td><div align="right">职业级别</div></td>
      <td colspan="2"><?=$result['level']?></td>
    </tr>
    <tr>
      <td><div align="right">上报单位</div></td>
      <td colspan="3">三峡大学</td>
    </tr>

    
    <tr>
      <td><div align="right" >理论考试时间</div></td>
      <td><div align="left" ><?=$result['llkssj']?></div></td>
      <td width="100"><div align="right" >座位号</div></td>
      <td><div align="left"><?=$result['llkszwh']?></div></td>
    </tr>
    <tr>
      <td><div align="right" >理论考试地点</div></td>
      <td colspan="3"><div align="left" ><?=$result['llksdd']?></div></td>
    </tr>

    <tr>
      <td><div align="right" >实操考试时间</div></td>
      <td><div align="left" ><?=$result['sskssj']?></div></td>
      <td><div align="right">座位号</div></td>
      <td><div align="left"><?=$result['sskszwh']?></div></td>
    </tr>
    <tr>
      <td><div align="right" >实操考试地点</div></td>
      <td colspan="3"><div align="left" ><?=$result['ssksdd']?></div></td>
    </tr>

   <tr>
      <td><div align="right" >综合考试时间</div></td>
      <td><div align="left" ><?=$result['zhkssj']?></div></td>
      <td><div align="right">座位号</div></td>
      <td><div align="left"><?=$result['zhkszwh']?></div></td>
    </tr>
    <tr>
      <td><div align="right" >综合考试地点</div></td>
      <td colspan="3"><div align="left" ><?=$result['zhksdd']?></div></td>
    </tr>
	
	<?php
}
?>
   <tr>
      <td><div align="right" >备注</div></td>
      <td colspan="3"><div align="left" ><?=$result['bz']?></div></td>
    </tr>
    <tr>
      <td colspan="4">
        <div align="left">
          注：请务必带好准考证和身份证进入考场。<br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;考生禁止将手机等电子设备带入考场。     
        </div>
      </td>
    </tr>
  </tbody>
  </table>
</div>
<br><br><br>
<div align="center">
  <table width="570" border="0">
    <tbody>
    <tr>
     <td align="left">
<p align="center" class="bt">考生注意事项</p>
1、考生须凭本准考证和有效身份证件在开考前30分钟到达候考室签到。<br />
2、考生可携带铅笔、橡皮、钢笔等必备文具进入考场，严禁携带书籍、资料、U盘、手机和计算器、手提电脑等辅助工具入场，与考试无关物品一律放置考试区域以外，由考生自行保管。<br />
3、上机考试正式开始后，迟到考生禁止入场。<br />
4、在考试区域内携带手机者，一经发现无论开机与否，一律按违规处理。现场有金属探测仪，为了避免不必要的麻烦，请将手机放在寝室（*******重要*******）<br />
5、考生须在监考老师发出开考信号后开始答题，答题结束后须经监考老师确认交好卷并签名后方可离场。<br />
6、考试过程中须保持考场安静；不得以任何方式作弊或帮助他人作弊，违者将按规定进行处理。<br />
7、考试结束后，考生可在http://chaxun.neea.edu.cn网站查询当次考试成绩和证书信息。<br>
    </td>
    </tr>  
  </table>
</div>

<?php
}
?>
	
</body>
</html>
