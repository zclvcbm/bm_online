<?php
require_once("data/dconfig.php");
require_once("lib/config.php");
require_once("waf/waf.php");

$cur_date = date('y-m-d',time());
$db = new MySql();
$sql = "select t.*,f.fname from tf_kkhb t,tf_form f where t.fid=f.fid and end_time>='".$cur_date."' order by id desc";

$result = $db->getArray($sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    
    
    
    <style>
#nav { width:150px; height: 250px; border: 1px solid #D4CD49; position:fixed;left:0;top:30% }
</style>
<div id="nav">关注“三峡大学教育培训中心”<br /><img src="../wx.jpg" width="150" height="150" /><br />时刻掌握培训及考试信息</div>
    
    
    
    
    
    <style type="text/css">
*{margin:0;padding:0;list-style-type:none;}
a,img{border:0;}
.notice{width:387px;margin:20px auto;height:26px;overflow:hidden;background:url() no-repeat;}
.noticTipTxt{color:#ff7300;height:22px;line-height:22px;overflow:hidden;margin:0 0 0 40px;}
.noticTipTxt li{height:22px;line-height:22px;}
.noticTipTxt a{color:#0075E8;font-size:12px;text-decoration:none;}
.noticTipTxt a:hover{color:#ff7300;text-decoration:underline;}
</style>
     <link media="screen" type="text/css" href="./css/style.css" rel="stylesheet">

    <script type="text/javascript" src="./js/jquery.min.js"></script></head>


<body>    
<!--Header-->
   <div class="header">
    <div class="header_inner">
    <h1 class="logo">
      <a href="#"><img alt="" src="./images/logo.png"></a>      
    </h1>
    <ul class="nav"></ul>
    <div class="search"></div>
    <ul class="menu">      
      <li><a href="login.php">登录</a></li>
      <li></li>      
    </ul>
  </div>
</div>
<!--/Header-->



<div class="boxwrap">
  <div class="main_box">
    <h1 class="main_tit">
    考试列表</h1>
    <h1 class="main_tit"><a href="http://210.42.38.102/a/bumengaikuang/banshizhinan/2015/1116/328.html">如何注册及报名</a> <span style="float:right"> 
      <ul id="jsfoot01" class="noticTipTxt">
        <?php
			foreach ($result as $key => $exam) {
			?>
        <li><a href=#><?php echo $exam['fname'];?> <img src="./images/hot001.gif" width="22" height="11"></a></li>
        <?php
			}
			?>
        </ul>
      </span>
    </h1>
 
      <div class="type-list">
          <?php
                    foreach ($result as $key => $exam) {
                      
          ?>
    <dl>
                  <dt>
                      <a href="exam_detail.php?fid=<?php echo $exam['fid']; ?>"><b><?php echo $exam['fname'];?></b></a>
                  </dt>
                  <dd>
                      <?php echo $exam['fname'];?>报名已经开始啦，欢迎大家报考。<br /><?php echo $exam['bz'];?>
                  </dd>
           </dl>
                    <?php
                    }
                    ?>

          <div class="clear">
          </div>
      </div>

    <div class="clear"></div>
  </div>
</div>
 
<div class="clear"></div>
 

 
<!--Footer-->
<div class="footer">
  <div class="footer_inner">
    <div class="copyright">
      	<table width=100% height="90" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td align="center" style="font-size:9pt;line-height:20px; COLOR: #787878;">联系我们 <SPAN class=style5> | 推荐分辨率：1024 X 768 及以上</SPAN><br>
			Copyright&copy;2015 三峡大学继续教育学院 | 学院地址：宜昌市大学路8号 | 邮编：443002 | 联系电话：0717-6398961</td>
			<td><img src='images/wx_logo.jpg' width='80' height='80'></img></td>
		  </tr>
        </table>
  </div>
  </div>
</div>
<!--/Footer-->
    


<script type="text/javascript" src="./js/scrolltext.js"></script>
<script type="text/javascript">

if(document.getElementById("jsfoot01")){
	var scrollup = new ScrollText("jsfoot01");
	scrollup.LineHeight = 22;      
	scrollup.Amount = 1;         
	scrollup.Delay = 20;          
	scrollup.Start();            
	scrollup.Direction = "down"; 
}

if(document.getElementById("jsfoot02")){
	var scrollup = new ScrollText("jsfoot02");
	scrollup.LineHeight = 22;      
	scrollup.Amount = 1;      
	scrollup.Delay = 20;           
	scrollup.Start();             
	scrollup.Direction = "up";   
}
</script> 

</body></html>