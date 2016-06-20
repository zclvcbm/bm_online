<?php
require_once("data/dconfig.php");
require_once("lib/config.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
<title></title>
<meta name="keywords" content="">
<meta name="description" content="">
<style type="text/css">
*{margin:0;padding:0;list-style-type:none;}
a,img{border:0;}
.notice{width:387px;margin:20px auto;height:26px;overflow:hidden;background:url() no-repeat;}
.noticTipTxt{color:#ff7300;height:22px;line-height:22px;overflow:hidden;margin:0 0 0 40px;}
.noticTipTxt li{height:22px;line-height:22px;}
.noticTipTxt a{color:#0075E8;font-size:12px;text-decoration:none;}
.noticTipTxt a:hover{color:#ff7300;text-decoration:underline;}
.button{
width: 140px;
line-height: 38px;
text-align: center;
font-weight: bold;
color: #fff;
text-shadow:1px 1px 1px #333;
border-radius: 5px;
margin:0 20px 20px 0;
position: relative;
overflow: hidden;
}
.button:nth-child(6n){
margin-right: 0;
}
.button.green{
border:1px solid #64c878;
box-shadow: 0 1px 2px #b9ecc4 inset,0 -1px 0 #6c9f76 inset,0 -2px 3px #b9ecc4 inset;
background: -webkit-linear-gradient(top,#90dfa2,#84d494);
background: -moz-linear-gradient(top,#90dfa2,#84d494);
background: linear-gradient(top,#90dfa2,#84d494);
}
</style>
<link media="screen" type="text/css" href="./css/style.css" rel="stylesheet">

<?php
session_start();

$db = new MySql();
$fid_sql = "select  DISTINCT mc from tf_zkzh where sfzh=".$_SESSION['username'];

$tablist = $db->getArray($fid_sql);

$count = count($tablist);
?>  
<!--Header-->
   <div class="header">
    <div class="header_inner">  
    <h1 class="logo">
      <a href="#"><img alt="" src="./images/logo.png"></a>      
    </h1>
    <ul class="nav"></ul>
    <div class="search"></div>
    <ul class="menu">      
      <li></li>
      <li></li>      
    </ul>
  </div>
</div>
<!--/Header--> 
<div class="boxwrap">
  <div class="main_box">
    <h1 class="main_tit">
      准考证打印
    </h1>
      <div <?php if($count>0) echo 'style="display: none;"' ;?>>
          您尚未报名任何科目，无法打印准考证！
      </div>
      <div class="type-list" <?php if($count==0) echo 'style="display: none;"' ;?>>
          <form action="print_zkz.php" method="post">
          考试名称：
          <select name="mc">
              <?php
                foreach ($tablist as $value) 
                    echo "<option value='" . $value['mc'] . "'>" . $value['mc'] . "</option>";
              ?>  
          </select>
          &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="打印准考证"></input>
          </form>
          <div class="clear">
          </div>
      </div>
    <div class="clear"></div>
  </div>
</div>
<!--Footer-->
<div class="footer">
  <div class="footer_inner">
    <div class="copyright">
        <table width=100% height="30" border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td align="center" style="font-size:9pt;line-height:20px; COLOR: #787878;">联系我们 <SPAN class=style5> | 推荐分辨率：1024 X 768 及以上</SPAN><br>
      Copyright&copy;2015 三峡大学继续教育学院 | 学院地址：宜昌市大学路8号 | 邮编：443002 | 联系电话：0717-6398961</td>
      </tr>
        </table>
  </div>
  </div>
</div>
<!--/Footer-->